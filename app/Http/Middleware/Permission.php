<?php

namespace App\Http\Middleware;

use Closure;
use App\Admins;
class Permission
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
        if(!session('admin')){

           return redirect()->route('quan-tri/dang-nhap')->with('error', 'Bạn phải đăng nhập mới thực hiện chức năng này');
        }
		// Get the current route.
        $route = $request->route();

        // Get the current route actions.
        $actions = $route->getAction();
        
        if(session('admin')->id==1){

           return $next($request);
        }
        // dd($actions['permissions']);
         if (!$permissions = isset($actions['permissions']) ? $actions['permissions'] : null){    
            // No permissions to check, allow access.
            return $next($request);
        }
       // dd($actions['permissions']);
        else{
            
            if (session('admin')->can($actions['permissions']))
            {    
                // Access is granted.
                return $next($request);
            }
        }
        return redirect()->route('admin.home');
    }
}
