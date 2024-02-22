<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    // public function handle($request, Closure $next) {
    //     // if (Auth::check() == true && Auth::user()->role == 0) {
    //     //     return redirect()->route('home');
    //     // }elseif (Auth::check() == true && Auth::user()->role == 1) {
    //     //     return redirect()->route('/');
    //     // }else {
    //     //     return redirect()->route('login');
    //     // }

    //     return $next($request);
    // }
}
