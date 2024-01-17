
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            
                <!-- Topbar -->
                <nav class="navbar navbar-expand-lg p-3 navbar-light bg-white fixed-top shadow">
                    
                    
                    <div class='container'>
                        <a class='navbar-brand text-gray-800' href='<?=base_url('home')?>'>Website Desa</a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <!-- Nav Item -->
                                <li class="nav-item mx-1">
                                    <a href="<?= base_url() ?>" class="nav-link text-gray-800">
                                    <i class="fas fa-home fa-sm fa-fw text-gray-400"></i>
                                    Home</a>
                                </li>

                                <!-- Nav Item  -->
                                <li class="nav-item mx-1">
                                    <a href="<?= base_url('home/listartikel') ?>" class="nav-link text-gray-800">
                                    <i class="fas fa-newspaper fa-sm fa-fw text-gray-400"></i>
                                    Artikel</a>
                                </li>

                                <!-- Nav Item  -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-gray-800" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-database fa-sm fa-fw text-gray-400"></i>
                                    Data Desa</a>
                                    <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="<?= base_url('home/datapenduduk') ?>">Data Penduduk</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('home/datapengurus') ?>">Data Pengurus Desa</a>
                                    </div>
                                </li>

                                <?php if (!$this->session->userdata('id')) :?>
                                <!-- Nav Item  -->
                                <li class="nav-item mx-1">
                                    <a href="<?= base_url('login') ?>" class="nav-link text-gray-800">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
                                    Login</a>
                                </li>
                                <?php else : ?>
                                <!-- Nav Item  -->
                                <li class="nav-item mx-1">
                                    <a href="<?= base_url('dashboard') ?>" class="nav-link text-gray-800">
                                    <i class="fas fa-tachometer-alt fa-sm fa-fw text-gray-400"></i>
                                    Dashboard</a>
                                </li>
                                <?php endif; ?>

                                

                            </ul>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <!-- <div class="mx-1">
                                <a href="<?=base_url('/index/login')?>" class="btn btn-outline-primary">Login</a>
                                <a href="<?=base_url('/index/register')?>" class="btn btn-outline-primary">Register</a>
                            </div> -->

                        </div>
                    </div>


                </nav>
                <!-- End of Topbar -->

