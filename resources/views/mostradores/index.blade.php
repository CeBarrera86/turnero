@extends('layouts.app', ['activePage' => 'mostradores', 'titlePage' => __('Mostradores')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
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
                                    <a href="{{ route('mostradores.create') }}" class="btn btn-sm btn-warning">Nuevo</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center text-primary">
                                            <th>Número</th>
                                            <th>IP</th>
                                            <th>Alfa</th>
                                            <th>Tipo</th>
                                            <th>Sector</th>
                                            <th>Creado</th>
                                            <th>Actualizado</th>
                                            <th class="text-right">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($mostradores as $mostrador)
                                                <tr class="text-center">
                                                    <td>{{ $mostrador->numero }}</td>
                                                    <td>{{ $mostrador->ip }}</td>
                                                    <td>{{ $mostrador->alfa }}</td>
                                                    <td>{{ $mostrador->tipo }}</td>
                                                    <td>{{ $mostrador->sectores->nombre }}</td>
                                                    <td>{{ $mostrador->created_at }}</td>
                                                    <td>{{ $mostrador->updated_at }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('mostradores.edit', $mostrador->id) }}"
                                                            class="btn btn-facebook">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <form action="{{ route('mostradores.destroy', $mostrador->id) }}"
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
                            {{ $mostradores->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
