<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            <i><img style="width:150px" src="{{ asset('img/Corpico_logo.svg') }}" title="Corpico_logo"></i>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ $activePage == 'secciones' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#secciones" aria-expanded="true">
                    <i class="material-icons">apps</i>
                    <p>{{ __('Secciones') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="secciones">
                    <ul class="nav">
                        @if (Auth::user()->role != 4)
                            {{-- Si no es usuario --}}
                            <li class="nav-item{{ $activePage == 'cajas' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('cajas.index') }}">
                                    <span class="sidebar-mini"> SC </span>
                                    <span class="sidebar-normal">{{ __('Cajas') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'usuarios' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">
                                    <span class="sidebar-mini"> SU </span>
                                    <span class="sidebar-normal"> {{ __('Usuarios') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'reclamos' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('reclamos.index') }}">
                                    <span class="sidebar-mini"> SR </span>
                                    <span class="sidebar-normal"> {{ __('Reclamos') }} </span>
                                </a>
                            </li>
                        @else
                            @switch(Auth::user()->puestos->mostradores->sector)
                                @case('1')
                                    <li class="nav-item{{ $activePage == 'cajas' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('cajas.index') }}">
                                            <span class="sidebar-mini"> SC </span>
                                            <span class="sidebar-normal">{{ __('Cajas') }} </span>
                                        </a>
                                    </li>
                                @break

                                @case('2')
                                    <li class="nav-item{{ $activePage == 'usuarios' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('usuarios.index') }}">
                                            <span class="sidebar-mini"> SU </span>
                                            <span class="sidebar-normal"> {{ __('Usuarios') }} </span>
                                        </a>
                                    </li>
                                @break

                                @case('3')
                                    <li class="nav-item{{ $activePage == 'reclamos' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('reclamos.index') }}">
                                            <span class="sidebar-mini"> SR </span>
                                            <span class="sidebar-normal"> {{ __('Reclamos') }} </span>
                                        </a>
                                    </li>
                                @break

                                @default
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <span class="sidebar-normal">{{ __('HOME') }} </span>
                                    </a>
                            @endswitch
                        @endif
                    </ul>
                </div>
            </li>
            @if (Auth::user()->role == 1)
                <li class="nav-item{{ $activePage == 'estados' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('estados.index') }}">
                        <i class="material-icons">bubble_chart</i>
                        <p>{{ __('Estados') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'mostradores' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('mostradores.index') }}">
                        <i class="material-icons">dashboard</i>
                        <p>{{ __('Mostradores') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="material-icons">content_paste</i>
                        <p>{{ __('Roles') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'sectores' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('sectores.index') }}">
                        <i class="material-icons">location_ons</i>
                        <p>{{ __('Sectores') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="material-icons">group</i>
                        <p>{{ __('Usuarios') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
