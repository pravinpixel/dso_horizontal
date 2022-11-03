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
    Route::prefix('data-center')->group(function () {
        Route::get('/master-settings', [MasterController::class, 'index'])->name('master.item-description'); 
        Route::post('/create-settings', [MasterController::class, 'store_master'])->name('master.store.category');
        Route::post('/edit-setting/{id?}', [MasterController::class, 'edit_master'])->name('master.edit.category');
        Route::post('/delete-setting/{id?}', [MasterController::class, 'delete_master'])->name('master.delete.category');
    });
    Route::get('/', [MasterController::class, 'index'])->name('master-settings');
    Route::post('/update-settings', [MasterController::class, 'update_master'])->name('master.update.category');

    Route::get('/get_masters', [MasterController::class, 'get_masters'])->name('get_masters');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update'); 
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
     
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit'); 
    }); 
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update'); 
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
 
    Route::prefix('help')->group(function () {
        Route::get('/', [HelpMenuController::class, 'index'])->name('help.menu.index');
        Route::get('/create', [HelpMenuController::class, 'create'])->name('help.menu.create');
        Route::get('/edit/{id}', [HelpMenuController::class, 'edit'])->name('help.menu.edit');
        Route::post('/delete/{id}', [HelpMenuController::class, 'delete'])->name('help.menu.delete');
    });
    Route::post('/', [HelpMenuController::class, 'store'])->name('help.menu.store');
    Route::post('/edit/{id}', [HelpMenuController::class, 'update'])->name('help.menu.update');


    Route::prefix('pictogram')->group(function () {
        Route::get('/', [PictogramController::class, 'index'])->name('pictogram.index');
        Route::get('/create', [PictogramController::class, 'create'])->name('pictogram.create');
        Route::get('/{id?}', [PictogramController::class, 'edit'])->name('pictogram.edit');
        Route::post('/delete/{id?}', [PictogramController::class, 'destroy'])->name('pictogram.delete');
    }); 
    Route::put('/{id?}', [PictogramController::class, 'update'])->name('pictogram.update');
    Route::post('/create', [PictogramController::class, 'store'])->name('pictogram.store');

    // Table Order
    Route::get('/table-order', [TableOrderController::class, 'index'])->name('table-order.index');
    Route::post('/table-order', [TableOrderController::class, 'store'])->name('table-order.store');
});