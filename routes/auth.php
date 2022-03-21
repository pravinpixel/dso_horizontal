<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

 
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout'); 
    Route::get('/register', 'registerIndex')->name('register');
    Route::post('/register', 'register')->name('register');
}); 