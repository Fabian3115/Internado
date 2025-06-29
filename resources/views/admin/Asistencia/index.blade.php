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

    {{-- Contenedor principal --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0 fw-bold">📋 Asistencias registradas</h1>
            <a href="{{ route('admin.asistencia.create') }}" class="btn btn-success">
                ➕ Nueva asistencia
            </a>
        </div>

        {{-- Tabla --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Aprendiz</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Justificación</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($asistencias as $asistencia)
                                <tr>
                                    <td>{{ $asistencia->id }}</td>

                                    {{-- Aprendiz → Usuario → Persona → nombre --}}
                                    <td>
                                        {{ $asistencia->apprentice->person->name ?? 'Sin nombre' }}
                                    </td>

                                    <td>{{ $asistencia->attendance_date ?? '—' }}</td>
                                    <td>{{ $asistencia->attendance_status ?? '—' }}</td>
                                    <td>{{ $asistencia->justification ?? '—' }}</td>

                                    <td class="text-center">
                                        <a href="" class="btn btn-sm btn-outline-info me-1" title="Ver">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('admin.asistencia.edit', $asistencia->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.asistencia.destroy', $asistencia->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                onclick="return confirm('¿Eliminar asistencia?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        No hay asistencias registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer">
                {{ $asistencias->links() }}
            </div>
        </div>
    </div>
@endsection
