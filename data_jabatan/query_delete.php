<?php
include '../koneksi.php';
 
$kode_jabatan   = $_GET['kode_jabatan'];
$query="DELETE from jabatan where kode_jabatan='$kode_jabatan'";
mysqli_query($koneksi, $query);
echo "<script>alert('Data Berhasil di Hapus');window.location='index.php'</script>";
?>