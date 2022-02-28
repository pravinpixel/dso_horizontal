@extends('layouts.app')
@section('content')
        
    <div class="d-flex align-items-center mb-3">
        <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
            <div class="input-group align-items-center" title="Scan Barcode">
                <i class="bi bi-upc-scan font-20 mx-2"></i>
                <input type="text" class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill" placeholder="Click here to scan">
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
                <span class="d-none d-md-block">Deduct & track bulk vol</span>
            </a>
        </li> 
    </ul>
    
    <div class="tab-content p-3 bg-white border-bottom mb-3 border-start  border-end ">
        <div class="tab-pane " id="Deduct_track_bulk_vol"> 
            <div class="mb-3 table-responsive">
                <table class="table table-bordered table-hover bg-white">
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
                        </tr> 
                    </thead>
                    @for ($key=0; $key<1; $key++)
                    <tr class="table-tr">
                        <td colspan="12" class="p-0 border-bottom">
                            <table class="table m-0">
                                <tr>
                                    <td class="child-td-lg"><i class="bi bi-caret-right-fill table-toggle-icon" data-bs-toggle="collapse" href="#row_{{ $key+1 }}" role="button" aria-expanded="false" aria-controls="row_{{ $key+1 }}"></i> 
                                        Powder Z
                                    </td>
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
                                </tr>
                                <tr class="collapse show" id="row_{{ $key+1 }}">
                                    <td colspan="12" class="p-0">
                                        <table class="table bg-white m-0">
                                            <tr>
                                                <td class="child-td-lg"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td">10</td>
                                                <td class="child-td-lg">Keith/HuiBeng</td>
                                                <td class="child-td">CW</td>
                                                <td class="child-td">FC1</td>
                                                <td class="child-td"><small class="d-flex">31/10/2021  <i class="ms-1 text-danger dot-sm bi bi-circle-fill"></i></small> </td>
                                                <td class="child-td"><small class="badge badge-success-lighten rounded-pill">PASS</small></td>
                                                <td class="child-td">-</td> 
                                            </tr>
                                            <tr>
                                                <td class="child-td-lg">- Batch 1</td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td">1</td>
                                                <td class="child-td-lg">Keith/HuiBeng</td>
                                                <td class="child-td">CW</td>
                                                <td class="child-td">FC1</td>
                                                <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small> </td>
                                                <td class="child-td"><small class="badge badge-danger-lighten rounded-pill">FAIL</small></td>
                                                <td class="child-td">yes</td> 
                                            </tr>
                                            <tr>
                                                <td class="child-td-lg">- Batch 2</td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td">1</td>
                                                <td class="child-td-lg">Keith/HuiBeng</td>
                                                <td class="child-td">CW</td>
                                                <td class="child-td">FC1</td>
                                                <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-warning dot-sm bi bi-circle-fill"></i></small> </td>
                                                <td class="child-td"><small class="badge badge-success-lighten rounded-pill">PASS</small></td>
                                                <td class="child-td">yes</td> 
                                            </tr>
                                            <tr>
                                                <td class="child-td-lg">- Batch 3</td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td"></td>
                                                <td class="child-td">1</td>
                                                <td class="child-td">Keith/HuiBeng</td>
                                                <td class="child-td">CW</td>
                                                <td class="child-td">FC1</td>
                                                <td class="child-td"><small class="d-flex">31/10/2021 <i class="ms-1 text-success dot-sm bi bi-circle-fill"></i></small> </td>
                                                <td class="child-td"><small class="badge badge-danger-lighten rounded-pill">FAIL</small></td>
                                                <td class="child-td">-</td> 
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="table-th text-white" colspan="6"><span class="text-center">Bulk vol tracking logsheet</span></th>
                    </tr>
                    <tr>
                        <th class="table-th">Time stamp</th>
                        <th class="table-th">Last accessed</th>
                        <th class="table-th">Used Amt (kg)</th>
                        <th class="table-th">Remain Amt (kg)</th>
                        <th class="table-th">Remarks</th>
                        <th class="table-th">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="child-td">10/09/2021 at 08:00 </td>
                        <td class="child-td">Tan Ng Hui Beng</td>
                        <td class="child-td"><input type="number" name="" id="" class="form-control w-50 text-center mx-auto p-0" value="10"></td>
                        <td class="child-td">40</td>
                        <td class="child-td"><input type="text" name="" id="" class="form-control w-50 text-center mx-auto p-0"  ></td>
                        <td class="child-td">
                            <i class="btn btn-sm btn-danger-light rounded-pill bi bi-trash3-fill"></i>
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
                    <button class="btn btn-primary h-100 rounded-pill">Click to Confirm deduction</button>
                </div>
            </div>
        </div>
        <div class="tab-pane show active" id="Direct_Deduct">
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-white">
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
                        </tr> 
                    </thead>
                    @for ($key=0; $key<1; $key++)
                    <tr class="table-tr">
                        <td colspan="12" class="p-0 border-bottom">
                            <table class="table m-0">
                                <tr>
                                    <td class="child-td-lg"><i class="bi bi-caret-right-fill table-toggle-icon" data-bs-toggle="collapse" href="#roww_{{ $key+1 }}" role="button" aria-expanded="false" aria-controls="roww_{{ $key+1 }}"></i> Acetone IND</td>
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
                                </tr>
                                <tr class="collapse show" id="roww_{{ $key+1 }}">
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
            <table class="table bg-white table-bordered table-hover custom-center">
                <thead>
                    <tr class="bg text-white">
                        <th class="bg-secondary text-white" style="padding: 5px !important;" colspan="5"><span class="text-center">Withdrawal Cart</span></th>
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
                            <td class="child-td"><input type="number" name="" id="" class="form-control w-50 text-center mx-auto p-0" value="10"></td>
                            <td class="child-td"><input type="text" name="" class="form-control p-0 m-0  id="" value="AME"></td>
                            <td class="child-td">
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div class="text-end ">
                <button class="btn btn-primary rounded-pill">Click to Confirm deduction</button>
            </div>
            <table class="table bg-white table-bordered table-hover custom-center mt-3">
                <thead> 
                    <tr>
                        <th class="table-th">Date/time stamp</th>
                        <th class="table-th">Last accessed</th>
                        <th class="table-th">Auto-generate unique barcode label</th>
                        <th class="table-th">Outlife expiry from last date/time</th>
                        <th class="table-th">Outlife expiry from current date/time</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($key=0; $key<2; $key++)
                        <tr>
                            <td class="child-td">11/09/2021 08:00</td>
                            <td class="child-td">HuiBeng</td>
                            <td class="child-td">Roll2/1</td> 
                            <td class="child-td">29 days 17hrs</td>
                            <td class="child-td">11/09/2021 08:00</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div> 
    </div> 
@endsection 