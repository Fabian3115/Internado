@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('css/aprendiz/dashboard.css') }}">

@section('content')

    <div class="container py-4">
        {{-- ✅ Encabezado con Perfil --}}
        <div class="dashboard-header">
            <div class="dashboard-text">
                <h1><i class="ti ti-user-circle"></i> Bienvenido, {{ Auth::user()->nickname }}</h1>
                <p>
                    Consulta tus registros en el internado.<br>
                    <small><i class="ti ti-eye"></i> Solo cuentas con <strong>acceso de lectura</strong> sobre tu
                        información.</small>
                </p>
            </div>

            {{-- ✅ Card Perfil --}}
            <div class="perfil-card">
                <div class="perfil-header">
                    <img src="{{ asset(Auth::user()->profile_photo_path ?? 'images/profile_photos/Mamacita.jpg') }}" alt="Foto de perfil"
                        class="rounded-circle" width="100">

                    <h3>{{ Auth::user()->nickname }}</h3>
                </div>
                <div class="perfil-info">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    <p><strong>Rol:</strong> {{ Auth::user()->role }}</p>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="ti ti-logout"></i> Cerrar sesión</button>
                </form>
            </div>
        </div>

        {{-- ✅ Tarjetas de módulos --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-success"><i class="ti ti-clipboard-check"></i> Asistencia</div>
                    <p>Consulta tus listas diarias y verifica ausencias registradas.</p>
                    <a href="{{ route('aprendiz.asistencia.index') }}" class="btn-custom btn-azul w-100">Ver mis listas</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-success"><i class="ti ti-hourglass"></i> Horas de Contraprestación
                    </div>
                    <p>Consulta el avance de tus horas acumuladas y los registros de jornada.</p>
                    <a href="{{ route('aprendiz.contra_prestacion.index') }}" class="btn-custom btn-azul w-100">Ver mis
                        horas</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-success"><i class="ti ti-alert-circle"></i> Llamados de Atención
                    </div>
                    <p>Revisa el historial disciplinario asociado a tu perfil y tengas un control de tu disciplina.</p>
                    <a href="{{ route('aprendiz.atencion.index') }}" class="btn-custom btn-azul w-100">Ver historial</a>
                </div>
            </div>

        </div>
    </div>
@endsection
