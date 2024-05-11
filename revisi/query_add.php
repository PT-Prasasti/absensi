<?php
include '../koneksi.php';

$nip            = $_POST['nip'];
$tgl            = $_POST['tgl'];
$keterangan     = $_POST['keterangan'];
$status         = 'Waiting for Approval';
$waktu_in       = $_POST['waktu_in'];
$waktu_out      = $_POST['waktu_out'];
$foto_in        = $_POST['foto_in'];
$foto_out        = $_POST['foto_out'];


 
$query="INSERT INTO absen SET nip='$nip',tgl='$tgl',keterangan='$keterangan',status='$status',foto_in='$foto_in',foto_out='$foto_out',waktu_out='$waktu_out', waktu_in='$waktu_in'";
mysqli_query($koneksi, $query);

// var_dump($query);
echo "<script>alert('Data Berhasil di Ubah');window.location='index.php?nip=$nip'</script>";
?>