<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        Route::group(['prefix' => 'access'], function(){
            Route::group(['prefix' => 'role'], function(){
                Route::get('',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'index'])->name('admin.v1.access.role.index');
                Route::get('create',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'create'])->name('admin.v1.access.role.create');
                Route::post('store',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'store'])->name('admin.v1.access.role.store');
                Route::get('{id}/edit',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'edit'])->name('admin.v1.access.role.edit');
                Route::put('{id}/update',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'update'])->name('admin.v1.access.role.update');    
                Route::delete('{id}/delete',[Modules\Access\Http\Controllers\Web\V1\RoleController::class, 'destroy'])->name('admin.v1.access.role.destroy');    
                Route::group(['prefix' => 'access'], function(){
                    Route::get('{id}',[Modules\Access\Http\Controllers\Web\V1\RoleAccessController::class, 'index'])->name('admin.v1.access.role.access.index');
                    Route::get('assign/{role}/{access}',[Modules\Access\Http\Controllers\Web\V1\RoleAccessController::class, 'assign'])->name('admin.v1.access.role.access.assign');
                    Route::post('assignall/{role}',[Modules\Access\Http\Controllers\Web\V1\RoleAccessController::class, 'assignall'])->name('admin.v1.access.role.access.assignall');
                    Route::post('revokeall/{role}',[Modules\Access\Http\Controllers\Web\V1\RoleAccessController::class, 'revokeall'])->name('admin.v1.access.role.access.revokeall');
                });
            });
            Route::group(['prefix' => 'access'], function(){
                Route::get('',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'index'])->name('admin.v1.access.access.index');
                Route::get('create',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'create'])->name('admin.v1.access.access.create');
                Route::post('store',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'store'])->name('admin.v1.access.access.store');
                Route::get('{id}/edit',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'edit'])->name('admin.v1.access.access.edit');
                Route::put('{id}/update',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'update'])->name('admin.v1.access.access.update');    
                Route::get('{id}/delete',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'destroy'])->name('admin.v1.access.access.destroy');    
                // Route::delete('{id}/delete',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'destroy'])->name('admin.v1.access.access.destroy');    
                Route::get('status/{access}',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'status'])->name('admin.v1.access.access.status');
                Route::post('activateall',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'activateall'])->name('admin.v1.access.access.activateall');
                Route::post('inactivateall',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'inactivateall'])->name('admin.v1.access.access.inactivateall');
                Route::post('deleteall',[Modules\Access\Http\Controllers\Web\V1\AccessController::class, 'deleteall'])->name('admin.v1.access.access.deleteall');
            });
            Route::group(['prefix' => 'user'], function(){
                Route::get('',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'index'])->name('admin.v1.access.user.index');
                Route::get('create',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'create'])->name('admin.v1.access.user.create');
                Route::post('store',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'store'])->name('admin.v1.access.user.store');
                Route::get('{id}/edit',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'edit'])->name('admin.v1.access.user.edit');
                Route::put('{id}/update',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'update'])->name('admin.v1.access.user.update');
                Route::delete('{id}/delete',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'destroy'])->name('admin.v1.access.user.destroy');    
                Route::get('{id}/file',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'file'])->name('admin.v1.access.user.file');
            });
        });
    });
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth']],function(){
    Route::group(['prefix' => 'v1'],function(){
        Route::group(['prefix' => 'access'], function(){
            Route::group(['prefix' => 'user'], function(){
                Route::get('{id}',[Modules\Access\Http\Controllers\Web\V1\UserController::class, 'image'])->name('admin.v1.access.user.image');
            });
        });
    });
});