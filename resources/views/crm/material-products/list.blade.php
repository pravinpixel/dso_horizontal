@extends('layouts.app')
@section('content') 
    <div ng-app="SearchAddApp" ng-controller="SearchAddController">
        
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" ng-model="barcode_number" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button data-bs-toggle="modal" data-bs-target="#ImportFromExcel" class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                <a href="{{ route('mandatory-form-one') }}" class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</a>
            </div>
        </div> 
 
        {{-- = ==== Filletrs ====--}}
            <div class="table-fillters row m-0 p-2">
                <div class="col-12 mb-2 text-end d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none"   id="topnav-ecommerce" role="button"     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-caret-down-square-fill"></i>  
                        </button>
                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce" >
                            {{-- <label class="dropdown-item"><input type="checkbox" ng-model="on_item_description" class="form-check-input me-1">Item Description</label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_brand" class="form-check-input me-1">Brand</label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_batch" class="form-check-input me-1">Batch/Serial#</label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_unit_packing_size" class="form-check-input me-1">Pkt size </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_quantity" class="form-check-input me-1">Qty</label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_owner_one" class="form-check-input me-1">Owner1/2 </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_storage_room" class="form-check-input me-1">Storage Room </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_house_type" class="form-check-input me-1">Housing type  </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_date_of_expiry" class="form-check-input me-1">DOE </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_iqc_status" class="form-check-input me-1">QC status  </label> 
                            <label class="dropdown-item"><input type="checkbox" ng-model="on_used_for_td" class="form-check-input me-1">Used for TD/Expt </label>  --}}
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Category selection</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Owner ½</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Storage room</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Housing type </label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Housing #</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Owner 1/2</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Statutory board </label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">EUC Material </label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Require usage tracking</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Require outlife tracking</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Department</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date in </label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of expiry</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">QC status</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Used for TD/Expt</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">CAS #</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Project name</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Material/In-house product type</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of manufacture </label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of shipment</label>
                             <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Cost per unit </label>

                        </div>
                    </div> 
                    <button  data-bs-toggle="modal" data-bs-target="#advance-search-ng-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
                </div>
                <div class="col">
                    <label for="" class="form-label">Category selection</label>
                    <select ng-model="filter.category_selection" class="form-select custom">
                        <option value="">-- select --</option>
                        <option value="in_house">In House</option>
                        <option value="material">Material</option>
                    </select>
                </div> 
                <div class="col">
                    <label for="" class="form-label">Item description</label>
                    <input type="text" ng-model="filter.item_description" name="item_description" class="form-control custom" placeholder="Type here...">
                </div> 
                <div class="col">
                    <label for="" class="form-label">Brand</label>
                    <input type="text" ng-model="filter.brand" name="brand" class="form-control custom" placeholder="Type here...">
                </div> 
                <div class="col">
                    <label for=""  class="form-label">Owner 1/2</label>
                    <select name="owner" ng-model="filter.owner" class="form-select custom">
                        <option value="">-- select --</option>
                        @foreach ($owners as $row)
                            <option value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }}</option>
                        @endforeach 
                    </select>
                </div> 
                <div class="col">
                    <label for="" class="form-label">Dept</label>
                    <select name="dept" ng-model="filter.dept" id="" class="form-select custom">
                        <option value="">-- select --</option>
                        @foreach ($departments_db as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach 
                    </select>
                </div> 
                <div class="col">
                    <label for="" class="form-label">Storage area</label>
                    <select name="storage_area" ng-model="filter.storage_area" class="form-select custom">
                        <option value="">-- select --</option>
                        @foreach ($storage_room_db as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                        @endforeach 
                    </select>
                </div> 
                <div class="col"> 
                    <label for="" class="form-label">Date in</label>
                    <input type="date" ng-model="filter.date_in" name="date_in" class="form-control custom" placeholder="Type here...">
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <div class="btn-group">
                        <button ng-click="bulk_search()" class="btn btn-sm btn-primary rounded w-100 h-100 me-2"><i class="bi bi-search"></i></i> </button>
                        <button ng-click="reset_bulk_search()" class="btn btn-sm btn-light w-100 h-100 rounded"><i class="bi bi-arrow-counterclockwise"></i></button>
                    </div>
                </div> 
            </div>
         
        {{-- ====== Filletrs ===--}} 
    
        <table class="table table-centered table-bordered table-hovered bg-white">
            <thead>
                <tr>
                    <th ng-show="on_item_description" class="position-relative table-th child-td-lg">Item Description 
                        <i ng-click="sort_by('id', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('id', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_brand" class="position-relative table-th child-td">Brand 
                        <i ng-click="sort_by('brand', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('brand', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_batch" class="position-relative table-th child-td">Batch/Serial# 
                        <i ng-click="sort_by('batch', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('batch', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_unit_packing_size" class="position-relative table-th child-td">Pkt size 
                        <i ng-click="sort_by('unit_packing_size', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('unit_packing_size', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_quantity" class="position-relative table-th child-td">Qty 
                        <i ng-click="sort_by('quantity', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('quantity', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_owner_one" class="position-relative table-th child-td-lg">Owner1/2 
                        <i ng-click="sort_by('owner_one', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('owner_one', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_storage_room" class="position-relative table-th child-td">Storage Room 
                        <i ng-click="sort_by('storage_room', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('storage_room', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_house_type" class="position-relative table-th child-td">Housing type 
                        <i ng-click="sort_by('house_type', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('house_type', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_date_of_expiry" class="position-relative table-th child-td">DOE 
                        <i ng-click="sort_by('date_of_expiry', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('date_of_expiry', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_iqc_status" class="position-relative table-th child-td">QC status 
                        <i ng-click="sort_by('iqc_status', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('iqc_status', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th ng-show="on_used_for_td" class="position-relative table-th child-td">Used for TD/Expt 
                        <i ng-click="sort_by('item_description', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                        <i ng-click="sort_by('item_description', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                    </th>
                    <th class="table-th child-td">Actions </th>
                </tr> 
            </thead>  
            <tbody>
                <tr class="table-tr" ng-show="material_products.length != 0" ng-repeat="(index,row) in material_products.data track by row.id">
                    <td colspan="12" class="p-0 border-bottom">
                        <table class="table table-centered m-0">
                            <tr>
                                <td class="child-td-lg" ng-show="on_item_description">
                                    <i class="bi bi-caret-right-fill float-start table-toggle-icon  " data-bs-toggle="collapse" href="#row_@{{ index+1 }}" role="button" aria-expanded="false" aria-controls="row_@{{ index+1 }}"></i> 
                                    @{{ row.item_description }} |   @{{ row.id }} 
                                </td>
                                <td class="child-td" ng-show="on_brand">@{{ row.brand }}</td>
                                <td class="child-td" ng-show="on_batch"></td>
                                <td class="child-td" ng-show="on_unit_packing_size">@{{ row.unit_packing_size }}L</td>
                                <td class="child-td" ng-show="on_quantity">@{{ row.quantity }} <i class="text-success dot-sm bi bi-circle-fill"></i></td>
                                <td class="child-td-lg" ng-show="on_owner_one"></td>
                                <td class="child-td" ng-show="on_storage_room"></td>
                                <td class="child-td" ng-show="on_house_type"></td>
                                <td class="child-td" ng-show="on_date_of_expiry"></td>
                                <td class="child-td" ng-show="on_iqc_status"></td>
                                <td class="child-td" ng-show="on_used_for_td"></td>
                            <td class="child-td">
                                    <div class="dropdown">
                                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a> 
                                        <div class="dropdown-menu" >
                                            <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                                            <a ng-click="edit_material_product(row.id)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                                            <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                            <tr class="collapse show" id="row_@{{ index+1 }}">
                                <td colspan="12" class="p-0">
                                    <table class="table table-centered bg-white m-0">
                                        @for ($key2=0; $key2<2; $key2++)
                                            <tr>
                                                <td class="child-td-lg" ng-show="on_item_description"></td>
                                                
                                                <td class="child-td" ng-show="on_brand"></td>   
                                                
                                                <td class="child-td" ng-show="on_batch">
                                                    {{ $key2 == 0 ? "Batch/1" : "" }}
                                                    {{ $key2 == 1 ? "Batch/2" : "" }}
                                                </td> 

                                                <td class="child-td" ng-show="on_unit_packing_size">
                                                    {{ $key2 == 0 ? "1L" : "" }}
                                                    {{ $key2 == 1 ? "1L" : "" }}
                                                </td>   

                                                <td class="child-td" ng-show="on_quantity">
                                                    {{ $key2 == 0 ? "30" : "" }}
                                                    {{ $key2 == 1 ? "10" : "" }} 
                                                </td>

                                                <td class="child-td-lg" ng-show="on_owner_one">Keith/HuiBeng</td>
                                                <td class="child-td" ng-show="on_storage_room">CW</td>
                                                <td class="child-td" ng-show="on_house_type">FC1</td>
                                                <td class="child-td" ng-show="on_date_of_expiry">
                                                    <small class="d-flex justify-content-center">@{{ row.date_of_expiry }}  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small>
                                                </td>
                                                <td class="child-td" ng-show="on_iqc_status">
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
                                                <td class="child-td"  ng-show="on_used_for_td">-</td>
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
                <tr ng-show="material_products.data.length == 0">
                    <td colspan="12" class="text-center" >
                        No data found
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pb-3">
            <page-pagination></page-pagination>
        </div>  

        {{-- ======= START : App Models ==== --}}
            @include('crm.material-products.modals.view-list')
            @include('crm.material-products.modals.advance-search')
            @include('crm.material-products.modals.saved-search')
            @include('crm.material-products.modals.transfer')
            @include('crm.material-products.modals.transfer')
            @include('crm.material-products.modals.repack-transfers')
            @include('crm.material-products.modals.repack-outlife')
            @include('crm.material-products.modals.import-from-excel')
        {{-- ======= END : App Models ==== --}}
         
    </div>
@endsection

@section('scripts')

    <input type="hidden" id="get-material-products" value="{{ route('get-material-products') }}">
    <input type="hidden" id="edit-material-products" value="{{ route('material-product.edit-form-one') }}">
    <input type="hidden" id="delete-material-products" value="{{ route('delete-material-products') }}">
    <input type="hidden" id="get-save-search" value="{{ route('get-save-search') }}">
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <script src="{{ asset('public/asset/js/modules/SearchAddApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/SearchAddController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
@endsection