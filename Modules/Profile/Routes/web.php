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
        Route::group(['prefix' => 'profile'], function(){
            Route::get('edit',[Modules\Profile\Http\Controllers\Web\V1\ProfileController::class, 'edit'])->name('admin.v1.profile.edit');
            Route::put('update',[Modules\Profile\Http\Controllers\Web\V1\ProfileController::class, 'update'])->name('admin.v1.profile.update');
            Route::get('{id}/delete',[Modules\Profile\Http\Controllers\Web\V1\ProfileController::class, 'destroy'])->name('admin.v1.profile.destroy');
            Route::get('{id}/file',[Modules\Profile\Http\Controllers\Web\V1\ProfileController::class, 'file'])->name('admin.v1.profile.file');
        });
    });
});
