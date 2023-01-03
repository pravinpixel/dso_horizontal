@extends('layouts.app')
@section('content')
<div>
    <section>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-near-expiry text-white text-center">
                <h5 class="m-0">Near Expiry Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="NEAR_EXPIRY_TABLE"> 
                    <thead>
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
                            <td class="text-near-expiry"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-near-expiry"><b><small>Brand</small></b></td>
                            <td class="text-near-expiry"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-near-expiry"><b><small>Qty</small></b></td>
                            <td class="text-near-expiry"><b><small>Owners</small></b></td>
                            {{-- <td class="text-near-expiry"><b><small>Storage location</small></b></td>
                            <td class="text-near-expiry"><b><small>Housing Type</small></b></td> --}}
                            <td class="text-near-expiry"><b><small>DOE</small></b></td>
                            <td class="text-near-expiry"><b><small>IQC Status</small></b></td>
                            <td class="text-near-expiry"><b><small>Action</small></b></td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>  
            </div>
        </div>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-expired text-white text-center">
                <h5 class="m-0">Expired Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="EXPIRY_TABLE"> 
                    <thead> 
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
                            <td class="text-near-expiry"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-near-expiry"><b><small>Brand</small></b></td>
                            <td class="text-near-expiry"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-near-expiry"><b><small>Qty</small></b></td>
                            <td class="text-near-expiry"><b><small>Owners</small></b></td>
                            {{-- <td class="text-near-expiry"><b><small>Storage location</small></b></td>
                            <td class="text-near-expiry"><b><small>Housing Type</small></b></td> --}}
                            <td class="text-near-expiry"><b><small>DOE</small></b></td>
                            <td class="text-near-expiry"><b><small>IQC Status</small></b></td>
                            <td class="text-near-expiry"><b><small>Action</small></b></td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>  
            </div> 
        </div>
        <div class="card shadow-sm border"> 
            <div class="card-header bg-failed text-white text-center">
                <h5 class="m-0">Failed IQC Material/In-house Product</h5>
            </div>
            <div class="card-body">
                <table class="table m-0 table-hover table-sm" id="FAILED_IQC_TABLE"> 
                    <thead> 
                        <tr class="bg-light" style="position: sticky;top: 0;z-index: 11;">
                            <td class="text-near-expiry"><b><small>Material / Product  Description</small></b></td>
                            <td class="text-near-expiry"><b><small>Brand</small></b></td>
                            <td class="text-near-expiry"><b><small>#Batch/Serial/PO No</small></b></td>
                            <td class="text-near-expiry"><b><small>Qty</small></b></td>
                            <td class="text-near-expiry"><b><small>Owners</small></b></td>
                            {{-- <td class="text-near-expiry"><b><small>Storage location</small></b></td>
                            <td class="text-near-expiry"><b><small>Housing Type</small></b></td> --}}
                            <td class="text-near-expiry"><b><small>DOE</small></b></td>
                            <td class="text-near-expiry"><b><small>IQC Status</small></b></td>
                            <td class="text-near-expiry"><b><small>Action</small></b></td>
                        </tr> 
                    </thead>
                    <tbody></tbody>
                </table>  
            </div>
        </div>
    </section>
    @include('crm.material-products.modals.view-batch-list')
</div>
@endsection 
@section('scripts')  
    <script src="{{ asset('public/asset/js/controllers/NotificationController.js') }}"></script>
    <script>
        var tables = document.getElementsByClassName('table');
        Object.entries(tables).forEach(element => {
            if(element[1].id !== '' && element[1].id !== null) {
                var API = `{{ route('near_expiry_expired_ajax') }}/${element[1].id}`;
                $(`#${element[1].id}`).DataTable({
                    stripeClasses: [],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All'],
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: API,
                    columns: [ 
                        {data: 'item_description', name: 'item_description'},
                        {data: 'brand', name: 'brand'},
                        {data: 'batch_serial_po_number', name: 'batch_serial_po_number'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'owners', name: 'owners'},
                        // {data: 'storage_area', name: 'storage_area'},
                        // {data: 'housing_type', name: 'housing_type'},
                        {data: 'date_of_expiry', name: 'date_of_expiry'},
                        {data: 'iqc_status', name: 'iqc_status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }
        });
    </script>
@endsection