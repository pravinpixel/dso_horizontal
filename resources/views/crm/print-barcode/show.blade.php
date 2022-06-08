@extends('layouts.app')
@section('content')
    <div>
        <table class="table table-bordered bg-white">
            <thead class="bg-primary text-white">
                <tr>
                    <th> Item Description</th>
                    <th>Brand</th>
                    <th>Batch/Serial#</th>
                    <th>Owner1/2</th>
                    <th>DOE</th>
                    <th>Used for TD/Expt</th> 
                    <th>Project Name</th>
                    <th>Qty to print</th>
                </tr> 
            </thead>
            <tr>
                <td>{{ $batch->BatchMaterialProduct->item_description }}</td>
                <td>{{ $batch->brand }}</td>
                <td>{{ $batch->batch }} / {{ $batch->serial }}</td>
                <td>{{ $batch->owner_one }} , {{ $batch->owner_one }}</td>
                <td>{{ $batch->date_of_expiry }}</td>
                <td>{{ $batch->used_for_td_expt_only == 1 ? "Yes" : "No" }}</td>
                <td>{{ $batch->project_name }}</td>  
                <td>
                    <input type="number" class="text-center fw-bold form-control form-control-sm m-0 " name="" id="" value="10">
                </td> 
            </tr>
        </table> 
    </div>
    <div class="card shadow-sm border">
        <div class="card-header bg-light border-bottom">
            <div class="row m-0">
                <div class="col-md-4 d-flex align-items-center">
                    <label class="me-2">
                        Style
                    </label>
                    <select name="" id="" class="form-select form-select-md rounded-pill">
                        <option value="">-- Select Label Size --</option>
                        <option value="small">Small</option>
                        <option value="big">Big</option>
                    </select>
                </div>
                <div class="col-md-8 text-end">
                    <button class="btn btn-outline-primary rounded-pill"><i class="fa fa-eye me-1"></i> Preview</button>
                    <button class="btn btn-primary rounded-pill"><i class="fa fa-print me-1"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="card-body text-center">            
            <div class="row m-0 ">
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Barcode" class="p-1 form-label cursor ps-2 bg-light  rounded-pill shadow-sm border w-100">
                        <input type="checkbox" class="form-check-input checked-input me-2" name="" id="Barcode">Barcode
                    </label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Material_Description" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100">
                        <input type="checkbox" class="form-check-input checked-input me-2" name="" id="Material_Description">Item description
                    </label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Project" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="Project">Project Name</label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Batch" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="Batch">Batch ID/Serial #</label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="DOE" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="DOE">DOE</label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="GHS-Pictogram-checked-input" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="GHS-Pictogram-checked-input">GHS Pictogram</label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Owner1" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="Owner1">Owner1/Owner2</label>
                </div>
                <div class="col-md-3 mb-2 text-start">
                    <label  for="td_expt" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="td_expt">Used for TD/EXPT</label>
                </div>
                {{-- <div class="col-md-3 mb-2 text-start">
                    <label  for="Outlife" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="Outlife">Outlife Expiry</label>
                </div> --}}
                <div class="col-md-3 mb-2 text-start">
                    <label  for="DOD" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="DOD">DOD</label>
                </div>
            </div>
        </div>
    </div> 
    <div id="GHS-Pictogram-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="modal-header rounded-0 bg-primary text-white">
                    <h4 class="modal-title" id="topModalLabel">Print Preview</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0 align-items-center">
                        <div class="col-md-8 bg-white">  
                            <div class=" p-3">
                                <h3 class="h5 text-center">Select the pictogram for your label:</h3>
                                <div class="row justify-content-center m-0">
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Explosives" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class=""  for="Explosives">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Explosives</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="flammables" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="flammables">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>flammables</u></small></div>
                                        </label>                                        
                                    </div>                                    
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Oxidisers" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Oxidisers">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Oxidisers</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Gases_Under_Pressure" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Gases_Under_Pressure">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Gases Under Pressure</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Corrosives" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Corrosives">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Corrosives</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Acute" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Acute">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Acute Toxicity</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Irritants" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Irritants">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Irritants/Sensitisers/others Hazards</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Specific" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Specific">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Specific Toxicity Hazards</u></small></div>
                                        </label>                                        
                                    </div>
                                    <div class="custom-box p-2 text-center">
                                        <input type="checkbox" name="" id="Environmental" class="checked-input rounded-5 form-check-input position-absolute top-0  m-2 right-0">
                                        <label class="" for="Environmental">
                                            <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="50px">
                                            <div class="text-dark"><small><u>Environmental Hazards</u></small></div>
                                        </label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="border card text-center rounded-5 p-3">
                                <img width="200px" class="mx-auto" src="https://lh3.googleusercontent.com/EASWqGp10M-RQANx9krxrmGHuH0_u6Jy_9lN9JPJhuFRDVKe8KrgEXGkOW8Yorum5tyg-vrx-cg0L5vy-t-7dFEg0eiwfyC7xJZ5WqUT=s660">
                                <div >
                                    <small>Batch 2/-</small>
                                    <div class="text-primary">
                                        <p class="m-0">Acetone IND</p>
                                        <p class="m-0">DOE 12 June 2020</p>
                                        <p class="m-0">Owner1/2 : Junxiang/ChiauLing</p>
                                    </div>
                                </div> 
                                <hr>
                                <div>
                                    <img src="{{ asset('public/asset/images/pictograms/flammables.png') }}" class="img-png" width="100px">
                                </div>
                                <div class="text-end">  
                                    <small class="bg-dark text-white badge">Used for TD/ EXPT</small><br>
                                    <small class="text-dark">DOD: 1/10/2026</small>
                                </div>
                            </div>         
                            <div class="text-center">
                                <button type="button" class="btn btn-success-light rounded-pill" data-bs-dismiss="modal">Amend</button>
                            <button type="button" class="btn btn-primary rounded-pill"><i class="fa fa-print me-1"></i> print</button>   </div>                
                        </div>
                    </div>
                </div>
                
                    
                  
               
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
@endsection

@section('scripts')
    <script>  
        $(document).on("change", ".checked-input[type='checkbox']", function () {
            $(this).parent()[this.checked ? "addClass" : "removeClass"]("bg-primary-light text-primary"); 
        });
        $(document).on("change", "#GHS-Pictogram-checked-input[type='checkbox']", function () {
            var checkBox = document.getElementById("GHS-Pictogram-checked-input");
            if (checkBox.checked == true){
                $('#GHS-Pictogram-modal').modal('show');
            }
        });
    </script> 
@endsection


