<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="mdi mdi-add-alert mdi-lg"></i>
<span class="label label-success" id="testspan"><?=$count >= 1 ? $count : '' ?></span>
</a>
<ul class="dropdown-menu">
<li class="header"><?php echo $val = $this->session->bahasa === 'EN' ? 'You have '.$count.' new notifications' : 'Anda memiliki '.$count.' pemberitahuan baru'; ?></li>
<li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
        <?php 
            foreach ($notif as $get) { $data = $this->session->bahasa === 'EN' ? $get->notif_en : $get->notif_id; 
            
                $tmp_cdate  = date("d-M-Y H:i");
                $cdate      = new DateTime($tmp_cdate);

                $date_data  = strtotime($get->timestamp);
                $tmp_date   = date("d-M-Y H:i", $date_data);
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
            <li >
                <a href="#" onclick="read_notif('<?=$get->id_notif ?>','<?=$data ?>');" >
                    <i class="mdi mdi-event-note text-teal mdi-lg"></i> | <?php echo $this->session->bahasa === 'EN' ? '<b class="text-maroon">'.$get->notif_en.'</b>' : '<b class="text-maroon">'.$get->notif_id.'</b>' ;?><br>
                    <small class=" text-maroon"><?=$res_date ?></small>
                    <small class="pull-right text-maroon"><?php echo date("H:i | d-M-Y ", strtotime($get->timestamp)); ?></small>
                </a>
            </li>
        <?php } else { ?>
            <li >
                <a href="#" onclick="read_notif('<?=$get->id_notif ?>','<?=$data ?>');" >
                    <i class="mdi mdi-event-available text-blue mdi-lg"></i> | <?php echo $this->session->bahasa === 'EN' ? $get->notif_en : $get->notif_id ;?><br>
                    <small class=" text-maroon"><?=$res_date ?></small>
                    <small class="pull-right text-maroon"><?php echo date("H:i | d-M-Y ", strtotime($get->timestamp)); ?></small>
                </a>
            </li>
        <?php } } ?>
    </ul>
</li>
<li class="footer"><a href="#" onclick="view_all_notif('<?=$id_peg ?>');"><b><?php echo $this->session->bahasa === 'EN' ? 'View all' : 'Lihat semua'; ?></b></a></li>
</ul>

<script>
    $("#testspan").on('DOMSubtreeModified', function () {
        alert("Span HTML is now " + $(this).html());
    });

    function toast_notif(id) {
        alert(id);
    }
</script>
