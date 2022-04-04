@extends('layouts.app')
@section('content')
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
                    <th class="table-th child-td">Storage Room</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">QC status</th>
                    <th class="table-th child-td">Used for TD/Expt</th>
                    <th class="table-th child-td">System Stock</th> 
                    <th class="table-th child-td">Physical  Stock</th> 
                    <th class="table-th child-td">Actions</th>
                </tr> 
            </thead>
            @for ($key=0; $key<3; $key++)
            <tr class="table-tr">
                <td colspan="14" class="p-0 border-bottom">
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
                            <td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="bi bi-arrow-repeat me-1"></i>reconciliation</a>
                                        <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr class="collapse show" id="row_{{ $key+1 }}">
                            <td colspan="14" class="p-0">
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
                                            <td class="child-td">15</td>
                                            <td class="child-td">10</td>
                                            <td class="child-td">10</td>
                                            <td class="child-td">
                                                <div class="dropdown">
                                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a> 
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="bi bi-arrow-repeat me-1"></i>reconciliation</a>
                                                        <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
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
     
    <!-- Standard modal -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header m-0 border-0 justify-content-end">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Item Description</th>
                            <td>:</td>
                            <td>Acetone IND</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>:</td>
                            <td>XOX</td>
                        </tr>
                        <tr>
                            <th>Batch/Serial#</th>
                            <td>:</td>
                            <td>Batch/1</td>
                        </tr>
                        <tr>
                            <th>System Stock</th>
                            <td>:</td>
                            <td><input type="number" class="bg-none form-control "  value="10"></td>
                        </tr>
                        <tr>
                            <th>Physical Stock</th>
                            <td>:</td>
                            <td><input type="number" class="bg-none form-control "  value="10"></td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>:</td>
                            <td><input type="text" class="bg-none form-control "  value="10"></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary rounded-pill px-3" value="Submit">
                    </div>
                </div> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

