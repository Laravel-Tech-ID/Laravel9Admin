<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Route;
use App\Response;

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
                    return back()->with('error', config('app.message_deny'));
                }
            }else{
                return redirect(route('login'));
            }
            return $next($request);
        }else{
            if(auth('api')->user()){
                if(!auth('api')->user()->hasAccess(Route::current()->getName())){
                    return Response::_401();
                }
            }else{
                return Response::_401();
            }
            return $next($request);
        }        
    }
}
