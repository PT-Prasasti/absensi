<?php
include '../koneksi.php';

$kode_jabatan    = $_POST['kode_jabatan'];
$nama_jabatan    = $_POST['nama_jabatan'];
 
$query="UPDATE jabatan SET nama_jabatan='$nama_jabatan' where kode_jabatan='$kode_jabatan'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Ubah');window.location='index.php'</script>";
?>