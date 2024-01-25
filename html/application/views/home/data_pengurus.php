                <!-- Begin Page Content -->
                <div class="container">

                    <div class="row mt-5">

                        <div class="col-12 mt-5">
                            <!-- Page Heading -->
                            <h1 class="col-md-9 mx-auto mb-4 text-gray-800"><?= $title ?></h1>      

                            <?php foreach ($pengurus as $p) : ?>
                                <div class="col-md-9 mx-auto mb-4">
                                    <!-- Add a border around the container -->
                                    <div class="border p-3">
                                        <h3 class="text-primary"><strong></strong></h3>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= base_url('uploads/pengurus/') . $p['fotoprofil'] ?>" class="h-100 card-img" alt="...">
                                                <br><br>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="panel panel-default">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr >
                                                                <th width="15%" nowrap="">Nama</th>
                                                                <td width="1px">:</td>
                                                                <td><?= $p['nama'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th nowrap="">Nip</th>
                                                                <td width="1px">:</td>
                                                                <td><?= $p['nip'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th nowrap="">Jabatan</th>
                                                                <td width="1px">:</td>
                                                                <td><?= $p['jabatan'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th nowrap="">Lulusan</th>
                                                                <td width="1px">:</td>
                                                                <td><?= $p['pendidikan'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th nowrap="">Alamat</th>
                                                                <td width="1px">:</td>
                                                                <td><?= $p['alamat'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>

                </div>
                
        
  
                
                                    
            
                