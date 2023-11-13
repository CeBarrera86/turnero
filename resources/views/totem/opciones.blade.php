@extends('layouts.app_totem', ['activePage' => 'totem', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-primary">
                            <span>
                                <h2>
                                    <strong>
                                        Bienvenido/a
                                        <br />
                                        {{ $cliente->titular }}
                                    </strong>
                                </h2>
                            </span>
                        </div>
                        <div class="card-body">
                            <p class="card-category">
                                DESEO SACAR TURNO PARA:
                            </p>
                            @foreach ($sectores as $sector)
                                <form action="{{ route('totem.store') }}" method="post" class="mt-2">
                                    @csrf
                                    <input type="hidden" value="{{ $cliente->id }}" name="cli_id" id="cli_id">
                                    <input type="hidden" value="{{ $sector->id }}" name="sec_id" id="sec_id">
                                    <button type="submit" class="alert-option alert-success" rel="tooltip"
                                        style="width: 100%;">
                                        <div class="row">
                                            <div class="text-left col-sm-6 font-weight-bold" style="font-size: 19px;">
                                                {{ $sector->nombre }}
                                            </div>
                                            <div class="text-right col-sm-6" style="font-size: 17px;">
                                                {{ $sector->descripcion }}
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
