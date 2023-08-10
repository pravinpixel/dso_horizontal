@extends('crm.reports.index')

@section('report_content')
    <div>
        <form action="{{ route('reports.material_in_house_pdt_history_download') }}" method="POST">
            @csrf
            <div class="row m-0 justify-content-center">
                <div class="col-8">
                    <div class="table-fillters row m-0 border">
                        <div class="col">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" name="StartDate" id="StartDateFilter" class="form-control custom"
                                placeholder="DD/MM/YYYY" onchange="filterTable(this)">
                        </div>
                        <div class="col">
                            <label for="" class="form-label">End Date</label>
                            <input type="date" name="EndDate" id="EndDateFilter" class="form-control custom"
                                placeholder="DD/MM/YYYY" onchange="filterTable(this)">
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Actions</label>
                            <div class="btn-group w-100">
                                <button type="submit" name="export" id="export"
                                    class="btn-sm btn btn-success form-control-sm"><i
                                        class="bi bi-file-earmark-spreadsheet"></i> Export</button>
                                <button type="button" name="refresh" id="refresh"
                                    class="btn-sm btn btn-warning form-control-sm"><i class="fa fa-repeat"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border shadow-sm">
                <div class="card-body">
                    <div class="table-fillters row m-0 p-0">
                        @foreach ($filters as $index => $filter)
                            <div class="col">
                                <label class="form-label">{{ $index }}</label>
                                <select id="{{ str_replace(' ', '', $index) }}Filter" name="{{ str_replace(' ', '', $index) }}"
                                    ng-model="advanced_filter.category_selection" class="form-select custom"
                                    onchange="filterTable(this)">
                                    <option value="">-- Select --</option>
                                    @foreach ($filter as $item)
                                        @if (!is_null($item))
                                            @if ($index == 'Transaction by')
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @else
                                                <option value="{{ $item }}">
                                                    {{ ucfirst(strtolower(format_text($item))) }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div class="table-responsive">
                        <table id="historyTable" class="table table-sm">
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th style="font-weight: bold;font-size:12px">S.No</th>
                                    <th style="font-weight: bold;font-size:12px">Barcode Number</th>
                                    <th style="font-weight: bold;font-size:12px">Category Selection</th>
                                    <th style="font-weight: bold;font-size:12px">Item description</th>
                                    <th style="font-weight: bold;font-size:12px">Brand</th>
                                    <th style="font-weight: bold;font-size:12px">Batch#/Serial#</th>
                                    <th style="font-weight: bold;font-size:12px">Transaction Date</th>
                                    <th style="font-weight: bold;font-size:12px">Transaction Time</th>
                                    <th style="font-weight: bold;font-size:12px">Transacted</th>
                                    <th style="font-weight: bold;font-size:12px">Module</th>
                                    <th style="font-weight: bold;font-size:12px">Action Taken</th>
                                    <th style="font-weight: bold;font-size:12px">Unit packing value</th>
                                    <th style="font-weight: bold;font-size:12px">Quantity</th>
                                    <th style="font-weight: bold;font-size:12px">Total quantity</th>
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
        </form>
    </div>
@endsection

@section('scripts')
    <style>
        .dataTables_length {
            display: none !important
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {

            load_data = (filters) => {
                $('#historyTable').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('get-material-product-history') }}",
                        data: filters
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "barcode_number",
                            name: "barcode_number"
                        },
                        {
                            data: "CategorySelection",
                            name: "CategorySelection"
                        },
                        {
                            data: "ItemDescription",
                            name: "ItemDescription"
                        },
                        {
                            data: "Brand",
                            name: "Brand"
                        },
                        {
                            data: "BatchSerial",
                            name: "BatchSerial"
                        },
                        {
                            data: "TransactionDate",
                            name: "created_at"
                        },
                        {
                            data: "TransactionTime",
                            name: "created_at"
                        },
                        {
                            data: "TransactionBy",
                            name: "TransactionBy"
                        },
                        {
                            data: "Module",
                            name: "Module"
                        },
                        {
                            data: "ActionTaken",
                            name: "ActionTaken"
                        },
                        {
                            data: "UnitPackingValue",
                            name: "UnitPackingValue"
                        },
                        {
                            data: "Quantity",
                            name: "Quantity"
                        },
                        {
                            data: "TotalQuantity",
                            name: "TotalQuantity"
                        },
                        {
                            data: "StorageArea",
                            name: "StorageArea"
                        },
                        {
                            data: "Housing",
                            name: "Housing"
                        },
                        {
                            data: "Owners",
                            name: "Owners"
                        },
                        {
                            data: "Remarks",
                            name: "Remarks"
                        },
                        {
                            data: "DrawStatus",
                            name: "DrawStatus"
                        },
                        {
                            data: "RemainingOutlifeOfParent",
                            name: "RemainingOutlifeOfParent"
                        }
                    ],
                });
            }
            load_data();

            filterTable = (e) => {
                $('#historyTable').DataTable().destroy();
                const filters = {
                    @foreach ($filters as $index => $filter)
                        {{ str_replace(' ', '', $index) }}: $('#{{ str_replace(' ', '', $index) }}Filter')
                        .val(),
                    @endforeach
                    end_date: $('#EndDateFilter').val(),
                    start_date: $('#StartDateFilter').val()
                }
                load_data(filters);
            }
            $('#refresh').click(function() {
                $('input').val('');
                $('select').val('');
                $('#historyTable').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
