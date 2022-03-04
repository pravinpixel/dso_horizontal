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
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="table-th text-center">S.No</th>
                     <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td child-td-lg">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt size</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">Storage location </th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td text-danger">Count</th>
                </tr> 
            </thead>
            @for ($key=0; $key<2; $key++)
            <tr>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td-lg">Acetone IND</td>
                <td class="child-td child-td-lg">Sigma Aldrich</td>
                <td class="child-td">XYZ/-/4567</td>
                <td class="child-td">{{ $key+1 }}</td>
                <td class="child-td child-td-lg">Junxiang/Joon Fatt</td>
                <td class="child-td">MR</td>
                <td class="child-td">FC2</td>
                <td class="child-td">09/0{{ $key+1 }}/21</td>
                <td class="child-td text-danger">1>2>3</td>
            </tr>
            @endfor
        </table> 
    </div> 
@endsection