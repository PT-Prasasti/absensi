<?php
include '../koneksi.php';
 
$tanggal    = $_POST['tanggal'];
$status    = $_POST['status'];
$keterangan    = $_POST['keterangan'];

$query="INSERT INTO tanggal SET  tanggal='$tanggal',status='$status',keterangan='$keterangan'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>