@extends('layouts.master')

@section('content')
    {{-- SweetAlert para mensajes --}}
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

    {{-- Estilos personalizados --}}
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

        .badge-activo {
            background-color: #39A900;
        }

        .badge-inactivo {
            background-color: #6c757d;
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
            {{-- Header --}}
            <div class="card-header-custom">
                <span><i class="bi bi-people-fill"></i> Lista de Aprendices</span>
                <a href="{{ route('admin.aprendices.create') }}" class="btn btn-success">
                    ➕ Nuevo Aprendiz
                </a>
            </div>

            {{-- Filtros --}}
            <div class="filter-container mt-3 mx-3">
                <form method="GET" action="{{ route('admin.aprendices.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..."
                            value="{{ request('nombre') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="programa" class="form-control" placeholder="Buscar por programa..."
                            value="{{ request('programa') }}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success w-100"><i class="bi bi-search"></i> Filtrar</button>
                    </div>
                </form>
            </div>

            {{-- Tabla --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Aprendiz</th>
                                <th>Programa</th>
                                <th>Estado</th>
                                <th>Nombre Tutor</th>
                                <th>Apellido Tutor</th>
                                <th>Teléfono Tutor</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($apprentices as $apprentice)
                                <tr>
                                    <td>{{ $apprentice->id }}</td>
                                    <td>{{ $apprentice->person->full_name }}</td>
                                    <td>{{ $apprentice->program->program_name }}</td>
                                    <td>
                                        @if ($apprentice->state === 'Activo')
                                            <span class="badge badge-activo">Activo</span>
                                        @else
                                            <span class="badge badge-inactivo">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $apprentice->Tutor_name }}</td>
                                    <td>{{ $apprentice->Tutor_last_name }}</td>
                                    <td>{{ $apprentice->Tutor_number_phone }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-info me-1" title="Ver">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.aprendices.edit', $apprentice->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.aprendices.destroy', $apprentice->id) }}"
                                            method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">No hay aprendices registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer text-center">
                {{ $apprentices->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert confirmación --}}
    <script>
        function confirmDelete(form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Eliminar aprendiz?',
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
