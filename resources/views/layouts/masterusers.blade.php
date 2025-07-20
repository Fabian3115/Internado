<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Convivencia - Internado</title>
    <link rel="shortcut icon" href="{{ asset('images/logo_sena.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{asset('css/layouts/masterusers.css')}}">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar-custom">
        <div class="logo">
            <img src="{{ asset('images/logo_sena.png') }}" alt="Logo SENA">
        </div>
        <div class="toggle-menu" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        <ul class="menu m-0 p-0">
            <li><a href="{{ route('welcome') }}"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="{{ route('developers') }}"><i class="fas fa-code"></i>Desarrolladores</a></li>
            <li><a href="{{route('tecnologias')}}"><i class="fas fa-info-circle"></i> Sobre el software</a></li>
            @auth
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-user-shield"></i> Admin</a></li>
                @elseif(auth()->user()->role === 'aprendiz')
                    <li><a href="{{ route('aprendiz.dashboard') }}"><i class="fas fa-user-graduate"></i> Aprendiz</a></li>
                @endif
                <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            @else
                <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
            @endauth
        </ul>
    </nav>

    <!-- CONTENIDO -->
    <div class="content-wrapper">
        <div class="container">
            @yield('contenido')
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer-custom">
        <p>&copy; 2023-2025 <a href="#">Internado</a> | Aprendices SENA ADSO - <a href="#">Ficha 2847386</a></p>
        <div class="footer-social">
            <a href="https://www.facebook.com/torres3115"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
        </div>
    </footer>

    <!-- Script -->
    <script>
        function toggleMenu() {
            document.querySelector('.menu').classList.toggle('active');
        }
    </script>
</body>
</html>
