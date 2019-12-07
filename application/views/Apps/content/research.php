<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Research Leave' : 'Cuti Riset' ?></b> Application</h3>
            </div>
            <div class="box-body">
                <div class="col-sm-2">
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Add Leave Submission' : 'Tambah Pengajuan Cuti' ?>">
                        <a data-toggle="modal" data-target="#submission_modal" class="btn btn-block btn-success"><i class="mdi mdi-assignment mdi-lg"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Submission' : 'Pengajuan' ?></b></a><br>
                    </span>
                </div>
                <div class="col-sm-12" id="tb_content">
                    <table id="tbl_research" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Date Of Research' : 'Tanggal Riset' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Penyetuju' ?></th>
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
                                        <b class="text-maroon"><?=$get->nama_spv ?></b>
                                        <span class="pull-right-container">
                                            <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label pull-right <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Print Submission' : 'Cetak Pengajuan' ?>">
                                            <a href="<?php $url = 'pdf_gen/report/research/'.$get->id_research.'/'; echo base_url($url.$this->session->token)?>" target="_blank" class="btn btn-xs btn-info"><i class="mdi mdi-print"></i></a>
                                        </span>
                                        <?php if ($get->approval === '1') { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Edit Data' : 'Ubah Data' ?>">
                                                <a onclick="edit('<?=$get->id_research ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Delete Data' : 'Hapus Data' ?>">
                                                <a onclick="del('<?=$get->id_research ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </span>
                                        <?php } else {  ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Details' : 'Lihat Detail' ?>">
                                                <a onclick="view('<?=$get->id_research ?>'); " class="btn btn-xs btn-warning"><i class="mdi mdi-visibility"></i></a>
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
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Penyetuju' ?></th>
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
                <h2 class="modal-title text-center">Form <b class="text-maroon "><?php echo $this->session->bahasa === 'EN' ? 'Research Leave Submission' : 'Pengajuan Cuti Riset'?></b> </h2>
            </div>
            <form id="research_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Submission Date' : 'Masukan Tanggal Pengajuan' ?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="div_name">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="research_name_peg" value="<?=$name ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Your Full Name' : 'Masukan Nama Lengkap Anda' ?>" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                        <div class="form-group col-sm-12" id="div_approver">
                            <label for="supervisor" class="col-sm-3 control-label text-dark">Approver</label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="approver" value="<?=$approver ?>" readonly required>
                                <input type="text" class="form-control" name="name" value="<?=$supervisor ?>" placeholder="Fill with your Full Name" disabled required>
                                <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="position" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Positions In The Project' : 'Posisi dalam Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="position" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Fill with your staff Positions In The Project' : 'Masukan Posisi/Jabatan Anda dalam Project tersebut' ?>" id="position" required>
                                <span class="input-group-addon"><i class="mdi mdi-card-membership mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="picopi" class="col-sm-3 control-label text-dark">PI/Co PI</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="picopi" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input PI/Co PI' : 'Masukan PI/Co PI' ?>" id="picopi" required>
                                <span class="input-group-addon"><i class="mdi mdi-class mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sponsor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Sponsorship' : 'Sponsor' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="sponsor" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your sponsorship' : 'Masukan Sponsor Anda' ?>" id="sponsor" required>
                                <span class="input-group-addon"><i class="mdi mdi-redeem mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="p_name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Project Title' : 'Judul Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="p_name" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input the name of your project' : 'Masukan Judul Project Anda' ?>" id="p_name" required>
                                <span class="input-group-addon"><i class="mdi mdi-stars mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="toa" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="toa" name="toa" class="form-control select2" style="width: 100%;" onchange="show_others()" required>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your type of Duty' : 'Pilih Jenis Aktifitas'?></b></option>
                                    <?php 
                                        foreach ($type as $types) { 
                                            if ($this->session->bahasa === 'ID') { ?>
                                                    <option value="<?= $types->id_type_research ?>" ><?= $types->type_research_id ?></option>                                    
                                    <?php  } else { ?>
                                                <option value="<?= $types->id_type_research ?>"><?= $types->type_research_en ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="others_oat">
                            <label for="oat" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Others Activity Type' : 'Jenis Aktifitas Lainnya' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="oat" name="oat"  placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Others Duty Type' : 'Masukan Jenis Aktifitas Lainnya' ?>">
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="tod" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Source Of Funds' : 'Sumber Dana' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="sof" name="sof" class="form-control select2" style="width: 100%;" onchange="show_others_funds()" required>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your Source Of Funds' : 'Pilih Sumber Dana' ?> </b></option>
                                    <option value="SEAMEO - RECFON">SEAMEO - RECFON</option>
                                    <option value="SPONSORSHIP">SPONSORSHIP</option>
                                    <option value="3"><?php echo $this->session->bahasa === 'ID' ? 'Lain - Lain' : 'Others'; ?></option>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-attach-money mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="others_funds">
                            <label for="supervisor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Others Source Of Funds' : 'Sumber Dana Lainnya' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="osof" name="osof"  placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Others Source Of Funds' : 'Masukan Sumber Dana Lainnya' ?>">
                                <span class="input-group-addon"><i class="mdi mdi-attach-money mdi-lg text-teal"></i></span>
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range" id="data_range" required>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Perhitungan Hari' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day" value="" id="count_day" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Count of Leave Day' : 'Perhitungan Lama Hari' ?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-poll mdi-lg text-teal"></i></span>
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
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Date Of MoU' : 'Tanggal MoU' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="date_mou" name="date_mou" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of MoU' : 'Tanggal MoU' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Research Proposal' : 'Proposal Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="proposal" name="proposal" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Research Proposal' : 'Tanggal Proposal Riset' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-search mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Budget Proposal' : 'Proposal Anggaran' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="budget" name="budget" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Budget Proposal' : 'Tanggal Proposal Anggaran' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-credit-card mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label">Ethics Approval</label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="e_approval" name="e_approval" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Ethics Approval' : 'Tanggal Ethics Approval' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-group-work mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Copy of 1st Installment' : 'Copy of 1st Installment' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="installment" name="installment" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Copy of 1st Installment' : 'Tanggal Copy of 1st Installment' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-receipt mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Official Research Permission Letter' : 'Tanggal Surat Izin Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="date_permission" name="date_permission" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date of Official Research Permission Letter' : 'Tanggal Surat Izin Riset' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-vpn-lock mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Locations' : 'Lokasi' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="location" value="" rows="5" id="localtion" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your dutys location' : 'Masukan Lokasi' ?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-add-location mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Research Information' : 'Informasi Riset' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement" value="" rows="5" id="statement" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Your Research Information' : 'Masukan Informasi Riset Anda' ?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save' : 'Simpan' ?></b></button>
                    <a type="button" class="btn btn-default" onclick="hide();"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
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
                <h3 class="modal-title text-center"><?php echo $this->session->bahasa === 'EN' ? 'Form <b class="text-dark">Edit</b> Research Leave Submission' : '<b class="text-dark">Ubah</b> Pengajuan Cuti Riset'?> </h3>
            </div>
            <form id="research_form_edit" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_research_edit" name="id_research_edit">
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" value="<?=$cdate ?>" name="sub_date" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Fill with your staff Positions In The Project' : 'Masukan Posisi/Jabatan Anda dalam Project tersebut' ?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="div_name">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="research_name_peg" value="<?=$name ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Your Full Name' : 'Masukan Nama Lengkap Anda' ?>" readonly >
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                        <div class="form-group col-sm-12" id="div_approver">
                            <label for="supervisor" class="col-sm-3 control-label text-dark">Approver</label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="approver" value="<?=$approver ?>" readonly required>
                                <input type="text" class="form-control" name="name" value="<?=$supervisor ?>" placeholder="Fill with your Full Name" disabled required>
                                <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="position" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Positions In The Project' : 'Posisi dalam Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="position" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Fill with your staff Positions In The Project' : 'Masukan Posisi/Jabatan Anda dalam Project tersebut' ?>" id="position_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-card-membership mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="picopi" class="col-sm-3 control-label text-dark">PI/Co PI</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="picopi" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input PI/Co PI' : 'Masukan PI/Co PI' ?>" id="picopi_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-class mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sponsor" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Sponsorship' : 'Sponsor' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="sponsor" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your sponsorship' : 'Masukan Sponsor Anda' ?>" id="sponsor_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-redeem mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="p_name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Project Title' : 'Judul Project' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="p_name" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input the name of your project' : 'Masukan Judul Project Anda' ?>" id="p_name_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-stars mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="toa" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="toa_edit" name="toa" class="form-control select2" style="width: 100%;" onchange="show_others_edit()" required>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your type of Duty' : 'Pilih Jenis Aktifitas'?></b></option>
                                    <?php 
                                        foreach ($type as $types) { 
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
                                <input type="text" class="form-control" id="oat_edit" name="oat"  placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Others Duty Type' : 'Masukan Jenis Aktifitas Lainnya' ?>">
                                <span class="input-group-addon"><i class="mdi mdi-layers mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="tod" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Source Of Funds' : 'Sumber Dana' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="sof_edit" name="sof" class="form-control select2" style="width: 100%;" onchange="show_others_funds_edit()" required>
                                    <option value="" selected="selected" disabled><b><?php echo $this->session->bahasa === 'EN' ? 'Choose your Source Of Funds' : 'Pilih Sumber Dana' ?></b></option>
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
                                <input type="text" class="form-control" id="osof_edit" name="osof"  placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Others Source Of Funds' : 'Masukan Sumber Dana Lainnya' ?>">
                                <span class="input-group-addon"><i class="mdi mdi-attach-money mdi-lg text-teal"></i></span>
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Date Range' : 'Jangka Waktu' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right" name="date_range" id="data_range_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-date-range mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Day Calculation' : 'Perhitungan Hari' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" name="count_day" value="" id="count_day_edit" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Count of Leave Day' : 'Perhitungan Lama Hari' ?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-poll mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                        <div class="form-group col-sm-12">
                            <label for="plt" class="col-sm-3 control-label text-dark">PLT</label>
                            <div class="input-group col-sm-9">
                                <select id="plt_edit" name="plt" class="form-control select2" style="width: 100%;"  required>
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
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Date Of MoU' : 'Tanggal MoU' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="date_mou_edit" name="date_mou" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of MoU' : 'Tanggal MoU' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Research Proposal' : 'Proposal Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="proposal_edit" name="proposal" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Research Proposal' : 'Tanggal Proposal Riset' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-search mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Budget Proposal' : 'Proposal Anggaran' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="budget_edit" name="budget" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Budget Proposal' : 'Tanggal Proposal Anggaran' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-credit-card mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label">Ethics Approval</label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="e_approval_edit" name="e_approval" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date Of Ethics Approval' : 'Tanggal Ethics Approval' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-group-work mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Copy of 1st Installment' : 'Copy of 1st Installment' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="installment_edit" name="installment" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Date Copy of 1st Installment' : 'Masukan Tanggal Copy of 1st Installment' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-receipt mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Official Research Permission Letter' : 'Tanggal Surat Izin Riset' ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right datepicker" id="date_permission_edit" name="date_permission" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Date of Official Research Permission Letter' : 'Tanggal Surat Izin Riset' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-vpn-lock mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Locations' : 'Lokasi' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="location" value="" rows="5" id="location_edit" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your dutys location' : 'Masukan Lokasi' ?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-add-location mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Research Information' : 'Informasi Riset' ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="statement" value="" rows="5" id="statement_edit" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input Your Research Information' : 'Masukan Informasi Riset Anda' ?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_edit" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save Changes' : 'Ubah' ?></b></button>
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

        $('#submission_modal').on('hidden.bs.modal', function () {
            hide();
        });

        $('#edit_submission_modal').on('hidden.bs.modal', function () {
            hide();
        });
        
        // Select Input
        $('.select2').select2();

        // Datatable 
        $('#tbl_research').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'responsive'  : true
        })

        //Date range picker
        $('#data_range').daterangepicker();
        $('#data_range_edit').daterangepicker()

        //Date picker
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    $(document).ready(function(){
        $('#others_oat').hide();
        $('#others_funds').hide();
        $('#div_name').hide();
        $('#div_approver').hide();
    });

    function show_others() {
        var id = $('#toa').val();
        if (id === 3 || id === '3') {
            $('#others_oat').show();
        } else {
            $('#oat').val('');
            $('#others_oat').hide();
        }
    } 

    function show_others_funds() {
        var id = $('#sof').val();
        if (id === 3 || id === '3') {
            $('#others_funds').show();
        } else {
            $('#osof').val('');
            $('#others_funds').hide();
        }
    }

    function show_others_edit() {
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

    function tb_reload (token) {
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/tables/tb_research/',  
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
        $('#edit_submission_modal').modal('hide');
        $('#toa_edit').val('').trigger('change');
        $('#sof_edit').val('').trigger('change');
        $('#plt_edit').val('').trigger('change');
        $('#toa').val('').trigger('change');
        $('#sof').val('').trigger('change');
        $('#plt').val('').trigger('change');
        $('#research_form')[0].reset();
        $('#research_form_edit')[0].reset();
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

    $('#research_form').submit(function(e) {
        e.preventDefault();
        
        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/research/insert_submission', 
            data : new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);

                // alert(JSON.stringify(data));

                if (data.code === true) { 
                    
                    hide();                   
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been saved!" : "Data Anda telah tersimpan!"?>');
                    tb_reload (token);
                    socket.emit('notif', { notif: 1});

                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/research/mail/send/' + data.id_research + '/1',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "<?php echo $this->session->token; ?>");
                        }
                    }).done(function (res) {
                        var ress = JSON.parse(res);
                        // toast(1 , "Mail Success :", ress.code);
                        if (ress.code === true) {
                            toast(1 , "Mail Success :", "<?php echo $this->session->bahasa === 'EN' ? "Email submission was sent to supervisor!" : "Email pengajuan telah terkirim ke supervisor!" ?>");
                        } else {
                            toast(2 , "Warning :", "<?php echo $this->session->bahasa === 'EN' ? "Email submission not sent to supervisor!" : "Gagal mengirim email pengajuan data ke supervisor!" ?>");
                        }
                    }).fail(function (err)  {
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail submission notification!' : 'Tidak dapat mengirim email pemberitahuan pengajuan!' ?>");
                    });

                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/research/mail/send/' + data.id_research + '/2',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "<?php echo $this->session->token; ?>");
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
                        toast(0 , "Error :", "<?php echo $this->session->bahasa === 'EN' ? 'Cannot sending mail submission notification!' : 'Tidak dapat mengirim email pemberitahuan pengajuan!' ?>");
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

    $('#research_form_edit').submit(function(e) {
        e.preventDefault();
        
        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            // enctype: 'multipart/form-data',
            url  : base_url() + '/crud/research/update', 
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
                    
                    hide();
                    tb_reload(token);

                    $.ajax({
                        type: "POST",
                        url: base_url() + '/crud/research/mail/update/' + data.id_research + '/1',
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
                        url: base_url() + '/crud/research/mail/update/' + data.id_research + '/2',
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

                    $('#toa_edit').val(get.jenis_keg).trigger('change');
                    $('#plt_edit').val(get.id_plt).trigger('change');
                    $('#sof_edit').val(dana).trigger('change');
                    $('#statement_edit').val(get.ket);
                    $('#location_edit').val(get.lokasi);
                    $('#position_edit').val(get.jabatan);
                    $('#picopi_edit').val(get.picopi);
                    $('#p_name_edit').val(get.nama_research);
                    $('#sponsor_edit').val(get.sponsor);
                    $('#date_mou_edit').val(get.tgl_mou);
                    $('#proposal_edit').val(get.tgl_research);
                    $('#installment_edit').val(get.tgl_installment);
                    $('#e_approval_edit').val(get.tgl_ethic);
                    $('#budget_edit').val(get.tgl_buget);
                    $('#date_permission_edit').val(get.tgl_izin_riset);


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

                    $('#toa_edit').prop("disabled", false);
                    $('#plt_edit').prop("disabled", false);
                    $('#sof_edit').prop("disabled", false);
                    $('#statement_edit').prop("disabled", false);
                    $('#location_edit').prop("disabled", false);
                    $('#position_edit').prop("disabled", false);
                    $('#picopi_edit').prop("disabled", false);
                    $('#p_name_edit').prop("disabled", false);
                    $('#sponsor_edit').prop("disabled", false);
                    $('#date_mou_edit').prop("disabled", false);
                    $('#proposal_edit').prop("disabled", false);
                    $('#installment_edit').prop("disabled", false);
                    $('#e_approval_edit').prop("disabled", false);
                    $('#budget_edit').prop("disabled", false);
                    $('#date_permission_edit').prop("disabled", false);
                    $('#data_range_edit').prop("disabled", false);
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
        var token = '<?php echo $this->session->token; ?>';

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

                    $('#toa_edit').val(get.jenis_keg).trigger('change');
                    $('#plt_edit').val(get.id_plt).trigger('change');
                    $('#sof_edit').val(dana).trigger('change');
                    $('#statement_edit').val(get.ket);
                    $('#location_edit').val(get.lokasi);
                    $('#position_edit').val(get.jabatan);
                    $('#picopi_edit').val(get.picopi);
                    $('#p_name_edit').val(get.nama_research);
                    $('#sponsor_edit').val(get.sponsor);
                    $('#date_mou_edit').val(get.tgl_mou);
                    $('#proposal_edit').val(get.tgl_research);
                    $('#installment_edit').val(get.tgl_installment);
                    $('#e_approval_edit').val(get.tgl_ethic);
                    $('#budget_edit').val(get.tgl_buget);
                    $('#date_permission_edit').val(get.tgl_izin_riset);


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

                    $('#toa_edit').prop("disabled", true);
                    $('#plt_edit').prop("disabled", true);
                    $('#sof_edit').prop("disabled", true);
                    $('#statement_edit').prop("disabled", true);
                    $('#location_edit').prop("disabled", true);
                    $('#position_edit').prop("disabled", true);
                    $('#picopi_edit').prop("disabled", true);
                    $('#p_name_edit').prop("disabled", true);
                    $('#sponsor_edit').prop("disabled", true);
                    $('#date_mou_edit').prop("disabled", true);
                    $('#proposal_edit').prop("disabled", true);
                    $('#installment_edit').prop("disabled", true);
                    $('#e_approval_edit').prop("disabled", true);
                    $('#budget_edit').prop("disabled", true);
                    $('#date_permission_edit').prop("disabled", true);
                    $('#data_range_edit').prop("disabled", true);
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
            url  : base_url() + '/crud/general/attachment_viewer', 
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
                            url  : base_url() + '/crud/research/delete', 
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
   
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>
