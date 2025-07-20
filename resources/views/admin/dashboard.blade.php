@extends('layouts.master')

@section('content')
    <style>
        :root {
            --verde-sena: #39A900;
            --gris-fondo: #f4f6f8;
            --blanco: #fff;
            --sombra: 0 4px 8px rgba(0, 0, 0, 0.08);
            --radio: 12px;
            --transicion: 0.3s ease;
            --degradado-perfil: linear-gradient(135deg, #39A900 0%, #56c800 100%);
        }

        body {
            background: var(--gris-fondo);
        }

        /* ✅ Card principal */
        .dashboard-header {
            background: var(--blanco);
            padding: 2rem;
            border-radius: var(--radio);
            box-shadow: var(--sombra);
            margin-bottom: 2rem;
            border-left: 5px solid var(--verde-sena);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .dashboard-text {
            flex: 1;
            min-width: 280px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
            color: var(--verde-sena);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .dashboard-header p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .dashboard-list li {
            padding: 0.6rem 0;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
        }

        /* ✅ Card Perfil estilizada */
        .perfil-card {
            background: var(--blanco);
            border-radius: var(--radio);
            padding: 1.5rem;
            box-shadow: var(--sombra);
            width: 280px;
            position: relative;
            overflow: hidden;
            border: 2px solid var(--verde-sena);
        }

        .perfil-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: var(--degradado-perfil);
            z-index: 0;
        }

        .perfil-header {
            text-align: center;
            position: relative;
            z-index: 1;
            margin-bottom: 1rem;
        }

        .perfil-avatar {
            position: relative;
            z-index: 1;
        }

        .perfil-avatar::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .perfil-avatar:hover::after {
            opacity: 1;
        }


        .perfil-card h3 {
            margin-top: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--verde-sena);
        }

        .perfil-info {
            font-size: 0.9rem;
            color: #333;
            text-align: left;
            margin-top: 1rem;
        }

        .perfil-info p {
            margin: 0.4rem 0;
        }

        .btn-logout {
            display: block;
            width: 100%;
            background: var(--verde-sena);
            color: #fff;
            padding: 10px;
            border-radius: var(--radio);
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            margin-top: 1rem;
            transition: background var(--transicion);
        }

        .btn-logout:hover {
            background: #2e7d00;
        }

        /* ✅ Tarjetas de módulos */
        .card-custom {
            background: var(--blanco);
            border-radius: var(--radio);
            padding: 1rem;
            box-shadow: var(--sombra);
            transition: transform var(--transicion);
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-header-custom {
            font-weight: bold;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-custom {
            display: inline-block;
            text-align: center;
            padding: 10px;
            border-radius: var(--radio);
            font-weight: bold;
            text-decoration: none;
            transition: background var(--transicion);
        }

        .btn-verde {
            border: 2px solid var(--verde-sena);
            color: var(--verde-sena);
        }

        .btn-verde:hover {
            background: var(--verde-sena);
            color: #fff;
        }
    </style>

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
