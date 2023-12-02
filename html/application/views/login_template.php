

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
                                    <form class="user" method="post" action="<?= base_url('index/login_template') ?>">
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
                                        <a class="small" href="<?= base_url('index/register_template') ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
