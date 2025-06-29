@extends('layouts.master')

@section('content')
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
            <h1 class="mb-0">Aprendices</h1>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    {{-- Campos del modelo --}}
                    <th>Porcentaje&nbsp;Beneficio</th>
                    <th>Persona&nbsp;ID</th>
                    <th>Programa&nbsp;ID</th>
                    <th>Estado</th>
                    <th>Nombre&nbsp;Tutor</th>
                    <th>Apellido&nbsp;Tutor</th>
                    <th>Teléfono&nbsp;Tutor</th>
                    <th class="text-center" style="width: 200px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($apprentices as $apprentice)
                    <tr>
                        {{-- IDs y valores puros del modelo --}}
                        <td>{{ $apprentice->id }}</td>
                        <td>{{ $apprentice->benefit->percentage }} %</td>
                        <td>{{ $apprentice->person->name }}</td>
                        <td>{{ $apprentice->program->program_name }}</td>

                        {{-- Estado con badge --}}
                        <td>
                            <span class="badge {{ $apprentice->state === 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($apprentice->state) }}
                            </span>
                        </td>

                        {{-- Datos de tutor --}}
                        <td>{{ $apprentice->Tutor_name }}</td>
                        <td>{{ $apprentice->Tutor_last_name }}</td>
                        <td>{{ $apprentice->Tutor_number_phone }}</td>

                        {{-- Botones --}}
                        <td class="text-center">
                            <a href="" class="btn btn-sm btn-outline-info me-1" title="Ver">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('admin.aprendices.edit', $apprentice->id) }}"
                                class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.aprendices.destroy', $apprentice->id) }}" method="POST"
                                class="d-inline-block" onsubmit="return confirm('¿Eliminar este aprendiz?');">
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
                        <td colspan="12" class="text-center">No hay aprendices registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $apprentices->links() }}
        </div>
    </div>
@endsection
