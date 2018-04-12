<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Initiative;

class CurrentUserAuthenticate
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
        if(!Auth::check()) {
            return redirect('login/uwum');
        }
        else {
            $initiative = Initiative::find($request->id);

            if(empty($initiative) || Auth::id() != $initiative->user->id) {
                return redirect('offers');
            }
        }

        return $next($request);
    }
}
