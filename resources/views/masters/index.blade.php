@extends('layouts.app')
@section('content') 
    <div class="row" ng-app="MasterApp" ng-controller="MasterController">
        <div class="col-sm-3 mb-2 mb-sm-0"> 
            <ul class="list-group">
                <a class="list-group-item align-items-center d-flex"><i class="bi bi-list font-24 me-2"></i><strong class="h4">Menu List</strong></a>
                <x-has-access name="table-order.index">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['table-order.index']) ? "active" : '' }}" href="{{ route('table-order.index') }}"><i class="bi bi-table font-24 me-2"></i> Table order</a>
                </x-has-access>
                <x-has-access :name="['master.item-description','master-settings']">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['master.item-description','master-settings']) ? "active" : '' }}" href="{{ route('master.item-description') }}"><i class="bi bi-diagram-2-fill font-24 me-2"></i> Data center </a>
                </x-has-access>
                <x-has-access :name="['user.index','user.create','user.edit']">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['user.index','user.create','user.edit']) ? "active" : '' }}" href="{{ route('user.index') }}"><i class="bi bi-person-plus-fill font-24 me-2"></i>Users</a>
                </x-has-access>
                <x-has-access :name="['role.index','role.create','role.edit']">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['role.index','role.create','role.edit']) ? "active" : '' }}" href="{{ route('role.index') }}"><i class="bi bi-person-rolodex font-24 me-2"></i>Roles</a>
                </x-has-access>
                <x-has-access :name="['help.menu.index','help.menu.create','help.menu.edit']">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['help.menu.index','help.menu.create','help.menu.edit']) ? "active" : '' }}" href="{{ route('help.menu.index') }}"><i class="bi bi-question-circle-fill font-24 me-2"></i>Help menu</a>
                </x-has-access>
                <x-has-access name="pictogram.index">
                    <a class="list-group-item list-group-item-action align-items-center d-flex {{ Route::is(['pictogram.index']) ? "active" : null }}" href="{{ route('pictogram.index') }}"><i class="bi bi-boxes font-24 me-2"></i> Pictogram</a>
                </x-has-access>
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
   
@endsection 

@section('scripts')
    <input type="hidden" value="{{ route('get_masters') }}" id="get_masters">
    <input type="hidden" value="{{ route('master.store.category') }}" id="store_master_category">
    <input type="hidden" value="{{ route('master.edit.category') }}" id="edit_master_category">
    <input type="hidden" value="{{ route('master.update.category') }}" id="update_master_category">
    <input type="hidden" value="{{ route('master.delete.category') }}" id="delete_master_category">
 
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="{{ asset('public/asset/js/modules/MasterApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/MasterController.js') }}"></script> 
@endsection 
