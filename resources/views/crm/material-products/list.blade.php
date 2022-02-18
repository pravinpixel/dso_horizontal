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
            <button data-bs-toggle="modal" data-bs-target="#advance-search-modal" class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
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
            <label for="" class="form-label">Date </label>
            <input type="date" class="form-control custom" placeholder="Type here...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th class="table-th child-td-lg">Mat/Pdt decription</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt size (L)</th>
                    <th class="table-th child-td">Qty</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage rm</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">QC status</th>
                    <th class="table-th child-td">Used for TD/Expt</th>
                    <th class="table-th child-td">Actions</th>
                </tr> 
            </thead>
            @for ($key=0; $key<10; $key++)
            <tr class="table-tr">
                <td colspan="12" class="p-0 border-bottom">
                    <table class="table m-0">
                        <tr>
                            <td class="child-td-lg"><i class="bi bi-caret-right-fill collapsed table-toggle-icon" data-bs-toggle="collapse" href="#row_{{ $key+1 }}" role="button" aria-expanded="false" aria-controls="row_{{ $key+1 }}"></i> Acetone IND</td>
                            <td class="child-td">XOX</td>
                            <td class="child-td"></td>
                            <td class="child-td">1</td>
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
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                        <a class="dropdown-item" href="#"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                                        <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="collapse" id="row_{{ $key+1 }}">
                            <td colspan="12" class="p-0">
                                <table class="table bg-white m-0">
                                    <tr>
                                        <td class="child-td-lg"></td>
                                        <td class="child-td"></td>
                                        <td class="child-td">Batch1/-</td>
                                        <td class="child-td"></td>
                                        <td class="child-td">10</td>
                                        <td class="child-td-lg">Keith/HuiBeng</td>
                                        <td class="child-td">CW</td>
                                        <td class="child-td">FC1</td>
                                        <td class="child-td"><small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small> </td>
                                        <td class="child-td"><small class="badge badge-success-lighten rounded-pill">PASS</small></td>
                                        <td class="child-td">-</td>
                                        <td class="child-td">
                                            <div class="dropdown">
                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a> 
                                                <div class="dropdown-menu"> 
                                                    <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View Material/Product batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#Transfers"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete material/product batch</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="child-td-lg"></td>
                                        <td class="child-td"></td>
                                        <td class="child-td">Batch1/-</td>
                                        <td class="child-td"></td>
                                        <td class="child-td">10</td>
                                        <td class="child-td-lg">Keith/HuiBeng</td>
                                        <td class="child-td">CW</td>
                                        <td class="child-td">FC1</td>
                                        <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small> </td>
                                        <td class="child-td"><small class="badge badge-danger-lighten rounded-pill">FAIL</small></td>
                                        <td class="child-td">yes</td>
                                        <td class="child-td">
                                            <div class="dropdown">
                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                                    <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View Material/Product batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete material/product batch</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="child-td-lg"></td>
                                        <td class="child-td"></td>
                                        <td class="child-td">Batch1/-</td>
                                        <td class="child-td"></td>
                                        <td class="child-td">10</td>
                                        <td class="child-td-lg">Keith/HuiBeng</td>
                                        <td class="child-td">CW</td>
                                        <td class="child-td">FC1</td>
                                        <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-warning dot-sm bi bi-circle-fill"></i></small> </td>
                                        <td class="child-td"><small class="badge badge-success-lighten rounded-pill">PASS</small></td>
                                        <td class="child-td">yes</td>
                                        <td class="child-td">
                                            <div class="dropdown">
                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                                    <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View Material/Product batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete material/product batch</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="child-td-lg"></td>
                                        <td class="child-td"></td>
                                        <td class="child-td">Batch1/-</td>
                                        <td class="child-td"></td>
                                        <td class="child-td">10</td>
                                        <td class="child-td">Keith/HuiBeng</td>
                                        <td class="child-td">CW</td>
                                        <td class="child-td">FC1</td>
                                        <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small> </td>
                                        <td class="child-td"><small class="badge badge-danger-lighten rounded-pill">FAIL</small></td>
                                        <td class="child-td">-</td>
                                        <td class="child-td">
                                            <div class="dropdown">
                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                                    <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> View Material/Product batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit material/product batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete material / product batch</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
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
    <div id="View_Material_Product_details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0 ">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View Material/Product details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body  modal-scroll-2">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Material/Product description</div>
                                Acetone IND 
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Brand</div>
                                XOX
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">CAS#</div>
                                1234
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Stat body</div>
                                SCDF
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Alert threshold amt (green)</div>
                                40
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Alert threshold amt (Amber)</div>
                                20
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Alert threshold amt (green)</div>
                                24weeks
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Alert before expiry (Amber)</div>
                                12weeks
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Access</div>
                                Default (everyone can see)
                            </div>
                        </li>
                    </ol> 
                </div> 
            </div> 
        </div>
    </div> 
    <div id="View_Batch_Material_Product_details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View Material/Product batch details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll-2">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Material/Product description</div>
                                Acetone IND 
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Brand</div>
                                XOX
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">CAS#</div>
                                1234
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Stat body</div>
                                SCDF
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Alert threshold amt (green)</div>
                                40
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Alert threshold amt (Amber)</div>
                                20
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Alert threshold amt (green)</div>
                                24weeks
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Alert before expiry (Amber)</div>
                                12weeks
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">FM1202</div>
                                Acetone IND grade form.doc
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">COC/COA</div>
                                <a href="#">Acetone COC.pdf</a> | <a href="#">Acetone COA.pdf</a> 
                            </div>
                        </li>
                    </ol> 
                </div> 
            </div> 
        </div>
    </div> 
    <div id="Transfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="modal-header rounded-0 bg-primary text-white  ">
                    <h4 class="modal-title" id="topModalLabel">Transfer Material/Product batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body  ">
                    <table class="table bg-white table-bordered custom-center m-0">
                        <thead class="bg-light text-primary-2 table-bordered"> 
                            <tr>
                                <th width="200px">Transfer Qty</th>
                                <th>Storage rm</th>
                                <th>Housing type</th>
                                <th>Owner 1</th>
                                <th>Owner 2</th>
                                <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="200px" class="text-center"><input type="number" name="" id="" value="5" class="form-control form-control-sm"></td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value="">CW</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value="">FC1</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value="">Keith</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value="">HuiBeng</option>
                                    </select>
                                </td>
                                <td>
                                    <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div> 
                <div class="modal-footer text-end  border-top">
                    <button class="btn btn-primary rounded-pill">Click to confirm transfer</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
@endsection