@foreach ($tableAllColumns as $column) 
    <td ng-if="on_{{ $column['name'] }}" class="child-td">
        {!! $column['row'] !!}
        abcd
    </td>
@endforeach