<?php

require '../vendor/autoload.php';
include '../koneksi.php';
include '../Mailer.php';

$kode_izin     = $_POST['kode_izin'];
$status        = $_POST['status'];
$nama          = $_POST['nama_karyawan'];
$lama          = $_POST['lama'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_akhir = $_POST['tanggal_akhir'];
$keterangan    = $_POST['keterangan'];
$manager       = isset($_POST['manager']) ? $_POST['manager'] : null;

$query = "UPDATE izin SET status='$status' where kode_izin='$kode_izin'";

try {
    if (mysqli_query($koneksi, $query)) {
        $link = 'https://absen.pt-prasasti.com/form_login_manager_izin.php';
        $subject = $manager ? "Pengajuan Izin dari $nama. Segera lakukan konfirmasi. (Done)" : "Pengajuan Izin dari $nama. Segera lakukan konfirmasi. (Approved by HOD)";
        $emailTo = $manager ? "sales@pt-prasasti.com" : "sales@pt-prasasti.com"; // MANAGER
        $emailHrd = "test@pt-prasasti.com"; // HRD
        $mailerHod = new Mailer($subject, $link, $nama, $lama, $tanggal_mulai, $tanggal_akhir, $keterangan, $alasan = 'Izin', $context="Izin", $emailTo);
        $mailerHrd = new Mailer($subject, $link, $nama, $lama, $tanggal_mulai, $tanggal_akhir, $keterangan, $alasan = 'Izin', $context="Izin", $emailHrd, true);
        if ($mailerHod && $mailerHrd) {
            echo "<script>alert('Data Pengajuan Izin Terkirim');window.location='index.php'</script>";
        } else {
            echo "smtp gagal";
        }
    } else {
        echo "<script>alert('Email notifikasi gagal terkirim!');</script>";
    }
    echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";
} catch (\Exception $th) {
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}
