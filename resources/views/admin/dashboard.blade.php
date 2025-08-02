@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

@section('content')

    <div class="container py-4">
        {{-- ✅ Encabezado con Perfil --}}
        <div class="dashboard-header">
            <div class="dashboard-text">
                <h1><i class="ti ti-building-community"></i> Centro de Convivencia – Internado SENA</h1>
                <p>
                    Bienvenido <strong>{{ Auth::user()->nickname }}</strong>. Aquí podrás gestionar las áreas clave del
                    internado:
                </p>
                <ul class="dashboard-list">
                    <li><i class="ti ti-user-check text-success"></i> Registro y seguimiento de asistencia</li>
                    <li><i class="ti ti-clock text-success"></i> Control de horas de contraprestación</li>
                    <li><i class="ti ti-alert-circle text-success"></i> Gestión de llamados de atención</li>
                </ul>
            </div>

            {{-- ✅ Card Perfil estilizada --}}
            <div class="perfil-card">
                <div class="perfil-header">
                    <img src="{{ asset(Auth::user()->profile_photo_path ?? 'images/profile_photos/Mamacita.jpg') }}"
                        alt="Foto de perfil" class="rounded-circle" width="100">

                    <h3>{{ Auth::user()->nickname }}</h3>
                </div>
                <div class="perfil-info">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    <p><strong>Rol:</strong> {{ Auth::user()->role }}</p>
                </div>
                {{-- ✅ Botón Cerrar Sesión --}}
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
                    <p>• Registro diario digital<br>• Informes automáticos<br>• Control de ausencias</p>
                    <a href="{{ route('admin.asistencia.index') }}" class="btn-custom btn-verde w-100">Ir al módulo</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-success"><i class="ti ti-hourglass"></i> Horas de Contraprestación
                    </div>
                    <p>• Registro de jornadas<br>• Acumulado automático<br>• Alertas configuradas</p>
                    <a href="{{ route('admin.contra_prestacion.index') }}" class="btn-custom btn-verde w-100">Ir al
                        módulo</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-success"><i class="ti ti-alert-triangle"></i> Llamados de Atención
                    </div>
                    <p>• Registro disciplinario<br>• Historial de aprendiz<br>• Informes detallados</p>
                    <a href="{{ route('admin.atencion.index') }}" class="btn-custom btn-verde w-100">Ir al módulo</a>
                </div>
            </div>
        </div>
    </div>
@endsection
