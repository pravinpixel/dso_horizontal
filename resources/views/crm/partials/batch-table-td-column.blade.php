<div class="box box-lg" ng-show="on_item_description"></div>

@foreach ($tableAllColumns as $column)
    @if ($column['name'] != 'item_description' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id')
        <div ng-if="on_{{ $column['name'] }}" class="box text-center"> 
            @switch($column['name'])
                @case('iqc_status')
                    <span ng-if="batch.iqc_status != 1" class="mx-auto badge bg-success rounded-pill">PASS</span>
                    <span ng-if="batch.iqc_status == 1" class="mx-auto badge bg-danger rounded-pill">FAIL</span> 
                @break
                @case('is_draft')
                    <span ng-if="batch.is_draft != 1" class="mx-auto badge bg-success rounded-pill">Active</span>
                    <span ng-if="batch.is_draft == 1" class="mx-auto badge bg-secondary rounded-pill">Draft</span> 
                @break
                @case('owner_two')
                    {!! $tableAllColumns['owner_one']['batch'].' , ' !!} {!! $tableAllColumns['owner_two']['batch'] !!} 
                @break
                @case('serial')
                    {!! $tableAllColumns['batch']['batch'].' / ' !!} {!! $tableAllColumns['serial']['batch'] !!}  
                @break
                @case('housing_type')
                    {{ $column['batch'] }} - {{ $tableAllColumns["housing"]["batch"] }}
                @break
                @case('statutory_body')
                    @{{ batch.statutory_body.name }}
                @break
                @case('unit_packing_value')
                    @{{ batch.unit_packing_value }} {{ $tableAllColumns['unit_of_measure']['row']}} 
                @break
                @case('date_of_expiry')
                    {{ $column['batch'] }} <span><i class="ms-1 @{{ getDateOfExpiryColor(current_date, batch.date_of_expiry) }} dot-sm bi bi-circle-fill"></i></span>
                @break 
                @default {!! $column['batch'] !!}
            @endswitch 
        </div>
    @endif
@endforeach 

@switch($page_name)
    @case('MATERIAL_SEARCH_OR_ADD')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="duplicateThisBatch(batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</button>
                    <button class="dropdown-item text-secondary" ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="Transfers(batch.id ,  row.quantity)"><i class="bi bi-arrows-move me-1"></i>Transfer</button>
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                    {{-- ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" --}}
                        <button  class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i> Repack/Transfer 
                        </button>
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i> Repack/outlife
                        </button> 
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        </div>  
    @break 
    @case('PRINT_BARCODE_LABEL')
        <div class="box border-start d-flex align-items-center" >
            <div class="d-flex align-items-center justify-content-between">
                <div class="btn-group mx-auto"> 
                    <button title="View Batch Details" class="btn bg-light btn-sm border text-primary2" ng-click="view_batch_details(row, batch)"><i class="fa fa-eye"></i></button>
                    <button title="Print Batch Label" class="btn btn-light btn-sm border text-primary" ng-click="view_print_barcode(batch.id)"><i class="fa fa-print"></i></button>
                </div>
            </div>
        </div> 
    @break
    @case('MATERIAL_WITHDRAWAL')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary"  ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button> 
                </div>
            </div>
        </div>
    @break
    @case('THRESHOLD_QTY') 
        <div class="box border-start">
            @{{ batch.is_read }}
            <input ng-checked="batch.is_read"  ng-click="changeReadStatus(batch.id)" type="checkbox" id="switch@{{ batch.id }}" data-switch="none"/>
            <label class="border shadow-sm" for="switch@{{ batch.id }}"></label>
        </div>
    @break
    @case('EXTEND_EXPIRY')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button> 
                    <button class="dropdown-item text-secondary" ng-click="extension(batch)"><i class="bi bi-arrow-up-right-square me-1"></i>Extension</button>
                </div>
            </div>
        </div>
    @break
    @case('EARLY_DISPOSAL')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <a class="dropdown-item d-flex align-items-start" ng-click="dispose(batch)">
                        <i class="bi bi-trash2 me-1"></i>
                      To Dispose /  <br>  Used for TD / Expt Project 
                    </a>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        </div>
    @break
    @case('REPORT_UTILISATION_CART')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</button>
                    <button class="dropdown-item text-secondary" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button>
                    <button class="dropdown-item text-secondary" ng-click="duplicateThisBatch(batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</button>
                    <button class="dropdown-item text-secondary" ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="Transfers(batch.id ,  row.quantity)"><i class="bi bi-arrows-move me-1"></i>Transfer</button>
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                    {{-- ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" --}}
                        <button  class="dropdown-item text-secondary" ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i> Repack/Transfer 
                        </button>
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button class="dropdown-item text-secondary"  ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i> Repack/outlife
                        </button> 
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        </div>
    @break
    @case('REPORT_EXPORT_CART')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</button>
                    <button class="dropdown-item text-secondary" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button>
                    <button class="dropdown-item text-secondary" ng-click="duplicateThisBatch(batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</button>
                    <button class="dropdown-item text-secondary" ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="Transfers(batch.id ,  row.quantity)"><i class="bi bi-arrows-move me-1"></i>Transfer</button>
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                    {{-- ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" --}}
                        <button  class="dropdown-item text-secondary" ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i> Repack/Transfer 
                        </button>
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button class="dropdown-item text-secondary"  ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i> Repack/outlife
                        </button> 
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        </div>
    @break
    @case('REPORT_DISPOSED_ITEMS')
        <div class="box border-start box-sm">
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <a class="dropdown-item d-flex align-items-start" ng-click="dispose(batch)">
                        <i class="bi bi-trash2 me-1"></i>
                    To Dispose /  <br>  Used for TD / Expt Project 
                    </a>
                    <button class="dropdown-item text-secondary"  ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button>
                    <button class="dropdown-item text-secondary"  ng-click="duplicateThisBatch(batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</button>
                    <button class="dropdown-item text-secondary"  ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="Transfers(batch.id ,  row.quantity)"><i class="bi bi-arrows-move me-1"></i>Transfer</button>
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                    {{-- ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" --}}
                        <button  class="dropdown-item text-secondary" ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i> Repack/Transfer 
                        </button>
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button class="dropdown-item text-secondary"  ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i> Repack/outlife
                        </button> 
                    {{--  ==== REPACK OUTLIFE ====  --}}
        
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        </div>
    @break
@endswitch