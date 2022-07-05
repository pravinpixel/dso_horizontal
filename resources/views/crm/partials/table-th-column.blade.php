<div ng-show="on_item_description" class="sticky-left">
    <div class="box position-relative h-100 th box-lg">
        Item Description
        <div class="btn-sort">
            <i class="bi bi-arrow-up" ng-click="sort_by('item_description', 'ASC')" ></i>
            <i class="bi bi-arrow-down" ng-click="sort_by('item_description', 'DESC')"></i>
        </div>
    </div>
</div>
@foreach ($tableAllColumns as $column)
    @if ($column['name'] != 'item_description' && $column['name'] != 'owner_one' && $column['name'] != 'batch' && $column['name'] != 'material_product_id')
        <div ng-if="on_{{ $column['name'] }}" class="position-relative box th">
            @if ($column['name'] == 'iqc_status')
                IQC Status
                @elseif ($column['name'] == 'is_draft') Status
                @elseif ($column['name'] == 'housing_type') Housing
                @elseif ($column['name'] == 'owner_two') Ownners
                @elseif ($column['name'] == 'serial')Batch# / Serial#
                @else   {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
            @endif
            <div class="btn-sort">
                <i class="bi bi-arrow-up" ng-click="sort_by('{{ $column['name'] }}', 'ASC')"></i>
                <i class="bi bi-arrow-down" ng-click="sort_by('{{ $column['name'] }}', 'DESC')"></i>
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
    @default
@endswitch