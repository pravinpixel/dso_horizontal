@extends('layouts.app')
@section('content')
    <div>

        {{-- = ==== Filletrs ====--}}
        <div class="table-fillters p-2">
            <div class="row m-0 ">
                <div class="col-md-4 d-flex align-items-center"> 
                    <label for="" class="form-label col-3">Start in</label>
                    <input type="date" ng-model="date_in" name="date_in" class="form-control custom" placeholder="Type here...">
                </div>
                <div class="col-md-4 d-flex align-items-center"> 
                    <label for="" class="form-label col-3">End in</label>
                    <input type="date" ng-model="date_in" name="date_in" class="form-control custom" placeholder="Type here...">
                </div>
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-light mx-1 border rounded-pill dropdown-toggle arrow-none"   id="topnav-ecommerce" role="button"     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-caret-down-square-fill"></i>  
                        </button>
                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce" >
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Category selection</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Owner ½</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">storage area</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Housing type </label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Housing #</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Owner 1/2</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Statutory board </label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">EUC Material </label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Require usage tracking</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Require outlife tracking</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Department</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date in </label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of expiry</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">QC status</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Used for TD/Expt</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">CAS #</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Project name</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Material/In-house product type</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of manufacture </label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Date of shipment</label>
                            <label class="dropdown-item"><input type="checkbox"class="form-check-input me-1">Cost per unit <small class="sgd"> S$ </small></label>
                        </div>
                    </div> 
                    <div>
                        <button  data-bs-toggle="modal" data-bs-target="#advance-search-ng-modal"  class="rounded-pill btn btn-sm btn-light shadow-sm border"><i class="bi bi-funnel-fill me-1"></i></i> Advanced filter</button>
                    </div>
                </div>
            </div> 
        </div> 
        {{-- ====== Filletrs ===--}} 

        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="table-th child-td-lg"> Item Description</th>
                    <th class="table-th child-td">Brand</th>
                    <th class="table-th child-td">Batch/Serial#</th>
                    <th class="table-th child-td">Pkt Size</th>
                    <th class="table-th child-td">Qty</th>
                    <th class="table-th child-td-lg">Owner1/2</th>
                    <th class="table-th child-td">storage area</th>
                    <th class="table-th child-td">Housing type</th>
                    <th class="table-th child-td">Threshold limit</th>
                    <th class="table-th child-td">DOE</th>
                    <th class="table-th child-td">Read Status</th>
					 <th class="table-th child-td">Actions</th>
                </tr> 
            </thead>
			
            <tr class="table-tr">
                <td colspan="12" class="p-0 border-bottom">
                    <table class="table m-0">
                        <tr>
                            <td class="child-td-lg"><i class="bi bi-caret-right-fill collapsed table-toggle-icon" data-bs-toggle="collapse" href="#row1" role="button" aria-expanded="false" aria-controls="row1"></i> Acetone IND</td>
                            <td class="child-td">XOX</td>
                            <td class="child-td">- Batch1/001</td>
                            <td class="child-td"> 5</td>
                            <td class="child-td-lg"></td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td text-center">10</td>
                            <td class="child-td"></td>
                            <td class="child-td"></td>
                            <td class="child-td">/-</td>
							<td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View batch details
                                        </a>                                        
                                    </div>
                                </div>
                            </td> 
                        </tr> 
                        <tr class="collapse show" id="row1">
                            <td colspan="12" class="p-0">
                                <table class="table bg-white m-0">
                                    @for ($i=0;$i<6;$i++)
                                        <tr>
                                            <td class="child-td-lg"></td>
                                            <td class="child-td"></td>
                                            <td class="child-td">Batch1/-</td>
                                            <td class="child-td">{{ $i+1 }}</td>
                                            <td class="child-td">8</td>
                                            <td class="child-td-lg">Keith/HuiBeng</td>
                                            <td class="child-td">CW</td>
                                            <td class="child-td">FC1</td>
                                            <td class="child-td"></td>
                                            <td class="child-td">10/02/2020</td>                                           
                                            <td class="child-td">
                                                <input type="checkbox" id="switch0_{{ $i+1 }}" data-switch="none"/>
                                                <label for="switch0_{{ $i+1 }}" data-on-label="" data-off-label=""></label>
                                            </td>
                                            <td class="child-td">
                                                <div class="dropdown">
                                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a> 
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View batch details
                                                        </a>                                        
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
           
        </table> 
    </div>         
@endsection 