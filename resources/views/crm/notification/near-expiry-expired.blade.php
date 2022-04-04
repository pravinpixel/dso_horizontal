@extends('layouts.app')
@section('content')
<div class="s">
   
    <div class="card"> 
        <div class="card-body p-0">
            <table class="table table-bordered table-hover bg-white border m-0">
                <thead>
                    <tr>
                        <td colspan="9" class="bg-secondary  text-white card-header text-center">
                            <h5 class="m-0">Near Expiry Material/In-house Product</h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th child-td">Item  Description</td>
                        <td class="table-th child-td">Brand</td>
                        <td class="table-th child-td">#Batch/Serial/Lot No</td>
                        <td class="table-th child-td">Qty</td>
                        <td class="table-th child-td">Owner 1/2</td>
                        <td class="table-th child-td">Storage location</td>
                        <td class="table-th child-td">Housing Type</td>
                        <td class="table-th child-td">DOE</td>
                        <td class="table-th child-td">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0;$i<6;$i++)
                        <tr>
                            <td class="child-td">IPA </td>
                            <td class="child-td">Sigma Aldrich</td>
                            <td class="child-td">ABC/-/1234</td>
                            <td class="child-td">{{ $i+1 }}0</td>
                            <td class="child-td">Junxiang/JoonFatt</td>
                            <td class="child-td">MR </td>
                            <td class="child-td">FC{{ $i+1 }}</td>
                            <td class="child-td">30/0{{ $i+1 }}/21</td>
                            <td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        <a class="dropdown-item" href="#"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
										  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch details
                                          </a> 
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    @endfor
                </tbody>
            </table> 
        </div>
    </div>
    <div class="card"> 
        <div class="card-body p-0">            
            <table class="table border table-bordered table-hover bg-white m-0">
                <thead>
                    <tr>
                        <td colspan="9" class="bg-secondary  text-white card-header text-center">
                            <h5 class="m-0">Expired Material/In-house Product</h5>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Item  Description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">#Batch/Serial/Lot No</th>
                        <th class="table-th child-td">Qty</th>
                        <th class="table-th child-td">Owner 1/2</th>
                        <th class="table-th child-td">Storage location</th>
                        <th class="table-th child-td">Housing Type</th>
                        <th class="table-th child-td">DOE</th>
                        <th class="table-th child-td">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0;$i<6;$i++)
                        <tr>
                            <td class="child-td">IPA </td>
                            <td class="child-td">Sigma Aldrich</td>
                            <td class="child-td">ABC/-/1234</td>
                            <td class="child-td">{{ $i+1 }}0</td>
                            <td class="child-td">Junxiang/JoonFatt</td>
                            <td class="child-td">MR </td>
                            <td class="child-td">FC{{ $i+1 }}</td>
                            <td class="child-td">30/0{{ $i+1 }}/21</td>
                            <td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        <a class="dropdown-item" href="#"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a>
										  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch details
                                          </a> 
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    @endfor
                </tbody>
            </table> 
        </div>    
    </div>
    <div class="card"> 
        <div class="card-body p-0">            
            <table class="table border table-bordered table-hover bg-white m-0">
                <thead>
                    <tr>
                        <td colspan="9" class="bg-secondary  text-white card-header text-center">
                            <h5 class="m-0">Failed IQC Material/In-House Product</h5>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-th child-td">Material / Product  Description</th>
                        <th class="table-th child-td">Brand</th>
                        <th class="table-th child-td">#Batch/Serial/Lot No</th>
                        <th class="table-th child-td">Qty</th>
                        <th class="table-th child-td">Owner 1/2</th>
                        <th class="table-th child-td">Storage location</th>
                        <th class="table-th child-td">Housing Type</th>
                        <th class="table-th child-td">DOE</th>
                        <th class="table-th child-td">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0;$i<6;$i++)
                        <tr>
                            <td class="child-td">IPA </td>
                            <td class="child-td">Sigma Aldrich</td>
                            <td class="child-td">ABC/-/1234</td>
                            <td class="child-td">{{ $i+1 }}0</td>
                            <td class="child-td">Junxiang/JoonFatt</td>
                            <td class="child-td">MR </td>
                            <td class="child-td">FC{{ $i+1 }}</td>
                            <td class="child-td">30/0{{ $i+1 }}/21</td>
                            <td class="child-td">
                                <div class="dropdown">
                                    <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a> 
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="bi bi-trash2 me-1"></i>To Dispose/Used for TD/Expt Project</a>
                                        {{-- <a class="dropdown-item" href="#"><i class="bi bi-arrow-up-right-square me-1"></i> Extend Expiry</a> --}}
										  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View Batch details
                                          </a> 
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    @endfor
                </tbody>
            </table> 
        </div>    
    </div>	
</div>     
@endsection 