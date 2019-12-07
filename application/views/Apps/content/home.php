<?php if (isset($this->session->token)) { ?>
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="box-title"><?php echo $val = $this->session->bahasa === 'EN' ? 'Summary' : 'Ringkasan' ?><b class="text-primary"><?php echo $val = $this->session->bahasa === 'EN' ? 'Today' : ' Hari Ini' ?></b></h2>
                <div class="pull-right">
                    <a href="#" onclick="date('0')"><h2 class="box-title"><b><?php echo $this->session->bahasa === 'EN' ? 'Previous Day' : 'Hari Sebelumnya' ?></b></h2>&nbsp;<i class="glyphicon glyphicon-triangle-left"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <b id="date_tmp" class="box-title text-maroon">0</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="date('1')"><i class="glyphicon glyphicon-triangle-right"></i>&nbsp;<h2 class="box-title"><b><?php echo $this->session->bahasa === 'EN' ? 'Next Day' : 'Hari Berikutnya' ?></b></h2></i></a>
                </div>
            </div>
            <div class="box-body" id="leave_content">
                <div class="col-sm-12">
                    <h4><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Available Today' : 'Tersedia Hari Ini' ?></b></h4>
                    <ul class="list-inline">
                        <?php 
                            $count = null;
                            foreach ($get_peg as $peg) { 
                                if ($peg->id_akses > 1 || $peg->id_akses > '1') {
                                $stat = null;
                                foreach ($get_available as $get) {
                                    if ($get->id_peg === $peg->id_peg) {
                                        $stat = 1;
                                    }
                                }

                                if ($stat != 1 && $peg->id_peg != 1) { $count++;
                                    if ($count < 13 ) { 
                        ?>
                                        <li>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$peg->nama ?>">
                                                <div class="user-block">
                                                    <a href="#" onclick="view_profile('<?=$peg->id_peg ?>','1');">
                                                        <img class="img-circle" src="<?php echo $peg->pic != null || $peg->pic != '' ? $peg->pic : ($peg->pic_google != '' || $peg->pic_google != null ? $peg->pic_google : base_url('assets/img/profile/avatar4.png')) ; ?>" alt="User Image">
                                                    </a>
                                                </div>
                                            </span>
                                        </li>
                        <?php } } } } if( $count > 13 ) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="More...">
                                    <div class="user-block">
                                        <a href="#"><i class="mdi mdi-more-horiz mdi-3x text-blue"></i></a>
                                    </div>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-sm-12">
                    <h4><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office (General)' : 'Dinas Kantor (Umum)' ?></b></h4>
                    <ul class="list-inline">
                        <?php $count_g = null; if(empty($get_general)) { echo '<li><p><b>No Data Available!</b></p></li>'; } else { foreach ($get_general as $get) { $count_g++; ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$get->nama ?>">
                                    <div class="user-block">
                                        <a href="#" onclick="view_profile('<?=$get->id_general ?>','2');">
                                            <img class="img-circle" src="<?php echo $get->pic != null || $get->pic != '' ? $get->pic : $get->pic_google ; ?>" alt="User Image">
                                        </a>
                                    </div>
                                </span>
                            </li>
                        <?php } } if( $count > 13 ) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="More...">
                                    <div class="user-block">
                                        <a href="#"><i class="mdi mdi-more-horiz mdi-3x text-maroon"></i></a>
                                    </div>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-sm-12">
                    <h4><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Leave the office (Research)' : 'Dinas Kantor (Riset)' ?></b></h4>
                    <ul class="list-inline">
                        <?php if(empty($get_research)) { echo '<li><p><b>No Data Available!</b></p></li>'; } else { foreach ($get_research as $get) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$get->nama ?>">
                                    <div class="user-block">
                                        <a href="#" onclick="view_profile('<?=$get->id_research ?>','3');">
                                            <img class="img-circle" src="<?php echo $get->pic != null || $get->pic != '' ? $get->pic : $get->pic_google ; ?>" alt="User Image">
                                        </a>
                                    </div>
                                </span>
                            </li>
                        <?php } } if( $count > 13 ) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="More...">
                                    <div class="user-block">
                                        <a href="#"><i class="mdi mdi-more-horiz mdi-3x text-maroon"></i></a>
                                    </div>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-sm-12">
                    <h4><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Leave' : 'Cuti' ?></b></h4>
                    <ul class="list-inline">
                        <?php 
                            if(empty($get_cuti)) { 
                                echo '<li><p><b>No Data Available!</b></p></li>'; 
                            } else { 
                                foreach ($get_cuti as $get) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$get->nama_user ?>">
                                    <div class="user-block">
                                        <a href="#" onclick="view_profile('<?=$get->id_cuti ?>','4');">
                                            <img class="img-circle" src="<?php echo $get->pic != null || $get->pic != '' ? $get->pic : $get->pic_google ; ?>" alt="User Image">
                                        </a>
                                    </div>
                                </span>
                            </li>
                        <?php } } if( $count > 13 ) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="More...">
                                    <div class="user-block">
                                        <a href="#"><i class="mdi mdi-more-horiz mdi-3x text-maroon"></i></a>
                                    </div>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-sm-12">
                    <h4><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Overtime' : 'Lembur' ?></b></h4>
                    <ul class="list-inline">
                        <?php if(empty($get_overtime)) { echo '<li><p><b>No Data Available!</b></p></li>'; } else { foreach ($get_overtime as $get) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?=$get->nama_user ?>">
                                    <div class="user-block">
                                        <a href="#" onclick="view_profile('<?=$get->id_overtime ?>','5');">
                                            <img class="img-circle" src="<?php echo $get->pic != null || $get->pic != '' ? $get->pic : $get->pic_google ; ?>" alt="User Image">
                                        </a>
                                    </div>
                                </span>
                            </li>
                        <?php } } if( $count > 13 ) { ?>
                            <li>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="More...">
                                    <div class="user-block">
                                        <a href="#"><i class="mdi mdi-more-horiz mdi-3x text-maroon"></i></a>
                                    </div>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                    <img class="img-circle" src="<?=$pics ?>" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?=$nama ?></h3>
                <h5 class="widget-user-desc"><?=$jab ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a><b class="text-maroon">Unit</b> <span class="pull-right badge bg-blue"><?=$unit ?></span></a></li>
                    <li><a><b class="text-maroon">Supervisor</b> <span class="pull-right badge bg-aqua"><?=$supervisor ?></span></a></li>
                    <li><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Birthday' : 'Tanggal Lahir' ?></b> <span class="pull-right badge bg-green"><?=$tgl_lahir?></span></a></li>
                    <li>
                        <div class="description-block"><hr>
                            <h5 class="description-header"><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'ADDRESS' : 'ALAMAT' ?></b></h5>
                            <span class="description-text"><?=$alamat?></span>
                        </div><br>
                    </li>
                </ul>
            </div>
            <div class="widget-user-header bg-blue">
                <center><h3 class=""><?php echo $this->session->bahasa === 'EN' ? 'My <b>Summary</b>' : '<b>Ringkasan</b> Saya' ?></h3></center>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><b class="text-maroon"><?=$count_research[0]->lama_hari + $count_general[0]->lama_hari ?> Days</b></h5><br>
                            <span class="description-text"><b><?php echo $this->session->bahasa === 'EN' ? 'Leave The Office' : 'Dinas Kantor' ?></b></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                        <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><b class="text-maroon"><?=$count_leave[0]->lama_hari === null || $count_leave[0]->lama_hari === '' ? '0' : $count_leave[0]->lama_hari ?> Days</b></h5><br>
                            <span class="description-text"><b><?php echo $this->session->bahasa === 'EN' ? 'Annual Leave' : 'Cuti Tahunan' ?></b></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                        <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><b class="text-maroon"><?=$count_overtime[0]->time_total === null || $count_overtime[0]->time_total === '' ? '0' : $count_overtime[0]->time_total ?> Hours</b></h5><br>
                            <span class="description-text"><b><?php echo $this->session->bahasa === 'EN' ? 'Overtime' : 'Lembur' ?></b></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
    </div>
</div>

<div id="profile_viewer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                    <h1 class="font-weight-bold" id="name"></h1>
                    <h5 class="widget-user-desc" id="jab"></h5>
                </div>
                <div class="widget-user-image" id="pic">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header font-weight-bold" id="spv"></h5><br>
                                <span class="description-text">Supervisor</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header font-weight-bold" id="div"></h5><br>
                                <span class="description-text">Unit</span>
                            </div>
                        <!-- /.description-block -->
                        </div>
                            <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header font-weight-bold" id="birthday"></h5><br>
                                <span class="description-text"><?php echo $this->session->bahasa === 'EN' ? 'Birthday' : 'Tanggal Lahir' ?></span>
                            </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer no-padding" id="leave_information">
                    <ul class="nav nav-stacked">
                        <li id="a"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Type Of Leave' : 'Tipe Cuti/Dinas' ?></b> <span class="pull-right badge bg-blue" id="type"></span></a></li>
                        <li id="b"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Start Date' : 'Tanggal Mulai' ?></b> <span class="pull-right badge bg-green" id="s_date"></span></a></li>
                        <li id="c"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Date' : 'Tanggal' ?></b> <span class="pull-right badge bg-green" id="date_overtime"></span></a></li>
                        <li id="d"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Day Length' : 'Lama Hari' ?></b> <span class="pull-right badge bg-orange" id="day_count"></span></a></li>
                        <li id="e"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'End Date' : 'Tanggal Berakhir' ?></b> <span class="pull-right badge bg-red" id="n_date"></span></a></li>
                        <li id="f"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'From' : 'Dari' ?></b> <span class="pull-right badge bg-red" id="from"></span></a></li>
                        <li id="g"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'To' : 'Sampai' ?>To</b> <span class="pull-right badge bg-red" id="to"></span></a></li>
                        <li id="h"><a><b class="text-maroon"><?php echo $this->session->bahasa === 'EN' ? 'Time Count' : 'Perhitungan Waktu' ?></b> <span class="pull-right badge bg-red" id="time_count"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->session->bahasa === 'EN' ? 'Close' : 'Tutup' ?></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var today = moment().format('YYYY-MM-DD');
        $('#date_tmp').text(today);

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()
    });

    function date ($req) {
        var token = '<?php echo $this->session->token; ?>';
        let date = moment($('#date_tmp').text()).format('YYYY-MM-DD');
        let tmp  = null;
        var html = null;

        if ($req === '1') {
            tmp = moment(date).add(1, 'days').format('YYYY-MM-DD');
        } else {
            tmp = moment(date).subtract(1, 'days').format('YYYY-MM-DD');
        }

        $('#date_tmp').text(tmp);
        // $("#leave_content").html('<h1>test</h1>');

        $.ajax({
            type : 'POST', 
            url  : base_url() + '/crud/home/search', 
            data : { 'date' : tmp},
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", token);
            },
            success: function(ress){
                // var ress = JSON.parse(ress);
                // html = ress;
                // alert(html);
                $("#leave_content").html(ress)
                // alert(ress);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toast(0 , "Error :", errorThrown);
            }
        });

        // $('#date_tmp').text(tmp);
    }

    function view_profile (id, req) {
        var token = '<?php echo $this->session->token; ?>';

        if ( req === '1' ) {
            $.ajax({ 
                type : 'POST', 
                url  : base_url() + '/crud/home/peg', 
                data : { 'id' : id },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function(ress){
                    var data = JSON.parse(ress);

                    $('#leave_information').hide();
                    $('#name').text(data.name);
                    $('#jab').text(data.jab);
                    $('#div').text(data.unit);
                    $('#spv').text(data.supervisor);
                    $('#birthday').text(data.tgl_lahir);
                    $('#pic').html('<img class="img-circle" src="'+data.pics+'" alt="User Avatar">');
                    // $("#imagePreview").css("background-image", "url("+data.pics+")");
                    $('#profile_viewer').modal('show');
                    // alert(JSON.stringify(data));
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                }
            });
        } else {
            $.ajax({
                type : 'POST', 
                url  : base_url() + '/crud/home/peg_leave', 
                data : { 'id' : id, 'req' : req},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function(data){
                    var data = JSON.parse(data);

                    if( req === '5') {

                        $('#a').hide();
                        $('#b').hide();
                        $('#d').hide();
                        $('#e').hide();
                        $('#name').text(data.name);
                        $('#jab').text(data.jab);
                        $('#div').text(data.unit);
                        $('#spv').text(data.supervisor);
                        $('#birthday').text(data.tgl_lahir);
                        $('#date_overtime').text(moment(data.date).format('DD MMMM YYYY'));
                        $('#from').text(data.from);
                        $('#to').text(data.to);
                        $('#time_count').text(data.time_count);
                        $('#pic').html('<img class="img-circle" src="'+data.pics+'" alt="User Avatar">');
                        
                        $('#profile_viewer').modal('show');
                    } else {
                        $('#h').hide();
                        $('#g').hide();
                        $('#f').hide();
                        $('#c').hide();
                        $('#name').text(data.name);
                        $('#jab').text(data.jab);
                        $('#div').text(data.unit);
                        $('#spv').text(data.supervisor);
                        $('#birthday').text(data.tgl_lahir);
                        $('#day_count').text(data.count_day + ' <?php echo $this->session->bahasa === 'EN' ? 'days' : 'hari' ?>');
                        $('#s_date').text(moment(data.start_date).format('DD MMMM YYYY'));
                        $('#n_date').text(moment(data.end_date).format('DD MMMM YYYY'));
                        $('#type').text(data.type);
                        $('#pic').html('<img class="img-circle" src="'+data.pics+'" alt="User Avatar">');
                        
                        $('#leave_information').show();
                        $('#profile_viewer').modal('show');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toast(0 , "Error :", errorThrown);
                }
            });
        }
        
    }
</script>
<?php } else {  echo "<script type='text/javascript'>window.location.reload();</script>"; } ?>