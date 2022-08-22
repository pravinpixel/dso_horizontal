<div id="Extensionmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="card-header text-center rounded-0 bg-primary text-white">
                <div>
                    <h4 class="modal-title mb-1" id="topModalLabel">Extend Expiry</h4>
                </div>
                <button type="button" class="top-0 right-0 m-2 position-absolute rounded-pill btn btn-light btn-sm  shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body ">
                <div class="row container py-3 col-lg-9 mx-auto">
                    <div class="col-sm-4 mb-2 mb-sm-0 border-end  py-3">
                        <h1 class="h5">Extended QC Results Status :</h1>
                        <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <label for="Pass_label" class="nav-link active show form-radio-success">
                                <input ng-model="batch.extended_qc_status" ng-checked="batch.extended_qc_status == 'PASS'" value="PASS" type="radio" class="form-check-input border-success" id="Pass_label"> 
                                <span class="text-success"> Pass</span>
                            </label>
                            <label for="Fail_label" class="nav-link form-radio-danger ">
                                <input ng-model="batch.extended_qc_status" ng-checked="batch.extended_qc_status == 'FAIL'" value="FAIL" type="radio" class="form-check-input border-danger" id="Fail_label"> 
                                <span class="text-danger">Fail</span>
                            </label> 
                        </div>
                        <br>
                        <h1 class="h5 mb-3">Accordance to EG1 Chemical UIMS 2021</h1>
                        <div>
                            <div class="my-1"><span class="me-2">-</span> 2 years OEM unstated (liquids , others)</div>
                            <div class="my-1"><span class="me-2">-</span> 5 years OEM unstated (dry , others)</div>
                            <div class="my-1"><span class="me-2">-</span> 5 years OEM declare does not expire</div>
                            <div class="my-1"><span class="me-2">-</span> DSO in house (ask Domain PMTS)</div> 
                        </div>
                    </div>
                    <div class="col-sm-8"> 
                        <div ng-if="batch.extended_qc_status != null">
                            <p class="text-muted" style="text-transform: none !important">
                                Please fill in the information below for <b class="text-dark">expiry extension</b>. The field labels marked with * are required input fields.
                            </p>
                            <div class="row m-0">
                                <form  action="{{ route('update.extend-expiry', request()->route()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12 text-start mb-2 px-1">
                                        <small class="mb-1">Extended QC Documents*</small>
                                        <input type="file" name="extended_qc_result" ng-disabled="batch.extended_qc_status == 'FAIL'" class="form-control" placeholder="Type here">
                                    </div>
                                    <div class="col-12 text-start mb-2 px-1">
                                        <small class="mb-1">Extended Expiry Date *</small>
                                        <input type="date"  value="@{{ batch.extended_expiry }}" name="extended_expiry" ng-disabled="batch.extended_qc_status == 'FAIL'" class="form-control" placeholder="Type here">
                                    </div>
                                    <div class="col-12 text-start mb-2 px-1">
                                        <small class="mb-1">Remark</small>
                                        <input type="text"  ng-model="batch.remarks" name="remarks" ng-disabled="batch.extended_qc_status == 'FAIL'" class="form-control" placeholder="Type here">
                                    </div>
                                    <div class="col-12 text-center mb-2 px-1">
                                        <button type="submit" ng-if="batch.extended_qc_status == 'PASS'" class="btn btn-success rounded-pill">Submit</button>
                                        <button ng-if="batch.extended_qc_status == 'FAIL'" class="btn btn-outline-danger rounded-pill">Please proceed for disposal</button>
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div> 