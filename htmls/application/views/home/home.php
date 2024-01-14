                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

                    <div class="row">
                        
                        <!-- Carrousel -->
                        <div class="col-12 mb-3">

                            <div id="img-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://placehold.co/120x50" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://placehold.co/110x50   " alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://placehold.co/110x50   " alt="Third slide">
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
                            
                        <div class="card shadow mb-4">
                            <!-- Card body -->
                            <div class="card-body">
                                <h1 class="h3 mb-4 text-gray-800">Informasi Terbaru</h1>

                                <div class="row">
                                    <?php foreach ($artikel as $a) : ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <img src="<?= base_url('uploads/artikel/') . $a->image_url ?>" class="card-img-top" height="200" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $a->title ?></h5>
                                                    <p class="card-text"><?= substr($a->content, 0, 100) ?>...</p>
                                                    <a href="<?= base_url('home/artikel/') . $a->slug ?>" class="btn btn-primary">Read More</a>
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