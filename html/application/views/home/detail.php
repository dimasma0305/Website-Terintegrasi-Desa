<!-- <div class="container">
    <h1><?= $article->title; ?></h1>
    <img class="img-thumbnail w-25" src="<?= base_url('uploads/artikel/'). $article->image_url ?>" alt="<?= $article->image_url ?>" >
    <p><?= $article->content; ?></p>
</div> -->

                <!-- Begin Page Content -->
                <div class="container">

                    <div class="row mt-5">

                        <div class="col-12 mt-5">
                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>      
                            <h1 class="h6 mb-4 text-gray-800"><?= date("d F Y", strtotime($artikel->created_at)) ?></h1>      
                                
                                <div class="card shadow mb-4">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="<?= base_url('uploads/artikel/').$artikel->image_url ?>" class="w-75 card-img mb-5" alt="...">
                                        </div>
                                        <p class="card-text"><?= $artikel->content?></p>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->