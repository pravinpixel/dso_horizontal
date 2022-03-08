<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box"> 
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">DSO</a></li>
                      
                        @if (Route::is(['list-material-products','withdrawal-material-products']))
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Material/In-house Product</a></li>
                        @endif
                        @if (Route::is(['threshold-qty','near-expiry-expired']))
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Notification</a></li>
                        @endif
                        <li class="breadcrumb-item active">
                            {{ Route::is('dashboard') ? "Dashboard" : "" }}
                            {{ Route::is('list-material-products') ? "Search or Add" : "" }}
                            {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product" : "" }}
                            {{ Route::is('disposal') ? "Early Disposal" : "" }}
                            {{ Route::is('print-barcode') ? "Print Barcode" : "" }}
                            {{ Route::is('reconsolidation') ? "Reconciliation" : "" }}
                            {{ Route::is('reports') ? "Reports" : "" }}
                            {{ Route::is('list-search') ? "List Search" : "" }}
                            {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                            {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                            {{ Route::is('near-expiry-expired') ? "Near Expiry/Expired " : "" }}
                            {{ Route::is('ui-demo') ? "UI DEMOS" : "" }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    {{ Route::is('dashboard') ? "Dashboard" : "" }}
                    {{ Route::is('list-material-products') ? "Search or Add" : "" }}
                    {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product " : "" }}
                    {{ Route::is('disposal') ? "Early Disposal" : "" }}
                    {{ Route::is('print-barcode') ? "Print Barcode / Label" : "" }}
                    {{ Route::is('reconsolidation') ? "Reconciliation" : "" }}
                    {{ Route::is('reports') ? "Reports" : "" }}
                    {{ Route::is('list-search') ? "List Search" : "" }}
                    {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                    {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                    {{ Route::is('near-expiry-expired') ? "Near Expiry/Expired " : "" }}
                    {{ Route::is('ui-demo') ? "UI DEMOS" : "" }}
                </h4>
            </div>
        </div>
    </div>  
</div>