<?php

namespace App\Http\Middleware;

use App\Helpers\AuthCommon;
use Closure;
use Illuminate\Http\Request;

class RyunnaAuth
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

        $auth = AuthCommon::user();
        if(!isset($auth->username)){
           return redirect('/');
        }

        return $next($request);
    }
}
