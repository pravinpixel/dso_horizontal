@extends('layouts.app')
@section('content') 
    <div ng-app="RootApp" ng-controller="RootController">
        <div class="d-flex align-items-center mb-3 justify-content-between">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" onkeyup="withdrawal_search_barcode_number(this)" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                    <i ng-click="resetBarCode()" class="bi bi-x-circle-fill font-20 text-danger position-absolute right-0 me-2" style="cursor: pointer;z-index:111"></i>
                </div>
            </div> 
            <div class="col-1 text-end">
                <div ng-show="withdrawalType">
                    @include('crm.partials.table-column-filter') 
                </div>
            </div>
        </div>  
        <div >
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span>Direct Deduct</span>
                        <span class="badge bg-primary ms-2">@{{ directDeduct.length }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                        <span>Deduct & Track Usage</span>
                        <span class="badge bg-primary ms-2">@{{ deductTrackUsage.length }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        <span>Deduct & Track Outlife</span>
                        <span class="badge bg-primary ms-2">@{{ deductTrackOutlife.length }}</span>
                    </a>
                </li>
            </ul>
      
            <div class="tab-content border border-top-0 p-3 m-0 bg-white">
                <div class="tab-pane show active" id="home">
                    @include('crm.material-products.withdrawal.direct-deduct')
                </div>
                <div class="tab-pane" id="profile">
                    @include('crm.material-products.withdrawal.deduct-track-useage')
                </div>
                <div class="tab-pane" id="settings">
                    @include('crm.material-products.withdrawal.deduct-track-outlife')
                </div>
            </div> 
 
            {{-- <ul class="nav nav-tabs bg-light">
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DIRECT_DEDUCT' ? 'active' : ''">
                        <i class="mdi mdi-home-variant d-md-none d-block"></i>
                        <span class="d-none d-md-block">Direct Deduct</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DEDUCT_TRACK_USAGE' ? 'active' : ''">
                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                        <span class="d-none d-md-block">Deduct & Track Usage</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DEDUCT_TRACK_OUTLIFE' ? 'active' : ''">
                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                        <span class="d-none d-md-block">Deduct & Track Outlife</span>
                    </a>
                </li> 
            </ul> 
            <section class="border border-top-0 card-body"> 
                <div>
                </div>
            </section> --}}
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
    <input type="hidden" id="page-name" value="{{ $page_name }}">
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
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script> --}}
    <script src="https://code.angularjs.org/snapshot/angular-sanitize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.6.4/angular-messages.js"></script>    
    <script src="{{ asset('public/asset/js/vendors/date-picker.js') }}"></script>
    <script src="{{ asset('public/asset/js/modules/RootApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/RootController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/RepackOutlife.js') }}"></script>  
    <script>
            wordMatchSuggest = (element) => {
            $.ajax({
                type    :   'GET',
                url     :   "{{ route('suggestion') }}",
                data    :  {
                    "name"  : element.name,
                    "value" : element.value,
                } ,
                success:function(response){
                    $(`#${element.list.id}`).html('')
                    if(response.data != undefined || response.data != null) {
                        Object.values(response.data).map((item) => { 
                            if(element.value !== item) {
                                $(`#${element.list.id}`).append(`<option value="${item}">`)
                            }
                        })
                    }
                }
            });
        }
    </script>
@endsection
 