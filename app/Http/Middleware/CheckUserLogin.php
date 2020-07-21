<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserLogin
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
        if(Auth::user()) {
            if(Auth::user()->otp_status == 0 && Auth::user()->user_type != 'admin' && Auth::user()->user_type != 'staff') {
                if (Auth::user()->updated_at != Auth::user()->created_at) {
                    flash(__('aleady_registered_msg'))->success();
                }else{
                    flash(__('new_registered_msg'))->success();
                }
                return redirect()->route('frontend.login_opt');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
