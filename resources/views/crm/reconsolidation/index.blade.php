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
                    <th class="table-th text-center">S.No</th>
                    <th class="table-th child-td-lg">Mat/Pdt decription</th>
                    <th class="table-th child-td child-td-lg">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt size (L)</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage location </th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td text-danger">Count</th>
                </tr> 
            </thead>
            @for ($key=0; $key<2; $key++)
            <tr>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td-lg">Acetone IND</td>
                <td class="child-td child-td-lg">Sigma Aldrich</td>
                <td class="child-td">XYZ/-/4567</td>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td child-td-lg">Junxiang/Joon Fatt</td>
                <td class="child-td">MR</td>
                <td class="child-td">FC2</td>
                <td class="child-td">09/0{{ $key+1 }}/21</td>
                <td class="child-td text-danger">1>2>3</td>
            </tr>
            @endfor
        </table> 
    </div>
    <div id="advance-search-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>Advanced Search Filter</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="text-center">
                        <div class="row m-0">
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">In-house Product Logsheet ID#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input type="checkbox" id="EUCMaterial" class="form-check-input me-1">
                                <label for="EUCMaterial" class="form-lable">EUC Material</label>

                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">CAS#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Supplier</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Batch#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Serial#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Statutory board</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">SCDF</option>
                                    <option value="2">NEA</option>
                                    <option value="3">HSA</option>
                                    <option value="4">NA(CWC),</option>
                                    <option value="4">SPF</option>
                                    <option value="4">Not Applicable</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Housing type</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Flammable Cabinet</option>
                                    <option value="2">Acid Cabinet</option>
                                    <option value="3">Base Cabinet</option>
                                    <option value="4">Metal Cabinet</option>
                                    <option value="4">Racks</option>
                                    <option value="4">Dry Cabinet</option>
                                    <option value="4">Freezer</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Unit Packing size</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">kg</option>
                                    <option value="2">L</option>
                                    <option value="3">m</option>
                                    <option value="4">m2</option>
                                    <option value="4">piece</option>
                                    <option value="4">roll</option>
                                    <option value="4">drum</option>
                                    <option value="4">lnyard</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Date of expiry</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">IQC status (P/F)</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">PO Number</small>
                                <input type="number" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Extended expiry</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Extended QC statu (P/F)</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Disposed</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No but use for TD & EXPT</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Project name </small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Material/Product type</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Date of shipment</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top text-center">
                    <button class="btn btn-primary mx-auto col-3 rounded-pill"><i class="bi bi-search me-1"></i> Search</button>
                </div>
            </div> 
        </div>
    </div>
@endsection