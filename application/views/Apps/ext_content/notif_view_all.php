<?php foreach ($notif_all as $get) { $data = $this->session->bahasa === 'EN' ? $get->notif_en : $get->notif_id; ?>
    <?php 
        $tmp_cdate  = date("d-M-Y H:i");
        $cdate      = new DateTime($tmp_cdate);

        $date_data  = strtotime($get->timestamp);
        $tmp_date   = date("d-M-Y H:i", $date_data);
        $ntmp_date  = date("H:i - d M Y ", $date_data);
        $ndate      = new DateTime($tmp_date);

        $count      = $cdate->diff($ndate);
        $rcount     = $count->format("%R%a");

        if ($rcount < 0 ) {
            $res_date = $this->session->bahasa === 'EN' ? $count->format("%a").' days ago' : $count->format("%a").' hari yang lalu';
        } else if ($rcount == 0) {
            if ((int)$count->format("%H") < 1 ) {
                $res_date = $this->session->bahasa === 'EN' ? (int)$count->format("%I").' minutes ago' : (int)$count->format("%I").' menit yang lalu';
            } else {
                $res_date = $this->session->bahasa === 'EN' ? (int)$count->format("%H").' hours ago' : (int)$count->format("%H").' jam yang lalu';
            }
        } else {
            $res_date = 'Current datetime error.';
        }
    ?>

    <?php if($get->stat_notif === '0' ) { ?>
        <b><a href="#" onclick="read_notif('<?=$get->id_notif ?>','<?=$data ?>');" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <small class="text-muted"><?=$res_date ?></small>
                <small class="label pull-right bg-maroon"><?php echo $val = $this->session->bahasa === 'EN' ? 'New' : 'Baru'; ?></small>
            </div>
            <p class="mb-1"><?=$data ?></p>
            <small class="text-muted"><?=$ntmp_date ?></small>
        </a></b>
    <?php } else { ?>
        <a href="#" onclick="read_notif('<?=$get->id_notif ?>','<?=$data ?>');" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <small class="text-muted"><?=$res_date ?></small>
            </div>
            <p class="mb-1"><?=$data ?></p>
            <small class="text-muted"><?=$ntmp_date ?></small>
        </a>
<?php } } ?>