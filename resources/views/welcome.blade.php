@extends('layouts.masterusers')

{{-- Estilos exclusivos para esta página --}}
<link rel="stylesheet" href="{{asset('css/welcome.css')}}">

@section('contenido')
    {{-- HERO / BIENVENIDA ———————————————————————————————————————— --}}
    <section class="landing-section text-light">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">🌿 Bienvenido al Internado SENA</h1>
            <p class="lead mb-5 mx-auto" style="max-width:720px">
                Tu experiencia formativa empieza aquí. Lleva un control transparente de tus <strong>asistencias</strong>,
                <strong>horas de contraprestación</strong> y <strong>seguimiento disciplinario</strong>, todo en un solo
                lugar.
            </p>

            {{-- Tres beneficios rápidos --}}
            <div class="d-flex justify-content-center flex-wrap gap-4 mb-5">
                <div class="info-box bg-white text-dark p-4 rounded">
                    <h5 class="fw-bold mb-2">📅 Asistencia</h5>
                    <p class="mb-0 small">Historial de asistencia siempre disponible.</p>
                </div>
                <div class="info-box bg-white text-dark p-4 rounded">
                    <h5 class="fw-bold mb-2">⏱️ Horas de Contraprestación</h5>
                    <p class="mb-0 small">Visualiza tu progreso hacia las 40 u 80 horas requeridas.</p>
                </div>
                <div class="info-box bg-white text-dark p-4 rounded">
                    <h5 class="fw-bold mb-2">⚖️ Seguimiento Disciplinario</h5>
                    <p class="mb-0 small">Observa mejoras y llamados de atención para tu crecimiento.</p>
                </div>
            </div>

            <a href="{{ route('login') }}" class="btn btn-main btn-lg px-5 rounded-pill">Ingresar al Sistema</a>
        </div>
    </section>

    {{-- CURVA DECORATIVA ——————————————————————————————————————— --}}
    <div class="wave" style="margin-top:-4px;">
        <svg viewBox="0 0 1440 320"><path fill="#00592d" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,224C384,224,480,256,576,245.3C672,235,768,181,864,181.3C960,181,1056,235,1152,250.7C1248,267,1344,245,1392,234.7L1440,224V0H0Z"></path></svg>
    </div>

    {{-- MÓDULOS DESTACADOS ———————————————————————————————————————— --}}
    <section style="max-width:1100px;margin:60px auto">
        <h3 class="text-center mb-5" style="color:var(--sena-green);font-weight:700;">¿Qué podrás hacer con este sistema?</h3>

        <div class="d-flex flex-wrap justify-content-center gap-4">
            {{-- Asistencia --}}
            <div class="card zoom border-0" style="min-width:280px;">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-clipboard-check me-1"></i> Control de Asistencia
                </div>
                <div class="card-body">
                    <p class="card-text small mb-0">
                        Registra diariamente tu permanencia en el internado y cumple con los requisitos de asistencia establecidos.
                    </p>
                </div>
            </div>

            {{-- Horas de contraprestación --}}
            <div class="card zoom border-0" style="min-width:280px;">
                <div class="card-header text-dark" style="background:var(--sena-accent);">
                    <i class="fas fa-hourglass-half me-1"></i> Horas de Contraprestación
                </div>
                <div class="card-body">
                    <p class="card-text small mb-0">
                        Registra tus actividades de apoyo y revisa en tiempo real las horas acumuladas hasta llegar a las 40 u 80 requeridas.
                    </p>
                </div>
            </div>

            {{-- Llamados de atención --}}
            <div class="card zoom border-0" style="min-width:280px;">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-exclamation-triangle me-1"></i> Llamados de Atención
                </div>
                <div class="card-body">
                    <p class="card-text small mb-0">
                        Consulta fácilmente tu historial disciplinario y mantente al tanto de tus compromisos de mejora.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
