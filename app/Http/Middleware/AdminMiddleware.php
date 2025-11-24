<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sedang login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // PENGECEKAN KETAT: KEDUA kondisi harus terpenuhi (AND, bukan OR)
        // User harus memiliki is_admin=true DAN role='admin' untuk akses admin
        if ($user->is_admin === true && strtolower(trim($user->role ?? '')) === 'admin') {
            return $next($request);
        }

        // Tolak akses dengan 403 Forbidden (lebih aman dari redirect)
        // Ini akan memblokir user biasa yang mencoba akses admin setelah login di tab berbeda
        abort(403, 'Akses Ditolak: Anda bukan Admin.');
    }
}