<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Overtime' : 'Lembur' ?></b> Application</h3>
            </div>
            <div class="box-body">
                <div class="col-sm-2">
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Add Submission' : 'Tambah Pengajuan Lembur' ?>">
                        <a data-toggle="modal" data-target="#submission_modal" class="btn btn-block btn-success"><i class="mdi mdi-assignment mdi-lg"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Submission' : 'Pengajuan' ?></b></a><br>
                    </span>
                </div>
                <div class="col-sm-12" id="tb_content">
                    <table id="tbl_overtime" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Times Range' : 'Jangka Waktu' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Penyetuju' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
                            </tr>
                            <col width="10">
                            <col width="150">
                            <col width="250">
                            <col width="320">
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
                                    <td><?=$date ?> <b class="text-maroon">(<?=$get->time_start ?> - <?=$get->time_end ?>)</b><b class="pull-right"></b><small class="label pull-right bg-purple"><?=$get->time_total ?> <?php echo $this->session->bahasa === 'EN' ? 'Hours' : 'Jam'?></small></td>
                                    <td>
                                        <b class="text-maroon"><?=$get->nama_svp ?></b>
                                        <span class="pull-right-container">
                                            <?php if ($get->status === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu persetujuan'; $color = 'bg-orange'; } else if ($get->status === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label pull-right <?=$color?>"><?=$status?></small>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($get->status === '1') { ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Edit Data' : 'Ubah Data' ?>">
                                                <a onclick="edit('<?=$get->id_overtime ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Delete Data' : 'Hapus Data' ?>">
                                                <a onclick="del('<?=$get->id_overtime ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </span>
                                        <?php } else {  ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Details' : 'Lihat Detail' ?>">
                                                <a onclick="view('<?=$get->id_overtime ?>'); " class="btn btn-xs btn-warning"><i class="mdi mdi-visibility"></i></a>
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
                <h2 class="modal-title text-center"><b class="text-maroon "><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Submission' : 'Pengajuan Lembur'; ?></b> Form</h2>
            </div>
            <form id="overtime_form" class="form-horizontal">
                <?php //print_r($approver) ?>
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="overtime_name_peg" value="<?=$name ?>" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Input your Full Name' : 'Masukan Nama Lengkap Anda'; ?>"  readonly >
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
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Date' : 'Tanggal Lembur'; ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="datepicker" name="date_overtime" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Input Overtime Date' : 'Masukan Tanggal Lembur'; ?>"  required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'From' : 'Dari'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker" name="from_time" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Set Start Time' : 'Tentukan Waktu Mulai'; ?>" id="from_time" required>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'To' : 'Sampai'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker" name="to_time" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Set End Time' : 'Tentukan Waktu Akhir'; ?>" id="to_time" required>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Time Calculation' : 'Perhitungan Waktu'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="count_time" value="" id="count_time" required>
                                <input type="text" class="form-control" value="" id="count_times" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Total Hours' : 'Total Waktu'?>" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Information' : 'Informasi Lembur'; ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="desc" value="" rows="5" id="desc" placeholder="<?php echo $val = $this->session->bahasa === 'EN' ? 'Input your overtime statement' : 'Masukan pernyataan/informasi lembur'; ?>" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>&nbsp;&nbsp;<b><?php echo $val = $this->session->bahasa === 'EN' ? 'Save' : 'Simpan'; ?></b></button>
                    <a type="button" class="btn btn-default" onclick="hide();"><?php echo $val = $this->session->bahasa === 'EN' ? 'Close' : 'Tutup'; ?></a>
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
                <h3 class="modal-title text-center"><b class="text-maroon "><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Submission Form <b class="text-dark">Edit</b>' : 'Formulir <b class="text-dark">Ubah</b> Pengajuan Lembur'; ?> </b></h3>
            </div>
            <form id="overtime_form_edit" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_overtime" name="id_overtime" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="id_peg_edit" value="<?=$id_peg ?>" readonly required>
                                <input type="text" class="form-control" name="overtime_name_peg_edit" value="<?=$name ?>" placeholder="" readonly>
                                <span class="input-group-addon"><i class="mdi mdi-account-circle mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php if ($approver != 1 || $approver != '1') { ?>
                        <div class="form-group col-sm-12">
                            <label for="supervisor" class="col-sm-3 control-label text-dark">Approver</label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="approver_edit" value="<?=$approver ?>" readonly required>
                                <input type="text" class="form-control" name="name_edit" value="<?=$supervisor ?>" placeholder="Fill with your Full Name" disabled required>
                                <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group col-sm-12">
                            <label for="sub_date" class="col-sm-3 control-label"><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Date' : 'Tanggal Lembur'; ?></label>
                            <div class="input-group date col-sm-9">
                                <input type="text" class="form-control pull-right" id="datepicker_edit" name="date_overtime_edit" placeholder="" required>
                                <span class="input-group-addon"><i class="mdi mdi-event-note mdi-lg text-teal"></i></span>
                            </div> 
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'From' : 'Dari'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker_edit" name="from_time_edit" placeholder="Set Start Time" id="from_time_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="daterange" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'To' : 'Sampai'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control pull-right timepicker_edit" name="to_time_edit" placeholder="Set End Time" id="to_time_edit" required>
                                <span class="input-group-addon"><i class="mdi mdi-access-time mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="count_day" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Time Calculation' : 'Perhitungan Waktu'; ?></label>
                            <div class="input-group col-sm-9">
                                <input type="hidden" name="count_time_edit" value="" id="count_time_edit" required>
                                <input type="text" class="form-control" value="" id="count_times_edit" placeholder="Total Hours" readonly required>
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="statement" class="col-sm-3 control-label text-dark"><?php echo $val = $this->session->bahasa === 'EN' ? 'Overtime Information' : 'Informasi Lembur'; ?></label>
                            <div class="input-group col-sm-9">
                                <textarea class="form-control" name="desc_edit" value="" rows="5" id="desc_edit" placeholder="Fill your Overtime statement" required></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-description mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                    
                    <button id="btn_edit" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save Changes' : 'Ubah Data'; ?></b></button>                   
                    <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup'; ?></a>
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
        $('#tbl_overtime').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'responsive'  : true
        })

        // Time Picker
        $('.timepicker').timepicker({
                showInputs: false,
                minuteStep: 60,
                showMeridian: false,
                defaultTime: false
        })

        $('.timepicker_edit').timepicker({
                showInputs: false,
                minuteStep: 60,
                showMeridian: false,
                defaultTime: false
        })

        //Date picker
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })

        $('#datepicker_edit').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    function tb_reload (token) {
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/tables/tb_overtime/',  
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
        $('#overtime_form')[0].reset();
        $('#overtime_form_edit')[0].reset();
    }

    $('.timepicker').change(function(){
        // var today   = new Date();

        // var start   = today + ' ' +$('#from_time').val();
        // var end     = today + ' ' +$('#to_time').val();

        // var ms  = moment(end,"DD/MM/YYYY HH:mm:ss").diff(moment(start,"DD/MM/YYYY HH:mm:ss"));
        // var d   = moment.duration(ms);
        // var H   = Math.floor(d.asHours());
        // var M   = Math.floor(d.minutes());
        // var S   = Math.floor(d.seconds());
        // var D   = Math.floor(d.asDays());
        

        var timea   = $('#from_time').val();
        var timeb   = $('#to_time').val();
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
            $('#count_time').val(0);
            $('#count_times').val(H+' Hours, '+M+ ' Minutes');
        } else {
            $('#count_time').val(H+':'+M);
            $('#count_times').val(H+' Hours, '+M+ ' Minutes');
        }
        
    });

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
            $('#count_times_edit').val(H+' <?php echo $this->session->bahasa === 'EN' ? 'Hours' : 'Jam'?>, '+M+ ' <?php echo $this->session->bahasa === 'EN' ? 'Minutes' : 'Menit'?>');
        } else {
            $('#count_time_edit').val(H+':'+M);
            $('#count_times_edit').val(H+' <?php echo $this->session->bahasa === 'EN' ? 'Hours' : 'Jam'?>, '+M+ ' <?php echo $this->session->bahasa === 'EN' ? 'Minutes' : 'Menit'?>');
        }
    }

    $('.timepicker_edit').change(function(){
        time_edit_change();
    });

    $('#overtime_form').submit(function(e) {
        e.preventDefault();
        
        var token = $('#token').val();

        if ($('#count_time').val() === '0') {
            info('<?php echo $this->session->bahasa === 'EN' ? '<b>Validation Alert!</b>' : '<b>Peringatan Validasi!</b>'?>',"<?php echo $this->session->bahasa === 'EN' ? '<b>To Time</b> value must be greater then <b>From Time</b> value. Please fix it.' : '<b>Waktu Akhir</b> harus lebih besar dari <b>waktu mulai/start<b>.'; ?>", 'orange', 'fa fa-warning')
        } else {
            $.ajax({
                type : 'POST', 
                // enctype: 'multipart/form-data',
                url  : base_url() + '/crud/overtime/insert_submission', 
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
                        toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been saved!" : "Data Anda telah tersimpan!"?>');
                        hide();
                        tb_reload (token);
                    } else {                   
                        toast('0','Error', data.error);
                        tb_reload(token);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                }
            });
        }
    });

    $('#overtime_form_edit').submit(function(e) {
        e.preventDefault();
        
        var token = $('#token').val();

        if ($('#count_time_edit').val() === '0') {
            info('<?php echo $this->session->bahasa === 'EN' ? '<b>Validation Alert!</b>' : '<b>Peringatan Validasi!</b>'?>',"<?php echo $this->session->bahasa === 'EN' ? '<b>To Time</b> value must be greater then <b>From Time</b> value. Please fix it.' : '<b>Waktu Akhir</b> harus lebih besar dari <b>waktu mulai/start<b>.'; ?>", 'orange', 'fa fa-warning')
        } else {

            $.ajax({
                type : 'POST', 
                url  : base_url() + '/crud/overtime/update', 
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
                    } else {
                        toast('0','Error', data.error);
                        tb_reload(token);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                }
            });
        }
    });

    function edit(id) {
        var token = $('#token').val();
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

                    time_edit_change();

                    $('#datepicker_edit').prop("disabled", false);
                    $('#from_time_edit').prop("disabled", false);
                    $('#to_time_edit').prop("disabled", false);
                    $('#desc_edit').prop("disabled", false);
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

                    time_edit_change();

                    $('#datepicker_edit').prop("disabled", true);
                    $('#from_time_edit').prop("disabled", true);
                    $('#to_time_edit').prop("disabled", true);
                    $('#desc_edit').prop("disabled", true);
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
                            url  : base_url() + '/crud/overtime/delete', 
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
