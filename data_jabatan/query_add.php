<?php
include '../koneksi.php';
 
$kode_jabatan    = $_POST['kode_jabatan'];
$nama_jabatan    = $_POST['nama_jabatan'];

$query="INSERT INTO jabatan SET  kode_jabatan='$kode_jabatan',nama_jabatan='$nama_jabatan'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>