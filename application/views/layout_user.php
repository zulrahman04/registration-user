<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Register</title>

        <!-- Custom fonts for this template-->
        <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
            
        <!-- Custom styles for this template-->
        <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
        

    </head>

    <body class="bg-gradient-primary">

        <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="<?= base_url('assets') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/jquery-validation/additional-methods.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

        <script src="<?= base_url() ?>assets/jquery-loading-overlay-2.1.6/dist/loadingoverlay.min.js" type="text/javascript"></script>
        <style>
            .error{
                font-size: 1em;
                color: #e74a3b;
            }
        </style>
        <div class="container">
            <?php $this->load->view($view) ?>
        </div>  

    </body>

</html>