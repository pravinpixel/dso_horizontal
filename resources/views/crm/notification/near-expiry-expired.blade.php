@extends('layouts.app')
@section('content')
<div class="s">
    @if (count($near_expiry) !== 0)
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
                            <th>Material / Product  Description</th>
                            <th>Brand</th>
                            <th>#Batch/Serial/PO No</th>
                            <th>Qty</th>
                            <th>Owner 1/2</th>
                            <th>Storage location</th>
                            <th>Housing Type</th>
                            <th>DOE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($near_expiry as $i => $row) 
                            <tr>
                                <td>{{ $row->BatchMaterialProduct->item_description }}</td>
                                <td>{{ $row->brand }}</td>
                                <td>{{ $row->batch }} / {{ $row->serial }} / {{ $row->po_number }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{  $row->owner_one }} / {{ $row->owner_two }}</td>
                                <td>{{ $row->StorageArea->name }} </td>
                                <td>{{ $row->HousingType->name }} </td>
                                <td>{{ $row->date_of_expiry }} </td>
                                <td>
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
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    @endif
    
    @if (count($expired) !== 0)
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
                            <th>Item  Description</th>
                            <th>Brand</th>
                            <th>#Batch/Serial/PO No</th>
                            <th>Qty</th>
                            <th>Owner 1/2</th>
                            <th>Storage location</th>
                            <th>Housing Type</th>
                            <th>DOE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expired as $i => $row)
                            <tr>
                                <td>{{ $row->BatchMaterialProduct->item_description }}</td>
                                <td>{{ $row->brand }}</td>
                                <td>{{ $row->batch }} / {{ $row->serial }} / {{ $row->po_number }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{  $row->owner_one }} / {{ $row->owner_two }}</td>
                                <td>{{ $row->StorageArea->name }} </td>
                                <td>{{ $row->HousingType->name }} </td>
                                <td>{{ $row->date_of_expiry }} </td>
                                <td>
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
                        @endforeach
                    </tbody>
                </table> 
            </div>    
        </div>
    @endif

    @if (count($failed_iqc) !== 0)
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
                            <th>Material / Product  Description</th>
                            <th>Brand</th>
                            <th>#Batch/Serial/PO No</th>
                            <th>Qty</th>
                            <th>Owner 1/2</th>
                            <th>Storage location</th>
                            <th>Housing Type</th>
                            <th>DOE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($failed_iqc as $i => $row)
                            <tr>
                                <td>{{ $row->BatchMaterialProduct->item_description }}</td>
                                <td>{{ $row->brand }}</td>
                                <td>{{ $row->batch }} / {{ $row->serial }} / {{ $row->po_number }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{  $row->owner_one }} / {{ $row->owner_two }}</td>
                                <td>{{ $row->StorageArea->name }} </td>
                                <td>{{ $row->HousingType->name }} </td>
                                <td>{{ $row->date_of_expiry }} </td>
                                <td>
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
                        @endforeach
                    </tbody>
                </table> 
            </div>    
        </div>
    @endif
</div>     
@endsection 