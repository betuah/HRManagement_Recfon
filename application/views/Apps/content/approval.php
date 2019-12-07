<?php if (isset($this->session->token)) { ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office <b class="text-maroon" >(Research)</b>' : 'Dinas Kantor <b class="text-maroon" >(Riset)</b>' ?> </h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_research" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date Of Research' : 'Tanggal Riset' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="200">
                            <col width="120">
                            <col width="200">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                        </thead>
                        <tbody>
                            <?php foreach ($get_reseach as $get) { ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $date  = date_create($get->date_submission);
                                            $date  = date_format($date , "d M Y");
                                        ?>
                                        <?=$date ?>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama ?></b></td>
                                    <td>
                                        <?php 
                                            $cuti = $this->session->bahasa === 'ID' ? $get->type_research_id : $get->type_research_en;
                                        ?>
                                        <b class="text-green"><?=$get->jenis_keg_lain === '' || !$get->jenis_keg_lain === null ? $cuti : $get->jenis_keg_lain ?></b>
                                    </td>
                                    <td>
                                        <?php 
                                            $start  = date_create($get->start_date);
                                            $end    = date_create($get->end_date);
                                            $ndate  = date_format($start , "d M Y") . ' - ' .  date_format($end , "d M Y");
                                        ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$ndate ?>">
                                            <?=$ndate ?> ( <b class="text-maroon"><?=$get->lama_hari ?> <?php echo $this->session->bahasa === 'EN' ? 'Day' : 'Hari' ?> </b>)
                                        </span>
                                    </td>
                                    <td><?=$get->nama_plt ?></td>
                                    <td>
                                        <span class="pull-right-container">
                                            <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                                            <a onclick="research_details('<?=$get->id_research ?>'); " class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                                        </span>
                                        <?php if ($get->approval === 1 || $get->approval === '1' ) { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                                                <a onclick="aproval('research','<?=$get->id_research ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                                                <a onclick="aproval('research','<?=$get->id_research ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date Of Research' : 'Tanggal Riset' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office <b class="text-maroon" >(General)</b>' : 'Dinas Kantor <b class="text-maroon" >(Umum)</b>' ?> </h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_general">
                    <table id="tbl_general" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type of Duty' : 'Jenis Dinas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date of Duty' : 'Tanggal Dinas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="150">
                            <col width="120">
                            <col width="200">
                            <col width="150">
                            <col width="100">
                            <col width="100">
                        </thead>
                        <tbody>
                            <?php foreach ($get_general as $get) { ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $date  = date_create($get->date_submission);
                                            $date  = date_format($date , "d M Y");
                                        ?>
                                        <?=$date ?>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama ?></b></td>
                                    <td>
                                        <?php 
                                            $cuti = $this->session->bahasa === 'ID' ? $get->name_duty_type_id : $get->name_duty_type_en;
                                        ?>
                                        <b class="text-green"><?=$get->others_duty_type === '' || !$get->others_duty_type === null ? $cuti : $get->others_duty_type ?></b>
                                    </td>
                                    <td>
                                        <?php 
                                            $start  = date_create($get->start_date);
                                            $end    = date_create($get->end_date);
                                            $ndate  = date_format($start , "d M Y") . ' - ' .  date_format($end , "d M Y");
                                        ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$ndate ?>">
                                            <?=$ndate ?> ( <b class="text-maroon"><?=$get->lama_hari ?> <?php echo $this->session->bahasa === 'EN' ? 'Day' : 'Hari' ?> </b>)
                                        </span>
                                    </td>
                                    <td><?=$get->nama_plt ?></td>
                                    <td>
                                        
                                        <span class="pull-right-container">
                                            <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label  <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($get->lampiran != null || $get->lampiran != '') { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Attachment File' : 'Lihat Lampiran' ?>">
                                                <a onclick="view_attch('general','<?=$get->id_general ?>');" class="btn btn-xs btn-info"><i class="mdi mdi-attach-file"></i></a>
                                            </span>
                                        <?php } ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                                            <a onclick="general_details('<?=$get->id_general ?>'); " class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                                        </span>
                                        <?php if ($get->approval === 1 || $get->approval === '1' ) { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                                                <a onclick="aproval('general','<?=$get->id_general ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                                                <a onclick="aproval('general','<?=$get->id_general ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type of Duty' : 'Jenis Dinas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date of Duty' : 'Tanggal Dinas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Overtime' : 'Lembur' ?></b></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_overtime">
                    <table id="tbl_overtime" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Times Range' : 'Jangka Waktu' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="250">
                            <col width="250">
                            <col width="100">
                            <col width="50">
                        </thead>
                        <tbody>
                            <?php foreach ($get_overtime as $get) { ?>
                                <?php 
                                    $sdate = date_create($get->timestamp);
                                    $sdate = date_format($sdate , "d M Y");

                                    $date  = date_create($get->date_overtime);
                                    $date  = date_format($date , "d M Y");
                                    // $time  = explode(":",$get->time_total);
                                ?>
                                <tr>
                                    <td><?=$sdate ?></td>
                                    <td><b class="text-maroon"><?=$get->nama ?></b></td>
                                    <td><?=$date ?> <b class="text-maroon">(<?=$get->time_start ?> - <?=$get->time_end ?>)</b><b class="pull-right"></b><small class="label pull-right bg-purple"><?=$get->time_total ?> Hours</small></td>
                                    <td>
                                        
                                        <span class="pull-right-container">
                                            <?php if ($get->status === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->status === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                                            <a onclick="overtime_details('<?=$get->id_overtime ?>'); " class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                                        </span>
                                        <?php if ($get->status === 1 || $get->status === '1' ) { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                                                <a onclick="aproval('overtime','<?=$get->id_overtime ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                                                <a onclick="aproval('overtime','<?=$get->id_overtime ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Times Range' : 'Jangka Waktu' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Leave' : 'Cuti' ?></b></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_leave">
                    <table id="tbl_leave" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type of leave' : 'Jenis Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date of leave' : 'Tanggal Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="150">
                            <col width="120">
                            <col width="200">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                        </thead>
                        <tbody>
                            <?php foreach ($get_cuti as $get) { ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $date  = date_create($get->tgl_cuti);
                                            $date  = date_format($date , "d M Y");
                                        ?>
                                        <?=$date ?>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama_user ?></b></td>
                                    <td>
                                        <?php 
                                            foreach ($type_leave as $types) { 
                                                if ($types->id_jen_cuti === $get->tipe_cuti) {
                                                    $cuti = $types->nama_jen_cut;
                                                }
                                            }
                                        ?>
                                        <b class="text-green"><?=$cuti ?></b>
                                    </td>
                                    <td>
                                        <?php 
                                            $start  = date_create($get->start_date);
                                            $end    = date_create($get->end_date);
                                            $ndate  = date_format($start , "d M Y") . ' - ' .  date_format($end , "d M Y");
                                        ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$ndate ?>">
                                            <?=$ndate ?> ( <b class="text-maroon"><?=$get->lama_hari ?> <?php echo $this->session->bahasa === 'EN' ? 'Day' : 'Hari' ?> </b>)
                                        </span>
                                    </td>
                                    <td><?=$get->nama_plt ?></td>
                                    <td>
                                        
                                        <span class="pull-right-container">
                                            <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    </a>
                                    <td>
                                        <?php if($get->lampiran != null || $get->lampiran != '') { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Attachment File' : 'Lihat Lampiran' ?>">
                                                <a onclick="view_attch('leave','<?=$get->id_cuti ?>');" class="btn btn-xs btn-info"><i class="mdi mdi-attach-file"></i></a>
                                            </span>
                                        <?php } ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                                            <a onclick="leave_details('<?=$get->id_cuti ?>');" class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                                        </span>
                                        <?php if ($get->approval === 1 || $get->approval === '1' ) { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                                                <a onclick="aproval('leave','<?=$get->id_cuti ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                                                <a onclick="aproval('leave','<?=$get->id_cuti ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type of leave' : 'Jenis Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date of leave' : 'Tanggal Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leave Modal -->
<div id="view_leave" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Leave Submission' : 'Pengajuan Cuti' ?> </b></h3>
                <h4 class="modal-title text-center">ID : <b class="text-maroon" id="id_leave"></b></h4>
            </div>
            <div class="modal-body">
                <form id="leave_form" enctype="multipart/form-data" class="form-horizontal">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_cuti" name="id_cuti" value="">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></label>
                            <div class="input-group date col-sm-9">
                                <input id="sub_date" type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date_edit" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Submission Date' : 'Masukan Tanggal Pengajuan' ?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg_edit" value="<?=$id_peg ?>" readonly required>
                                <input id="username" type="text" name="leave_name_peg_edit" class="form-control" value="<?=$name ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Fill with your Full Name' : 'Isi Dengan Nama Lengkap Anda' ?>" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Leave' : 'Jenis Cuti' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="sub_type_edit" id="sub_type_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-library-books mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jarak Tanggal' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range_edit" id="data_range_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Perhitungan Hari' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day_edit" value="" id="count_day_edit_leave" placeholder="Count of Leave Day" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark">PLT</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="plt_edit_leave" value="" id="plt_edit_leave" placeholder="Count of Leave Day" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-face mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave Information' : 'Informasi Cuti' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement_edit" value="" rows="5" id="statement_edit" placeholder="Fill your leave statement" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                    
                <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
            </div>
            
        </div>
    </div>
</div>
 
<!-- Overtime Modal -->
<div id="view_overtime" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Pengajuan Lembur' ?>Overtime Submission </b></h3>
                <h4 class="modal-title text-center">ID : <b class="text-maroon" id="id_overtime"></b></h4>
            </div>
            <form id="overtime_form" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_overtime" name="id_overtime" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg_edit" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="overtime_name_peg_edit" value="<?=$name ?>" placeholder="Fill with your Full Name" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Date overtime' : 'Tanggal Lembur' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="datepicker_edit" name="date_overtime_edit" placeholder="Overtime Date" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'From' : 'Mulai Dari' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker_edit" name="from_time_edit" placeholder="Set Start Time" id="from_time_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'To' : 'Sampai' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker_edit" name="to_time_edit" placeholder="Set End Time" id="to_time_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Time Calculation' : 'Perhitungan Waktu' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="count_time_edit" value="" id="count_time_edit" required>
                                <input type="text" class="form-control" value="" id="count_times_edit" placeholder="Total Hours" readonly readonly>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Overtime Information' : 'Informasi Lembur' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="desc_edit" value="" rows="5" id="desc_edit" placeholder="Fill your Overtime statement" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- General Modal -->
<div id="view_general" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'General Duty Submission' : 'Pengajuan Dinas Umum' ?> </b></h3>
                <h4 class="modal-title text-center">ID : <b class="text-maroon" id="id_general"></b></h4>
            </div>
            <form id="general_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_general_edit" name="id_general_edit" value="">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date" placeholder="Submission Date" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="general_name_peg" value="<?=$name ?>" placeholder="Fill with your Full Name" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="tod" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Duty' : 'Jenis Tugas' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="tod_edit" name="tod_edit" class="form-control select2" style="width: 100%;" onchange="show_others_edit()" readonly>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your type of duty' : 'Pilih Jenis Tugas'?></b></option>
                                    <?php 
                                        foreach ($type_general as $types) { 
                                            if ($this->session->bahasa === 'ID') { ?>
                                                    <option value="<?= $types->id_duty_type ?>" ><?= $types->name_duty_type_id ?></option>                                    
                                    <?php  } else { ?>
                                                <option value="<?= $types->id_duty_type ?>"><?= $types->name_duty_type_en ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="others_edit">
                            <label for="supervisor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Others Duty Type' : 'Jenis Tugas Lainnya' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="others_val_edit" name="others_edit"  placeholder="Fill Others Duty Type" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="supervisor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Institution Name' : 'Nama Institusi' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="inti_name_edit" id="insti_name_edit" placeholder="Fill with the Institution name or project" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-business mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range_edit" id="data_range_edit_general" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Perhitungan Tanggal' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day_edit" value="" id="count_day_edit_general" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Count of Leave Day' : 'Perhitungan Total Hari'?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-poll mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark">PLT</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="plt_edit_general" value="" id="plt_edit_general" placeholder="Count of Leave Day" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-face mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12"> 
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Duty Information' : 'Informasi Dinas' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement_edit" value="" rows="5" id="statement_edit_general" placeholder="Fill your Duty information" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Locations' : 'Lokasi' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="location_edit" rows="5" id="location_edit" placeholder="Fill your duty's location" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-add-location mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Research Modal -->
<div id="view_research" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Research Leave Submission' : 'Pengajuan Dinas Riset' ?> </b></h3>
                <h4 class="modal-title text-center">ID : <b class="text-maroon" id="id_research"></b></h4>
            </div>
            <form id="research_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_research_edit" name="id_research_edit">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date" placeholder="Submission Date" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="div_name">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="research_name_peg" value="<?=$name ?>" placeholder="Fill with your Full Name" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="position" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Positions In The Project' : 'Posisi dalam Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="position" placeholder="Fill with your staff Positions In The Project" id="position_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-card-membership mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="picopi" class="col-sm-3 control-label text-dark">PI/Co PI</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="picopi" placeholder="Fill with your staff Positions In The Project" id="picopi_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-class mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sponsor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Sponsorship' : 'Sponsor' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="sponsor" placeholder="Fill with your sponsorship" id="sponsor_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-redeem mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="p_name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Project Title' : 'Judul Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="p_name" placeholder="Fill the name of your project" id="p_name_edit" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-stars mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="toa" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="toa_edit" name="toa" class="form-control select2" style="width: 100%;" onchange="show_others_research()" readonly>
                                    <option value="" selected="selected" disabled><b>Choose your type of Duty</b></option>
                                    <?php 
                                        foreach ($type_research as $types) { 
                                            if ($this->session->bahasa === 'ID') { ?>
                                                    <option value="<?= $types->id_type_research ?>" ><?= $types->type_research_id ?></option>                                    
                                    <?php  } else { ?>
                                                <option value="<?= $types->id_type_research ?>"><?= $types->type_research_en ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="others_oat_edit">
                            <label for="oat" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Others Activity Type' : 'Jenis Aktifitas Lainnya' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="oat_edit" name="oat"  placeholder="Fill Others Duty Type" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="tod" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Source Of Funds' : 'Sumber Dana' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="sof_edit" name="sof" class="form-control select2" style="width: 100%;" onchange="show_others_funds_edit()" readonly>
                                    <option value="" selected="selected" disabled><b>Choose your type of Duty</b></option>
                                    <option value="SEAMEO - RECFON">SEAMEO - RECFON</option>
                                    <option value="SPONSORSHIP">SPONSORSHIP</option>
                                    <option value="3"><?php echo $this->session->bahasa === 'ID' ? 'Lain - Lain' : 'Others'; ?></option>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-attach-money mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="others_funds_edit">
                            <label for="supervisor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Others Source Of Funds' : 'Sumber Dana Lainnya' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="osof_edit" name="osof"  placeholder="Fill Others Source Of Funds" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-attach-money mdi-lg text-teal"></i></span>
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range" id="data_range_research" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Perhitungan Hari' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day" value="" id="count_day_research" placeholder="Count of Leave Day" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-poll mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="plt" class="col-sm-3 control-label text-dark">PLT</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="" value="" id="plt_research" placeholder="" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-face mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Date Of MoU' : 'Tanggal MoU' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="date_mou_edit" name="date_mou" placeholder="Date of Mou" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Research Proposal' : 'Proposal Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="proposal_edit" name="proposal" placeholder="Date Of Research Proposal" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-search mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Budget Proposal' : 'Proposal Anggaran' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="budget_edit" name="budget" placeholder="Date Of Budget Proposal" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-credit-card mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label">Ethics Approval</label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="e_approval_edit" name="e_approval" placeholder="Date Of Ethics Approval" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-group-work mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Copy of 1st Installment' : 'Copy of 1st Installment' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="installment_edit" name="installment" placeholder="Date Of Copy of 1st Installment" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-receipt mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Official Research Permission Letter' : 'Tanggal Surat Izin Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="date_permission_edit" name="date_permission" placeholder="Date of Official Research Permission Letter" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-vpn-lock mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Locations' : 'Lokasi' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="location" value="" rows="5" id="location_research" placeholder="Fill your duty's location" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-add-location mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Research Information' : 'Informasi Riset' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement" value="" rows="5" id="statement_research" placeholder="Fill with your research information" readonly></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Attachment Modal -->
<div id="attachment_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Attachment' : 'Lampiran' ?></b> <?php echo $this->session->bahasa === 'EN' ? 'Viewer' : '' ?></h2>
            </div>
            <form id="leave_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="embed">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url('/assets/js/settings/sidenav.js'); ?>"></script>
<script>

    $(function () {
        if(screen.width <= 760) {
            $('#style').removeClass('row');
        }

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()

        $('#tbl_general').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'responsive'  : true
        })
        $('#tbl_research').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'responsive'  : true
        })
        $('#tbl_overtime').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'responsive'  : true
        })
        $('#tbl_leave').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'responsive'  : true
        })

        $('#view_leave').on('hidden.bs.modal', function () {
            $('#leave_form')[0].reset();
        });
        $('#view_overtime').on('hidden.bs.modal', function () {
            $('#overtime_form')[0].reset();
        });
        $('#view_general').on('hidden.bs.modal', function () {
            $('#general_form')[0].reset();
        });
        $('#view_research').on('hidden.bs.modal', function () {
            $('#research_form')[0].reset();
        });
    })

    function show_others_edit() {
        var id = $('#tod_edit').val();
        if (id === 8 || id === '8') {
            $('#others_edit').show();
        } else {
            $('#others_val_edit').val('');
            $('#others_edit').hide();
        }
    }

    function show_others_research() {
        var id = $('#toa_edit').val();
        if (id === 3 || id === '3') {
            $('#others_oat_edit').show();
        } else {
            $('#oat_edit').val('');
            $('#others_oat_edit').hide();
        }
    }

    function show_others_funds_edit() {
        var id = $('#sof_edit').val();
        if (id === 3 || id === '3') {
            $('#others_funds_edit').show();
        } else {
            $('#osof_edit').val('');
            $('#others_funds_edit').hide();
        }
    }

    function time_edit_change() {
        var timea   = $('#from_time_edit').val();
        var timeb   = $('#to_time_edit').val();
        var resa    = timea.split(':');
        var resb    = timeb.split(':');

        var start   = new Date();
        start.setHours(resa[0]);
        start.setMinutes(resa[1]);

        var end     = new Date();
        end.setHours(resb[0]);
        end.setMinutes(resb[1]);

        var t_start = start.getTime();
        var t_end   = end.getTime();

        var res     = moment(end,"DD/MM/YYYY HH:mm:ss").diff(moment(start,"DD/MM/YYYY HH:mm:ss"));  
        var f_res   = moment.duration(res);
        var H       = isNaN(Math.floor(f_res.asHours())) ? 0 : Math.floor(f_res.asHours());
        var M       = Math.floor(f_res.minutes());
 
        if (H < 0) {
            $('#count_time_edit').val(0);
            $('#count_times_edit').val(H+' Hours, '+M+ ' Minutes');
        } else {
            $('#count_time_edit').val(H+':'+M);
            $('#count_times_edit').val(H+' Hours, '+M+ ' Minutes');
        }
    }

    function tb_reload (token, tb) {
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/tables/'+tb+'/',  
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            }
        }).done(function (res) {
            switch (tb) {
                case 'tb_ap_research':
                    $("#tb_content_research").html(res);
                    break;
                case 'tb_ap_general':
                    $("#tb_content_general").html(res);
                    break;
                case 'tb_ap_overtime':
                    $("#tb_content_overtime").html(res);
                    break;
                case 'tb_ap_leave':
                    $("#tb_content_leave").html(res);
                    break;
            }
        }).fail(function (err)  {
            toast(2 , "Error :", "Sorry, The data table cannot be show!");
        });
    }

    function view_attch(req, id) {
        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/'+req+'/attachment_viewer', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);

                if (data.code === true) {
                    $('#embed').html('<object id="attach_file_viewer" data="'+data.pdf+'" type="application/pdf" width="100%" height="780"></object>')
                    $('#attachment_modal').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function general_details(id) {
        var token = '<?php echo $this->session->token; ?>';
        $('#id_general_edit').val(id);

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/general/edit', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                var get  = data.get[0];

                // alert(JSON.stringify(get));

                if (data.code === true) {

                    $('#tod_edit').val(get.id_duty_type).trigger('change');;
                    $('#plt_edit_general').val(get.nama_plt).trigger('change');;
                    $('#statement_edit_general').val(get.ket);
                    $('#location_edit').val(get.lokasi);
                    $('#others_val_edit').val(get.others_duty_type);
                    $('#insti_name_edit').val(get.instansi);
                    $('#data_range_edit_general').val(moment(get.start_date).format('MM/DD/YYYY') + ' - ' + moment(get.end_date).format('MM/DD/YYYY'));
                    $('#count_day_edit_general').val(get.lama_hari);
                    $('#id_general').text(get.id_general);

                    $('#view_general').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function leave_details(id) {
        var token = '<?php echo $this->session->token; ?>';
        $('#id_cuti').val(id);

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/leave/edit', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                var get  = data.get[0];

                // alert(JSON.stringify(get));

                if (data.code === true) {
                    var lang = "<?php echo $this->session->bahasa === 'EN' ? 'EN' : 'ID' ?>";
                    var type = lang === 'EN' ? get.nama_jen_cut_en : get.nama_jen_cut;
                    $('#sub_type_edit').val(type).trigger('change');;
                    $('#plt_edit_leave').val(get.nama_plt).trigger('change');;
                    $('#statement_edit').val(get.ket);
                    $('#id_leave').text(get.id_cuti);
                    $('#data_range_edit').val(moment(get.start_date).format('MM/DD/YYYY') + ' - ' + moment(get.end_date).format('MM/DD/YYYY'));

                    var date = $('#data_range_edit').val();
                    var res = date.split("-");
                    var a = moment(res[0], 'MM/DD/YYYY');
                    var b = moment(res[1], 'MM/DD/YYYY');
                    var days = b.diff(a, 'days');

                    if (days === 0) {
                        $('#count_day_edit_leave').val(1);
                    } else {
                        $('#count_day_edit_leave').val(days + 1);
                    }

                    $('#view_leave').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function overtime_details(id) {
        var token = '<?php echo $this->session->token; ?>';
        $('#id_overtime').val(id);

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/overtime/edit', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                var get  = data.get[0];

                if (data.code === true) {
                    $('#from_time_edit').val(get.time_start);
                    $('#to_time_edit').val(get.time_end);
                    $('#datepicker_edit').val(get.date_overtime);
                    $('#desc_edit').val(get.desc);
                    $('#id_overtime').text(get.id_overtime);

                    time_edit_change();

                    $('#view_overtime').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function research_details(id) {
        var token = '<?php echo $this->session->token; ?>';
        $('#id_research_edit').val(id);

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/research/edit', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                var get  = data.get[0];

                // alert(JSON.stringify(get));

                if (data.code === true) {
                    var dana = get.sumber_dana === 'SEAMEO - RECFON' || get.sumber_dana === 'SPONSORSHIP' ? get.sumber_dana : '3';

                    $('#id_research').text(get.id_research);
                    $('#toa_edit').val(get.jenis_keg).trigger('change');
                    $('#plt_research').val(get.nama_plt);
                    $('#sof_edit').val(dana).trigger('change');
                    $('#statement_research').val(get.ket);
                    $('#location_research').val(get.lokasi);
                    $('#position_edit').val(get.jabatan);
                    $('#picopi_edit').val(get.picopi);
                    $('#p_name_edit').val(get.nama_research);
                    $('#sponsor_edit').val(get.sponsor);
                    $('#date_mou_edit').val(get.tgl_mou);
                    $('#proposal_edit').val(get.tgl_research);
                    $('#installment_edit').val(get.tgl_installment);
                    $('#e_approval_edit').val(get.tgl_ethic);
                    $('#budget_edit').val(get.tgl_buget);
                    $('#count_day_research').val(get.lama_hari);
                    $('#date_permission_edit').val(get.tgl_izin_riset);
                    $('#data_range_research').val(moment(get.start_date).format('MM/DD/YYYY') + ' - ' + moment(get.end_date).format('MM/DD/YYYY'));

                    $('#view_research').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function aproval(req, id, act) {
        var token   = '<?php echo $this->session->token; ?>';
        var title   = act === '2' ? '<?php echo $this->session->bahasa === 'EN' ? 'Approval Confirmation' : 'Konfirmasi Persetujuan'?>' : '<?php echo $this->session->bahasa === 'EN' ? 'Reject Confirmation' : 'Konfirmasi Tidak Menyetujui'?>';
        var content = act === '2' ? '<?php echo $this->session->bahasa === 'EN' ? '<b class="text-red">Are your sure to approve this submission ? </b><br><br><b>Note :</b> The data cannot be changed.' : '<b class="text-red">Apakah Anda yakin untuk menyetujui pengajuan permohonan ini ? </b><br><br><b>Catatan :</b> Data tidak dapat di rubah.'?>' : '<?php echo $this->session->bahasa === 'EN' ? '<b class="text-red">Are your sure to reject this submission ? </b><br><br><b>Note :</b> The data cannot be changed.' : '<b class="text-red">Apakah Anda yakin untuk menolak pengajuan permohonan ini ? </b><br><br><b>Catatan :</b> Data tidak dapat di rubah.'?>';
        var color   = act === '0' ? 'red' : 'orange';
        var tb      = 'tb_ap_'+req;

        $.confirm({
            theme: 'material',
            title: title,
            content: content,
            type: color,
            icon: 'mdi mdi-warning mdi-lg',
            typeAnimated: true,
            draggable: true,
            autoClose: 'No|9000',
            buttons: {
                delete: {
                    btnClass: 'btn-info',
                    text: 'Yes',
                    action: function () {
                        $.ajax({
                            type : 'POST', 
                            url  : base_url() + '/crud/'+req+'/aproval/'+act+'/'+id, 
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader ("Authorization", token);
                            },
                            success: function(data){
                                var data = JSON.parse(data);
                                
                                if (data.code === true) {
                                    
                                    var msg     = '<?php echo $this->session->bahasa === 'EN' ? '<b>The Data has been saved.</b>' : '<b>Data berhasil di simpan.</b>'?>';
                                    toast('1','Success', msg);
                                    tb_reload(token, tb);
                                    socket.emit('notif', { notif: 1});

                                    if (req != 'overtime') {
                                        // Send mail to peg
                                        $.ajax({
                                            type: "POST",
                                            url: base_url() + '/crud/'+req+'/mail/approval/' + data.id + '/1',
                                            beforeSend: function (xhr) {
                                                xhr.setRequestHeader ("Authorization", token);
                                            }
                                        }).done(function (res) {
                                            var ress = JSON.parse(res);
                                            // toast(1 , "Mail Success :", ress.code);
                                            if (ress.code === true) {
                                                toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? 'Email was sent!' : 'Email Terkirim!'?>");
                                            } else {
                                                toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? 'Email not sent!' : 'Email Tidak Terkirim!'?>");
                                            }
                                        }).fail(function (err)  {
                                            toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending notification!' : 'Tidak dapat mengirim Notifikasi!'?>");
                                        });
                                        
                                        // Send mail to PLT
                                        $.ajax({
                                            type: "POST",
                                            url: base_url() + '/crud/'+req+'/mail/approval/' + data.id + '/0',
                                            beforeSend: function (xhr) {
                                                xhr.setRequestHeader ("Authorization", token);
                                            }
                                        }).done(function (res) {
                                            var ress = JSON.parse(res);
                                            if (ress.code === true) {
                                                toast(1 , "Mail Success :", "Email was sended to PLT!");
                                            } else {
                                                toast(2 , "Warning :", "Email not send to PLT!");
                                            }
                                        }).fail(function (err)  {
                                            toast(0 , "Error :", "Cannot sending mail notification!");
                                        });
                                    }
                                } else {
                                    toast('2','Warning', '<b>'+data.error+'</b>');
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                toast(0 , "Error :", errorThrown);
                            }
                        });
                    }
                },
                No: {
                    btnClass: 'btn-default',
                    text: 'No',
                }
            }
        });
    }
   
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>
