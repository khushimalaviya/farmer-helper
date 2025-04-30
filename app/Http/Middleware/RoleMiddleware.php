<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!Auth::user()->roles()->whereIn('u_role', $roles)->exists()) {
            // return response()->view('errors.403', [], 403);
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
