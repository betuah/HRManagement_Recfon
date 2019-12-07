<table id="tbl_research" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Submission Date' : 'Tanggal Pengajuan' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Full Name' : 'Nama Lengkap' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Date Of Research' : 'Tanggal Riset' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Approver' : 'Penyetuju' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Action' : 'Aksi' ?></th>
        </tr>
        <col width="10">
        <col width="150">
        <col width="120">
        <col width="200">
        <col width="100">
        <col width="200">
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
                        $cuti = $this->session->bahasa === 'ID' ? $get->type_research_id : $get->type_research_en;
                    ?>
                    <b class="text-green"><?=$get->jenis_keg_lain === '' || !$get->jenis_keg_lain === null ? $cuti : $get->jenis_keg_lain ?></b>
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
                    <b class="text-maroon"><?=$get->nama_spv ?></b>
                    <span class="pull-right-container">
                        <?php if ($get->approval === '1') { $status = $this->session->bahasa === 'EN' ? 'Waiting Approval' : 'Menunggu Persetujuan'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = $this->session->bahasa === 'EN' ? 'Approved' : 'Diizinkan'; $color = 'bg-green'; } else { $status = $this->session->bahasa === 'EN' ? 'Not Approved' : 'Tidak Diizinkan'; $color = 'bg-red'; } ?>
                        <small class="label pull-right <?=$color?>"><?=$status?></small>
                    </span>
                </td>
                <td>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Print Submission' : 'Cetak Pengajuan' ?>">
                        <a href="<?php $url = 'pdf_gen/report/research/'.$get->id_research.'/'; echo base_url($url.$this->session->token)?>" target="_blank" class="btn btn-xs btn-info"><i class="mdi mdi-print"></i></a>
                    </span>
                    <?php if ($get->approval === '1') { ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Edit Data' : 'Ubah Data' ?>">
                            <a onclick="edit('<?=$get->id_research ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                        </span>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'Delete Data' : 'Hapus Data' ?>">
                            <a onclick="del('<?=$get->id_research ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                        </span>
                    <?php } else {  ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="<?php echo $this->session->bahasa === 'EN' ? 'View Details' : 'Lihat Detail' ?>">
                            <a onclick="view('<?=$get->id_research ?>'); " class="btn btn-xs btn-warning"><i class="mdi mdi-visibility"></i></a>
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
            <th><?php echo $this->session->bahasa === 'EN' ? 'Type Of Activity' : 'Jenis Aktifitas' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'Date Of Research' : 'Tanggal Riset' ?></th>
            <th><?php echo $this->session->bahasa === 'EN' ? 'PLT' : 'PLT' ?></th>
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
        $('#tbl_research').DataTable({
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