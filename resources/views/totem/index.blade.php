@extends('layouts.app_totem', ['activePage' => 'totem', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Bienvenido/a</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-category">
                                INGRESÁ TU DNI
                            </p>
                            <form method="post" action="{{ route('totem.search') }}" autocomplete="on"
                                class="form-horizontal">
                                @csrf
                                {{-- DNI --}}
                                <div class="alert alert-success">
                                    <div class="bmd-form-group{{ $errors->has('dni') ? ' has-danger' : '' }}">
                                        <input id="campo" name="dni" class="form-control dni" type="number" title="Ingrese DNI sin puntos"
                                            onfocusin="myFocusFunction()" readonly>
                                        @if ($errors->has('dni'))
                                            <div id="dni-error" class="error text-danger pl-3" for="dni"
                                                style="display: block;">
                                                <strong>{{ $errors->first('dni') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    {{-- INGRESAR --}}
                                    <button type="submit" class="btn btn-warning">{{ __('Ingresar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="teclado" class="table-responsive col-md-3" style="display: none;">
                    <table class="table table_teclado text-center">
                        <tr>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                        <tr class="mt-2">
                            <td colspan="2">0</td>
                            <td><span class="material-icons">backspace</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    @if (session('create') == 'ok')
        <script>
            Swal.fire({
                title: '¡Gracias!',
                text: "El turno se ha generado correctamente!",
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endpush
@push('js')
    <script>
        var x = document.getElementById("campo");
        x.addEventListener("focus", myFocusFunction, true);

        function myFocusFunction() {
            document.getElementById("teclado").style.display = 'block';
        }
    </script>
@endpush
