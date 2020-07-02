<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AuthSam;

class AgencyAuth
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
        if(!AuthSam::permission()) return redirect('client/mypage/home');
        // if(!AuthSam::permission_lock()) return redirect('/agency/home/?lock=1');
        return $rq;
    }
}
