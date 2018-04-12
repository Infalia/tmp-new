<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UwumAuthenticate
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
        // if(!Auth::check()) {
        //     return redirect('login/uwum');
        // }

        if(!Auth::check()) {
            Auth::loginUsingId(1);
        }

        return $next($request);
    }
}
