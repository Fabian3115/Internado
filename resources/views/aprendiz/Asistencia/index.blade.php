@extends('layouts.master')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-HlKf2b62hI+zlfpGdLiYl8AP+5yKqJ14Y8rVfXbsld8hSAbAbEYqP1ZHLaTDKthsgUci+DaRGKQJMko15F8HUw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: "{{ session('success') }}",
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    <div class="container">
        <h1 class="mb-4 fw-bold">📋 Mis asistencias</h1>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Aprendiz</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Justificación</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($asistencias as $attendance)
                        <tr>
                            {{-- Numeración continua entre páginas --}}
                            <td>{{ $loop->iteration + ($asistencias->currentPage() - 1) * $asistencias->perPage() }}</td>

                            {{-- Nombre del aprendiz --}}
                            <td>{{ $attendance->apprentice->person->name ?? 'Sin nombre' }}</td>

                            {{-- Fecha en formato dd/mm/yyyy --}}
                            <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}</td>

                            {{-- Badge de estado --}}
                            <td>
                                @switch($attendance->attendance_status)
                                    @case('Presente')
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Presente</span>
                                    @break

                                    @case('Ausente')
                                        <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Ausente</span>
                                    @break

                                    @case('Justificado')
                                        <span class="badge bg-warning text-dark"><i
                                                class="fas fa-exclamation-circle me-1"></i>Justificado</span>
                                    @break
                                @endswitch
                            </td>

                            <td>{{ $attendance->justification ?? '—' }}</td>

                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron registros de asistencia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación Bootstrap --}}
            <div class="d-flex justify-content-center">
                {{ $asistencias->links() }}
            </div>
        </div>
    @endsection
