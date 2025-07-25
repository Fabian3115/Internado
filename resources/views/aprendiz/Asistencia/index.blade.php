@extends('layouts.master')

{{-- Importar FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-HlKf2b62hI+zlfpGdLiYl8AP+5yKqJ14Y8rVfXbsld8hSAbAbEYqP1ZHLaTDKthsgUci+DaRGKQJMko15F8HUw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/lista_asistencia.css') }}">

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '✅ ¡Registro Exitoso!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#39A900',
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    <div class="container py-5">
        <div class="card card-custom">
            <div class="card-header-custom">
                <i class="fas fa-clipboard-list"></i> Mis Asistencias
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-hashtag"></i></th>
                                <th><i class="fas fa-user"></i> Aprendiz</th>
                                <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                                <th><i class="fas fa-check-double"></i> Estado</th>
                                <th><i class="fas fa-file-alt"></i> Justificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($asistencias as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration + ($asistencias->currentPage() - 1) * $asistencias->perPage() }}
                                    </td>
                                    <td class="fw-semibold"><i
                                            class="fas fa-id-badge text-success me-2"></i>{{ $attendance->apprentice->person->name ?? 'Sin nombre' }}
                                    </td>
                                    <td><i
                                            class="fas fa-calendar-day text-primary me-1"></i>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        @switch($attendance->attendance_status)
                                            @case('Presente')
                                                <span class="estado-badge presente">
                                                    <i class="fas fa-check-circle"></i> Presente
                                                </span>
                                            @break

                                            @case('Ausente')
                                                <span class="estado-badge ausente">
                                                    <i class="fas fa-times-circle"></i> Ausente
                                                </span>
                                            @break

                                            @case('Justificado')
                                                <span class="estado-badge justificado">
                                                    <i class="fas fa-exclamation-circle"></i> Justificado
                                                </span>
                                            @break
                                        @endswitch
                                    </td>

                                    <td><i
                                            class="fas fa-file-signature text-info me-1"></i>{{ $attendance->justification ?? '—' }}
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i><br>
                                            No se encontraron registros de asistencia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación personalizada --}}
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination pagination-custom">
                            {{-- Botón Anterior --}}
                            @if ($asistencias->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $asistencias->previousPageUrl() }}" class="page-link" aria-label="Anterior">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Números --}}
                            @foreach ($asistencias->getUrlRange(1, $asistencias->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $asistencias->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Botón Siguiente --}}
                            @if ($asistencias->hasMorePages())
                                <li class="page-item">
                                    <a href="{{ $asistencias->nextPageUrl() }}" class="page-link" aria-label="Siguiente">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    @endsection
