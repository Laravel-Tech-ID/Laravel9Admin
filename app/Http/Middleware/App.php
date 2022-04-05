<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Route;

class App
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
        if($request->route()->getAction('middleware')[0] === 'web'){
            if(Auth::check()){
                if(!Auth::user()->hasAccess(Route::current()->getName())){
                    return redirect(route('admin.dashboard.index'));
                }
            }else{
                return redirect(route('login'));
            }
            return $next($request);
        }else{
            //TANPA ROUTE CACHE//
            if(auth('api')->user()){
                if(!auth('api')->user()->hasAccess(Route::current()->getName())){
                    return Response::_401();
                }
            }else{
                return Response::_401();
            }
            return $next($request);
            //DENGAN ROUTE CACHE//
            // $auth = Cache::remember("auth", 10 * 60, function () {
            //     return auth('api')->user();
            // });
            // if($auth){
            //     $check = Cache::remember("auth_has_access", 10 * 60, function () {
            //         return auth('api')->user()->hasAccess(Route::current()->getName());
            //     });
            //     if(!$check){
            //         return Response::_401();
            //     }
            // }else{
            //     return Response::_401();
            // }
            // return $next($request);
        }        
    }
}
