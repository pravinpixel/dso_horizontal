@extends('layouts.app')
@section('content')
    <div ng-app="RootApp" ng-controller="RootController">
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" min="1" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button data-bs-toggle="modal" data-bs-target="#ImportFromExcel" class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                 <button ng-click="export()" class="btn btn-success rounded-pill mx-1"><i class="bi bi-box-arrow-right"></i> Export from Excel</button>
                <a href="{{ route('create.material-product',['type'=>'form-one']) }}" class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</a>
            </div>
            
        </div>

        {{-- = ==== Filletrs ====--}}
            @include('crm.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <section>
            @include('crm.partials.data-table')
        </section>

        {{-- ======= START : App Models ==== --}}
            @include('crm.material-products.modals.view-batch-list')
            @include('crm.material-products.modals.view-list')
            @include('crm.material-products.modals.advance-search')
            @include('crm.material-products.modals.saved-search')
            @include('crm.material-products.modals.transfer')
            @include('crm.material-products.modals.repack-transfers')
            @include('crm.material-products.modals.repack-outlife')
            @include('crm.material-products.modals.import-from-excel')
        {{-- ======= END : App Models ==== --}}
    </div>
@endsection 
@include('includes.dso-datatable')