<div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow " >
            <div ng-show="currentBatch.end_of_batch == 1" class="disabled-text text-center">
                Batch NO Longer Available !
                <br>
                <button type="button" class="badge btn btn-light border text-dark rounded-pill mt-3" data-bs-dismiss="modal" aria-hidden="true">
                   <i class="bi bi-x"></i> <small>Close</small>
                </button>
            </div>
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="@{{ currentBatch.end_of_batch == 1 ? 'disabled-content' : '' }}">
                <form name="repackOutlifeForm" class="modal-body p-0" style="border: none !important; max-height:85vh;overflow:auto">
                    <table class="table table-centered table-sm bg-white table-bordered custom-center m-0">
                        <thead class="bg-primary-2 text-white">
                            <tr>
                                <th colspan="11">
                                    Mat/Pdt outlife logsheet
                                </th>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Material / Product Draw status</td>
                                <td>Date & time stamp</td>
                                <td>Last accessed</td>
                                {{-- <td>Total  quantity</td> --}}
                                <td> Input repack Amount (<small>Total Quantity</small>)  <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                                <td>Remain Amount (<small>Total Quantity</small>)  <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                                {{-- <td>Auto-generate unique barcode label</td> --}}
                                <td>Repack size <br> ( @{{ repack_outlife_unit_of_measure }} )</td>
                                <td>Quantity</td>
                                <td>
                                  
                                    <div>Material Remaining outlife :</div>
                                    <b ng-bind="repack_outlife_days"></b>
                                     <hr>
                                    <div>Outlife used</div>
                                    <small>(prepreg roll) </small>
                                   
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(i,repack) in repack_outlife_table">
                                <td ng-bind="i + 1"></td>
                                <td>
                                    <table class="w-100 text-center" ng-if="repack.draw_in.status == 1 && repack.draw_out.status == 1">
                                        <tr>
                                            <td>
                                                <label class="btn btn-sm btn-draw-out btn-disabled"><small>Draw Out</small></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="btn btn-sm btn-draw-in btn-disabled"><small>Draw In</small></label>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="w-100 text-center" ng-if="repack.draw_in.status == 1 && repack.draw_out.status == 0 || repack.draw_in.status == 0 && repack.draw_out.status == 1" >
                                        <tr>
                                            <td>
                                                <label for="DRAW_OUT_@{{ i }}" class="btn btn-sm btn-draw-out" ng-class="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1 ||  repack_outlife_days == 0 ? 'btn-disabled' : ''">
                                                    <input class="d-none" id="DRAW_OUT_@{{ i }}" repack-table="OUT" type="radio" ng-model="repack.draw_status" value="1" name="draw_status" required  ng-disabled="repack_outlife_days == 0 || repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1" />
                                                    <small>Draw Out</small>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="DRAW_IN_@{{ i }}" class="btn btn-sm btn-draw-in" ng-class="repack.draw_out.status == 0 || repack.draw_in.status == 1 && repack.draw_out.status == 1 || repack.draw_in_disabled==1 ||  repack_outlife_days == 0? 'btn-disabled' : '' " >
                                                    <input class="d-none" id="DRAW_IN_@{{ i }}" repack-table="IN" type="radio" ng-model="repack.draw_status" value="0" name="draw_status" required  ng-disabled="repack_outlife_days == 0 || repack.draw_out.status == 0 || repack.draw_in.status == 1 && repack.draw_out.status == 1" />
                                                <small>Draw In</small>
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="padding: 0" width="220px">
                                    <table class="text-center w-100">
                                        <tr><td class="text-center"><small ng-bind="repack.draw_in.time_stamp"></small></td></tr>
                                        <tr><td class="text-center"><small ng-bind="repack.draw_out.time_stamp"></small></td></tr>
                                    </table>
                                </td>
                                <td style="padding: 0" width="220px">
                                    <table class="text-center w-100">
                                        <tr><td class="text-center"><small ng-bind="repack.draw_in_last_access"></small></td></tr>
                                        <tr><td class="text-center"><small ng-bind="repack.draw_out_last_access"></small></td></tr>
                                    </table>
                                </td>
                                {{-- <td ng-bind="repack.last_access"></td> --}}
                                {{-- <td ng-bind="repack.total_quantity"></td> --}}
                                <td class="text-center">
                                    <span ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1">
                                        <input type="number" ng-model='repack.repack_amount' repack-table="REPACK_INPUT" ng-min="1" ng-max="repack.total_quantity" class="form-control form-control-sm text-center " ng-class="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1 ||  repack_outlife_days == 0 ? 'btn-disabled' : ''" required>
                                    </span>
                                    <small ng-bind="repack.old_input_repack_amount" ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1"></small>
                                </td>
                                <td><small ng-bind="repack.balance_amount"></small></td>
                                {{-- <td ng-bind="repack.barcode_number"></td> --}}
                                <td class="text-center position-relative">
                                    <small ng-if="repack.draw_out.status == 0 && repack.draw_in.status == 1 ">
                                        <input type="number" ng-model='repack.repack_size' max="@{{ repack.repack_amount }}" repack-table="REPACK_SIZE" class="form-control form-control-sm text-center " ng-class="repack.draw_in.status == 0 ||  repack.draw_in.status == 1 && repack.draw_out.status == 1 ||  repack_outlife_days == 0 ? 'btn-disabled' : ''" required>
                                    </small>
                                    <small
                                        ng-bind="repack.repack_size"
                                        ng-if="repack.draw_out.status == 1 && repack.draw_in.status == 0 || repack.draw_out.status == 1 && repack.draw_in.status == 1">
                                    </small>
                                </td>
                            <td><small ng-bind="repack.quantity"></small></td>
                            <td><small ng-bind="repack.remaining_days"></small></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer bg-light">
                <div class="row align-items-center">
                    <div class="shadow-sm border col-4">
                        <div class="@{{ currentBatch.end_of_batch == 1 ? 'disabled-content' : '' }}">
                            <label for="end_of_batch" class="p-2">
                                <input type="checkbox" ng-checked="currentBatch.end_of_batch == 1" ng-model="end_of_batch" value="1" class="form-check-input me-2" id="end_of_batch">
                                End of batch
                            </label>
                            <span ng-if="end_of_batch" ng-click="setEndOfBatch(currentBatch.id)"  class="badge rounded-pill ms-2 py-1 px-2 btn btn-sm btn-success"> <i class="fa fa-save me-1"></i> Save </span>
                        </div>
                    </div>
                    <div class="col-6 ms-auto text-end">
                        <button class="btn btn-primary rounded-pill h-100 btn-loader" ng-click="saveRepackOutlife()">Save and Submit</button>
                        <!-- <button class="btn btn-secondary rounded-pill h-100" ng-show="repackOutlifeForm.$invalid">Save and Submit1</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
// Listen for the 'input' event on all input fields of type 'number'
document.addEventListener('input', function(event) {
    // Check if the target element is an input field of type 'number'
    if (event.target.tagName === 'INPUT' && event.target.type === 'number') {
        var inputValue = event.target.value;
        var numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;
    }
});
</script>
</div>
