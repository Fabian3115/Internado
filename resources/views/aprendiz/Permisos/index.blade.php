@extends('layouts.master')

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/permisos/lista_permisos.css') }}">

@section('content')

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
                            <td>{{ $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>{{ $salida->destination ?? '-' }}</td>
                            <td>
                                <span
                                    class="estado-badge
                                    {{ $salida->status == 'pendiente' ? 'pendiente' : ($salida->status == 'aprobada' ? 'aprobada' : 'rechazada') }}">
                                    {{ ucfirst($salida->status) }}
                                </span>
                            </td>
                            <td class="acciones">
                                @if ($salida->status == 'pendiente')
                                    <a href="{{ route('aprendiz.request.edit', $salida->id) }}"
                                        class="btn-accion btn-editar" title="Editar" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('aprendiz.request.delete', $salida->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-accion btn-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?')"
                                            title="Eliminar" data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @elseif ($salida->status == 'aprobada')
                                    <span style="color:#999;">Su Solicitud fue aprobada</span>
                                @else
                                    <span style="color:#999;">Su Solicitud fue rechazada</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
