@extends('layouts.app', ['activePage' => 'usuarios', 'titlePage' => __('Atención al Público')])

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
        const sector = 2; // Sector Cajas
        const urlVerificarDisponibles = @json(route('ticket.verificarDisponibles'));
        const urlVerificarDerivados = @json(route('ticket.verificarDerivados'));
        const urlCheckTurno = @json(route('turno.checkTurno'));
        const urlLlamarTicket = @json(route('turno.store'));
        const urlEliminarTicket = @json(route('ticket.update', 'id'));
        const urlUpdateTurno = @json(route('turno.update', 'id'));
    </script>

    <script type="text/javascript" src="{{ asset('js/secciones/seccionesConsultas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/secciones/botones.js') }}"></script>
@endpush
