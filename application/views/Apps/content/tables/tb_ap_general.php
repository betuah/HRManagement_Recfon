<table id="tbl_general" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Type of Duty' : 'Jenis Dinas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Date of Duty' : 'Tanggal Dinas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Status' : 'Status' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
        </tr>
        <col width="10">
        <col width="150">
        <col width="120">
        <col width="200">
        <col width="150">
        <col width="100">
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
                        $cuti = $this->session->bahasa === 'ID' ? $get->name_duty_type_id : $get->name_duty_type_en;
                    ?>
                    <b class="text-green"><?=$get->others_duty_type === '' || !$get->others_duty_type === null ? $cuti : $get->others_duty_type ?></b>
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
                    
                    <span class="pull-right-container">
                        <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu Persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = $this->session->bahasa === 'EN' ? 'Approved' : 'Diizinkan'; $color = 'bg-green'; } else { $status = $this->session->bahasa === 'EN' ? 'Not Approved' : 'Tidak Diizinkan'; $color = 'bg-red'; } ?>
                        <small class="label  <?=$color?>"><?=$status?></small>
                    </span>
                </td>
                <td>
                    <?php if($get->lampiran != null || $get->lampiran != '') { ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Attachment File' : 'Lihat Lampiran' ?>">
                            <a onclick="view_attch('general','<?=$get->id_general ?>');" class="btn btn-xs btn-info"><i class="mdi mdi-attach-file"></i></a>
                        </span>
                    <?php } ?>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Details' : 'Detail' ?>">
                        <a onclick="general_details('<?=$get->id_general ?>'); " class="btn btn-xs btn-info"><i class="mdi mdi-visibility"></i></a>
                    </span>
                    <?php if ($get->approval === 1 || $get->approval === '1' ) { ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Approve' : 'Menyetujui' ?>">
                            <a onclick="aproval('general','<?=$get->id_general ?>','2')" class="btn btn-xs btn-success"><i class="mdi mdi-thumb-up"></i></a>
                        </span>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Reject' : 'Menolak' ?>">
                            <a onclick="aproval('general','<?=$get->id_general ?>','0')" class="btn btn-xs btn-danger"><i class="mdi mdi-thumb-down"></i></a>
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
            <th><?php echo $this->session->bahasa === 'EN' ? 'Type of Duty' : 'Jenis Dinas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Date of Duty' : 'Tanggal Dinas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
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
        $('#tbl_general').DataTable({
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