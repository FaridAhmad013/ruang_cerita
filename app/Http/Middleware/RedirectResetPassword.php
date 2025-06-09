<?php

namespace App\Http\Middleware;

use App\Helpers\AuthCommon;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class RedirectResetPassword
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
        if($auth->last_update == null){
            return redirect(route('profile.index'))->with(['reset_password' => 'Silakan ganti password bawaan, dengan password keinginan Anda']);
        }
        if(Carbon::parse($auth->last_update)->addMonth(3)->eq(Carbon::now())){
            return redirect(route('profile.index'))->with(['reset_password' => 'Silakan Untuk Mereset Password Anda']);
        }

        return $next($request);
    }
}
