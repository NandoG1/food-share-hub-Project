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
    public function handle($request, Closure $next)
    {
        dd(Auth::guard('admin')->user(), session()->all()); 
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login')->withErrors(['access' => 'Anda tidak memiliki akses sebagai Admin.']);
        }
    
        return $next($request);
     

    }
}