<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App;
use Session;
use Request;
use App\Models\Admin;
use App\Models\AdminAdminRole;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
	{
	    if (!Auth::guard($guard)->check()) {
	        return redirect('admin/login');
	    }

        /**
         * 判断是否为线上环境
         */
        if (strtolower(App()->environment()) === strtolower('production')) {
            $route = Route::currentRouteAction();
            $routeRole =  route_role($route,'Backend');
            $adminSession = Session::get('ADMIN_DATA');
            $adminId = $adminSession['id'];
            $user = Admin::getDataById($adminId);

            if($user->can($routeRole) === false){
                if(Request::ajax()){
                    $result = ['status' => true, 'message' => '您无权限!','routeRole'=>$routeRole];
                    return response()->json($result);
                }else{
                    echo $routeRole."<br/>";
                    die("您无权限");
                }
            }
        }

	    return $next($request);
	}
}