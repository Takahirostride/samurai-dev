<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Modules\Admin\Controllers\AuthController;

class EmployeeAdmin
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
        if (AuthController::permission() > 1) {
            return redirect('/admin/employee/system/advertisement');
        }
        return $response;
    }
}
