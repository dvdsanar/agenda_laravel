<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isUserActive = auth()->user()->is_active;
        if($isUserActive)
        {
            return $next($request);
        }
    return response()->json('El usuario no tiene su cuenta activada', 401);
    }    
}
