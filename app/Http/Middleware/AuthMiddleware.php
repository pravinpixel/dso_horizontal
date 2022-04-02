<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Sentinel::check()== FALSE) { 
            return redirect()->route('login'); 
        } 

        // if (Sentinel::hasAccess('user.view.withdrawal') ) {
        //     return $next($request);
        // }  

        return $next($request);
        // return redirect()->route('dashboard');

        // if(Sentinel::check()) {
        //     if (Sentinel::hasAccess('user.view.withdrawal') ) {
        //         return $next($request);
        //     }
        //     return redirect()->route('dashboard');
        // }
        
        // return redirect()->route('login');
    }
}