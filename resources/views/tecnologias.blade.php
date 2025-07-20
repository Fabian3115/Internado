@extends('layouts.masterusers')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/tecnologias.css') }}">
@endpush

@section('contenido')
<section class="tools-section">
    <div class="container text-center">
        <h1 class="section-title">Tecnologías Utilizadas</h1>
        <p class="section-subtitle">Este sistema fue desarrollado combinando herramientas modernas para ofrecerte la mejor experiencia.</p>

        <div class="row g-4 justify-content-center">
            <!-- Laravel -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/laravel.png') }}" alt="Laravel" class="tool-img">
                    <h5>Laravel</h5>
                    <p>Framework backend potente para construir aplicaciones web seguras y escalables.</p>
                </div>
            </div>
            <!-- MySQL -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/mysql.png') }}" alt="MySQL" class="tool-img">
                    <h5>MySQL</h5>
                    <p>Base de datos relacional para almacenar toda la información del sistema de forma eficiente.</p>
                </div>
            </div>
            <!-- Bootstrap -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/bootstrap.png') }}" alt="Bootstrap" class="tool-img">
                    <h5>Bootstrap</h5>
                    <p>Framework CSS que aporta diseño responsive y componentes modernos.</p>
                </div>
            </div>
            <!-- JavaScript -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/javascript.png') }}" alt="JavaScript" class="tool-img">
                    <h5>JavaScript</h5>
                    <p>Interactividad en tiempo real para una mejor experiencia del usuario.</p>
                </div>
            </div>
            <!-- Animate.css -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/animate.png') }}" alt="Animate.css" class="tool-img">
                    <h5>Animate.css</h5>
                    <p>Animaciones suaves y atractivas para hacer la interfaz más dinámica.</p>
                </div>
            </div>
            <!-- Font Awesome -->
            <div class="col-md-4">
                <div class="tool-card">
                    <img src="{{ asset('images/tecnologias/fontawesome.png') }}" alt="Font Awesome" class="tool-img">
                    <h5>Font Awesome</h5>
                    <p>Íconos elegantes y fáciles de usar para una interfaz clara y funcional.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
