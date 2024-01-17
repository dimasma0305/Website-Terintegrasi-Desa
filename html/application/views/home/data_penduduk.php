                <!-- Begin Page Content -->
                <div class="container">

                    <div class="row mt-5">

                        <div class="col-12 mt-5">
                            <!-- Page Heading -->
                            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>      
                        </div>
                    
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data Jenis Kelamin</h6>
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

                         <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <a href="#collapseBar" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseBar">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan </h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse show" id="collapseBar">
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="chartPekerjaan"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->


<script>
    $(document).ready(function() {

        // Fetch data pendidikan
        $.ajax({
            url: "<?php echo base_url('home/chartpendidikan'); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Update Chart.js data with fetched data
                console.log(response);
                chartPendidikan(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error if needed
            }
        });

        // Fetch data jenis kelamin
        $.ajax({
            url: "<?php echo base_url('home/chartjk'); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Update Chart.js data with fetched data
                console.log(response);
                chartJK(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error if needed
            }
        });

         // Fetch data pekerjaan
         $.ajax({
            url: "<?php echo base_url('home/chartpekerjaan'); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Update Chart.js data with fetched data
                console.log(response);
                chartPekerjaan(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error if needed
            }
        });

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

        function chartPekerjaan(data) {
            var ctx = document.getElementById("chartPekerjaan");
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