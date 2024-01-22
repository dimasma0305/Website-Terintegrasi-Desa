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

                        <!-- Pie Chart -->
                        <div class="col-xl-12">
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
                        
                    </div>

                    <!-- Content Row -->

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
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                // Handle error if needed
                            }
                        });

                        // Function to update Chart.js with fetched data
                        // Bar Chart Example
                       
                    });
                </script>

                <!-- Page level plugins -->
                <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
                <!-- <script src="<?= base_url('assets/') ?>js/demo/chart-bar-demo.js"></script> -->