<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterController;

Route::middleware(['auth_users'])->group(function () {
    Route::get('/item-description', [MasterController::class, 'index'])->name('master-settings');

    Route::get('/get_masters', [MasterController::class, 'get_masters'])->name('get_masters');


    Route::get('/master-settings', [MasterController::class, 'index'])->name('master.item-description'); 

    Route::post('/create-settings', [MasterController::class, 'store_master'])->name('master.store.category');
    Route::post('/update-settings', [MasterController::class, 'update_master'])->name('master.update.category');
    Route::post('/delete-setting/{id}', [MasterController::class, 'delete_master'])->name('master.delete.category');
    Route::post('/edit-setting/{id}', [MasterController::class, 'edit_master'])->name('master.edit.category');
});