@php
    $photo = Auth::user()->info ? Auth::user()->info->photo : '';
    $role = Auth::user()->roles->first()->name;
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand pt-0" href="/perfil">
        <div class="sidebar-brand-icon rotate-n-15">
            @if ($photo)
                <img class="img-profile rounded-circle" src="{{ asset('uploads/photos') }}/{{Auth::user()->id.'/'.$photo}}" width="50">
            @else
            <img class="img-profile rounded-circle" src="/online/img/undraw_profile.svg" width="50">
            @endif
        </div>
        <div class="sidebar-brand-text mx-3 pt-3">
            <span class="mr-2 d-inline-block small align-middle" title="{{auth()->user()->email}}">{{auth()->user()->name}} <br>{{auth()->user()->email}}</span>
            <i class="fas fa-fw fa-cog align-middle"></i>
        </div>
    </a>

    @if($role == 'admin' || $role == 'superadmin')
        <li class="nav-item{{request()->segment(1) == 'clientes' ? ' active' : '' }}">
            <a class="nav-link" href="/clientes" style="border-left: {{request()->segment(1) == 'clientes' ? ' 4px solid #FBB911' : '0' }}">
                <i class="fas fa-user-friends"style="color: #FBB911" ></i>
                <span>{{$role == 'admin' ? 'USUARIOS' : 'CLIENTES'}}</span>
            </a>
        </li>
        {{-- <li class="nav-item{{request()->segment(1) == 'planes' ? ' active' : '' }}">
            <a class="nav-link" href="/planes">
                <i class="fas fa-tags" style="color: #E72E7A"></i>
                <span>PLANES</span>
            </a>
        </li> --}}
<<<<<<< HEAD
        <li class="nav-item{{request()->segment(1) == 'videos' ? ' active' : '' }}">
            <a class="nav-link" href="/videos">
                <i class="fas fa-fw fa-play" style="color: #E72E7A"></i>
                <span>VÍDEOS</span>
            </a>
        </li>
        <li class="nav-item{{request()->segment(1) == 'objetivos' ? ' active' : '' }}">
            <a class="nav-link" href="/objetivos">
                <i class="fas fa-bullseye" style="color: #6666FF"></i>
                <span>OBJETIVOS</span>
            </a>
        </li>
    @endif

    @if($role == 'admin')
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
=======
>>>>>>> 97c1e7ced1cea5951c1bf2848ccb64acd04e2c4c
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item{{request()->segment(1) == 'rituales' ? ' active' : '' }}">
        <a class="nav-link" href="/rituales" style="border-left: {{request()->segment(1) == 'rituales' ? ' 4px solid #FBB911' : '0' }}">
            <i class="fas fa-fw fa-check-circle" style="color: #FBB911"></i>
            <span>RITUALES</span>
        </a>
    </li>

    <li class="nav-item{{request()->segment(1) == 'videos' ? ' active' : '' }}">
        <a class="nav-link" href="/videos" style="border-left: {{request()->segment(1) == 'videos' ? ' 4px solid #E72E7A' : '0' }}">
            <i class="fas fa-fw fa-play" style="color: #E72E7A"></i>
            <span>VÍDEOS</span>
        </a>
    </li>
    <li class="nav-item{{request()->segment(1) == 'resumen' ? ' active' : '' }}">
        <a class="nav-link" href="/resumen" style="border-left: {{request()->segment(1) == 'resumen' ? ' 4px solid #E54C16' : '0' }}">
            <i class="fas fa-fw fa-chart-area" style="color: #E54C16"></i>
            <span>RESUMEN</span></a>
    </li>

    <li class="nav-item{{request()->segment(1) == 'soporte' ? ' active' : '' }}">
        <a class="nav-link" href="soporte" style="border-left: {{request()->segment(1) == 'soporte' ? ' 4px solid #39B8BC' : '0' }}">
            <i class="fas fa-fw fa-question-circle" style="color: #39B8BC"></i>
            <span>SOPORTE</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>