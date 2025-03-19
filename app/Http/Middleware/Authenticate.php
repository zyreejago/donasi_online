<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an authenticated request.
     */
    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        // After authentication, check user role and redirect accordingly
        if (Auth::check() && Auth::user()->role === 'admin' && $request->routeIs('dashboard')) {
            redirect()->route('admin.dashboard')->send();
            exit;
        }
    }
    
}