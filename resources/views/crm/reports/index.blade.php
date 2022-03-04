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
    <table class="table table-centered table-bordered table-hover border shadow bg-white">
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
            <td colspan="12" class="p-0 border-bottom">
                <table class="table table-centered m-0">
                    <tr>
                        <td class="child-td-lg"><input type="checkbox" name="" id="" class="form-check-input"> <i class="bi bi-caret-right-fill {{ $key == 0 ? "" : "collapsed" }} table-toggle-icon" data-bs-toggle="collapse" href="#row_{{ $key+1 }}" role="button" aria-expanded="false" aria-controls="row_{{ $key+1 }}"></i> Acetone IND</td>
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
                    <tr class="collapse {{ $key == 0 ? "show" : "" }}" id="row_{{ $key+1 }}">
                        <td colspan="12" class="p-0">
                            <table class="table table-centered bg-white m-0">
                                @for ($key2=0; $key2<4; $key2++)
                                    <tr>
                                        <td class="child-td-lg"></td>
                                        <td class="child-td"></td>
                                        <td class="child-td">  
                                            <div class="btn-group">
                                                @if ($key2 == 0)
                                                    <input type="checkbox" name="" id="" class="form-check-input me-1"> Batch/1 
                                                @endif
                                                @if ($key2 == 1)
                                                    <input type="checkbox" name="" id="" class="form-check-input me-1"> Batch/2 
                                                @endif 
                                                @if ($key2 == 2)
                                                    <input type="checkbox" name="" id="" class="form-check-input me-1"> Batch/3 
                                                @endif
                                                @if ($key2 == 3)
                                                    <input type="checkbox" name="" id="" class="form-check-input me-1"> Batch/4
                                                @endif     
                                            </div> 
                                        </td>
                                        
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

    <h3 class="h5 border shadow text-primary bg-light text-center py-2">Material/In-House Product Utilisation Cart</h3>
    <table class="table table-centered table-bordered table-hover bg-white border shadow">
        <thead>
            <tr>
                <th class="table-th text-center">Item Description</th>
                <th class="table-th text-center">Brand</th>
                <th class="table-th text-center">Batch/Serial#</th>
                <th class="table-th text-center">Pkt Size</th>
                <th class="table-th text-center"><button class="text-danger btn btn-sm btn-light rounded-pill"><i class="bi bi-trash"></i></button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">Acetone IND</td>
                <td class="text-center">XOX</td>
                <td class="text-center"></td>
                <td class="text-center">1roll</td>
                <td class="text-center text-danger"><i class="bi bi-x-circle-fill"></i></td>
            </tr>
            <tr>
                <td class="text-center">Acetone IND</td>
                <td class="text-center">XOX</td>
                <td class="text-center"></td>
                <td class="text-center">1roll</td>
                <td class="text-center text-danger"><i class="bi bi-x-circle-fill"></i></td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <button class="btn btn-primary rounded-pill"><b>Export as CSV</b></button>
    </div>
    <br>
@endsection 