@extends('crm.reports.index')
 
@section('report_content')  
    @if (count($actions) != 0) 
        <div class="card"> 
            <div class="card-body">
                <table class="table m-0 pt-2 table-sm text-center" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center">S.No</th>
                            <th class="text-white bg-primary-2 text-center">Transaction date </th>
                            <th class="text-white bg-primary-2 text-center">Transaction time </th>
                            <th class="text-white bg-primary-2 text-center">Transaction By </th>
                            <th class="text-white bg-primary-2 text-center">Module </th>
                            <th class="text-white bg-primary-2 text-center">Action Taken </th>
                            <th class="text-white bg-primary-2 text-center">Comments</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table> 
            </div> 
        </div>
        @else
       {!! no_data_found() !!}
    @endif
@endsection
 
@section('scripts')
    <script>
        var table = $('#custom-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('reports.history') }}",
                data: function (d) {
                    d.action_type = $('#ActionType').val()
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'TransactionDate', name: 'TransactionDate'},
                {data: 'TransactionTime', name: 'TransactionTime'},
                {data: 'TransactionBy', name: 'TransactionBy'},
                {data: 'module_name', name: 'module_name'},
                {data: 'action_type', name: 'action_type'},
                {data: 'Remarks', name: 'Remarks'}
            ]
        });
        $("#custom-data-table_filter").append(`
            <label class="ms-3">
                Filters:
                <select id="ActionType" class="form-select" style="display: inline-block;width:auto">
                    <option value="">--Select Status--</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}">{{ $action }}</option>
                    @endforeach
                </select>
            </label>
        `);
        $('#ActionType').change(function(){
            table.draw();
        });
    </script>
@endsection