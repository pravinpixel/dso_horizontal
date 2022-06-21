<div id="advance-search-ng-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog w-100 modal-right h-100">
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
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.item_description">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Brand</small>
                            <input type="text" class="form-control" placeholder="Type here" ng-model="advanced_filter.brand">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Ownner 1/2</label>
                            <select class="form-select" ng-model="advanced_filter.owner_one">
                                <option value="">-- select --</option>
                                <option ng-value="user.id" ng-repeat="user in MasterData.owners">@{{ user.alias_name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Departments</label>
                            <select class="form-select" ng-model="advanced_filter.departments">
                                <option value="">-- select --</option>
                                <option ng-value="user.id" ng-repeat="user in MasterData.departments">@{{ user.name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <label class="form-label">Storage Room</label>
                            <select class="form-select" ng-model="advanced_filter.departments">
                                <option value="">-- select --</option>
                                <option ng-value="user.id" ng-repeat="user in MasterData.storage_room">@{{ user.name }}</option> 
                            </select>
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date In</small>
                            <input type="date" class="form-control" placeholder="Type here" ng-model="advanced_filter.date_in">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date of expiry</small>
                            <input type="date" class="form-control" placeholder="Type here" ng-model="advanced_filter.date_of_expiry">
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
                            <input type="date" class="form-control" placeholder="Type here" ng-model="advanced_filter.date_of_manufacture">
                        </div>
                        <div class="col-6 text-start mb-2 px-1">
                            <small class="mb-1">Date of shipment</small>
                            <input type="date" class="form-control" placeholder="Type here" ng-model="advanced_filter.date_of_shipment">
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
                        {{-- <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Extended expiry</small>
                                <input type="date" class="form-control" placeholder="Type here" ng-model="advanced_filter.extended_expiry">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label class="form-label">Extended QC status</label>
                                <select name="advanced_filter.extended_qc_status" class="form-select" ng-model="advanced_filter.extended_qc_status">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label class="form-label">Disposed</label>
                                <select name="advanced_filter.disposed" class="form-select" ng-model="advanced_filter.disposed">
                                    <option value="">-- select --</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No but used for TD/Expt</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label class="form-label">Extended QC status</label>
                                <select name="advanced_filter.extended_qc_status" class="form-select" ng-model="advanced_filter.extended_qc_status">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label class="form-label">Required Usage Tracking</label>
                                <select name="advanced_filter.usage_tracking" class="form-select" ng-model="advanced_filter.usage_tracking">
                                    <option value="">-- select --</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option> 
                                </select>
                            </div> 
                        --}}
                    </div>
                </div>
                <form name="dateForm" class="form-horizontal">
                    <div class="form-group">
                        <label for="daterange1" class="control-label">Simple picker</label>
                        <input date-range-picker id="daterange1" name="daterange1" class="form-control date-picker" type="text"
                               ng-model="date" required ng-change="SimplePickerChange();"/>
                    </div>
                    <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                        <label for="daterange2" class="control-label">Picker with min and max date</label>
                        <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                               min="'2015-01-23'" max="'2015-08-25'" ng-model="date"
                               required/>
                        <div class="help-block" ng-messages="dateForm.daterange2.$error">
                            <p ng-message="min">Start date is too far in the past.</p>
                            <p ng-message="max">End date is too far in the future.</p>
                            <p ng-message="required">Range is required.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="daterange3" class="control-label">Picker with custom locale</label>
                        <input date-range-picker id="daterange3" name="daterange3" class="form-control date-picker" type="text"
                               ng-model="date" options="opts" required/>
                    </div>
                    <div class="form-group">
                        <label for="daterange4" class="control-label">Clearable picker</label>
                        <input date-range-picker id="daterange4" name="daterange4" class="form-control date-picker" type="text"
                               ng-model="date" clearable="true" required/>
                    </div>
                    <div class="form-group">
                        <label for="daterange5" class="control-label">Picker with custom format</label>
                        <input date-range-picker name="daterange5" id="daterange5" class="form-control date-picker" type="text"
                           ng-model="date" options="{locale: {format: 'MMMM D, YYYY'}}" required/>
                    </div>
                    <div class="form-grou">
                        <button type="button" class="btn" ng-click="setStartDate()">Set Start Date to 4 days ago</button>
                        <button type="button" class="btn" ng-click="setRange()">Set Range to 4 days ago</button>
                    </div>
                    <div class="form-group">
                        <label for="daterange6" class="control-label">Single date</label>
                        <input date-range-picker name="daterange6" id="daterange6" class="form-control date-picker" type="text"
                               ng-model="singleDate" options="{singleDatePicker: true}" required/>
                    </div>
                </form> 
            </div>
            <div class="modal-footer border-top text-center">
                <label for="xxxx" data-bs-toggle="modal" data-bs-target="#save-search-name"><input type="checkbox" name="" class="form-check-input" id="xxxx"> Save this search</label>
                <button ng-click="search_advanced_mode()" class="btn btn-primary mx-auto col-3 rounded-pill"><i class="bi bi-search me-1"></i> Search</button>
            </div>
        </div> 
    </div>
</div> 
<div class="modal fade" id="save-search-name" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>Search Title</h4>  
                <div class="ms-auto">
                    <button class="rounded-pill btn btn-light btn-sm shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <input type="text" ng-model="search_title" class="form-control mb-3" placeholder="Type here..">
                <input type="submit" ng-click="save_search_title()" class="form-control btn-primary btn" value="Save">
            </div>
        </div>
    </div>
</div>