@extends('layouts.master')

@section('content')
    {{-- Notificaciones con SweetAlert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Registro Exitoso!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#39A900'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registro Eliminado',
                text: "{{ session('error') }}",
                confirmButtonColor: '#39A900'
            });
        </script>
    @endif

    <style>
        :root {
            --verde-sena: #39A900;
            --gris-claro: #f8f9fa;
        }

        body {
            background-color: var(--gris-claro);
        }

        .card-custom {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header-custom {
            background: var(--verde-sena);
            color: #fff;
            padding: 1rem 1.5rem;
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .table-hover tbody tr:hover {
            background-color: #f3f8f3;
            transition: 0.2s;
        }

        .badge-presente {
            background-color: #39A900;
        }

        .badge-ausente {
            background-color: #dc3545;
        }

        .badge-excusa {
            background-color: #ffc107;
            color: #000;
        }

        .filter-container {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="container py-4">
        <div class="card card-custom">
            {{-- HEADER --}}
            <div class="card-header-custom">
                <span><i class="bi bi-clock-history"></i> Historial de Asistencias</span>
                <a href="{{ route('admin.asistencia.create') }}" class="btn btn-success">
                    ➕ Registrar asistencia
                </a>
            </div>

            {{-- FILTROS --}}
            <div class="filter-container mt-3 mx-3">
                <form method="GET" action="{{ route('admin.asistencia.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="aprendiz" class="form-control" placeholder="Buscar aprendiz..."
                            value="{{ request('aprendiz') }}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success w-100"><i class="bi bi-search"></i> Filtrar</button>
                    </div>
                </form>
            </div>

            {{-- TABLA --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
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
                                    <td>{{ $asistencia->apprentice->person->full_name ?? 'Sin nombre' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($asistencia->attendance_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($asistencia->attendance_status === 'Presente')
                                            <span class="badge badge-presente">Presente</span>
                                        @elseif($asistencia->attendance_status === 'Ausente')
                                            <span class="badge badge-ausente">Ausente</span>
                                        @else
                                            <span class="badge badge-excusa">Excusa</span>
                                        @endif
                                    </td>
                                    <td>{{ $asistencia->justification ?? '—' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.asistencia.edit', $asistencia->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.asistencia.destroy', $asistencia->id) }}"
                                            method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No hay asistencias registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer text-center">
                {{ $asistencias->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert confirmación --}}
    <script>
        function confirmDelete(form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Eliminar registro?',
                text: "No podrás deshacer esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#39A900',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>
@endsection
