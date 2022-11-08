@extends('crm.reports.index')
 
@section('report_content')  
    @if (count($disposed) != 0) 
        <div class="card"> 
            <div class="card-body">
                <table class="table m-0 pt-2 table-sm text-center" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                            <th class="text-white bg-primary-2 text-center font-14">Transaction date </th>
                            <th class="text-white bg-primary-2 text-center font-14">Transaction time </th>
                            <th class="text-white bg-primary-2 text-center font-14">Transaction By </th>
                            <th class="text-white bg-primary-2 text-center font-14">Item Description</th>
                            <th class="text-white bg-primary-2 text-center font-14">Batch/Serial</th>
                            <th class="text-white bg-primary-2 text-center font-14">Unit packing value</th>
                            <th class="text-white bg-primary-2 text-center font-14">Quantity</th>
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
                url: "{{ route('reports.disposed_items') }}", 
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'transaction_date', name: 'transaction_date'},
                {data: 'transaction_time', name: 'transaction_time'},
                {data: 'transaction_by', name: 'transaction_by'},
                {data: 'item_description', name: 'item_description'},
                {data: 'batch_serial', name: 'batch_serial'},
                {data: 'unit_pack_value', name: 'unit_pack_value'},
                {data: 'quantity', name: 'quantity'}
            ]
        }); 
        $("#custom-data-table_length").prepend(`
            <a href="{{ route('reports.export_disposed_items') }}" class="btn btn-info rounded-pill me-3" autocomplete="off"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export as CSV</a>
        `);
    </script>
@endsection