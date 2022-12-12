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
                {data: 'DT_RowIndex', name: 'id'},
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
                        <option value="{{ $action }}">{{ ucwords(strtolower(str_replace('_', " " , $action))) }}</option>
                    @endforeach
                </select>
            </label>
        `);
        $("#custom-data-table_length").prepend(`
            <a href="{{ route('reports.export') }}" class="btn btn-info rounded-pill me-3" autocomplete="off"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export as CSV</a>
        `);

        $('#ActionType').change(function(){
            table.draw();
        });
    </script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            function load_data(start_date = '', end_date = '',barcode = '')    {
                $('#custom-data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('reports.disposed_items') }}",
                        data:{
                            start_date:start_date,
                            end_date:end_date,
                            barcode:barcode
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        { data: 'TransactionDate', name: 'TransactionDate' },
                        {data: 'TransactionTime',name: 'TransactionTime'},
                        {data: 'TransactionBy',name: 'TransactionBy'},
                        {data: 'ItemDescription',name: 'ItemDescription'},
                        {data: 'BatchSerial',name: 'BatchSerial'},
                        {data: 'UnitPackingValue',name: 'UnitPackingValue'},
                        {data: 'BeforeQuantity',name: 'BeforeQuantity'},
                        {data: 'DisposedQuantity',name: 'DisposedQuantity'},
                        {data: 'AfterQuantity',name: 'AfterQuantity'},
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var start_date = $('#start_date').val();
                var end_date   = $('#end_date').val();
                var barcode   = $("#barcode").val();

                $('#custom-data-table').DataTable().destroy();
                load_data(start_date, end_date , barcode);

            });

            $('#refresh').click(function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('#barcode').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
