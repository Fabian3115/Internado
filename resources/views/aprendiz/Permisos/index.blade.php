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
            font-family: 'Segoe UI', sans-serif;
        }

        .container-lista {
            max-width: 1100px;
            margin: 40px auto;
            background: var(--blanco);
            border-radius: var(--radio);
            box-shadow: var(--sombra);
            padding: 30px;
            animation: fadeIn 0.6s ease-in-out;
        }

        .titulo-lista {
            text-align: center;
            color: var(--verde-sena);
            font-weight: bold;
            margin-bottom: 25px;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
            font-size: 15px;
        }

        th {
            background-color: var(--verde-sena);
            color: var(--blanco);
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-accion {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-editar {
            background-color: var(--verde-sena);
            color: #fff;
        }

        .btn-editar:hover {
            background-color: #2e7d32;
        }

        .btn-eliminar {
            background-color: #e53935;
            color: #fff;
        }

        .btn-eliminar:hover {
            background-color: #c62828;
        }

        .estado-badge {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .pendiente {
            background: #fff3cd;
            color: #856404;
        }

        .aprobada {
            background: #d4edda;
            color: #155724;
        }

        .rechazada {
            background: #f8d7da;
            color: #721c24;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <div class="container-lista">
        <h2 class="titulo-lista"><i class="fas fa-sign-out-alt"></i> Mis Solicitudes de Salida</h2>

        @if ($salidas->isEmpty())
            <p style="text-align:center; color:#666;">No tienes solicitudes registradas aún.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-info-circle"></i> Motivo</th>
                        <th><i class="fas fa-sign-out-alt"></i> Salida</th>
                        <th><i class="fas fa-sign-in-alt"></i> Regreso</th>
                        <th><i class="fas fa-map-marker-alt"></i> Destino</th>
                        <th><i class="fas fa-check-circle"></i> Estado</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                        <tr>
                            <td>{{ $salida->reason }}</td>
                            <td>{{ \Carbon\Carbon::parse($salida->departure_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $salida->destination ?? '-' }}</td>
                            <td>
                                <span class="estado-badge
                                    {{ $salida->status == 'pendiente' ? 'pendiente' : ($salida->status == 'aprobada' ? 'aprobada' : 'rechazada') }}">
                                    {{ ucfirst($salida->status) }}
                                </span>
                            </td>
                            <td class="acciones">
                                @if ($salida->status == 'pendiente')
                                    <a href="{{ route('aprendiz.request.edit', $salida->id) }}"
                                       class="btn-accion btn-editar"
                                       title="Editar" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('aprendiz.request.delete', $salida->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-accion btn-eliminar"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?')"
                                                title="Eliminar" data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @else
                                    <span style="color:#999;">No disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Activar tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
