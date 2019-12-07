<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Leave' : 'Cuti' ?></b> Application</h3>
            </div>
            <div class="box-body">
                <div class="col-sm-2">
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Add Leave Submission' : 'Tambah Pengajuan Cuti' ?>">
                        <a data-toggle="modal" data-target="#submission_modal" class="btn btn-block btn-success"><i class="mdi mdi-assignment mdi-lg"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Submission' : 'Pengajuan' ?></b></a><br>
                    </span>
                </div>
                <div class="col-sm-12" id="tb_content">
                    <table id="tbl_leave" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type of leave' : 'Jenis Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date of leave' : 'Tanggal Cuti' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Approver' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="150">
                            <col width="120">
                            <col width="200">
                            <col width="100">
                            <col width="200">
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
                                            foreach ($type as $types) { 
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
                                        <b class="text-maroon"><?=$get->nama_supervisor ?></b>
                                        <span class="pull-right-container">
                                            <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu Persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = $this->session->bahasa === 'EN' ? 'Approved' : 'Diizinkan'; $color = 'bg-green'; } else { $status = $this->session->bahasa === 'EN' ? 'Not Approved' : 'Tidak Diizinkan'; $color = 'bg-red'; } ?>
                                            <small class="label pull-right <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Print Submission' : 'Cetak Pengajuan' ?>">
                                            <a href="<?php $url = 'pdf_gen/report/leave/'.$get->id_cuti.'/'; echo base_url($url.$this->session->token)?>" target="_blank" class="btn btn-xs btn-info"><i class="mdi mdi-print"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Attachment File' : 'Lihat Lampiran' ?>">
                                            <a onclick="view_attch('<?=$get->id_cuti ?>');" class="btn btn-xs btn-success"><i class="mdi mdi-attach-file"></i></a>
                                        </span>
                                        <?php if ($get->approval === '1') { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Edit Data' : 'Ubah Data' ?>">
                                                <a onclick="edit('<?=$get->id_cuti ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Delete Data' : 'Hapus Data' ?>">
                                                <a onclick="del('<?=$get->id_cuti ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </span>
                                        <?php } else {  ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Details' : 'Lihat Detail' ?>">
                                                <a onclick="view('<?=$get->id_cuti ?>'); " class="btn btn-xs btn-warning"><i class="mdi mdi-visibility"></i></a>
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
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Approver' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="submission_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Leave Submission' : 'Pengajuan Cuti'?></b></h2>
            </div>
            <form id="leave_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan'?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Submission Date' : 'Masukan Tanggal Pengajuan'?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap'?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="leave_name_peg" value="<?=$name ?>" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Input your Full Name' : 'Masukan Nama Lengkap Anda'; ?>" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                            <div class="form-group col-sm-12">
                                <label for="supervisor" class="col-sm-3 control-label text-dark">Approver</label>
                                <div class="input-group col-sm-9">
                                    <input type="hidden" name="approver" value="<?=$approver ?>" readonly required>
                                    <input type="text" class="form-control" name="name" value="<?=$supervisor ?>" placeholder="Fill with your Full Name" disabled required>
                                    <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="sub_type" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Leave' : 'Jenis Cuti'?></label>
                            <div class="input-group col-sm-9">
                                <select id="sub_type" name="sub_type" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose your type of leave' : 'Pilih Jenis Cuti'?></option>
                                    <?php 
                                        foreach ($type as $types) { 
                                            if ($jekel === 'Male') {
                                                if ($types->id_jen_cuti !== '3' && $types->id_jen_cuti !== '4' ) { ?>
                                                    <option value="<?= $types->id_jen_cuti ?>"><?= $types->nama_jen_cut ?></option>                                    
                                    <?php  } } else { ?>
                                                <option value="<?= $types->id_jen_cuti ?>"><?= $types->nama_jen_cut ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-library-books mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="attachment" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Attachment' : 'Lampiran'?></label>
                            <div class="input-group input-file col-sm-9">
                                <input type="file" class="form-control" id="attachment" name="files_cuti" placeholder="Upload your atttachment">
                                <span class="input-group-addon"><i class="mdi mdi-attachment mdi-lg text-teal"></i></span>
                            </div>
                            <p class="col-sm-3"></p>
                            <p class="col-sm-9 text-dark"><?php echo $this->session->bahasa === 'EN' ? '<b>Note : </b>Allowed files format are PDF (.pdf) with max size of 20 MB.' : '<b>Catatan : </b>Hanya mengizinkan file format PDF (.pdf) dengan maksimal ukuran 20 MB.'?></p>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu'?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range" id="data_range" required>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Total Hari'?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day" value="" id="count_day" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Count of Leave Day' : 'Perhitungan Total Hari'?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                            <div class="form-group col-sm-12">
                                <label for="plt" class="col-sm-3 control-label text-dark">PLT</label>
                                <div class="input-group col-sm-9">
                                    <select id="plt" name="plt" class="form-control select2" style="width: 100%;"  required>
                                        <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your delegation' : 'Pilih delegasi Anda'?></b></option>
                                        <?php foreach ($plts as $plt) { 
                                            if( $plt->id_peg != $id_peg && $plt->id_akses != '1' && $plt->id_akses != '2') { ?>
                                            <option value="<?= $plt->id_peg ?>"><?=$plt->nama ?> - <?=$plt->nama_unit ?></option>
                                        <?php } }?>
                                    </select>
                                    <span class="input-group-addon"><i class="mdi mdi-face mdi-lg text-teal"></i></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave Information' : 'Informasi Cuti'?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement" value="" rows="5" id="statement" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your leave statement' : 'Masukan Pernyataan/Informasi Cuti'?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save' : 'Simpan'?></b></button>
                    <a type="button" class="btn btn-default" onclick="hide();"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup'?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="edit_submission_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Leave Submission Form <b class="text-dark">Edit</b>' : '<b class="text-dark">Ubah</b> Pengajuan Lembur'?> </b> </h3>
            </div>
            <form id="leave_form_edit" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_cuti" name="id_cuti" value="">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan'?></label>
                            <div class="input-group date col-sm-9">
                                <input id="sub_date" type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date_edit" placeholder="Submission Date" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap'?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg_edit" value="<?=$id_peg ?>" readonly required>
                                <input id="username" type="text" name="leave_name_peg_edit" class="form-control" value="<?=$name ?>" placeholder="Fill with your Full Name" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                            <div class="form-group col-sm-12">
                                <label for="supervisor" class="col-sm-3 control-label text-dark">Approver</label>
                                <div class="input-group col-sm-9">
                                    <input id="approver_id" type="hidden" name="approver_edit" value="<?=$approver ?>" readonly required>
                                    <input id="approver_name" type="text" class="form-control" name="name_edit" value="<?=$supervisor ?>" placeholder="Fill with your Full Name" disabled required>
                                    <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="sub_type" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Leave' : 'Jenis Cuti'?></label>
                            <div class="input-group col-sm-9">
                                <select id="sub_type_edit" name="sub_type_edit" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose your type of leave' : 'Pilih Jenis Cuti'?></option>
                                    <?php 
                                        foreach ($type as $types) { 
                                            if ($jekel === 'Male') {
                                                if ($types->id_jen_cuti !== '3' && $types->id_jen_cuti !== '4' ) { ?>
                                                    <option value="<?= $types->id_jen_cuti ?>"><?= $types->nama_jen_cut ?></option>                                    
                                    <?php  } } else { ?>
                                                <option value="<?= $types->id_jen_cuti ?>"><?= $types->nama_jen_cut ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-library-books mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                       
                        <div class="form-group col-sm-12" id="attch">
                            <label for="attachment" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Attachment' : 'Lampiran'?></label>
                            <div class="input-group input-file col-sm-9">
                                <input type="file" class="form-control" id="attachment" name="files_cuti_edit" placeholder="Upload your atttachment">
                                <span class="input-group-addon"><i class="mdi mdi-attachment mdi-lg text-teal"></i></span>
                            </div>
                            <p class="col-sm-3"></p>
                            <p class="col-sm-9 text-dark"><?php echo $this->session->bahasa === 'EN' ? '<b>Note : </b>Allowed files format are PDF (.pdf) with max size of 20 MB.' : '<b>Catatan : </b>Hanya mengizinkan file format PDF (.pdf) dengan maksimal ukuran 20 MB.'?></p>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu'?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range_edit" id="data_range_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div> 
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Total Hari'?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day_edit" value="" id="count_day_edit" placeholder="Count of Leave Day" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                        <div class="form-group col-sm-12">
                            <label for="plt" class="col-sm-3 control-label text-dark">PLT</label>
                            <div class="input-group col-sm-9">
                                <select id="plt_edit" name="plt_edit" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your delegation' : 'Pilih delegasi Anda'?></b></option>
                                    <?php foreach ($plts as $plt) { 
                                        if( $plt->id_peg != $id_peg ) { ?>
                                        <option value="<?= $plt->id_peg ?>"><?=$plt->nama ?> - <?=$plt->nama_unit ?></option>
                                    <?php } }?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-face mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave Information' : 'Informasi Cuti'?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement_edit" value="" rows="5" id="statement_edit" placeholder="Fill your leave statement" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                    
                    <button id="btn_edit" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save Changes' : 'Ubah'?></b></button>                    
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup'?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="attachment_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-center"><?php echo $this->session->bahasa === 'EN' ? '<b class="text-maroon ">Attachment</b> Viewer' : 'Lihat <b class="text-maroon ">Lampiran</b>'?></h2>
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
    $(document).ready(function () {
        $("#date_range").datepicker();
    });

    $(function () {
        if(screen.width <= 760) {
            $('#style').removeClass('row');
        }

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()

        $('#submission_modal').on('hidden.bs.modal', function () {
            hide();
        });

        $('#edit_submission_modal').on('hidden.bs.modal', function () {
            $('#sub_type_edit').val('').trigger('change');
            $('#plt_edit').val('').trigger('change');
            $('#leave_form_edit')[0].reset();
        });
        
        // Select Input
        $('.select2').select2();

        // Datatable 
        $('#tbl_leave').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'responsive'  : true
        })

        //Date range picker
        $('#data_range').daterangepicker({
            // isInvalidDate: function(date) {
            //     return (date.day() == 0 || date.day() == 6);
            // }
        });
        $('#data_range_edit').daterangepicker({
            // isInvalidDate: function(date) {
            //     return (date.day() == 0 || date.day() == 6);
            // }
        })

        //Date picker
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    function tb_reload (token) {
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/tables/tb_leave/',  
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            }
        }).done(function (res) {
            $("#tb_content").html(res);
        }).fail(function (err)  {
            toast(2 , "Error :", "Sorry, The data table cannot be show!");
        });
    }
   
    function hide() {
        $('#submission_modal').modal('hide');
        $('#sub_type').val('').trigger('change');
        $('#plt').val('').trigger('change');
        $('#leave_form')[0].reset();
    }

    $('#data_range').change(function(){ 
        
        var date = $('#data_range').val();
        var res = date.split("-");
        var a = moment(res[0], 'MM/DD/YYYY');
        var b = moment(res[1], 'MM/DD/YYYY');
        var days = b.diff(a, 'days');

        if (days === 0) {
            $('#count_day').val(1);
        } else {
            $('#count_day').val(days + 1);
        }
        
    });

    $('#data_range_edit').change(function(){
        var date = $('#data_range_edit').val();
        var res = date.split("-");
        var a = moment(res[0], 'MM/DD/YYYY');
        var b = moment(res[1], 'MM/DD/YYYY');
        var days = b.diff(a, 'days');

        if (days === 0) {
            $('#count_day_edit').val(1);
        } else {
            $('#count_day_edit').val(days + 1);
        }
        
    });

    function del(id) {
        $.confirm({
            theme: 'material',
            title: '<?php echo $this->session->bahasa === 'EN' ? 'Delete Data' : 'Hapus Data' ?>',
            content: '<?php echo $this->session->bahasa === 'EN' ? '<b class="text-red">Are your sure to delete this data ? </b><br><br><b>Note :</b> Data will be delete permanently. So make sure again if you want to delete it.' : '<b class="text-red">Apakah Anda yakin ingin menghapus data ini ? </b><br><br><b>Catatan :</b> Data yang di hapus tidak dapat kembali. Pastikan kembali data yang ingin di hapus.' ?>',
            type: 'red',
            icon: 'mdi mdi-warning mdi-lg',
            typeAnimated: true,
            draggable: true,
            autoClose: 'No|9000',
            buttons: {
                delete: {
                    btnClass: 'btn-red',
                    text: '<?php echo $this->session->bahasa === 'EN' ? '<b>Yes</b>' : '<b>Iya</b>' ?>',
                    action: function () {
                        var token = $('#token').val();

                        $.ajax({
                            type : 'POST', 
                            url  : base_url() + '/crud/leave/delete', 
                            data : { 'id' : id},
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader ("Authorization", token);
                            },
                            success: function(data){
                                var data = JSON.parse(data);
                                socket.emit('notif', { notif: 1});

                                if (data.code === true) {
                                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been deleted!" : "Data telah di hapus!" ?>');
                                    tb_reload(token);
                                } else {
                                    toast('0','Error', data.error);
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
                    text: '<?php echo $this->session->bahasa === 'EN' ? '<b>Cencel</b>' : '<b>Batal</b>' ?>',
                }
            }
        });
    }

    $('#leave_form').submit(function(e) {
        e.preventDefault();
        
        var token = '<?php echo $this->session->token; ?>';

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/leave/insert_submission', 
            data : new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);

                if (data.code === true) { 
                    hide();                   
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been saved!" : "Data Anda telah tersimpan!"?>');
                    tb_reload (token);
                    socket.emit('notif', { notif: 1});

                    // Send mail to supervisor
                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/leave/mail/send/' + data.id_cuti + '/1',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", token);
                        }
                    }).done(function (res) {
                        var ress = JSON.parse(res);
                        // toast(1 , "Mail Success :", ress.code);
                        if (ress.code === true) {
                            toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? "Email submission was sent to supervisor!" : "Email pengajuan cuti telah terkirim ke supervisor!" ?>");
                        } else {
                            toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? "Email submission not sent to supervisor!" : "Gagal mengirim email pengajuan cuti data ke supervisor!" ?>");
                        }
                    }).fail(function (err)  {
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail submission notification!' : 'Tidak dapat mengirim email pemberitahuan pengajuan!' ?>");
                    });

                    // Send mail to PLT
                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/leave/mail/send/' + data.id_cuti + '/2',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", token);
                        }
                    }).done(function (res) {
                        var ress = JSON.parse(res);
                        // toast(1 , "Mail Success :", ress.code);
                        if (ress.code === true) {
                            toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? "Email was sent to PLT!" : "Email telah terkirim ke PLT!" ?>");
                        } else {
                            toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? "Email not sent to PLT!" : "Gagal mengirim email ke PLT!" ?>");
                        }
                    }).fail(function (err)  {
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail notification!' : 'Tidak dapat mengirim email pemberitahuan perubahan data!' ?>");
                    });
                } else {                   
                    toast('0','Error', data.error);
                    tb_reload(token);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    });

    $('#leave_form_edit').submit(function(e) {
        e.preventDefault();
        
        var token = '<?php echo $this->session->token; ?>';

        $.ajax({
            type : 'POST', 
            // enctype: 'multipart/form-data',
            url  : base_url() + '/crud/leave/update', 
            data : new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                socket.emit('notif', { notif: 1});

                if (data.code === true) {
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been changed!" : "Data Anda telah diubah!" ?>');
                    
                    $('#edit_submission_modal').modal('hide');
                    tb_reload(token);

                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/leave/mail/update/' + data.id_cuti + '/1',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "<?php echo $this->session->token; ?>");
                        }
                    }).done(function (res) {
                        var ress = JSON.parse(res);
                        // toast(1 , "Mail Success :", ress.code);
                        if (ress.code === true) {
                            toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? "Email update was sent to supervisor!" : "Email perubahan data telah terkirim ke supervisor!" ?>");
                        } else {
                            toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? "Email update not sent to supervisor!" : "Gagal mengirim email perubahan data ke supervisor!" ?>");
                        }
                    }).fail(function (err)  {
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail update notification!' : 'Tidak dapat mengirim email pemberitahuan perubahan data!' ?>");
                    });

                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/leave/mail/update/' + data.id_cuti + '/2',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "<?php echo $this->session->token; ?>");
                        }
                    }).done(function (res) {
                        var ress = JSON.parse(res);
                        // toast(1 , "Mail Success :", ress.code);
                        if (ress.code === true) {
                            toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? "Email update was sent to PLT!" : "Email perubahan data telah terkirim ke PLT!" ?>");
                        } else {
                            toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? "Email update not sent to PLT!" : "Gagal mengirim email perubahan data ke PLT!" ?>");
                        }
                    }).fail(function (err)  {
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail update notification!' : 'Tidak dapat mengirim email pemberitahuan perubahan data!' ?>");
                    });
                } else {
                    toast('0','Error', data.error);
                    tb_reload(token);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    });

    function edit(id) {
        var token = $('#token').val();
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
                    $('#sub_type_edit').val(get.tipe_cuti).trigger('change');;
                    $('#plt_edit').val(get.plt).trigger('change');;
                    $('#statement_edit').val(get.ket);
                    $('#data_range_edit').val(moment(get.start_date).format('MM/DD/YYYY') + ' - ' + moment(get.end_date).format('MM/DD/YYYY'));

                    var date = $('#data_range_edit').val();
                    var res = date.split("-");
                    var a = moment(res[0], 'MM/DD/YYYY');
                    var b = moment(res[1], 'MM/DD/YYYY');
                    var days = b.diff(a, 'days');

                    if (days === 0) {
                        $('#count_day_edit').val(1);
                    } else {
                        $('#count_day_edit').val(days + 1);
                    }

                    $('#sub_type_edit').prop("disabled", false);
                    $('#data_range_edit').prop("disabled", false);
                    $('#plt_edit').prop("disabled", false);
                    $('#statement_edit').prop("disabled", false);
                    $('#attch').show();
                    $('#btn_edit').show();

                    $('#edit_submission_modal').modal('show');
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function view(id) {
        var token = $('#token').val();
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
                    $('#sub_type_edit').val(get.tipe_cuti).trigger('change');
                    $('#plt_edit').val(get.plt).trigger('change');
                    $('#statement_edit').val(get.ket);
                    $('#data_range_edit').val(moment(get.start_date).format('MM/DD/YYYY') + ' - ' + moment(get.end_date).format('MM/DD/YYYY'));

                    var date = $('#data_range_edit').val();
                    var res = date.split("-");
                    var a = moment(res[0], 'MM/DD/YYYY');
                    var b = moment(res[1], 'MM/DD/YYYY');
                    var days = b.diff(a, 'days');

                    if (days === 0) {
                        $('#count_day_edit').val(1);
                    } else {
                        $('#count_day_edit').val(days + 1);
                    }
                   
                    $('#sub_type_edit').prop("disabled", true);
                    $('#data_range_edit').prop("disabled", true);
                    $('#plt_edit').prop("disabled", true);
                    $('#statement_edit').prop("disabled", true);
                    $('#attch').hide();
                    $('#btn_edit').hide();

                    $('#edit_submission_modal').modal('show');

                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    function view_attch(id) {
        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/leave/attachment_viewer', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);

                if (data.code === true) {
                    $('#embed').html('<object id="attach_file_viewer" data="'+data.pdf+'" type="application/pdf" width="100%" height="780"></object>')
                    $('#attachment_modal').modal('show');
                    // $('#attach_file_viewer').attr('data', data.pdf);
                } else {
                    toast('2','Warning', '<b>'+data.error+'</b>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }
   
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>
