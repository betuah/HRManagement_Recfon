<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
            <img src="<?php echo $pic; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
            <p><?php echo $full_name; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Available</a>
            </div>
        </div> -->
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?php echo $val = $this->session->bahasa === 'EN' ? 'MAIN NAVIGATION' : 'NAVIGASI UTAMA'; ?></li>
            <li id="home" onclick="active('home','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="fa fa-home"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? 'Home' : 'Beranda'; ?></span>
                    <span class="pull-right-container">
                    <!-- <small class="label pull-right bg-orange">Hot</small> -->
                    </span>
                </a>
            </li>
            <li id="profile" onclick="active('profile','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="fa fa-user-md"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? 'My Profile' : 'Profil Saya'; ?></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li id="la" class="treeview" style="display:none"> 
                <a href="#">
                    <i class="fa fa-send"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? 'Leave Application' : 'Permohonan Izin'; ?></span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul id="laul" class="treeview-menu">
                    <li style="display:none" id="lresearch" onclick="active('lresearch','<?php echo $this->session->token; ?>')"><a href="#"><i class="fa fa-circle-o"></i><?php echo $val = $this->session->bahasa === 'EN' ? 'Leave the office (Research)' : 'Izin Dinas (Riset) '; ?></a></li>
                    <li style="display:none" id="lgeneral" onclick="active('lgeneral','<?php echo $this->session->token; ?>')"><a href="#"><i class="fa fa-circle-o"></i><?php echo $val = $this->session->bahasa === 'EN' ? 'Leave the office (General)' : 'Izin Dinas (Umum) '; ?></a></li>
                    <li style="display:none" id="overtime" onclick="active('overtime','<?php echo $this->session->token; ?>')"><a href="#"><i class="fa fa-circle-o"></i><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime' : 'Izin Lembur '; ?> </a></li>
                    <li style="display:none" id="leave" onclick="active('leave','<?php echo $this->session->token; ?>')"><a href="#"><i class="fa fa-circle-o"></i><?php echo $val = $this->session->bahasa === 'EN' ? 'Leave' : 'Izin Cuti '; ?> </a></li>
                </ul>
            </li>
            <li id="approval" onclick="active('approval','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="fa fa-thumbs-o-up"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? 'Approval' : 'Persetujuan '; ?></span>
                </a>
            </li>
            <li id="employees" onclick="active('employees','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="mdi mdi-business"></i> &nbsp;&nbsp;<span><?php echo $val = $this->session->bahasa === 'EN' ? 'Employees' : 'Kepegawaian'; ?></span>
                </a>
            </li>
            <!-- <li id="employees" onclick="active('1','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="mdi mdi-account-box"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? ' Employees' : 'Data Karyawan'; ?></span>
                </a>
            </li> -->
            
            <li class="header"><?php echo $val = $this->session->bahasa === 'EN' ? 'REPORT NAVIGATION' : 'NAVIGASI LAPORAN '; ?></li>
            <li id="summary" onclick="active('summary','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="fa fa-info-circle text-green"></i> <span><?php echo $val = $this->session->bahasa === 'EN' ? 'My Summary' : 'Ringkasan '; ?></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li id="today" onclick="active('today','<?php echo $this->session->token; ?>')" style="display:none">
                <a href="#">
                    <i class="fa fa-info-circle text-yellow"></i><span><?php echo $val = $this->session->bahasa === 'EN' ? 'RECFON Today' : 'RECFON Hari Ini '; ?></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>