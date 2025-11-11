<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Komercia') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('TemplateKomercia/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/auth.css') }}">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('TemplateKomercia/assets/libs/bootstrap/js/bootstrap.bundle.js') }}"></script>

    <!-- Validación Bootstrap -->
   @yield('js')
</body>
</html>
