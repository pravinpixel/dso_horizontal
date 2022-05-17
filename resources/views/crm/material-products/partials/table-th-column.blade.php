<div ng-show="on_item_description" class="sticky-left">
    <div class="box position-relative h-100 th">
        Item Description 
        <i ng-click="sort_by('id', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
        <i ng-click="sort_by('id', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
    </div>
</div>
@foreach ($tableAllColumns as $column) 
    <div ng-if="on_{{ $column['name'] }}" class="position-relative box th">
        <i ng-click="sort_by('{{ $column['name'] }}', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
        <i ng-click="sort_by('{{ $column['name'] }}', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
        <span class="text-capitalize">
            {{ str_replace('_', " ", $column['name']) }}
        </span>
    </div>
@endforeach
<div class="box th box-sm">Actions</div>
 