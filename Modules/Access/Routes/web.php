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

// Route::group(['prefix' => 'admin'],function(){
Route::group(['prefix' => 'admin', 'middleware' => ['auth','app']],function(){
    Route::group(['prefix' => 'access'], function(){
        Route::group(['prefix' => 'role'], function(){
            Route::get('',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'index'])->name('admin.access.role.index');
            Route::get('create',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'create'])->name('admin.access.role.create');
            Route::post('store',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'store'])->name('admin.access.role.store');
            Route::get('{id}/edit',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'edit'])->name('admin.access.role.edit');
            Route::put('{id}/update',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'update'])->name('admin.access.role.update');    
            Route::delete('{id}/delete',[Modules\Access\Http\Controllers\V1\Web\RoleController::class, 'destroy'])->name('admin.access.role.destroy');    
            Route::group(['prefix' => 'access'], function(){
                Route::get('{id}',[Modules\Access\Http\Controllers\V1\Web\RoleAccessController::class, 'index'])->name('admin.access.role.access.index');
                Route::get('assign/{role}/{access}',[Modules\Access\Http\Controllers\V1\Web\RoleAccessController::class, 'assign'])->name('admin.access.role.access.assign');
                Route::post('assignall/{role}',[Modules\Access\Http\Controllers\V1\Web\RoleAccessController::class, 'assignall'])->name('admin.access.role.access.assignall');
                Route::post('revokeall/{role}',[Modules\Access\Http\Controllers\V1\Web\RoleAccessController::class, 'revokeall'])->name('admin.access.role.access.revokeall');
            });
        });
        Route::group(['prefix' => 'access'], function(){
            Route::get('',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'index'])->name('admin.access.access.index');
            Route::get('create',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'create'])->name('admin.access.access.create');
            Route::post('store',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'store'])->name('admin.access.access.store');
            Route::get('{id}/edit',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'edit'])->name('admin.access.access.edit');
            Route::put('{id}/update',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'update'])->name('admin.access.access.update');    
            Route::get('{id}/delete',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'destroy'])->name('admin.access.access.destroy');    
            // Route::delete('{id}/delete',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'destroy'])->name('admin.access.access.destroy');    
            Route::get('status/{access}',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'status'])->name('admin.access.access.status');
            Route::post('activateall',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'activateall'])->name('admin.access.access.activateall');
            Route::post('inactivateall',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'inactivateall'])->name('admin.access.access.inactivateall');
            Route::post('deleteall',[Modules\Access\Http\Controllers\V1\Web\AccessController::class, 'deleteall'])->name('admin.access.access.deleteall');
        });
        Route::group(['prefix' => 'user'], function(){
            Route::get('',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'index'])->name('admin.access.user.index');
            Route::get('create',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'create'])->name('admin.access.user.create');
            Route::post('store',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'store'])->name('admin.access.user.store');
            Route::get('{id}/edit',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'edit'])->name('admin.access.user.edit');
            Route::put('{id}/update',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'update'])->name('admin.access.user.update');
            Route::delete('{id}/delete',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'destroy'])->name('admin.access.user.destroy');    
            Route::get('{id}/file',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'file'])->name('admin.access.user.file');
        });
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']],function(){
    Route::group(['prefix' => 'access'], function(){
        Route::group(['prefix' => 'user'], function(){
            Route::get('{id}',[Modules\Access\Http\Controllers\V1\Web\UserController::class, 'image'])->name('admin.access.user.image');
        });
    });
});
// Route::get('/', function () {
//     return view('welcome');
//     //return view('backend.pages.dashboard');
// });

// Route::resource('category', 'CategoryController');
// Route::resource('post', 'PostController');
// Route::resource('comment', 'CommentController');
// Route::resource('posttag', 'PostTagController');
// Route::resource('tag', 'TagController');
