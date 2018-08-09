<ul class="sidebar-menu">

    <li class="header">Menú de navegación</li>

    <li class="{{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span> Dashboard</span></a>
    </li>

    {{-- Administration --}}
    <li class="treeview {{ in_array(Request::segment(1), ['usuarios', 'roles']) ? 'active' : '' }}">
        <a href="#"><i class="fas fa-cogs"></i> <span> Administración</span> <i class="fas fa-angle-left pull-right"></i></a>

        <ul class="treeview-menu">
            <li class="{{ in_array(Request::segment(1), ['usuarios', 'roles']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fab fa-wpforms"></i> Módulos <i class="fas fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'usuarios' ? 'active' : '' }}">
                        <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> <span> Usuarios </span></a>
                    </li>

                    <li class="{{ Request::segment(1) == 'roles' ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}"><i class="fas fa-address-card"></i><span> Roles </span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    {{-- Machines--}}
    <li class="{{ Request::segment(1) == 'maquinas' ? 'active' : '' }}">
        <a href="{{ route('maquinas.index') }}"><i class="fas fa-subway"></i><span> Máquinas</span> <i class="fas fa-angle-left pull-right"></i></a>
    </li>

    {{-- Tables --}}
    <li class="treeview {{ in_array(Request::segment(1), ['bitacoras', 'facturas', 'finalizados', 'monedas', 'monedascofres']) ? 'active' : '' }}">
        <a href="#"><i class="fas fa-receipt"></i> <span> Tablas </span> <i class="fas fa-angle-left pull-right"></i></a>

        <ul class="treeview-menu">
            <li class="{{ in_array(Request::segment(1), ['bitacoras', 'facturas', 'finalizados', 'monedas', 'monedascofres']) ? 'active' : '' }}">
                <a href="#"> <i class="fab fa-wpforms"></i> Módulos <i class="fas fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'bitacoras' ? 'active' : '' }}">
                        <a href="{{ route('bitacoras.index') }}"><i class="fas fa-hand-lizard"></i> <span> Bitácoras</span></a>
                    </li>

                    <li class="{{ Request::segment(1) == 'facturas' ? 'active' : '' }}">
                        <a href="{{ route('facturas.index') }}"><i class="fas fa-pen-square"></i> <span> Facturas</span></a>
                    </li>

                    <li class="{{ Request::segment(1) == 'finalizados' ? 'active' : '' }}">
                        <a href="{{ route('finalizados.index') }}"><i class="fas fa-infinity"></i> <span> Finalizados</span></a>
                    </li>

                    <li class="{{ Request::segment(1) == 'monedas' ? 'active' : '' }}">
                        <a href="{{ route('monedas.index') }}"><i class="fas fa-coins"></i><span> Monedas</span> </a>
                    </li>

                    <li class="{{ Request::segment(1) == 'monedascofres' ? 'active' : '' }}">
                        <a href="{{ route('monedascofres.index') }}"><i class="fas fa-briefcase"></i><span> Monedas cofre</span> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    {{-- Reports --}}
    <li class="treeview {{ in_array(Request::segment(1), ['resumengeneral']) ? 'active' : '' }}">

        <a href="#"><i class="far fa-chart-bar"></i> <span>Reportes</span><i class="fas fa-angle-left pull-right"></i></a>

        <ul class="treeview-menu">
            <li class="{{ Request::segment(1) == 'resumengeneral' ? 'active' : '' }}">
                <a href="{{ route('resumengeneral.index') }}"><i class="far fa-circle"></i> Resumen general</a>
            </li>
        </ul>
    </li>
</ul>
