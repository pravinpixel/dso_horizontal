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
                            {{ Route::is('dashboard') ? "Dashboard" : null }}
                            {{ Route::is('list-material-products') ? "Search or Add" : null }}
                            {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product" : null }}
                            {{ Route::is('disposal') ? "Early Disposal" : null }}
                            {{ Route::is('barcode.listing') ? "Print Label" : null }}
                            {{ Route::is(['reconciliation','view-reconciliation']) ? "Reconciliation" : null }}
                            {{ Route::is(['reports','reports.utilisation_cart','reports.export_cart','reports.history','reports.disposed_items']) ? "Reports" : null }}

                            {{ Route::is('list-search') ? "List Search" : null }}
                            {{ Route::is('extend-expiry') ? "Extend Expiry" : null }}
                            {{ Route::is('threshold-qty') ? "Threshold Qty" : null }}
                            {{ Route::is('near-expiry-expired') ? "Near Expiry / Expired / Failed IQC " : null }}
                            {{ Route::is(['user-access']) ? "User Access" : null }}
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
                                'table-order.index',
                                'help.menu.index','help.menu.create','help.menu.edit'
                            ]) ? "Master Settings" : null }}

                            {{ Route::is(['help.index','help.document']) ? "Help Menu" : null }}
                            {{ Route::is('disposed-items') ? "Disposed Materials/In-house Products" : null }}
                           
                            {{ Route::is('create.material-product') ? "Add Materials / In-house Product" : null }}
                            {{ Request::route('wizard_mode') == 'edit' ? "Edit Materials / In-house Product" : null  }}
                            {{ Request::route('wizard_mode') == 'duplicate' ? "Duplicate Materials / In-house Product" : null  }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    {{ Route::is('dashboard') ? "Dashboard" : null }}
                    {{ Route::is('list-material-products') ? "Search or Add" : null }}
                    {{ Route::is('withdrawal-material-products') ? "Withdraw Material/In-house Product " : null }}
                    {{ Route::is('disposal') ? "Early Disposal" : null }}
                    {{ Route::is('barcode.listing') ? "Print Label  " : null }}
                    {{ Route::is(['reconciliation','view-reconciliation']) ? "Reconciliation" : null }}
                    {{ Route::is(['reports','reports.utilisation_cart','reports.export_cart','reports.history','reports.disposed_items']) ? "Reports" : null }}

                    {{ Route::is('list-search') ? "List Search" : null }}
                    {{ Route::is('extend-expiry') ? "Extend Expiry" : null }}
                    {{ Route::is('threshold-qty') ? "Threshold Qty" : null }}
                    {{ Route::is('near-expiry-expired') ? "Near Expiry / Expired / Failed IQC " : null }} 
                    {{ Route::is(['user-access']) ? "User Access" : null }}
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
                        'table-order.index',
                        'help.menu.index','help.menu.create','help.menu.edit'
                    ]) ? "Master Settings" : null }}
                    {{ Route::is(['help.index','help.document']) ? "Help Menu" : null }}
                    {{ Route::is('disposed-items') ? "Disposed Materials/In-house Products" : null }}

                    {{ Route::is('create.material-product') ? "Add Materials / In-house Product" : null }}
                    
                    {{ Request::route('wizard_mode') == 'edit' ? "Edit Materials / In-house Product" : null  }}
                    {{ Request::route('wizard_mode') == 'duplicate' ? "Duplicate Materials / In-house Product" : null  }}
                </h4>
            </div>
        </div>
    </div>  
</div>