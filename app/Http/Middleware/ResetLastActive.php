<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class ResetLastActive
{

    public function handle($request, Closure $next)
    {
        Session::put('lastActive', date('U'));
        
        return $next($request);
    }
}
