<tr>
    <th ng-show="on_item_description" class="position-relative box th">Item Description 
        <i ng-click="sort_by('id', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
        <i ng-click="sort_by('id', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
    </th>
    @foreach ($tableAllColumns as $column) 
        <th ng-if="on_{{ $column['name'] }}" class="position-relative box th">
            <i ng-click="sort_by('{{ $column['name'] }}', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
            <i ng-click="sort_by('{{ $column['name'] }}', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
            <span class="text-capitalize">
                {{ str_replace('_', " ", $column['name']) }}
            </span>
        </th>
    @endforeach
    <th class="box th box-sm ">Actions</th>
</tr>