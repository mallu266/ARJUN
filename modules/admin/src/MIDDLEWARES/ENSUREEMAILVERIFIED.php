<?php

namespace ARJUN\ADMIN\MIDDLEWARES;

use Closure;
use Illuminate\Support\Facades\Auth;

class ENSUREEMAILVERIFIED {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user() && Auth::user()->verify) {
            return $next($request);
        }
    }

}
