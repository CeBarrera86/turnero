@extends('layouts.app', ['activePage' => 'sectores', 'titlePage' => __('Sector')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('sectores.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear') }}</h4>
                                <p class="card-category">{{ __('Registrar Información del Sector') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Letra --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Letra') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('letra') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('letra') ? ' is-invalid' : '' }}"
                                                name="letra" id="input-letra" type="text"
                                                placeholder="{{ __('Ingrese Letra...') }}" value="{{ old('letra') }}"
                                                required="true" aria-required="true" autofocus />
                                            @if ($errors->has('letra'))
                                                <span id="letra-error" class="error text-danger"
                                                    for="input-letra">{{ $errors->first('letra') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Nombre --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                                name="nombre" id="input-nombre" type="text"
                                                placeholder="{{ __('Ingrese Nombre...') }}" value="{{ old('nombre') }}"
                                                required="true" aria-required="true" autofocus />
                                            @if ($errors->has('nombre'))
                                                <span id="nombre-error" class="error text-danger"
                                                    for="input-nombre">{{ $errors->first('nombre') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Descripción --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Descripción') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                                name="descripcion" id="input-descripcion" type="text"
                                                placeholder="{{ __('Ingrese Descripcion...') }}"
                                                value="{{ old('descripcion') }}" required="true" aria-required="true" />
                                            @if ($errors->has('descripcion'))
                                                <span id="descripcion-error" class="error text-danger"
                                                    for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Registro --}}
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear') }}</button>
                                <a href="{{ route('sectores.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
