<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AspModAuthenticate
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
            return redirect('asp/login');
        }
        $user = auth('asp_user')->user();
        if($user->role != 'mod'){
            return response('Unauthorized!', 401);
        }
        return $next($request);
    }
}
