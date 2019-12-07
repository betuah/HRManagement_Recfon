<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submission Mail</title>
</head>
<body>
    <p><?=$req === 'approval' ? $nama_spv : $name ?> <?=$msg ?> </p><br>
    <table>
        <tr>
            <td><?php echo $this->session->bahasa === 'EN' ? 'Type Leave' : 'Jenis Cuti' ?></td>
            <td>: <?=$type_leave ?></td>
        </tr>
        <tr>
            <td><?php echo $this->session->bahasa === 'EN' ? 'Day Lenght' : 'Lama Hari' ?></td>
            <td>: <?=$count_day ?> <?php echo $this->session->bahasa === 'EN' ? 'Days' : 'Hari' ?></td>
        </tr>
        <tr>
            <td><?php echo $this->session->bahasa === 'EN' ? 'From Date' : 'Dari Tanggal' ?></td>
            <td>: <?=$from_date ?></td>
        </tr>
        <tr>
            <td><?php echo $this->session->bahasa === 'EN' ? 'Until Date' : 'Sampai Tanggal' ?></td>
            <td>: <?=$until_date ?></td>
        </tr>
    </table><br>
    <?php $footer = $this->session->bahasa === 'EN' ? "Click <a href='".base_url()."' >here</a> to see more detail in HR Portal Apps SEAMEO-RECFON."  : "Klik <a href='".base_url()."' >di sini</a> untuk melihat lebih lengkap di Applikasi HR Portal SEAMEO-RECFON"; ?>
    <p><?=$footer ?></p>
</body>
</html>