<div id="RepackTransfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Transfer Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table table-centered bg-white table-bordered custom-center m-0">
                    <thead class="bg-primary-2 text-white"> 
                        <tr>
                            <th colspan="12">
                                Repacked mat/product tracking logsheet (Repack)
                            </th>
                        </tr>
                        <tr>
                            <td>Date & time stamp	</td>
                            <td>Current accessed </td>
                            <td>Repack total quantity</td>
                            <td>Remain total quantity</td>
                            <td>New unit packing value</td>
                            <td>Quantity </td>
                            <td>Storage Area</td>
                            <td>Housing type</td>
                            <td>Housing No</td>
                            <td>Owners</td>
                            <th><i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@{{ CurrentDate | date:'dd/MM/yyyy HH:mm:ss'}}</td>
                            <td>{{ auth_user()->alias_name }}</td>
                            <td>
                                <input 
                                    type="number" 
                                    min="1" 
                                    ng-max="RepackTransfer.total_quantity"
                                    ng-model="RepackTransfer.RepackQuantity"
                                    class="custom-input"
                                    repack-transfer-table="REPACK_QUANTITY"
                                />
                            </td>
                            <td ng-bind="RepackTransfer.RemainQuantity"></td>
                            <td>
                                <input
                                    type="number" 
                                    min="1" 
                                    ng-model="RepackTransfer.new_unit_packing_value" 
                                    ng-value="RepackTransfer.new_unit_packing_value"
                                    class="custom-input"
                                    repack-transfer-table="NEW_UNIT_PACKING_VALUE"
                                />
                            </td>
                            <td  ng-bind="RepackTransfer.AutoCalQty">
                                {{-- ng-bind="RepackTransfer.quantity" --}}
                                {{-- @{{ RepackTransfer.total_quantity / RepackTransfer.new_unit_packing_value	 }}    --}}
                            </td>
                            <td>
                                <select class="custom-input" ng-model="RepackTransfer.storage_area">
                                    <option ng-selected="row.id == RepackTransfer.storage_area.id" ng-value="row.id" ng-repeat="row in MasterData.storage_room">@{{ row.name }}</option>
                                </select>
                            </td>
                            <td width="150px">
                                <select class="custom-input" ng-model="RepackTransfer.housing_type">
                                    <option ng-selected="row.id == RepackTransfer.housing_type.id" ng-value="row.id" ng-repeat="row in MasterData.house_types">@{{ row.name }}</option>
                                </select>
                            </td>
                            <td>
                                <select class="custom-input"  ng-model="RepackTransfer.housing">>
                                    <option value="@{{ RepackTransfer.housing }}"> @{{ RepackTransfer.housing }} </option>
                                    {!! $housing = "@{{ RepackTransfer.housing }}" !!}
                                    @for ($key=0;$key<20;$key++)
                                        <option value="{{ $key + 1 }}" {{ $key + 1 == $housing ? "selected" : "" }}>{{ $key + 1 }} </option>
                                    @endfor
                                </select>
                            </td>
                            <td width="130px">
                                <div ng-dropdown-multiselect="" class="border rounded bg-white" options="RepackTransfersBatchOwners" selected-model="RepackTransfersBatchOwnersModel"></div>
                            </td>
                            <td>
                                <i ng-click="RepackTransfers('clear')" class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
                        </tr>
                    </tbody>
                </table> 
            </div> 
            <div class="modal-footer text-end  border-top">
                <button class="btn btn-primary rounded-pill"  ng-click="RepackTransfers('store')">Click to confirm and proceed to print label page</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 