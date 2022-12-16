@extends('crm.reports.index')

@section('report_content')
    <form action="{{ route('reports.utilization-cart') }}" method="POST">
        @csrf
        <div class="row m-0 justify-content-center">
            <div class="col-8">
                <div class="table-fillters row m-0 border">
                    <div class="col">
                        <label for="" class="form-label">Start Date</label>
                        <input type="month" onchange="setMonthValidateion(this.value)" name="start_month" id="start_month" class="form-control custom" placeholder="DD/MM/YYYY">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">End Date</label>
                        <input type="month" name="end_month" id="end_month" class="form-control custom" placeholder="DD/MM/YYYY">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Actions</label>
                        <div class="btn-group w-100">
                            <button type="button" name="filter" id="filter" class="btn-sm btn btn-primary form-control-sm"><i class="fa fa-refresh"></i> Generate</button>
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
            <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                <thead>
                    <tr>
                        <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                        <th class="text-white bg-primary-2 text-center font-14">Item Description</th>
                        <th class="text-white bg-primary-2 text-center font-14">Brand</th>
                        <th class="text-white bg-primary-2 text-center font-14">Batch / Serial</th>
                        <th class="text-white bg-primary-2 text-center font-14">Unit Packing Value</th>
                        <th class="text-white bg-primary-2 text-center font-14">Total Quantity</th>
                        <th class="text-white bg-primary-2 text-center font-14">Average Quantity</th>
                        <th class="text-white bg-primary-2 text-center font-14">Maximum Quantity</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            function load_data(start_month = '', end_month = '',barcode = '')    {
                $('#custom-data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('reports.utilization-cart') }}",
                        data:{
                            start_month:start_month,
                            end_month:end_month,
                            barcode:barcode
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data: "item_description" , name:"item_description"},
                        {data: "brand" , name:"brand"},
                        {data: "batch_serial" , name:"batch_serial"},
                        {data: "unit_packing_value" , name:"unit_packing_value"},
                        {data: "total_quantity" , name:"total_quantity"},
                        {data: "average_quantity" , name:"average_quantity"},
                        {data: "maximum_quantity" , name:"maximum_quantity"},
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var start_month = $('#start_month').val();
                var end_month   = $('#end_month').val();
                var barcode   = $("#barcode").val();

                $('#custom-data-table').DataTable().destroy();
                load_data(start_month, end_month , barcode);

            });

            setMonthValidateion = (month) => {
                $('#end_month').attr('min',month);
            }
            $('#refresh').click(function(){
                $('#start_month').val('');
                $('#end_month').val('');
                $('#barcode').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
