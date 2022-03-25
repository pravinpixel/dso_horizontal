<?php
include('auth.php');
include('master.php');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialProductsController;


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
     

    // Change Product Category
    
    Route::post('/change-product-category', [MaterialProductsController::class, 'change_product_category'])->name('change-product-category');

    // Add MaterialProduct  Form ONE
    Route::get('/material-products-mandatory-form-one', [MaterialProductsController::class, 'form_one_index'])->name('mandatory-form-one');
    Route::post('/material-products-mandatory-form-one', [MaterialProductsController::class, 'form_one_store'])->name('mandatory-form-one');

    // Add MaterialProduct  Form TWO
    Route::get('/material-products-mandatory-form-two', [MaterialProductsController::class, 'form_two_index'])->name('mandatory-form-two');
    Route::post('/material-products-mandatory-form-two', [MaterialProductsController::class, 'form_two_store'])->name('mandatory-form-two');

    // Add MaterialProducts Non Mandatory Fom
    Route::get('/add-material-products-non-mandatory-form', [MaterialProductsController::class, 'non_mandatory_form_index'])->name('non-mandatory-form');
    Route::post('/add-material-products-non-mandatory-form', [MaterialProductsController::class, 'non_mandatory_form_store'])->name('non-mandatory-form');
 
});
 