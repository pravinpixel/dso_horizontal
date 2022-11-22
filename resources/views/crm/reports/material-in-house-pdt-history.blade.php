@extends('crm.reports.index')
 
@section('report_content') 
    <div>
        <div class="card border shadow-sm col-md-6 mx-auto">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <h4 class="text-center mb-3">Scan Batch Barcode</h4>
                    <div class="p-1 border rounded-pill shadow-sm bg-white mb-3">
                        <div class="input-group align-items-center" title="Scan Barcode">
                            <i class="bi bi-upc-scan font-20 mx-2"></i>
                            <input type="number" min="1" ng-model="barcode_number" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill ng-pristine ng-valid ng-empty ng-valid-min ng-touched" placeholder="Click here to scan" autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="date" name="start_date" class="form-control form-control-sm">
                        <input type="date" name="end_date" class="form-control form-control-sm">
                        <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection 
@include('includes.dso-datatable')