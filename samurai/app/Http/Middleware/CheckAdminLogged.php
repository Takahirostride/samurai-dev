<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Modules\admin\Controllers\AuthController;

class CheckAdminLogged
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
        if (AuthController::is_admin()) {
            if(AuthController::permission()==0) {
                return redirect('/admin/master');
            }else{
                return redirect('/admin/employee');
            }
            
        }
        return $response;
    }
}
