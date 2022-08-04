<div id="View_Batch_Details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog w-100 modal-right h-100">
        <div class="modal-content h-100 rounded-0">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>View Batch Details</h4>
                <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body modal-scroll-2 p-0"> 
                <ol class="list-group list-group-numbered" style="overflow: hidden">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" >
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
                           @{{ batchOverview.housing_type }}
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
                    </li>

                </ol> 
            </div> 
        </div> 
    </div>
</div>