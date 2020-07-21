<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserToken
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
        if(($user = Auth::user()) && $request->hasHeader("authorization") && $request->header("authorization") == "Bearer {$user->api_token}")
        {
            return $next($request);
        }
        return response()->json(['success'=>false, 'data'=>(object)[],'message'=>__('Unauthorize authorization token.')], 401);
    }
}
