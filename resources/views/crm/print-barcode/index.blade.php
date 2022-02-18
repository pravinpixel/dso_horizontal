@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
            </div> 
        </div>
        <div class="col-2 ms-auto text-end">
            <button class="btn btn-primary rounded-pill"><i class="fa fa-plus me-1"></i> Add</button>
        </div>
    </div> 
    <div class="table-fillters row m-0">
        <div class="col-12 mb-2 d-flex">
            <button  data-bs-toggle="modal" data-bs-target="#advance-search-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
            <button class="rounded-pill btn btn-sm btn-success-light ms-auto"><i class="bi bi-arrow-counterclockwise"></i></button>
            <button class="rounded-pill btn btn-sm btn-danger-light ms-1"><i class="bi bi-x"></i></i> </button>
        </div>
        <div class="col">
            <label for="" class="form-label">Material/Product description</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div> 
        <div class="col">
            <label for="" class="form-label">Brand</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div> 
        <div class="col">
            <label for="" class="form-label">Owner 1/2</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">Vetri maran</option>
                <option value="2">Alan walker</option>
                <option value="3">Alex</option>
                <option value="4">Hema</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Dept</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">EGP1</option>
                <option value="2">EGP4</option>
                <option value="3">EGP7</option>
                <option value="4">FSML</option>
                <option value="4">STML</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Storage area</label>
            <select name="" id="" class="form-select custom">
                <option value="">-- select --</option>
                <option value="1">AR</option>
                <option value="2">CW</option>
                <option value="3">MA</option>
                <option value="4">SP</option>
                <option value="4">MR</option>
                <option value="4">Polymer</option>
                <option value="4">ChemShed1</option>
                <option value="4">ChemShed2</option>
            </select>
        </div> 
        <div class="col">
            <label for="" class="form-label">Housing type</label>
            <input type="text" class="form-control custom" placeholder="Type here...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th class="table-th child-td-lg">Mat/Pdt decription</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">Used for TD/Expt</th> 
                    <th class="table-th child-td">Project Name</th>
                    <th class="table-th child-td">Qty to print</th>
                </tr> 
            </thead>
            @for ($key=0; $key<1; $key++)
            <tr>
                <td class="child-td-lg">Acetone IND</td>
                <td class="child-td">XOX</td>
                <td class="child-td"> Batch2/-</td>
                <td class="child-td-lg"> Junxiang/ChiauLing</td>
                <td class="child-td">12/06/2020</td>
                <td class="child-td">yes</td>
                <td class="child-td">-</td> 
                <td class="child-td">10</td> 
            </tr>
            @endfor
        </table> 
    </div>
    <div class="card">
        <div class="card-header">
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
                        <input type="checkbox" class="form-check-input checked-input me-2" name="" id="Material_Description">Material/Product Description
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
                <div class="col-md-3 mb-2 text-start">
                    <label  for="Outlife" class="p-1 form-label bg-light cursor ps-2 rounded-pill shadow-sm border w-100"><input type="checkbox" class="form-check-input checked-input me-2" name="" id="Outlife">Outlife Expiry</label>
                </div>
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
            $('#GHS-Pictogram-modal').modal('show');
        });
    </script>
@endsection