<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class localization
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
        // Check header request and determine localizaton
        if (session()->has('locale')){
            App::setLocale(session('locale'));
        }
        // continue request
        return $next($request);
    }
}
