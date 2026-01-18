<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika sudah memiliki akses admin
        if (!$request->session()->has('admin_access_granted')) {
            // Redirect ke form input kode akses
            return redirect()->route('admin.access.form')->with('error', 'Silakan verifikasi akses terlebih dahulu.');
        }

        return $next($request);
    }
}
