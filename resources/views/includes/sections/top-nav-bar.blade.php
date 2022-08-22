<div class="topnav shadow bg-primary">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu ">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav custom">                    
                    <li class="nav-item dropdown">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? "active" : "" }}"><i class="bi bi-speedometer2 me-1"></i><span>Dashboard</span></a>
                    </li>  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['material-product.edit-form-one','material-product.edit-form-two','material-product.edit-form-three']) ? "active" : "" }} {{ Route::is(['withdrawal-material-products','list-material-products','mandatory-form-one','mandatory-form-two','non-mandatory-form']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-briefcase me-1"></i> Material / In-house Product <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="{{ route('withdrawal-material-products') }}" class="dropdown-item {{ Route::is(['withdrawal-material-products']) ? "active" : "" }}"><i class="bi bi-aspect-ratio me-1"></i><span>Withdrawal</span></a>
                            <a href="{{ route('list-material-products') }}" class="dropdown-item {{ Route::is(['list-material-products']) ? "active" : "" }}"><i class="bi bi-plus-circle-dotted me-1"></i><span>Search or Add</span></a>
                        </div>
                    </li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['threshold-qty','near-expiry-expired']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell me-1"></i> Notification <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="{{ route('threshold-qty') }}" class="dropdown-item {{ Route::is(['threshold-qty']) ? "active" : "" }}"><i class="bi bi-subtract me-1"></i><span>Threshold Qty</span></a>
                            <a href="{{ route('near-expiry-expired') }}" class="dropdown-item {{ Route::is(['near-expiry-expired']) ? "active" : "" }}"><i class="bi bi-list-ul me-1"></i><span>Near Expiry/Expired </span></a> 
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('disposal') }}" class="nav-link {{ Route::is('disposal') ? "active" : "" }}"><i class="bi bi-trash2 me-1"></i><span>Early Disposal</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('extend-expiry') }}" class="nav-link {{ Route::is('extend-expiry') ? 'active' : '' }}"><i class="bi bi-arrow-up-right-square me-1"></i>Extended Expiry</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('reports') }}" class="nav-link {{ Route::is(['reports','reports.utilisation_cart','reports.export_cart','reports.history','reports.disposed_items']) ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph me-1"></i>Report  </a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a href="{{ route('print-barcode') }}" class="nav-link {{ Route::is('print-barcode') ? 'active' : '' }}"><i class="bi bi-upc-scan me-1"></i>Print Label </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('reconsolidation') }}" class="nav-link {{ Route::is(['reconsolidation','view-reconsolidation']) ? "active" : "" }}"><i class="bi bi-arrow-repeat me-1"></i>Reconciliation</a>
                    </li> 
                </ul>
            </div>
        </nav>
    </div>
</div> 