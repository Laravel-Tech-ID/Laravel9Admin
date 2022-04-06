<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'auth'], function(){
        Route::post('login',[Modules\Auth\Http\Controllers\Api\V1\AuthController::class, 'login'])->name('api.v1.auth.login');
        Route::post('refresh',[Modules\Auth\Http\Controllers\Api\V1\AuthController::class, 'refresh'])->name('api.v1.auth.refresh');
        // Route::post('register',[Modules\Auth\Http\Controllers\Api\V1\AuthController::class, 'register'])->name('api.v1.auth.register');
        Route::group(['middleware' => ['auth:api','app']],function (){
            Route::get('profile',[Modules\Auth\Http\Controllers\Api\V1\AuthController::class, 'profile'])->name('api.v1.auth.profile');
            Route::post('logout',[Modules\Auth\Http\Controllers\Api\V1\AuthController::class, 'logout'])->name('api.v1.auth.logout');
        });
    });
});
    