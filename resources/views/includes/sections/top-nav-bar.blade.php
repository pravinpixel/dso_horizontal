<div class="topnav shadow bg-primary position-relative">
    {{-- <div id="google_translate_element" style="position: absolute;top:15px;right: 10px;z-index: 11111;"></div> --}}
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu ">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav custom">
                    <x-has-access name="dashboard">
                        <li class="nav-item dropdown">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? "active" : "" }}"><i class="bi bi-speedometer2 me-1"></i><span>Dashboard</span></a>
                        </li>
                    </x-has-access> 
                    <x-has-access :name="['withdrawal_index','list-material-products']">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['material-product.edit-form-one','material-product.edit-form-two','material-product.edit-form-three']) ? "active" : "" }} {{ Route::is(['withdrawal_index','list-material-products','mandatory-form-one','mandatory-form-two','non-mandatory-form']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-briefcase me-1"></i> Material / In-house Product <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                <x-has-access name="withdrawal_index"> 
                                    <a href="{{ route('withdrawal_index') }}" class="dropdown-item {{ Route::is(['withdrawal_index']) ? "active" : "" }}"><i class="bi bi-aspect-ratio me-1"></i><span>Withdrawal</span></a>
                                </x-has-access>
                                <x-has-access name="list-material-products">
                                    <a href="{{ route('list-material-products') }}" class="dropdown-item {{ Route::is(['list-material-products']) ? "active" : "" }}"><i class="bi bi-plus-circle-dotted me-1"></i><span>Search or Add</span></a>
                                </x-has-access> 
                            </div>
                        </li>
                    </x-has-access>
                    <x-has-access :name="['threshold-qty','near-expiry-expired']">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['threshold-qty','near-expiry-expired']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-bell me-1"></i> Notification <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                <x-has-access name="threshold-qty">
                                    <a href="{{ route('threshold-qty') }}" class="dropdown-item {{ Route::is(['threshold-qty']) ? "active" : "" }}"><i class="bi bi-subtract me-1"></i><span>Threshold Qty</span></a>
                                </x-has-access>
                                <x-has-access name="near-expiry-expired">
                                    <a href="{{ route('near-expiry-expired') }}" class="dropdown-item {{ Route::is(['near-expiry-expired']) ? "active" : "" }}"><i class="bi bi-list-ul me-1"></i><span>Near Expiry / Expired / Failed IQC</span></a>
                                </x-has-access>
                            </div>
                        </li>
                    </x-has-access>
                    <x-has-access name="disposal">
                        <li class="nav-item dropdown">
                            <a href="{{ route('disposal') }}" class="nav-link {{ Route::is('disposal') ? "active" : "" }}"><i class="bi bi-trash2 me-1"></i><span>Early Disposal</span></a>
                        </li>
                    </x-has-access>
                    <x-has-access name="extend-expiry">
                        <li class="nav-item dropdown">
                            <a href="{{ route('extend-expiry') }}" class="nav-link {{ Route::is('extend-expiry') ? 'active' : '' }}"><i class="bi bi-arrow-up-right-square me-1"></i>Extended Expiry</a>
                        </li>
                    </x-has-access>
                    <x-has-access name="reports">
                        <li class="nav-item dropdown">
                            <a href="{{ route('reports') }}" class="nav-link {{ Route::is(['reports','reports.disposed_items','reports.expired_material','reports.security','reports.deduct_track_outlife','reports.deduct_track_usage','reports.material_in_house_pdt_history']) ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph me-1"></i>Report  </a>
                        </li>
                    </x-has-access>
                    <x-has-access name="barcode.listing">
                        <li class="nav-item dropdown">
                            <a href="{{ route('barcode.listing') }}" class="nav-link {{ Route::is('barcode.listing') ? 'active' : '' }}"><i class="bi bi-upc-scan me-1"></i>Print Label </a>
                        </li>
                    </x-has-access>
                    <x-has-access name="reconciliation">
                        <li class="nav-item dropdown">
                            <a href="{{ route('reconciliation') }}" class="nav-link {{ Route::is(['reconciliation','view-reconciliation']) ? "active" : "" }}"><i class="bi bi-arrow-repeat me-1"></i>Reconciliation</a>
                        </li>
                    </x-has-access>
                </ul>
            </div>
        </nav>
    </div>
</div>
