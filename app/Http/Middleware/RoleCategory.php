<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Redirect;
use Session;
class RoleCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */


    public function handle($request, Closure $next, $guard = null)
    {
        // if ($request->input('age') <= 200) {
        //     return "sonnt";
        // }

        // return $next($request);
         // Add this:


        if($request->method() == 'POST'){
           
            return $next($request);
           
        }
        if ($request->method() == 'GET' || $this->tokensMatch($request)) {
            if(!session('admin') == "admin" ){
                return Redirect::to('/');
            }else{
                return $next($request);
            }
        }
        return Redirect::to('/');
        // throw new TokenMismatchException;
    }
}
