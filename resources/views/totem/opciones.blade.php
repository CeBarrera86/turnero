@extends('layouts.app_totem', ['activePage' => 'totem', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container col-md-7">
            <div class="row">
                <div class="card card-chart">
                    <div class="card-header card-header-primary d-flex align-items-center justify-content-center">
                        <span class="font-weight-bold" style="font-size: xx-large"> Bienvenido/a </br></br>
                            <span id="clienteTitular"></span>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-category">DESEO SACAR TURNO PARA:</p>
                        <div class="d-flex" id="sectoresButtons">
                            @foreach ($sectores as $sector)
                                <button class="alert-option alert-success turno-button" style="flex: 0.5;"
                                    data-cli-id="{{ $cliente->id }}" data-sec-id="{{ $sector->id }}">
                                    <div class="sector-button">
                                        {{ $sector->nombre }}
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        <div class="text-center col-md-6 mx-auto mt-3">
                            <form id="volverForm" action="{{ route('totem.index') }}">
                                <button type="submit" class="btn btn-danger">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="swal-container"></div>
    @push('js')
        <script>
            const urlTotemStore = @json(route('totem.store'));
            const urlTotemIndex = @json(route('totem.index'));
            const urlTareasIndex = @json(route('totem.tareas'));
            document.getElementById('volverForm').addEventListener('submit', function() {
                localStorage.clear();
            });
        </script>
        <script type="module" src="{{ asset('js/totem/inicio.js') }}"></script>
    @endpush
@endsection
