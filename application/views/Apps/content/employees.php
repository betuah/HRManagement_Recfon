<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark">Data <b class="text-maroon" ><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Kepegawaian' ?></b></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-2">
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Add Employees' : 'Tambah Pegawai' ?>">
                        <a data-toggle="modal" data-target="#submission_modal" class="btn btn-block btn-success"><i class="mdi mdi-add-circle mdi-lg"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Add Employees' : 'Tambah Pegawai' ?></b></a><br>
                    </span>
                </div>
                <div class="col-sm-12" id="tb_employees">
                    <table id="tbl_employees" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-blue">
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <!-- <col width="200">
                            <col width="150">
                            <col width="120">
                            <col width="200">
                            <col width="100">
                            <col width="200">
                            <col width="100"> -->
                        </thead>
                        <tbody>
                            <?php foreach ($get_peg as $get) { if ($get->id_akses != '1') { ?>
                                <tr>
                                    <td>
                                        <b class="text-maroon"><?=$get->nama ?></b>
                                    </td>
                                    <td>
                                        <?=$get->email ?>
                                    </td>
                                    <td>
                                        <b class="text-maroon"><?=$get->ket ?></b>
                                    </td>
                                    <td>
                                        <?=$get->id_akses === '5' ? $get->nama_unit : $get->nama_div ?>
                                    </td>
                                    <td>
                                        <?php $stat = $get->status > '0' ? 'Active' : 'Not Active'; ?>
                                        <span class="pull-right-container">
                                            <?php //if ($get->approval === '1') { $status = 'Waiting Approval'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                                            <small class="label bg-green"><?=$stat?></small>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit File">
                                            <a onclick="edit('<?=$get->id_peg ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete File">
                                            <a onclick="del('<?=$get->id_peg ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-blue">
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Action</th>
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
                <h2 class="modal-title text-center"><?php echo $this->session->bahasa === 'EN' ? '<b class="text-maroon ">Add Employees</b>' : '<b class="text-maroon ">Tambah Pegawai</b>' ?></h2>
            </div>
            <form id="employees_form" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark">NIK</label>
                            <div class="input-group col-sm-9">
                                <input type="number" class="form-control" name="nik" value="" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input NIK' : 'Masukan NIK' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="name"name="name" value="" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your Full Name' : 'Masukan Nama Lengkap' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="email" class="col-sm-3 control-label text-dark">Email</label>
                            <div class="input-group col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input email' : 'Masukan Email' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-email mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="gender" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Gender' : 'Jenis Kelamin' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="gender" name="gender" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose the gender' : 'Pilih Jenis Kelamin' ?></option>
                                    <option value="Male" ><?php echo $this->session->bahasa === 'EN' ? 'Male' : 'Pria' ?></option>
                                    <option value="Female" ><?php echo $this->session->bahasa === 'EN' ? 'Female' : 'Wanita' ?></option>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-person mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="level" class="col-sm-3 control-label text-dark">Level</label>
                            <div class="input-group col-sm-9">
                                <select id="level" name="level" class="form-control select2" style="width: 100%;" onchange="req_unit(this.value)" required>
                                    <option value="0" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose the Level' : 'Pilih Level' ?></option>
                                    <?php 
                                        foreach ($level as $level) { 
                                            if ($level->id_akses != '1') { ?>
                                               <option value="<?= $level->id_akses ?>"><?= $level->ket ?></option>                            
                                    <?php  } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-verified-user mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="unit_content">
                            
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
                <h3 class="modal-title text-center"><?php echo $this->session->bahasa === 'EN' ? '<b class="text-maroon ">Edit Employees</b>' : '<b class="text-maroon ">Ubah Pegawai</b>' ?></h3>
            </div>
            <form id="employees_form_edit" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="style" class="row">
                        <input type="hidden" id="token" name="token" value="<?=$token?>">
                        <input type="hidden" id="id_peg" name="id_peg" >
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark">NIK</label>
                            <div class="input-group col-sm-9">
                                <input type="number" class="form-control" name="nik_edit" id="nik_edit" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input NIK' : 'Masukan NIK' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-assignment-turned-in mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control" id="name_edit"name="name_edit" value="" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your Full Name' : 'Masukan Nama Lengkap' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-account-box mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="email" class="col-sm-3 control-label text-dark">Email</label>
                            <div class="input-group col-sm-9">
                                <input type="email" class="form-control" id="email_edit" name="email_edit" value="" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input email' : 'Masukan Email' ?>" required >
                                <span class="input-group-addon"><i class="mdi mdi-email mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="gender" class="col-sm-3 control-label text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Gender' : 'Jenis Kelamin' ?></label>
                            <div class="input-group col-sm-9">
                                <select id="gender_edit" name="gender_edit" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose the gender' : 'Pilih Jenis Kelamin' ?></option>
                                    <option value="Male" ><?php echo $this->session->bahasa === 'EN' ? 'Male' : 'Pria' ?></option>
                                    <option value="Female" ><?php echo $this->session->bahasa === 'EN' ? 'Female' : 'Wanita' ?></option>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-person mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="level" class="col-sm-3 control-label text-dark">Level</label>
                            <div class="input-group col-sm-9">
                                <select id="level_edit" name="level_edit" class="form-control select2" style="width: 100%;" onchange="req_unit_edit(this.value)" required>
                                    <option value="0" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose the Level' : 'Pilih Level' ?></option>
                                    <?php 
                                        foreach ($akses as $get_level) { 
                                            if ($get_level->id_akses != '1') { ?>
                                               <option value="<?= $get_level->id_akses ?>"><?= $get_level->ket ?></option>                            
                                    <?php  } } ?>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-verified-user mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12" id="unit_content_edit">
                            
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="gender" class="col-sm-3 control-label text-dark">Status</label>
                            <div class="input-group col-sm-9">
                                <select id="status_edit" name="status_edit" class="form-control select2" style="width: 100%;"  required>
                                    <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose Status' : 'Pilih Status' ?></option>
                                    <option value="1" ><?php echo $this->session->bahasa === 'EN' ? 'Active' : 'Aktif' ?></option>
                                    <option value="2" ><?php echo $this->session->bahasa === 'EN' ? 'Not Active' : 'Tidak Aktif' ?></option>
                                </select>
                                <span class="input-group-addon"><i class="mdi mdi-person mdi-lg text-teal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save Changes' : 'Simpan Perubahan' ?></b></button>
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
            $('#edit_submission_modal').modal('hide');
            $('#gender_edit').val('').trigger('change');
            $('#level_edit').val('0').trigger('change');
            $('#unit_content_edit').hide();
            $('#employees_form_edit')[0].reset();
        });
        
        // Select Input
        $('.select2').select2();

        // Datatable 
        $('#tbl_employees').DataTable({
            'paging'      : true,
            'lengthChange': false,
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
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    function tb_reload (token) {
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/tables/tb_employees/',  
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            }
        }).done(function (res) {
            $("#tb_employees").html(res);
        }).fail(function (err)  {
            toast(2 , "Error :", "Sorry, The data table cannot be show!");
        });
    }

    function req_unit(req) {
        var token  = '<?php echo $this->session->token; ?>';
        $('#unit_content').show();
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/unit/unit/' + req,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            }
        }).done(function (res) {
            $("#unit_content").html(res);
        }).fail(function (err)  {
            toast(2 , "Error :", "Sorry, The unit cannot be show!");
        });
    }

    function req_unit_edit(req) {
        var token  = '<?php echo $this->session->token; ?>';
        $('#unit_content_edit').show();
        $.ajax({
            type: "GET",
            url: base_url() + '/ajax/unit/unit_edit/' + req,  
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            }
        }).done(function (res) {
            $("#unit_content_edit").html(res);
        }).fail(function (err)  {
            toast(2 , "Error :", "Sorry, The unit cannot be show!");
        });
    }
   
    function hide() {
        $('#submission_modal').modal('hide');
        $('#gender').val('').trigger('change');
        $('#level').val('0').trigger('change');
        $('#employees_form')[0].reset();
        $('#unit_content').hide();
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
                            url  : base_url() + '/crud/employees/delete', 
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

    $('#employees_form').submit(function(e) {
        e.preventDefault();
        
        var token = '<?php echo $this->session->token; ?>';

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/employees/insert', 
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

    $('#employees_form_edit').submit(function(e) {
        e.preventDefault();
        
        var token = '<?php echo $this->session->token; ?>';

        $.ajax({
            type : 'POST', 
            // enctype: 'multipart/form-data',
            url  : base_url() + '/crud/employees/update', 
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
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been changed!" : "Data Anda telah diubah!" ?>');
                    
                    $('#edit_submission_modal').modal('hide');
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
    });

    function edit(id) {
        var token = $('#token').val();
        $('#id_cuti').val(id);

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/employees/edit', 
            data : { 'id' : id},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);
                var get  = data.get[0];

                if (data.code === true) {
                    $('#id_peg').val(get.id_peg);
                    $('#name_edit').val(get.nama);
                    $('#nik_edit').val(get.nik_peg);
                    $('#email_edit').val(get.email);
                    $('#status_edit').val(get.status);
                    $('#gender_edit').val(get.jekel).trigger('change');
                    $('#level_edit').val(get.id_akses).trigger('change');
                    $('#unit_edit').val(get.id_div).trigger('change');
                    $('#status_edit').val(get.status).trigger('change');

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
   
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>
