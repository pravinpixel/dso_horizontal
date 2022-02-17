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
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    {{ Route::is('dashboard') ? "Dashboard" : "" }}
                    {{ Route::is('list-material-products') ? "List Material / In-house product" : "" }}
                    {{ Route::is('withdrawal-material-products') ? "Withdraw Material/Product " : "" }}
                    {{ Route::is('disposal') ? "Disposal" : "" }}
                </h4>
            </div>
        </div>
    </div>  
</div>