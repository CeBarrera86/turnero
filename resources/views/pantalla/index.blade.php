@extends('layouts.app_pantalla', ['activePage' => 'pantalla', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="pantallaTable" class="table">
                            <h2 style="text-align: center; font-weight: bold; font-size: 50px;">TURNOS</h2>
                            <tbody id="tablaTurnos">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const urlTicketsAtendidos = @json(route('pantalla.ticketsAtendidos'));
        const urlPublicidad = @json(route('pantalla.publicidad'));
    </script>
    <script type="module" src="{{ asset('js/pantallas/main.js') }}"></script>
@endpush
