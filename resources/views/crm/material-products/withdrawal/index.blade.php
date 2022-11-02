@extends('layouts.app')
@section('content')
    <div>
        <div class="d-flex align-items-center mb-3 justify-content-between">
            <div class="col-5 p-1 border rounded-pill shadow-sm bg-white">
                <div class="input-group align-items-center" title="Scan Barcode">
                    <i class="bi bi-upc-scan font-20 mx-2"></i>
                    <input type="number" id="barcode_input" onkeyup="getWithDrawlCart(this.value)"
                        class="form-control form-control-lg border-0 bg-light ms-1 rounded-pill"
                        placeholder="Click here to scan">
                </div>
            </div>
        </div>
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#DIRECT_DEDUCT" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                        <span class="font-16 fw-bold">Direct Deduct</span>
                        <span class="badge ms-2 bg-blue-1" id="DirectDeductCount">{{ count($direct_deducts) }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#DEDUCT_TRACK_USAGE" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="font-16 fw-bold">Deduct & Track Usage</span>
                        <span class="badge ms-2 bg-blue-2" id="DeductTrackUsageCount">{{ count($deduct_track_usage) }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#DEDUCT_TRACK_OUTLIFE" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="font-16 fw-bold">Deduct & Track Outlife</span>
                        <span class="badge ms-2 bg-blue-3" id="DeductTrackOutlifeCount">{{ count($deduct_track_outlife) }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content text-center border border-top-0 p-3 m-0 bg-white">
                <div class="tab-pane show active" id="DIRECT_DEDUCT">
                    @include('crm.material-products.withdrawal.direct-deduct')
                </div>  
                <div class="tab-pane" id="DEDUCT_TRACK_USAGE">
                    @include('crm.material-products.withdrawal.deduct-track-useage')
                </div>
                <div class="tab-pane" id="DEDUCT_TRACK_OUTLIFE">
                    @include('crm.material-products.withdrawal.deduct-track-outlife')
                </div>
            </div>
        </div>
    </div>
    <div id="View_Batch_Details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View Batch Details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll-2 p-0"> 
                    <ol class="list-group list-group-numbered" style="overflow: hidden" id="Batch_Details"> </ol> 
                </div> 
            </div> 
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('public/asset/js/controllers/NotificationController.js') }}"></script>
    <script>
        getWithDrawlCart = async (barcode) => { // Scan Barcode
            validate(barcode) && fetch(`${APP_URL}/withdrawal/get-withdrawal-batches/${barcode}`).then(response => response.json()).then((data) => {
                render(data);
            })
        }
        decreaseQuantity = (id, tabName) => { // Decresing Qty
            fetch(`${APP_URL}/withdrawal/decrease-quantity/${id}`).then(response => response.json()).then((data) => {
                activeMenu(data.withdraw_type)
                renderAgain(tabName)
            })
        }
        deleteRow = (id, tabName) => { // Delete Row
            fetch(`${APP_URL}/withdrawal/delete-withdraw-cart/${id}`).then(response => response.json()).then((data) => {
                activeMenu(data.withdraw_type)
                renderAgain(tabName)
            })
        }
        // Helpers
        render = (response) => {
            if (response.status == true) {
                document.getElementById(response.withdraw_type).innerHTML = response.data;
                activeMenu(response.withdraw_type)
            }
            document.getElementById("barcode_input").value = '';
            fetch(`${APP_URL}/withdrawal/get-withdraw-cart-count`).then(response => response.json()).then((data) => {
                document.getElementById("DirectDeductCount").innerHTML = data.direct_deduct;
                document.getElementById("DeductTrackUsageCount").innerHTML = data.deduct_track_usage;
                document.getElementById("DeductTrackOutlifeCount").innerHTML = data.deduct_track_outlife;
            })
        }
        renderAgain = (tabName) => {
            fetch(`${APP_URL}/withdrawal/get-withdrawal-data/${tabName}`).then(response => response.json()).then((data) => {
                render(data);
            });
        }
        activeMenu = (tab_menu_name) => {
            var tabLink = document.querySelectorAll('a[data-bs-toggle="tab"]');
            var tabPane = document.querySelectorAll('div.tab-pane');
            tabLink.forEach(element => {
                element.classList.remove('active')
            });
            tabPane.forEach(element => {
                element.classList.remove('show')
                element.classList.remove('active')
            });
            var tabTable = document.getElementById(tab_menu_name);
            var tabTableLink = document.querySelector(`a[href="#${tab_menu_name}"]`);
            tabTable.classList.add("show")
            tabTable.classList.add("active")
            tabTableLink.classList.add('active')
        }
        validate = (barcode) => {
            if (barcode === undefined || barcode == '' || barcode === null) {
                return false
            } else {
                return true
            }
        }
        // ========== Deduct & Track Usage  =========
        startTrackUsage = (total_amount,used_amount) => {
            var remain_amount       = document.getElementById('remain_amount')
                remain_amount.value = total_amount - used_amount
        }
    </script>
@endsection