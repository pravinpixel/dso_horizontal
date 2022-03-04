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
                            <td class="child-td"></td>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disposalModal"><i class="bi bi-trash2 me-1"></i>Dispose</a>
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
        <div class="modal-dialog custom-modal-dialog modal-top">
            <div class="modal-content rounded-0 border-bottom shadow">
                <div class="card-header text-center rounded-0 bg-primary text-white">
                    <div>
                        <h4 class="modal-title mb-1" id="topModalLabel">Disposal</h4>
                        <p class="m-0">Please fill in the information below. The field labels marked with * are required input fields.</p>
                    </div>
                    <button type="button" class="btn-close top-0 right-0 m-2 position-absolute" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body ">
                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi consequuntur iste at ea, officia cum pariatur excepturi quaerat mollitia voluptas quas assumenda dolore deserunt dolorem optio ducimus, dolorum esse tempore.
                </div>  
            </div>
        </div>
    </div> 
@endsection