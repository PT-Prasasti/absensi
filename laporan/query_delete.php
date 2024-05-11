<?php
include '../koneksi.php';
 
$id   = $_GET['id'];
$query="DELETE from absen where id='$id'";
mysqli_query($koneksi, $query);


echo "<script>alert('Data Berhasil di Hapus');window.location='../dashboard/index.php'</script>";
?>