<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="{{ asset('TemplateKomercia/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">


    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/auth.css') }}">
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('TemplateKomercia/assets/libs/bootstrap/js/bootstrap.bundle.js') }}"></script>
    @yield('js')
</body>

</html>
