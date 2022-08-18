<div id="Transfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white">
                <h4 class="modal-title" id="topModalLabel">Transfer batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                    <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                        <tr>
                            <th width="200px">Transfer Qty</th>
                            {{-- <th>storage area (able to add in new rooms in the future)</th>
                            <th>Housing type (able to add in new housing type in the future)</th> --}}
                            <th>storage area </th>
                            <th>Housing type </th>
                            <th>Housing No.</th>
                            <th>Owner 1</th>
                            <th>Owner 2</th>
                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px" class="text-center">
                                <input type="number" min="0" max="@{{ TransfersBatchMaxQuantity }}" placeholder="@{{ TransfersBatchMaxQuantity }}" ng-model="TransfersBatch.quantity" ng-value="TransfersBatch.quantity" class="text-center form-control form-control-sm">
                            </td>
                            <td>
                                <select  class="form-select form-select-sm" ng-model="TransfersBatch.storage_area">
                                    <option ng-selected="row.id == TransfersBatch.storage_area" ng-value="row.id" ng-repeat="row in MasterData.storage_room">@{{ row.name }}</option>
                                </select>
                            </td>
                            <td>
                                <select  class="form-select form-select-sm" ng-model="TransfersBatch.housing_type">
                                    <option ng-selected="row.id == TransfersBatch.housing_type" ng-value="row.id" ng-repeat="row in MasterData.house_types">@{{ row.name }}</option>
                                </select>
                            </td>
                            <td>
                                <select  class="form-select form-select-sm"  ng-model="TransfersBatch.housing">>
                                    <option value="@{{ TransfersBatch.housing }}"> @{{ TransfersBatch.housing }} </option>
                                    {!! $housing = "@{{ TransfersBatch.housing }}" !!}
                                    @for ($key=0;$key<20;$key++)
                                        <option value="{{ $key + 1 }}" {{ $key + 1 == $housing ? "selected" : "" }}>{{ $key + 1 }} </option>
                                    @endfor
                                    <option value="nill"> nill </option>
                                </select>
                            </td>
                            <td>
                                <select  class="form-select form-select-sm" ng-model="TransfersBatch.owner_one">
                                    <option ng-selected="row.alias_name == TransfersBatch.owner_one" ng-value="row.alias_name" ng-repeat="row in MasterData.owners">@{{ row.alias_name }}</option>
                                </select>
                            </td>
                            <td>
                                <select  class="form-select form-select-sm" ng-model="TransfersBatch.owner_two">
                                    <option ng-selected="row.alias_name == TransfersBatch.owner_two" ng-value="row.alias_name" ng-repeat="row in MasterData.owners">@{{ row.alias_name }}</option>
                                </select>
                            </td>
                            <td>
                                <a ng-click="clearTransferBatch()" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> 
            <div class="modal-footer text-end  border-top">
                {{-- <button class="btn btn-success rounded-pill me-2">Print barcode</button> --}}
                <button class="btn btn-primary rounded-pill" ng-click="transferBatch()">Click to confirm transfer</button>
            </div>
        </div>
    </div>
</div> 