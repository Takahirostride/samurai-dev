<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AuthSam;

class ClientAuth
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
        $rq = $next($request);
        if(AuthSam::permission()) return redirect('agency/mypage/home');
        // if(!AuthSam::permission_lock()) return redirect('client/F0/?lock=1');
        return $rq;
    }
}
