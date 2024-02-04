<div ng-show="on_item_description" class="sticky-left">
    <div class="box position-relative h-100 th box-lg">
        Item description
        <div class="btn-sort">
           <img src="{{url('/public/asset/images/up.svg')}}" ng-click="sort_by('item_description', 'DESC')" width="15" height="15" style="cursor: pointer;">
           &nbsp;&nbsp;
           <img src="{{url('/public/asset/images/down.svg')}}" ng-click="sort_by('item_description', 'ASC')" width="15" height="15" style="cursor: pointer;">
        </div>
    </div>
</div>
<input type="hidden" name="sort_value" id="sort_value" Value="ASC">
@foreach ($tableAllColumns as $column)
    @if ($column['name'] != 'item_description' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id')
        <div ng-if="on_{{ $column['name'] }}" class="position-relative box th">
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
                @elseif ($column['name'] == 'disposed_after')  Date of Disposal 
                @else {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
            @endif
            <div class="btn-sort">
              <img src="{{url('/public/asset/images/up.svg')}}" ng-click="sort_by('{{ $column['name'] }}', 'DESC')" width="15" height="15" style="cursor: pointer;" >
              &nbsp;&nbsp;
             <img src="{{url('/public/asset/images/down.svg')}}"ng-click="sort_by('{{ $column['name'] }}', 'ASC')"width="15" height="15" style="cursor: pointer;">
            </div>
        </div>
    @endif
@endforeach

@switch($page_name)
    @case($page_name == 'MATERIAL_SEARCH_OR_ADD')
        <div class="box th border-start box-sm">
            Actions
        </div>
    @break
    @case($page_name == 'PRINT_BARCODE_LABEL')
        <div class="box th border-start">
            Actions / Qty to print
        </div>
    @break
    @case($page_name == 'THRESHOLD_QTY')
        <div class="box th border-start">
            Read status
        </div>
    @break 
    @default
    <div class="box box-sm th border-start">
        Actions 
    </div>
@endswitch