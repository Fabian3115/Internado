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
    
    {{-- Contenedor principal --}}
    <div class="container py-4">
        <h2 class="fw-bold mb-4">⏱️ Mis horas de contraprestación</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Horas Registradas</th>
                        <th>Actividad</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($horas as $registro)
                        <tr>
                            <td>{{ $loop->iteration + ($horas->currentPage() - 1) * $horas->perPage() }}</td>
                            <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                            <td><strong>{{ $registro->cantidad_horas }}</strong></td>
                            <td>{{ $registro->actividad }}</td>
                            <td>{{ $registro->observaciones ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No tienes horas de contraprestación registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $horas->links() }}
        </div>
    </div>
@endsection
