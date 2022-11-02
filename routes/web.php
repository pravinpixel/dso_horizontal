<?php
include('auth.php');
include('master.php'); 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialProductsController;
use App\Http\Controllers\Admin\HelpMenuController;
use App\Http\Controllers\EarlyDisposalController;
use App\Http\Controllers\ExtendExpiryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrintBarcodeController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ReconciliationController;
use App\Http\Controllers\RepackBatchController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TransferBatchController;
use App\Http\Controllers\WithdrawalController; 

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
     

    Route::get('/help-menu', [HelpMenuController::class, 'help_index'])->name('help.index'); 
    Route::get('/help-document/{id}', [HelpMenuController::class, 'show_document'])->name('help.document'); 
 

    Route::get('/reconciliation', [ReconciliationController::class,'index'])->name('reconciliation');
    Route::get('/reconciliation/list', [ReconciliationController::class,'show'])->name('view-reconciliation');
    Route::post('/reconciliation/download', [ReconciliationController::class,'download'])->name('reconciliation.download'); 
    Route::post('/reconciliation/store', [ReconciliationController::class,'ReconciliationImportUpdate'])->name('reconciliation.store'); 
    Route::post('/reconciliation/update/{id}', [ReconciliationController::class,'ReconciliationUpdate'])->name('reconciliation.update'); 
    Route::delete('/reconciliation/destroy/{id}', [ReconciliationController::class,'destroy'])->name('reconciliation.destroy'); 

    
 
      
    Route::get('disposed-items', function () {
        return view('crm.notification.disposed-items');  
    })->name('disposed-items');

    //  Listing Page
    Route::get('/get-save-search', [MaterialProductsController::class, 'my_search_history'])->name('get-save-search');
    Route::post('/get-save-search', [MaterialProductsController::class, 'save_search_history'])->name('get-save-search');
    Route::delete('/get-save-search/{id?}', [MaterialProductsController::class, 'delete_search_history'])->name('get-save-search');
    Route::get('/search-or-add', [MaterialProductsController::class, 'list_index'])->name('list-material-products');
  
    Route::post('/import_excel', [MaterialProductsController::class, 'import_excel'])->name('import_data');

    //  Get Material OR Products  List
    Route::get('/get-material-products', [MaterialProductsController::class, 'index'])->name('get-material-products');
    Route::post('/get-material-products', [MaterialProductsController::class, 'index'])->name('get-material-products');

    // Get Material Bathes Data
    Route::get('/get-material-batch/{batch?}', [MaterialProductsController::class, 'view_batch'])->name('get-batch-material-products');
    Route::get('/get-batch/{batch?}', [MaterialProductsController::class, 'show_batch'])->name('get-batch');
    Route::get('/view-batch/{batch?}', [MaterialProductsController::class, 'viewBatch'])->name('view-batch');

    // Advanced Search
    Route::get('/get-material-products/advanced-search', [MaterialProductsController::class, 'advanced_search'])->name('get-material-products-advanced-search');
    Route::post('/get-material-products/advanced-search', [MaterialProductsController::class, 'advanced_search'])->name('get-material-products-advanced-search');
 

    Route::post('/delete-material-products/{id?}', [MaterialProductsController::class, 'destroy'])->name('delete-material-products');
    Route::post('/delete-material-products-batch/{id?}', [MaterialProductsController::class, 'batch_destroy'])->name('delete-material-products-batch');


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

    // Add MaterialProducts Non Mandatory Fom
    Route::get('/add-material-products-other-form', [MaterialProductsController::class, 'other_form_index'])->name('other-form');
    Route::post('/add-material-products-other-form', [MaterialProductsController::class, 'other_form_store'])->name('other-form');
    
    //  ==================================

    // Create MaterialProduct 
    Route::get('/material-product/create/{type?}', [MaterialProductsController::class, 'wizardFormView'])->name('create.material-product');
    Route::post('/material-product/create/{type?}', [MaterialProductsController::class, 'storeWizardForm'])->name('create.material-product');

    // Edit  MaterialProduct 
    Route::get('/material-product/{type?}/{wizard_mode?}/{id?}/batch/{batch_id?}/{is_parent?}', [MaterialProductsController::class, 'wizardFormView'])->name('edit_or_duplicate.material-product');
    Route::post('/material-product/{type?}/{wizard_mode?}/{id?}/batch/{batch_id?}/{is_parent?}', [MaterialProductsController::class, 'storeWizardForm'])->name('edit_or_duplicate.material-product');

    // Transfer Batches
    Route::post('/transfer-batch', [TransferBatchController::class, 'transfer'])->name('transfer-batch');
    Route::post('/repack-batch', [RepackBatchController::class, 'repack'])->name('repack-batch');
    

    // ===================== Print Label ===================== 
        Route::get('/print-label', [PrintBarcodeController::class, 'index'])->name('print-barcode'); 
        Route::get('/print-label/{id?}', [PrintBarcodeController::class, 'show'])->name('print-barcode'); 
        Route::post('/print-label/{id?}', [PrintBarcodeController::class, 'print'])->name('print-barcode'); 
    // ===================== Print Label =====================

    // ==================== Repack Draw IN / OUT Flow ===============
        Route::get('/repack-batch/{batch_id}', [RepackBatchController::class, 'get_repack_outlife'])->name('repack_outlife'); 
        Route::post('/repack-batch/{batch_id}', [RepackBatchController::class, 'repack_outlife'])->name('repack_outlife');
        // Route::get('/repack-batch/{batch_id}', [RepackBatchController::class, 'get_repack_outlife'])->name('repack_outlife'); 

        Route::post('/store-repack-batch/{batch_id}', [RepackBatchController::class, 'store_repack_outlife'])->name('store_repack_outlife');
        Route::get('/export-repack-batch/{batch_id}', [RepackBatchController::class, 'export_repack_outlife'])->name('export_repack_outlife');
        
    // ==================== Repack Draw IN / OUT Flow ===============

    // Word Suggestion 
    Route::post('/get-suggestion', [MaterialProductsController::class, 'suggestion'])->name('suggestion');
    Route::get('/duplicate-batch/{id}', [MaterialProductsController::class, 'duplicate_batch'])->name('duplicate_batch');

    
    Route::prefix('withdrawal')->group(function() {
        Route::get('/material-are-in-house-products', [WithdrawalController::class, 'index'])->name('withdrawal_index'); 
        Route::post('/withdrawal-direct-deduct', [WithdrawalController::class, 'direct_deduct'])->name('direct-deduct');
        Route::post('/withdrawal-deduct-track-usage', [WithdrawalController::class, 'deduct_track_usage'])->name('deduct-track-usage');
        Route::post('/withdrawal-deduct-track-outlife', [WithdrawalController::class, 'deduct_track_outlife'])->name('deduct-track-outlife');
    });
    
    Route::get('/decrease-quantity/{id}', [WithdrawalController::class, 'decrease_quantity'])->name('decrease-quantity');
    Route::get('/get-withdrawal-data/{type}', [WithdrawalController::class, 'get_withdrawal_data'])->name('get-withdrawal_data');
    Route::get('/delete-withdraw-cart/{id}', [WithdrawalController::class, 'delete_withdraw_cart'])->name('delete-withdraw_cart');
    Route::get('/get-withdraw-cart-count', [WithdrawalController::class, 'withdraw_cart_count'])->name('withdraw-cart-count');
    Route::get('/get-withdrawal-batches/{barcode?}', [WithdrawalController::class, 'withdrawal_indexing'])->name('withdrawal-indexing');

    Route::prefix('notification')->group(function() {
        Route::get('threshold-qty', [NotificationController::class,'threshold_index'])->name('threshold-qty');
        Route::post('change-read-status/{batch_id?}', [NotificationController::class,'change_read_status'])->name('change-read-status');
        Route::get('/near-expiry-expired',[NotificationController::class,'near_expiry_expired_index'])->name('near-expiry-expired'); 
    });
    Route::get('NotificationCount',[NotificationController::class,'notification_count']);


    
    Route::get('/near-expiry-expired-ajax/{type?}',[NotificationController::class,'near_expiry_expired_ajax'])->name('near_expiry_expired_ajax'); 

    Route::get('extend-expiry/{id?}', [ExtendExpiryController::class,'index'])->name('extend-expiry');
    Route::get('/get-extend-expiry/{id?}', [ExtendExpiryController::class,'show']);
    Route::post('/extend-expiry/{id?}', [ExtendExpiryController::class,'update'])->name('update.extend-expiry');
    
    Route::get('disposal/{id?}', [EarlyDisposalController::class,'index'])->name('disposal');
    Route::get('/get-disposal-expiry/{id?}', [EarlyDisposalController::class,'show']); 
    Route::post('/disposal/{id?}', [EarlyDisposalController::class,'disposal_update'])->name('update.disposal'); 

    Route::get('reports', [ReportsController::class,'utilisation_cart'])->name('reports'); 
    Route::get('reports/utilisation-cart', [ReportsController::class,'utilisation_cart'])->name('reports.utilisation_cart'); 
    Route::get('reports/export-cart', [ReportsController::class,'export_cart'])->name('reports.export_cart'); 
    Route::get('reports/history', [ReportsController::class,'history'])->name('reports.history'); 
    Route::get('reports/disposed-items', [ReportsController::class,'disposed_items'])->name('reports.disposed_items'); 
    Route::get('reports/export', [ReportsController::class,'export'])->name('reports.export'); 

    Route::resource('/product-cart', ProductCartController::class); 
    Route::get('/get-product-cart',[ ProductCartController::class,'index']); 
});