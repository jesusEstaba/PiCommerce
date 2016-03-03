<?php

namespace Pizza\Http\Middleware;

use Closure;
use Pizza\Http\Controllers\CloseCTRL;

class hora
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
        if( CloseCTRL::hora() )
            return $next($request);
        
        return redirect()->to('/closed');    
    }
}
