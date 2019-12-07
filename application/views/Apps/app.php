<?php if (isset($this->session->token)) { ?>
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
        <!-- daterange picker -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/plugins/iCheck/all.css'); ?>">
        <!-- Confirm Dialog -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/jquery-confirm/jquery-confirm.min.css'); ?>">
         <!-- Toast -->
         <link rel="stylesheet" href="<?php echo base_url('/assets/components/toastr/toastr.min.css'); ?>">
        <!-- Select 2 -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/select2/css/select2.min.css'); ?>">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/datatables.net/css/responsive.bootstrap.min.css'); ?>">
        
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/material-icons/css/material-icons.min.css'); ?>"/>
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/AdminLTE.min.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/skins/_all-skins.min.css'); ?>">
        <!-- Pace style -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/plugins/pace/pace.css'); ?>">
        <!-- Custom Style -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/style.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- [if lt IE 9]> -->
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <!-- <![endif] -->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    
    <body class="hold-transition skin-purple sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

        <?php $this->view('apps/layout/header'); ?>

        <!-- =============================================== -->

        <?php $this->view('apps/layout/sidenav'); ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h3 class="col-sm-4">
                    <i class="glyphicon glyphicon-calendar text-teal"></i>&nbsp;&nbsp;&nbsp;<b id="date" class="text-dark"><?php echo date("l, M d, Y") ?></b>
                </h3>
                <h3 class="col-sm-8">
                    <i class="glyphicon glyphicon-time text-teal"></i>&nbsp;&nbsp;&nbsp;<b id="time" class="text-dark"><?php echo date("h:i A") ?></b>
                </h3>
                <ol id="breadcrumb" class="breadcrumb"></ol>
            </section>
            
            <!-- Main content -->
            <section id="content" class="content">
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Show all notif modal -->
        <div id="all_notif_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title text-center"><?php echo $val = $this->session->bahasa === 'EN' ? '<b class="text-maroon ">Notification</b> Viewer' : 'Lihat <b class="text-maroon ">Pemberitahuan</b>'; ?></h2>
                    </div>
                    <form id="leave_form" enctype="multipart/form-data" class="form-horizontal">
                        <div class="modal-body">
                            <div id="notif_all_content" class="list-group">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $val = $this->session->bahasa === 'EN' ? 'Close' : 'Tutup'; ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End show all notif modal -->

        <footer class="main-footer">
            
            <div class="pull-right hidden-xs">
                <b><?php echo $val = $this->session->bahasa === 'EN' ? 'Language' : 'Bahasa'; ?>&nbsp;</b>
                <select id="language" onchange="language()">
                    <option value="EN" <?php echo $val = $this->session->bahasa === 'EN' ? 'selected="selected"' : ''; ?> >EN</option>
                    <option value="ID" <?php echo $val = $this->session->bahasa === 'ID' ? 'selected="selected"' : ''; ?> >ID</option>
                </select> &nbsp;| &nbsp;
                <!-- <a href=""><b><?php echo $val = $this->session->bahasa === 'EN' ? 'About' : 'Tentang'; ?> </b> </a>&nbsp;|&nbsp;<a href=""> <b><?php echo $val = $this->session->bahasa === 'EN' ? 'Help' : 'Bantuan'; ?></b> </b> </a> &nbsp;| &nbsp;<b><?php echo $val = $this->session->bahasa === 'EN' ? 'Version' : 'Versi'; ?></b> 1.0.1  -->
                  &nbsp;<b><?php echo $val = $this->session->bahasa === 'EN' ? 'Version' : 'Versi'; ?></b> 1.0.1 
            </div>
            <strong>Copyright <a href="http://www.seameo-recfon.org" target="_blank">SEAMEO RECFON</a> &copy; <?php echo date('Y'); ?>.</strong>
        </footer>

        <!-- Google Translate -->
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <!-- jQuery 3 -->
        <script src="<?php echo base_url('/assets/components/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url('/assets/components/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- PACE -->
        <script src="<?php echo base_url('/assets/components/PACE/pace.min.js'); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url('/assets/components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('/assets/components/fastclick/fastclick.js'); ?>"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo base_url('/assets/plugins/iCheck/icheck.min.js'); ?>"></script>
        <!-- date-range-picker -->
        <script src="<?php echo base_url('/assets/components/moment/min/moment.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url('/assets/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo base_url('/assets/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
        <!-- jQuery Confirm -->
        <script src="<?php echo base_url('/assets/components/jquery-confirm/jquery-confirm.min.js'); ?>"></script>
        <!-- Toast Lib -->
        <script src="<?php echo base_url('/assets/components/toastr/toastr.min.js'); ?>"></script>
        <!-- Select2 JS -->
        <script src="<?php echo base_url('/assets/components/select2/js/select2.full.min.js'); ?>"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url('/assets/components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/components/datatables.net/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/components/datatables.net/js/responsive.bootstrap.min.js'); ?>"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url('/assets/js/adminlte.min.js'); ?>"></script>
        <!-- Initial Settings -->
        <script src="<?php echo base_url('/assets/js/settings/initialize_app.js'); ?>"></script>
        <!-- SideNav Settings -->
        <script src="<?php echo base_url('/assets/js/settings/sidenav.js'); ?>"></script>
        <!-- Toast Set -->
        <script src="<?php echo base_url('/assets/js/settings/toast.js'); ?>"></script>
        <!-- Alert -->
        <script src="<?php echo base_url('/assets/js/settings/alert.js'); ?>"></script>
        <!-- Base URL -->
        <script src="<?php echo base_url('/assets/js/settings/base_url.js'); ?>"></script>
        <!-- Date Formater -->
        <!-- <script src="<?php echo base_url('/assets/components/date-formater/build/date.js'); ?>"></script> -->
        <!-- Date Formater -->
        <script src="<?php echo base_url('/assets/components/date-formater/build/date-en-US.js'); ?>"></script>
        <!-- Toast Set -->
        <script src="<?php echo base_url('/assets/js/settings/toast.js'); ?>"></script>
        <!-- Socket Io -->
        <script src="<?php echo base_url('/assets/js/socketio/socket.io.js'); ?>"></script>

        <script>
            var socket  = io.connect('http://localhost:8080');

            socket.on('res_notif', function (data) {
                if (data.notif === 1) {
                    var tokens  = '<?php echo $this->session->token; ?>';
                    var id      = <?=$id_user ?>;

                    $.ajax({
                        type: "GET",
                        url: base_url() + '/notif/get_limit/' + id,  
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", tokens);
                        }
                    }).done(function (res) {
                        $("#notif_content").html(res);
                    }).fail(function (err)  {
                        toast(2 , "Error :", "<?php echo $val = $this->session->bahasa === 'EN' ? 'Sorry, The data table cannot be show!' : 'Maaf, Data tidak dapat tampil!'; ?>");
                    });
                }
            });

        </script>

        <!-- page script -->
        <script type="text/javascript">
            $(document).ajaxStart(function () {
                Pace.restart();
            })

            function language () {
                var tokens  = '<?php echo $this->session->token; ?>';
                var val = $("#language").val();

                $.ajax({
                    type: "POST",
                    url: base_url() + '/ajax/language/' + val,  
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", tokens);
                    }
                }).done(function (res) {
                    toast(1 , "Success :", "You need to refresh this page to get the changes!");
                }).fail(function (err)  {
                    toast(2 , "Error :", "Sorry, cannot change language!");
                });
            }

            function view_all_notif (id) {
                var tokens  = '<?php echo $this->session->token; ?>';
                $.ajax({
                    type: "GET",
                    url: base_url() + '/notif/get/' + id,  
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", tokens);
                    }
                }).done(function (res) {
                    $("#notif_all_content").html(res);
                    $('#all_notif_modal').modal('show');
                }).fail(function (err)  {
                    toast(2 , "Error :", "<?php echo $val = $this->session->bahasa === 'EN' ? 'Sorry, The data table cannot be show!' : 'Maaf, tidak dapat menampilkan data!' ?>");
                });
            }

            function notif() {
                var tokens  = '<?php echo $this->session->token; ?>';
                var id      = <?=$id_user ?>;
                
                $.ajax({
                    type: "GET",
                    url: base_url() + '/notif/get_limit/' + id,  
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", tokens);
                    }
                }).done(function (res) {
                    $("#notif_content").html(res);
                }).fail(function (err)  {
                    toast(2 , "Error :", "<?php echo $val = $this->session->bahasa === 'EN' ? 'Sorry, The data table cannot be show!' : 'Maaf, tidak dapat menampilkan data!' ?>");
                });
            }

            $(document).ready(function(){
                active('home','<?php echo $this->session->token; ?>');
                verify_menu('<?php echo $this->session->token; ?>');

                var time = Date().toString("hh:mm:ss tt") ;

                // Time
                setInterval(function(){
                    <?php if (isset($this->session->token)) { ?>
                        $("#date").text(new Date().toString("dddd, MMM dd, yyyy"));
                        $("#time").text(new Date().toString("hh:mm:ss tt"));
                    <?php } else { header('Location: ' . base_url()); } ?>
                }, 1000);

                // Notif
                notif();   

                setInterval(function(){
                    var stat = '<?php if (isset($this->session->token)) { echo '1'; } else { echo '0'; } ?>';
                    if (stat !== '1') {
                        location.reload();
                    }
                }, 1000);
            });

            function read_notif(id,content) {
                var tokens  = '<?php echo $this->session->token; ?>';
                $.ajax({
                    type: "GET",
                    url: base_url() + '/notif/read/' + id,  
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", tokens);
                    }
                }).done(function (res) {
                    var res = JSON.parse(res);
                    info('<b class="">Notification<b>',`<b class=""> ${content} <b>`, 'blue', 'mdi mdi-event-available');
                    active(res.pages,'<?php echo $this->session->token; ?>');
                    notif();  
                    $('#all_notif_modal').modal('hide');
                }).fail(function (err)  {
                    toast(2 , "Error :", "<?php echo $val = $this->session->bahasa === 'EN' ? 'Sorry, The data table cannot be show!' : 'Maaf, tidak dapat menampilkan data!' ?>");
                });
            }
        </script>
    </body>
</html>
<?php } else { header('Location: ' . base_url('/auth/logout')); } ?>