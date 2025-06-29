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
            <h1 class="mb-0">Beneficios</h1>
            <a href="{{ route('admin.beneficio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Beneficio
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Porcentaje (%)</th>
                    <th>Horas Totales</th>
                    <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($benefits as $beneficio)
                    <tr>
                        <td>{{ $beneficio->id }}</td>
                        <td>{{ $beneficio->percentage }}</td>
                        <td>{{ $beneficio->total_hours }}</td>
                        <td class="text-center">
                            <a href="" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.beneficio.edit', $beneficio->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.beneficio.destroy', $beneficio->id) }}" method="POST"
                                class="d-inline-block"
                                onsubmit="return confirm('¿Estás seguro de eliminar este beneficio?');">
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
                        <td colspan="4" class="text-center">No hay beneficios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center">
            {{ $benefits->links() }}
        </div>
    </div>
@endsection
