                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>
                    <h1 class="h4 mb-4 text-gray-800">Welcome <?= $this->session->userdata('username') ?></h1>

                     <!-- Content Row -->
                     <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Data Surat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['surat'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Data Penduduk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['penduduk'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Data Pengurus</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['pengurus'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Data Artikel</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['artikel'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Content Row -->

                    <!-- Content Row -->
                    <div class="row">
                    
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-6">
                            <div class="card shadow mb-4">
                                <a href="#collapsePie" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapsePie">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Status Surat</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse show" id="collapsePie">
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

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-6">
                            <div class="card shadow mb-4">
                                <a href="#collapseBar" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseBar">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan Penduduk</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse show" id="collapseBar">
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="myBarChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /Content Row -->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pie Chart Pendidikan -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-4">
                                <a href="#collapsePiePendidikan" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapsePiePendidikan">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pendidikan Penduduk</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse show" id="collapsePiePendidikan">
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="chartPendidikan"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-primary"></i> SD
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> SMP
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-info"></i> SMA
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-secondary"></i> S1
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart Jenis Kelamin -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <a href="#collapsePieJK" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapsePieJK">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Jenis Kelamin Penduduk</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse show" id="collapsePieJK">
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="chartJK"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-primary"></i> Laki-laki
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Perempuan
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /Content Row -->


                </div>
                <!-- /.container-fluid -->

                <script>
                    $(document).ready(function() {
                        // Fetch data using AJAX
                        $.ajax({
                            url: "<?php echo base_url('user/chart'); ?>",
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                // Update Chart.js data with fetched data
                                console.log(response);
                                pieChart(response.surat);
                                barChart(response.pekerjaan);
                                chartPendidikan(response.pendidikan);
                                chartJK(response.jenisKelamin);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                // Handle error if needed
                            }
                        });

                        // Function to update Chart.js with fetched data
                        function chartPendidikan(data) {
                            var ctx = document.getElementById("chartPendidikan");
                            var myPieChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                labels: Object.keys(data),
                                datasets: [{
                                    data: Object.values(data),
                                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#858796'],
                                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#6e7890'],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }],
                                },
                                options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 10,
                                },
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 80,
                                },
                            })
                        };

                        function chartJK(data) {
                            var ctx = document.getElementById("chartJK");
                            var myPieChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                labels: Object.keys(data),
                                datasets: [{
                                    data: Object.values(data),
                                    backgroundColor: ['#4e73df', '#1cc88a'],
                                    hoverBackgroundColor: ['#2e59d9', '#17a673'],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }],
                                },
                                options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 10,
                                },
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 80,
                                },
                            })
                        };

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