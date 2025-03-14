<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::check() && ($request->is('login') || $request->is('register'))) {
                $user = Auth::user();
                return redirect()->route($user->role == 'admin' ? 'admin.dashboard' : 'dashboard');
            }
            
        }
        

        return $next($request);
    }
}
