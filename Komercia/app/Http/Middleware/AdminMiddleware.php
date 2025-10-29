<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Verifica que haya sesión activa
        if (!$request->session()->has('usuario_id')) {
            return redirect()->route('landing.Login.log')->with('error', 'Debes iniciar sesión primero.');
        }

        // Verifica que sea admin (rol 1 = admin, ajusta según tu BD)
        if ($request->session()->get('rol') != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
