<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        // Pastikan pengguna sudah login.
        if (!$request->user()) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        $user = $request->user();

        // Tolak akun yang dinonaktifkan.
        if (!$user->is_active) {
            abort(403, 'Akun kamu sedang tidak aktif.');
        }

        // Periksa apakah role pengguna diizinkan.
        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Kamu tidak memiliki izin untuk mengakses fitur ini.');
        }

        return $next($request);
    }
}
