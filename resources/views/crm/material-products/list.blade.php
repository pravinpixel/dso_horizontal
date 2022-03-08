@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
            </div> 
        </div>
        <div class="col-6 d-flex justify-content-end ms-auto text-end">
            <button class="btn btn-success rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Import from Excel</button>
                  
            <button class="btn btn-primary rounded-pill mx-1"><i class="fa fa-plus me-1"></i> Add</button>
            
			  
            <div class="dropdown">
                <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none"   id="topnav-ecommerce" role="button"     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-caret-down-square-fill"></i>  
                </button>
                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce" >
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Products</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Products Details</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Orders</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Order Details</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Customers</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Shopping Cart</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Checkout</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id="">Sellers</label>
                </div>
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
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                        <a class="dropdown-item" href="#"><i class="bi bi-pencil-square me-1"></i> Edit </a>
                                        <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete</a> 
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr class="collapse show" id="row_{{ $key+1 }}">
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
                                            <td class="child-td">
                                                @if ($key2 == 0)
                                                30
                                                @endif
                                                @if ($key2 == 1)
                                                9
                                                @endif 
                                                @if ($key2 == 2)
                                                2
                                                @endif
                                                @if ($key2 == 3)
                                                10
                                                @endif  
                                            </td>
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
                <div class="modal-body modal-scroll-2 p-0">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Material description </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">In-house Product description</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">In-house Product Logsheet ID# (hyperlink to logsheet)* - for product only ; phase 2</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">EUC material* (checked if EUC material)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">CAS#</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">FM1202 (checked if FM1202 is available)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Upload SDS/Mill Cert Document*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Brand* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Supplier* (for products, can input names instead) </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Unit Packing size (select units) * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Quantity * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Batch # * (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Lot# *  (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Serial# *  (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">COC/COA/Mill Cert (attach COC/COA/Mill Cert document)* - up to 3 only.</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Statutory body (able to add in new bodies in the future)* for material not product</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Storage room (able to add in new rooms in the future)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Housing type (able to add in new housing type in the future)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Owner 1 * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Owner 2 (SE/PL/FM)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Date in *</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Date of expiry (Date)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">IQC status (P/F)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"IQC result (Visual check for non-IQC items. Attach QC document for IQC items)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">For product only, can attach COC/COA under IQC."</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">PO Number*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended expiry</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended QC status (P/F)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended QC result (Visual check if no QC conducted/Attach QC document if QC conducted)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Disposed (Y/N but used for TD&EXPT project) </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Upload disposal certificate</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Project name </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Remarks </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"Alert Threshold Qty for new material/product description (red amber green indicator to reflect quantity health status)  (All owner 1/2 to receive notification) "</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"Alert before expiry (in terms of weeks) for new material/product description (red amber green indicator to warn owners on near expiry items) (All owner 1/2 to receive notification) "</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Dept*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Material/Product type </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Cost per unit</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Access (default everyone can see, indicate who only can see) drop down list with lab groups then further breakdown into names*</li>

                        {{-- <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Material/In-house Product description</div>
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
                        </li> --}}
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
                                <div class="fw-bold">Material/In-house Product description</div>
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
                    <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                        <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                            <tr>
                                <th width="200px">Transfer Qty</th>
                                {{-- <th>Storage room (able to add in new rooms in the future)</th>
                                <th>Housing type (able to add in new housing type in the future)</th> --}}
                                <th>Storage room </th>
                                <th>Housing type </th>
                                <th>Housing No.</th>
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
                                        <option value="">AR</option> 
                                        <option value="">CW</option> 
                                        <option value="">MA</option> 
                                        <option value="">SP</option> 
                                        <option value="">MR</option> 
                                        <option value="">Polymer</option> 
                                        <option value="">ChemShed1</option> 
                                        <option value="">ChemShed2</option> 
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value=""> Flammable Cabinet</option>
                                        <option value=""> Acid Cabinet</option>
                                        <option value=""> Base Cabinet</option>
                                        <option value=""> Metal Cabinet</option>
                                        <option value=""> Racks</option>
                                        <option value=""> Dry Cabinet</option>
                                        <option value=""> Freezer</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value=""> -</option>
                                        @for ($key=0;$key<20;$key++)
                                            <option value="">{{ $key+1 }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value="">Beng HJibn</option>
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
                    <h4 class="modal-title" id="topModalLabel">Repack/Transfer Material/Product batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-lg-12">
                            <h5 class="h5 text-primary text-center"> Bulk vol tracking logsheet (Drum)</h5>
                            <table class="table table-centered bg-white table-bordered table-hover custom-center mb-3">
                                <thead class="bg-light text-primary-2 table-bordered table-hover"> 
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
                            <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                                <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                    <tr>
                                        <th width="200px">Repack Size(L)</th>
										 <th>Qty</th>
                                        <th>Storage Room</th>
                                        <th>Housing type</th>
										 <th>Housing No</th>
                                        <th>Owner 1</th>
                                        <th>Owner 2</th>
										<th>Generate Unique Barcode</th>
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
										  <td style="padding: 0">15</td>
                                        <td style="padding: 0">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">FC1</option>
                                            </select></td>
                                       <td>
                                    <select name="" id="" class="form-select form-select-sm">
                                        <option value=""> -</option>
                                        @for ($key=0;$key<20;$key++)
                                            <option value="">{{ $key+1 }}</option>
                                        @endfor
                                    </select>
                                </td>
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
										  <td style="padding: 0">Batch2/1</td>
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
                    <button class="btn btn-primary rounded-pill">Click to confirm and proceed to print label page
</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> 
    <div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="modal-header rounded-0 bg-primary text-white  ">
                    <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>				  
                <div class="modal-body  ">
				 <h5 class="h5 text-primary text-center">Mat/Pdt outlife logsheet</h5>
                    <table class="table table-centered  bg-white table-bordered table-hover custom-center m-0">
                        <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                            <tr>
                                <th width="200px">(Mother)Material/Product Draw status</th>
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