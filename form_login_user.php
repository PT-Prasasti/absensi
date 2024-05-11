<?php
    include 'koneksi.php';
    session_start();

    $nip = $_POST['nip'];
    $telepon = $_POST['telepon'];
    $hasil = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip = '$nip' AND telepon = '$telepon'");
    $user = mysqli_num_rows($hasil);

    if($user > 0){
        $data = mysqli_fetch_assoc($hasil);
        $_SESSION['nip'] = $data['nip'];
        $_SESSION['nama']=$data['nama'];
        $_SESSION['telepon']=$data['telepon'];
        header("location:menu.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
?>