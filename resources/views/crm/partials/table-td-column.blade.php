<div ng-show="on_item_description" class="box box-lg sticky-left justify-content-start">
    <div class="w-100 text-start d-flex">
        <a class="bi bi-chevron-right table-toggle-icon me-auto" 
            data-bs-toggle="collapse"
            href="#row_@{{ index+1 }}"
            role="button" title="@{{ row.item_description}}">
        </a>
        <small class="text-start ms-1 col">
            @{{ row.item_description.replace('/', " / ")  }}
        </small>
    </div>
</div> 
@foreach ($tableAllColumns as $key =>  $column) 
    @if ($column['name'] != 'item_description' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id')
        <div ng-if="on_{{ $column['name'] }}" class="box justify-content-start" >
            @if ($column['name']=="unit_packing_value")
                @elseif ($column['name'] == 'is_draft')
                @elseif($column['name']=="quantity")
                    @{{ row.totalQuantity }}
                    <span ng-if="row.totalQuantity < row.alert_threshold_qty_upper_limit && row.totalQuantity <= row.alert_threshold_qty_lower_limit">
                        <i class="ms-1 text-warning dot-sm bi bi-circle-fill"></i>
                    </span>
                    <span ng-if="row.totalQuantity > row.alert_threshold_qty_lower_limit">
                        <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i>
                    </span>
                @else
                {!! $column['row'] !!}
            @endif
        </div>
    @endif
@endforeach
<div class="box border-start {{ $page_name !== 'PRINT_BARCODE_LABEL'  ? "box-sm" : null}}">
    @if ($page_name === 'MATERIAL_SEARCH_OR_ADD')
        <div class="dropdown">
            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
            </a> 
            <div class="dropdown-menu" >
                <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                <a ng-click="editOrDuplicate('edit', row.id, row.batches[0].id , 1) " class="dropdown-item" href="javascript:void(0)"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete</a>  
            </div>
        </div>
    @endif
</div>