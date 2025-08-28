<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">ADMIN PANEL</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Addons</div>

    <li class="nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-fw fa-table"></i><span>Brands</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-fw fa-tasks"></i><span>Products</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.certificates.index') }}">
            <i class="fas fa-fw fa-certificate"></i><span>Certificates</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
