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
            <button class="btn btn-info rounded-pill mx-1"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export as CSV</button>
        </div> 
    </div> 
    @include('includes.sections.filter')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#Direct_Deduct" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate Material/ In-house Product Utilisation rate </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#search" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate list of Material/In-house Product</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="#Generatemp" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Material/Product History</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="#DisposedItems" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Disposed items</span>
            </a>
        </li> 
    </ul>
    
    <div class="tab-content bg-white border-bottom mb-3 border-start  border-end ">
        <div class="tab-pane p-3 show active" id="Direct_Deduct"> 
            <table class="table table-centered table-bordered table-hover bg-white">
                <thead>
                    <tr>
                         <th class="table-th child-td-lg"> Item Description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch/Serial#</th>
                        <th class="table-th child-td">Pkt size</th>
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
                @for ($key=0; $key<3; $key++)
                <tr class="table-tr">
                    <td colspan="13" class="p-0 border-bottom">
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
                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</a> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse show" id="row_{{ $key+1 }}">
                                <td colspan="13" class="p-0">
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
                                                        <small class="badge bg-success rounded-pill">PASS</small>
                                                    @endif
                                                    @if ($key2 == 1)
                                                        <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                    @endif 
                                                    @if ($key2 == 2)
                                                        <small class="badge bg-success rounded-pill">PASS</small>
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
                                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</a>
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="7"><span class="text-center">Utilisation Cart</span></th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
						 <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
						 <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td">Withdraw Qty</th>
                        <th class="table-th child-td"> <i class="text-danger bi bi-trash3-fill"></i></th>
                    </tr>
                </thead>
                <tbody> 											
					<tr>
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                        <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
					</tr>  										 
                    <tr class="bg-secondary text-white">
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                            <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
					</tr> 
                </tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Generate</button>
            </div>
        </div>
        <div class="tab-pane p-3" id="search">
            <table class="table table-centered table-bordered table-hover bg-white">
                <thead>
                    <tr>
                         <th class="table-th child-td-lg"> Item Description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch/Serial#</th>
                        <th class="table-th child-td">Pkt size</th>
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
                @for ($key=0; $key<3; $key++)
                <tr class="table-tr">
                    <td colspan="13" class="p-0 border-bottom">
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
                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</a> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse show" id="row_{{ $key+1 }}">
                                <td colspan="13" class="p-0">
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
                                                        <small class="badge bg-success rounded-pill">PASS</small>
                                                    @endif
                                                    @if ($key2 == 1)
                                                        <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                    @endif 
                                                    @if ($key2 == 2)
                                                        <small class="badge bg-success rounded-pill">PASS</small>
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
                                                            <a class="dropdown-item text-secondary" href="#"><i class="bi bi-cart-plus-fill me-1"></i>Add to Cart</a>
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-dark  text-white" style="padding: 5px !important;" colspan="7"><span class="text-center">Export Cart</span></th>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item description</th>
						 <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">Batch#/ Serial#</th>
						 <th class="table-th child-td">Pkt size</th>
                        <th class="table-th child-td"> Qty</th>
                        <th class="table-th child-td"> <i class="text-danger bi bi-trash3-fill"></i></th>
                    </tr>
                </thead>
                <tbody> 											
					<tr>
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                        <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
					</tr>  										 
                    <tr class="bg-secondary text-white">
                        <td class="child-td">Prepreg C3K</td>
                        <td class="child-td">Brand 1</td>
                        <td class="child-td">Roll2/1</td>
                            <td class="child-td">0.5L</td>
                        <td class="child-td text-center"><input type="number" min="1"  name="" class="border-0 bg-none form-control  p-0 form-control-sm text-center" value="10"></td>
                        <td class="child-td">
                            <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                        </td>
					</tr> 
                </tbody>
            </table> 
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Export</button>
            </div>
        </div> 
        <div class="tab-pane p-3" id="Generatemp">
            <table class="table m-0 table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="table-th text-center">S.No</th>
                        <th class="table-th text-center">Transaction date </th>
                        <th class="table-th text-center">Transaction time </th>
                        <th class="table-th text-center">Transaction By </th>
                        <th class="table-th text-center">Module </th>
                        <th class="table-th text-center">Action Taken </th>
                        <th class="table-th text-center">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0; $i<8; $i++)
                        <tr>
                            <td class="text-center py-1">{{ $i+1 }}</td>
                            <td class="text-center py-1">1{{ $i+1 }}-03-2022 </td>
                            <td class="text-center py-1">0{{ $i+1 }}:1{{ $i+1 }} AM </td>
                            <td class="text-center py-1">Transaction By </td>
                            <td class="text-center py-1">Module </td>
                            <td class="text-center py-1">Action Taken </td>
                            <td class="text-center py-1">Comments</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div> 
        <div class="tab-pane p-3" id="DisposedItems">
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
                            <th class="table-th child-td">IQC status</th>
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
                                                            <small class="badge bg-success rounded-pill">PASS</small>
                                                        @endif
                                                        @if ($key2 == 1)
                                                            <small class="badge badge-danger-lighten rounded-pill">FALL</small>
                                                        @endif 
                                                        @if ($key2 == 2)
                                                            <small class="badge bg-success rounded-pill">PASS</small>
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
                                        <input type="number" min="1"  class="form-control text-center my-2" name="" id="" value="10" style="width: 100px">
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
                        </div>  
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
@endsection