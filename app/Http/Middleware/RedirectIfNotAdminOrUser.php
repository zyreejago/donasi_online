<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdminOrUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Periksa role pengguna
            if (Auth::user()->role === 'admin') {
                // Jika admin, arahkan ke dashboard admin
                return redirect()->route('admin.dashboard');
            }

            if (Auth::user()->role === 'user') {
                // Jika user biasa, arahkan ke dashboard user (atau halaman lain yang diinginkan)
                return redirect()->route('pages.donasi'); // Ganti sesuai dengan route yang ada untuk user
            }
        }

        // Jika tidak ada role yang cocok atau user tidak login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
