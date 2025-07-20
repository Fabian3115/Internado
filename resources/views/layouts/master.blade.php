<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Desplazamiento</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link href="https://unpkg.com/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet">


    <style>
        :root {
            --verde-sena: #39A900;
            --gris-fondo: #f9fafb;
            --hover-light: #e9f5eb;
        }

        body {
            background: var(--gris-fondo);
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            padding: 0.8rem 1rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand img {
            height: 35px;
        }

        .nav-link {
            color: #333;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-link i {
            font-size: 18px;
        }

        .nav-link:hover {
            background: var(--hover-light);
            color: var(--verde-sena);
        }

        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-menu a:hover {
            background: var(--hover-light);
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--verde-sena);
        }

        footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- ✅ Navbar Superior con Dropdowns -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo_sena.png') }}" alt="Logo">
                INTERNADO
            </a>

            <!-- Botón responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    @if (Auth::user()->role === 'admin')
                        <!-- Asistencias -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-calendar"></i> Asistencias</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.asistencia.create') }}"><i
                                            class="ti ti-pencil"></i> Tomar Asistencia</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.asistencia.index') }}"><i
                                            class="ti ti-history"></i> Historial</a></li>
                            </ul>
                        </li>

                        <!-- Aprendices -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-users"></i> Aprendices</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.aprendices.create') }}"><i
                                            class="ti ti-user-plus"></i> Añadir Aprendiz</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.aprendices.index') }}"><i
                                            class="ti ti-user"></i> Lista de Aprendices</a></li>
                            </ul>
                        </li>

                        <!-- Contra Prestaciones -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-clock"></i> Contra Prestaciones</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.contra_prestacion.create') }}"><i
                                            class="ti ti-plus"></i> Añadir Horas</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.contra_prestacion.index') }}"><i class="ti ti-history"></i> Historial</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Llamados de Atención -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-alert-circle"></i> Llamados de Atención</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.atencion.create') }}"><i
                                            class="ti ti-plus"></i> Añadir Llamado</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.atencion.index') }}"><i
                                            class="ti ti-list-details"></i> Lista de Llamados</a></li>
                            </ul>
                        </li>

                        <!-- Programas de Formación -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-book"></i> Programas</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.programa.create') }}"><i
                                            class="ti ti-plus"></i> Añadir Programa</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.programa.index') }}"><i
                                            class="ti ti-list"></i> Lista de Programas</a></li>
                            </ul>
                        </li>

                        <!-- Administradores -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-user-shield"></i> Administradores</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="ti ti-user-plus"></i> Crear
                                        Administrador</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti ti-users"></i> Lista de
                                        Administradores</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role === 'aprendiz')
                        <!-- Aprendiz Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                    class="ti ti-school"></i> Mis Opciones</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('aprendiz.asistencia.index') }}"><i
                                            class="ti ti-calendar"></i> Mis Asistencias</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('aprendiz.contra_prestacion.index') }}"><i
                                            class="ti ti-clock"></i> Mis Horas</a></li>
                                <li><a class="dropdown-item" href="{{ route('aprendiz.atencion.index') }}"><i
                                            class="ti ti-alert-circle"></i> Mis Llamados</a></li>
                            </ul>
                        </li>
                    @endif
                    @auth
                        {{-- ✅ Botón Cerrar Sesión --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn-logout"><i class="ti ti-logout"></i> Cerrar sesión</button>
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Contenido -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- ✅ Footer -->
    <footer>
        <strong>© 2025 INTERNADO - SENA | Ficha 2847386</strong>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
