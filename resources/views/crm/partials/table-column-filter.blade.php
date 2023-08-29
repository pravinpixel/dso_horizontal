<div class="tableColumns-dropdown">
    <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-caret-down-square-fill"></i>  
    </button>
    <div class="tableColumns-menu"> 
        <div class="menu-list" ng-init="@foreach ($tableAllColumns as $column)@if ($column['name'] != 'unit_of_measure' && $column['name'] != 'barcode_number' && $column['name'] != 'housing') on_{{ $column['name'] }} = {{ $column['status'] == 1 ? 'true' : 'false' }}; @endif @endforeach "> 
            <label>
                <input type="checkbox" ng-model="on_all_check_box" ng-change="select_all_check_box()" class="form-check-input me-1">
                <span>All</span>
            </label> 
            @foreach ($tableAllColumns as $column)  
                @if ($column['name'] != 'barcode_number' && $column['name'] != 'unit_of_measure' &&  $column['name'] != 'housing' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id' && $column['name'] != 'packing_size')
                    <label> 
                        <input type="checkbox" ng-checked="{{ $column['status'] == 1  && $column['name'] != 'barcode_number' ? true : false }}" ng-model="on_{{ $column['name'] }}" id="on_{{ $column['name'] }}" class="form-check-input me-1">
                        <small>
                            @if ($column['name'] == 'iqc_status')
                                IQC status 
                                @elseif ($column['name'] == 'is_draft') Status
                                @elseif ($column['name'] == 'housing_type') Housing
                                @elseif ($column['name'] == 'owner_two') Owners
                                @elseif ($column['name'] == 'serial')Batch# / Serial#
                                @elseif ($column['name'] == 'po_number') PO number
                                @elseif ($column['name'] == 'cas') CAS#
                                @elseif ($column['name'] == 'euc_material') EUC material
                                @elseif ($column['name'] == 'material_product_type') Material/Product type 
                                @elseif ($column['name'] == 'alert_threshold_qty_upper_limit') Alert threshold Qty (upper limit)
                                @elseif ($column['name'] == 'alert_threshold_qty_lower_limit') Alert threshold Qty (lower limit)
                                @elseif ($column['name'] == 'alert_before_expiry') Alert before expiry (weeks)
                                @elseif ($column['name'] == 'euc_material') EUC Material
                                @elseif ($column['name'] == 'outlife'  ) Outlife (days)
                                @elseif ($column['name'] == 'used_for_td_expt_only'  ) Used for TD/Expt only
                                @elseif ($column['name'] == 'extended_qc_status')  Extended QC status 
                                @else {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
                            @endif
                        </small>
                    </label>
                @endif
            @endforeach
        </div>
    </div>
</div>