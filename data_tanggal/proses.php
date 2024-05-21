<?php

    $kegiatan   = $_POST['kegiatan'];
    $mulai      = $_POST['mulai'];
    $selesai    = $_POST['selesai'];

    $koneksi = mysqli_connect('localhost', 'root', '', 'absensi');

    mysqli_query($koneksi, "insert into jadwal set kegiatan='$kegiatan', mulai='$mulai', selesai='$selesai' ");
    
    header("location: index.php");

?>