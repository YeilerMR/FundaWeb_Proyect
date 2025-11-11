<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Logo / Brand -->
    <div class="text-center mb-3">
        <div class="brand-icon-lg mb-2"><i class="bi bi-shop"></i></div>
        <h4 class="auth-title">Komercia</h4>
        <p class="auth-subtitle">Inicia sesión para continuar</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input 
                type="text" 
                id="username" 
                name="email" 
                class="form-control" 
                placeholder="Ejm: NoobMaster34" 
                value="{{ old('email') }}" 
                required 
                autofocus
            >
            <div class="invalid-feedback">Ingresa un usuario válido.</div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control" 
                placeholder="Tu contraseña" 
                required 
                autocomplete="current-password"
            >
            <div class="invalid-feedback">La contraseña es obligatoria.</div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input 
                class="form-check-input" 
                type="checkbox" 
                id="remember_me" 
                name="remember"
            >
            <label class="form-check-label" for="remember_me">
                Recordarme
            </label>
        </div>

        <!-- Forgot Password + Submit -->
        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
            <button type="submit" class="btn btn-primary-custom">
                Iniciar Sesión
            </button>
        </div>
    </form>

    <!-- Bootstrap Validation Script -->
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
</x-guest-layout>
