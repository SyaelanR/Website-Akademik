<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware ini akan memeriksa apakah role user yang login
     * cocok dengan salah satu role yang diizinkan.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles Daftar role yang diizinkan, dipisahkan koma.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login.
        // Middleware 'auth' seharusnya sudah menangani ini, tapi ini adalah pengaman tambahan.
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan.
        if (!in_array($request->user()->role, $roles)) {
            // 3. Jika tidak cocok, tolak akses dengan halaman error 403 (Forbidden).
            abort(403, 'ANDA TIDAK MEMILIKI AKSES UNTUK HALAMAN INI.');
        }

        // 4. Jika peran cocok, lanjutkan ke request berikutnya.
        return $next($request);
    }
}
