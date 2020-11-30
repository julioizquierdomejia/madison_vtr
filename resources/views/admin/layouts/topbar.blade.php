<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-black topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 text-white">
        <i class="fa fa-bars" style="color: #fff;"></i>
    </button>
    <div class="d-flex align-items-center">
        <!--i class="fas fa-fw fa-industry fa-2x"></i-->
        <div class="brand-name pl-3">
            <span class="text-bigger mb-0 h4 d-block name_client">MADISON</span>
            <!--span class="text">{{date('d-m-Y')}}</span-->
        </div>
    </div>

    <ul class="navbar-nav ml-auto mr-4">
      
      <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>-->
                    {{ Auth::user()->name }} <!--<span class="caret"></span>-->
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>
        @endguest


    </ul>


    <!--div class="d-flex flex-row align-items-center ml-auto mr-4">
        <i class="fas fa-fw fa-cog fa-2x"></i>
        <div class="plan-name pl-2 text-right">
            <span class="text-bigger d-block">plan</span>
            <h5 class="mb-0 text"><strong>Medium</strong></h5>
        </div>
    </div-->
</nav>
<!-- End of Topbar -->

