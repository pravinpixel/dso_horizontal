<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\MasterController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\PermissionController; 
    use App\Http\Controllers\Admin\HelpMenuController;
    use App\Http\Controllers\Admin\PictogramController;

Route::middleware(['auth_users'])->group(function () {
    Route::get('/item-description', [MasterController::class, 'index'])->name('master-settings');
    Route::get('/get_masters', [MasterController::class, 'get_masters'])->name('get_masters');
    Route::get('/master-settings', [MasterController::class, 'index'])->name('master.item-description'); 
    Route::post('/create-settings', [MasterController::class, 'store_master'])->name('master.store.category');
    Route::post('/update-settings', [MasterController::class, 'update_master'])->name('master.update.category');
    Route::post('/delete-setting/{id?}', [MasterController::class, 'delete_master'])->name('master.delete.category');
    Route::post('/edit-setting/{id?}', [MasterController::class, 'edit_master'])->name('master.edit.category');


    // User Routes 
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user-delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user-update/{id}', function () {   
        return redirect()->back();
    })->name('user.update');


    // Role Routes 
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role-delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
    Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role-update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role-update/{id}', function () {   
        return redirect()->back();
    })->name('role.update');


    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
 
    Route::get('/help', [HelpMenuController::class, 'index'])->name('help.menu.index');
    Route::get('/help/create', [HelpMenuController::class, 'create'])->name('help.menu.create');
    Route::post('/help', [HelpMenuController::class, 'store'])->name('help.menu.store');
    Route::get('/edit/{id}', [HelpMenuController::class, 'edit'])->name('help.menu.edit');
    Route::post('/edit/{id}', [HelpMenuController::class, 'update'])->name('help.menu.update');
    Route::post('/delete/{id}', [HelpMenuController::class, 'delete'])->name('help.menu.delete');

    
    Route::get('/pictogram', [PictogramController::class, 'index'])->name('pictogram.index');
    Route::get('/pictogram/create', [PictogramController::class, 'create'])->name('pictogram.create');
    Route::post('/pictogram/create', [PictogramController::class, 'store'])->name('pictogram.store');
    Route::get('/pictogram/{id?}', [PictogramController::class, 'edit'])->name('pictogram.edit');
    Route::post('/pictogram/delete/{id?}', [PictogramController::class, 'destroy'])->name('pictogram.delete');
    Route::put('/pictogram/{id?}', [PictogramController::class, 'update'])->name('pictogram.update');
});