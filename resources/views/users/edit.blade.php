@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('users.update', $user->id) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Actualizar') }}</h4>
                                <p class="card-category">{{ __('Editar información de Usuarios') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Nombre --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" id="input-name" type="text"
                                                value="{{ old('name', $user->name) }}" required="true" aria-required="true"
                                                autofocus />
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                    for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Apellido --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Apellido') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}"
                                                name="surname" id="input-surname" type="text"
                                                placeholder="{{ __('Ingrese Apellido...') }}"
                                                value="{{ old('surname', $user->surname) }}" required="true"
                                                aria-required="true" />
                                            @if ($errors->has('surname'))
                                                <span id="surname-error" class="error text-danger"
                                                    for="input-surname">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Rol --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Rol') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                                name="role" id="input-role" required="true" aria-required="true">
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}"
                                                        {{ $rol->id == $user->role ? 'selected' : '' }}>
                                                        {{ $rol->tipo }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                                <span id="role-error" class="error text-danger"
                                                    for="input-role">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Usuario --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Usuario') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                name="username" id="input-username" type="text"
                                                placeholder="{{ __('Ingrese Nombre de Usuario...') }}"
                                                value="{{ old('username', $user->username) }}" required="true"
                                                aria-required="true" />
                                            @if ($errors->has('username'))
                                                <span id="username-error" class="error text-danger"
                                                    for="input-username">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Contraseña --}}
                                <div class="row justify-content-center">
                                    <label class="col-sm-2 col-form-label">{{ __('Contraseña') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" id="input-password" type="password"
                                                placeholder="{{ __('Ingrese Nueva Contraseña en caso de modificar...') }}" />
                                            @if ($errors->has('password'))
                                                <span id="password-error" class="error text-danger"
                                                    for="input-password">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Registro --}}
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                                <a href="{{ route('users.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- PARA CAMBIO DE PASSWORD --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <form method="post" action="#" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Change password') }}</h4>
                                <p class="card-category">{{ __('Password') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status_password'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status_password') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="input-current-password">{{ __('Current Password') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                                input type="password" name="old_password" id="input-current-password"
                                                placeholder="{{ __('Current Password') }}" value="" required />
                                            @if ($errors->has('old_password'))
                                                <span id="name-error" class="error text-danger"
                                                    for="input-name">{{ $errors->first('old_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="input-password">{{ __('New Password') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" id="input-password" type="password"
                                                placeholder="{{ __('New Password') }}" value="" required />
                                            @if ($errors->has('password'))
                                                <span id="password-error" class="error text-danger"
                                                    for="input-password">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" name="password_confirmation"
                                                id="input-password-confirmation" type="password"
                                                placeholder="{{ __('Confirm New Password') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
