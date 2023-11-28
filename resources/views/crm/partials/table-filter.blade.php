<div class="table-fillters row m-0 p-2">
    <div class="col-12 mb-2 text-end d-flex justify-content-end">
        @include('crm.partials.table-column-filter') 
        <button data-bs-toggle="modal" data-bs-target="#advance-search-ng-modal" class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
    </div>
    <div class="col">
        <label for="" class="form-label">Category selection</label>
        <select ng-model="advanced_filter.category_selection" class="form-select custom">
            <option value="">-- Select --</option>
            <option value="in_house">In House</option>
            <option value="material">Material</option>
        </select>
    </div> 
    <div class="col">
        <label for="" class="form-label">Item description</label>
        <input type="text" ng-model="advanced_filter.item_description" name="item_description" class="form-control custom need-word-match" placeholder="Type here...">
    </div>
    <div class="col">
        <label for="" class="form-label">Brand</label>
        <input type="text" ng-model="advanced_filter.brand" name="brand" class="form-control custom need-word-match" placeholder="Type here..." >
    </div> 
    <div class="col">
        <label for="" class="form-label">Owners</label>
        <div>  
            <div ng-dropdown-multiselect=""  options="owners" selected-model="advanced_filter_owners"></div>
        </div>
    </div> 
    <div class="col">
        <label for="" class="form-label">Department</label>
        <select name="department" ng-model="advanced_filter.department" id="" class="form-select custom">
            <option value="">-- Select --</option>
            @foreach ($departments_db as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach 
        </select>
    </div> 
    <div class="col">
        <label for="" class="form-label">Storage area</label>
        <select name="storage_area" ng-model="advanced_filter.storage_area" class="form-select custom">
            <option value="">-- Select --</option>
            @foreach ($storage_room_db as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach 
        </select>
    </div> 
    <div class="col"> 
        <label for="" class="form-label">Date in</label>
        <input type="text" date-range-picker ng-model="advanced_filter.date_in" name="date_in" class="form-control custom" placeholder="DD/MM/YYYY">
    </div>
    <div class="col"> 
        <label for="" class="form-label">Date of expiry</label>
        <input type="text" date-range-picker ng-model="advanced_filter.date_of_expiry" name="date_of_expiry" class="form-control custom" placeholder="DD/MM/YYYY">
    </div>
    <div class="col d-flex align-items-center justify-content-center">
        <div class="btn-group">
            <button ng-click="search_advanced_mode()" class="btn btn-sm btn-primary rounded w-100 h-100 "><i class="bi bi-search"></i></button>
            &nbsp; 
            <button ng-click="reset_bulk_search()" class="btn btn-sm btn-light w-100 h-100 rounded"><i class="bi bi-arrow-counterclockwise"></i></button> &nbsp; 
            <button ng-click="export()" class="btn btn-sm btn-primary rounded w-100 h-100 "><i class="bi bi-box-arrow-right"></i></button>
        </div>
    </div> 
</div>