@extends('crm.reports.index')

@section('report_content')
    @if (count($DeductTrackUsage) != 0) 
        <form action="{{ route('reports.deduct_track_usage_download') }}" method="POST" class="text-end mb-3">
            @csrf
            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel</button>
        </form>
        <div class="card">
            <div class="card-body">
                <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                            <th class="text-white bg-primary-2 text-center font-14">Item Description</th>
                            <th class="text-white bg-primary-2 text-center font-14">Brand</th>
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
                url: "{{ route('reports.deduct_track_usage') }}",
            },
            columns: [{data: 'DT_RowIndex',name: 'id'},
                {data:"ItemDescription",name:"ItemDescription"},
                {data:"Brand",name:"Brand"},          
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
            ]
        });
    </script>
@endsection

    {{-- <form action="{{ route('reports.deduct_track_usage_download') }}" method="POST">
        @csrf
        <cart-table type="{{ $page_name }}"></cart-table> 
    </form>  --}}