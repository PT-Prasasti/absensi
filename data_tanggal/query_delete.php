<?php
include '../koneksi.php';
 
$id   = $_GET['id'];
$query="DELETE from tanggal where id='$id'";
mysqli_query($koneksi, $query);
echo "<script>alert('Data Berhasil di Hapus');window.location='index.php'</script>";
?>