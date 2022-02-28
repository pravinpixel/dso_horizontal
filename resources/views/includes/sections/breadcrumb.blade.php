<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box"> 
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">DSO</a></li>
                        <li class="breadcrumb-item active">
                            {{ Route::is('dashboard') ? "Dashboard" : "" }}
                            {{ Route::is('list-material-products') ? "List Material / In-house product" : "" }}
                            {{ Route::is('withdrawal-material-products') ? "Withdraw Material/Product " : "" }}
                            {{ Route::is('disposal') ? "Disposal" : "" }}
                            {{ Route::is('print-barcode') ? "Print Barcode" : "" }}
                            {{ Route::is('reconsolidation') ? "Reconciliation" : "" }}
                            {{ Route::is('reports') ? "Reports" : "" }}
                            {{ Route::is('list-search') ? "List Search" : "" }}
                            {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                            {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                            {{ Route::is('near-expiry-expired') ? "Near Expiry/Expired Material/Product" : "" }}
                            {{ Route::is('ui-demo') ? "UI DEMOS" : "" }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    {{ Route::is('dashboard') ? "Dashboard" : "" }}
                    {{ Route::is('list-material-products') ? "List Material / In-house product" : "" }}
                    {{ Route::is('withdrawal-material-products') ? "Withdraw Material/Product " : "" }}
                    {{ Route::is('disposal') ? "Disposal" : "" }}
                    {{ Route::is('print-barcode') ? "Print Barcode / Label" : "" }}
                    {{ Route::is('reconsolidation') ? "Reconciliation" : "" }}
                    {{ Route::is('reports') ? "Reports" : "" }}
                    {{ Route::is('list-search') ? "List Search" : "" }}
                    {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                    {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                    {{ Route::is('near-expiry-expired') ? "Near Expiry/Expired Material/Product" : "" }}
                    {{ Route::is('ui-demo') ? "UI DEMOS" : "" }}
                </h4>
            </div>
        </div>
    </div>  
</div>