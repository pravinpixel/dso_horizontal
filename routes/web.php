<?php

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

Route::get('/', function () {   
    return view('auth.login');  
});

Route::get('/dashboard', function () {   
    return view('crm.dashboard.index');  
})->name('dashboard');

Route::get('/list-material-products', function () {   
    return view('crm.material-products.list');  
})->name('list-material-products');

Route::get('/withdrawal-material-products', function () {   
    return view('crm.material-products.withdrawal');  
})->name('withdrawal-material-products');

Route::get('/disposal', function () {   
    return view('crm.disposal.index');  
})->name('disposal');

 