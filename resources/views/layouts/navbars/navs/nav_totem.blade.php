<!-- Navbar -->
<nav class="navbar bg-dark fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper logo col-md-3">
            <span class="navbar-brand">
                <a href="{{ route('totem.index') }}">
                    <img style="width: 50%" src="{{ asset('img/Corpico_logo.svg') }}" title="Corpico_logo">
                </a>
            </span>
        </div>
        <div class="navbar-wrapper col-md-3 justify-content-center">
            <span class="navbar-brand">
                <strong>{{ $titlePage }}</strong>
            </span>
        </div>
        <div class="navbar-wrapper col-md-3 justify-content-end">
            <span class="navbar-brand">
                <strong>
                    <div id="time"></div>
                </strong>
            </span>
        </div>
    </div>
</nav>
