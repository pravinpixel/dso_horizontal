@extends('crm.reports.index')

@section('report_content')
    @if (count($DeductTrackUsage) != 0)
        <form action="{{ route('reports.deduct_track_usage_download') }}" method="POST">
            @csrf
            <div class="row m-0 justify-content-center">
                <div class="col-6">
                    <div class="table-fillters row m-0 border">
                        <div class="col">
                            <label for="" class="form-label">Scan Barcode</label>
                            <input type="text" name="barcode" id="barcode" class="form-control custom" placeholder="Scan here...">
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
                    <div class="table-responsive">
                        <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                            <thead>
                                <tr>
                                    <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Item Description</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Brand</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Barcode</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Batch Serial</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Unit Packing Value</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Storage Area</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Housing</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Owners</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Transaction Date</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Transaction Time</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Transaction By</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Used Amount</th>
                                    <th class="text-white bg-primary-2 text-center font-14">Remaining Amount</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
        {!! no_data_found() !!}
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            function load_data(barcode = '')    {
                $('#custom-data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('reports.deduct_track_usage') }}",
                        data:{
                            barcode:barcode
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data:"ItemDescription",name:"ItemDescription"},
                        {data:"Brand",name:"Brand"},
                        {data:"Barcode",name:"Barcode"},
                        {data:"BatchSerial",name:"BatchSerial"},
                        {data:"UnitPackingValue",name:"UnitPackingValue" },
                        {data:"StorageArea",name:"StorageArea"},
                        {data:"Housing",name:"Housing"},
                        {data:"Owners",name:"Owners"},
                        {data:"TransactionDate",name:"TransactionDate"},
                        {data:"TransactionTime",name:"TransactionTime"},
                        {data:"TransactionBy",name:"TransactionBy"},
                        {data:"UsedAmount",name:"UsedAmount"},
                        {data:"RemainingAmount",name:"RemainingAmount"},
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var barcode   = $("#barcode").val();
                $('#custom-data-table').DataTable().destroy();
                load_data(barcode);
            });

            $('#refresh').click(function(){
                $('#barcode').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
