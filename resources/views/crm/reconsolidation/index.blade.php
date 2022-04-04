@extends('layouts.app')
@section('content')
    <div class="row m-0">
        <div class="col-md-8">
            <div class="row m-0 align-items-center">
                <div class="col-3 text-end"><strong>Select File</strong></div>
                <div class="col-9">
                    <input type="file" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 text-start">
            <button class="btn btn-secondary">Reconcile</button>
            <a href="{{ route('view-reconsolidation') }}" class="btn btn-primary">View Reconciliation</a>
        </div>
    </div>
    <div>
        <h3 class="h4">Past Reconciliations</h3>
        <table class="table custom table-bordered table-striped border">
            <thead>
                <tr>
                    <th width="200px" class="text-center table-th">File upload Date & Time </th>
                    <th class="text-center table-th">Uploaded Filename </th>
                    <th class="text-center table-th">Reconciliation Date & Time</th>
                    <th width="100px" class="text-center table-th">Status</th>
                    <th  class="text-center table-th">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                    <td class="text-center py-1">
                        <div class="dropdown">
                            <a class="ropdown-toggle text-secondary" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a> 
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#View_Batch_Material_Product_details"><i class="bi bi-eye-fill me-1"></i>View </a>
                                <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                            </div>
                        </div>
                    </td> 
                </tr>
            </tbody>
        </table>
    </div>
@endsection