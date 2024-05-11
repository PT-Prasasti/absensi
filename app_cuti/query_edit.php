<?php
include '../koneksi.php';

$kode_cuti            = $_POST['kode_cuti'];
$status        = $_POST['status'];
 
$query="UPDATE cuti SET status='$status' where kode_cuti='$kode_cuti'";
mysqli_query($koneksi, $query);
var_dump($query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>