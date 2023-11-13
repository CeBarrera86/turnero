@extends('layouts.app', ['activePage' => 'mostradores', 'titlePage' => __('Mostrador')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('mostradores.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear') }}</h4>
                                <p class="card-category">{{ __('Registrar Información del Mostrador') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Número --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Numero') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('numero') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}"
                                                name="numero" id="input-numero" type="text"
                                                placeholder="{{ __('Ingrese número...') }}" value="{{ old('numero') }}"
                                                required="true" aria-required="true" autofocus />
                                            @if ($errors->has('numero'))
                                                <span id="numero-error" class="error text-danger"
                                                    for="input-numero">{{ $errors->first('numero') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- IP --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('IP') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}"
                                                name="ip" id="input-ip" type="text"
                                                placeholder="{{ __('Ingrese IP...') }}" value="{{ old('ip') }}"
                                                required="true" aria-required="true" />
                                            @if ($errors->has('ip'))
                                                <span id="ip-error" class="error text-danger"
                                                    for="input-ip">{{ $errors->first('ip') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Alfa --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Alfa') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('alfa') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('alfa') ? ' is-invalid' : '' }}"
                                                name="alfa" id="input-alfa" type="text"
                                                placeholder="{{ __('Ingrese Alfa...') }}" value="{{ old('alfa') }}"
                                                required="true" aria-required="true" />
                                            @if ($errors->has('alfa'))
                                                <span id="alfa-error" class="error text-danger"
                                                    for="input-alfa">{{ $errors->first('alfa') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Tipo --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Tipo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}"
                                                name="tipo" id="input-tipo" type="text"
                                                placeholder="{{ __('Ingrese Tipo...') }}" value="{{ old('tipo') }}"
                                                required="true" aria-required="true" />
                                            @if ($errors->has('tipo'))
                                                <span id="tipo-error" class="error text-danger"
                                                    for="input-tipo">{{ $errors->first('tipo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Sector --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Sector') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('sector') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('sector') ? ' is-invalid' : '' }}"
                                                name="sector" id="input-sector" required="true" aria-required="true">
                                                <option value="">{{ __('Ingrese Sector...') }}</option>
                                                @foreach ($sectores as $sector)
                                                    <option value="{{ $sector->id }}">{{ $sector->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sector'))
                                                <span id="sector-error" class="error text-danger"
                                                    for="input-sector">{{ $errors->first('sector') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Registro --}}
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear') }}</button>
                                <a href="{{ route('mostradores.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
