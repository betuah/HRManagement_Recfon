<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue-active">
                <h3 class="widget-user-username"><b><?=$nama ?></b></h3>
                <h5 class="widget-user-desc"><?=$jab ?></h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="<?=$pics ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header"><?=$supervisor ?></h5>
                        <span class="description-text">Supervisor</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header"><?=$unit ?></h5>
                        <span class="description-text"><?php echo $this->session->bahasa === 'EN' ? 'Unit' : 'Unit' ?></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header"><?=$tgl_lahir?></h5>
                        <span class="description-text"><?php echo $this->session->bahasa === 'EN' ? 'Birthday' : 'Tanggal Lahir' ?></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-12">
                        <div class="description-block"><hr>
                            <h5 class="description-header"><?php echo $this->session->bahasa === 'EN' ? 'ADDRESS' : 'ALAMAT' ?></h5>
                            <span class="description-text"><?=$alamat?></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.widget-user -->
    </div>

    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <!-- <h3 class="box-title">Profile Settings</h3> -->
            <!-- <h2 class="title text-aqua"><b>Profile Settings</b></h2><br> -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="pd-tab" data-toggle="tab" href="#pd" role="tab" aria-controls="pd" aria-selected="true"><h5><b>Personal Data</b></h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic" role="tab" aria-controls="pic" aria-selected="false"><h5><b><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Foto Profil' ?></b></h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pass-tab" data-toggle="tab" href="#pass" role="tab" aria-controls="pass" aria-selected="false"><h5><b><?php echo $this->session->bahasa === 'EN' ? 'Change Password' : 'Ubah Password' ?></b></h5></a>
                </li>
            </ul> 
        
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Personal Data -->
                <div class="tab-pane active" id="pd" role="tabpanel" aria-labelledby="pd-tab">
                    <form id="personal_form" class="form-horizontal row">
                        <input type="hidden" id="token" name="token" value="<?=$token ?>">
                        <div class="form-group col-sm-12">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="input-group col-sm-10">
                                <input type="email" class="form-control" name="email" value="<?=$email ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your Email' : 'Masukan Email Anda' ?>" disabled >
                                <span class="input-group-addon"><i class="mdi mdi-email mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="nik" class="col-sm-2 control-label">NIK</label>
                            <div class="input-group col-sm-10">
                                <input type="number" class="form-control" name="nik" value="<?=$nik ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your NIK' : 'Masukan NIK Anda' ?>" disabled id="nik">
                                <span class="input-group-addon"><i class="mdi mdi-linear-scale mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="name" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?=$nama ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your full name' : 'Masukan Nama Lengkap Anda' ?>" disabled id="name">
                                <span class="input-group-addon"><i class="mdi mdi-person-pin mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="jekel" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Gender' : 'Jenis Kelamin' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="radio" id="R1" disabled name="jekel" value="Male" class="flat-red" <?php if($jekel === 'Male') { echo 'checked'; } ?>>&nbsp;<?php echo $this->session->bahasa === 'EN' ? 'Male' : 'Pria' ?>&nbsp;&nbsp;
                                <input type="radio" id="R2" disabled name="jekel" value="Female" class="flat-red" <?php if($jekel === 'Female') { echo 'checked'; } ?> >&nbsp;<?php echo $this->session->bahasa === 'EN' ? 'Female' : 'Wanita' ?>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="alamat" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Address' : 'Alamat' ?></label>
                            <div class="input-group col-sm-10">
                                <textarea type="email" class="form-control" name="alamat" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Type your Address' : 'Masukan Alamat Anda' ?>" disabled id="alamat"><?php if($alamat === null || $alamat === '') { echo '-'; } else { echo $alamat; } ?></textarea>
                                <span class="input-group-addon"><i class="mdi mdi-place mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="tempat_lahir" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Place of Birth' : 'Tempat Lahir' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="text" class="form-control" name="tempat_lahir" value="<?=$tempat ?>" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your Place of Birth' : 'Masukan Tempat Lahir Anda' ?>" disabled id="tempat_lahir">
                                <span class="input-group-addon"><i class="mdi mdi-person-pin-circle mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="birthday" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Birthday' : 'Tanggal Lahir' ?></label>
                            <div class="input-group date col-sm-10">
                                <input type="text" class="form-control pull-right" id="datepicker" value="<?=$tgl_lahir ?>" name="tgl_lahir" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Type your Birthday' : 'Masukan Tanggal Lahir Anda' ?>" disabled>
                                <span class="input-group-addon"><i class="mdi mdi-cake mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                                <a onclick="edit(false);" class="btn btn-block btn-warning float-left"><i class="fa fa-edit"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Edit' : 'Ubah' ?></b></a>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-block btn-info float-right"><i class="fa fa-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save' : 'Simpan' ?></b></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Personal Data -->

                <!-- Picture -->
                <div class="tab-pane" id="pic" role="tabpanel" aria-labelledby="pic-tab">
                    <form id="pic_form" enctype="multipart/form-data">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="pics" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(<?=$pics ?>);">
                                </div>
                            </div><br><br>
                            <button type="submit" class="btn btn-block btn-info float-right"><i class="fa fa-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save' : 'Simpan' ?></b></button>
                            <a onclick="restore_pic()" class="btn btn-block btn-warning float-right"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<b>Restore Default</b></a>
                        </div> 
                    </form>
                </div>
                
                <!-- End Picture -->

                <!-- Change Password -->
                <div class="tab-pane" id="pass" role="tabpanel" aria-labelledby="pass-tab">
                    <form id="pass_form" class="form-horizontal row">
                        <div class="form-group col-sm-12">
                            <label for="opass" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Old Password' : 'Password Lama' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="password" id="opass" class="form-control" name="opass" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Leave this blank if you have never created a password.' : 'Biarkan Kosong Jika Anda Tidak Pernah Membuat Password Sebelumnya.' ?>">
                                <span class="input-group-addon"><i class="mdi mdi-lock-open mdi-lg text-maroon"></i></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="newpass" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'New Password' : 'Password Baru' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="password" id="newpass" class="form-control" name="newpass" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Input your new Password' : 'Masukan Password Baru Anda' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-lock-outline mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="cpass" class="col-sm-2 control-label"><?php echo $this->session->bahasa === 'EN' ? 'Confirm Password' : 'Password Konfirmasi' ?></label>
                            <div class="input-group col-sm-10">
                                <input type="password" id="cpass" class="form-control" name="cpass" placeholder="<?php echo $this->session->bahasa === 'EN' ? 'Re input your new Password' : 'Masukan kembali Password Baru Anda' ?>" required>
                                <span class="input-group-addon"><i class="mdi mdi-lock mdi-lg text-maroon"></i></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-block btn-info "><i class="fa fa-send"></i>&nbsp;&nbsp;<b><?php echo $this->session->bahasa === 'EN' ? 'Save' : 'Simpan' ?></b></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Change Password -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        if(screen.width <= 760) {
            $('#personal_form').removeClass('row');
            $('#pass_form').removeClass('row');
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

        //Date picker
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
        
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    });

    function edit(stat) {
        $('#nik').prop("disabled", stat);
        $('#R1').prop("disabled", stat);
        $('#R2').prop("disabled", stat);
        $('#name').prop("disabled", stat);
        $('#alamat').prop("disabled", stat);
        $('#tempat_lahir').prop("disabled", stat);
        $('#datepicker').prop("disabled", stat);
    }

    $("#personal_form").submit(function(e) {
        e.preventDefault();

        var token = $('#token').val();

        var check = document.getElementById('nik').disabled;

        if(check === true) {
            info('<?php echo $this->session->bahasa === 'EN' ? "<b>Information!</b>" : "<b>Informasi !</b>"?>',"<?php echo $this->session->bahasa === 'EN' ? 'You must click the <b>Edit button</b> first to change the data, then click the <b>Save button</b> to save the data.' : 'Tekan tombol <b>Ubah</b> sebelum Anda merubah data, Lalu tekan tombol <b>Simpan</b> untuk meyimpan data.' ?>", 'blue', 'fa fa-info')
        } else {
            $.ajax({
                type : 'POST', 
                url  : base_url() + '/crud/profile/update_personal', 
                data : $("#personal_form").serializeArray(),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function(data){
                    var data = JSON.parse(data);

                    if (data.code === true) {
                        toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been changed!" : "Data Anda telah tersimpan."?>');
                        edit(true);
                        active('profile', token);
                        
                    } else {
                        toast('0','Error','<?php echo $this->session->bahasa === 'EN' ? "Error changed the data!" : "Terjadi Kesalah pada saat mengubah data!"?>');
                        edit(true);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                    edit(false);
                }
            });
        }
    });

    $("#pass_form").submit(function(e) {
        e.preventDefault();

        var token       = $('#token').val();
        var newpass     = $('#newpass').val();
        var cpass       = $('#cpass').val();

        if ( newpass === cpass ) {
            $.ajax({
                type : 'POST', 
                url  : base_url() + '/crud/profile/change_pass', 
                data : $("#pass_form").serializeArray(),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function(data){
                    var data = JSON.parse(data);

                    if (data.code === true) {
                        toast('1','<b>Success</b>','<?php echo $this->session->bahasa === 'EN' ? "Your password updated!" : "Password Anda Telah di ubah."?>');
                        $('#newpass').val('');
                        $('#cpass').val('');
                        $('#opass').val('');
                    } else {
                        info('<b>Ops!</b>',data.error, 'red', 'fa fa-exclamation-circle');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                    edit(false);
                }
            });
        } else {
            info('<b>Ops!</b>','<b>Your confirmation password is not the same!</b>', 'orange', 'fa fa-exclamation-triangle');
        }
    });

    function restore_pic() {
        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/profile/restore_pic', 
            data : $("#pic_form").serializeArray(),
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                var data = JSON.parse(data);

                if (data.code === true) {
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Restore Picture Success!" : "Mengmbalikan Foto Profil Berhasil!"?>');
                    edit(true);
                    // active('profile', token);
                    window.location.href = "<?php echo base_url(); ?>";
                } else {
                    toast('3','<b>Information</b>', data.error);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    }

    $("#pic_form").submit(function(e) {
        e.preventDefault();

        var token = $('#token').val();

        $.ajax({
            type : 'POST', 
            // enctype: 'multipart/form-data',
            url  : base_url() + '/crud/profile/update_pic', 
            data : new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(data){
                // alert(JSON.stringify(data));
                var data = JSON.parse(data);

                if (data.code === true) {
                    toast('1','Success','<?php echo $this->session->bahasa === 'EN' ? "Your data has been changed!" : "Data Anda Telah Dirubah."?>');
                    edit(true);
                    // active('profile', token);
                    window.location.href = "<?php echo base_url(); ?>";
                } else {
                    toast('0','Error', data.error);
                    // alert(JSON.stringify(data));
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });
    });
</script>

<?php } else { echo "<script type='text/javascript'>window.location.href = '". base_url() ."';</script>"; } ?>
