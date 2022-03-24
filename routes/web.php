<?php
include('auth.php');
include('master.php');
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth_users'])->group(function () {
    Route::get('/dashboard', function () {   
        return view('crm.dashboard.index');  
    })->name('dashboard');
    Route::get('/list-material-products', function () {   
        return view('crm.material-products.list');  
    })->name('list-material-products');
    
    Route::get('/add-material-products-mandatory-form-one', function () {   
        return view('crm.material-products.wizard.mandatory-one');  
    })->name('mandatory-form-one');
    
    Route::get('/add-material-products-mandatory-form-two', function () {   
        return view('crm.material-products.wizard.mandatory-two');  
    })->name('mandatory-form-two');
    
    Route::get('/add-material-products-non-mandatory-form', function () {   
        return view('crm.material-products.wizard.non-mandatory');  
    })->name('non-mandatory-form');
    
    Route::get('/withdrawal-material-products', function () {   
        return view('crm.material-products.withdrawal');  
    })->name('withdrawal-material-products');
    
    Route::get('/disposal', function () {   
        return view('crm.disposal.index');  
    })->name('disposal');
    
    Route::get('/print-barcode', function () {   
        return view('crm.print-barcode.index');  
    })->name('print-barcode');
    
    Route::get('/reconciliation', function () {   
        return view('crm.reconsolidation.index');  
    })->name('reconsolidation');
    
    Route::get('/view-reconciliation', function () {   
        return view('crm.reconsolidation.view');  
    })->name('view-reconsolidation');
    
    Route::get('/reports', function () {   
        return view('crm.reports.index');  
    })->name('reports');
    
    Route::get('/extend-expiry', function () {   
        return view('crm.extend-expiry.index');  
    })->name('extend-expiry');
    
    Route::get('/threshold-qty', function () {   
        return view('crm.notification.threshold-qty');  
    })->name('threshold-qty');
    
    Route::get('/near-expiry-expired', function () {   
        return view('crm.notification.near-expiry-expired');  
    })->name('near-expiry-expired');
     
});
 