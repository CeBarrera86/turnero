@extends('layouts.app_totem', ['activePage' => 'totem', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container col-md-12">
            <div class="card card-chart">
                <div class="card-header card-header-primary d-flex align-items-center justify-content-center">
                    <span id="clienteTitular" class="font-weight-bold" style="font-size: xx-large">
                        {{ $cliente->titular }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="d-flex" id="tareasButtons">
                        @foreach ($tareasPorSector as $sector => $tareas)
                            <div class="sector-container col-md-6 d-flex flex-column">
                                @foreach ($tareas as $tarea)
                                    <button id="{{ $tarea->id }}" class="alert-option-tareas alert-success turno-button"
                                        data-cli-id="{{ $cliente->id }}" data-sec-id="{{ $sector }}">
                                        <div class="text-center font-weight-bold" style="font-size: 33px;">
                                            {{ $tarea->descripcion }}</div>
                                    </button>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center col-md-3 mx-auto mt-3">
                        <form id="volverForm" action="{{ route('totem.index') }}">
                            <button type="submit" class="btn btn-danger">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            const urlTotemStore = @json(route('totem.store'));
            const urlTotemIndex = @json(route('totem.index'));
            document.getElementById('volverForm').addEventListener('submit', function() {
                localStorage.clear();
            });
        </script>
        <script type="module" src="{{ asset('js/totem/inicio.js') }}"></script>
    @endpush
@endsection
