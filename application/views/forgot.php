

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <?php
                                    if (!isset($url)) {?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                                        <p class="mb-4">Masukan email kamu dan link reset password akan dikirim!</p>
                                    </div>
                                    <form method="post" action='<?= base_url() ?>user/forgot_password' id="myform" accept-charset="utf-8"  class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" > Reset Password</button>
                                    </form>
                                    <?php }else {?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Permintaan reset password</h1>
                                        <p class="mb-4">klik link berikut :</p> <a href="<?= $url ?>"><?= $url ?></a>
                                    </div>
                                    <?php } ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('register') ?>">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('login') ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>