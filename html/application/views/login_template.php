<!-- Topbar -->
<nav class="navbar navbar-expand-lg p-3 navbar-light bg-white mb-5 static-top shadow">
    <div class='container-fluid'>
        <a class='navbar-brand' href='<?=base_url('/')?>'>Hidden brand</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <!-- Nav Item  -->
                <li class="nav-item mx-1">
                    <a href="" class="nav-link text-dark">Contact</a>
                </li>

                <!-- Nav Item -->
                <li class="nav-item mx-1">
                    <a href="" class="nav-link text-dark">Home</a>
                </li>
            </ul>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <div class="mx-1">
                <a href="" class="btn btn-outline-primary">Login</a>
                <a href="" class="btn btn-outline-primary">Register</a>
            </div>

        </div>
    </div>


</nav>
<!-- End of Topbar -->


    <div class="container">
    

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-auto">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="https://source.unsplash.com/green-grass-field-photography-7hww7t6NLcg/600x650" class="img-fluid">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('cindex/login_template') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Username">
                                            <?= form_error('username', '<small class="p-3 text-danger">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                 placeholder="Password">
                                            <?= form_error('password', '<small class="p-3 text-danger">', '</small>') ?>
                                        </div>
                                
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
    
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
