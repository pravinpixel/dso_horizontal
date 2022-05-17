@foreach ($tableAllColumns as $column) 
    <th ng-if="on_{{ $column['name'] }}" class="position-relative table-th child-td">
        <i ng-click="sort_by('{{ $column['name'] }}', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
        <i ng-click="sort_by('{{ $column['name'] }}', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
        <span class="text-capitalize">
            {{ str_replace('_', " ", $column['name']) }}
        </span>
    </th>
@endforeach