<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Contoh validasi role (asumsi pengguna memiliki role di session atau auth)
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect('/unauthorized'); // Redirect jika tidak sesuai role
        }

        return $next($request);
    }
}
