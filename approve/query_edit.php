<?php
include '../koneksi.php';

$id            = $_POST['id'];
$status        = $_POST['status'];
 
$query="UPDATE absen SET status='$status' where id='$id'";
mysqli_query($koneksi, $query);
var_dump($query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>