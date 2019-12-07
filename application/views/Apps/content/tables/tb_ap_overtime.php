<table id="tbl_overtime" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Times Range' : 'Jangka Waktu' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
        </tr>
        <col width="10">
        <col width="250">
        <col width="250">
        <col width="100">
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
                <td><?=$date ?> <b class="text-maroon">(<?=$get->time_start ?> - <?=$get->time_end ?>)</b><b class="pull-right"></b><small class="label pull-right bg-purple"><?=$get->time_total ?> Hours</small></td>
                <td>
                    
                    <span class="pull-right-container">
                        <?php if ($get->status === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu Persetujuan'; $color = 'bg-orange'; } else if ($get->status === '2') { $status = $this->session->bahasa === 'EN' ? 'Approved' : 'Diizinkan'; $color = 'bg-green'; } else { $status = $this->session->bahasa === 'EN' ? 'Not Approved' : 'Tidak Diizinkan'; $color = 'bg-red'; } ?>
                        <small class="label <?=$color?>"><?=$status?></small>
                    </span>
                </td>
                <td>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                        <a onclick="overtime_details('<?=$get->id_overtime ?>'); " class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                    </span>
                    <?php if ($get->status === 1 || $get->status === '1' ) { ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                            <a onclick="aproval('overtime','<?=$get->id_overtime ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                        </span>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                            <a onclick="aproval('overtime','<?=$get->id_overtime ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
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
            <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
        </tr>
    </tfoot>
</table>

<script>

    $(function () {
        if(screen.width <= 760) {
            $('#style').removeClass('row');
        }

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()
        
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
    })
</script>