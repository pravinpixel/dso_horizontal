@extends('layouts.app')
@section('content') 
    <div ng-app="SearchAddApp" ng-controller="SearchAddController">
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" min="1"  ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end"></div>
        </div>

        {{-- = ==== Filletrs ====--}}
            @include('crm.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <div class="table-responsive shadow-lg bg-white">
            <div class="custom-table d-none" style=" min-height: 460px !important;">
                <div class="custom-table-head">
                    {{-- ======= Table Header  ====== --}}
                        {!! $table_th_columns !!}
                    {{-- ======= Table Header  ====== --}}
                </div>
                <div class="custom-table-body">
                    <div class="custom-table-row"  ng-repeat="(index,row) in material_products.data" >
                        {{--  ng-if="row.access.includes(auth_id) || auth_role == 'admin'"  > --}}
                        <div class="custom-table">
                            <div class="custom-table-head">
                                {{-- ======= Matrial Product Data  ====== --}}
                                    {!! $table_td_columns !!} 
                                {{-- ======= Matrial Product Data  ====== --}}
                            </div>
                            <div class="custom-table collapse show batch-table" id="row_@{{ index+1 }}">
                                <div class="custom-table-row " ng-repeat="batch in row.batches" ng-class="batch.is_draft == 1 ? 'drafted' : 'non-drafted'">
                                    {{-- ======= Matrial Product Batches Data  ====== --}}
                                        {!! $batch_table_td_columns !!} 
                                    {{-- ======= Matrial Product Batches Data  ====== --}}
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div ng-show="material_products.data.length == 0">
                        <div colspan="12" class="text-center" >
                            No data found
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <page-pagination>
            </page-pagination>
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
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/asset/css/vendors/date-picker.css') }}" />
@endsection
@section('scripts')
    <input type="hidden" id="get-material-products" value="{{ route('get-material-products') }}">
    <input type="hidden" id="delete-material-products" value="{{ route('delete-material-products') }}">
    <input type="hidden" id="delete-material-products-batch" value="{{ route('delete-material-products-batch') }}">
    <input type="hidden" id="get-save-search" value="{{ route('get-save-search') }}">
    <input type="hidden" id="get-batch-material-products" value="{{ route("get-batch-material-products") }}">
    <input type="hidden" id="get-batch" value="{{ route("get-batch") }}">
    <input type="hidden" id="get_masters" value="{{ route("get_masters") }}">
    <input type="hidden" id="transfer_batch" value="{{ route("transfer-batch") }}"> 
    <input type="hidden" id="repack_batch" value="{{ route("repack-batch") }}"> 
    <input type="hidden" id="auth-id" value="{{ Sentinel::getUser()->id }}">
    <input type="hidden" id="auth-role" value="{{ Sentinel::getUser()->roles[0]->slug }}"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public/asset/js/vendors/daterangepicker.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.6.4/angular-messages.js"></script>    
    <script src="{{ asset('public/asset/js/vendors/date-picker.js') }}"></script>
    <script src="{{ asset('public/asset/js/modules/SearchAddApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/SearchAddController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/RepackOutlife.js') }}"></script>
@endsection