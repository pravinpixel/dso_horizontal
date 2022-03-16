@extends('layouts.app')
@section('content')
    <div>
        <table class="table custom table-bordered table-striped border">
            <thead>
                <tr>
                    <th class="table-th">Item Description</th>
                    <th class="table-th">Brand</th>
                    <th class="table-th">Batch/Serial#</th>
                    <th class="table-th">Pkt size</th>
                    <th class="table-th">System Stock</th>
                    <th class="table-th">Physical Stock</th>
                    <th class="table-th">Reconcile Now</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i<10; $i++)
                    <tr>
                        <td class="py-1 ">Acetone IND</td>
                        <td class="py-1 ">XOX</td>
                        <td class="py-1 ">Batch/1</td>
                        <td class="py-1 ">20</td>
                        <td class="py-1 ">15</td>
                        <td class="py-1 ">30</td>
                        <td class="py-1 ">
                            <a   data-bs-toggle="modal" data-bs-target="#standard-modal" class="btn btn-sm btn-primary">Submit</a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>


    <!-- Standard modal -->
 
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header m-0 border-0"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button></div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Item Description</th>
                            <td>:</td>
                            <td>Acetone IND</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>:</td>
                            <td>XOX</td>
                        </tr>
                        <tr>
                            <th>Batch/Serial#</th>
                            <td>:</td>
                            <td>Batch/1</td>
                        </tr>
                        <tr>
                            <th>System Stock</th>
                            <td>:</td>
                            <td><input type="number" class="bg-none form-control border-0"  value="10"></td>
                        </tr>
                        <tr>
                            <th>Physical Stock</th>
                            <td>:</td>
                            <td><input type="number" class="bg-none form-control border-0"  value="10"></td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>:</td>
                            <td><input type="text" class="bg-none form-control border-0"  value="10"></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

