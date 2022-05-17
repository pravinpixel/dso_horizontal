@foreach ($tableAllColumns as $column) 
    <td ng-if="on_{{ $column['name'] }}" class="child-td">
        {!! $column['batch'] !!}
        abcd
    </td>
@endforeach