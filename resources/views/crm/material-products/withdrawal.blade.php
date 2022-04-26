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
            <div class="dropdown">
                <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none"   id="topnav-ecommerce" role="button"     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-caret-down-square-fill"></i>  
                </button>
                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce" >
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Products</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Products Details</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Orders</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Order Details</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Customers</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Shopping Cart</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Checkout</label>
                    <label class="dropdown-item"><input type="checkbox" class="form-check-input me-1" name="" id=""> Sellers</label>
                </div>
            </div>
        </div>
    </div>
   
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#Direct_Deduct" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Direct Deduct</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#Deduct_track_bulk_vol" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Deduct & Track Usage</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="#Deduct_track_outlife" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Deduct & Track Outlife</span>
            </a>
        </li> 
    </ul>
    
    <div class="tab-content p-3 bg-white border-bottom mb-3 border-start  border-end ">
        <div class="tab-pane " id="Deduct_track_bulk_vol"> 
            <div class="mb-3 ">           
                <table class="table table-centered table-bordered table-hover bg-white">
                    <thead>
                        <tr>
                             <th class="table-th child-td-lg"> Item Description</th>
                            <th class="table-th child-td">Brand</th>
                            <th class="table-th child-td">Batch/Serial#</th>
                            <th class="table-th child-td">Pkt size</th>
                            <th class="table-th child-td">Qty</th>
                            <th class="table-th child-td-lg">Owner1/2</th>
                            <th class="table-th child-td">storage area</th>
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
                                                    <td class="child-td">
                                                        <td class="child-td">
                                                            <div class="dropdown">
                                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </a> 
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch Details</a>
                                                                </div>
                                                            </div>
                                                        </td> 
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="bg-dark text-white" style="padding: 5px !important" colspan="8"><span class="text-center">Bulk vol tracking logsheet</span></th>
                    </tr>
                    <tr>
					    <th class="table-th child-td-lg"> Item Description</th>                    
                        <th class="table-th child-td">Batch/Serial#</th>
                        <th class="table-th child-td">Last accessed</th>
                        <th class="table-th">Date&time stamp</th> 
                        <th class="table-th">Used Amt (kg)</th>
                        <th class="table-th">Remain Amt (kg)</th>
                        <th class="table-th">Remarks</th>
                        <th class="table-th"> <i class="text-danger bi bi-trash3-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
					 <td class="child-td"> Acetone IND</td>
                        <td class="child-td">XOX</td>
                        <td class="child-td">Tan Ng Hui Beng</td>
                        <td class="child-td">5</td>
                        <td class="child-td"><input type="number" name="" id="" class="form-control w-50 text-center mx-auto p-0" value="10"></td>
                        <td class="child-td">40</td>
                        <td class="child-td"><input type="text" name="" id="" class="form-control w-50 text-center mx-auto p-0"  ></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex align-items-center">
                <div class="shadow-sm border col-3">
                    <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of material/product</label>
                </div>
                <div class="col-6 ms-auto text-end">
                    {{-- <button class="btn btn-success h-100 rounded-pill">Print Barcode</button> --}}
                    <button class="btn btn-info h-100 rounded-pill">Export Logsheet</button>
                    <button class="btn btn-primary h-100 rounded-pill">Click to Confirm deduction</button>
                </div>
            </div>
        </div>
        <div class="tab-pane show active" id="Direct_Deduct">
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
                            <th class="table-th child-td">storage area</th>
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
                                                    <td class="child-td">
                                                        <td class="child-td">
                                                            <div class="dropdown">
                                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </a> 
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch Details </a>
                                                                </div>
                                                            </div>
                                                        </td> 
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="7"><span class="text-center">Withdrawal Cart</span></th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
						 <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
						 <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td">Withdraw Qty</th>
                        <th class="table-th child-td">Remarks</th>
                        <th class="table-th child-td"> <i class="text-danger bi bi-trash3-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($key=0; $key<2; $key++)
						@if ($key == 1)
						 
                        <tr class="bg-secondary text-white">
						   <td class="child-td">Prepreg C3K</td>
						    <td class="child-td">Brand 1</td>
                            <td class="child-td">Roll2/1</td>
							 <td class="child-td">0.5L</td>
                            <td class="child-td"><input type="number" disabled name="" class="form-control w-auto p-0 form-control-sm text-center" value="10"></td>
                            <td class="child-td"><input type="text"  name="" class="form-control w-auto p-0 form-control-sm text-center" value="AME"></td>
                            <td class="child-td">
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
							 </tr>
					 
						@endif
						
						@if ($key ==0)
						<tr>
						<td class="child-td">Prepreg C3K</td>
						  <td class="child-td">Brand 1</td>
                            <td class="child-td">Roll2/1</td>
							<td class="child-td">0.5L</td>
                            <td class="child-td"><input type="number" disabled name="" class="form-control w-auto p-0 form-control-sm text-center" value="10"></td>
                            <td class="child-td"><input type="text"  name="" class="form-control w-auto p-0 form-control-sm text-center" value="AME"></td>
                            <td class="child-td">
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
						</tr> 
						@endif 
                    @endfor
                </tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
            </div>
            <table class="table bg-white table-bordered table-hover custom-center mt-3">
                <thead> 
                    <tr>
                        <th  class="bg-dark  text-white" style="padding: 5px !important;" colspan="7">Material/In-house Product Outlife Information</th>
                    </tr>
                    <tr>
                          <th class="table-th child-td">Item description</th>
						   <th class="table-th child-td">Batch#/ Serial#</th>
                        <th class="table-th child-td">Date & time stamp</th>                       
                        <th class="table-th child-td">Auto-generate unique barcode label</th>
                        <th class="table-th child-td">Outlife expiry from last date/time</th>
                        <th class="table-th child-td">Outlife expiry from current date/time</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($key=0; $key<2; $key++)
                        <tr>
							<td class="child-td">Prepreg C3K</td>						 
                            <td class="child-td">Roll2/1</td>                           
                            <td class="child-td">HuiBeng</td>
                            <td class="child-td">Roll2/1</td> 
                            <td class="child-td">29 days 17hrs</td>
                            <td class="child-td">11/09/2021 08:00</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Print outlife expiry</button>
            </div>
        </div> 
        <div class="tab-pane" id="Deduct_track_outlife">
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
                            <th class="table-th child-td">storage area</th>
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
                                                    <td class="child-td">
                                                        <td class="child-td">
                                                            <div class="dropdown">
                                                                <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </a> 
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch Details</a>
                                                                </div>
                                                            </div>
                                                        </td> 
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
            <table class="table bg-white table-bordered custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="11"><span class="text-center">Withdrawal Cart</span></th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
						<th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
						<th class="table-th child-td">Last accessed</th>
						<th class="table-th child-td">Date & time stamp</th>
                        <th class="table-th child-td">Unique Barcode Label</th>
                        <th class="table-th child-td">Pkt size(lnyards)</th>
                        <th class="table-th child-td">Qty</th>
                        <th class="table-th child-td">Remarks</th>
                        <th class="table-th child-td">Outlife expiry from last date/time</th>
                        <th class="table-th child-td">Outlife expiry from current date/time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="child-td">Prepreg C3K</td>
						<td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
						<td class="child-td">4</td>
						<td class="child-td">22-12-2022 1:05</td>
                        <td class="child-td">369854</td>
                        <td class="child-td">10</td>
                        <td class="child-td">2</td>
                        <td class="child-td"><input type="text"  name="" class="form-control  p-0 form-control-sm text-center"></td>
                        <td class="child-td">25 days 16 hour</td>
                        <td class="child-td">22-12-2022 1:05</td>
                    </tr>
                </tbody>
            </table>
             
            <div class="text-end ">
                <button class="btn btn-info rounded-pill">Confirm Deduction</button>
                <button class="btn btn-primary rounded-pill">Print outlife expiry</button>
            </div>
        </div> 
    </div> 
@endsection 