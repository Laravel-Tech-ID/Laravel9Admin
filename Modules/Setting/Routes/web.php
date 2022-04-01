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
// Route::group(['prefix' => 'admin'],function(){
    Route::group(['prefix' => 'setting'], function(){
        Route::get('', [Modules\Setting\Http\Controllers\V1\Web\SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('store', [Modules\Setting\Http\Controllers\V1\Web\SettingController::class, 'store'])->name('admin.setting.store');
        Route::put('update', [Modules\Setting\Http\Controllers\V1\Web\SettingController::class, 'update'])->name('admin.setting.update');
    });
});