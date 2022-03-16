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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td class="text-center py-1">01/01/2021 10.30am</td>
                    <td class="text-center py-1">File 001</td>
                    <td class="text-center py-1">01/01/2021 11.30am</td>
                    <td class="text-center py-1"><span class="badge bg-success">Active</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection