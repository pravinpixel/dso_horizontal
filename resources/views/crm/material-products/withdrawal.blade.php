@extends('layouts.app')
@section('content') 
    <div ng-app="SearchAddApp" ng-controller="SearchAddController">
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" min="1"  ng-model="barcode_number" min="1" ng-change="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div> 
            <div class="col text-end">
                @include('crm.partials.table-column-filter') 
            </div>
        </div>
        <div class="card" ng-if="withdrawalType">
            <ul class="nav nav-tabs bg-light">
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DIRECT_DEDUCT' ? 'active' : ''">
                        <i class="mdi mdi-home-variant d-md-none d-block"></i>
                        <span class="d-none d-md-block">Direct Deduct</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DEDUCT_TRACK_USAGE' ? 'active' : ''">
                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                        <span class="d-none d-md-block">Deduct & Track Usage</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" ng-class="withdrawalType == 'DEDUCT_TRACK_OUTLIFE' ? 'active' : ''">
                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                        <span class="d-none d-md-block">Deduct & Track Outlife</span>
                    </a>
                </li> 
            </ul>
            <section class="border border-top-0 card-body">
                <div class="mb-3">
                    @include('crm.partials.data-table')
                </div>
                <div ng-if="withdrawalType == 'DIRECT_DEDUCT'"> 
                    <table class="table bg-white table-bordered table-hover">
                        <thead>
                            <tr class="bg text-white">
                                <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="7"><span class="text-center">Withdrawal Cart</span></th>
                            </tr>
                            <tr>
                                <th class="table-th child-td">Item description</th>
                                <th class="table-th child-td">Brand</th>
                                <th class="table-th child-td">Batch#/ Serial#</th>
                                <th class="table-th child-td">Pkt size</th>
                                <th class="table-th child-td">Withdraw Qty</th>
                                <th class="table-th child-td">Remarks</th>
                                <th class="table-th child-td"> <i class="text-danger bi bi-trash3-fill"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($key=0; $key<2; $key++)
                                @if ($key == 1)
                                
                                <tr class="bg-secondary text-white">
                                <td class="child-td">Prepreg C3K</td>
                                    <td class="child-td">Brand 1</td>
                                    <td class="child-td">Roll2/1</td>
                                    <td class="child-td">0.5L</td>
                                    <td class="child-td"><input type="number" disabled name="" class="form-control w-auto p-0 form-control-sm text-center" value="10"></td>
                                    <td class="child-td"><input type="text"  name="" class="form-control w-auto p-0 form-control-sm text-center" value="AME"></td>
                                    <td class="child-td">
                                        <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                    </tr>
                                @endif
                                
                                @if ($key ==0)
                                <tr>
                                <td class="child-td">Prepreg C3K</td>
                                <td class="child-td">Brand 1</td>
                                    <td class="child-td">Roll2/1</td>
                                    <td class="child-td">0.5L</td>
                                    <td class="child-td"><input type="number" disabled name="" class="form-control w-auto p-0 form-control-sm text-center" value="10"></td>
                                    <td class="child-td"><input type="text"  name="" class="form-control w-auto p-0 form-control-sm text-center" value="AME"></td>
                                    <td class="child-td">
                                        <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                </tr> 
                                @endif 
                            @endfor
                        </tbody>
                    </table>
                    <div class="text-end ">
                        <button class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
                    </div>
                </div>
                <div ng-if="withdrawalType == 'DEDUCT_TRACK_USAGE'">
                    <table class="table bg-white table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="bg-dark text-white" style="padding: 5px !important" colspan="8"><span class="text-center">Bulk vol tracking logsheet</span></th>
                            </tr>
                            <tr>
                                <th class="table-th child-td-lg"> Item Description</th>                    
                                <th class="table-th child-td">Batch/Serial#</th>
                                <th class="table-th child-td">Last accessed</th>
                                <th class="table-th">Date&time stamp</th> 
                                <th class="table-th">Used Amt (kg)</th>
                                <th class="table-th">Remain Amt (kg)</th>
                                <th class="table-th">Remarks</th>
                                <th class="table-th"> <i class="text-danger bi bi-trash3-fill"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="child-td"> Acetone IND</td>
                                <td class="child-td">XOX</td>
                                <td class="child-td">Tan Ng Hui Beng</td>
                                <td class="child-td">5</td>
                                <td class="child-td"><input type="number" name="" id="" class="form-control w-50 text-center mx-auto p-0" value="10"></td>
                                <td class="child-td">40</td>
                                <td class="child-td"><input type="text" name="" id="" class="form-control w-50 text-center mx-auto p-0"  ></td>
                                <td class="child-td">
                                    <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center">
                        <div class="shadow-sm border col-3">
                            <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of material/product</label>
                        </div>
                        <div class="col-6 ms-auto text-end">
                            {{-- <button class="btn btn-success h-100 rounded-pill">Print Barcode</button> --}}
                            <button class="btn btn-info h-100 rounded-pill">Export Logsheet</button>
                            <button class="btn btn-primary h-100 rounded-pill">Click to Confirm deduction</button>
                        </div>
                    </div>
                </div>
                <div ng-if="withdrawalType == 'DEDUCT_TRACK_OUTLIFE'">
                    <table class="table bg-white table-bordered">
                        <thead>
                            <tr class="bg text-white">
                                <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span></th>
                            </tr>
                            <tr>
                                <th class="table-th child-td">Item description</th>
                                <th class="table-th child-td">Brand</th>
                                <th class="table-th child-td">Batch#/ Serial#</th>
                                <th class="table-th child-td">Last accessed</th>
                                <th class="table-th child-td">Date & time stamp</th>
                                <th class="table-th child-td">Unique Barcode Label</th>
                                <th class="table-th child-td">Pkt size</th>
                                <th class="table-th child-td">Qty</th>
                                <th class="table-th child-td">Remarks</th>
                                <th class="table-th child-td">Outlife expiry from last date/time</th>
                                <th class="table-th child-td">Outlife expiry from current date/time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="child-td">Prepreg C3K</td>
                                <td class="child-td">Brand 1</td>
                                <td class="child-td">Roll2/1</td>
                                <td class="child-td">4</td>
                                <td class="child-td">22-12-2022 1:05</td>
                                <td class="child-td">369854</td>
                                <td class="child-td">10</td>
                                <td class="child-td">2</td>
                                <td class="child-td"><input type="text"  name="" class="form-control  p-0 form-control-sm text-center"></td>
                                <td class="child-td">25 days 16 hour</td>
                                <td class="child-td">22-12-2022 1:05</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-end ">
                        <button class="btn btn-info rounded-pill">Confirm Deduction</button>
                        <button class="btn btn-primary rounded-pill">Print outlife expiry</button>
                    </div>
                </div>
            </section>
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
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/asset/css/vendors/date-picker.css') }}" />
@endsection
@section('scripts')
    <input type="hidden" id="page-name" value="{{ $page_name }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public/asset/js/vendors/daterangepicker.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script> --}}
    <script src="https://code.angularjs.org/snapshot/angular-sanitize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.6.4/angular-messages.js"></script>    
    <script src="{{ asset('public/asset/js/vendors/date-picker.js') }}"></script>
    <script src="{{ asset('public/asset/js/modules/SearchAddApp.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/SearchAddController.js') }}"></script>
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
 