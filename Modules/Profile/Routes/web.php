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
    Route::group(['prefix' => 'profile'], function(){
        Route::get('edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('update',[Modules\Profile\Http\Controllers\V1\Web\ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileController::class, 'destroy'])->name('admin.profile.destroy');
        Route::get('{id}/file',[Modules\Profile\Http\Controllers\V1\Web\ProfileController::class, 'file'])->name('admin.profile.file');
        Route::group(['prefix' => 'personal'], function(){
            Route::get('/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfilePersonalController::class, 'edit'])->name('admin.profile.personal.edit');
            Route::put('/update',[Modules\Profile\Http\Controllers\V1\Web\ProfilePersonalController::class, 'update'])->name('admin.profile.personal.update');
            Route::get('{id}/file',[Modules\Profile\Http\Controllers\V1\Web\ProfilePersonalController::class, 'file'])->name('admin.profile.personal.file');
        });
        Route::group(['prefix' => 'ahli'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'index'])->name('admin.profile.ahli.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'create'])->name('admin.profile.ahli.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'store'])->name('admin.profile.ahli.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'edit'])->name('admin.profile.ahli.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'update'])->name('admin.profile.ahli.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'destroy'])->name('admin.profile.ahli.destroy');        
            Route::get('/{id}/file',[Modules\Profile\Http\Controllers\V1\Web\ProfileAhliController::class, 'file'])->name('admin.profile.ahli.file');
        });
        Route::group(['prefix' => 'bea'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'index'])->name('admin.profile.bea.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'create'])->name('admin.profile.bea.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'store'])->name('admin.profile.bea.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'edit'])->name('admin.profile.bea.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'update'])->name('admin.profile.bea.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileBeaController::class, 'destroy'])->name('admin.profile.bea.destroy');        
        });
        Route::group(['prefix' => 'alamat'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'index'])->name('admin.profile.alamat.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'create'])->name('admin.profile.alamat.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'store'])->name('admin.profile.alamat.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'edit'])->name('admin.profile.alamat.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'update'])->name('admin.profile.alamat.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileAlamatController::class, 'destroy'])->name('admin.profile.alamat.destroy');        
        });
        Route::group(['prefix' => 'didik'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'index'])->name('admin.profile.didik.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'create'])->name('admin.profile.didik.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'store'])->name('admin.profile.didik.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'edit'])->name('admin.profile.didik.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'update'])->name('admin.profile.didik.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileDidikController::class, 'destroy'])->name('admin.profile.didik.destroy');        
        });
        Route::group(['prefix' => 'hobi'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'index'])->name('admin.profile.hobi.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'create'])->name('admin.profile.hobi.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'store'])->name('admin.profile.hobi.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'edit'])->name('admin.profile.hobi.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'update'])->name('admin.profile.hobi.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileHobiController::class, 'destroy'])->name('admin.profile.hobi.destroy');        
        });
        Route::group(['prefix' => 'kerja'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'index'])->name('admin.profile.kerja.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'create'])->name('admin.profile.kerja.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'store'])->name('admin.profile.kerja.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'edit'])->name('admin.profile.kerja.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'update'])->name('admin.profile.kerja.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileKerjaController::class, 'destroy'])->name('admin.profile.kerja.destroy');        
        });
        Route::group(['prefix' => 'ortu'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'index'])->name('admin.profile.ortu.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'create'])->name('admin.profile.ortu.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'store'])->name('admin.profile.ortu.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'edit'])->name('admin.profile.ortu.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'update'])->name('admin.profile.ortu.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileOrtuController::class, 'destroy'])->name('admin.profile.ortu.destroy');        
        });
        Route::group(['prefix' => 'prestasi'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'index'])->name('admin.profile.prestasi.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'create'])->name('admin.profile.prestasi.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'store'])->name('admin.profile.prestasi.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'edit'])->name('admin.profile.prestasi.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'update'])->name('admin.profile.prestasi.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'destroy'])->name('admin.profile.prestasi.destroy');        
            Route::get('/{id}/file',[Modules\Profile\Http\Controllers\V1\Web\ProfilePrestasiController::class, 'file'])->name('admin.profile.prestasi.file');
        });
        Route::group(['prefix' => 'sakit'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'index'])->name('admin.profile.sakit.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'create'])->name('admin.profile.sakit.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'store'])->name('admin.profile.sakit.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'edit'])->name('admin.profile.sakit.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'update'])->name('admin.profile.sakit.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileSakitController::class, 'destroy'])->name('admin.profile.sakit.destroy');        
        });
        Route::group(['prefix' => 'sehat'], function(){
            Route::get('',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'index'])->name('admin.profile.sehat.index');
            Route::get('/create',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'create'])->name('admin.profile.sehat.create');
            Route::post('/store',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'store'])->name('admin.profile.sehat.store');
            Route::get('/{id}/edit',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'edit'])->name('admin.profile.sehat.edit');
            Route::put('/{id}/update',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'update'])->name('admin.profile.sehat.update');    
            Route::delete('/{id}/delete',[Modules\Profile\Http\Controllers\V1\Web\ProfileSehatController::class, 'destroy'])->name('admin.profile.sehat.destroy');        
        });
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']],function(){
    Route::group(['prefix' => 'profile'], function(){
        Route::group(['prefix' => 'user'], function(){
            Route::get('{id}',[Modules\Access\Http\Controllers\V1\Web\ProfileSehatController::class, 'image'])->name('admin.profile.user.image');
        });
    });
});
