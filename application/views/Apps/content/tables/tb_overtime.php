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
                        <?php if ($get->status === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu Persetujuan'; $color = 'bg-orange'; } else if ($get->status === '2') { $status = $this->session->bahasa === 'EN' ? 'Approved' : 'Diizinkan'; $color = 'bg-green'; } else { $status = $this->session->bahasa === 'EN' ? 'Not Approved' : 'Tidak Diizinkan'; $color = 'bg-red'; } ?>
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