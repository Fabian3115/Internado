<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Convicencia - Internado</title>
    <link rel="shortcut icon" href="{{ asset('images/logo_sena.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/masterusers.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul style="display: flex; list-style: none; margin: 0; padding: 0; width: 100%; align-items: center;">
            <div style="display: flex;">
                <div class="overlay">
                    <!-- Header de navegación -->
                    <div class="nav">
                        <div class="logo">
                            <img src="{{ asset('/images/logo_sena.png') }}" alt="Logo Internado SENA">
                        </div>
                        <div class="menu">
                            <a href="{{route('welcome')}}">Inicio</a>
                            <a href="{{route('developers')}}">Desarrolladores</a>
                            <a href="#">Sobre el software</a>
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <li style="margin-right: 20px;">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-user-shield"></i> Administrador
                                        </a>
                                    </li>
                                @elseif (auth()->user()->role === 'aprendiz')
                                    <li style="margin-right: 20px;">
                                        <a class="nav-link" href="{{ route('aprendiz.dashboard') }}">
                                            <i class="fas fa-user-shield"></i> Aprendiz
                                        </a>
                                    </li>
                                @endif
                                <div style="margin-left: auto;">
                                    <li style="margin-right: 20px;">
                                        <a class="nav-link" href="{{ route('logout') }}">
                                            <i class="fas fa-lock"></i> Cerrar Sesión
                                        </a>
                                    </li>
                                </div>
                            @else
                                <li style="margin-right: 20px;">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-home"></i> Inicio
                                    </a>
                                </li>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </nav>
    <!-- Main content -->
    <div class="content-wrapper" style="padding: 20px; margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('contenido')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer"
        style="width: 100%; position: fixed; bottom: 0; left: 0; background-color:  #287924FF; color: white; padding: 10px 20px;">
        <strong>Copyright © 2023-2025
            <a href="#" style="color: #DB0F0FFF;">INTERNADO</a>.
        </strong>
        <strong>Aprendices SENA de la Tecnología de Desarrollo de Software
            <a href="#" style="color: #000000FF;">Ficha: 2847386.</a>.
        </strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1
        </div>
    </footer>
