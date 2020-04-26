<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\CloseCTRL;

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
        $hora = CloseCTRL::hora();

        if ($hora[0]) {
            return $next($request);
        }
        
        return redirect()->to('/closed/' . $hora[1]); 
    }
}
