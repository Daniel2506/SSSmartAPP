<ul class="sidebar-menu">
    <li class="header">Menú de navegación</li>

    <li class="{{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li class="{{ Request::segment(1) == 'bitacoras' ? 'active' : '' }}">
        <a href="{{ route('bitacoras.index') }}"><i class="fa fa-hand-lizard-o"></i> <span>Bitácoras</span></a>
    </li>

    <li class="{{ Request::segment(1) == 'facturas' ? 'active' : '' }}">
        <a href="{{ route('facturas.index') }}"><i class="fa fa-pencil-square-o"></i> <span>Facturas</span></a>
    </li>

    <li class="{{ Request::segment(1) == 'maquinas' ? 'active' : '' }}">
        <a href="{{ route('maquinas.index') }}"><i class="fa fa-cogs"></i><span> Máquinas</span> </a>
    </li>

    <li class="{{ Request::segment(1) == 'usuarios' ? 'active' : '' }}">
        <a href="{{ route('usuarios.index') }}"><i class="fa fa-users"></i> <span>Usuarios</span></a>
    </li>

    <li class="{{ Request::segment(1) == 'roles' ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}"><i class="fa fa-address-card-o"></i><span>Roles </span></a>
    </li>

    {{-- Reports --}}
    <li class="treeview {{ in_array(Request::segment(1), ['resumengeneral']) ? 'active' : '' }}">

        <a href="#"><i class="fa fa-bar-chart-o"></i> <span>Reportes</span><i class="fa fa-angle-left pull-right"></i></a>

        <ul class="treeview-menu">
            <li class="{{ Request::segment(1) == 'resumengeneral' ? 'active' : '' }}">
                <a href="{{ route('resumengeneral.index') }}"><i class="fa fa-circle-o"></i> Resumen general</a>
            </li>
        </ul>
    </li>
</ul>
