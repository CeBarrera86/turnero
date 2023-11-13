<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <span class="navbar-brand" href="#">{{ $titlePage }}</span>
        </div>
        <div class="collapse navbar-collapse justify-content-end">
            @yield('search')
            <ul class="navbar-nav">
                <li class="ml-5">Hola {{ Auth::user()->name }}</li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Cuenta') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

