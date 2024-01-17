                <!-- Begin Page Content -->
                <div class="container">

                    <div class="row mt-5">

                        <div class="col-12 mt-5">
                            <!-- Page Heading -->
                            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>      
                                
                            <?php foreach ($artikel as $a) : ?>
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('uploads/artikel/').$a->image_url ?>" class="h-100 card-img" alt="...">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $a->title ?></h5>
                                                <p class="card-text"><?= substr($a->content, 0, 100) ?>...</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->