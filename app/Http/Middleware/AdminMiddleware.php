<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
<<<<<<< HEAD
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['access' => 'Anda tidak memiliki akses sebagai Admin.']);

=======
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && optional(Auth::user())->isAdmin()) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Unauthorized access.');
>>>>>>> 3564f8aa615b12ed2a22b05693f9024994f54f82
    }
}
