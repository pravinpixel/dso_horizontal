<div class="box" ng-show="on_item_description"></div>   

@foreach ($tableAllColumns as $column) 
    <div ng-if="on_{{ $column['name'] }}" class="box">
        @if ($column['name']=="iqc_status")
            <small class="badge badge-success-lighten rounded-pill">PASS</small>
            @elseif($column['name']=="date_of_expiry")
                {{ $column['batch'] }}
                <i class="ms-1 text-{{ $column['name']  == 1 ? "success" : "danger"}} dot-sm bi bi-circle-fill"></i>
            @elseif($column['name']=="used_for_td_expt_only")
                -
            @else
                {!! $column['batch'] !!}
        @endif 
    </div>
@endforeach

<div class="box box-sm">
    <div class="dropdown">
        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
        </a> 
        <div class="dropdown-menu"> 
            <a class="dropdown-item text-secondary" href="#" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</a>
            <a class="dropdown-item text-secondary" href="#" ng-click="editOrDuplicate('duplicate',row.id, batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</a>
            <a class="dropdown-item text-secondary" href="#" ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
            {{--  ==== REPACK OUTLIFE ====  --}}
                <a ng-if="row.outlife_tracking ==  1" class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackTransfers">
                    <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                </a>
                <a ng-if="row.outlife_tracking ==  0 || row.outlife_tracking ===  null" class="dropdown-item text-secondary link-disabled">
                    <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                </a>
            {{--  ==== REPACK OUTLIFE ====  --}}
            {{--  ==== REPACK OUTLIFE ====  --}}
                <a ng-if="row.outlife_tracking ==  1" class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackOutlife">
                    <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                </a>
                <a ng-if="row.outlife_tracking ==  0 || row.outlife_tracking ===  null" class="dropdown-item link-disabled">
                    <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                </a>
            {{--  ==== REPACK OUTLIFE ====  --}}
            <a class="dropdown-item text-secondary" onclick="printModal()" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
            <a class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
        </div>
    </div>
</div>