@extends('layouts.master')

@section('content')
    <style>
        :root {
            --verde-sena: #39A900;
            --gris-fondo: #f4f6f8;
            --blanco: #ffffff;
            --sombra: 0 4px 10px rgba(0, 0, 0, 0.1);
            --radio: 12px;
        }

        body {
            background-color: var(--gris-fondo);
        }

        .container-admin {
            max-width: 1200px;
            margin: 40px auto;
            background: var(--blanco);
            border-radius: var(--radio);
            box-shadow: var(--sombra);
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }

        .titulo-admin {
            text-align: center;
            color: var(--verde-sena);
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: var(--verde-sena);
            color: var(--blanco);
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: var(--radio);
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-aprobar {
            background-color: #43a047;
            color: white;
        }

        .btn-aprobar:hover {
            background-color: #2e7d32;
        }

        .btn-rechazar {
            background-color: #e53935;
            color: white;
        }

        .btn-rechazar:hover {
            background-color: #c62828;
        }

        .btn-eliminar {
            background-color: #757575;
            color: white;
        }

        .btn-eliminar:hover {
            background-color: #424242;
        }
    </style>

    <div class="container-admin">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif
        <h2 class="titulo-admin">Gestión de Solicitudes de Salida</h2>

        @if ($salidas->isEmpty())
            <p style="text-align:center; color:#666;">No hay solicitudes registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Aprendiz</th>
                        <th>Motivo</th>
                        <th>Salida</th>
                        <th>Regreso</th>
                        <th>Destino</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                        <tr>
                            <td>{{ $salida->apprentice->name }}</td>
                            <td>{{ $salida->reason }}</td>
                            <td>{{ \Carbon\Carbon::parse($salida->departure_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>{{ $salida->destination ?? '-' }}</td>
                            <td>
                                @if ($salida->status == 'pendiente')
                                    <span style="color: orange; font-weight:bold;">Pendiente</span>
                                @elseif($salida->status == 'aprobada')
                                    <span style="color: green; font-weight:bold;">Aprobada</span>
                                @else
                                    <span style="color: red; font-weight:bold;">Rechazada</span>
                                @endif
                            </td>
                            <td class="acciones">
                                @if ($salida->status == 'pendiente')
                                    <form action="" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-aprobar btn-approve"
                                            data-id="{{ $salida->id }}">Aprobar</button>
                                    </form>
                                    <form action="" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-rechazar btn-reject"
                                            data-id="{{ $salida->id }}">Rechazar</button>
                                    </form>
                                @endif
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-eliminar btn-delete"
                                        data-id="{{ $salida->id }}">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aprobar
            document.querySelectorAll('.btn-approve').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.dataset.id;
                    Swal.fire({
                        title: '¿Aprobar esta solicitud?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#39A900',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, aprobar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/Salida-internado/${id}/aceptar`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            }).then(() => location.reload());
                        }
                    });
                });
            });

            // Rechazar con comentario
            document.querySelectorAll('.btn-reject').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.dataset.id;
                    Swal.fire({
                        title: 'Rechazar solicitud',
                        input: 'textarea',
                        inputLabel: 'Motivo del rechazo:',
                        inputPlaceholder: 'Escribe el motivo...',
                        showCancelButton: true,
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#757575',
                        confirmButtonText: 'Rechazar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/Salida-internado/${id}/rechazar`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    comment: result.value
                                })
                            }).then(() => location.reload());
                        }
                    });
                });
            });

            // Eliminar
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.dataset.id;
                    Swal.fire({
                        title: '¿Eliminar esta solicitud?',
                        text: "No podrás revertir esta acción",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#757575',
                        confirmButtonText: 'Sí, eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/salidas/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            }).then(() => location.reload());
                        }
                    });
                });
            });
        });
    </script>

@endsection
