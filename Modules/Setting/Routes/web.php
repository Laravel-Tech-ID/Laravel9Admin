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
        Route::group(['prefix' => 'setting'], function(){
            Route::get('', [Modules\Setting\Http\Controllers\Web\V1\SettingController::class, 'index'])->name('admin.v1.setting.index');
            Route::post('store', [Modules\Setting\Http\Controllers\Web\V1\SettingController::class, 'store'])->name('admin.v1.setting.store');
            Route::put('update', [Modules\Setting\Http\Controllers\Web\V1\SettingController::class, 'update'])->name('admin.v1.setting.update');
        });
    });
});