@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => __('Rol')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('roles.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear') }}</h4>
                                <p class="card-category">{{ __('Registrar Información del Rol') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Tipo --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Tipo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}"
                                                name="tipo" id="input-tipo" type="text"
                                                placeholder="{{ __('Ingrese Tipo...') }}" value="{{ old('tipo') }}"
                                                required="true" aria-required="true" autofocus />
                                            @if ($errors->has('tipo'))
                                                <span id="tipo-error" class="error text-danger"
                                                    for="input-tipo">{{ $errors->first('tipo') }}</span>
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
                                <a href="{{ route('roles.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
