

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="post" action='<?= base_url() ?>user/addRegister' id="myform" enctype="multipart/form-data" accept-charset="utf-8" class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email" required>
                                            <center><span style="color:red" id="semail"></span></center> 
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama"
                                        placeholder="Nama" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Password" required>
                                            <center><span style="color:red" id="spassword"></span></center> 
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="rpassword" name="rpassword" placeholder="Repeat Password" required>
                                            <center><span style="color:red" id="srpassword"></span></center>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="btn btn-info btn-user btn-block form-control" stylr="border-radius: 10rem;" id='lfoto'>Pilih Foto</label>
                                    <input type="file" class="form-control form-control-file" style="display: none" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg">
                                    <center><span style="color:red" id="sfoto"></span></center>         
                                </div>
                                <button  type="submit" class="btn btn-primary btn-user btn-block" id='simpan'>
                                    Register Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('forgot') ?>">Forgot Password?</a>
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


    <script>
        $('#myform').validate({
            rules: {
                email: {
                    required: true
                },
                nama: {
                    required: true
                },
                password: {
                    required: true, minlength: 8
                },
                rpassword: {
                    required: true, minlength: 8
                },
                foto: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Masukan Email",
                },
                nama: {
                    required: "Masukan Nama"
                },
                password: {
                    required: "Masukan Password"
                },
                rpassword: {
                    required: " ",
                    minlength: " "
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function (form) {
                valid = true
                if (isEmail($("#email").val()) == false){   
                    $('#semail').text('Email tidak sesuai')
                    valid = false
                }
                if ($("#password").val() !== $("#rpassword").val()) {
                    $('#spassword').text('Password tidak sama');
                    $('#srpassword').text('Password tidak sama');
                    valid = false
                }
                if ($("#foto").val() === '') {
                    $('#sfoto').text('Masukan Foto');
                    valid = false
                }
                if (valid == true) {          
                    $.LoadingOverlay("show");
                    $.ajax({
                        dataType: "json",
                        type: 'POST', 
                        url: '<?= base_url() ?>user/cekEmail',
                        data: {
                            email: $("#email").val()
                        },
                        success: function(response) { 
                            if (!response) {
                                setTimeout(function () {
                                    form.submit();
                                }, 500)
                            }else{
                                $('#semail').text('Email Sudah terdaftar')
                            }
                        },
                        error: function() {
                            alert('error')
                        }
                    });  
                    $('#spassword').text('');
                    $('#srpassword').text(''); 
                    $('#sfoto').text('');
                }
            }
        });

        function cekEmail(email) {
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $("#foto").change(function() {
            var fullPath = document.getElementById('foto').value;
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            } 
            if (!filename) {
                document.getElementById('lfoto').innerHTML= "Pilih Foto";
            } else {                
                document.getElementById('lfoto').innerHTML= filename;
            }
        });
    </script>