<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    
        // check if user login
        if(Auth::check()) {
            // check if the user logged in is admin
            if(Auth::user()->isAdmin()) {
                // return next request, means all good.
                return $next($request);
            }
        }

        return redirect('/');

    }
}
