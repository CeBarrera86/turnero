@extends('layouts.app', ['activePage' => 'estados', 'titlePage' => __('Estado')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('estados.update', $estado->id) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Actualizar') }}</h4>
                                <p class="card-category">{{ __('Editar información del Rol') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Letra --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Letra') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('letra') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('letra') ? ' is-invalid' : '' }}"
                                                name="letra" id="input-letra" type="text"
                                                value="{{ old('letra', $estado->letra) }}" required="true" aria-required="true"
                                                autofocus />
                                            @if ($errors->has('letra'))
                                                <span id="letra-error" class="error text-danger"
                                                    for="input-letra">{{ $errors->first('letra') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Descripción --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Descripción') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                                name="descripcion" id="input-descripcion" type="text"
                                                placeholder="{{ __('Ingrese Descripción...') }}"
                                                value="{{ old('descripcion', $estado->descripcion) }}" required="true"
                                                aria-required="true" />
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
                                <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                                <a href="{{ route('estados.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
