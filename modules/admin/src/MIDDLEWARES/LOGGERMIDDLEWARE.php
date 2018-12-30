<?php

namespace ARJUN\ADMIN\MIDDLEWARES;

use Closure;
use ARJUN\ADMIN\TRAITS\LOGS\ACTIVITYLOGGER;

class LOGGERMIDDLEWARE {

    protected $guard;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct($guard = 'web') {
        $this->guard = $guard;
    }

    public function handle($request, Closure $next, $guards) {
        if ($request->method() != 'GET') {
            ACTIVITYLOGGER::activity($guards);
        }
        return $next($request);
    }

}
