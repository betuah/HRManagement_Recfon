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

<script>
    $(document).ready(function(){
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>