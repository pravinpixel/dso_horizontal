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
                                    <th>Date&time stamp</th>
                                    <th>Current accessed</th>
                                    <th>Input Used amt (@{{ RepackTransferMeasure }})</th>
                                    <th>
                                        <span>Current Pkt Size : <span class="lead"><b>@{{ RepackTransferPackSize }}</b></span></span>
                                        <hr class="bg-secondary">
                                        Remain Amt (@{{ RepackTransferMeasure }})
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td style="padding: 0">@{{ CurrentDate | date:'dd/MM/yyyy HH:mm:ss'}}</td>
                                    <td style="padding: 0">@{{ CurrentAccessed }}</td>
                                    <td style="padding: 0">
                                        <input type="number" min="1" max="@{{ RepackTransferPackSize }}" ng-model="RepackTransferPackingSize" class="text-center form-control form-control-sm">
                                    </td>
                                    <td style="padding: 0">
                                        @{{ RepackTransferPackSize - RepackTransferPackingSize}}
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="h5 text-primary text-center">Repacked mat/product tracking logsheet (Repack)</h5>
                        <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                            <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                <tr>
                                    <th width="200px"> 
                                        Repack Size(@{{ RepackTransferMeasure }})</th>
                                     <th>Qty</th>
                                    <th>storage area</th>
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
                                    <td style="padding: 0" width="200px" class="text-center">
                                        <input type="number" min="1" ng-model="RepackTransfer.repack_size" ng-value="RepackTransfer.repack_size"class="border-0 rounded-0 text-center form-control form-control-sm">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" min="1" ng-model="RepackTransfer.quantity" ng-value="RepackTransfer.quantity" class="border-0 rounded-0 text-center form-control form-control-sm">
                                    </td>
                                    <td style="padding: 0">
                                        <select  class="border-0 rounded-0 form-select form-select-sm" ng-model="RepackTransfer.storage_area">
                                            <option ng-selected="row.id == RepackTransfer.storage_area" ng-value="row.id" ng-repeat="row in MasterData.storage_room">@{{ row.name }}</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select  class="border-0 rounded-0 form-select form-select-sm" ng-model="RepackTransfer.housing_type">
                                            <option ng-selected="row.id == RepackTransfer.housing_type" ng-value="row.id" ng-repeat="row in MasterData.house_types">@{{ row.name }}</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select  class="border-0 rounded-0 form-select form-select-sm"  ng-model="RepackTransfer.housing">>
                                            <option value="@{{ RepackTransfer.housing }}"> @{{ RepackTransfer.housing }} </option>
                                            {!! $housing = "@{{ RepackTransfer.housing }}" !!}
                                            @for ($key=0;$key<20;$key++)
                                                <option value="{{ $key + 1 }}" {{ $key + 1 == $housing ? "selected" : "" }}>{{ $key + 1 }} </option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select  class="border-0 rounded-0 form-select form-select-sm" ng-model="RepackTransfer.owner_one">
                                            <option ng-selected="row.alias_name == RepackTransfer.owner_one" ng-value="row.alias_name" ng-repeat="row in MasterData.owners">@{{ row.alias_name }}</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select class="border-0 rounded-0 form-select form-select-sm" ng-model="RepackTransfer.owner_two">
                                            <option ng-selected="row.alias_name == RepackTransfer.owner_two" ng-value="row.alias_name" ng-repeat="row in MasterData.owners">@{{ row.alias_name }}</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">-</td>
                                    <td style="padding: 0">
                                        <i  ng-click="RepackTransfers('clear')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            <div class="modal-footer text-end  border-top">
                <button class="btn btn-primary rounded-pill"  ng-click="RepackTransfers('store')">Click to confirm and proceed to print label page</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 