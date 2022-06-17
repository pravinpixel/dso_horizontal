@extends('layouts.app')
@section('content')
    <div ng-app="PrintLabelApp" ng-controller="PrintController">
        <div> 
            <table class="table table-bordered bg-white">
                <thead class="bg-primary text-white">
                    <tr>
                        <th> Item Description</th>
                        <th>Brand</th>
                        <th>Batch/Serial#</th>
                        <th>Owner1/2</th>
                        <th>DOE</th>
                        <th>Used for TD/Expt</th> 
                        <th>Project Name</th>
                        <th>Qty to print</th>
                    </tr> 
                </thead>
                <tr>
                    <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
                    <td>{{ $batch->brand }}</td>
                    <td>{{ $batch->batch }} / {{ $batch->serial }}</td>
                    <td>{{ $batch->owner_one }} , {{ $batch->owner_one }}</td>
                    <td>{{ $batch->date_of_expiry }}</td>
                    <td>{{ $batch->used_for_td_expt_only == 1 ? "Yes" : "No" }}</td>
                    <td>{{ $batch->project_name }}</td>  
                    <td>
                        <input type="number" class="text-center fw-bold form-control form-control-sm m-0 " ng-model="print_qty">
                    </td> 
                </tr>
            </table> 
        </div>
        <div class="row m-0">
            <div class="col-md-4 p-0 pe-3" id="printableBarcodeLabel"> 
                <div class="border card text-center rounded-5 p-3 print-card" > 
                    <div class="barcode_label" ng-if="Barcode" >
                        {{ $batch->BatchBarcode->barcode_label }}
                    </div>
                    <div>
                        <small  ng-if="batch_id">Batch /{{ $batch->id }}</small>
                        <div class="text-primary">
                            <p class="m-0" ng-if="item_description">{{ $batch->BatchMaterialProduct->item_description}}</p>
                            <p class="m-0" ng-if="date_of_expiry">{{ $batch->date_of_expiry }}</p>
                            <p class="m-0" ng-if="project_name">{{ $batch->project_name }}</p>
                            <p class="m-0" ng-if="ownners">Owner1/2 : {{ $batch->owner_one }} / {{ $batch->owner_one }}</p>
                        </div> 
                    </div> 
                    <div class="border-top mt-3 pt-3 print-border">
                        <div id="printImages">
                            @if ($pictograms)
                                @foreach ($pictograms as $pictogram)
                                    <img id="pictograms_{{ $pictogram->id }}" ng-if="pictogramsLab_{{ $pictogram->id }}" src="{{ storageGet($pictogram->image) }}" class="img-png" width="50px">
                                @endforeach
                            @endif 
                        </div>
                    </div>
                    <div class="text-end">  
                        <small class="bg-dark text-white badge print-badge" ng-if="used_for_td_expt_only">Used  for TD/ EXPT</small><br>
                        <small class="text-dark" ng-if="date_of_shipment">DOD: {{ $batch->date_of_shipment }}</small>
                    </div>
                </div>  
            </div>
            <div class="col-md-8 p-0 position-relative">
                <div class="card shadow-sm border" >
                    <div class="card-header bg-light border-bottom">
                        <div class="row m-0">
                            <div class="col-md-4 d-flex align-items-center">
                                <label class="me-2">
                                    Style
                                </label>
                                <select ng-model="print_size" class="form-select form-select-md rounded-pill">
                                    <option value="">-- Select Label Size --</option>
                                    <option value="small">Small</option>
                                    <option value="big">Big</option>
                                </select>
                            </div>
                            <div class="col-md-8 text-end">
                                {{-- <button type="button" class="btn btn-success-light rounded-pill" data-bs-dismiss="modal">Amend</button> --}}
                                <button type="button" ng-click="printBarcodeLabel()" class="btn btn-primary rounded-pill"><i class="fa fa-print me-1"></i> print</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">            
                        <div class="row m-0 ">
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="Barcode" class="p-1 form-label cursor ps-2 bg-light  rounded-pill shadow-sm border w-100">
                                    <input type="checkbox" class="form-check-input checked-input me-2" ng-model="Barcode" id="Barcode">Barcode
                                </label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="Material_Description" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100">
                                    <input type="checkbox" class="form-check-input checked-input me-2" ng-model="item_description" id="Material_Description">Item description
                                </label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="Project" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" ng-model="project_name" id="Project">Project Name</label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="Batch" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" ng-model="batch_id" id="Batch">Batch ID/Serial #</label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="DOE" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" ng-model="date_of_expiry" id="DOE">DOE</label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label ng-click="GHSPictogramMenu()" for="GHS-Pictogram-checked-input" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2"  id="GHS-Pictogram-checked-input">GHS Pictogram</label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="Owner1" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" ng-model="ownners" id="Owner1">Owner1/Owner2</label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="td_expt" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" ng-model="used_for_td_expt_only" id="td_expt">Used for TD/EXPT</label>
                            </div> 
                            <div class="col-md-4 mb-2 text-start">
                                <label  for="date_of_shipment" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2"  ng-model="date_of_shipment" id="date_of_shipment">DOD</label>
                            </div>
                        </div>  
                    </div>
                </div> 
                <div class="card shadow-sm border position-absolute w-100 animate__fadeInDown animate__animated" style="top: 0" id="GHSPictogramMenu">
                    <div class="card-header border-bottom bg-light text-dark">
                        <h3 class="h5 text-center">Select the pictogram for your label:</h3>
                    </div>
                    <div class="card-body bg-white"> 
                        <div class="row m-0">
                            @if ($pictograms)
                                @foreach ($pictograms as $pictogram)
                                    <label  class="col-4 position-relative text-white row my-2"  for="pictogramsLab_{{ $pictogram->id }}">
                                        <div class="col-4">
                                            <img id="pictograms_{{ $pictogram->id }}" src="{{ storageGet($pictogram->image) }}" class="img-png" width="50px">
                                        </div>
                                        <div class="text-dark col d-flex align-items-center text-dark bg-light p-2 rounded-pill">
                                            <input type="checkbox" name="pictograms" ng-model="pictogramsLab_{{ $pictogram->id }}" id="pictogramsLab_{{ $pictogram->id }}" class="checked-input me-1 form-check-input">
                                            <span><b>{{ $pictogram->name }}</b></span>
                                        </div>
                                    </label>
                                @endforeach
                            @endif 
                        </div>
                        <hr>
                        <button class="btn btn-light border rounded-pill my-2" ng-click="confirmGHS()">
                            <i class="fa fa-times me-1"> </i> Close
                        </button>  
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    <div id="printBox" class="d-none bg-primary"></div>
@endsection
@section('styles')
    <style>
        @font-face {
            font-family: 'barcode font';
            font-style: normal;
            font-weight: 400;
            src: local('barcode font'), url('https://fonts.cdnfonts.com/s/10997/BarcodeFont.woff') format('woff');
        }
    </style>


    <style>
        #printImages img {
            width: 95px !important
        }
         
        .barcode_label {
            font-family: 'barcode font', Courier;
            font-size: 58px !important;
            color: black !important;
            letter-spacing: 3px
        }
    </style>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="{{ asset('public/asset/js/controllers/PrintLabelController.js') }}"></script>
@endsection