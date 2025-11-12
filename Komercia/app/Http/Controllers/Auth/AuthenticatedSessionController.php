<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    public function create(): View|RedirectResponse
    {
        // Si ya hay sesión activa, redirigir según su rol
        if (Auth::check()) {
            return match (Auth::user()->id_rol) {
                1 => redirect()->route('admin.dashboard'),
                2 => redirect()->route('landing.home'),
                default => redirect()->route('landing.home'),
            };
        }

        // Si no hay sesión, mostrar login normalmente
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = User::where('dsc_username', $request->email)->first();



        if ($usuario && Hash::check($request->password, $usuario->dsc_contrasenha)) {
            Auth::login($usuario);
            $request->session()->regenerate();

            $redirectRoute = match ($usuario->id_rol) {
                1 => route('admin.dashboard'),
                2 => route('landing.home'),
                default => route('login'),
            };

            return redirect()->intended($redirectRoute);
        }

        return back()->withErrors([
            'password' => 'Usuario o contraseña incorrecta.',
        ])->onlyInput('username');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(): RedirectResponse
    {
        // Crear usuario “quemado”
        $usuario = User::create([
            'dsc_username' => 'yeiler',
            'dsc_correo' => 'yei;er@gmail.com',
            'dsc_contrasenha' => Hash::make('Olito123'),
            'id_rol' => 2,
            'fec_creacion' => now(),
            'fec_modificacion' => now(),
        ]);



        // Redirigir al panel admin
        return redirect()->route('admin.dashboard')->with('success', 'Usuario admin creado y logueado.');
    }
}
