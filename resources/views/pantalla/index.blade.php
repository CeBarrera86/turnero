@extends('layouts.app_pantalla', ['activePage' => 'pantalla', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="alert alert-primary tv" style="text-align: center;">
                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="myCarouselCaja">
                                <!-- Contenido del carrusel Caja -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success tv" style="text-align: center;">
                        <div id="myCarousel2" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="myCarouselBox">
                                <!-- Contenido del carrusel Box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const urlCheckDataCaja = @json(route('pantalla.checkDataCaja'));
        const urlCheckDataBox = @json(route('pantalla.checkDataBox'));
        const urlCheckSidebar = @json(route('pantalla.checkSidebar'));
    </script>
    <script type="text/javascript" src="{{ asset('js/pantallas/pantalla.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pantallas/evento.js') }}"></script>
@endpush
