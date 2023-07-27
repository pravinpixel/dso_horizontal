<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\HelpMenuController;
use App\Http\Controllers\Admin\PictogramController;
use App\Http\Controllers\Admin\TableOrderController;

Route::middleware(['auth_users'])->group(function () {
    Route::get('/settings', [MasterController::class, 'index'])->name('master-settings');

    Route::prefix('settings')->group(function () {
        Route::get('/table-order', [TableOrderController::class, 'index'])->name('table-order.index');
        Route::post('/table-order/store/{id?}', [TableOrderController::class, 'store'])->name('table-order.store');
        Route::post('/table-order/update-order', [TableOrderController::class, 'update_order'])->name('update-orderby');

        Route::get('/data-center', [MasterController::class, 'item_description'])->name('master.item-description');
        Route::post('/data-center/create', [MasterController::class, 'store_master'])->name('master.store.category');
        Route::post('/data-center/delete/{id?}', [MasterController::class, 'delete_master'])->name('master.delete.category');
        Route::post('/data-center/update', [MasterController::class, 'update_master'])->name('master.update.category');

        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/export', [UserController::class, 'export'])->name('user.export');
        Route::post('/users', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        
        Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
        Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        
        Route::get('/help', [HelpMenuController::class, 'index'])->name('help.menu.index');
        Route::get('/help/create', [HelpMenuController::class, 'create'])->name('help.menu.create');
        Route::get('/help/edit/{id}', [HelpMenuController::class, 'edit'])->name('help.menu.edit');
        Route::post('/help/delete/{id}', [HelpMenuController::class, 'delete'])->name('help.menu.delete');
        Route::post('/help/store', [HelpMenuController::class, 'store'])->name('help.menu.store');
        Route::post('/help/update/{id}', [HelpMenuController::class, 'update'])->name('help.menu.update'); 

        Route::get('/pictogram', [PictogramController::class, 'index'])->name('pictogram.index');
        Route::get('/pictogram/create', [PictogramController::class, 'create'])->name('pictogram.create');
        Route::get('/pictogram/{id?}', [PictogramController::class, 'edit'])->name('pictogram.edit');
        Route::post('/pictogram/delete/{id?}', [PictogramController::class, 'destroy'])->name('pictogram.delete');
        Route::put('pictogram/update/{id?}', [PictogramController::class, 'update'])->name('pictogram.update');
        Route::post('pictogram/store', [PictogramController::class, 'store'])->name('pictogram.store'); 

        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');


        Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
        Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/roles/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::post('/roles/permission', [PermissionController::class, 'store'])->name('permission.store'); 
       
    }); 

    Route::post('/edit-setting/{id?}', [MasterController::class, 'edit_master'])->name('master.edit.category');
    Route::get('/get_masters', [MasterController::class, 'get_masters'])->name('get_masters'); 
});
