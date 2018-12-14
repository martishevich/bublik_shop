<?php

namespace App\Http\Middleware;

use Closure;

class Basketmiddleware
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
        if ($request->session()->has('cart')){
            $counter = count($request->session()->get('cart', '0'));
            $request->session()->put('counter', $counter);
        }
        else {
            $counter = '';
            $request->session()->put('counter', $counter);
        }
        
        return $next($request);
    }
}
