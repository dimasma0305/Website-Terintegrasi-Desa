                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

                    <div class="row mt-5">
                        
                        <!-- Carrousel -->
                        <div class="col-12 mb-3">

                            <div id="img-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?= base_url('assets/img/carousel-4.jpg') ?>" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h1 class="mb-5 pb-5 font-weight-bolder" style="font-size: 46px;">Pesona Keindahan Alam Desa</h1>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= base_url('assets/img/carousel-2.jpg') ?>" alt="Second slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h1 class="mb-5 pb-5 font-weight-bolder" style="font-size: 46px;">Sawah</h1>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= base_url('assets/img/carousel-3.jpg') ?>" alt="Third slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h1 class="mb-5 pb-5 font-weight-bolder" style="font-size: 46px;">Pura </h1>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#img-carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#img-carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>    

                        </div>
                        <!--  -->
                        
                        <!-- Artikel -->
                        <div class="col-12 mb-3">
                            
                            <div class="card shadow">
                                <!-- Card body -->
                                <div class="card-body">
                                    <h1 class="h3 mb-4 text-gray-800">Informasi Terbaru</h1>

                                    <div class="row">
                                        <?php foreach ($artikel as $a) : ?>
                                            <div class="col-md-4 mb-4">
                                                <div  class="card text-dark bg-light mb-3">
                                                <img src="<?= base_url('uploads/artikel/') . $a->image_url ?>" class="card-img-top" height="200" alt="..."/>

                                                    <div class="card-body">
                                                        <p class="card-title">
                                                            <a href="<?= base_url('home/artikel/') . $a->slug ?>" class="text-dark stretched-link" ><?= html_escape($a->title) ?></a>
                                                        </p>
                                                        <p class="card-text"><small class="text-muted"><?= date("d F Y", strtotime($a->created_at)) ?></small></p>
                                                        <!-- <a href="<?= base_url('home/artikel/') . $a->slug ?>" class="btn btn-primary">Baca</a> -->
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                       

                         <!-- Pengurus -->
                         <div class="col-12 mb-3">
                            
                            <div class="card shadow mb-4">
                                <!-- Card body -->
                                <div class="card-body">
                                    <h1 class="h3 mb-4 text-gray-800">Pengurus Desa</h1>

                                    <div class="row">
                                        <?php foreach ($pengurus as $p) : ?>
                                            <div class="col-md-4 mb-4">
                                                <div  class="card text-dark mb-3">
                                                    <img src="<?= base_url('uploads/pengurus/') . $p['fotoprofil'] ?>" class="card-img-top" height="300" width="200" alt="...">
                                                    <div class="card-body">
                                                    <table class="table table-borderless ">
                                                        <tbody>
                                                            <tr >
                                                                <th>Nama</th>
                                                                <td>:</td>
                                                                <td><?= $p['nama'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nip</th>
                                                                <td>:</td>
                                                                <td><?= $p['nip'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jabatan</th>
                                                                <td>:</td>
                                                                <td><?= $p['jabatan'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Lulusan</th>
                                                                <td>:</td>
                                                                <td><?= $p['pendidikan'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Alamat</th>
                                                                <td>:</td>
                                                                <td><?= $p['alamat'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

                