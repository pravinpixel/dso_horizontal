@extends('crm.reports.index')
 
@section('report_content')  
    @if (count($product_batches) != 0) 
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" min="1" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button class="btn btn-info rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export as CSV</button>
            </div>
        </div>
        <table class="table m-0 table-bordered table-striped">
            <thead>
                <tr>
                    <th class="table-th text-center">S.No</th>
                    <th class="table-th text-center">Transaction date </th>
                    <th class="table-th text-center">Transaction time </th>
                    <th class="table-th text-center">Transaction By </th>
                    <th class="table-th text-center">Module </th>
                    <th class="table-th text-center">Action Taken </th>
                    <th class="table-th text-center">Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_batches as $i => $row)
                    <tr>
                        <td class="text-center py-1">{{ $i+1 }}</td>
                        <td class="text-center py-1">{{ $row->created_at->format('Y-m-d') }} </td>
                        <td class="text-center py-1">{{ $row->created_at->format('h:m A') }} </td>
                        <td class="text-center py-1">{{ $row->User->alias_name }} </td>
                        <td class="text-center py-1">{{ $row->module_name }} </td>
                        <td class="text-center py-1">{{ $row->action_type }} </td>
                        <td class="text-center py-1">{{ $row->remarks }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        @else
       {!! no_data_found() !!}
    @endif
@endsection