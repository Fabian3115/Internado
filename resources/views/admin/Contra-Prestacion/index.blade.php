@extends('layouts.master')

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
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registro Eliminado',
                text: "{{ session('error') }}",
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Historial de Horas</h1>
            <a href="{{ route('admin.contra_prestacion.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Registro
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Aprendiz</th>
                    <th>Horas</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Horas Totales</th>
                    <th>Registrado por</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($horas as $hour)
                    <tr>
                        <td>{{ $hour->id }}</td>
                        <td>{{ $hour->apprentice->person->name ?? 'Sin nombre' }}</td>
                        <td>{{ $hour->hours }}</td>
                        <td>{{ \Carbon\Carbon::parse($hour->activity_date)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($hour->activity_description, 40) }}</td>
                        <td>{{ $hour->total_hours }}</td>
                        <td>{{ $hour->recordedBy->nickname ?? $hour->recorded_by }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center">
            {{ $horas->links() }}
        </div>
    </div>
@endsection
