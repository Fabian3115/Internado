@extends('layouts.masterusers')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

@section('contenido')
    <section class="hero-section">
        <h1>Bienvenido al <span style="color:var(--accent)">Internado SENA</span></h1>
        <p>Gestiona tu asistencia, horas de contraprestación y seguimiento disciplinario en un solo lugar.</p>
        <a href="{{ route('login') }}" class="btn-main">Ingresar</a>
    </section>

    <div class="wave">
        <svg viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                d="M0,256L48,229.3C96,203,192,149,288,138.7C384,128,480,160,576,192C672,224,768,256,864,234.7C960,213,1056,139,1152,117.3C1248,96,1344,128,1392,144L1440,160V320H0Z">
            </path>
        </svg>
    </div>

    <section class="features-section">
        <h2>¿Por qué elegir este sistema?</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-calendar-check"></i>
                    <h5>Control de Asistencia</h5>
                    <p>Registra y consulta tu asistencia de forma rápida.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-hourglass-half"></i>
                    <h5>Horas de Contraprestación</h5>
                    <p>Monitorea tu avance en tiempo real.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-balance-scale"></i>
                    <h5>Seguimiento Disciplinario</h5>
                    <p>Consulta tu historial y mejora continuamente.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="modules-section">
        <h2>Funcionalidades Principales</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="module-card">
                    <i class="fas fa-users icon"></i>
                    <h5>Gestión de Aprendices</h5>
                    <p>Consulta y administra aprendices con facilidad.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="module-card">
                    <i class="fas fa-tasks icon"></i>
                    <h5>Control de Actividades</h5>
                    <p>Registra y gestiona tus actividades en tiempo real.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="module-card">
                    <i class="fas fa-chart-line icon"></i>
                    <h5>Reportes Dinámicos</h5>
                    <p>Obtén análisis claros y detallados con gráficos.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
