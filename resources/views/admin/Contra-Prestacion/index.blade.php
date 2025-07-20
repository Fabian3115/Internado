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

        .badge-horas {
            background-color: #39A900;
            color: #fff;
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
                <span><i class="bi bi-clock-history"></i> Historial de Horas</span>
                <a href="{{ route('admin.contra_prestacion.create') }}" class="btn btn-success">
                    ➕ Regitrar Horas
                </a>
            </div>

            {{-- FILTROS --}}
            <div class="filter-container mt-3 mx-3">
                <form method="GET" action="{{ route('admin.contra_prestacion.index') }}" class="row g-3">
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
                                <th>Horas</th>
                                <th>Fecha</th>
                                <th>Horas Totales</th>
                                <th>Registrado por</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($horas as $hour)
                                <tr>
                                    <td>{{ $hour->id }}</td>
                                    <td>{{ $hour->apprentice->person->full_name ?? 'Sin nombre' }}</td>
                                    <td><span class="badge badge-horas">{{ $hour->hours }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($hour->activity_date)->format('d/m/Y') }}</td>
                                    <td>{{ $hour->total_hours }}</td>
                                    <td>{{ $hour->recordedBy->nickname ?? $hour->recorded_by }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.contra_prestacion.edit', $hour->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.contra_prestacion.destroy', $hour->id) }}"
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
                                    <td colspan="7" class="text-center py-4">No hay registros.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer text-center">
                {{ $horas->links() }}
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
