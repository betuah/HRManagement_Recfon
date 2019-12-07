<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/components/bootstrap/css/bootstrap.min.css'); ?>">

        <title>Pengajuan Izin Cuti Dinas</title>

    </head>
    <body style="font-family: 'Titillium Web', sans-serif;">
        <center><br><br><br><br><br>
            <h4 style="font-family: 'Titillium Web', sans-serif;"><b>FORMULIR CUTI DINAS<b></h4><br><br><br><br><br>
        </center>
        
        <table class="">
            <tr>
                <td colspan="2"><b>Yang bertanda tangan di bawah ini</b></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: <?=$get_data->nama ?></td>
            </tr>
            <tr>
                <td>Posisi / Jabatan</td>
                <td>: <?=$get_akses->ket ?></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td>: <?=$get_data->nama_unit ?></td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>: <?=$get_data->nama_div ?></td>
            </tr>
        </table><br><br>

        <table class="">
            <tr>
                <td colspan="2"><b>Menyatakan untuk tidak masuk kerja atau cuti :</b></td>
            </tr>
            <tr>
                <td >Jenis cuti yang diajukan</td>
                <td >: <b><?=$get_data->name_duty_type_id ?></b></td>
            </tr>
            <tr>
                <td >Selama</td>
                <td >: <b><?=$get_data->lama_hari ?> Hari</b></td>
            </tr>
            <tr>
                <td>Pada tanggal</td>
                <?php 
                    $start      = date_create($get_data->start_date);
                    $end        = date_create($get_data->end_date);
                    $date_S     = date_format($start , "d M Y");
                    $date_n     = date_format($end , "d M Y");
                ?>
                <td>: <b><?=$date_S ?> Sampai tanggal <?=$date_n ?></b></td>
            </tr>
        </table><br><br>

        
        <table class="">
            <tr>
                <td colspan="2"><b class="text-justify">Untuk itu saya mendelegasikan tugas dan tanggung jawab saya selama tidak hadir kerja kepada :</b></td>
            </tr>
            <tr>
                <td >Nama</td>
                <td> : <?=$get_data->nama_plt ?></td>
            </tr>
            <tr>
                <td>Tugas & tanggung jawab</td>
                <td>: </td>
            </tr>
            <tr>
                <td>Tanda tangan</td>
                <td> : __________________</td>
            </tr>
        </table><br><br>

        <div class="row">
            <div class="col-xs-12">
                <table class="">
                    <tr>
                        <td><b>Demikian surat izin / keterangan ini kami buat, semoga menjadi perhatian.</b><br><br><br></td>
                    </tr>
                    <tr>
                        <td><b><?=$get_data->nama_spv ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Keputusan : Menyetujui / Tidak Menyetujui </b><br><br><br></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td colspan="2">Jakarta, 
                            <?php 
                                $tgl    = date_create($get_data->date_submission);
                                $date   = date_format($tgl , "d M Y");
                            ?>
                        <?=$date ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Hormat Kami<br><br><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td>( <?=$get_data->nama ?> )</td>
                        <td class="text-right">( <?=$get_data->nama_spv ?> )</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>