@extends('layouts.app')
@section('content')

<div ng-app="PrintLabelApp" ng-controller="PrintController">
    <div>
        <table class="table table-bordered bg-white custom">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-1"> Item description</th>
                    <th class="p-1">Brand</th>
                    <th class="p-1">Batch#/Serial# </th>
                    <th class="p-1">Owner1/2</th>
                    <th class="p-1">DOE</th>
                    <th class="p-1">Used for TD/Expt</th>
                    <th class="p-1">Project name</th>
                    <th class="p-1">Qty to print</th>
                </tr>
            </thead>
            <tr>
                <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
                <td>{{ $batch->brand }}</td>
                <td>{{ $batch->batch }} / {{ $batch->serial }}</td>
                <td>
                    @if (count($batch->BatchOwners))
                    @foreach ($batch->BatchOwners as $owner)
                    <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                        {{ $owner->alias_name }}
                    </small>
                    @endforeach
                    @endif
                </td>
                <td>{{ Carbon\Carbon::parse($batch->date_of_expiry)->format('d/m/Y') }}</td>
                <td>{{ $batch->used_for_td_expt_only == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $batch->project_name }}</td>
                <td>
                    @{{ print_qty }}
                </td>
            </tr>
        </table>
    </div>
    <div class="row m-0">
        <div class="col-md-4 p-0 pe-3" id="printableBarcodeLabel">
            <div class="print-card-wrapper">
                <div class="border card text-center rounded-5 p-3 print-card">
                    <div ng-if="Barcode" style="padding: 15px 0">
                        <div>{!! getBarcodeImage($batch->barcode_number) !!}</div>
                        <b>{{ (string) $batch->barcode_number }}</b>
                    </div>
                    <div>
                        <small ng-if="batch_id">
                            <b class="text-dark">Batch#/Serial#</b> : {{ $batch->batch }} / {{ $batch->serial }}
                        </small>
                        <div class="text-primary">
                            <p class="m-0" ng-if="item_description">
                                {{ $batch->BatchMaterialProduct->item_description }}</p>
                                <p class="m-0" ng-if="date_of_expiry">
                                    <b class="text-dark">DOE</b> :
                                    {{ Carbon\Carbon::parse($batch->date_of_expiry)->format('d/m/Y') }}
                                </p>
                                <p class="m-0" ng-if="project_name">
                                    <b class="text-dark">Project name</b> :
                                    {{ $batch->project_name }}
                                </p>
                                <p class="m-0" ng-if="owners"> <b class="text-dark">Owners</b> :
                                    @if (count($batch->BatchOwners))
                                    @foreach ($batch->BatchOwners as $owner)
                                    <small
                                    class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                                    {{ $owner->alias_name }}
                                </small>
                                @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="border-top mt-3 pt-1 print-border">
                        <div id="printImages">
                            @if ($pictograms)
                            @foreach ($pictograms as $pictogram)
                            <img id="pictograms_{{ $pictogram->id }}"
                            ng-if="pictogramsLab_{{ $pictogram->id }}"
                            src="{{ storageGet($pictogram->image) }}" class="img-png" width="50px">
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <table class="w-100 border-0">
                        <tr style="vertical-align: baseline;">
                            <td class="text-start" style="width:60% !important">
                                <div class="m-0 " ng-if="PrintOutlife">
                                    <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">Leftover Outlife</small><br>
                                    @if ($batch->DrawInOutlifeLatest->current_outlife_expiry ?? null)
                                    <small>{{ $batch->outlife }}</small>

                                    <div>
                                        <small class="badge badge-outline-dark shadow-sm bg-light rounded-pill">Outlife expiry date</small><br> 
                                        <small>
                                            @if(isset($batch->DrawInOutlifeLatest->current_outlife_expiry))

                                           {{SetDateFormatWithHours($batch->DrawInOutlifeLatest->current_outlife_expiry)}}
                                        @endif</small>
                                        </div>              
                                        @else
                    @php
                    $diffrence='';
                    if(isset($batch->outlife) && $batch->outlife !=NULL){
                    $diffrence=\Carbon\Carbon::now()->addDays($batch->outlife);
                  }

                                        @endphp  
                                        @if(isset($diffrence) && $diffrence!='')          
                                        {{SetDateFormatWithHours($diffrence)}}
                                        @else
                                        DD/MM/YYYY
                                        @endif
                                        @endif


                                    </div>
                                </td>
                                <td class="text-end">
                                    <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill"
                                    ng-if="used_for_td_expt_only">Used for TD/ EXPT</small><br>
                                    @if (is_null($batch->disposed_after))
                                    <small class="text-dark" ng-if="date_of_shipment">DOD: DD/MM/YYYY</small>
                                    @else
                                    <small class="text-dark" ng-if="date_of_shipment">DOD:
                                        {{ Carbon\Carbon::parse($batch->disposed_after)->format('d/m/Y') }}</small>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 p-0 position-relative">
                    <div class="card shadow-sm border">
                        <div class="card-header bg-light border-bottom">
                            <div class="row m-0">
                                <div class="col-md-3 p-0">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2">
                                            Qty
                                        </label>
                                        <input type="number" class="fw-bold form-control rounded-pill" ng-model="print_qty">
                                    </div>
                                </div>
                                <div class="col-md-4  ">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2">
                                            Style
                                        </label>
                                        <select ng-model="print_size" class="form-select form-select-md rounded-pill">
                                            <option value="">-- Select Label Size --</option>
                                            <option value="small">Small</option>
                                            <option value="big">Big</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 text-end p-0">
                                    <a href="{{ route('barcode.listing') }}"
                                    class="btn btn-light border rounded-pill shadow-sm"><i
                                    class="fa fa-times me-1"></i>Cancel & back</a>
                                    <button type="button" ng-click="printBarcodeLabel()"
                                    class="btn btn-primary rounded-pill"><i class="fa fa-print me-1"></i> Print</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="row m-0">

                                <div class="col-md-4 mb-2 text-start">
                                    <label for="Barcode"
                                    class="p-1 form-label cursor ps-2 bg-light rounded-pill shadow-sm border w-100">
                                    <input type="checkbox" class="form-check-input checked-input me-2" ng-model="Barcode"
                                    id="Barcode">Barcode
                                </label>
                            </div>
                            <div class="col-md-4 mb-2 text-start">
                                <label for="Material_Description"
                                class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100">
                                <input type="checkbox" class="form-check-input checked-input me-2"
                                ng-model="item_description" id="Material_Description">Item description
                            </label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="Project"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2"
                            ng-model="project_name" id="Project">Project name</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="Batch"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2" ng-model="batch_id"
                            id="Batch">Batch #/Serial #</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="DOE"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2"
                            ng-model="date_of_expiry" id="DOE">DOE</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label ng-click="GHSPictogramMenu()" for="GHS-Pictogram-checked-input"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2"
                            id="GHS-Pictogram-checked-input">GHS pictogram</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="Owner1"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2" ng-model="owners"
                            id="Owner1">Owners</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="td_expt"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2"
                            ng-model="used_for_td_expt_only" id="td_expt">Used for TD/EXPT</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="date_of_shipment"
                            class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input
                            type="checkbox" class="form-check-input checked-input me-2"
                            ng-model="date_of_shipment" id="date_of_shipment">DOD</label>
                        </div>
                        <div class="col-md-4 mb-2 text-start">
                            <label for="PrintOutlife"
                            class="p-1 form-label cursor ps-2 bg-light rounded-pill shadow-sm border w-100">
                            <input type="checkbox" class="form-check-input checked-input me-2"
                            ng-model="PrintOutlife" id="PrintOutlife">
                            Outlife expiry
                        </label>
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow-sm border position-absolute w-100 animate__fadeInDown animate__animated"
        style="top: 0" id="GHSPictogramMenu">
        <div class="card-header border-bottom bg-light text-dark">
            <h3 class="h5 text-center">Select the pictogram for your label:</h3>
        </div>
        <div class="card-body bg-white">
            <div class="row m-0">
                @if ($pictograms)
                @foreach ($pictograms as $pictogram)
                <label class="col-4 position-relative text-white row my-2"
                for="pictogramsLab_{{ $pictogram->id }}">
                <div class="col-4">
                    <img id="pictograms_{{ $pictogram->id }}"
                    src="{{ storageGet($pictogram->image) }}" class="img-png"
                    width="50px">
                </div>
                <div
                class="text-dark col d-flex align-items-center text-dark bg-light p-2 rounded-pill">
                <input type="checkbox" name="pictograms"
                ng-model="pictogramsLab_{{ $pictogram->id }}"
                id="pictogramsLab_{{ $pictogram->id }}"
                class="checked-input me-1 form-check-input">
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
        src: local('barcode font'), url("{{ asset('asset/fonts/BarcodeFont.woff') }}") format('woff');
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
    <script src="{{ asset('public/asset/js/vendors/angular.min.js') }}"></script>
    <script src="{{ asset('public/asset/js/controllers/PrintLabelController.js') }}"></script>
    @endsection
