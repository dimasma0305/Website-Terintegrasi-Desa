                <!-- Begin Page Content -->
                <div class="container">

                    <div class="row mt-5">

                        <div class="col-12 mt-5">
                            <!-- Page Heading -->
                            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>      
                                
                            <?php foreach ($pengurus as $p) : ?>
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('uploads/pengurus/').$p['fotoprofil'] ?>" class="h-100 card-img" alt="...">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $p['nama'] ?></h5>
                                                <p class="card-text">NIP : <?= $p['nip'] ?></p>
                                                <p class="card-text">Jabatan : <?= $p['jabatan'] ?></p>
                                                <p class="card-text">Pendidikan: <?= $p['pendidikan'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->