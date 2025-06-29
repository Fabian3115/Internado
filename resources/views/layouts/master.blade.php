<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo_sena.png') }}" type="image/x-icon">
    <title>Gestion de Desplzamiento de Funcionario</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Css Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/layouts/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('/images/Contacto/images.png') }}" alt="AdminLTELogo"
                height="100" width="150">
        </div>
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @auth
                    <div class="dropdown" id="userDropdownContainer" style="margin-left: auto; margin-right: 30px;">
                        <button class="dropdown-toggle" onclick="toggleDropdown()">👤 {{ Auth::user()->nickname }}</button>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-lock"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('/images/logo_sena.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">INTERNADO</span>
            </a>
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="{{ asset('images/profile_photos/Mamacita.jpg') }}" alt="Foto de {{ Auth::user()->nickname }}"
                            class="img-circle elevation-2" style="object-fit: cover; width: 35px; height: 35px;">
                    </div>

                    <div class="info">
                        <a href="#" class="d-block">
                            {{ Auth::user()->nickname }}
                        </a>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!--Aqui va la ruta para la vista del Admin-->
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-file-signature"></i>&nbsp;
                                    <p>
                                        Asistencias
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.asistencia.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Tomar la Asistencia</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.asistencia.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de Asistencia</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Aprendices
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.aprendices.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Añadir información del Aprendiz</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.aprendices.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de Aprendices</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Contra Prestaciones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.contra_prestacion.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Añadir horas al Aprendiz</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.contra_prestacion.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista horas de los Aprendices</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Llamados de Atención
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.atencion.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Añadir llamado de atención al Aprendiz</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.atencion.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de llamados de atención de los Aprendices</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Porcentaje de Beneficio
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.beneficio.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Añadir porcentaje de beneficio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.beneficio.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de Porcentaje de Beneficio</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Programas de Formación
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.programa.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                            <p>Añadir programa de formación</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.programa.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de programas de formación</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!--Aqui va la ruta para la vista del Aprendiz-->
                        @if (Auth::user()->role === 'aprendiz')
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-file-signature"></i>&nbsp;
                                    <p>
                                        Asistencias
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('aprendiz.atencion.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Listado de Asistencia del aprendiz</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Contra Prestaciones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('aprendiz.contra_prestacion.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Listado de horas del aprendiz</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>&nbsp;
                                    <p>
                                        Llamados de Atención
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('aprendiz.atencion.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>Lista de llamados de atención de al Aprendiz</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <footer class="main-footer"
            style="width: 100%; position: fixed; bottom: 0; left: 0; background-color: #343a40; color: white; padding: 10px 20px;">
            <strong>Copyright © 2023-2025
                <a href="#" style="color: #3c8dbc;">INTERNADO</a>.
            </strong>
            <strong>Aprendices SENA de la Tecnología de Desarrollo de Software
                <a href="#" style="color: #D2160DFF;">Ficha: 2847386.</a>.
            </strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo -->
    <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("userDropdownContainer");
            dropdown.classList.toggle("show");
        }

        // Cerrar el dropdown si se hace clic fuera
        window.addEventListener("click", function(e) {
            if (!document.getElementById("userDropdownContainer").contains(e.target)) {
                document.getElementById("userDropdownContainer").classList.remove("show");
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll(".nav-sidebar .nav-link");
            links.forEach(link => {
                link.addEventListener("mouseover", () => link.style.transform = "scale(1.02)");
                link.addEventListener("mouseout", () => link.style.transform = "scale(1)");
            });
        });
    </script>

</body>

</html>
