<div ng-show="on_item_description" class="sticky-left">
    <div class="box position-relative h-100 th">
        Item Description
        <i ng-click="sort_by('id', 'asc')" class="bi bi-caret-up-fill btn-sort top-0"></i>
        <i ng-click="sort_by('id', 'desc')"
            class="bi bi-caret-down-fill btn-sort bottom-0"></i>
    </div>
</div>
@foreach ($tableAllColumns as $column)
    <div ng-if="on_{{ $column['name'] }}" class="position-relative box th">
        <i ng-click="sort_by('{{ $column['name'] }}', 'asc')"
            class="bi bi-caret-up-fill btn-sort top-0"></i>
        <i ng-click="sort_by('{{ $column['name'] }}', 'desc')"
            class="bi bi-caret-down-fill btn-sort bottom-0"></i>
        {{ ucfirst(str_replace('_', ' ', $column['name'])) }}
    </div>
@endforeach
<div class="box th border-start {{ $page_name !== 'PRINT_BARCODE_LABEL' ? 'box-sm' : null }}">
    Actions
    {{ $page_name === 'PRINT_BARCODE_LABEL' ? '/ Qty to print' : null }}
</div>
