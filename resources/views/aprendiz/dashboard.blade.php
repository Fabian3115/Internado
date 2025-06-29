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
                title: 'Acceso Denegado',
                text: "{{ session('error') }}",
                confirmButtonText: 'Entendido'
            });
        </script>
        </div>
    @endif

    <div class="container py-4">
        {{-- Encabezado estilizado --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-light p-4 rounded shadow-sm border-start border-primary border-4">
                    <h1 class="display-6 fw-bold text-primary mb-3">
                        <i class="fas fa-user-circle me-2"></i>Bienvenido, {{ Auth::user()->nickname }}
                    </h1>

                    <p class="lead mb-0">
                        <i class="fas fa-eye me-1 text-primary"></i>
                        Consulta tus registros en el internado. <br>
                        <small class="text-muted">
                            Solo cuentas con <strong>acceso de lectura</strong> sobre la información asociada a tu usuario.
                        </small>
                    </p>
                </div>
            </div>
        </div>


        {{-- Tarjetas de módulos (solo lectura) --}}
        <div class="row g-4">
            {{-- Asistencia --}}
            <div class="col-md-4">
                <div class="card h-100 border-success">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-clipboard-check me-1"></i> Asistencia
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Revisa tus listas diarias de asistencia y verifica ausencias registradas.
                        </p>
                        <a href="{{ route('aprendiz.asistencia.index') }}" class="btn btn-outline-success w-100">
                            Ver mis listas
                        </a>
                    </div>
                </div>
            </div>

            {{-- Horas de contraprestación --}}
            <div class="col-md-4">
                <div class="card h-100 border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-hourglass-half me-1"></i> Horas de Contraprestación
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Consulta el avance de tus horas acumuladas y los registros de jornada.
                        </p>
                        <a href="{{ route('aprendiz.contra_prestacion.index') }}" class="btn btn-outline-warning w-100">
                            Ver mis horas
                        </a>
                    </div>
                </div>
            </div>

            {{-- Llamados de atención --}}
            <div class="col-md-4">
                <div class="card h-100 border-danger">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-exclamation-triangle me-1"></i> Llamados de Atención
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Revisa el historial de observaciones disciplinarias asociadas a tu perfil.
                        </p>
                        <a href="{{ route('aprendiz.atencion.index') }}" class="btn btn-outline-danger w-100">
                            Ver historial
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Perfil del usuario --}}
        <div class="row mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="h5 mb-0"><i class="fas fa-user-circle me-2"></i>Tu perfil</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ Auth::user()->nickname }}</p>
                        <p><strong>Correo:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
