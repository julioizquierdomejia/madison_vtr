


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand pt-0" href="/perfil">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="img-profile rounded-circle" src="/online/img/undraw_profile.svg" width="50">
        </div>
        <div class="sidebar-brand-text mx-3 pt-3">
            <span class="mr-2 d-inline-block small align-middle">{{auth()->user()->name}} <br>{{auth()->user()->email}}</span>
            <i class="fas fa-fw fa-cog align-middle"></i>
        </div>
    </a>

    @if(Auth::user()->roles->first()->name == 'superadmin')
        <li class="nav-item{{request()->segment(1) == 'clientes' ? ' active' : '' }}">
            <a class="nav-link" href="/clientes">
                <i class="fas fa-user-friends"style="color: #FBB911" ></i>
                <span>CLIENTES</span>
            </a>
        </li>
        <li class="nav-item{{request()->segment(1) == 'planes' ? ' active' : '' }}">
            <a class="nav-link" href="/planes">
                <i class="fas fa-tags" style="color: #E72E7A"></i>
                <span>PLANES</span>
            </a>
        </li>
    @endif

    @if(Auth::user()->roles->first()->name == 'admin')
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
                <i class="fas fa-fw fa-check-circle" style="color: #FBB911"></i>
                <span>RITUALES</span>
            </a>
        </li>

        <li class="nav-item{{request()->segment(1) == 'videos' ? ' active' : '' }}">
            <a class="nav-link" href="/videos">
                <i class="fas fa-fw fa-play" style="color: #E72E7A"></i>
                <span>VÍDEOS</span>
            </a>
        </li>

        <li class="nav-item{{request()->segment(1) == 'resumen' ? ' active' : '' }}">
            <a class="nav-link" href="/resumen">
                <i class="fas fa-fw fa-chart-area" style="color: #E54C16"></i>
                <span>RESUMEN</span></a>
        </li>

        <li class="nav-item{{request()->segment(1) == 'soporte' ? ' active' : '' }}">
            <a class="nav-link" href="soporte">
                <i class="fas fa-fw fa-question-circle" style="color: #39B8BC"></i>
                <span>SOPORTE</span></a>
        </li>
    @endif

    @if(Auth::user()->roles->first()->name == 'editor')
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
                <i class="fas fa-fw fa-check-circle" style="color: #FBB911"></i>
                <span>RITUALES</span>
            </a>
        </li>

        <li class="nav-item{{request()->segment(1) == 'videos' ? ' active' : '' }}">
            <a class="nav-link" href="/videos">
                <i class="fas fa-fw fa-play" style="color: #E72E7A"></i>
                <span>VÍDEOS</span>
            </a>
        </li>
    @endif

    @if(Auth::user()->roles->first()->name == 'editor')
    @endif


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>