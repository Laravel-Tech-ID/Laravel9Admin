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
        if(Auth::check()){
            if(!Auth::user()->hasAccess(Route::current()->getName())){
                return redirect(route('admin.dashboard.index'));
            }
        }else{
            return redirect(route('login'));
        }
        return $next($request);
    }
}
