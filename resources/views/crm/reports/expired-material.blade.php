@extends('crm.reports.index')

@section('report_content')
    @if (count($expired) != 0)
        <form action="{{ route('reports.export_expired_material') }}" method="POST">
            @csrf
            <div class="row m-0 justify-content-center">
                <div class="col-8">
                    <div class="table-fillters row m-0 border">
                        <div class="col">
                            <label for="department" class="form-label">Department</label>
                            <select id="department" name="department" class="form-select custom w-100" style="display: inline-block;width:auto">
                                <option value="">-- Select --</option>
                                @foreach ($departments as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="used_for_td_expt_only" class="form-label">Used for TD/Expt only</label>
                            <select id="used_for_td_expt_only" name="used_for_td_expt_only"  class="form-select custom w-100" style="display: inline-block;width:auto">
                                <option value="">-- Select --</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
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
            <div class="card-body table-responsive">
                <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                            <th class="text-white bg-primary-2 text-center font-14">Category</th>
                            <th class="text-white bg-primary-2 text-center font-14">Item description</th>
                            <th class="text-white bg-primary-2 text-center font-14">Batch #/ Serial #</th>
                            <th class="text-white bg-primary-2 text-center font-14">unit packing value</th>
                            <th class="text-white bg-primary-2 text-center font-14">Quantity</th>
                            <th class="text-white bg-primary-2 text-center font-14">Storage area</th>
                            <th class="text-white bg-primary-2 text-center font-14">Housing</th>
                            <th class="text-white bg-primary-2 text-center font-14">Date of expiry</th>
                            <th class="text-white bg-primary-2 text-center font-14">Used for TD/Expt</th>
                            <th class="text-white bg-primary-2 text-center font-14">Department</th>
                            <th class="text-white bg-primary-2 text-center font-14">Owners</th>
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
            function load_data(department = '', used_for_td_expt_only = '')    {
                $('#custom-data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('reports.expired_material') }}",
                        data:{
                            department:department,
                            used_for_td_expt_only:used_for_td_expt_only,
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data:"category_selection",name:"category_selection"},
                        {data:"item_description",name:"item_description"},
                        {data:"batch_serial",name:"batch_serial"},
                        {data:"unit_packing_value",name:"unit_packing_value"},
                        {data:"quantity",name:"quantity"} ,
                        {data:"storage_area",name:"storage_area"},
                        {data:"housing",name:"housing"},
                        {data:"date_of_expiry",name:"date_of_expiry"},
                        {data:"used_for_td_expt_only",name:"used_for_td_expt_only"} ,
                        {data:"department",name:"department"},
                        {data:"owners",name:"owners"},
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var department = $('#department').val();
                var used_for_td_expt_only   = $('#used_for_td_expt_only').val();

                $('#custom-data-table').DataTable().destroy();
                load_data(department, used_for_td_expt_only);
            });

            $('#refresh').click(function(){
                $('#department').val('');
                $('#used_for_td_expt_only').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection

