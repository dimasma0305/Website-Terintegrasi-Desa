    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <?php $this->load->view('partials/flash_block')?>
                            <form class="user" method="post" action="<?= base_url('index/register') ?>">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Username" value="<?= set_value('username') ?>">
                                        <?= form_error('username', '<small class="p-3 text-danger">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" value="<?= set_value('email') ?>">
                                        <?= form_error('email', '<small class="p-3 text-danger">', '</small>') ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password1" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            <?= form_error('password1', '<small class="p-3 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password2" type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('index/login') ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>