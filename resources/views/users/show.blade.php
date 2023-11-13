@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title"> Perfil </h4>
                        </div>
                        <div class="card-body ">
                            @if (session('success'))
                                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show">
                                    <div class="alert alert-success" role="success" style="text-align: center;">
                                        <h4><strong> {{ session('success') }} </strong></h4>
                                    </div>
                                </div>
                            @elseif (session('danger'))
                                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show">
                                    <div class="alert alert-danger" role="danger" style="text-align: center;">
                                        <h4><strong> {{ session('danger') }} </strong></h4>
                                    </div>
                                </div>
                            @endif
                            <a href="#" class="d-flex">
                                <img src="{{ asset('img/new_logo.png') }}" alt="image" class="avatar">
                                <h3 class="title mx-3 mt-auto">{{ $user->username }}</h3>
                            </a>
                            <div class="card card-user">
                                <div class="card-text">
                                    <p class="description">
                                        <br />Nombre: {{ $user->name }}
                                        <br />Apellido: {{ $user->surname }}
                                        <br />Rol: {{ $user->roles->tipo }}
                                        <br />Creado: {{ $user->created_at }}
                                        <br />Actualizado: {{ $user->updated_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mx-auto">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-facebook">Editar</a>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-warning">Principal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
