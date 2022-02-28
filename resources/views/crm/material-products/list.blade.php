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
   
    <div class="table-fillters row m-0 p-2">
        <div class="col-12 mb-2 text-end">
            <button  data-bs-toggle="modal" data-bs-target="#advance-search-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
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
        <div class="col d-flex align-items-center justify-content-center">
            <div class="btn-group">
                <button class="btn btn-sm btn-primary rounded w-100 h-100 me-2"><i class="bi bi-search"></i></i> </button>
                <button class="btn btn-sm btn-light w-100 h-100 rounded"><i class="bi bi-arrow-counterclockwise"></i></button>
            </div>
        </div> 
    </div>
    <div class="table-responsive">
        <table class="table table-centered table-bordered bg-white">
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
                    <table class="table table-centered m-0">
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
                                <table class="table table-centered bg-white m-0">
                                    @for ($key2=0; $key2<4; $key2++)
                                        <tr>
                                            <td class="child-td-lg"></td>
                                            <td class="child-td"></td>
                                            <td class="child-td">Batch1/-</td>
                                            <td class="child-td"></td>
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
    <div id="View_Material_Product_details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0 ">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View details</h4>
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
                    <h4>View batch details</h4>
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
                    <h4 class="modal-title" id="topModalLabel">Transfer batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body  ">
                    <table class="table table-centered bg-white table-bordered custom-center m-0">
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
                                <td width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
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
    </div> 
    <div id="RepackTransfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="modal-header rounded-0 bg-primary text-white  ">
                    <h4 class="modal-title" id="topModalLabel">Repack/Transfer batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-lg-12">
                            <h5 class="h5 text-primary text-center"> Bulk vol tracking logsheet (Drum)</h5>
                            <table class="table table-centered bg-white table-bordered custom-center mb-3">
                                <thead class="bg-light text-primary-2 table-bordered"> 
                                    <tr>
                                        <th>Time stamp</th>
                                        <th>Current accessed</th>
                                        <th>Input Used amt (L)</th>
                                        <th>Remain Amt (L)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0">10/09/2021 at 08:00</td>
                                        <td style="padding: 0">Ziv</td>
                                        <td style="padding: 0"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                                        <td style="padding: 0">15</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <h5 class="h5 text-primary text-center">Repacked mat/product tracking logsheet (Repack)</h5>
                            <table class="table table-centered bg-white table-bordered custom-center m-0">
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
                                        <td style="padding: 0" width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
                                        <td style="padding: 0">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">CW</option>
                                            </select>
                                        </td>
                                        <td style="padding: 0">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">FC1</option>
                                            </select>
                                        </td style="padding: 0">
                                        <td style="padding: 0">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">Keith</option>
                                            </select>
                                        </td>
                                        <td style="padding: 0">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">HuiBeng</option>
                                            </select>
                                        </td>
                                        <td style="padding: 0">
                                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer text-end  border-top">
                    <button class="btn btn-primary rounded-pill">Click to confirm transfer</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> 
    <div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="modal-header rounded-0 bg-primary text-white  ">
                    <h4 class="modal-title" id="topModalLabel">Repack/Outlife batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body  ">
                    <table class="table table-centered  bg-white table-bordered custom-center m-0">
                        <thead class="bg-light text-primary-2 table-bordered"> 
                            <tr>
                                <th width="200px">(Mother) Draw status</th>
                                <th>Date/time stamp</th>
                                <th>Last accessed</th>
                                <th>Auto-generate unique barcode label</th>
                                <th>Qty cut (kitted prepreg)</th>
                                <th>
                                    Remaining outlife (prepreg roll)
                                    Intital count: 
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <input type="number" name="" id="" style="width: 45px" value="30" class="me-1 p-0 text-center form-control form-control-sm"> days
                                    </div>
                                </th>
                                <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="300px" colspan="3">
                                    <div class="row mb-2">
                                        <div class="col p-0">
                                            <button class="btn btn-success">Draw Out</button>
                                        </div>
                                        <div class="col p-0">11/09/2021 08:00</div>
                                        <div class="col p-0">HuiBeng</div>
                                    </div>
                                    <div class="row ">
                                        <div class="col p-0">
                                            <button class="btn btn-secondary">Draw in</button>
                                        </div>
                                        <div class="col p-0">11/09/2021 08:00</div>
                                        <div class="col p-0">HuiBeng</div>
                                    </div>
                                </td>
                                <td>
                                    Roll2/1 
                                </td>
                                <td class="text-center"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                                <td>29 days 17hrs</td>
                                <td>
                                    <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
                <div class="card-footer ">
                    <div class="row align-items-center">
                        <div class="shadow-sm border col-4">
                            <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of batch</label>
                        </div>
                        <div class="col-6 ms-auto text-end">
                            <button class="btn btn-primary rounded-pill h-100">Save and Submit</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> 
@endsection