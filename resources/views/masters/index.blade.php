@extends('layouts.app')
@section('content')

    <div class="row" ng-app="MasterApp" ng-controller="MasterController">
        <div class="col-sm-3 mb-2 mb-sm-0"> 
            <ul class="list-group">
                <a class="list-group-item align-items-center d-flex">
                    <i class="bi bi-list fa-2x me-2"></i>
                    <strong class="h4">Menus List</strong>
                </a>
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
