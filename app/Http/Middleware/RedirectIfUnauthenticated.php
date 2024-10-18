<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RedirectIfUnauthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {

        $guards = empty($guards) ? [null] : $guards;


        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                if (Auth::guard('web') && Route::is('login')) {
                    return redirect()->route('dashboard');
                } 

                if (Auth::guard('admin') && Route::is('admin.login')) {
                    return redirect()->route('admin.dashboard');

                }
            } 
        }

        return $next($request);
    }
}
