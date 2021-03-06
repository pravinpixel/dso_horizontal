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
                @case('date_of_expiry')
                    {{ $column['batch'] }} <span><i class="ms-1 @{{ getDateOfExpiryColor(current_date, batch.date_of_expiry) }} dot-sm bi bi-circle-fill"></i></span>
                @break
                @default {!! $column['batch'] !!}
            @endswitch 
        </div>
    @endif
@endforeach
<div class="box border-start {{ $page_name !== 'PRINT_BARCODE_LABEL'  ? "box-sm d-flex align-items-center" : null}}" >
    <div class="{{$page_name === 'PRINT_BARCODE_LABEL'  ? "d-flex align-items-center justify-content-between" : null }}">
        @if ($page_name === 'MATERIAL_SEARCH_OR_ADD')
            <div class="dropdown mx-1">
                <a class="ropdown-toggle"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots text-dark"></i> 
                </a> 
                <div class="dropdown-menu"> 
                    <button class="dropdown-item text-secondary"  ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</button>
                    <button class="dropdown-item text-secondary"  ng-click="duplicateThisBatch(batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</button>
                    <button class="dropdown-item text-secondary"  ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</button>
                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1"  ng-click="Transfers(batch.id ,  row.quantity)"><i class="bi bi-arrows-move me-1"></i>Transfer</button>

                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" class="dropdown-item text-secondary" 
                            ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i>
                            Repack/Transfer 
                        </button>
                    {{--  ==== REPACK OUTLIFE ====  --}}

                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <button ng-disabled="batch.require_outlife_tracking ==  1 || batch.is_draft == 1" class="dropdown-item text-secondary"  ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                        </button> 
                    {{--  ==== REPACK OUTLIFE ====  --}}

                    <button class="dropdown-item text-secondary" ng-disabled="batch.is_draft == 1" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</button>
                    <button class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</button>  
                </div>
            </div>
        @endif 

        @if ($page_name === 'PRINT_BARCODE_LABEL')
            <div class="btn-group mx-auto"> 
                <button title="View Batch Details" class="btn bg-light btn-sm border text-primary2" ng-click="view_batch_details(row, batch)"><i class="fa fa-eye"></i></button>
                <button title="Print Batch Label" class="btn btn-light btn-sm border text-primary" ng-click="view_print_barcode(batch.id)"><i class="fa fa-print"></i></button>
            </div>
        @endif
    </div>
</div>