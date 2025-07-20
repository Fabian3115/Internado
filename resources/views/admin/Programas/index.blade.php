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

        .filter-container {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .badge-nivel {
            background-color: #39A900;
            color: #fff;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 8px;
        }
    </style>

    <div class="container py-4">
        <div class="card card-custom">
            {{-- HEADER --}}
            <div class="card-header-custom">
                <span><i class="bi bi-journal-text"></i> Programas de Formación</span>
                <a href="{{ route('admin.programa.create') }}" class="btn btn-success">
                    ➕ Nuevo Programa
                </a>
            </div>

            {{-- FILTROS --}}
            <div class="filter-container mt-3 mx-3">
                <form method="GET" action="{{ route('admin.programa.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..."
                            value="{{ request('nombre') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="ficha" class="form-control" placeholder="Buscar por ficha..."
                            value="{{ request('ficha') }}">
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
                                <th>Nombre</th>
                                <th>Ficha</th>
                                <th>Nivel</th>
                                <th>Sigla</th>
                                <th>Modalidad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programs as $program)
                                <tr>
                                    <td>{{ $program->id }}</td>
                                    <td>{{ $program->program_name }}</td>
                                    <td>{{ $program->technical_sheet }}</td>
                                    <td><span class="badge-nivel">{{ $program->level }}</span></td>
                                    <td>{{ $program->initials }}</td>
                                    <td>{{ $program->mode }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.programa.edit', $program->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.programa.destroy', $program->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirmDelete(this);">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No hay programas registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer text-center">
                {{ $programs->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert confirmación --}}
    <script>
        function confirmDelete(form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Eliminar programa?',
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
