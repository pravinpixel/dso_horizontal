@extends('crm.reports.index')

@section('report_content')
    @if (count($disposed) != 0)
        <div class="card border shadow-sm col-md-6 mx-auto">
            <div class="card-body">
                <form action="{{ route('reports.export_disposed_items') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="date" name="start_date"class="form-control form-control-sm">
                        <input type="date" name="end_date"class="form-control form-control-sm">
                        <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel</button>
                    </div>
                </form>
            </div>
        </div>
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
                            <th class="text-white bg-primary-2 text-center font-14">Before Quantity</th>
                            <th class="text-white bg-primary-2 text-center font-14">Disposed Quantity</th>
                            <th class="text-white bg-primary-2 text-center font-14">After Quantity</th> 
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
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'TransactionDate',
                    name: 'TransactionDate'
                },
                {
                    data: 'TransactionTime',
                    name: 'TransactionTime'
                },
                {
                    data: 'TransactionBy',
                    name: 'TransactionBy'
                },
                {
                    data: 'ItemDescription',
                    name: 'ItemDescription'
                },
                {
                    data: 'BatchSerial',
                    name: 'BatchSerial'
                },
                {
                    data: 'UnitPackingValue',
                    name: 'UnitPackingValue'
                },
                {
                    data: 'BeforeQuantity',
                    name: 'BeforeQuantity'
                },
                {
                    data: 'DisposedQuantity',
                    name: 'DisposedQuantity'
                },
                {
                    data: 'AfterQuantity',
                    name: 'AfterQuantity'
                },
            ]
        });
    </script>
@endsection
