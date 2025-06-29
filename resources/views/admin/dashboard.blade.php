{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.master')

@section('title', 'Dashboard Administrador')


@section('content')

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

    {{-- Contenido principal --}}
    <div class="container py-4">
        {{-- Encabezado estilizado --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-light p-4 rounded shadow-sm border-start border-success border-4">
                    <h1 class="display-6 fw-bold text-success mb-3">
                        <i class="fas fa-school me-2"></i>Centro de Convivencia – Internado SENA
                    </h1>

                    <p class="lead">
                        Bienvenido <strong class="text-dark">{{ Auth::user()->nickname }}</strong>. Este sistema digital te
                        permite gestionar de forma eficiente los aspectos clave del internado:
                    </p>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item bg-light">
                            <i class="fas fa-user-check text-success me-2"></i>
                            <strong>Registro y seguimiento de asistencia</strong> de aprendices.
                        </li>
                        <li class="list-group-item bg-light">
                            <i class="fas fa-clock text-success me-2"></i>
                            <strong>Control de horas de contraprestación</strong> (40 u 80 h requeridas).
                        </li>
                        <li class="list-group-item bg-light">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                            <strong>Gestión de llamados de atención</strong> y seguimiento disciplinario.
                        </li>
                    </ul>

                    <p class="text-muted small fst-italic mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        * Módulos como <u>asignación de camas</u> fueron excluidos según el alcance aprobado.
                    </p>
                </div>
            </div>
        </div>

        {{-- Tarjetas de módulos --}}
        <div class="row g-4">
            {{-- Asistencia --}}
            <div class="col-md-4">
                <div class="card h-100 border-success">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-clipboard-check me-1"></i> Asistencia
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            • Registro diario mediante listas digitales.<br>
                            • Informes de asistencia para los responsables.<br>
                            • Detección de ausencias recurrentes.
                        </p>
                        <a href="{{ route('admin.asistencia.index') }}" class="btn btn-outline-success w-100">
                            Ir al módulo
                        </a>
                    </div>
                </div>
            </div>

            {{-- Contraprestación --}}
            <div class="col-md-4">
                <div class="card h-100 border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-hourglass-half me-1"></i> Horas de Contraprestación
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            • Registro de fecha de las jornadas.<br>
                            • Acumulado automático de horas.<br>
                            • Alertas cuando se alcanzan las 40 u 80 h.
                        </p>
                        <a href="{{ route('admin.contra_prestacion.index') }}" class="btn btn-outline-warning w-100">
                            Ir al módulo
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
                            • Registro de incidentes y observaciones.<br>
                            • Historial disciplinario por aprendiz.<br>
                            • Informes para seguimiento institucional.
                        </p>
                        <a href="{{ route('admin.atencion.index') }}" class="btn btn-outline-danger w-100">
                            Ir al módulo
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
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
