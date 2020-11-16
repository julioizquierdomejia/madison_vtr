<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/perfil">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="img-profile rounded-circle" src="/online/img/undraw_profile.svg" width="30">
        </div>
        <div class="sidebar-brand-text mx-3 d-flex text-left">
            <span class="mr-2 d-none d-lg-block small">Douglas <br>McGee</span>
            <i class="fas fa-fw fa-cog"></i>
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Rituales</span>
        </a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item{{request()->segment(1) == 'rituales' ? ' active' : '' }}">
        <a class="nav-link" href="/rituales">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Rituales</span>
        </a>
    </li>

    <li class="nav-item{{request()->segment(1) == 'videos' ? ' active' : '' }}">
        <a class="nav-link" href="/videos">
            <i class="fas fa-fw fa-play"></i>
            <span>Vídeos</span>
        </a>
    </li>

    <li class="nav-item{{request()->segment(1) == 'resumen' ? ' active' : '' }}">
        <a class="nav-link" href="/resumen">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Resumen</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item{{request()->segment(1) == 'soporte' ? ' active' : '' }}">
        <a class="nav-link" href="soporte">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>Soporte</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>