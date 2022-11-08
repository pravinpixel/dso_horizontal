@extends('crm.reports.index')

@section('report_content')
    @if (count($expired_material) != 0)
        <div class="card border shadow-sm col-md-6 mx-auto">
            <div class="card-body">
                <form action="{{ route('reports.export_expired_material') }}" method="POST">
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
            <div class="card-body table-responsive">
                <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                            <th class="text-white bg-primary-2 text-center font-14">Category</th>    
                            <th class="text-white bg-primary-2 text-center font-14">Item description</th>      
                            <th class="text-white bg-primary-2 text-center font-14">batch serial</th>          
                            <th class="text-white bg-primary-2 text-center font-14">unit packing value</th>    
                            <th class="text-white bg-primary-2 text-center font-14">quantity</th>              
                            <th class="text-white bg-primary-2 text-center font-14">storage area</th>          
                            <th class="text-white bg-primary-2 text-center font-14">housing</th>               
                            <th class="text-white bg-primary-2 text-center font-14">date of expiry</th>        
                            {{-- <th class="text-white bg-primary-2 text-center font-14">used for td expt only</th>  --}}
                            <th class="text-white bg-primary-2 text-center font-14">department</th>            
                            <th class="text-white bg-primary-2 text-center font-14">owners</th>                
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
                url: "{{ route('reports.expired_material') }}",
            },
            columns: [
                {data: 'DT_RowIndex',name: 'id'},
                {data:"category_selection",name:"category_selection"},
                {data:"item_description",name:"item_description"},
                {data:"batch_serial",name:"batch_serial"},
                {data:"unit_packing_value",name:"unit_packing_value"},
                {data:"quantity",name:"quantity"} ,
                {data:"storage_area",name:"storage_area"},
                {data:"housing",name:"housing"},
                {data:"date_of_expiry",name:"date_of_expiry"},
                // {data:"used_for_td_expt_only",name:"used_for_td_expt_only"} ,
                {data:"department",name:"department"},
                {data:"owners",name:"owners"},
            ]
        });
    </script>
@endsection
