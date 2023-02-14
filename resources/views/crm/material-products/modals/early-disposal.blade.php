<div id="disposalModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        {{-- <div class="modal-dialog custom-modal-dialog modal-top"> --}}
        <div class="modal-content h-auto rounded-0 border-bottom shadow">
            <div class="card-header text-center rounded-0 bg-primary text-white">
                <div>
                    <h4 class="modal-title mb-1" id="topModalLabel">Disposal / Used for TD or Expt Project</h4>
                    <span>Please fill in the information below</span>
                </div>
                <button type="button" class="top-0 right-0 m-2 position-absolute rounded-pill btn btn-light btn-sm  shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body p-4">
                <small>Please indicate selection below for <b>Disposal/ used for TD or Expt project</b> </small>
                <form action="{{ route('update.disposal') }}" method="POST" enctype="multipart/form-data" class="row m-0 pt-4" style="border: none !important;">
                    @csrf
                    <input type="hidden" name="id" value="@{{ batch.id }}">
                    <div class="col-md-6 border-end p-4">
                        <label for="Pass_label" class="form-radio-warning mb-3">
                            <input  type="radio" name="used_for_td_expt_only" class="me-2 form-check-input border-warning" value="0" ng-checked="batch.used_for_td_expt_only == 0"  ng-model="batch.used_for_td_expt_only" id="Pass_label" required />
                            <span class="text-warning"> For Disposal</span>
                        </label>
                        <div class="mb-3">
                            <table class="table table-centered m-0">
                                <tr>
                                    <th class="p-0">Quantity</th>
                                    <th class="p-2">:</th>
                                    <td class="p-2"><input ng-model="batch_qty" step="any" ng-disabled="batch.used_for_td_expt_only == 1" type="number" min="1" max="@{{ batch.quantity }}" name="quantity" class="form-control form-control-sm text-center" style="width: 100px" required></td>
                                </tr>
                                <tr>
                                    <th class="p-0">Remain quantity</th>
                                    <th class="p-2">:</th>
                                    <td class="p-2">@{{ batch.quantity - batch_qty }}</td>
                                </tr>
                            </table>
                        </div>
                        <label class="pb-2"><strong>Supporting documents (If any)</strong></label>
                        <input ng-disabled="batch.used_for_td_expt_only == 1" type="file" name="disposal_certificate" id="" class="form-control" >
                    </div>
                    <div class="col-md-6 p-4">
                        <label for="Passss_label" class="form-radio-success mb-3">
                            <input type="radio" name="used_for_td_expt_only"  class="me-2 form-check-input border-success" value="1" ng-checked="batch.used_for_td_expt_only == 1" ng-model="batch.used_for_td_expt_only" id="Passss_label" required>
                            <span class="text-success">Used for TD/Expt Project</span>
                        </label>
                        <div class="mb-3">
                            <span><strong>Supporting documents (Approval email)</strong></span>
                            <input type="file" ng-disabled="batch.used_for_td_expt_only == 0" name="used_for_td_certificate" id="" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <span><strong>* To be disposed after</strong></span>
                            <input type="date" ng-disabled="batch.used_for_td_expt_only == 0" name="disposed_after" value="@{{ batch.disposed_after }}" class="form-control" required>
                        </div>
                        <h1 class="h5 my-3">Accordance to EG1 Chemical UIMS 2021</h1>
                        <div>
                            <div class="my-1"><span class="me-2">-</span> 2 years OEM unstated (liquids , others)</div>
                            <div class="my-1"><span class="me-2">-</span> 5 years OEM unstated (dry , others)</div>
                            <div class="my-1"><span class="me-2">-</span> 5 years OEM declare does not expire</div>
                            <div class="my-1"><span class="me-2">-</span> DSO in house (ask Domain PMTS)</div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="px-3 rounded-pill btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
