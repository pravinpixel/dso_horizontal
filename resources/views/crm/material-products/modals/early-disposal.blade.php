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
                <div class="row m-0 pt-4">
                    <div class="col-md-6 border-end p-4">
                        <label for="Pass_label" class="form-radio-primary mb-3">
                            <input type="radio" name="group" class="form-check-input border-primary " checked id="Pass_label"> <span class="text-primary"> For Disposal</span>
                        </label>
                        <div class="d-flex align-items-center mb-3">
                            <label for="" class="me-2">Qty : </label>
                            <input type="number" min="1"  class="form-control text-center my-2" name="" id="" value="@{{ batch.quantity }}" style="width: 100px">
                        </div>
                        <span><strong>Supporting Documents (If any)</strong></span>
                        <input type="file" name="" id="" class="form-control"> 
                    </div>
                    <div class="col-md-6 p-4">
                        <label for="Pass_label" class="form-radio-primary mb-3">
                            <input type="radio" name="group" class="form-check-input border-primary " checked id="Pass_label"> <span class="text-primary">Used for TD/Expt Project</span>
                        </label>
                        <div class="mb-3">
                            <span><strong>Supporting Documents (Approval email)</strong></span>
                            <input type="file" name="" id="" class="form-control"> 
                        </div>
                        <div class="mb-3">
                            <span><strong>* To be Disposed after</strong></span>
                            <input type="date" name="" id="" class="form-control"> 
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
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="px-3 rounded-pill btn btn-primary">Submit</button>
                    </div>
                </div> 
            </div>  
        </div>
    </div>
</div> 