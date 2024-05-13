<?php
include '../koneksi.php';

$id    = $_POST['id'];
$tanggal    = $_POST['tanggal'];
$status    = $_POST['status'];
$keterangan    = $_POST['keterangan'];
 
$query="UPDATE tanggal SET tanggal='$tanggal', status='$status', keterangan='$keterangan' where id='$id'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Ubah');window.location='index.php'</script>";
?>