<div id="advance-search-ng-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  w-100 modal-right h-100">
        <div class="modal-content h-100 rounded-0">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>Advanced Search Filter</h4>  
                <div class="ms-auto">
                    <a ng-click="view_my_saved_search()" class="btn btn-outline-light me-2 rounded-pill">My saved searches</a>
                    <button class="rounded-pill btn btn-light btn-sm shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
            </div>
            <div class="modal-body modal-scroll">
                <div class="text-center">
                    <div class="row m-0"> 
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Supplier</small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.supplier" name="supplier">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Batch#</small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.batch" name="batch">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Serial#</small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.serial" name="serial">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">PO Number</small>
                            <input type="number" min="1"  class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.po_number" name="po_number">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Statutory board</label>
                            <select name="advanced_filter.statutory_body" class="form-select" ng-model="advanced_filter.statutory_body">
                                <option value="">-- Select --</option>
                                @foreach ($statutory_body_db as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">EUC Material</label>
                            <select class="form-select" ng-model="advanced_filter.euc_material">
                                <option value="">-- Select --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Require Bulk volume tracking</label>
                            <select class="form-select" ng-model="advanced_filter.require_bulk_volume_tracking">
                                <option value="">-- Select --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Required Outlife Tracking</label>
                            <select name="advanced_filter.require_outlife_tracking" class="form-select" ng-model="advanced_filter.require_outlife_tracking">
                                <option value="">-- Select --</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Storage area</label>
                            <select name="storage_area" ng-model="advanced_filter.storage_area" class="form-select">
                                <option value="">-- Select --</option>
                                @foreach ($storage_room_db as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Housing type</label>
                            <select name="advanced_filter.housing_type" class="form-select" ng-model="advanced_filter.housing_type">
                                <option value="">-- Select --</option>
                                @foreach ($house_type_db as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Housing #</label>
                            <select name="advanced_filter.housing" class="form-select form-select-sm" ng-model="advanced_filter.housing">
                                <option value="">-- Select --</option>
                                <option value="nil"> - </option>

                                @for ($key=0;$key<20;$key++)
                                    <option value="{{ $key+1 }}">{{ $key+1 }}</option>
                                @endfor
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">IQC status </label>
                            <select name="advanced_filter.iqc_status" class="form-select" ng-model="advanced_filter.iqc_status">
                                <option value="">-- Select --</option>
                                <option value="1">Pass</option>
                                <option value="0">Fail</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">CAS#</small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.cas" name="cas">
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">FM 1202</small>
                            <select class="form-select" ng-model="advanced_filter.fm_1202">
                                <option value="">-- Select --</option>
                                <option value="on">Yes</option>
                                <option value="off">No</option> 
                            </select>
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Project name </small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.project_name" name="project_name">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Material / Product type </small>
                            <input type="text" class="form-control need-word-match" placeholder="Type here" ng-model="advanced_filter.material_product_type" name="material_product_type">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Date of manufacture</small>
                            <input type="text" date-range-picker class="form-control need-word-match" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_of_manufacture" name="date_of_manufacture">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1 text-dark">Date of shipment</small>
                            <input type="text" date-range-picker class="form-control need-word-match" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_of_shipment" name="date_of_shipment">
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Used for TD/EXPT only</label>
                            <select class="form-select" ng-model="advanced_filter.used_for_td_expt_only">
                                <option value="">-- Select --</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label text-dark">Status</label>
                            <select class="form-select" ng-model="advanced_filter.is_draft">
                                <option value="">-- Select --</option>
                                <option value="1">Draft</option>
                                <option value="0">Active</option> 
                            </select>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="card-footer border-top text-center align-items-center row m-0">
                <label for="saveThisSearch" class="col-4 p-0">
                    <input type="checkbox" onclick="saved_this_search(this)"  class="form-check-input" id="saveThisSearch"> Save this search
                </label>
                <div class="text-end col-8  p-0">
                    <button ng-click="clear_advanced_filter()" class="btn btn-light rounded-pill"><i class="bi bi-x me-1"></i> clear</button>
                    <button ng-click="search_advanced_mode()" class="btn btn-primary rounded-pill"><i class="bi bi-search me-1"></i> Search</button>
                </div>
            </div>
        </div> 
    </div>
</div> 
<div class="modal fade" id="save-search-name" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>Search Title</h4>  
                <div class="ms-auto">
                    <button class="rounded-pill btn btn-light btn-sm shadow-sm border" onclick="uncheckedSavedSearch()" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <input type="text" ng-model="search_title" class="form-control mb-3" placeholder="Type here..">
                <input type="submit" ng-click="save_search_title()" class="form-control btn-primary btn" value="Save">
            </div>
        </div>
    </div>
</div>