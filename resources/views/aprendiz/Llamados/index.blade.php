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
        <h2 class="fw-bold mb-4">📢 Mis llamados de atención</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Incidente</th>
                        <th>Descripción</th>
                        <th>Observaciones</th>
                        <th>Reportador por</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($llamados as $llamado)
                        <tr>
                            <td>{{ $loop->iteration + ($llamados->currentPage() - 1) * $llamados->perPage() }}</td>
                            <td>{{ \Carbon\Carbon::parse($llamado->date)->format('d/m/Y') }}</td>
                            <td>{{ $llamado->incident }}</td>
                            <td>{{ $llamado->description }}</td>
                            <td>{{ $llamado->observations ?? '—' }}</td>
                            <td>{{ $llamado->recoded_by ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No tienes llamados de atención registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $llamados->links() }}
        </div>
    </div>

@endsection
