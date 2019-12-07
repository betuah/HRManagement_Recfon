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
                <a href="<?php base_url() ?>"><b class="text-aqua">HR </b> PORTAL</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="login-form" action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email" required >
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="pass" class="form-control" placeholder="Password" required >
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>
                </form>

                <div class="social-auth-links text-center">
                <p>- OR -</p>
               
                <a href="<?php echo base_url('/auth/google_oauth') ?>" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google"></i> Sign in using
                    Google Suite</a>
                </div>
                <!-- /.social-auth-links -->               

            </div>
            <!-- /.login-box-body --><br><hr>
            <p class="login-box-msg"> SEAMEO - RECFON &copy; 2019</p>
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="<?php echo base_url('/assets/components/jquery/jquery.min.js'); ?>"></script>
        <!-- jQuery Confirm -->
        <script src="<?php echo base_url('/assets/components/jquery-confirm/jquery-confirm.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url('/assets/components/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- Toast Lib -->
        <!-- <script src="<?php echo base_url('/assets/components/toastr/toastr.min.js'); ?>"></script> -->
        <!-- Login -->
        <script src="<?php echo base_url('/assets/js/settings/auth.js'); ?>"></script>
        <!-- Toast Set -->
        <script src="<?php echo base_url('/assets/js/settings/toast.js'); ?>"></script>
        <!-- Base URL -->
        <script src="<?php echo base_url('/assets/js/settings/base_url.js'); ?>"></script>

    </body>
</html>
