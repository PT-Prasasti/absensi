<?php
include '../koneksi.php';

$kode_izin            = $_POST['kode_izin'];
$status        = $_POST['status'];
 
$query="UPDATE izin SET status='$status' where kode_izin='$kode_izin'";
mysqli_query($koneksi, $query);
var_dump($query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>