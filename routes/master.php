<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\MasterController;
    use App\Http\Controllers\UserController;

Route::middleware(['auth_users'])->group(function () {
    Route::get('/item-description', [MasterController::class, 'index'])->name('master-settings');
    Route::get('/get_masters', [MasterController::class, 'get_masters'])->name('get_masters');
    Route::get('/master-settings', [MasterController::class, 'index'])->name('master.item-description'); 
    Route::post('/create-settings', [MasterController::class, 'store_master'])->name('master.store.category');
    Route::post('/update-settings', [MasterController::class, 'update_master'])->name('master.update.category');
    Route::post('/delete-setting/{id}', [MasterController::class, 'delete_master'])->name('master.delete.category');
    Route::post('/edit-setting/{id}', [MasterController::class, 'edit_master'])->name('master.edit.category');


    // User Routes 

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');


});