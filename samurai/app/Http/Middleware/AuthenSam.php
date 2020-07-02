<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\AuthSam;

class AuthenSam
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
        if (!AuthSam::isLogin()) {
            return redirect('login');
            // ->with('error', 'ログインしてください。');
        }
        return $response;
    }
}
