<div ng-show="on_item_description" class="sticky-left">
    <div class="box position-relative h-100 th box-lg">
        Item Description
        <div class="btn-sort">
            <i class="bi bi-caret-up-fill" ng-click="sort_by('item_description', 'ASC')" ></i>
            <i class="bi bi-caret-down-fill" ng-click="sort_by('item_description', 'DESC')"></i>
        </div>
    </div>
</div>
@foreach ($tableAllColumns as $column)
    <div ng-if="on_{{ $column['name'] }}" class="position-relative box th"> 
        {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
        <div class="btn-sort">
            <i class="bi bi-caret-up-fill" ng-click="sort_by('{{ $column['name'] }}', 'ASC')"></i>
            <i class="bi bi-caret-down-fill" ng-click="sort_by('{{ $column['name'] }}', 'DESC')"></i>
        </div>
    </div>
@endforeach
<div class="box th border-start {{ $page_name !== 'PRINT_BARCODE_LABEL' ? 'box-sm' : null }}">
    Actions
    {{ $page_name === 'PRINT_BARCODE_LABEL' ? '/ Qty to print' : null }}
</div>
