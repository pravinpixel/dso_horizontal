@extends('layouts.app')
@section('content')
    <div class="row mt-4"> 
        <x-has-access name="withdrawal_index">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('withdrawal_index') }}" class="card-body btn">
                        <i class="text-warning bi bi-aspect-ratio fa-2x mb-2"></i>
                        <div class="text-primary"><b>Withdrawal</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="list-material-products">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('list-material-products') }}" class="card-body btn">
                        <i class="text-warning bi bi-plus-circle-dotted fa-2x mb-2"></i>
                        <div class="text-primary"><b> Search or Add</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="threshold-qty">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('threshold-qty') }}" class="card-body btn">
                        <i class="text-warning bi bi-subtract fa-2x mb-2"></i>
                        <div class="text-primary"><b> Threshold Qty</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="near-expiry-expired">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('near-expiry-expired') }}" class="card-body btn">
                        <i class="text-warning bi bi-list-ul fa-2x mb-2"></i>
                        <div class="text-primary"><b> Near Expiry / Expired / Failed IQC </b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="disposal">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('disposal') }}" class="card-body btn">
                        <i class="text-warning bi bi-trash2 fa-2x mb-2"></i>
                        <div class="text-primary"><b> Early Disposal</b></div>
                    </a>
                </div>
            </div>
        </x-has-access> 
        <x-has-access name="extend-expiry">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('extend-expiry') }}" class="card-body btn">
                        <i class="text-warning bi bi-arrow-up-right-square fa-2x mb-2"></i>
                        <div class="text-primary"><b> Extended Expiry</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="reports">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reports') }}" class="card-body btn">
                        <i class="text-warning bi bi-file-earmark-bar-graph fa-2x mb-2"></i>
                        <div class="text-primary"><b> Report</b></div>
                    </a>
                </div>
            </div>    
        </x-has-access> 
        <x-has-access name="threshold-qty">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('barcode.listing') }}" class="card-body btn">
                        <i class="text-warning bi bi-upc-scan fa-2x mb-2"></i>
                        <div class="text-primary"><b> Print Label</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
        <x-has-access name="reconciliation">
            <div class="col-md-2">
                <div class="shadow-sm card shadow-hover border-hover animate__animated animate__fadeIn">
                    <a href="{{ route('reconciliation') }}" class="card-body btn">
                        <i class="text-warning bi bi-arrow-repeat fa-2x mb-2"></i>
                        <div class="text-primary"><b> Reconciliation</b></div>
                    </a>
                </div>
            </div>
        </x-has-access>
    </div>
    <div class="card border shadow-sm">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h2 class="h3 px-1 m-0 text-primary">Overall Snapshots</h2>
                </div>
                <div class="col-4 ms-auto p-0">
                    <div class="nav btn-group w-100" style="flex-wrap: nowrap !important">
                        <button data-bs-toggle="tab" type="button" onclick="getDashboardData('today')" class="btn btn-outline-primary active">Today</button>
                        <button data-bs-toggle="tab" type="button" onclick="getDashboardData('week')" class="btn btn-outline-primary">Last 7 Days</button>
                        <button data-bs-toggle="tab" type="button" onclick="getDashboardData('month')" class="btn btn-outline-primary">This Month</button>
                        <button data-bs-toggle="tab" type="button" onclick="getDashboardData('year')" class="btn btn-outline-primary">This Year</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row m-0">
                <div class="col rounded shadow-hover m-1 py-2 bg-primary-gradient px-3">
                    <div class="d-flex align-items-center">
                        <div class="text-warning bi bi-tools fa-2x me-3"></div>
                        <div>
                            <p class="mb-1">Materials</p>
                            <strong class="fa-2x" id="Materials">0</strong>
                        </div>
                    </div>
                </div>
                <div class="col rounded shadow-hover m-1 py-2 bg-primary-gradient px-3">
                    <div class="d-flex align-items-center">
                        <div class="text-warning fa fa-industry fa-2x me-3"></div>
                        <div>
                            <p class="mb-1">In-house</p>
                            <strong class="fa-2x" id="InHouse">0</strong>
                        </div>
                    </div>
                </div>
                <div class="col rounded shadow-hover m-1 py-2 bg-primary-gradient px-3">
                    <div class="d-flex align-items-center">
                        <div class="text-warning bi bi-trash2 fa-2x me-3"></div>
                        <div>
                            <p class="mb-1">Disposals</p>
                            <strong class="fa-2x" id="Disposals">0</strong>
                        </div>
                    </div>
                </div>
                <div class="col rounded shadow-hover m-1 py-2 bg-primary-gradient px-3">
                    <div class="d-flex align-items-center">
                        <div class="text-warning fa fa-exclamation-circle fa-2x me-3"></div>
                        <div>
                            <p class="mb-1">Expired </p>
                            <strong class="fa-2x" id="Expired">0</strong>
                        </div>
                    </div>
                </div>
                {{-- <div class="col rounded shadow-hover m-1 py-2 bg-primary-gradient px-3">
                    <div class="d-flex align-items-center">
                        <di class="text-warning bi bi-arrow-up-right-square fa-2x me-3"></di>
                    <div>
                            <p class="mb-1">Extended</p>
                            <strong>3520</strong>
                    </div>
                    </div>
                </div>   --}}
            </div>
        </div>
    </div> 
    <div class="row m-0 ">
        <div class="col-12 text-end mb-3">
            <button class="btn btn-primary fa fa-eye" id="toggle_show"></button>
        </div>
        <div class="toggle_container col-md" id="hide_conatiner">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="h4 text-center my-1">Material/in-house product utilisation</h3>
                    <button class="btn btn-danger rounded-pill btn-sm fa fa-times" onclick="jQuery('#hide_conatiner').remove();"></button>
                </div>
                <div class="card-body"> 
                    <canvas id="myChart" class="w-100"></canvas>
                </div>
            </div>
        </div>
        <div class="toggle_container col-md">
            <div class="card">
                <div class="card-header">
                    <h3 class="h4 text-center my-1">Health count of specific materials</h3>
                </div>
                <div class="card-body"> 
                    <div class="border">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>
                                        <select name="" id="" class="form-select">
                                            <option value="">-- Choose Category --</option>
                                            <option value="">Material</option>
                                            <option value="">In-House</option>
                                        </select>
                                    </th>
                                    <th>Product 1</th>
                                    <th>Product 2</th>
                                    <th>Product 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Active</b></td>
                                    <td>250</td>
                                    <td>540</td>
                                    <td>254</td>
                                </tr>
                                <tr>
                                    <td><b>Disposed</b></td>
                                    <td>250</td>
                                    <td>540</td>
                                    <td>254</td>
                                </tr>
                                <tr>
                                    <td><b>Expired</b></td>
                                    <td>250</td>
                                    <td>540</td>
                                    <td>254</td>
                                </tr>
                                <tr>
                                    <td><b>Extended</b></td>
                                    <td>250</td>
                                    <td>540</td>
                                    <td>254</td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
    <script>
        var xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [3860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                    label: "Product 1",
                    borderColor: "#163269",
                    fill: false
                }, {
                    data: [7600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                    label: "Product 2",
                    borderColor: "#FDCA3F",
                    fill: false
                }, {
                    data: [5300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                    label: "Product 3",
                    borderColor: "#4389F6",
                    fill: false
                }]
            },
            // options: {
            //     legend: {display: false}
            // }
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#toggle_show").click(function() {
                $(".toggle_container").toggle();
            });
            getDashboardData = (type) => {
                axios.post("{{ route('get-dashBoard-counts-by-filters') }}",{
                    type : type
                }).then(function (response) {  
                    console.log(response.data)
                    Object.entries(response.data).map((item) => {
                        document.querySelector(`#${item[0]}`).innerHTML = item[1]
                    })
                }).catch(function (error) {
                    console.log(error);
                });
            }
            getDashboardData('today')
        });
    </script> 
@endsection
