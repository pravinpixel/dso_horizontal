<div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow" >
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>				  
            <form name="repackOutlifeForm" class="modal-body p-2" style="border: none !important; max-height:85vh;overflow:auto"> 
                <table class="table table-centered  bg-white table-bordered custom-center m-0">
                    <thead class="bg-primary-2 text-white"> 
                        <tr>
                            <th colspan="10">
                                Mat/Pdt outlife logsheet
                            </th>
                        </tr>
                        <tr>
                            <td>Material / Product Draw status</td>
                            <td>Date & time stamp</td>
                            <td>Last accessed</td>
                            <td> Input repack Amount  <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                            <td>Remain Amount  <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                            <td>Auto-generate unique barcode label</td>
                            <td>Repack size <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                            <td>Quantity</td>
                            <td>
                                Remaining outlife (prepreg roll) <br>
                                Intital count: @{{ repack_outlife_days }}  days
                            </td>
                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(i,repack) in repack_outlife_table">
                            <td> 
                                <label for="DRAW_IN_@{{ i }}" class="btn btn-sm btn-draw-in" ng-class="repack.draw_out.status == 0 || repack.draw_in.status == 1 && repack.draw_out.status == 1 ? 'btn-disabled' : '' " >
                                    <input class="d-none" id="DRAW_IN_@{{ i }}" repack-table="IN" type="radio" ng-model="repack.draw_status" value="0" name="draw_status" required  ng-disabled="repack.draw_out.status == 0 || repack.draw_in.status == 1 && repack.draw_out.status == 1" />
                                   Draw In
                                </label>
                                <label for="DRAW_OUT_@{{ i }}" class="btn btn-sm btn-draw-out" ng-class="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1 ? 'btn-disabled' : ''">
                                    <input class="d-none" id="DRAW_OUT_@{{ i }}" repack-table="OUT" type="radio" ng-model="repack.draw_status" value="1" name="draw_status" required  ng-disabled="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1" />
                                    Draw Out
                                </label>
                                {{-- <input type="button" repack-table="IN" ng-disabled="repack.draw_out.status == 0 || repack.draw_in.status == 1 && repack.draw_out.status == 1" value="" class="btn-draw draw-in"> <br> <br>
                                <input type="button" repack-table="OUT" ng-disabled="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1" value="Draw Out" class="btn-draw draw-out"> --}}
                            </td>
                            <td style="padding: 0" width="300px">
                                <div><small>@{{ repack.draw_out.time_stamp}}</small></div><br>
                                <div><small>@{{ repack.draw_in.time_stamp }}</small></div>
                            </td>
                            <td><small>@{{ repack.last_access }}</small></td>
                            <td class="text-center"> 
                                {{-- @{{ repack.total_quantity }} --}}
                                <span ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1">
                                    <input type="number" ng-model='repack.repack_amount' repack-table="REPACK_INPUT" ng-min="1" ng-max="repack.total_quantity" class="form-control form-control-sm text-center " required>
                                </span>
                                <span ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1">
                                    @{{ repack.initial_amount }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1">
                                    <input type="number" disabled ng-model='repack.balance_amount' class="form-control form-control-sm text-center " >
                                </span>
                                <span ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1">
                                    @{{ repack.balance_amount }}
                                </span>
                            </td>
                            <td>@{{ repack.barcode_number }}</td>
                            <td class="text-center position-relative">
                                <span ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1 ">
                                    <input type="number" ng-model='repack.repack_size' max="@{{ repack.repack_amount }}" repack-table="REPACK_SIZE" class="form-control form-control-sm text-center " required>
                                </span>
                                <span ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1">
                                    @{{ repack.repack_size }}
                                </span>
                            </td>
                            <td class="text-center position-relative p-1">
                                <span ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1 ">
                                    <input type="number" readonly ng-model='repack.qty_cut' class="px-0 text-center form-control form-control-sm text-center " required>
                                </span>
                                <span ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1">
                                    @{{ repack.qty_cut }}
                                </span>
                            </td>
                            <td>@{{ repack.remaining_days }}</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div class="card-footer bg-light">
                <div class="row align-items-center">
                    <div class="shadow-sm border col-4">
                        <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of batch</label>
                    </div>
                    <div class="col-6 ms-auto text-end"> 
                        <label for="exportLogCheckBox" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="exportLogCheckBox"> Export logsheet</label>
                        <button class="btn btn-primary rounded-pill h-100"  ng-if="repackOutlifeForm.$invalid != true" ng-click="saveRepackOutlife()">Save and Submit</button>
                        <button class="btn btn-secondary rounded-pill h-100" ng-if="repackOutlifeForm.$invalid">Save and Submit</button>
                        {{-- <button class="btn btn-primary rounded-pill h-100" ng-if="next_draw == true" ng-click="saveRepackOutlife()">Save and Submit 2</button> --}}
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>