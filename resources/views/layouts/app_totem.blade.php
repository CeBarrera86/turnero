<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Totem') }}</title>
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('img/corpico_icon.jpg') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons" />
    {{-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/material-dashboard_totem.css?v=2.1.1') }}" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/virtual-key.js') }}"></script>
</head>

<body class="{{ $class ?? '' }}">
    @guest()
        @include('layouts.page_templates.totem')
    @endguest

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('js/plugins/moment.min.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('js/plugins/sweetalert2.js') }}"></script>
    <!-- Script para el tiempo -->
    <script type="text/javascript">
        function showTime() {
            var date = new Date();
            document.getElementById('time').innerHTML = date.toLocaleDateString('es-AR') + ' - ' + date.toLocaleTimeString(
                'es-AR');
        }
        setInterval(showTime, 1000);
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</body>

</html>
