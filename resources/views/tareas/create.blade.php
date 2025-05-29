@extends('layouts.app', ['activePage' => 'tareas', 'titlePage' => __('Tarea')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('tareas.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear') }}</h4>
                                <p class="card-category">{{ __('Registrar Información de la Tarea') }}</p>
                            </div>
                            <div class="card-body">
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
                                <a href="{{ route('tareas.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
