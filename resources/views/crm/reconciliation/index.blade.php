@extends('layouts.app')
@section('content')
    <div class="card border shadow-sm col-md-6 mx-auto">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title m-0">Select File</h4>
        </div>
        <div class="card-body pb-0">
            <form action="{{ route('reconciliation.store') }}"  method="POST" class="input-group rounded-pill" style="overflow: hidden" enctype="multipart/form-data"> @csrf
                <input type="file" name="ReconciliationFile" class="form-control" required />
                <input type="submit" class="btn btn-success" value="Reconcile">
            </form>
            <form action="{{ route('reconciliation.download') }}" method="POST" class="text-end"> @csrf
                <button type="submit" class="btn btn-link btn-sm my-2">
                    <i class="bi bi-download"></i>
                    Download Sample
                </button>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('view-reconciliation') }}" class="btn btn-outline-primary rounded-pill btn-sm">
                <i class="bi bi-eye"></i> View Reconciliation
            </a>
        </div>
    </div>
    @if(count($Reconciliation) > 0)
        <hr>
        <h3 class="h4 text-center my-3"><i class="bi bi-clock"></i> Past Reconciliations</h3>
        <table class="table table-sm border border-light table-hover shadow-sm">
            <thead>
                <tr class="text-primary shadow-sm border">
                    <th>S.No </th>
                    <th>Uploaded Filename </th>
                    <th>Uploaded AT </th>
                    <th>Reconciliation Date & Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Reconciliation as $i => $row)
                    <tr>
                        <td>{{ $i +1 }}</td>
                        <td>{{ str_replace("public/files/ReconciliationFile/", '' , $row->file_name) }}</td>
                        <td>{{ $row->uploaded_at }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td> 
                            @if ($row->status)
                                <span class="badge bg-success">Success</span>
                                @else       
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="ropdown-toggle text-secondary"  id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a> 
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" download="File_{{ now() }}" href="{{ url('storage/app/'.$row->file_name) }}"><i class="bi bi-download me-1"></i>Download </a>
                                    <a class="dropdown-item text-danger"><i class="bi bi-trash  me-1"></i>Delete </a>
                                </div>
                            </div>
                        </td> 
                    </tr>
                @endforeach 
            </tbody>
        </table>
    @endif
@endsection