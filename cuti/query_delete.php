<?php
include '../koneksi.php';
 
$kode_cuti   = $_GET['kode_cuti'];
$query="DELETE from cuti where kode_cuti='$kode_cuti'";
mysqli_query($koneksi, $query);
echo "<script>alert('Data Berhasil di Hapus');window.location='index.php'</script>";
?>