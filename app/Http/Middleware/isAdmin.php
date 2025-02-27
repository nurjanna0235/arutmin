<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('level') !== 'admin') {
            return response()->json(['message' => 'Anda tidak memiliki akses!'], 403);
        }

        // Jika pengguna adalah admin, lanjutkan request
        return $next($request);
    }
}
