 <!--- Sidemenu -->
 <ul class="metismenu side-nav">
    <li class="side-nav-title side-nav-item">Menú</li>

    <li class="side-nav-item">
        <a href="{{ route('dashboard') }}" class="side-nav-link">
            <i class="uil-home-alt"></i>
            <span> Inicio </span>
        </a>
    </li>


    @canany([ 'Interfaz productos','Interfaz caja', 'Interfaz clientes'])
    <li class="side-nav-title side-nav-item">Módulos</li>
    @endcanany


    <!--###########################-->
    <!--Inventario-->
    <!--###########################-->
    @canany(['Interfaz productos'])
    <li class="side-nav-item">

        <a href="javascript: void(0);" class="side-nav-link">
            <i class="uil-box"></i>
            <span> Almacen </span>
            <span class="menu-arrow"></span>
        </a>


        <ul class="side-nav-second-level" aria-expanded="false">

            @can('Interfaz productos')
            <li>
                <a href="{{ route('dashboard-products') }}">Productos</a>
            </li>
            @endcan

        </ul>
    </li>
    @endcanany
    <!--###########################-->
    <!--Ventas-->
    <!--###########################-->
    @canany(['Interfaz caja','Interfaz clientes'])
    <li class="side-nav-item">

        <a href="javascript: void(0);" class="side-nav-link">
            <i class="mdi mdi-coin"></i>
            <span> Ventas </span>
            <span class="menu-arrow"></span>
        </a>


        <ul class="side-nav-second-level" aria-expanded="false">
            @can('Interfaz caja')
            <li>
                <a href="{{ route('dashboard-billing') }}">Caja</a>
            </li>
            @endcan

            @can('Interfaz clientes')
            <li>
                <a href="{{ route('dashboard-clientes') }}">Clientes</a>
            </li>
            @endcan


        </ul>
    </li>
    @endcanany
    <!--###########################-->
    <!--Usuarios-->
    <!--###########################-->
    @canany(['Interfaz usuarios', 'Interfaz permisologia','Interfaz administracion'])
    <li class="side-nav-title side-nav-item">Administración</li>
    @endcanany
    @canany(['Interfaz usuarios', 'Interfaz permisologia'])
    <li class="side-nav-item">

            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-user"></i>
                <span> Usuarios </span>
                <span class="menu-arrow"></span>
            </a>


        <ul class="side-nav-second-level" aria-expanded="false">
            @can('Interfaz usuarios')
            <li>
                <a href="{{ route('dashboard-usuarios') }}">Usuarios</a>
            </li>
            @endcan
            @can('Interfaz permisologia')
            <li>
                <a href="{{ route('dashboard-permission') }}">Permisología</a>
            </li>
            @endcan

        </ul>
    </li>
    @endcanany

    <!--###########################-->
    <!--Administracion-->
    <!--###########################-->
    @can('Interfaz administracion')
    <li class="side-nav-item">

        <a href="{{ route('dashboard-administration') }}" class="side-nav-link">
            <i class="mdi mdi-cogs"></i>
            <span> Administración </span>

        </a>
    </li>
    @endcan

     <!--###########################-->
    <!--Reportes-->
    <!--###########################-->

    @canany(['Interfaz reportes'])
    <li class="side-nav-item">
        <a href="{{ route('dashboard-reports') }}" class="side-nav-link">
            <i class="mdi mdi-file-table-box-multiple-outline"></i>
            <span > Reportes </span>
        </a>
    </li>
    @endcanany













</ul>
