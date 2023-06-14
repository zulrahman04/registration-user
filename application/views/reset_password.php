

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
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4"><?= $email ?></p>
                                    </div>
                                    <form method="post" action='<?= base_url() ?>user/updatePassword' id="myform" accept-charset="utf-8"  class="user">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user"
                                                id="email" name="email" value="<?= $email ?>" aria-describedby="emailHelp"
                                                placeholder="Password..." required>
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" aria-describedby="emailHelp"
                                                placeholder="Password..." required>
                                            <center><span style="color:red" id="spassword"></span></center> 
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="rpassword" name="rpassword" aria-describedby="emailHelp"
                                                placeholder="Comfirm Password..." required>
                                            <center><span style="color:red" id="srpassword"></span></center> 
                                        </div>
                                        <button type="button" id="update" class="btn btn-primary btn-user btn-block" > Reset Password</button>
                                    </form>
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

        <script>
            $('#update').click(function () {
                if ($("#password").val() !== $("#rpassword").val()) {
                    $('#spassword').text('Password tidak sama');
                    $('#srpassword').text('Password tidak sama');
                }else{
                    $('#myform').submit()
                }
            })
        </script>