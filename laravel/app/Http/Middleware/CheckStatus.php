<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatus
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
        $user = \App\User::find($request['user']->id);
        if($user->status != 1 )
        {
            return response()->json(['message'=>'errors.unauthenticated']);
        }
        return $next($request);
    }
}
