@extends('masters.index')

@section('masters')
    <div class="row m-0 master-card-group">
        {{-- <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0"> 
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Category selection</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="name" ng-model="name" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreMasterData(name ,'category_section')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div> 
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush"> 
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in masterData track by row.id">
                            <span ng-bind="row.name"></span>
                            <div class="float-end">
                                <span ng-click="EditMasterData(row.id ,'category_section')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'category_section')"><i class="bi bi-trash text-danger"></i></span>
                            </div>
                        </li> 
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Statutory body</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input type="text" name="statutory" ng-model="statutory" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreStatutoryData(statutory ,'statutory_section')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in statutoryData">
                            <span ng-bind="row.name"></span>
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'statutory_section')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'statutory_section')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Unit of measure</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="pake_name" ng-model="pake_name" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StorePackingSizeData(pake_name ,'packing_size_section')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in pack_sizeData">
                            <span ng-bind="row.name"></span>
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'packing_size_section')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'packing_size_section')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Storage area</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="storeage_room" ng-model="storeage_room" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreStorageRoomData(storeage_room ,'storage_room')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in storageRoomData">
                            <span ng-bind="row.name"></span>
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'storage_room')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'storage_room')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div> 
        </div>
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Departments</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="department" ng-model="department" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreDepartmentsData(department ,'departments')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in DepartmentsData">
                            <span ng-bind="row.name"></span>
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'departments')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'departments')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light p-2">
                    <strong class="h5 text-primary">Housing type</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="house_type" ng-model="house_type" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreHouseTypeData(house_type ,'house_types')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-1" ng-repeat="row in houseTypesData">
                            <span ng-bind="row.name"></span>
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'house_types')"><i class="bi bi-pencil-square text-secondary me-1"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'house_types')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div> 
        </div> 
    </div>
@endsection 