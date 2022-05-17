<td ng-show="on_item_description" class="box">
    <i class="bi bi-caret-right-fill float-start table-toggle-icon" data-bs-toggle="collapse" href="#row_@{{ index+1 }}" role="button" aria-expanded="false" aria-controls="row_@{{ index+1 }}"></i> 
    @{{ row.item_description }}
</td>

@foreach ($tableAllColumns as $column) 
    <td ng-if="on_{{ $column['name'] }}" class="box">
        {!! $column['row'] !!}
        abcd
    </td>
@endforeach
<td class="box box-sm">
    <div class="dropdown">
        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i>
        </a> 
        <div class="dropdown-menu" >
            <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
            <a ng-click="editOrDuplicate('edit', row.id, row.batches[0].id)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-pencil-square me-1"></i> Edit </a>
            <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
        </div>
    </div>
</td>