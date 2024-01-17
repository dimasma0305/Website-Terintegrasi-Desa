

    <div class="container">


        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <?php $this->load->view('partials/flash_block') ?>
                                    <form class="user" method="post" action="<?= base_url('index/login') ?>">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control form-control-user"
                                                placeholder="Username" value="<?= set_value('username') ?>">
                                            <?= form_error('username', '<small class="p-3 text-danger">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                 placeholder="Password">
                                            <?= form_error('password', '<small class="p-3 text-danger">', '</small>') ?>
                                        </div>
										<input type="hidden" name="redirect" value="<?= isset($_GET['r']) ? html_escape($_GET['r']) : '' ?>">

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('index/register') ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
