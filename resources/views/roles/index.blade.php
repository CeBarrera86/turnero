@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => __('Roles')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
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
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-warning">Nuevo</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center text-primary">
                                            <th>ID</th>
                                            <th>Tipo</th>
                                            <th>Descripción</th>
                                            <th>Creado</th>
                                            <th>Actualizado</th>
                                            <th class="text-right">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $rol)
                                                <tr class="text-center">
                                                    <td>{{ $rol->id }}</td>
                                                    <td>{{ $rol->tipo }}</td>
                                                    <td>{{ $rol->descripcion }}</td>
                                                    <td>{{ $rol->created_at }}</td>
                                                    <td>{{ $rol->updated_at }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('roles.edit', $rol->id) }}"
                                                            class="btn btn-facebook">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <form action="{{ route('roles.destroy', $rol->id) }}"
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
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
