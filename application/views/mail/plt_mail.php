<!DOCTYPE html>
<html lang="en">
<head>
    <title>PLT Mail</title>
</head>
<body>
    <p><?=$name ?> <?=$msg ?></p><br>
    
    <?php $footer = $this->session->bahasa === 'EN' ? "Click <a href='".base_url()."' >here</a> to see more detail in HR Portal Apps SEAMEO-RECFON."  : "Klik <a href='".base_url()."' >di sini</a> untuk melihat lebih lengkap di Applikasi HR Portal SEAMEO-RECFON"; ?>
    <p><?=$footer ?></p>
</body>
</html>