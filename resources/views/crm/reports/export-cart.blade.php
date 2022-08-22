@extends('crm.reports.index')
 
@section('report_content') 
    <div>
        <div class="d-flex align-items-center mb-3">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" min="1" ng-model="barcode_number" min="1" ng-keyup="search_barcode_number()" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end ms-auto text-end">
                <button class="btn btn-info rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export as CSV</button>
            </div>
        </div>

        {{-- = ==== Filletrs ====--}}
            @include('crm.partials.table-filter')
        {{-- ====== Filletrs ===--}}
         
        <section>
            @include('crm.partials.data-table')
        </section>

        <div>
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="7"><span class="text-center">Export Cart </span></th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
                         <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
                         <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td">Withdraw Qty</th>
                        <th class="table-th child-td"> <i class="text-danger bi bi-trash3-fill"></i></th>
                    </tr>
                </thead>
                <tbody> 											
                    <tr>
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                        <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr>  										 
                    <tr class="bg-secondary text-white">
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                            <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr> 
                </tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Generate</button>
            </div>
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
