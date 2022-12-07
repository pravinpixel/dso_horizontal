@extends('crm.reports.index')

@section('report_content')
    <div>
        <div class="card border shadow-sm col-md-6 mx-auto">
            <div class="card-body">
                <div>
                    <form action="{{ route('reports.material_in_house_pdt_history_download') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control form-control-sm">
                            <input type="date" name="end_date" class="form-control form-control-sm">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="historyTable" class="table table-bordered table-sm">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th style="font-weight: bold">S.No</th>
                                <th style="font-weight: bold">Barcode Number</th>
                                <th style="font-weight: bold">Category Selection</th>
                                <th style="font-weight: bold">Item Description</th>
                                <th style="font-weight: bold">Brand</th>
                                <th style="font-weight: bold">Batch#/Serial#</th>
                                <th style="font-weight: bold">Transaction Date</th>
                                <th style="font-weight: bold">Transaction Time</th>
                                <th style="font-weight: bold">Transaction By</th>
                                <th style="font-weight: bold">Module</th>
                                <th style="font-weight: bold">Action Taken</th>
                                <th style="font-weight: bold">Unit packing value</th>
                                <th style="font-weight: bold">Quantity</th>
                                <th style="font-weight: bold">Storage area</th>
                                <th style="font-weight: bold">Housing </th>
                                <th style="font-weight: bold">Owners</th>
                                <th style="font-weight: bold">Remarks </th>
                                <th style="font-weight: bold">Draw status</th>
                                <th style="font-weight: bold">Remaining outlife of parent </th>
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
    <script>
        getMaterialProductHistoryByBarcode = (barcode_number) => {
            if(barcode_number == '' || barcode_number == undefined || barcode_number == null) {
                return false;
            }
            axios.get(`${APP_URL}/reports/check-material-product-history/${barcode_number}/true`).then(function (response) {  
                
                if(response.data.status) {
                    setTimeout(() => {
                        var historyTable = $('#historyTable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "{{ route('get-material-product-history') }}" +"/"+ barcode_number,
                            },
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'id'
                                }, 
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
                            ]
                        });
                    }, 1000);
                }
            }).catch(function (error) {
                console.log(error);
            }); 

        }
        var historyTable = $('#historyTable').DataTable({
            processing: true,
            serverSide: true,
            // retrieve: true,
            // paging: false,
            ajax: {
                url: "{{ route('get-material-product-history') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                }, 
                
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
            ]
        });
        </script>
@endsection