@extends('layouts.app')
@section('content') 
    <div ng-app="SearchAddApp" ng-controller="SearchAddController">
        
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button data-bs-toggle="modal" data-bs-target="#ImportFromExcel" class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                <a href="{{ route('create.material-product',['type'=>'form-one']) }}" class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</a>
            </div>
        </div>

        {{-- = ==== Filletrs ====--}}
            @include('crm.material-products.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <div class="table-responsive">
            <table class="table table-centered table-bordered table-hovered bg-white ">
                <thead>
                    {{-- ======= Table Header  ====== --}}
                        {!! $table_th_columns !!}
                    {{-- ======= Table Header  ====== --}}
                </thead>
                <tbody>
                    <tr class="table-tr"  ng-repeat="(index,row) in material_products.data track by row.id">
                    {{-- <tr class="table-tr" ng-if="row.access.includes(auth_id) || auth_role == 'admin'" ng-repeat="(index,row) in material_products.data track by row.id"> --}}
                        <td colspan="12" class="p-0 border-bottom ">
                            <table class="table table-centered m-0" ng-class="row.is_draft == 1 ? 'bg-draft' : ''">
                                <tr>
                                    {{-- ======= Matrial Product Data  ====== --}}
                                        {!! $table_td_columns !!} 
                                    {{-- ======= Matrial Product Data  ====== --}}
                                </tr>
                                <tr class="collapse show" id="row_@{{ index+1 }}">
                                    <td colspan="12" class="p-0">
                                        <table class="table table-centered m-0" ng-class="row.is_draft == 1 ? 'bg-draft' : 'bg-white'">
                                            <tr ng-repeat="batch in row.batches">
                                                {{-- ======= Matrial Product Batches Data  ====== --}}
                                                    {!! $batch_table_td_columns !!} 
                                                {{-- ======= Matrial Product Batches Data  ====== --}}
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                    <tr ng-show="material_products.data.length == 0">
                        <td colspan="12" class="text-center" >
                            No data found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pb-3">
            <page-pagination></page-pagination>
        </div>

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

@section('scripts')
    <input type="hidden" id="get-material-products" value="{{ route('get-material-products') }}">
    <input type="hidden" id="delete-material-products" value="{{ route('delete-material-products') }}">
    <input type="hidden" id="delete-material-products-batch" value="{{ route('delete-material-products-batch') }}">
    <input type="hidden" id="get-save-search" value="{{ route('get-save-search') }}">
    <input type="hidden" id="auth-id" value="{{ Sentinel::getUser()->id }}">
    <input type="hidden" id="auth-role" value="{{ Sentinel::getUser()->roles[0]->slug }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="{{ asset('public/asset/js/modules/SearchAddApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/SearchAddController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
@endsection