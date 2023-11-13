@extends('layouts.app', ['activePage' => 'estados', 'titlePage' => __('Estados')])

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
                                    <a href="{{ route('estados.create') }}" class="btn btn-sm btn-warning">Nuevo</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center text-primary">
                                            <th>Letra</th>
                                            <th>Descripción</th>
                                            <th>Creado</th>
                                            <th>Actualizado</th>
                                            <th class="text-right">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($estados as $estado)
                                                <tr class="text-center">
                                                    <td>{{ $estado->letra }}</td>
                                                    <td>{{ $estado->descripcion }}</td>
                                                    <td>{{ $estado->created_at }}</td>
                                                    <td>{{ $estado->updated_at }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('estados.edit', $estado->id) }}"
                                                            class="btn btn-facebook">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <form action="{{ route('estados.destroy', $estado->id) }}"
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
                            {{ $estados->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
