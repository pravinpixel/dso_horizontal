<div ng-show="on_item_description" class="box box-lg sticky-left justify-content-start">
    <div class="w-100 text-start d-flex">
        <a class="bi bi-chevron-right table-toggle-icon me-auto text-white" 
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
            @switch($column['name'])
                @case('unit_packing_value')
                    @{{ row.unit_packing_value }} 
                    {{ $tableAllColumns['unit_of_measure']['row']}}
                @break
                @case('category_selection')
                    @{{ row.category_selection == 'material' ? 'Material' : ''}} @{{ row.category_selection == 'in_house' ? 'In-house Product' : ''}}
                @break 
                @case('quantity')
                    <span>
                        @{{ row.totalQuantity }}
                        <i class="ms-1 @{{ row.quantityColor }} dot-sm bi bi-circle-fill"></i>
                    </span>
                @break
                @case('total_quantity')
                    <span>
                        @{{ row.material_total_quantity }}    
                    </span>
                @break
                @default
                {!! $column['row'] !!}
            @endswitch 
        </div>
    @endif
@endforeach
@switch($page_name)
    @case('MATERIAL_SEARCH_OR_ADD')
        <div class="box border-start box-sm">
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
        </div>
    @break
    @case('PRINT_BARCODE_LABEL')
        <div class="box border-start">
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
        </div>
    @break 
    @case('MATERIAL_WITHDRAWAL')
        <div class="box border-start box-sm">
            <div class="dropdown">
                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a> 
                <div class="dropdown-menu" >
                    <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                </div>
            </div>
        </div>
    @break
    @case('THRESHOLD_QTY')
        <div class="box border-start text-center">
            <div class="dropdown">
                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a> 
                <div class="dropdown-menu" >
                    <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                </div>
            </div>
        </div>
    @break
    @case('EARLY_DISPOSAL')
        <div class="box border-start box-sm">
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
        </div>
    @break
    @case('REPORT_UTILISATION_CART')
        <div class="box border-start box-sm">
            <div class="dropdown">
                <a class="ropdown-toggle text-secondary"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" material-id="@{{ row.id }}" onclick="addToCart(this,'{{ $page_name }}')"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</button>
                </div>
            </div>
        </div>
    @break
    @case('REPORT_EXPORT_CART')
        <div class="box border-start box-sm">
            <div class="dropdown">
                <a class="ropdown-toggle text-secondary"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" material-id="@{{ row.id }}" onclick="addToCart(this,'{{ $page_name }}')"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</button>
                </div>
            </div>
        </div>
    @break
    @case('REPORT_DISPOSED_ITEMS')
        <div class="box border-start box-sm">
            <div class="dropdown">
                <a class="ropdown-toggle text-secondary"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" material-id="@{{ row.id }}" onclick="addToCart(this,'{{ $page_name }}')"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</button>
                </div>
            </div>
        </div>
    @break
    @default
    <div class="box border-start box-sm"></div>     
@endswitch