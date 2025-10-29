@extends('landing.layouts.main')

@section('content')
<!-- Logo / Brand -->
            <div class="text-center mb-3">
                <div class="brand-icon-lg mb-2"><i class="bi bi-shop"></i></div>
            </div>

            <!-- Header -->
            <div class="auth-header text-center mb-3">
                <h5 class="fw-semibold mb-1">Registro de usuario</h5>
                <p class="text-secondary small">Completa los datos para crear tu cuenta</p>
            </div>

            <!-- Form -->
            <form class="needs-validation auth-form" action="{{ route('login.store') }}" method="POST" novalidate>
                @csrf
                <!-- Usuario -->
                <div class="mb-3">
                    <label class="form-label" for="username">Nombre de usuario</label>
                    <input type="text" id="username" name="dsc_username" class="form-control" value="josue"
                        placeholder="Nombre de usuario" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input type="email" id="email" name="dsc_correo" class="form-control" value="josue@gmail.com"
                        placeholder="ejemplo@correo.com" required>
                    <div class="invalid-feedback">Ingresa un correo válido.</div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" name="dsc_contrasenha" class="form-control" value="Olito123"
                        placeholder="********" minlength="6" required>
                    <div class="invalid-feedback">Mínimo 6 caracteres.</div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label" for="passwordConfirm">Confirmar contraseña</label>
                    <input type="password" id="passwordConfirm" class="form-control" value="Olito123"
                        placeholder="Vuelve a escribir la contraseña" required>
                    <div class="invalid-feedback">Debe coincidir con la contraseña.</div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary-custom w-100">Crear Cuenta</button>
            </form>

            <!-- Footer -->
            <div class="text-center mt-3">
                <a href="{{route('login.index')}}" class="auth-link">← Ya tengo cuenta</a>
            </div>
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