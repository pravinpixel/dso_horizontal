@extends('layouts.app')
@section('content')
<div ng-app="NotificationAPP" ng-controller="NotificationController">
    <section>
        <div class="card shadow-sm border" ng-if="notifications.near_expiry.length"> 
            <div class="card-body p-0" style="max-height: 50vh;overflow:auto">
                <table class="table m-0 table-hover">
                    <thead>
                        <tr>
                            <th colspan="9" class="bg-near-expiry text-white text-center">
                                <h5 class="m-0">Near Expiry Material/In-house Product</h5>
                            </th>
                        </tr> 
                    </thead>
                    <tbody> 
                        <tr class="bg-light">
                            <td class="text-near-expiry"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-near-expiry"><b><small>Brand</small></b></td>
                            <td class="text-near-expiry"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-near-expiry"><b><small>Qty</small></b></td>
                            <td class="text-near-expiry"><b><small>Owner 1/2</small></b></td>
                            <td class="text-near-expiry"><b><small>Storage location</small></b></td>
                            <td class="text-near-expiry"><b><small>Housing Type</small></b></td>
                            <td class="text-near-expiry"><b><small>DOE</small></b></td>
                            <td class="text-near-expiry"><b><small>Action</small></b></td>
                        </tr>
                        <tr ng-repeat="row in notifications.near_expiry">
                            <td>@{{ row.batch_material_product.item_description }}</td>
                            <td>@{{ row.brand }}</td>
                            <td>@{{ row.batch }} / @{{ row.serial }} / @{{ row.po_number }}</td>
                            <td>@{{ row.quantity }}</td>
                            <td>@{{ row.owner_one }} / @{{ row.owner_two }}</td>
                            <td>@{{ row.storage_area.name }} </td>
                            <td>@{{ row.housing_type.name }} </td>
                            <td>@{{ row.date_of_expiry }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        <a class="dropdown-item" href="{{ route('extend-expiry') }}/@{{ row.id }}"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
                                        <a class="dropdown-item"  ng-click="view_batch_details(row.batch_material_product, row)"><i class="bi bi-eye-fill me-1"></i>View Batch details</a>
                                    </div>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table> 
            </div>
        </div>
        <div class="card shadow-sm border" ng-if="notifications.expired.length"> 
            <div class="card-body p-0" style="max-height: 50vh;overflow:auto">
                <table class="table m-0 table-hover">
                    <thead>
                        <tr>
                            <th colspan="9" class="bg-expired text-white text-center">
                                <h5 class="m-0">Expired Material/In-house Product</h5>
                            </th>
                        </tr> 
                    </thead>
                    <tbody> 
                        <tr class="bg-light">
                            <td class="text-expired"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-expired"><b><small>Brand</small></b></td>
                            <td class="text-expired"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-expired"><b><small>Qty</small></b></td>
                            <td class="text-expired"><b><small>Owner 1/2</small></b></td>
                            <td class="text-expired"><b><small>Storage location</small></b></td>
                            <td class="text-expired"><b><small>Housing Type</small></b></td>
                            <td class="text-expired"><b><small>DOE</small></b></td>
                            <td class="text-expired"><b><small>Action</small></b></td>
                        </tr>
                        <tr ng-repeat="row in notifications.near_expiry">
                            <td>@{{ row.batch_material_product.item_description }}</td>
                            <td>@{{ row.brand }}</td>
                            <td>@{{ row.batch }} / @{{ row.serial }} / @{{ row.po_number }}</td>
                            <td>@{{ row.quantity }}</td>
                            <td>@{{ row.owner_one }} / @{{ row.owner_two }}</td>
                            <td>@{{ row.storage_area.name }} </td>
                            <td>@{{ row.housing_type.name }} </td>
                            <td>@{{ row.date_of_expiry }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        <a class="dropdown-item" href="{{ route('extend-expiry') }}/@{{ row.id }}"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
                                        <a class="dropdown-item"  ng-click="view_batch_details(row.batch_material_product, row)"><i class="bi bi-eye-fill me-1"></i>View Batch details</a> 
                                    </div>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table> 
            </div>
        </div>
        <div class="card shadow-sm border" ng-if="notifications.failed_iqc.length"> 
            <div class="card-body p-0" style="max-height: 50vh;overflow:auto">
                <table class="table m-0 table-hover">
                    <thead>
                        <tr>
                            <th colspan="9" class="bg-failed text-white text-center">
                                <h5 class="m-0">Failed IQC Material/In-house Product</h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr class="bg-light">
                            <td class="text-failed"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-failed"><b><small>Brand</small></b></td>
                            <td class="text-failed"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-failed"><b><small>Qty</small></b></td>
                            <td class="text-failed"><b><small>Owner 1/2</small></b></td>
                            <td class="text-failed"><b><small>Storage location</small></b></td>
                            <td class="text-failed"><b><small>Housing Type</small></b></td>
                            <td class="text-failed"><b><small>DOE</small></b></td>
                            <td class="text-failed"><b><small>Action</small></b></td>
                        </tr>
                        <tr ng-repeat="row in notifications.near_expiry">
                            <td>@{{ row.batch_material_product.item_description }}</td>
                            <td>@{{ row.brand }}</td>
                            <td>@{{ row.batch }} / @{{ row.serial }} / @{{ row.po_number }}</td>
                            <td>@{{ row.quantity }}</td>
                            <td>@{{ row.owner_one }} / @{{ row.owner_two }}</td>
                            <td>@{{ row.storage_area.name }} </td>
                            <td>@{{ row.housing_type.name }} </td>
                            <td>@{{ row.date_of_expiry }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        <a class="dropdown-item" href="{{ route('extend-expiry') }}/@{{ row.id }}"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
                                        <a class="dropdown-item" ng-click="view_batch_details(row.batch_material_product, row)"><i class="bi bi-eye-fill me-1"></i>View Batch details</a> 
                                    </div>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table> 
            </div>
        </div>
    </section>
    @include('crm.material-products.modals.view-batch-list') 
</div>
@endsection
@section('scripts') 
    <input type="hidden" id="get-batch-material-products" value="{{ route("get-batch-material-products") }}">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>  
    <script src="{{ asset('public/asset/js/controllers/NotificationController.js') }}"></script> 
@endsection