<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth','app']],function(){
    Route::group(['prefix' => 'v1'],function(){
        Route::get('dashboard', [Modules\Dashboard\Http\Controllers\Web\V1\DashboardController::class, 'index'])->name('admin.v1.dashboard.index');
    });
});
