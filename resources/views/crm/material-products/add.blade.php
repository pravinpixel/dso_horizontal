@extends('layouts.app')
@section('content')
    <div class="card border" style="overflow: hidden" ng-app="MaterialProductApp" ng-controller="MaterialProductController">
        <div class="card-header border-bottom p-0">
            <ul class="nav nav-pills bg-nav-pills nav-justified m-0">
                <li class="nav-item">
                    <a href="{{ route('mandatory-form-one') }}" class="nav-link py-2 rounded-0 {{ Route::is('mandatory-form-one') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 1</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mandatory-form-two') }}" class="nav-link py-2 rounded-0 {{ Route::is('mandatory-form-two') ? "active" : '' }}">
                        <span class="h5">Mandatory Fields Page 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('non-mandatory-form') }}" class="nav-link py-2 rounded-0 {{ Route::is('non-mandatory-form') ? "active" : '' }}">
                        <span class="h5">Non-Mandatory fields</span>
                    </a>
                </li>
            </ul>
        </div> 
        @yield('wizzard-form-content') 
    </div>

    <a href="{{ route('list-material-products') }}"><i class="bi bi-x-circle"></i> <u>Cancel & Back</u> </a>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script>
        var app = angular.module('MaterialProductApp', []);

        app.controller('MaterialProductController', function($scope, $http) {
            $scope.change_product_type =  function  () {

                if($scope.category_product_type == '') return false ;
                
                $http({
                    method: 'POST', 
                    url: "{{ route('change-product-category') }}", 
                    data: {
                        type: $scope.category_product_type
                    }
                }).then(function(response) {

                    Message('success', response.data.message);

                    if(response.data.status == true) {
                        location.reload();
                    }
                }, function(response) {
                    Message('danger', response.data.message);
                });
            }
        });
    </script>
@endsection

 