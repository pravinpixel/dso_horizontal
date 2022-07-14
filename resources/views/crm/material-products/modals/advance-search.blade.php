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
                            <label class="form-label">Category Selection</label>
                            <select class="form-select" ng-model="advanced_filter.category_selection">
                                <option value="">-- select --</option>
                                <option value="material">Material</option>
                                <option value="in-house">In-House</option>
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Item Description</small>
                            <input type="text" class="form-control" list="ad_item_description" onkeyup="wordMatchSuggest(this)" placeholder="Type here" ng-model="advanced_filter.item_description">
                            <datalist id="ad_item_description"></datalist>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Brand</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.brand">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Ownner 1/2</label>
                            <select class="form-select" ng-model="advanced_filter.owner_one">
                                <option value="">-- select --</option>
                                <option ng-value="user.alias_name" ng-repeat="user in MasterData.owners">@{{ user.alias_name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Departments</label>
                            <select class="form-select" ng-model="advanced_filter.department">
                                <option value="">-- select --</option>
                                <option ng-value="user.id" ng-repeat="user in MasterData.departments">@{{ user.name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Storage Room</label>
                            <select class="form-select" ng-model="advanced_filter.storage_room">
                                <option value="">-- select --</option>
                                <option ng-value="user.id" ng-repeat="user in MasterData.storage_room">@{{ user.name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date In</small>
                            <input type="text" date-range-picker class="form-control" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_in">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date of expiry</small>
                            <input type="text" date-range-picker class="form-control" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_of_expiry">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Supplier</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.supplier">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Batch#</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.batch">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Serial#</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.serial">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">PO Number</small>
                            <input type="number" min="1"  class="form-control" placeholder="Type here" ng-model="advanced_filter.po_number">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Statutory board</label>
                            <select name="advanced_filter.statutory_body" class="form-select" ng-model="advanced_filter.statutory_body">
                                <option value="">-- select --</option>
                                @foreach ($statutory_body_db as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">EUC Material</label>
                            <select class="form-select" ng-model="advanced_filter.euc_material">
                                <option value="">-- select --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Require Bulk volume tracking</label>
                            <select class="form-select" ng-model="advanced_filter.require_bulk_volume_tracking">
                                <option value="">-- select --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Required Outlife Tracking</label>
                            <select name="advanced_filter.require_outlife_tracking" class="form-select" ng-model="advanced_filter.require_outlife_tracking">
                                <option value="">-- select --</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Housing type</label>
                            <select name="advanced_filter.housing_type" class="form-select" ng-model="advanced_filter.housing_type">
                                <option value="">-- select --</option>
                                @foreach ($house_type_db as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Housing No</label>
                            <select name="advanced_filter.housing" class="form-select form-select-sm" ng-model="advanced_filter.housing">
                                <option value=""> -</option>
                                @for ($key=0;$key<20;$key++)
                                    <option value="{{ $key+1 }}">{{ $key+1 }}</option>
                                @endfor
                            </select>
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">IQC status </label>
                            <select name="advanced_filter.iqc_status" class="form-select" ng-model="advanced_filter.iqc_status">
                                <option value="">-- select --</option>
                                <option value="1">Pass</option>
                                <option value="2">Fail</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">CAS#</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.cas">
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">FM 1202</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.fm_1202">
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Project name </small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.project_name">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Material/In-house Product type</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.material_product_type">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date of manufacture</small>
                            <input type="text" date-range-picker class="form-control" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_of_manufacture">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date of shipment</small>
                            <input type="text" date-range-picker class="form-control" placeholder="YYYY-MM-DD" ng-model="advanced_filter.date_of_shipment">
                        </div> 
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Unit Packing size</label>
                            <select  class="form-select" ng-model="advanced_filter.unit_packing_value">
                                <option value="">-- select --</option>
                                @foreach ($unit_packing_size_db as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                @endforeach	 
                            </select>
                        </div>  
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Used for TD/EXPT only</label>
                            <select class="form-select" ng-model="advanced_filter.used_for_td_expt_only">
                                <option value="">-- select --</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Status</label>
                            <select class="form-select" ng-model="advanced_filter.is_draft">
                                <option value="">-- select --</option>
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