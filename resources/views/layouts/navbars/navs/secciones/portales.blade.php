<li class="nav-item{{ $activePage == $page ? ' active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">
        <i class="material-icons">{{ $icon }}</i>
        <p>{{ __($text) }}</p>
    </a>
</li>
