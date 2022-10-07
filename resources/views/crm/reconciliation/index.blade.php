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
            <form action="{{ route('reconciliation.download') }}" method="POST" class="text-center"> @csrf
                <button type="submit" class="btn btn-link btn-sm my-2">
                    <i class="bi bi-download"></i>
                    Download Sample
                </button>
            </form>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('view-reconciliation') }}" class="btn btn-outline-primary rounded-pill btn-sm">
                <i class="bi bi-eye"></i> View Reconciliation
            </a>
        </div>
    </div>
    @if(count($Reconciliation) > 0)
        <hr>
        <h3 class="h4 text-center my-3 text-dark"><i class="bi bi-clock"></i> Past Reconciliations</h3>
        <table class="table table-sm border border-light table-hover shadow-sm">
            <thead>
                <tr class="text-secondary shadow-sm border">
                    <th>S.No </th>
                    <th>Uploaded Filename </th>
                    <th>Uploaded AT </th>
                    <th>Reconciliation Date & Time</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Reconciliation as $i => $row)
                    <tr>
                        <td class="text-center">{{ $i +1 }}</td>
                        <td>{{ str_replace("public/files/ReconciliationFile/", '' , $row->file_name) }}</td>
                        <td class="text-center">{{ $row->uploaded_at }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td class="text-center">
                            @if ($row->status)
                                <span class="btn-sm font-12 rounded-pill text-white bg-success"><i class="bi bi-check-circle"></i> Success</span>
                                @else       
                                <span class="btn-sm font-12 rounded-pill text-dark bg-warning"><i class="bi bi-x-circle"></i> Failed</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a class="rounded-pill btn btn-sm btn-outline-dark-primary me-1" download="File_{{ now() }}" href="{{ url('storage/app/'.$row->file_name) }}"><i class="bi bi-download"></i></a>
                                <form action="{{ route('reconciliation.destroy',$row->id) }}"  method="POST"> 
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="event.preventDefault();if(confirm('Are You Sure want to Delete')) { this.form.submit() }" 
                                        class="rounded-pill btn btn-sm btn-outline-danger" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td> 
                    </tr>
                @endforeach 
            </tbody>
        </table>
    @endif
@endsection