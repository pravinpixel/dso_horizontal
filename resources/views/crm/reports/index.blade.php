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
            {{-- <button class="btn btn-primary rounded-pill"><i class="fa fa-plus me-1"></i> Add</button> --}}
        </div>
    </div> 
    @include('includes.sections.filter')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#Direct_Deduct" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate Material/Product withdrawal rate</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#search" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">List search (filter by fields)</span>
            </a>
        </li> 
        <li class="nav-item">
            <a href="#Generatemp" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Generate material/product history</span>
            </a>
        </li> 
    </ul>
    
    <div class="tab-content bg-white border-bottom mb-3 border-start  border-end ">
        <div class="tab-pane p-3 show active" id="Direct_Deduct"> 
               <div class="row m-0">
                <div class="col-md-6 p-0">
                    <div class="cardx">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="h4">Generate withdrawal rate</h4>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered table-hover bg-white m-0">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="table-th child-td-lg">Mat/Pdt decription</th>
                                            <th class="table-th child-td">Brand</th>
                                            <th class="table-th child-td">Pkt size</th>
                                            <th class="table-th child-td-lg">Owner1/2</th>
                                            <th class="table-th child-td">Storage area</th> 
                                        </tr> 
                                    </thead>
                                    @for ($key=0; $key<2; $key++)
                                    <tr>
                                        <td  ><input type="checkbox" name="" id="" class="form-check-input"></td>
                                        <td class="child-td-lg"> Acetone Aero 98%</td>
                                        <td class="child-td">XOX</td>
                                        <td class="child-td">Batch1/-</td>
                                        <td class="child-td">Andrew/Joon </td>
                                        <td class="child-td-lg">CW</td> 
                                    @endfor
                                </table> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="cardx">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="h4">Material/Product Utilisation Cart</h4>
                                <div>
                                    <button class="btn btn-outline-primary rounded-pill"><i class="bi bi-arrow-repeat me-1"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table bg-white table-bordered table-hover custom-center m-0">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th class="table-th text-white" colspan="5"><span class="text-center">Withdrawal Cart</span></th>
                                    </tr>
                                    <tr>
                                        <th class="table-th">Material/Product description</th>
                                        <th class="table-th">Batch#/ Serial#</th>
                                        <th class="table-th">Withdraw Qty</th>
                                        <th class="table-th">Remarks</th>
                                        <th class="table-th"> <i class="text-danger bi bi-trash3-fill"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($key=0; $key<2; $key++)
                                        <tr>
                                            <td class="child-td">Prepreg C3K</td>
                                            <td class="child-td">Roll2/1</td>
                                            <td class="child-td">1</td>
                                            <td class="child-td">AME</td>
                                            <td class="child-td">
                                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
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
                                <td class="child-td"></td>
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
        <div class="tab-pane p-2" id="Generatemp">
            <div class="table-responsive">
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
                            <th class="table-th child-td">Disposal</th>
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
                                    <td class="child-td"></td>
                                    <td class="child-td"></td>
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
                                                    <td class="child-td">N</td>
                                                    <td class="child-td">-</td>
                                                  
                                                    <td class="child-td">
                                                        <div class="dropdown">
                                                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a> 
                                                            <div class="dropdown-menu"> 
                                                                <a class="dropdown-item text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye"></i> Gernerate</a>
                                                                 
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
        </div> 
    </div> 
@endsection 