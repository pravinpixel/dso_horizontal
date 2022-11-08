@extends('layouts.app')
@section('content') 
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="{{ route('reports.utilisation_cart') }}" class="bg-none nav-link {{ Route::is(['reports','reports.utilisation_cart']) ? "active" : "" }}">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate Material/ In-house Product Utilisation rate </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.export_cart') }}" class="bg-none nav-link {{ Route::is(['reports.export_cart']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate list of Material/In-house Product</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="{{ route('reports.disposed_items') }}" class="bg-none nav-link {{ Route::is(['reports.disposed_items']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Disposed items</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports.expired_material') }}" class="bg-none nav-link {{ Route::is(['reports.expired_material']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Expired Material Report</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="{{ route('reports.history') }}" class="bg-none nav-link {{ Route::is(['reports.history']) ? "active" : "" }}">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Material/Product History</span>
            </a>
        </li>  
    </ul> 
    <section ng-app="RootApp" ng-controller="RootController" class="pt-3">
        @yield('report_content')
    </section> 
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
    <script src="{{ asset('public/asset/js/vendors/daterangepicker.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
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