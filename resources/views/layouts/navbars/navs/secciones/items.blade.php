<li class="nav-item{{ $activePage == $page ? ' active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">
        <span class="sidebar-mini">{{ $icon }}</span>
        <span class="sidebar-normal">{{ __($text) }} </span>
    </a>
</li>
