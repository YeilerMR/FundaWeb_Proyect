<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica que haya un usuario autenticado
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión primero.');
        }

      
        if (Auth::user()->id_rol != 2) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Solo los clientes pueden acceder a esta sección.');
        }

        // Si todo está bien, continúa
        return $next($request);
    }
}
