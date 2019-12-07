<?php if (isset($this->session->token)) { ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Available <b class="text-maroon" >Today</b>' : 'Tersedia <b class="text-maroon" >Hari Ini</b>' ?> </h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_remaining_days" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                
                                    foreach ($get_peg as $peg) { 
                                        $stat = null;
                                        foreach ($get_available as $get) {
                                            if ($get->id_peg === $peg->id_peg) {
                                                $stat = 1;
                                            }
                                        }

                                        if ($stat != 1 && $peg->id_peg != 1) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                        </div>
                                    </td>
                                    <td><b class="text-maroon"><?=$peg->nama?><b></td>
                                    <td><b class="text-maroon"><?=$peg->nama_unit?><b></td>
                                </tr>
                            <?php } }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office (<b class="text-maroon" >General</b>)' : 'Dinas Kantor (<b class="text-maroon" >Umum</b>)' ?></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_research" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($get_general as $get) { 
                            ?>
                                <tr>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                        </div>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama?><b></td>
                                    <td><b class="text-maroon"><?=$get->nama_unit?><b></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="text-dark"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office (<b class="text-maroon" >Research</b>)' : 'Dinas Kantor (<b class="text-maroon" >Riset</b>)' ?></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_general" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($get_reseach as $get) { 
                            ?>
                                <tr>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                        </div>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama?><b></td>
                                    <td><b class="text-maroon"><?=$get->nama_unit?><b></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
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
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_leave" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($get_cuti as $get) { 
                            ?>
                                <tr>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                        </div>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama_user?><b></td>
                                    <td><b class="text-maroon"><?=$get->nama_unit?><b></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
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
                <div class="col-sm-12" id="tb_content_research">
                    <table id="tbl_overtime" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($get_overtime as $get) { 
                            ?>
                                <tr>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                        </div>
                                    </td>
                                    <td><b class="text-maroon"><?=$get->nama?><b></td>
                                    <td><b class="text-maroon"><?=$get->nama_unit?><b></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Picture' : 'Gambar' ?></th>
                                <th><?php echo $this->session->bahasa === 'EN' ? 'Employees' : 'Pegawai' ?></th>
                                <th>Unit</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(function () {
        if(screen.width <= 760) {
            $('#style').removeClass('row');
        }

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()

        $('#tbl_remaining_days').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : true
        })
        $('#tbl_general').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
        $('#tbl_research').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
        $('#tbl_overtime').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
        $('#tbl_leave').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
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
   
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>
