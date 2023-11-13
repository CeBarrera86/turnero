@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Usuarios')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Listado') }}</h4>
                        </div>
                        <div class="card-body">
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-warning">Nuevo</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center text-primary">
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Rol</th>
                                            <th class="text-right">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="text-center">
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->roles->tipo }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('users.show', $user->id) }}"
                                                            class="btn btn-info">
                                                            <i class="material-icons">person</i>
                                                        </a>
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-facebook">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="post" style="display: inline-block;"
                                                            onsubmit="return confirm('Esta seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" rel="tooltip">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer m-auto">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
