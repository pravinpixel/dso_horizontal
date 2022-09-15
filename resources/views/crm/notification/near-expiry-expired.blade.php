@extends('layouts.app')
@section('content')
<div>
    <section>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-near-expiry text-white text-center">
                <h5 class="m-0">Near Expiry Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="NEAR_EXPIRY_TABLE"> 
                    <thead>
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
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
                    </thead>
                    <tbody></tbody>
                </table>  
            </div>
        </div>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-expired text-white text-center">
                <h5 class="m-0">Expired Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="EXPIRY_TABLE"> 
                    <thead> 
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
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
                    </thead>
                    <tbody></tbody>
                </table>  
            </div> 
        </div>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-failed text-white text-center">
                <h5 class="m-0">Failed IQC Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="FAILED_IQC_TABLE"> 
                    <thead> 
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
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
                    </thead>
                    <tbody></tbody>
                </table>  
            </div>
        </div>
    </section>
    <div id="View_Batch_Details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View Batch Details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll-2 p-0"> 
                    <ol class="list-group list-group-numbered" style="overflow: hidden" id="Batch_Details">
                        {{-- <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Category selection</div>
                               @{{ batchOverview.category_selection }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Item Description</div>
                               @{{ batchOverview.item_description }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Brand</div>
                               @{{ batchOverview.brand }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Supplier</div>
                               @{{ batchOverview.supplier }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Packing size</div>
                               @{{ batchOverview.unit_packing_value }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Quantity</div>
                               @{{ batchOverview.quantity }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Batch #</div>
                               @{{ batchOverview.batch }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Serial#</div>
                               @{{ batchOverview.serial }}
                            </div>
                        </li>
    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">PO #</div>
                               @{{ batchOverview.po_number }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Statutory body</div>
                               @{{ batchOverview.statutory_body }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">EUC material</div>
                               @{{ batchOverview.euc_material }}
                            </div>
                        </li>
    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Require bulk volume tracking</div>
                               @{{ batchOverview.require_bulk_volume_tracking }}
                            </div>
                        </li><li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Require outlife tracking and outlife (days)</div>
                               @{{ batchOverview.require_outlife_tracking }}
                            </div>
                        </li>
    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Housing type and #</div>
                               @{{ batchOverview.housing }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Owner 1/Owner 2 (SE/PL/FM)</div>
                               @{{ batchOverview.owners }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Department</div>
                               @{{ batchOverview.department }}
                            </div>
                        </li>
    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Access</div>
                               @{{ batchOverview.access }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date in</div>
                               @{{ batchOverview.date_in }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date of expiry</div>
                               @{{ batchOverview.date_of_expiry }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" >
                            <div class="w-100  d-flex justify-content-between align-items-center">
                                <div class="fw-bold">SDS</div>
                                <div class="btn-group mt-1" ng-if="batchOverview.sds != null">
                                    <a class="btn btn-sm btn-outline-primary" href="@{{ batchOverview.sds }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                                    <a class="btn btn-sm btn-primary" href="@{{ batchOverview.sds }}" download><i class="fa fa-download me-1"></i>Download</a>
                                </div>
                            </div>
                        </li> 
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" >
                            <div class="w-100  d-flex justify-content-between align-items-center">
                                <div class="fw-bold">COC/COA/Mill Cert</div>
                                <div class="mt-1 text-end" ng-if="batchOverview.coc_coa_mill_cert != null">
                                    <span class="btn-group mb-1" ng-repeat="row in batchOverview.coc_coa_mill_cert">
                                        <a class="btn btn-sm btn-outline-primary" href="@{{ row }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                                        <a class="btn btn-sm btn-primary" href="@{{ row }}" download><i class="fa fa-download me-1"></i>Download</a>
                                    </span> 
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">IQC status (P/F)</div>
                               @{{ batchOverview.iqc_status }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" >
                            <div class="w-100  d-flex justify-content-between align-items-center">
                                <div class="fw-bold">IQC result</div>
                                <div class="btn-group mt-1" ng-if="batchOverview.iqc_result != null">
                                    <a class="btn btn-sm btn-outline-primary" href="@{{ batchOverview.iqc_result }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                                    <a class="btn btn-sm btn-primary" href="@{{ batchOverview.iqc_result }}" download><i class="fa fa-download me-1"></i>Download</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">CAS #</div>
                               @{{ batchOverview.cas }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">FM1202</div>
                               @{{ batchOverview.fm_1202 }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Project name</div>
                               @{{ batchOverview.project_name }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Material/Product type</div>
                               @{{ batchOverview.material_product_type }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date of manufacture</div>
                               @{{ batchOverview.date_of_manufacture }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date of shipment</div>
                               @{{ batchOverview.date_of_shipment }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold d-flex">Cost per unit <small class="sgd"> S$ </small></div>
                               @{{ batchOverview.cost_per_unit }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Remarks</div>
                               @{{ batchOverview.remarks }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Extended expiry</div>
                               @{{ batchOverview.extended_expiry }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Extended QC status (P/F)</div>
                               @{{ batchOverview.extended_qc_status }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Extended QC status (P/F)</div>
                               @{{ batchOverview.extended_qc_status }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Extended QC result</div>
                               @{{ batchOverview.extended_qc_result }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Disposed certificate</div>
                               @{{ batchOverview.disposal_certificate }}
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Used for TD/Expt only</div>
                               @{{ batchOverview.used_for_td_expt_only }}
                            </div>
                        </li> --}}
    
                    </ol> 
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection 
@section('scripts')  
    <script src="{{ asset('public/asset/js/controllers/NotificationController.js') }}"></script>
    <script>
        var tables = document.getElementsByClassName('table');
        Object.entries(tables).forEach(element => {
            if(element[1].id !== '' && element[1].id !== null) {
                var API = `{{ route('near_expiry_expired_ajax') }}/${element[1].id}`;
                $(`#${element[1].id}`).DataTable({
                    stripeClasses: [],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All'],
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: API,
                    columns: [ 
                        {data: 'item_description', name: 'item_description'},
                        {data: 'brand', name: 'brand'},
                        {data: 'batch_serial_po_number', name: 'batch_serial_po_number'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'owners', name: 'owners'},
                        {data: 'storage_area', name: 'storage_area'},
                        {data: 'housing_type', name: 'housing_type'},
                        {data: 'date_of_expiry', name: 'date_of_expiry'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }
        });
    </script>
@endsection