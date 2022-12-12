@extends('crm.reports.index')

@section('report_content')
    <div>
        <form action="{{ route('reports.material_in_house_pdt_history_download') }}" method="POST">
            @csrf
            <div class="row m-0 justify-content-center">
                <div class="col-10">
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
                    <table id="historyTable" class="table table-sm">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th style="font-weight: bold;font-size:12px">S.No</th>
                                <th style="font-weight: bold;font-size:12px">Barcode Number</th>
                                <th style="font-weight: bold;font-size:12px">Category Selection</th>
                                <th style="font-weight: bold;font-size:12px">Item Description</th>
                                <th style="font-weight: bold;font-size:12px">Brand</th>
                                <th style="font-weight: bold;font-size:12px">Batch#/Serial#</th>
                                <th style="font-weight: bold;font-size:12px">Transaction Date</th>
                                <th style="font-weight: bold;font-size:12px">Transaction Time</th>
                                <th style="font-weight: bold;font-size:12px">Transaction By</th>
                                <th style="font-weight: bold;font-size:12px">Module</th>
                                <th style="font-weight: bold;font-size:12px">Action Taken</th>
                                <th style="font-weight: bold;font-size:12px">Unit packing value</th>
                                <th style="font-weight: bold;font-size:12px">Quantity</th>
                                <th style="font-weight: bold;font-size:12px">Storage area</th>
                                <th style="font-weight: bold;font-size:12px">Housing </th>
                                <th style="font-weight: bold;font-size:12px">Owners</th>
                                <th style="font-weight: bold;font-size:12px">Remarks </th>
                                <th style="font-weight: bold;font-size:12px">Draw status</th>
                                <th style="font-weight: bold;font-size:12px;">Remaining outlife of parent </th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            function load_data(start_date = '', end_date = '',barcode = '')    {
                $('#historyTable').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('get-material-product-history') }}",
                        data:{
                            start_date:start_date,
                            end_date:end_date,
                            barcode:barcode
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data:"barcode_number" , name:"barcode_number"},
                        {data:"CategorySelection" , name:"CategorySelection"},
                        {data:"ItemDescription" , name:"ItemDescription"},
                        {data:"Brand" , name:"Brand"},
                        {data:"BatchSerial" , name:"BatchSerial"},
                        {data:"TransactionDate" , name:"TransactionDate"},
                        {data:"TransactionTime" , name:"TransactionTime"},
                        {data:"TransactionBy" , name:"TransactionBy"},
                        {data:"Module" , name:"Module"},
                        {data:"ActionTaken" , name:"ActionTaken"},
                        {data:"UnitPackingValue" , name:"UnitPackingValue"},
                        {data:"Quantity" , name:"Quantity"},
                        {data:"StorageArea" , name:"StorageArea"},
                        {data:"Housing" , name:"Housing"},
                        {data:"Owners" , name:"Owners"},
                        {data:"Remarks" , name:"Remarks"},
                        {data:"DrawStatus" , name:"DrawStatus"},
                        {data:"RemainingOutlifeOfParent" , name:"RemainingOutlifeOfParent"}
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var start_date = $('#start_date').val();
                var end_date   = $('#end_date').val();
                var barcode   = $("#barcode").val();

                $('#historyTable').DataTable().destroy();
                load_data(start_date, end_date , barcode);

            });

            $('#refresh').click(function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('#barcode').val('');
                $('#historyTable').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
