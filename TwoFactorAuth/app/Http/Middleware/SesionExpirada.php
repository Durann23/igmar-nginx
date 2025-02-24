<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SesionExpirada
{
 
    public function handle(Request $request, Closure $next)
    {
        if (!session('verification_email')) {
            return redirect()->route('login')->withErrors(['error' => 'La sesión ha expirado, inicia sesión nuevamente.']);
        }
        return $next($request);
    }
}
