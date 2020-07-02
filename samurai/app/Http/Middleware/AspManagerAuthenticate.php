<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AspManagerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'asp_user')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('asp_login');
        }
        $user = auth('asp_user')->user();
        if(!$user->isManager()){
            return response('Unauthorized!', 401);
        }
        return $next($request);
    }
}
