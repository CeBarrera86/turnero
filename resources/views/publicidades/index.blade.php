@extends('layouts.app', ['activePage' => 'publicidades', 'titlePage' => __('Publicidades')])

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
                                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-cloak>
                                    <div class="alert alert-success" role="success" style="text-align: center;">
                                        <h4><strong> {{ session('success') }} </strong></h4>
                                    </div>
                                </div>
                            @elseif (session('danger'))
                                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-cloak>
                                    <div class="alert alert-danger" role="danger" style="text-align: center;">
                                        <h4><strong> {{ session('danger') }} </strong></h4>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('publicidades.create') }}" class="btn btn-sm btn-warning">Nuevo
                                        Archivo</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center text-primary">
                                            <th>Archivo</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($archivos as $archivo)
                                                <tr class="text-center">
                                                    <td>
                                                        @if (in_array(pathinfo($archivo, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset('storage/publicidad/miniatura/' . $archivo) }}"
                                                                alt="{{ $archivo }}" class="img-thumbnail">
                                                        @elseif (in_array(pathinfo($archivo, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg', 'avi']))
                                                            <img src="{{ asset('storage/publicidad/miniatura/' . pathinfo($archivo, PATHINFO_FILENAME) . '.jpg') }}"
                                                                alt="{{ $archivo }}" class="img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td>{{ $archivo }}</td>
                                                    <td class="td-actions text-center">
                                                        <form action="{{ route('publicidades.destroy', $archivo) }}"
                                                            method="post" style="display: inline-block;"
                                                            onsubmit="return confirm('¿Está seguro?')">
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
                            {{ $archivos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
