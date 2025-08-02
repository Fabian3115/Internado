<!-- Menú para rol APRENDIZ -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-school"></i> Mis Opciones</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('aprendiz.asistencia.index') }}"><i class="ti ti-calendar"></i> Mis Asistencias</a></li>
        <li><a class="dropdown-item" href="{{ route('aprendiz.contra_prestacion.index') }}"><i class="ti ti-clock"></i> Mis Horas</a></li>
        <li><a class="dropdown-item" href="{{ route('aprendiz.atencion.index') }}"><i class="ti ti-alert-circle"></i> Mis Llamados</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="ti ti-school"></i> Permisos</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('aprendiz.request.create') }}"><i class="ti ti-pencil"></i> Crear Permiso</a></li>
        <li><a class="dropdown-item" href="{{ route('aprendiz.request.index') }}"><i class="ti ti-history"></i> Historial</a></li>
    </ul>
</li>
