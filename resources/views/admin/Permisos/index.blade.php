@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('css/admin/lista_admin_permisos.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

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
                            <td class="text-start d-flex align-items-center gap-2">
                                <img src="{{ asset($salida->apprentice->user->profile_photo_path ?? 'modules/gdf/images/Photo/prueba.jpg') }}"
                                    alt="Foto del Aprendiz" class="mini-avatar-admin">
                                <span>{{ $salida->apprentice->person->name }} {{ $salida->apprentice->person->last_name }}</span>
                            </td>
                            <td>{{ $salida->reason }}</td>
                            <td>{{ \Carbon\Carbon::parse($salida->departure_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>{{ $salida->destination ?? '-' }}</td>
                            <td>
                                @if ($salida->status == 'pendiente')
                                    <span style="color: orange; font-weight:bold;">Pendiente</span>
                                @elseif($salida->status == 'aprobada')
                                    <span style="color: green; font-weight:bold;">✅ Aprobada</span>
                                @else
                                    <span style="color: red; font-weight:bold;">❌ Rechazada</span>
                                @endif
                            </td>
                            <td class="acciones">
                                @if ($salida->status == 'pendiente')
                                    <button type="button" class="btn btn-aprobar" data-id="{{ $salida->id }}">✅
                                        Aprobar</button>
                                    <button type="button" class="btn btn-rechazar" data-id="{{ $salida->id }}">❌
                                        Rechazar</button>
                                @else
                                    <em class="text-muted">No disponible</em>
                                @endif
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
            document.querySelectorAll('.btn-aprobar').forEach(button => {
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

            // Rechazar con motivo
            document.querySelectorAll('.btn-rechazar').forEach(button => {
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

        });
    </script>

@endsection
