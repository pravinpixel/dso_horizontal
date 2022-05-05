<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box"> 
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">DSO</a></li>
                      
                        @if (Route::is(['list-material-products','withdrawal-material-products','mandatory-form-one','mandatory-form-two','non-mandatory-form']))
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Material/In-house Product</a></li>
                        @endif
                        @if (Route::is(['threshold-qty','near-expiry-expired']))
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notification</a></li>
                        @endif
                        @if (Route::is(['mandatory-form-one','mandatory-form-two','non-mandatory-form']))
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Search or Add</a></li>
                        @endif
                        <li class="breadcrumb-item active">
                            {{ Route::is('dashboard') ? "Dashboard" : "" }}
                            {{ Route::is('list-material-products') ? "Search or Add" : "" }}
                            {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product" : "" }}
                            {{ Route::is('disposal') ? "Early Disposal" : "" }}
                            {{ Route::is('print-barcode') ? "Print Label" : "" }}
                            {{ Route::is(['reconsolidation','view-reconsolidation']) ? "Reconciliation" : "" }}
                            {{ Route::is('reports') ? "Reports" : "" }}
                            {{ Route::is('list-search') ? "List Search" : "" }}
                            {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                            {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                            {{ Route::is('near-expiry-expired') ? "Near Expiry / Expired / Failed IQC " : "" }}
                            {{ Route::is(['user-access']) ? "User Access" : "" }}
                            {{ Route::is([
                                'master-settings',
                                'get_masters',
                                'master.item-description',
                                'master.edit.category',
                                'user.index',
                                'user.create',
                                'user.edit',
                                'role.index',
                                'role.create',
                                'role.edit',
                                'permission.index',
                                'help.menu.index','help.menu.create','help.menu.edit'
                            ]) ? "Master Settings" : "" }}

                            {{ Route::is(['help.index','help.document']) ? "Help Menu" : "" }}
                            {{ Route::is('disposed-items') ? "Disposed Materials/In-house Products" : "" }}
                           
                            {{ Route::is('create.material-product') ? "Add Materials / In-house Product" : "" }}
                            {{ Route::is('edit.material-product') ? "Edit Materials / In-house Product" : "" }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    {{ Route::is('dashboard') ? "Dashboard" : "" }}
                    {{ Route::is('list-material-products') ? "Search or Add" : "" }}
                    {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product " : "" }}
                    {{ Route::is('disposal') ? "Early Disposal" : "" }}
                    {{ Route::is('print-barcode') ? "Print Label  " : "" }}
                    {{ Route::is(['reconsolidation','view-reconsolidation']) ? "Reconciliation" : "" }}
                    {{ Route::is('reports') ? "Reports" : "" }}
                    {{ Route::is('list-search') ? "List Search" : "" }}
                    {{ Route::is('extend-expiry') ? "Extend Expiry" : "" }}
                    {{ Route::is('threshold-qty') ? "Threshold Qty" : "" }}
                    {{ Route::is('near-expiry-expired') ? "Near Expiry / Expired / Failed IQC " : "" }} 
                    {{ Route::is(['user-access']) ? "User Access" : "" }}
                    {{ Route::is([
                        'master-settings',
                        'get_masters',
                        'master.item-description',
                        'master.edit.category',
                        'user.index',
                        'user.create',
                        'user.edit',
                        'role.index',
                        'role.create',
                        'role.edit',
                        'permission.index',
                        'help.menu.index','help.menu.create','help.menu.edit'
                    ]) ? "Master Settings" : "" }}
                    {{ Route::is(['help.index','help.document']) ? "Help Menu" : "" }}
                    {{ Route::is('disposed-items') ? "Disposed Materials/In-house Products" : "" }}

                    {{ Route::is('create.material-product') ? "Add Materials / In-house Product" : "" }}
                    {{ Route::is('edit.material-product') ? "Edit Materials / In-house Product" : "" }}

                </h4>
            </div>
        </div>
    </div>  
</div>