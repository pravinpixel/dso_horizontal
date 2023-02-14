@extends('crm.reports.index')

@section('report_content')
    <form action="{{ route('reports.utilization-cart') }}" method="POST">
        @csrf
        <div class="row m-0 justify-content-center">
            <div class="col-8">
                <div class="table-fillters row m-0 border">
                    <div class="col">
                        <label for="" class="form-label">Start Date</label>
                        <input type="month" onchange="setMonthValidateion(this.value)" name="start_month" id="start_month"
                            class="form-control custom" placeholder="DD/MM/YYYY">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">End Date</label>
                        <input type="month" name="end_month" id="end_month" class="form-control custom"
                            placeholder="DD/MM/YYYY">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Actions</label>
                        <div class="btn-group w-100">
                            <button type="button" name="filter" id="filter"
                                class="btn-sm btn btn-primary form-control-sm"><i class="fa fa-refresh"></i>
                                Generate</button>
                            <button type="button" name="refresh" id="refresh"
                                class="btn-sm btn btn-warning form-control-sm"><i class="fa fa-repeat"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="utiliation-cart-model" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light border-bottom">
                    <h4 class="modal-title text-center w-100 text-primary" id="myLargeModalLabel">Utilization Cart</h4>
                    <div>
                        <button type="button" class="btn-sm btn btn-light border" onclick="closeUtilizationCart()"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="modal-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                    <canvas id="myChart"></canvas>
                </div>
                <div class="modal-footer border bg-light">
                    <div class="d-flex col-5 mx-auto justify-content-center align-items-center">
                        <input type="month" name="start_month" disabled id="chart_start_month"
                            class="form-control custom border-0">
                        <span class="px-2"> to </span>
                        <input type="month" name="end_month" disabled id="chart_end_month"
                            class="form-control custom border-0">
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table m-0 pt-2 table-sm" id="custom-data-table">
                <thead>
                    <tr>
                        <th class="text-white bg-primary-2 text-center font-14">S.No</th>
                        <th class="text-white bg-primary-2 text-center font-14">Item description</th>
                        <th class="text-white bg-primary-2 text-center font-14">Brand</th>
                        <th class="text-white bg-primary-2 text-center font-14">Batch / Serial</th>
                        <th class="text-white bg-primary-2 text-center font-14">Unit Packing Value</th>
                        <th class="text-white bg-primary-2 text-center font-14">Total Quantity</th>
                        <th class="text-white bg-primary-2 text-center font-14">Average Quantity</th>
                        <th class="text-white bg-primary-2 text-center font-14">Maximum Quantity</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('public/asset/js/vendors/Chart.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function load_data(start_month = '', end_month = '') {
                $('#custom-data-table').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    // searching: false,
                    ajax: {
                        url: "{{ route('reports.utilization-cart') }}",
                        data: {
                            start_month: start_month,
                            end_month: end_month,
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "item_description",
                            name: "item_description"
                        },
                        {
                            data: "brand",
                            name: "brand"
                        },
                        {
                            data: "batch_serial",
                            name: "batch_serial"
                        },
                        {
                            data: "unit_packing_value",
                            name: "unit_packing_value"
                        },
                        {
                            data: "total_quantity",
                            name: "total_quantity"
                        },
                        {
                            data: "average_quantity",
                            name: "average_quantity"
                        },
                        {
                            data: "maximum_quantity",
                            name: "maximum_quantity"
                        },
                    ],
                });
            }
            load_data();

            generateChart = (start_month, end_month) => {
                axios.post('{{ route('reports.utilization-chart') }}', {
                    start_month: start_month,
                    end_month: end_month
                }).then(function(response) {
                    generateChartView(response.data)
                    $('#chart_start_month').attr('value', start_month)
                    $('#chart_end_month').attr('value', end_month)
                }).catch(function(error) {
                    console.log(error);
                });
            }

            generateChartView = (data) => {
                new Chart(document.getElementById('myChart'), {
                    type: 'line',
                    data: {
                        labels  : data.chart_labels,
                        datasets: data.datasets
                    }, 
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                enabled: true,
                                usePointStyle: true,
                                callbacks: { 
                                    label: (item) => { 
                                        return `Quantity : ${item.raw}`
                                    }
                                },
                            },
                            legend: false,
                            zoom: {
                                limits: {
                                    y: {
                                        min: 0,
                                        max: 100
                                    },
                                    y2: {
                                        min: -5,
                                        max: 5
                                    }
                                },
                            },
                            title: {
                                display: true,
                                text: 'Batches Barcodes'
                            }
                        },
                        scales: {
                        x: {
                            ticks: {
                                callback: function(val, index) {
                                    return this.getLabelForValue(val).split(',')[2].replace('Date :','')
                                },
                                color: 'royalblue',
                            }
                        }
                        }
                    },
                })
                $('#utiliation-cart-model').modal('show');
            }
            closeUtilizationCart = () => {
                $('#utiliation-cart-model').modal('hide');
                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
            }

            setMonthValidateion = (month) => {
                $('#end_month').attr('min', month);
            }
            $('#refresh').click(function() {
                $('#chartContainer').addClass('d-none')
                $('#start_month').val('');
                $('#end_month').val('');
                $('#barcode').val('');
                $('#custom-data-table').DataTable().destroy();
                load_data();
            });
            $('#filter').click(function() {
                var start_month = $('#start_month').val();
                var end_month = $('#end_month').val();
                if (start_month == '' || start_month == undefined || end_month == '' || end_month ==
                    undefined) {
                    Message('danger', "Choose Start & End Months")
                    return false
                }
                generateChart(start_month, end_month)
                $('#custom-data-table').DataTable().destroy();
                load_data(start_month, end_month);
            });
        });
    </script>
@endsection
