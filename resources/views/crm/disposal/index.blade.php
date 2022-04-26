@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
            </div> 
        </div> 
    </div>
   
    @include('includes.sections.filter')
    <div class="">
        <table class="table table-centered table-bordered table-hover bg-white">
            <thead>
                <tr>
                     <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt size</th>
                    <th class="table-th child-td">Qty</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage Room</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">QC status</th>
                    <th class="table-th child-td">Used for TD/Expt</th>
                    <th class="table-th child-td">Actions</th>
                </tr> 
            </thead>
            @for ($key=0; $key<3; $key++)
            <tr class="table-tr">
                <td colspan="12" class="p-0 border-bottom">
                    <table class="table table-centered m-0">
                        <tr>
                            <td class="child-td-lg"><i class="bi bi-caret-right-fill collapsed table-toggle-icon" data-bs-toggle="collapse" href="#row_{{ $key+1 }}" role="button" aria-expanded="false" aria-controls="row_{{ $key+1 }}"></i> Acetone IND</td>
                            <td class="child-td">XOX</td>
                            <td class="child-td"></td>
                            <td class="child-td">1L</td>
                            <td class="child-td">20 <i class="text-success dot-sm bi bi-circle-fill"></i></td>
                            <td class="child-td-lg"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a> 
                                    <div class="dropdown-menu"> 
                                        {{-- <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disposalModal"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a> --}}
                                        {{-- <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View batch details</a> --}}
                                        <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                        <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackTransfers"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackOutlife"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                        <a class="dropdown-item text-secondary" onclick="printModal()" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                        <a class="dropdown-item text-danger" onclick="deleteModal()" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="collapse  " id="row_{{ $key+1 }}">
                            <td colspan="12" class="p-0">
                                <table class="table table-centered bg-white m-0">
                                    @for ($key2=0; $key2<4; $key2++)
                                        <tr>
                                            <td class="child-td-lg"></td>
                                            <td class="child-td"></td>
                                            @if ($key2 == 0)
                                            <td class="child-td">Batch/1</td>
                                            @endif
                                            @if ($key2 == 1)
                                            <td class="child-td">Batch/2</td>
                                            @endif 
                                            @if ($key2 == 2)
                                            <td class="child-td">Batch/3</td>
                                            @endif
                                            @if ($key2 == 3)
                                            <td class="child-td">Batch/4</td>
                                            @endif  
                                            @if ($key2 == 0)
                                            <td class="child-td">1L</td>
                                            @endif
                                            @if ($key2 == 1)
                                            <td class="child-td">1L</td>
                                            @endif 
                                            @if ($key2 == 2)
                                            <td class="child-td">0.5L</td>
                                            @endif
                                            @if ($key2 == 3)
                                            <td class="child-td">5L</td>
                                            @endif  
                                            <td class="child-td">10</td>
                                            <td class="child-td-lg">Keith/HuiBeng</td>
                                            <td class="child-td">CW</td>
                                            <td class="child-td">FC1</td>
                                            <td class="child-td">
                                                @if ($key2 == 0)
                                                    <small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small>
                                                @endif
                                                @if ($key2 == 1)
                                                    <small class="d-flex">31/10/2021  <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small>
                                                @endif 
                                                @if ($key2 == 2)
                                                    <small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small>
                                                @endif
                                                @if ($key2 == 3)
                                                    <small class="d-flex">31/10/2021  <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small>
                                                @endif  
                                            </td>
                                            <td class="child-td">
                                                @if ($key2 == 0)
                                                    <small class="badge badge-success-lighten rounded-pill">PASS</small>
                                                @endif
                                                @if ($key2 == 1)
                                                    <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                @endif 
                                                @if ($key2 == 2)
                                                    <small class="badge badge-success-lighten rounded-pill">PASS</small>
                                                @endif
                                                @if ($key2 == 3)
                                                    <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                @endif 
                                            </td>
                                            <td class="child-td">-</td>
                                            <td class="child-td">
                                                <div class="dropdown">
                                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a> 
                                                    <div class="dropdown-menu"> 
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disposalModal"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View batch details</a>
                                                        <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                        <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackTransfers"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                        <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#RepackOutlife"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                        <a class="dropdown-item text-secondary" onclick="printModal()" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                        <a class="dropdown-item text-danger" onclick="deleteModal()" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> 
                                    @endfor
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endfor
        </table>  
    </div>
    <div id="disposalModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            {{-- <div class="modal-dialog custom-modal-dialog modal-top"> --}}
            <div class="modal-content h-auto rounded-0 border-bottom shadow">
                <div class="card-header text-center rounded-0 bg-primary text-white">
                    <div>
                        <h4 class="modal-title mb-1" id="topModalLabel">Disposal / Used for TD or Expt Project</h4>
                        <span>Please fill in the information below</span>
                    </div>
                    <button type="button" class="btn-close top-0 right-0 m-2 position-absolute" data-bs-dismiss="modal" aria-hidden="true"></button>
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
                                <input type="number" class="form-control text-center my-2" name="" id="" value="10" style="width: 100px">
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
                                <span><strong>* To be Disposed after</span>
                                <input type="date" name="" id="" class="form-control"> 
                            </div>
                            <strong>Accordance to EG1 Chemical UIMS 2021</strong>
                            <ul>
                                <li>2 years OEM unstated (liquids , others)</li>
                                <li>5 years OEM unstated (dry , others)</li>
                                <li>5 years OEM declare does not expire</li>
                                <li>DSO in house (ask Domain PMTS)</li>
                            </ul>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="px-3 rounded-pill btn btn-primary">Submit</button>
                        </div>
                    </div>
                   {{-- <div class="row  ">
                       <div class="col-md-6">
                            <label for="Pass_label" class="form-radio-success">
                                <input type="radio" name="group" class="form-check-input border-success " checked id="Pass_label"> <span class="text-success"> Yes</span>
                            </label>
                            <div class="d-flex align-items-center">
                                <label for="" class="me-2">Qty : </label>
                                <input type="number" class="form-control text-center my-2" name="" id="" style="width: 100px">
                            </div>
                            <br>
                            <label for="Fail_label" class="form-radio-danger  my-2" >
                                <input type="radio" name="group"  class="form-check-input border-danger" id="Fail_label"> 
                                <span class="text-danger">No (can be use for TD/Expt project)</span>
                            </label>
                            <div><strong>To be dispoed after :</strong></div>
                            <input type="date" name="" id="" class="form-control">
                       </div>
                       <div class="col-md-6">
                        <span><strong>Approval Email:</strong></span>
                        <input type="file" name="" id="" class="form-control"> 
                       </div>
                       <div class="col-12 text-center mt-3">
                            <button class="btn btn-success rounded-pill">Submit and archive</button>
                       </div>
                   </div> --}}
                    {{-- <div class="row container py-3 col-lg-9 mx-auto">
                        <div class="col-md-4">
                            <label for="">Material Description*</label>
                            <input type="text" name="" id="" class="form-control" placeholder="Acetone ">
                        </div>
                        <div class="col-md-4">
                            <label for="">CAS Number *</label>
                            <div class="input-group">
                                <input type="text" name="" id="" class="form-control" placeholder=" 67-64-1">
                                <label for="cas-number_attach" class="btn btn-light border"><i class="bi bi-paperclip"></i></label>
                                <input type="file" name="" id="cas-number_attach" class="d-none">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Brand *</label>
                            <input type="text" name="" id="" class="form-control" placeholder="Sigma Aldrich">
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <h1 class="h5">Please indicate selection below for disposal. </h1>
                        </div>
                        <div class="col-sm-3  mb-sm-0  border-end  py-3">
                            
                            <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <label for="Pass_label" class="nav-link active show form-radio-success" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-pass" role="tab" aria-controls="v-pills-pass" aria-selected="true">
                                    <input type="radio" name="group" class="form-check-input border-success" checked id="Pass_label"> <span class="text-success"> Yes</span>
                                </label>
                                <label for="Fail_label" class="nav-link form-radio-danger " id="v-pills-fail-tab" data-bs-toggle="pill" href="#v-pills-fail" role="tab" aria-controls="v-pills-fail" aria-selected="false">
                                    <input type="radio" name="group"  class="form-check-input border-danger" id="Fail_label"> <span class="text-danger">No</span>
                                </label> 
                            </div>
                        </div>                    
                        <div class="col-sm-9">
                            <div class="tab-content  p-3" id="v-pills-tabContent">
                                <div class="tab-pane fade active show align-items-center pt-4" id="v-pills-pass" role="tabpanel" aria-labelledby="v-pills-pass-tab">
                                    <div class="d-flex align-items-center h-100">
                                        <label for="" class="me-2">Quantity : </label>
                                        <input type="number" class="form-control text-center" name="" id="" style="width: 200px">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-fail" role="tabpanel" aria-labelledby="v-pills-fail-tab">
                                    <p class="text-muted">
                                        Please fill in the information below for <b class="text-dark">expiry extension</b>. The field labels marked with * are required input fields.
                                    </p>
                                    <div class="row m-0">
                                        <div class="col-12 text-start mb-2 px-1">
                                            <label for="2_years" ><input id="2_years" type="checkbox" class="me-2 form-check-input" placeholder="Type here">2 years ( Liquids, others)</label>
                                        </div>
                                        <div class="col-12 text-start mb-2 px-1">
                                            <label for="5_years" ><input id="5_years" type="checkbox" class="me-2 form-check-input" placeholder="Type here"> 5 years ( Dry, inert, OEM declares non-expiry materials)</label>
                                        </div> 
                                        
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-12  my-2 mt-4 px-1">
                            Accordance to EG1 Chemical UIMS 2021

                            <div class="text-center">
                                <button class="btn btn-success rounded-pill">Submit and archive</button>
                            </div>
                        </div>
                    </div> --}}
                </div>  
            </div>
        </div>
    </div> 
@endsection