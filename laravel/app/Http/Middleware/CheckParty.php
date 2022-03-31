<?php

namespace App\Http\Middleware;

use Closure;

class CheckParty
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
        $user = $request['user'];
        if ($user->usable_type != 'App\School') 
        {
            return response()->json(['message', 'Only schools have this feature']);
        }
        return $next($request);
       
    }
}
