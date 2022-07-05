<div class="table-fillters row m-0 p-2">
    <div class="col-12 mb-2 text-end d-flex justify-content-end">
        <div class="tableColumns-dropdown">
            <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-caret-down-square-fill"></i>  
            </button>
            <div class="tableColumns-menu"> 
                <div class="menu-list"
                    ng-init="@foreach ($tableAllColumns as $column)@if ($column['name'] != 'unit_of_measure' && $column['name'] != 'housing') on_{{ $column['name'] }} = {{ $column['status'] == 1 ? 'true' : 'false' }};  @endif @endforeach "> 
                    <label>
                        <input type="checkbox" ng-model="on_all_check_box" ng-change="select_all_check_box()" class="form-check-input me-1">
                        <span>All</span>
                    </label> 
                    @foreach ($tableAllColumns as $column)  
                        @if ($column['name'] != 'unit_of_measure' && $column['name'] != 'housing' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id')
                            <label> 
                                <input type="checkbox" ng-checked="{{ $column['status'] == 1 ? true : false }}" ng-model="on_{{ $column['name'] }}" id="on_{{ $column['name'] }}" class="form-check-input me-1">
                                <span>
                                    @if ($column['name'] == 'iqc_status')
                                        IQC Status
                                        @elseif ($column['name'] == 'is_draft') Status
                                        @elseif ($column['name'] == 'housing_type') Housing
                                        @elseif ($column['name'] == 'owner_two') Ownners
                                        @elseif ($column['name'] == 'serial')Batch# / Serial#
                                        @else   {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
                                    @endif
                                </span>
                            </label>
                        @endif
                    @endforeach
                </div>
            </div>
        </div> 
        <button  data-bs-toggle="modal" data-bs-target="#advance-search-ng-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
    </div>
    <div class="col">
        <label for="" class="form-label">Category selection</label>
        <select ng-model="advanced_filter.category_selection" class="form-select custom">
            <option value="">-- select --</option>
            <option value="in_house">In House</option>
            <option value="material">Material</option>
        </select>
    </div> 
    <div class="col">
        <label for="" class="form-label">Item description</label>
        <input type="text" ng-model="advanced_filter.item_description" name="item_description" class="form-control custom" placeholder="Type here...">
    </div> 
    <div class="col">
        <label for="" class="form-label">Brand</label>
        <input type="text" ng-model="advanced_filter.brand" name="brand" class="form-control custom" placeholder="Type here...">
    </div> 
    <div class="col">
        <label for=""  class="form-label">Owner 1/2</label>
        <select name="owner_one" ng-model="advanced_filter.owner_one" class="form-select custom">
            <option value="">-- select --</option>
            @foreach ($owners as $row)
                <option value="{{ $row->alias_name }}">{{ $row->alias_name }}</option>
            @endforeach 
        </select>
        <input class="d-none" type="text" ng-model="advanced_filter.owner_two" ng-value="advanced_filter.owner_one">
    </div> 
    <div class="col">
        <label for="" class="form-label">Department</label>
        <select name="department" ng-model="advanced_filter.department" id="" class="form-select custom">
            <option value="">-- select --</option>
            @foreach ($departments_db as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach 
        </select>
    </div> 
    <div class="col">
        <label for="" class="form-label">Storage area</label>
        <select name="storage_area" ng-model="advanced_filter.storage_area" class="form-select custom">
            <option value="">-- select --</option>
            @foreach ($storage_room_db as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach 
        </select>
    </div> 
    <div class="col"> 
        <label for="" class="form-label">Date in</label>
        <input type="text" date-range-picker ng-model="advanced_filter.date_in" name="date_in" class="form-control custom" placeholder="YYYY-MM-DD">
    </div>
    <div class="col"> 
        <label for="" class="form-label">Date of expiry</label>
        <input type="text" date-range-picker ng-model="advanced_filter.date_of_expiry" name="date_of_expiry" class="form-control custom" placeholder="YYYY-MM-DD">
    </div>
    <div class="col d-flex align-items-center justify-content-center">
        <div class="btn-group">
            <button ng-click="search_advanced_mode()" class="btn btn-sm btn-primary rounded w-100 h-100 me-2"><i class="bi bi-search"></i></i> </button>
            <button ng-click="reset_bulk_search()" class="btn btn-sm btn-light w-100 h-100 rounded"><i class="bi bi-arrow-counterclockwise"></i></button>
        </div>
    </div> 
</div>
