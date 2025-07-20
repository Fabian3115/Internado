@extends('layouts.master')

@section('content')
    {{-- Notificaciones SweetAlert --}}
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

        .badge-tipo {
            background-color: var(--verde-sena);
            color: #fff;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 8px;
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
                <span><i class="bi bi-exclamation-circle"></i> Historial de Incidentes</span>
                <a href="{{ route('admin.atencion.create') }}" class="btn btn-success">
                    ➕ Nuevo Incidente
                </a>
            </div>

            {{-- FILTROS --}}
            <div class="filter-container mt-3 mx-3">
                <form method="GET" action="{{ route('admin.atencion.index') }}" class="row g-3">
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
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Observaciones</th>
                                <th>Registrado por</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($llamados as $incident)
                                <tr>
                                    <td>{{ $incident->id }}</td>
                                    <td>{{ $incident->apprentice->person->full_name ?? 'Sin nombre' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($incident->date)->format('d/m/Y') }}</td>
                                    <td><span class="badge-tipo">{{ $incident->incident }}</span></td>
                                    <td>{{ Str::limit($incident->description, 40) }}</td>
                                    <td>{{ Str::limit($incident->observations, 40) }}</td>
                                    <td>{{ $incident->recordedBy->nickname ?? $incident->recorded_by }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.atencion.edit', $incident->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.atencion.destroy', $incident->id) }}"
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
                                    <td colspan="8" class="text-center py-4">No hay incidentes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="card-footer text-center">
                {{ $llamados->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert confirmación --}}
    <script>
        function confirmDelete(form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Eliminar incidente?',
                text: "Esta acción no se puede deshacer.",
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
