<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Komercia')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('TemplateKomercia/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/slick/slick-theme.css') }}">

    <!-- AOS -->
    <link href="{{ asset('TemplateKomercia/assets/libs/aos/aos.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/style.css') }}">

    @stack('styles')
</head>

<body>

    @include('landing.partials.header')

    <main style="margin-top: 76px;">
        @yield('content')
    </main>

    @include('landing.partials.footer')

    <!-- JS -->
    <script src="{{ asset('TemplateKomercia/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/libs/jquery/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/libs/slick/slick.min.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/libs/aos/aos.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
