<div ng-show="on_item_description" class="box sticky-left justify-content-start">
    <a class="bi bi-caret-right-fill table-toggle-icon me-auto" 
        data-bs-toggle="collapse"
        href="#row_@{{ index+1 }}"
        role="button" title="@{{ row.item_description}}">
        @{{ row.item_description |  limitTo: 12 }}
    </a>
</div>

@foreach ($tableAllColumns as $key =>  $column) 
    <div ng-if="on_{{ $column['name'] }}" class="box" >
        {!! $column['row'] !!} 
    </div>
@endforeach
<div class="box border-start {{ $page_name !== 'PRINT_BARCODE_LABEL'  ? "box-sm" : null}}">
    @if ($page_name === 'MATERIAL_SEARCH_OR_ADD')
        <div class="dropdown">
            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
            </a> 
            <div class="dropdown-menu" >
                <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                <a ng-click="editOrDuplicate('edit', row.id, row.batches[0].id)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete</a>  
            </div>
        </div>
    @endif
</div>