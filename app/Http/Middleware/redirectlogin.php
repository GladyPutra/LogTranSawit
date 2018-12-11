<?php

namespace App\Http\Middleware;

use Closure;

class redirectlogin
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
        if(\Auth::guest())
        {
            \Alert::error('Silahkan Login Terlebih Dahulu', 'WARNING')->persistent('Close');
            return redirect()->route('login.home');
        }
        return $next($request);
    }
}
