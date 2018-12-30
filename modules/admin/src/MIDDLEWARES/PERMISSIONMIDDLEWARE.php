<?php

namespace ARJUN\ADMIN\MIDDLEWARES;

use Illuminate\Support\Facades\Auth;
use Closure;

class PERMISSIONMIDDLEWARE {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->permissions) {
            return $next($request);
        }
    }

}
