<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController; 
Route::controller(PermissionController::class)->group(function () { 
    Route::post('/role-permission', 'store')->name('store.permission');
});
 