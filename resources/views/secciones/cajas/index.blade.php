@extends('layouts.app', ['activePage' => 'cajas', 'titlePage' => __('Atención al Público')])

@section('search')
    @include('secciones.busqueda')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('secciones.secciones')
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var username = {!! json_encode(Auth::user()->username) !!};
        const sector = 1; // Sector Cajas
        const urlVerificarDisponibles = @json(route('ticket.verificarDisponibles'));
        const urlVerificarDerivados = @json(route('ticket.verificarDerivados'));
        const urlEliminarTicket = @json(route('ticket.update', 'id'));
        const urlSearchTicket = @json(route('ticket.searchTicket'));
        const urlCheckTurno = @json(route('turno.checkTurno'));
        const urlLlamarTicket = @json(route('turno.store'));
        const urlUpdateTurno = @json(route('turno.update', 'id'));
    </script>

    <script type="text/javascript" src="{{ asset('js/secciones/eventos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/secciones/seccionesConsultas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/secciones/botones.js') }}"></script>
@endpush
