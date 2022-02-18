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
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="h4">Generate Material/Product withdrawal rate</h4>
                        <div>
                            <button class="btn btn-outline-primary rounded-pill"><i class="bi bi-arrow-repeat me-1"></i>Generate History</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white m-0">
                            <thead>
                                <tr>
                                    <th colspan="2" class="table-th child-td-lg">Mat/Pdt decription</th>
                                    <th class="table-th child-td">Brand</th>
                                    <th class="table-th child-td">Pkt size (L)</th>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="h4">Material/Product Utilisation Cart</h4>
                        <div>
                            <button class="btn btn-outline-primary rounded-pill"><i class="bi bi-arrow-repeat me-1"></i>Generate</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table bg-white table-bordered custom-center m-0">
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
    
@endsection 