<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminPanel
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
        if( Auth::check() )
            if(Auth::user()->pro=='31416')
                return $next($request);
        

        return redirect()->to('kitchen/login');

    }
}
