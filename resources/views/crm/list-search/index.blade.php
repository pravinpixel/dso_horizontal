@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control  form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
            </div> 
        </div> 
    </div>
    
    {{-- @include('includes.sections.filter') --}}
    
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                     <th class="table-th child-td-lg"> Item Description</th>
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
                                        <a class="dropdown-item" data-target="#ViewMP"><i class="bi bi-eye-fill me-1"></i>View </a>
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
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-eye"></i> View batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
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
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-eye"></i> View batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
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
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-eye"></i> View batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-arrows-move me-1"></i>Transfer</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box-seam me-1"></i>Repack/Transfer </a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-box2-fill me-1"></i>Repack/outlife</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-upc-scan me-1"></i>Print Barcode/Label</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="bi bi-trash3-fill me-1"></i> Delete batch</a> 
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
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-eye"></i> View batch details</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-back me-1"></i>Duplicate batch</a>
                                                    <a class="dropdown-item text-secondary" href="#"><i class="bi bi-pencil-square me-1"></i>Edit batch</a>
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
@endsection