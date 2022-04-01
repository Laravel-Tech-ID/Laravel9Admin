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
    Route::get('dashboard', [Modules\Dashboard\Http\Controllers\V1\Web\DashboardController::class, 'index'])->name('admin.dashboard.index');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','app']],function(){
    Route::get('ortu', [Modules\Dashboard\Http\Controllers\V1\Web\DashboardController::class, 'ortu'])->name('admin.ortu.index');
});
