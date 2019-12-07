<table id="tbl_employees" class="table table-bordered table-striped">
    <thead>
        <tr class="text-blue">
            <th>Full Name</th>
            <th>Email</th>
            <th>Level</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <!-- <col width="200">
        <col width="150">
        <col width="120">
        <col width="200">
        <col width="100">
        <col width="200">
        <col width="100"> -->
    </thead>
    <tbody>
        <?php foreach ($get_peg as $get) { if ($get->id_akses != '1') { ?>
            <tr>
                <td>
                    <b class="text-maroon"><?=$get->nama ?></b>
                </td>
                <td>
                    <?=$get->email ?>
                </td>
                <td>
                    <b class="text-maroon"><?=$get->ket ?></b>
                </td>
                <td>
                    <?=$get->id_akses === '5' ? $get->nama_unit : $get->nama_div ?>
                </td>
                <td>
                    <?php $stat = $get->status > '0' ? 'Active' : 'Not Active'; ?>
                    <span class="pull-right-container">
                        <?php //if ($get->approval === '1') { $status = 'Waiting Approval'; $color = 'bg-orange'; } else if ($get->approval === '2') { $status = 'Approved'; $color = 'bg-green'; } else { $status = 'Not Approved'; $color = 'bg-red'; } ?>
                        <small class="label bg-green"><?=$stat?></small>
                    </span>
                </td>
                
                <td>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit File">
                        <a onclick="edit('<?=$get->id_peg ?>'); " class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                    </span>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete File">
                        <a onclick="del('<?=$get->id_peg ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                    </span>
                </td>
            </tr>
        <?php } } ?>
    </tbody>
    <tfoot>
        <tr class="text-blue">
            <th>Full Name</th>
            <th>Email</th>
            <th>Level</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Action</th>
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
        $('#tbl_employees').DataTable({
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