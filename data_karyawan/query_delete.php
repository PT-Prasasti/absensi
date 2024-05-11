<?php
include '../koneksi.php';
 
$nip   = $_GET['nip'];
$query="DELETE from karyawan where nip='$nip'";
mysqli_query($koneksi, $query);
echo "<script>alert('Data Berhasil di Hapus');window.location='index.php'</script>";
?>