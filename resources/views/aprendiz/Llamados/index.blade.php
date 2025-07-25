@extends('layouts.master')

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-HlKf2b62hI+zlfpGdLiYl8AP+5yKqJ14Y8rVfXbsld8hSAbAbEYqP1ZHLaTDKthsgUci+DaRGKQJMko15F8HUw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/lista_llamados.css') }}">

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '✅ Registro Exitoso',
                text: "{{ session('success') }}",
                confirmButtonColor: '#39A900',
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    <div class="container py-5">
        <div class="card card-custom">
            <div class="card-header-custom">
                <i class="fas fa-bullhorn"></i> Mis Llamados de Atención
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-success">
                            <tr>
                                <th><i class="fas fa-hashtag"></i></th>
                                <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                                <th><i class="fas fa-exclamation-triangle"></i> Incidente</th>
                                <th><i class="fas fa-align-left"></i> Descripción</th>
                                <th><i class="fas fa-comment-dots"></i> Observaciones</th>
                                <th><i class="fas fa-user-tie"></i> Reportado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($llamados as $llamado)
                                <tr>
                                    <td>{{ $loop->iteration + ($llamados->currentPage() - 1) * $llamados->perPage() }}</td>
                                    <td><i
                                            class="fas fa-calendar-day text-primary me-1"></i>{{ \Carbon\Carbon::parse($llamado->date)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <span class="badge-incidente">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $llamado->incident }}
                                        </span>
                                    </td>
                                    <td>{{ $llamado->description }}</td>
                                    <td><i
                                            class="fas fa-sticky-note text-warning me-1"></i>{{ $llamado->observations ?? '—' }}
                                    </td>
                                    <td><i class="fas fa-user text-info me-1"></i>{{ $llamado->user->nickname ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i><br>
                                        No tienes llamados de atención registrados.
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
                        @if ($llamados->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $llamados->previousPageUrl() }}" class="page-link" aria-label="Anterior">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Números --}}
                        @foreach ($llamados->getUrlRange(1, $llamados->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $llamados->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Botón Siguiente --}}
                        @if ($llamados->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $llamados->nextPageUrl() }}" class="page-link" aria-label="Siguiente">
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
