<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            // Utilizatorul nu este autentificat
            return redirect('/login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }

        if (Auth::user()->role !== $role) {
            // Utilizatorul nu are rolul potrivit
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
