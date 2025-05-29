<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            <i><img style="width:150px" src="{{ asset('img/Corpico_logo.svg') }}" title="Corpico_logo"></i>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if (in_array(Auth::user()->role, [1, 3, 4]) || (Auth::user()->role == 2 && Auth::user()->username == 'agonzalez'))
                <li class="nav-item {{ $activePage == 'secciones' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#secciones" aria-expanded="true">
                        <i class="material-icons">apps</i>
                        <p>{{ __('Secciones') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="secciones">
                        <ul class="nav">
                            @unless (Auth::user()->role == 4)
                                @include('layouts.navbars.navs.secciones.items', [
                                    'route' => 'cajas.index',
                                    'page' => 'cajas',
                                    'text' => 'Cajas',
                                    'icon' => 'SC',
                                ])
                                @include('layouts.navbars.navs.secciones.items', [
                                    'route' => 'usuarios.index',
                                    'page' => 'usuarios',
                                    'text' => 'Usuarios',
                                    'icon' => 'SU',
                                ])
                                @include('layouts.navbars.navs.secciones.items', [
                                    'route' => 'reclamos.index',
                                    'page' => 'reclamos',
                                    'text' => 'Reclamos',
                                    'icon' => 'SR',
                                ])
                            @else
                                @switch(Auth::user()->puestos->mostradores->sector)
                                    @case('1')
                                        @include('layouts.navbars.navs.secciones.items', [
                                            'route' => 'cajas.index',
                                            'page' => 'cajas',
                                            'text' => 'Cajas',
                                            'icon' => 'SC',
                                        ])
                                    @break

                                    @case('2')
                                        @include('layouts.navbars.navs.secciones.items', [
                                            'route' => 'usuarios.index',
                                            'page' => 'usuarios',
                                            'text' => 'Usuarios',
                                            'icon' => 'SU',
                                        ])
                                    @break

                                    @case('3')
                                        @include('layouts.navbars.navs.secciones.items', [
                                            'route' => 'reclamos.index',
                                            'page' => 'reclamos',
                                            'text' => 'Reclamos',
                                            'icon' => 'SR',
                                        ])
                                    @break

                                    @default
                                        @include('layouts.navbars.navs.secciones.items', [
                                            'route' => 'home',
                                            'page' => 'home',
                                            'text' => 'HOME',
                                        ])
                                @endswitch
                            @endunless
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->role == 1)
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'estados.index',
                    'page' => 'estados',
                    'text' => 'Estados',
                    'icon' => 'bubble_chart',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'mostradores.index',
                    'page' => 'mostradores',
                    'text' => 'Mostradores',
                    'icon' => 'dashboard',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'publicidades.index',
                    'page' => 'publicidades',
                    'text' => 'Publicidades',
                    'icon' => 'tv_guide',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'roles.index',
                    'page' => 'roles',
                    'text' => 'Roles',
                    'icon' => 'content_paste',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'sectores.index',
                    'page' => 'sectores',
                    'text' => 'Sectores',
                    'icon' => 'location_ons',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'tareas.index',
                    'page' => 'tareas',
                    'text' => 'Tareas',
                    'icon' => 'task',
                ])
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'users.index',
                    'page' => 'users',
                    'text' => 'Usuarios',
                    'icon' => 'group',
                ])
            @endif
            @if (Auth::user()->role == 2 && Auth::user()->username == 'falvarez')
                @include('layouts.navbars.navs.secciones.portales', [
                    'route' => 'publicidades.index',
                    'page' => 'publicidades',
                    'text' => 'Publicidades',
                    'icon' => 'tv_guide',
                ])
            @endif
        </ul>
    </div>
</div>
