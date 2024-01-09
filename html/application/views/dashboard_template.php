                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>
                    <h1 class="h4 mb-4 text-gray-800">Welcome <?= $this->session->userdata('username') ?></h1>

                     <!-- Content Row -->
                     <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Surat Diterima</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat['diterima'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Surat Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat['pending'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Surat Ditolak</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat['ditolak'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan Penduduk</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Status Surat</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Diterima
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Pending
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Ditolak
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

                <script>
                    $(document).ready(function() {
                        // Fetch data using AJAX
                        $.ajax({
                            url: "<?php echo base_url('user/piechart'); ?>",
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                // Update Chart.js data with fetched data
                                console.log(response);
                                pieChart(response);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                // Handle error if needed
                            }
                        });


                        // Fetch data using AJAX
                        $.ajax({
                            url: "<?php echo base_url('user/barchart'); ?>",
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                // Update Chart.js data with fetched data
                                console.log(response);
                                barChart(response);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                // Handle error if needed
                            }
                        });

                        // Function to update Chart.js with fetched data
                        // Bar Chart Example
                        function barChart(data) {
                            var ctx = document.getElementById("myBarChart");
                            var myBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(data), // Populate with fetched data labels
                                    datasets: [{
                                        label: "Jumlah penduduk", // Label for the dataset
                                        backgroundColor: "#4e73df",
                                        hoverBackgroundColor: "#2e59d9",
                                        borderColor: "#4e73df",
                                        data: Object.values(data), // Populate with fetched data counts
                                    }],
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    layout: {
                                        padding: {
                                            left: 10,
                                            right: 25,
                                            top: 25,
                                            bottom: 0
                                        }
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                                drawBorder: false
                                            },
                                            ticks: {
                                                maxTicksLimit: 10 // Adjust as needed
                                            },
                                            maxBarThickness: 25,
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                precision: 0, // Set precision to 0 to display integers
                                                padding: 10,
                                                callback: function(value) {
                                                    return Number(value).toLocaleString(); // Format y-axis labels
                                                }
                                            },
                                            gridLines: {
                                                color: "rgb(234, 236, 244)",
                                                zeroLineColor: "rgb(234, 236, 244)",
                                                drawBorder: false,
                                                borderDash: [2],
                                                zeroLineBorderDash: [2]
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                    tooltips: {
                                        titleMarginBottom: 10,
                                        titleFontColor: '#6e707e',
                                        titleFontSize: 14,
                                        backgroundColor: "rgb(255,255,255)",
                                        bodyFontColor: "#858796",
                                        borderColor: '#dddfeb',
                                        borderWidth: 1,
                                        xPadding: 15,
                                        yPadding: 15,
                                        displayColors: false,
                                        caretPadding: 10,
                                        callbacks: {
                                            label: function(tooltipItem, chart) {
                                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                                return datasetLabel + ': ' + Number(tooltipItem.yLabel).toLocaleString();
                                            }
                                        }
                                    },
                                }
                            });
                        }
                    });
                </script>

                <!-- Page level plugins -->
                <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
                <!-- <script src="<?= base_url('assets/') ?>js/demo/chart-bar-demo.js"></script> -->