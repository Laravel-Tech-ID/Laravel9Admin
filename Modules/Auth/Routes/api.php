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

Route::group(['prefix' => 'auth'], function(){
    Route::post('login',[Modules\Auth\Http\Controllers\V1\Api\AuthController::class, 'login'])->name('api.auth.login');
    Route::post('refresh',[Modules\Auth\Http\Controllers\V1\Api\AuthController::class, 'refresh'])->name('api.auth.refresh');
    // Route::post('register',[Modules\Auth\Http\Controllers\V1\Api\AuthController::class, 'register'])->name('api.auth.register');
    Route::group(['middleware' => ['auth:api','app']],function (){
        Route::get('profile',[Modules\Auth\Http\Controllers\V1\Api\AuthController::class, 'profile'])->name('api.auth.profile');
        Route::post('logout',[Modules\Auth\Http\Controllers\V1\Api\AuthController::class, 'logout'])->name('api.auth.logout');
    });
});
    