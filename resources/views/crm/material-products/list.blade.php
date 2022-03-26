@extends('layouts.app')
@section('content') 
    <div >
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div> 
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                <a href="{{ route('mandatory-form-one') }}" class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</a>
            </div>
        </div>

        @include('includes.sections.filter')
        
        <div ng-app="SearchAddApp" ng-controller="SearchAddController">
            <table class="table table-centered table-bordered table-hover bg-white">
                <thead>
                    <tr>
                         <th class="table-th child-td-lg"> Item Description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch/Serial#</th>
                        <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td">Qty</th>
                        <th class="table-th child-td-lg">Owner1/2</th>
                        <th class="table-th child-td">Storage Room</th>
                        <th class="table-th child-td">Housing type</th>
                        <th class="table-th child-td">DOE</th>
                        <th class="table-th child-td">QC status</th>
                        <th class="table-th child-td">Used for TD/Expt</th>
                        <th class="table-th child-td">Actions</th>
                    </tr> 
                </thead> 
                <tr>
                    <td colspan="12" class="text-center" ng-show="material_products.length == 0">
                        No data found
                    </td>
                </tr>
                <tr class="table-tr" ng-show="material_products.length != 0" ng-repeat="(index,row) in material_products track by row.id">
                    <td colspan="12" class="p-0 border-bottom">
                        <table class="table table-centered m-0">
                            <tr>
                                <td class="child-td-lg">
                                    <i class="bi bi-caret-right-fill float-start   table-toggle-icon" data-bs-toggle="collapse" href="#row_@{{ index+1 }}" role="button" aria-expanded="false" aria-controls="row_@{{ index+1 }}"></i> 
                                    @{{ row.item_description }}
                                </td>
                                <td class="child-td">@{{ row.brand }}</td>
                                <td class="child-td"></td>
                                <td class="child-td">@{{ row.unit_packing_size }}L</td>
                                <td class="child-td">@{{ row.quantity }} <i class="text-success dot-sm bi bi-circle-fill"></i></td>
                                <td class="child-td-lg"></td>
                                <td class="child-td"></td>
                                <td class="child-td"></td>
                                <td class="child-td"></td>
                                <td class="child-td"></td>
                                <td class="child-td"></td>
                               <td class="child-td">
                                    <div class="dropdown">
                                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a> 
                                        <div class="dropdown-menu" >
                                            <a ng-click="view_material_product(row)" class="dropdown-item"><i class="bi bi-eye-fill me-1"></i>View </a>
                                            <a ng-click="edit_material_product(row.id)" class="dropdown-item"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                                            <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                            <tr class="collapse show" id="row_@{{ index+1 }}">
                                <td colspan="12" class="p-0">
                                    <table class="table table-centered bg-white m-0">
                                        @for ($key2=0; $key2<4; $key2++)
                                            <tr>
                                                <td class="child-td-lg"></td>
                                                <td class="child-td"></td>   
                                                @if ($key2 == 0)
                                                <td class="child-td">Batch/1</td>
                                                @endif
                                                @if ($key2 == 1)
                                                <td class="child-td">Batch/2</td>
                                                @endif 
                                                @if ($key2 == 2)
                                                <td class="child-td">Batch/3</td>
                                                @endif
                                                @if ($key2 == 3)
                                                <td class="child-td">Batch/4</td>
                                                @endif  
                                                @if ($key2 == 0)
                                                <td class="child-td">1L</td>
                                                @endif
                                                @if ($key2 == 1)
                                                <td class="child-td">1L</td>
                                                @endif 
                                                @if ($key2 == 2)
                                                <td class="child-td">0.5L</td>
                                                @endif
                                                @if ($key2 == 3)
                                                <td class="child-td">5L</td>
                                                @endif  
                                                <td class="child-td">
                                                    @if ($key2 == 0)
                                                    30
                                                    @endif
                                                    @if ($key2 == 1)
                                                    9
                                                    @endif 
                                                    @if ($key2 == 2)
                                                    2
                                                    @endif
                                                    @if ($key2 == 3)
                                                    10
                                                    @endif  
                                                </td>
                                                <td class="child-td-lg">Keith/HuiBeng</td>
                                                <td class="child-td">CW</td>
                                                <td class="child-td">FC1</td>
                                                <td class="child-td">
                                                    @if ($key2 == 0)
                                                        <small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small>
                                                    @endif
                                                    @if ($key2 == 1)
                                                        <small class="d-flex">31/10/2021  <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small>
                                                    @endif 
                                                    @if ($key2 == 2)
                                                        <small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small>
                                                    @endif
                                                    @if ($key2 == 3)
                                                        <small class="d-flex">31/10/2021  <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small>
                                                    @endif  
                                                </td>
                                                <td class="child-td">
                                                    @if ($key2 == 0)
                                                        <small class="badge badge-success-lighten rounded-pill">PASS</small>
                                                    @endif
                                                    @if ($key2 == 1)
                                                        <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                    @endif 
                                                    @if ($key2 == 2)
                                                        <small class="badge badge-success-lighten rounded-pill">PASS</small>
                                                    @endif
                                                    @if ($key2 == 3)
                                                        <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                    @endif 
                                                </td>
                                                <td class="child-td">-</td>
                                                <td class="child-td">
                                                    <div class="dropdown">
                                                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a> 
                                                        <div class="dropdown-menu"> 
                                                            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View batch details</a>
                                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackTransfers"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackOutlife"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                            <a class="dropdown-item text-secondary" onclick="printModal()" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                            <a class="dropdown-item text-danger" onclick="deleteModal()" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> 
                                        @endfor
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr> 
            </table>
            <div id="View_Material_Product_Details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog w-100 modal-right h-100">
                    <div class="modal-content h-100 rounded-0">
                        <div class="modal-header bg-primary text-white border-0 rounded-0">
                            <h4>View Material / Product details</h4>
                            <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                        </div>
                        <div class="modal-body modal-scroll-2"> 
                            <ol class="list-group ">
                                <li class="list-group-item list-group-item-action" ng-repeat="(index, row) in view_material_product_data">
                                    <b>@{{ row.name }}</b>
                                    <div class="mt-1">@{{ row.item }}</div>
                                </li> 
                            </ol> 
                        </div> 
                    </div> 
                </div>
            </div>
        </div> 
        <div id="Transfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog custom-modal-dialog modal-top">
                <div class="modal-content rounded-0 border-bottom shadow">
                    <div class="modal-header rounded-0 bg-primary text-white  ">
                        <h4 class="modal-title" id="topModalLabel">Transfer batch</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body  ">
                        <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                            <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                <tr>
                                    <th width="200px">Transfer Qty</th>
                                    {{-- <th>Storage room (able to add in new rooms in the future)</th>
                                    <th>Housing type (able to add in new housing type in the future)</th> --}}
                                    <th>Storage room </th>
                                    <th>Housing type </th>
                                    <th>Housing No.</th>
                                    <th>Owner 1</th>
                                    <th>Owner 2</th>
                                    <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">AR</option> 
                                            <option value="">CW</option> 
                                            <option value="">MA</option> 
                                            <option value="">SP</option> 
                                            <option value="">MR</option> 
                                            <option value="">Polymer</option> 
                                            <option value="">ChemShed1</option> 
                                            <option value="">ChemShed2</option> 
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value=""> Flammable Cabinet</option>
                                            <option value=""> Acid Cabinet</option>
                                            <option value=""> Base Cabinet</option>
                                            <option value=""> Metal Cabinet</option>
                                            <option value=""> Racks</option>
                                            <option value=""> Dry Cabinet</option>
                                            <option value=""> Pallet </option>
                                            <option value=""> Freezer</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value=""> -</option>
                                            @for ($key=0;$key<20;$key++)
                                                <option value="">@{{ index+1 }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">Beng HJibn</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">HuiBeng</option>
                                        </select>
                                    </td>
                                    <td>
                                        <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div> 
                    <div class="modal-footer text-end  border-top">
                        <button class="btn btn-primary rounded-pill">Click to confirm transfer</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div> 
        <div id="RepackTransfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog custom-modal-dialog modal-top">
                <div class="modal-content rounded-0 border-bottom shadow">
                    <div class="modal-header rounded-0 bg-primary text-white  ">
                        <h4 class="modal-title" id="topModalLabel">Repack/Transfer Material/Product batch</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <h5 class="h5 text-primary text-center"> Bulk vol tracking logsheet (Drum)</h5>
                                <table class="table table-centered bg-white table-bordered table-hover custom-center mb-3">
                                    <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                        <tr>
                                   
                                            <th>Time stamp</th>
                                            <th>Current accessed</th>
                                            <th>Input Used amt (L)</th>
                                            <th>Remain Amt (L)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0">10/09/2021 at 08:00</td>
                                            <td style="padding: 0">Ziv</td>
                                            <td style="padding: 0"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                                            <td style="padding: 0">15</td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <h5 class="h5 text-primary text-center">Repacked mat/product tracking logsheet (Repack)</h5>
                                <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                                    <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                        <tr>
                                            <th width="200px">Repack Size(L)</th>
                                             <th>Qty</th>
                                            <th>Storage Room</th>
                                            <th>Housing type</th>
                                             <th>Housing No</th>
                                            <th>Owner 1</th>
                                            <th>Owner 2</th>
                                            <th>Generate Unique Barcode</th>
                                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0" width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
                                            <td style="padding: 0">
                                                <select name="" id="" class="form-select form-select-sm">
                                                    <option value="">CW</option>
                                                </select>
                                            </td>
                                              <td style="padding: 0">15</td>
                                            <td style="padding: 0">
                                                <select name="" id="" class="form-select form-select-sm">
                                                    <option value="">FC1</option>
                                                </select></td>
                                           <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value=""> -</option>
                                            @for ($key=0;$key<20;$key++)
                                                <option value="">@{{ index+1 }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                            <td style="padding: 0">
                                                <select name="" id="" class="form-select form-select-sm">
                                                    <option value="">Keith</option>
                                                </select>
                                            </td>
                                            <td style="padding: 0">
                                                <select name="" id="" class="form-select form-select-sm">
                                                    <option value="">HuiBeng</option>
                                                </select>
                                            </td>
                                              <td style="padding: 0">Batch2/1</td>
                                            <td style="padding: 0">
                                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="modal-footer text-end  border-top">
                        <button class="btn btn-primary rounded-pill">Click to confirm and proceed to print label page</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div> 
        <div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog custom-modal-dialog modal-top">
                <div class="modal-content rounded-0 border-bottom shadow">
                    <div class="modal-header rounded-0 bg-primary text-white  ">
                        <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>				  
                    <div class="modal-body  ">
                     <h5 class="h5 text-primary text-center">Mat/Pdt outlife logsheet</h5>
                        <table class="table table-centered  bg-white table-bordered table-hover custom-center m-0">
                            <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                <tr>
                                    <th width="200px">(Mother)Material/Product Draw status</th>
                                    <th>Date/time stamp</th>
                                    <th>Last accessed</th>
                                    <th>Auto-generate unique barcode label</th>
                                    <th>Qty cut (kitted prepreg)</th>
                                    <th>
                                        Remaining outlife (prepreg roll)
                                        Intital count: 
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <input type="number" name="" id="" style="width: 45px" value="30" class="me-1 p-0 text-center form-control form-control-sm"> days
                                        </div>
                                    </th>
                                    <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="300px" colspan="3">
                                        <div class="row mb-2">
                                            <div class="col p-0">
                                                <button class="btn btn-success">Draw Out</button>
                                            </div>
                                            <div class="col p-0">11/09/2021 08:00</div>
                                            <div class="col p-0">HuiBeng</div>
                                        </div>
                                        <div class="row ">
                                            <div class="col p-0">
                                                <button class="btn btn-secondary">Draw in</button>
                                            </div>
                                            <div class="col p-0">11/09/2021 08:00</div>
                                            <div class="col p-0">HuiBeng</div>
                                        </div>
                                    </td>
                                    <td>
                                        Roll2/1 
                                    </td>
                                    <td class="text-center"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                                    <td>29 days 17hrs</td>
                                    <td>
                                        <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <div class="card-footer ">
                        <div class="row align-items-center">
                            <div class="shadow-sm border col-4">
                                <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of batch</label>
                            </div>
                            <div class="col-6 ms-auto text-end">
                                <button class="btn btn-primary rounded-pill h-100">Save and Submit</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script>
        var app = angular.module('SearchAddApp', []);
        app.controller('SearchAddController', function($scope, $http) {
            $scope.get_material_products =  function  () {
                $http({
                    method: 'get', 
                    url: "{{ route('get-material-products') }}",  
                }).then(function(response) {
                    $scope.material_products = response.data.data;              
                }, function(response) {
                    Message('danger', response.data.message);
                });
            }
            $scope.get_material_products();

            $scope.view_material_product = function (row) {
                $('#View_Material_Product_Details').modal('show'); 
                $scope.view_material_product_data  = [
                    {name: 'Item description' , item : row.item_description},
                    {name: 'In-house Product Logsheet ID#' , item : row.in_house_product_logsheet_id},
                    {name: 'EUC material' , item : row.euc_material},
                    {name: 'Brand' , item : row.brand},
                    {name: 'Supplier' , item : row.supplier},
                    {name: 'Unit Packing size' , item : row.unit_packing_size},
                    {name: 'Statutory body' , item : row.statutory_body},
                    {name: 'Owner 1' , item : row.owner_one},
                    {name: 'Owner 2 (SE/PL/FM)' , item : row.owner_two},
                    {name: 'Remarks' , item : row.remarks},
                    {name: 'Alert Threshold Qty for new material/product description' , item : row.alert_threshold_qty_for_new},
                    {name: 'Alert before expiry (in terms of weeks) for new material/product description' , item : row.alert_before_expiry},
                    {name: 'Access' , item : row.access},
                ] 
            }

            $scope.edit_material_product = function (id) {
                var route =  "{{ route('material-product.edit-form-one') }}"+'/'+ id
                window.location.replace(route);
            }

            $scope.delete_material_product = function (id) {
               var route = "{{ route('delete-material-products') }}"+"/"+id
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
                            url: route, 
                        }).then(function(response) {
                            $scope.data = response.data; 
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