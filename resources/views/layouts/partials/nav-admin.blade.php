<!-- Menú para rol ADMIN -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-calendar"></i> Asistencias</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.asistencia.create') }}"><i class="ti ti-pencil"></i> Tomar Asistencia</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.asistencia.index') }}"><i class="ti ti-history"></i> Historial</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-users"></i> Aprendices</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.aprendices.create') }}"><i class="ti ti-user-plus"></i> Añadir</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.aprendices.index') }}"><i class="ti ti-user"></i> Lista</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-clock"></i> Contraprestaciones</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.contra_prestacion.create') }}"><i class="ti ti-plus"></i> Añadir Horas</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.contra_prestacion.index') }}"><i class="ti ti-history"></i> Historial</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-alert-circle"></i> Llamados</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.atencion.create') }}"><i class="ti ti-plus"></i> Nuevo</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.atencion.index') }}"><i class="ti ti-history"></i> Historial</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-book"></i> Programas</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.programa.create') }}"><i class="ti ti-plus"></i> Añadir</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.programa.index') }}"><i class="ti ti-list"></i> Lista</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-user-shield"></i> Admins</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.register_admin') }}"><i class="ti ti-user-plus"></i> Crear Admin</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-school"></i> Permisos</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.aprendices.request.index_admin') }}"><i class="ti ti-history"></i> Solicitudes</a></li>
    </ul>
</li>
