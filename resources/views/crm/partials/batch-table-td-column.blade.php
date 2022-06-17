<div class="box box-lg" ng-show="on_item_description"></div>   
 
@foreach ($tableAllColumns as $column) 
    <div ng-if="on_{{ $column['name'] }}" class="box text-center">
        @if ($column['name']=="iqc_status")
            <small class="badge bg-success rounded-pill">PASS</small>
            @elseif($column['name'] ==  "date_of_expiry")
                {{ $column['batch'] }}
                <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i>
            @elseif($column['name']=="used_for_td_expt_only")
                - 
            @else
                {!! $column['batch'] !!}
        @endif
    </div>
@endforeach

<div class="box border-start {{ $page_name !== 'PRINT_BARCODE_LABEL'  ? "box-sm d-flex align-items-center" : null}}" >
    <div class="{{$page_name === 'PRINT_BARCODE_LABEL'  ? "d-flex align-items-center justify-content-between" : null }}">
        @if ($page_name === 'MATERIAL_SEARCH_OR_ADD')
            <div class="dropdown mx-1">
                <a class="ropdown-toggle text-secondary"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                </a> 
                <div class="dropdown-menu"  > 
                    
                    <a class="dropdown-item text-secondary"  ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</a>
                    <a class="dropdown-item text-secondary"  ng-click="editOrDuplicate('duplicate',row.id, batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                    <a class="dropdown-item text-secondary"  ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                    <a class="dropdown-item text-secondary"  ng-click="Transfers(batch.id)"><i class="bi bi-arrows-move me-1"></i>Transfer</a>

                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <a ng-if="batch.require_outlife_tracking ==  1" class="dropdown-item text-secondary" ng-click="RepackTransfers('view',batch , row)">
                            <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                        </a>
                        <a ng-if="batch.require_outlife_tracking ==  0 || batch.require_outlife_tracking ===  null" class="dropdown-item text-secondary link-disabled">
                            <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                        </a>
                    {{--  ==== REPACK OUTLIFE ====  --}}

                    {{--  ==== REPACK OUTLIFE ====  --}}
                        <a ng-if="batch.require_outlife_tracking ==  1" class="dropdown-item text-secondary"  ng-click="RepackOutlife(batch, row.unit_of_measure)">
                            <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                        </a>
                        <a ng-if="batch.require_outlife_tracking ==  0 || batch.require_outlife_tracking ===  null" class="dropdown-item link-disabled">
                            <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                        </a>
                    {{--  ==== REPACK OUTLIFE ====  --}}

                    <a class="dropdown-item text-secondary" ng-click="printBatchLabel(batch.id)" ><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                    <a class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a>  
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