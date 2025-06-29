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
            <h1 class="mb-0">Programas de Formación</h1>
            <a href="{{ route('admin.programa.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Programa
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Ficha</th>
                    <th>Nivel</th>
                    <th>Sigla</th>
                    <th>Modalidad</th>
                    <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->program_name }}</td>
                        <td>{{ $program->technical_sheet }}</td>
                        <td>{{ $program->level }}</td>
                        <td>{{ $program->initials }}</td>
                        <td>{{ $program->mode }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.programa.edit', $program->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.programa.destroy', $program->id) }}" method="POST"
                                class="d-inline-block" onsubmit="return confirm('¿Eliminar este programa?');">
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
                        <td colspan="7" class="text-center">No hay programas registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $programs->links() }}
        </div>
    </div>
@endsection
