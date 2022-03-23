@extends('masters.index')

@section('masters')
    <div class="row m-0 master-card-group">
        <div class="col-md-4 mb-3 px-2">
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
                        <li class="list-group-item py-1" ng-repeat="row in masterData">
                            @{{ row.name }}
                            <div class="float-end">
                                <span ng-click="EditMasterData(row.id ,'category_section')"><i class="bi bi-pencil-square text-secondary"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'category_section')"><i class="bi bi-trash text-danger"></i></span>
                            </div>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
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
                        <li class="list-group-item py-1" ng-repeat="row in statutoryData">
                            @{{ row.name }}
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'statutory_section')"><i class="bi bi-pencil-square text-secondary"></i></span>
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
                    <strong class="h5 text-primary">Unit Packing size</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="pake_name" ng-model="pake_name" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StorePackingSizeData(pake_name ,'packing_size_section')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-1" ng-repeat="row in pack_sizeData">
                            @{{ row.name }}
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'packing_size_section')"><i class="bi bi-pencil-square text-secondary"></i></span>
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
                    <strong class="h5 text-primary">Storage Room</strong> 
                    <div class="btn-group w-100 mt-1">
                        <input  type="text" name="storeage_room" ng-model="storeage_room" class="form-control" placeholder="Type here" ng-required required>
                        <button  ng-click="StoreStorageRoomData(storeage_room ,'storage_room')" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-1" ng-repeat="row in storageRoomData">
                            @{{ row.name }}
                            <a class="float-end" href="">
                                <span ng-click="EditMasterData(row.id ,'storage_room')"><i class="bi bi-pencil-square text-secondary"></i></span>
                                <span ng-click="DeleteMasterData(row.id ,'storage_room')"><i class="bi bi-trash text-danger"></i></span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div> 
        </div>
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light text-primary">
                    <strong class="h5">Departments</strong> 
                    <a href="" class="float-end"><i class="fa fa-plus"></i></a>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-1">
                            EGP1
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li>
                        <li class="list-group-item py-1">
                            EGP4
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li>
                        <li class="list-group-item py-1">
                            EGP7
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li>
                        <li class="list-group-item py-1">
                            FSML
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li>
                        <li class="list-group-item py-1">
                            STML
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 px-2">
            <div class="card border m-0">
                <div class="card-header bg-light text-primary">
                    <strong class="h5">Departments</strong> 
                    <a href="" class="float-end"><i class="fa fa-plus"></i></a>
                </div>
                <div class="card-body scroll-body p-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-1"> 
                            Flammable
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Cabinet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Acid Cabinet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Base Cabinet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Metal Cabinet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Racks
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Dry Cabinet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Freezer
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li> 
                        <li class="list-group-item py-1"> 
                            Pallet
                            <a class="float-end" href="">
                                <i class="bi bi-pencil-square me-1 text-secondary"></i>
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </li>  
                    </ul>
                </div>
            </div>
        </div> 
    </div>
@endsection 