<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HR Portal | SEAMEO RECFON</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/font-awesome/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/Ionicons/ionicons.min.css'); ?>">
        <!-- Toast -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/toastr/toastr.min.css'); ?>">
        <!-- Confirm Dialog -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/jquery-confirm/jquery-confirm.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/AdminLTE.min.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font --> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <br>
                <img src="<?php echo base_url('assets/img/logo.png') ?>" alt="RECFON" height="80" width="160"><br>
                <a href="<?php echo base_url(); ?>"><b class="text-aqua">HR </b> PORTAL</a>
            </div>
            <!-- /.login-logo -->
            <?php if (isset($alert)) { ?>
                <h5 class="text-center"><?php echo $alert; ?></h5><br>
            <?php } else { ?>
                <!-- <p class="login-box-msg">Sign in to start your session</p>--><br> 
            <?php } ?>

            <div class="row">
                <div class="col-12 col-md-6">
                    <!-- <a href="<?php echo base_url('auth/manual_login'); ?>" class="btn btn-primary btn-block">Sign In</a> -->
                    <a href="<?php echo base_url('auth/manual_login'); ?>" class="btn btn-block btn-social btn-twitter "><i class="fa fa-lock"></i><b>Log In</b></a>
                </div>

                <div class="col-12 col-md-1"></div>

                <div class="col-12 col-md-6">
                    <a href="<?php echo base_url('auth/google_oauth') ?>" class="btn btn-block btn-social btn-google "><i class="fa fa-google"></i><b>Google Suite</b></a>
                </div>

                <br><br><br><hr>
                <p class="text-center"> SEAMEO - RECFON &copy; 2019</p>
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="<?php echo base_url('/assets/components/jquery/jquery.min.js'); ?>"></script>
        <!-- jQuery Confirm -->
        <script src="<?php echo base_url('/assets/components/jquery-confirm/jquery-confirm.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url('/assets/components/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- Toast Lib -->
        <script src="<?php echo base_url('/assets/components/toastr/toastr.min.js'); ?>"></script>
        <!-- Login -->
        <script src="<?php echo base_url('/assets/js/settings/auth.js'); ?>"></script>
        <!-- Toast Set -->
        <script src="<?php echo base_url('/assets/js/settings/toast.js'); ?>"></script>
        <!-- Base URL -->
        <script src="<?php echo base_url('/assets/js/settings/base_url.js'); ?>"></script>

        <script>
            
        </script>

    </body>
</html>
