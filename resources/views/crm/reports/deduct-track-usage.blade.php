@extends('crm.reports.index')

@section('report_content')
    @if (count($DeductTrackUsage) != 0) 
        <div class="card shadow-sm border">
            <div class="card-body">
                <form action="{{ route('reports.deduct_track_usage_download') }}" method="POST">
                    @csrf
                    <div class="table-fillters row m-0 p-0">
                        @foreach ($filters as $index => $filter)
                            <div class="col">
                                <label class="form-label">
                                    @if ($index == 'batch_serial')
                                        Batch#/Serial#
                                        @elseif ($index == 'housing')
                                        Housing type and #
                                        @elseif ($index == 'last_accessed')
                                        Transacted by
                                        @else
                                        {{ ucfirst(str_replace('_'," ",  $index)) }}
                                    @endif
                                </label>
                                <select id="{{ $index }}_input" name="{{ str_replace(' ','',$index) }}" ng-model="advanced_filter.category_selection" class="form-select custom" onchange="filterTable(this)">
                                    <option value="">-- Select --</option>
                                    @foreach ($filter as $item)
                                        @if (!is_null($item))
                                            <option value="{{ $item }}">{{ ucfirst(strtolower(format_text($item))) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach 
                        <div class="col">
                            <label for="" class="form-label">Actions</label>
                            <div class="btn-group w-100">
                                <button type="submit" name="export" id="export" class="btn-sm btn btn-success form-control-sm"><i class="bi bi-file-earmark-spreadsheet"></i> Export</button>
                                <button type="button" name="refresh" id="refresh" class="btn-sm btn btn-warning form-control-sm"><i class="fa fa-repeat"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                        <thead>
                            <tr>
                                <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                                <th class="text-white bg-primary-2 text-center font-14">Item description</th>
                                <th class="text-white bg-primary-2 text-center font-14">Brand</th>
                                {{-- <th class="text-white bg-primary-2 text-center font-14">Barcode</th> --}}
                                <th class="text-white bg-primary-2 text-center font-14">Batch #/ Serial #</th>
                                <th class="text-white bg-primary-2 text-center font-14">Unit Packing Value</th>
                                <th class="text-white bg-primary-2 text-center font-14">Storage Area</th>
                                <th class="text-white bg-primary-2 text-center font-14">Housing</th>
                                <th class="text-white bg-primary-2 text-center font-14">Owners</th>
                                <th class="text-white bg-primary-2 text-center font-14">Transaction Date</th>
                                <th class="text-white bg-primary-2 text-center font-14">Transaction Time</th>
                                <th class="text-white bg-primary-2 text-center font-14">Transacted By</th>
                                <th class="text-white bg-primary-2 text-center font-14">Used total amount</th>
                                <th class="text-white bg-primary-2 text-center font-14">Remaining total amount</th>
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
            function load_data(filters)    {
                $('#custom-data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('reports.deduct_track_usage') }}",
                        data: filters
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data:"item_description",name:"item_description"},
                        {data:"brand",name:"brand"},
                        // {data:"barcode_number",name:"barcode_number"},
                        {data:"batch_serial",name:"batch_serial"},
                        {data:"unit_packing_value",name:"unit_packing_value" },
                        {data:"storage_area",name:"storage_area"},
                        {data:"housing",name:"housing"},
                        {data:"Owners",name:"Owners"},
                        {data:"TransactionDate",name:"TransactionDate"},
                        {data:"TransactionTime",name:"TransactionTime"},
                        {data:"last_accessed",name:"last_accessed"},
                        {data:"used_amount",name:"used_amount"},
                        {data:"remain_amount",name:"remain_amount"},
                    ],
                });
            } 
            load_data();

            filterTable = (e) => {
                $('#custom-data-table').DataTable().destroy();
                load_data({
                    item_description: $('#item_description_input').val(),
                    batch_serial    : $('#batch_serial_input').val(),
                    last_accessed   : $('#last_accessed_input').val(),
                    barcode_number  : $('#barcode_number_input').val(),
                    brand           : $('#brand_input').val(),
                    storage_area    : $('#storage_area_input').val(),
                    housing         : $('#housing_input').val()
                });
            }
            $('#refresh').click(function() {
                $('input').val('');
                $('select').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
