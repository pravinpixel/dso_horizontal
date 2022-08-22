@extends('crm.reports.index')
 
@section('report_content') 
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
        @for ($i=0; $i<8; $i++)
            <tr>
                <td class="text-center py-1">{{ $i+1 }}</td>
                <td class="text-center py-1">1{{ $i+1 }}-03-2022 </td>
                <td class="text-center py-1">0{{ $i+1 }}:1{{ $i+1 }} AM </td>
                <td class="text-center py-1">Transaction By </td>
                <td class="text-center py-1">Module </td>
                <td class="text-center py-1">Action Taken </td>
                <td class="text-center py-1">Comments</td>
            </tr>
        @endfor
    </tbody>
</table>
@endsection