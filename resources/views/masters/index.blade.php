@extends('layouts.app')
@section('content')

    <div class="row" ng-app="MasterApp" ng-controller="MasterController">
        <div class="col-sm-3 mb-2 mb-sm-0">
            <h3 class="h4 mb-3">Menus List</h3>
            <ul class="list-group">
                <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['master.item-description','master-settings']) ? "active" : '' }}" href="{{ route('master.item-description') }}"><i class="bi bi-diagram-2-fill fa-2x me-2"></i> Item Description</a>
                <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['user.index','user.create','user.edit']) ? "active" : '' }}" href="{{ route('user.index') }}"><i class="bi bi-person-plus-fill fa-2x me-2"></i>Users</a>
                <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['role.index','role.create','role.edit']) ? "active" : '' }}" href="{{ route('role.index') }}"><i class="bi bi-person-rolodex fa-2x me-2"></i>Roles</a>
            </ul>
        </div> 
        <div class="col-sm-9 p-0"> 
            @yield('masters') 
        </div> 
        <div class="modal fade" id="edit_modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h4 class="modal-title" id="mySmallModalLabel">Edit Form</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" ng-model="editNameValue">
                    </div>
                    <div class="modal-footer border-top">
                        <a ng-click="UpdateMasterData()" class="btn btn-primary w-100">Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script>
        var app = angular.module('MasterApp', []);

        app.controller('MasterController', function($scope, $http) {
            $scope.updateMasterName ;
            $scope.GetMaster    = function (params) {
                $http.get("{{ route('get_masters') }}")
                .then(function(response) {
                    $scope.masterData       = response.data.master_category; 
                    $scope.statutoryData    = response.data.statutory;
                    $scope.pack_sizeData    = response.data.pack_size;
                    $scope.storageRoomData  = response.data.storage_room;
                    $scope.DepartmentsData  = response.data.departments;
                    $scope.houseTypesData   = response.data.house_types;
                });
            }
            $scope.GetMaster();

            $scope.StoreMasterData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.name = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            } 
            $scope.StoreStatutoryData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.statutory = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.StorePackingSizeData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.pake_name = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.StoreStorageRoomData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.storeage_room = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.StoreDepartmentsData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.department = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.StoreHouseTypeData = function (input_name, modal_type) {
                if(input_name == '' || input_name == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.store.category') }}', 
                    data: {
                        name: input_name, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.house_type = ''
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.EditMasterData = function (id, modal_type) {
                $scope.update_id = id 
                $http({
                    method: 'POST', 
                    url: '{{ url("") }}'+'/edit-setting/'+id, 
                    data: {
                        name: id, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.editNameValue = response.data.name;
                    $scope.modal_type    =  modal_type;
                    $("#edit_modal").modal("show");

                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
            $scope.UpdateMasterData = function () {
               
               if($scope.editNameValue == '' || $scope.editNameValue == null ) {
                    Message('danger', 'Field is required'); 
                    return false;
                }
                $http({
                    method: 'POST', 
                    url: '{{ route('master.update.category') }}', 
                    data: {
                        name: $scope.editNameValue, 
                        type: $scope.modal_type,
                        id:$scope.update_id
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    $scope.statutory = '';
                    $("#edit_modal").modal("hide");
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });

            }
            $scope.DeleteMasterData = function (id, modal_type) {
                swal({
                    text: "Are you sure want to Delete?",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn-light rounded-pill btn",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes! Delete",
                            value: true,
                            visible: true,
                            className: "btn btn-danger rounded-pill",
                            closeModal: true
                        }
                    }, 
                }).then((isConfirm) => {
                    if(isConfirm) {
                        $http({
                            method: 'POST', 
                            url: '{{ url("") }}'+'/delete-setting/'+id, 
                            data: {
                                id: id, 
                                type: modal_type
                            }
                        }).then(function(response) {
                            $scope.data = response.data;
                            $scope.GetMaster();
                            Message('success', response.data.message); 
                        }, function(response) {
                            $scope.data = response.data || 'Request failed';
                        });
                    }
                });
            }
        });
    </script>
@endsection 

@section('scripts')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function view_alls(source) {
            var checkboxes = document.getElementsByClassName('view');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function add_alls(source) {
            var checkboxes = document.getElementsByClassName('add');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function edit_alls(source) {
            var checkboxes = document.getElementsByClassName('edit');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function delete_alls(source) {
            var checkboxes = document.getElementsByClassName('delete');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection 
