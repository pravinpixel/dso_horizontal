@extends('crm.reports.index')

@section('report_content')
    <div>
        <div ng-app="RootApp" ng-controller="RootController">
            <div class="d-flex align-items-center mb-3">
                <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                    <div class="input-group align-items-center" title="Scan Barcode">
                        <i class="bi bi-upc-scan font-20 mx-2"></i>
                        <input type="number" min="1" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                    </div>
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
        <cart-table type="{{ $page_name }}"></cart-table>
    </div>
@endsection
@include('includes.dso-datatable')
