<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AuthSam;

class CheckLogged
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
        $response = $next($request);
        if (AuthSam::isLogin()) {
            if(AuthSam::permission()) return redirect('/agency/home');
            return redirect('/client/F0');
        }
        return $response;
    }
}
