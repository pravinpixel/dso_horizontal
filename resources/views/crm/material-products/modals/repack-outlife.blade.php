<div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>				  
            <div class="modal-body"> 
                <h5 class="h5 text-primary text-center">Mat/Pdt outlife logsheet</h5>
                <table class="table table-centered  bg-white table-bordered   custom-center m-0">
                    <thead class="bg-light text-primary-2 table-bordered"> 
                        <tr>
                            <th>(Mother)Material/Product Draw status</th>
                            <th>Date & time stamp</th>
                            <th>Last accessed</th>
                            <th>Input repack amt (@{{ RepackOutlifeData.unit_of_measure.name }})</th>
                            <th>Remain amt (@{{ RepackOutlifeData.unit_of_measure.name }})</th>
                            <th>Auto-generate unique barcode label</th>
                            <th>Repack size (@{{ RepackOutlifeData.unit_of_measure.name }})</th>
                            <th>Qty cut</th>
                            <th>
                                Remaining outlife (prepreg roll)
                                Intital count: @{{ RepackOutlifeData.outlife }}  days
                            </th>
                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody style="max-height: 80vh !important;over-flow:auto">  
                        <tr ng-repeat="repack_row in RepackOutlifeList.repack_outlife">
                            <td width="300px" colspan="3">
                                <div class="row mb-2">
                                    <div class="col p-0">
                                         Draw In 
                                    </div>
                                    <div class="col p-0">@{{ repack_row.draw_in_time_stamp }}</div>
                                    <div class="col p-0">
                                        <span ng-repeat='user in RepackOutlifeList.last_access'>@{{ user }}</span>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col p-0">
                                        <input class="btn-sm btn btn-success" type="button" value="Draw Out" ng-click="RepackOutlifeDrawOut()">
                                    </div>
                                    <div class="col p-0">@{{ repack_row.draw_out_time_stamp }}</div>
                                    <div class="col p-0">
                                        <span ng-repeat='user in RepackOutlifeList.last_access'>@{{ user }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">@{{ repack_row.input_repack_amount }}</td>
                            <td class="text-center">@{{ repack_row.remain_amount }}</td>
                            <td class="text-center">@{{ repack_row.unique_barcode_label }}</td>
                            <td class="text-center">@{{ repack_row.repack_size }}</td>
                            <td class="text-center">@{{ repack_row.qty_cut }}</td>
                            <td>@{{ repack_row.remain_days }}</td>
                            <td>-</td>
                        </tr> 
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <td width="300px" colspan="3">
                                <div class="row ">
                                    <div class="col p-0">
                                        <input class="btn-sm btn btn-secondary" type="button" value="Draw in" ng-click="RepackOutlifeDrawIn()" ng-disabled="draw_in === false">
                                    </div>
                                    <div class="col p-0">@{{ DrawInTimeStamp | date:"dd/MM/yyyy 'at' h:mma" }}</div>
                                    <div class="col p-0">
                                        <span ng-repeat='user in RepackOutlifeData.last_access'>@{{ user }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        -
                                    </div>
                                    <div class="col p-0">@{{ DrawOutTimeStamp | date:"dd/MM/yyyy 'at' h:mma" }}</div>
                                    <div class="col p-0">
                                        <span ng-repeat='user1 in RepackOutlifeData.last_access'>@{{ user1 }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <input type="number" min="1" ng-max="RepackOutlifeData.quantity" ng-model="RepackOutlifeData.Draw_input_repack_amt" class="text-center form-control form-control-sm">
                            </td>
                            <td class="text-center">
                                @{{ RepackOutlifeData.quantity - RepackOutlifeData.Draw_input_repack_amt }}
                            </td>
                            <td>Roll2/1</td>
                            <td class="text-center">
                                <input type="number" min="1" ng-model="RepackOutlifeData.Draw_repack_size" value="80" class="text-center form-control form-control-sm">
                            </td>
                            <td class="text-center">
                                <input type="number" min="1" ng-model="RepackOutlifeData.Draw_qty_cut" value="10" class="text-center form-control form-control-sm">
                            </td>
                            <td>-</td>
                            <td>
                                {{-- <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i><br><br> --}}
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
                        </tr>
                    </tfoot>
                </table> 
            </div> 
            <div class="card-footer ">
                <div class="row align-items-center">
                    <div class="shadow-sm border col-4">
                        <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of batch</label>
                    </div>
                    <div class="col-6 ms-auto text-end">
                        <button class="btn btn-info rounded-pill h-100">Export logsheet</button>
                        <button class="btn btn-primary rounded-pill h-100" ng-click="StoreRepackOutlifeData()">Save and Submit</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>