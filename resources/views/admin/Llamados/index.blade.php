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
            <h1 class="mb-0">Incidentes</h1>
            <a href="{{ route('admin.atencion.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Incidente
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Aprendiz</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Observaciones</th>
                    <th>Registrado por</th>
                    <th class="text-center" style="width: 200px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($llamados as $incident)
                    <tr>
                        <td>{{ $incident->id }}</td>
                        <td>{{ $incident->apprentice->person->name ?? 'Sin nombre' }}</td>
                        <td>{{ \Carbon\Carbon::parse($incident->date)->format('d/m/Y') }}</td>
                        <td>{{ $incident->incident }}</td>
                        <td>{{ Str::limit($incident->description, 40) }}</td>
                        <td>{{ Str::limit($incident->observations, 40) }}</td>
                        <td>{{ $incident->recordedBy->nickname ?? $incident->recorded_by }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.atencion.edit', $incident->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.atencion.destroy', $incident->id) }}" method="POST"
                                class="d-inline-block" onsubmit="return confirm('¿Eliminar este incidente?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay incidentes registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $llamados->links() }}
        </div>
    </div>
@endsection
