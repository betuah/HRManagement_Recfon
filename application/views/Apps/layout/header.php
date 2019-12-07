<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="<?php echo base_url('assets/img/logo-mini.png') ?>" alt="RECFON"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>HR </b>PORTAL</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->
            <li id="notif_content" class="dropdown notifications-menu">
                
            </li>
    
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $pic; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $full_name; ?></span>
                </a>
                <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="<?php echo $pic; ?>" class="img-circle" alt="User Image">

                    <p>
                    <?php echo $full_name; ?>
                    <small><?=$email ?></small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a onclick="active('profile','<?php echo $this->session->token; ?>')" class="btn btn-default btn-flat"><?php echo $val = $this->session->bahasa === 'EN' ? 'Profile' : 'Profil'; ?></a>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo base_url('/auth/logout'); ?>" class="btn btn-default btn-flat"><?php echo $val = $this->session->bahasa === 'EN' ? 'Sign out' : 'Keluar'; ?></a>
                    </div>
                </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>
    </div>
    </nav>
</header>