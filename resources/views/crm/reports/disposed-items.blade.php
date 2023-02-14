@extends('crm.reports.index')

@section('report_content')
    @if (count($disposed) != 0)
        <form action="{{ route('reports.export_disposed_items') }}" method="POST">
            @csrf
            <div class="row m-0 justify-content-center">
                <div class="col-8">
                    <div class="table-fillters row m-0 border">
                        <div class="col">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control custom" placeholder="DD/MM/YYYY">
                        </div>
                        <div class="col">
                            <label for="" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control custom" placeholder="DD/MM/YYYY">
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Actions</label>
                            <div class="btn-group w-100">
                                <button type="button" name="filter" id="filter" class="btn-sm btn btn-primary form-control-sm"><i class="fa fa-search"></i></button>
                                <button type="submit" name="export" id="export" class="btn-sm btn btn-success form-control-sm"><i class="bi bi-file-earmark-spreadsheet"></i> Export</button>
                                <button type="button" name="refresh" id="refresh" class="btn-sm btn btn-warning form-control-sm"><i class="fa fa-repeat"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table class="table m-0 pt-2 table-sm text-center" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                            <th class="text-white bg-primary-2 text-center font-14">Transaction date </th>
                            <th class="text-white bg-primary-2 text-center font-14">Transaction time </th>
                            <th class="text-white bg-primary-2 text-center font-14">Transacted by </th>
                            <th class="text-white bg-primary-2 text-center font-14">Item description</th>
                            <th class="text-white bg-primary-2 text-center font-14">Batch/Serial</th>
                            <th class="text-white bg-primary-2 text-center font-14">Unit packing value</th>
                            <th class="text-white bg-primary-2 text-center font-14">Before quantity</th>
                            <th class="text-white bg-primary-2 text-center font-14">Disposed quantity</th>
                            <th class="text-white bg-primary-2 text-center font-14">After quantity</th>
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
