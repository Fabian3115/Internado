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
            border-left: 5px solid #007bff;
            /* Azul para aprendiz */
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
            color: #007bff;
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

        .dashboard-header small {
            color: #777;
            font-style: italic;
        }

        /* ✅ Card Perfil */
        .perfil-card {
            background: var(--blanco);
            border-radius: var(--radio);
            padding: 1.5rem;
            box-shadow: var(--sombra);
            width: 280px;
            position: relative;
            overflow: hidden;
            border: 2px solid #007bff;
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
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            object-fit: cover;
            margin-top: -40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .perfil-card h3 {
            margin-top: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
        }

        .perfil-info {
            font-size: 0.9rem;
            color: #333;
            margin-top: 1rem;
        }

        .perfil-info p {
            margin: 0.4rem 0;
        }

        .btn-logout {
            display: block;
            width: 100%;
            background: #007bff;
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
            background: #0056b3;
        }

        /* ✅ Cards módulos */
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

        .btn-azul {
            border: 2px solid #007bff;
            color: #007bff;
        }

        .btn-azul:hover {
            background: #007bff;
            color: #fff;
        }
    </style>

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
                    <div class="card-header-custom text-warning"><i class="ti ti-hourglass"></i> Horas de Contraprestación
                    </div>
                    <p>Consulta el avance de tus horas acumuladas y los registros de jornada.</p>
                    <a href="{{ route('aprendiz.contra_prestacion.index') }}" class="btn-custom btn-azul w-100">Ver mis
                        horas</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-header-custom text-danger"><i class="ti ti-alert-circle"></i> Llamados de Atención
                    </div>
                    <p>Revisa el historial disciplinario asociado a tu perfil.</p>
                    <a href="{{ route('aprendiz.atencion.index') }}" class="btn-custom btn-azul w-100">Ver historial</a>
                </div>
            </div>
        </div>
    </div>
@endsection
