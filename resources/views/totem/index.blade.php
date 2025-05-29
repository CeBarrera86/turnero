@extends('layouts.app_totem', ['activePage' => 'totem', 'titlePage' => __('Gestión de Turnos')])

@section('content')
    <div class="content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Formulario de ingreso -->
                @include('totem.elementos.formulario')
                <!-- Teclado numérico -->
                @include('totem.elementos.teclado')
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const urlSearchDNI = @json(route('totem.search'));
        const message = @json($message);
    </script>
    <script type="module" src="{{ asset('js/totem/alertasIndex.js') }}"></script>
@endpush
