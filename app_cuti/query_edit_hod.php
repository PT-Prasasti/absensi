<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../koneksi.php';

$mail = new PHPMailer(true);


$kode_cuti     = $_POST['kode_cuti'];
$status        = $_POST['status'];
 
$query="UPDATE cuti SET status='$status' where kode_cuti='$kode_cuti'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

?>