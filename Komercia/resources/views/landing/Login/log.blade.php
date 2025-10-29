@extends('landing.layouts.main')

@section('content')
    <!-- Logo / Brand -->
    <div class="text-center mb-3">
        <div class="brand-icon-lg mb-2"><i class="bi bi-shop"></i></div>
        <h4 class="auth-title">Komercia</h4>
        <p class="auth-subtitle">Inicia sesión para continuar</p>
    </div>

    <!-- Form -->
    <form action="{{ route('login.attempt') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Ejm: NoobMaster34" required>
            <div class="invalid-feedback">Ingresa un usuario válido.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Tu contraseña" required>
            <div class="invalid-feedback">La contraseña es obligatoria.</div>
        </div>

        <button type="submit" class="btn btn-primary-custom w-100">
            Iniciar Sesión
        </button>
    </form>


    @endsection


    @section('js')
        <script>
           (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
        </script>
    @endsection
