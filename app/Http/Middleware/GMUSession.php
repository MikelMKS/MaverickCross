<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class GMUSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // comprueba si el usuario es tipo admin
    public function handle($request, Closure $next)
    {
        if (Session::get('Stipo') != 1) {
            return redirect('index');
        }

        return $next($request);
    }
}
