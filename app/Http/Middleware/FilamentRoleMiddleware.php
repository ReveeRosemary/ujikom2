<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilamentRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If the user is authenticated and has a "buyer" role
        if ($user && $user->role === 'buyer') {
            // You can redirect them to a different page or deny access
            return abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
