<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Desplazamiento</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link href="https://unpkg.com/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet">
    <!-- CSS PERSONALIZADO-->
    <link rel="stylesheet" href="{{ asset('css/layouts/master.css') }}">

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2"
                href="https://oferta.senasofiaplus.edu.co/sofia-oferta/">
                <img src="{{ asset('images/logo_sena.png') }}" alt="Logo">
                <strong>INTERNADO</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    @if (Auth::user()->role === 'admin')
                        <!-- Menú admin -->
                        @include('layouts.partials.nav-admin')
                    @endif

                    @if (Auth::user()->role === 'aprendiz')
                        <!-- Menú aprendiz -->
                        @include('layouts.partials.nav-aprendiz')
                    @endif
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger">
                                    <i class="ti ti-logout"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1 container py-4 mt-4">
            @yield('content')
        </main>

        <footer class="mt-auto">
            <strong>© 2025 INTERNADO - SENA | Ficha 2847386</strong>
        </footer>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
