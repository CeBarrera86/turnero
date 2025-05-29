@extends('layouts.app', ['activePage' => 'publicidades', 'titlePage' => __('Publicidad')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('publicidades.store') }}" autocomplete="off" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Cargar') }}</h4>
                                <p class="card-category">{{ __('Agregar nueva publicidad') }}</p>
                            </div>
                            <div class="card-body">
                                {{-- Archivo --}}
                                <div class="row justify-content-center">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <input type="file" multiple class="inputFileHidden" name="archivos[]"
                                            id="input-archivos" accept="archivo/*">
                                        <div class="input-group d-flex">
                                            <textarea type="text" class="form-control inputFileVisible"
                                                placeholder="Seleccione imágen(es)..." multiple readonly>
                                            </textarea>
                                            <span class="input-group-btn">
                                                <label for="input-archivos" class="btn btn-fab btn-round btn-info">
                                                    <i class="material-icons">attach_file</i>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Cargar --}}
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Cargar') }}</button>
                                <a href="{{ route('publicidades.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar los nombres de los archivos seleccionados
        document.getElementById('input-archivos').addEventListener('change', function() {
            const files = this.files;
            const visibleInput = document.querySelector('.inputFileVisible');
            if (files.length > 0) {
                visibleInput.value = Array.from(files).map(file => file.name).join(', ');
            } else {
                visibleInput.value = '';
            }
        });
    </script>
@endsection
