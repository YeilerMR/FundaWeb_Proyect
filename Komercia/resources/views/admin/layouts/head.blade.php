<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Komercia | Panel Admin')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('TemplateKomercia/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <!-- AOS -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/aos/aos.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/slick/slick-theme.css') }}">
    <!-- Estilos principales -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/admin.css') }}">

    {{-- Estilos específicos por página --}}
    @stack('styles')
</head>
