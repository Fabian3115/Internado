@extends('layouts.master')

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-HlKf2b62hI+zlfpGdLiYl8AP+5yKqJ14Y8rVfXbsld8hSAbAbEYqP1ZHLaTDKthsgUci+DaRGKQJMko15F8HUw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Estilos personalizados --}}
{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/lista_contra_prestacion.css') }}">


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
            <i class="fas fa-clock"></i> Mis Horas de Contraprestación
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th><i class="fas fa-hashtag"></i></th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                            <th><i class="fas fa-hourglass-half"></i> Horas</th>
                            <th><i class="fas fa-tasks"></i> Fecha de la Actividad</th>
                            <th><i class="fas fa-comment-dots"></i> Total de Horas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($horas as $registro)
                            <tr>
                                <td>{{ $loop->iteration + ($horas->currentPage() - 1) * $horas->perPage() }}</td>
                                <td>
                                    <i class="fas fa-calendar-day text-primary me-1"></i>
                                    {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <i class="fas fa-sticky-note text-warning me-1"></i>
                                    {{ $registro->hours ?? '—' }}
                                </td>
                                <td><i class="fas fa-tasks text-info me-1"></i>{{ $registro->activity_date }}</td>
                                <td>
                                    <span class="badge-horas">
                                        <i class="fas fa-clock"></i> {{ $registro->total_hours }} h
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i><br>
                                    No tienes horas registradas.
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
                    @if ($horas->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $horas->previousPageUrl() }}" class="page-link" aria-label="Anterior">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Números --}}
                    @foreach ($horas->getUrlRange(1, $horas->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $horas->currentPage() ? 'active' : '' }}">
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Botón Siguiente --}}
                    @if ($horas->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $horas->nextPageUrl() }}" class="page-link" aria-label="Siguiente">
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
