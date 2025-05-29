@extends('layouts.app', ['activePage' => 'usuarios', 'titlePage' => __('Atención al Público')])

@section('search')
    @include('secciones.busqueda')
@endsection

@section('content')
    <div class="content">
        <div id="userData" data-user-data="{{ json_encode($userData) }}" style="display: none;"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    @include('secciones.card', [
                        'title' => 'Turno Solicitado',
                        'id' => 'solicitado',
                        'footer' => 'solicitado',
                        'class' => 'text-center',
                    ])
                </div>
                <div class="col-md-4">
                    @include('secciones.card', [
                        'title' => 'Disponibles',
                        'id' => 'disponibles',
                        'tableId' => 'disponibles',
                    ])
                </div>
                <div class="col-md-4">
                    @include('secciones.card', [
                        'title' => 'Derivados',
                        'id' => 'derivados',
                        'tableId' => 'derivados',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const userData = JSON.parse(document.getElementById('userData').getAttribute('data-user-data'));
        const username = {!! json_encode(Auth::user()->username) !!};
        const urlVerificarDisponibles = @json(route('ticket.verificarDisponibles'));
        const urlVerificarDerivados = @json(route('ticket.verificarDerivados'));
        const urlUpdateTicket = @json(route('ticket.update', 'id'));
        const urlSearchTicket = @json(route('ticket.searchTicket'));
        const urlVerificarSolicitado = @json(route('turno.verificarSolicitado'));
        const urlAtenderTicket = @json(route('turno.store'));
        const urlUpdateTurno = @json(route('turno.update', 'id'));
        const urlUsuariosSector = @json(route('turno.usuarios'));
    </script>
    <script type="module" src="{{ asset('js/secciones/main.js') }}"></script>
@endpush
