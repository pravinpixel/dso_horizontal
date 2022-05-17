@extends('layouts.app')
@section('content') 
    <div ng-app="SearchAddApp" ng-controller="SearchAddController">
        
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button data-bs-toggle="modal" data-bs-target="#ImportFromExcel" class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                <a href="{{ route('create.material-product',['type'=>'form-one']) }}" class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</a>
            </div>
        </div> 
 
        {{-- = ==== Filletrs ====--}}
            @include('crm.material-products.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <div class="table-responsive">
            <table class="table table-centered table-bordered table-hovered bg-white ">
                <thead>
                    <tr>
                        <th ng-show="on_item_description" class="position-relative table-th child-td-lg">Item Description 
                            <i ng-click="sort_by('id', 'asc')" class="bi bi-arrow-up  position-absolute top-0 right-0 cur_ponit"></i>
                            <i ng-click="sort_by('id', 'desc')" class="bi bi-arrow-down  position-absolute bottom-0 right-0 cur_ponit"></i>
                        </th>
                        {!! $table_th_columns !!} 
                        <th class="table-th child-td">Actions</th>
                    </tr> 
                </thead>  
                <tbody>
                    <tr class="table-tr"  ng-repeat="(index,row) in material_products.data track by row.id">
                    {{-- <tr class="table-tr" ng-if="row.access.includes(auth_id) || auth_role == 'admin'" ng-repeat="(index,row) in material_products.data track by row.id"> --}}
                        <td colspan="12" class="p-0 border-bottom ">
                            <table class="table table-centered m-0" ng-class="row.is_draft == 1 ? 'bg-draft' : ''">
                                <tr>
                                    <td class="child-td-lg" ng-show="on_item_description">
                                        <i class="bi bi-caret-right-fill float-start table-toggle-icon  " data-bs-toggle="collapse" href="#row_@{{ index+1 }}" role="button" aria-expanded="false" aria-controls="row_@{{ index+1 }}"></i> 
                                        @{{ row.item_description }} 
                                    </td>
    
                                    {!! $table_td_columns !!}
    
                                    <td class="child-td">
                                        <div class="dropdown">
                                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a> 
                                            <div class="dropdown-menu" >
                                                <a ng-click="view_material_product(row)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-eye-fill me-1"></i>View </a>
                                                <a ng-click="editOrDuplicate('edit', row.id, row.batches[0].id)" class="dropdown-item" href="javascript:void(0)"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                                                <a ng-click="delete_material_product(row.id)"  class="dropdown-item text-danger" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="collapse show" id="row_@{{ index+1 }}">
                                    <td colspan="12" class="p-0">
                                        <table class="table table-centered m-0" ng-class="row.is_draft == 1 ? 'bg-draft' : 'bg-white'">
                                            <tr ng-repeat="batch in row.batches">
                                                <td class="child-td-lg" ng-show="on_item_description"></td>   
    
                                                {!! $batch_table_td_columns !!}
    
                                                <td class="child-td">
                                                    <div class="dropdown">
                                                        <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a> 
                                                        <div class="dropdown-menu"> 
                                                            <a class="dropdown-item text-secondary" href="#" ng-click="view_batch_details(row, batch)"><i class="bi bi-eye"></i> View batch details</a>
                                                            <a class="dropdown-item text-secondary" href="#" ng-click="editOrDuplicate('duplicate',row.id, batch.id)"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                            <a class="dropdown-item text-secondary" href="#" ng-click="editOrDuplicate('edit',row.id, batch.id)"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                            <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                            
                                                            {{--  ==== REPACK OUTLIFE ====  --}}
                                                                <a ng-if="row.outlife_tracking ==  1" class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackTransfers">
                                                                    <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                                                                </a>
                                                                <a ng-if="row.outlife_tracking ==  0 || row.outlife_tracking ===  null" class="dropdown-item text-secondary link-disabled">
                                                                    <i class="bi bi-box-seam me-1"></i>Repack/Transfer 
                                                                </a>
                                                            {{--  ==== REPACK OUTLIFE ====  --}}
                                                            
                                                            {{--  ==== REPACK OUTLIFE ====  --}}
                                                                <a ng-if="row.outlife_tracking ==  1" class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackOutlife">
                                                                    <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                                                                </a>
                                                                <a ng-if="row.outlife_tracking ==  0 || row.outlife_tracking ===  null" class="dropdown-item link-disabled">
                                                                    <i class="bi bi-box2-fill me-1"></i>Repack/outlife
                                                                </a>
                                                            {{--  ==== REPACK OUTLIFE ====  --}}
                                                            
                                                            <a class="dropdown-item text-secondary" onclick="printModal()" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                            <a class="dropdown-item text-danger" ng-click="delete_batch_material_product(batch.id)" href="javascript:void(0)"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> 
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
        </div>
        <div class="pb-3">
            <page-pagination></page-pagination>
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

@section('scripts')
    <input type="hidden" id="get-material-products" value="{{ route('get-material-products') }}">
    <input type="hidden" id="delete-material-products" value="{{ route('delete-material-products') }}">
    <input type="hidden" id="delete-material-products-batch" value="{{ route('delete-material-products-batch') }}">
    <input type="hidden" id="get-save-search" value="{{ route('get-save-search') }}">
    <input type="hidden" id="auth-id" value="{{ Sentinel::getUser()->id }}">
    <input type="hidden" id="auth-role" value="{{ Sentinel::getUser()->roles[0]->slug }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="{{ asset('public/asset/js/modules/SearchAddApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/SearchAddController.js') }}"></script>
    <script src="{{ asset('public/asset/js/directives/pagePagination.js') }}"></script>
@endsection