<?php

require '../vendor/autoload.php';
include '../koneksi.php';
include '../mailer.php';

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// die;
try {
    $kode_cuti     = $_POST['kode_cuti'];
    $status        = $_POST['status'];
    $nama          = $_POST['nama_karyawan'];
    $lama          = $_POST['lama'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $keterangan    = $_POST['keterangan'];
    $manager       = isset($_POST['manager']) ? $_POST['manager'] : null;

    // query
    $query = "UPDATE cuti SET status='$status' where kode_cuti='$kode_cuti'";

    if (mysqli_query($koneksi, $query)) {
        if ($status === 'Declined') {
            $queryKaryawan = "SELECT nip, sisa_cuti FROM karyawan WHERE nip = (SELECT nip FROM cuti WHERE kode_cuti = '$kode_cuti')";
            $resultKaryawan = mysqli_query($koneksi, $queryKaryawan);
            
            if ($resultKaryawan && mysqli_num_rows($resultKaryawan) > 0) {
                $rowKaryawan = mysqli_fetch_assoc($resultKaryawan);
                $nip = $rowKaryawan['nip'];
                $sisaCuti = $rowKaryawan['sisa_cuti'];

                $sisaCutiBaru = $sisaCuti + $lama;
                $queryUpdateSisaCuti = "UPDATE karyawan SET sisa_cuti = '$sisaCutiBaru' WHERE nip = '$nip'";

                if (mysqli_query($koneksi, $queryUpdateSisaCuti)) {
                    echo "<script>alert('Sisa cuti berhasil dikembalikan.');</script>";
                } else {
                    echo "<script>alert('Gagal mengembalikan sisa cuti.');</script>";
                }
            } else {
                echo "<script>alert('Data karyawan tidak ditemukan.');</script>";
            }
        } else {
            $link = 'https://absen.pt-prasasti.com/app_cuti/index.php';
            $subject = $manager ? "Pengajuan Cuti dari $nama. Segera lakukan konfirmasi. (Done)" : "Pengajuan Cuti dari $nama. Segera lakukan konfirmasi. (Approved by HOD)";
            $emailTo = $manager ? "auliarasyidalzahrawi@gmail.com" : "rosyidxorikain@gmail.com";
            $mailer = new Mailer($subject, $link, $nama, $lama, $tanggal_mulai, $tanggal_akhir, $keterangan, $alasan = 'Cuti', $context="Cuti", $emailTo);
            if ($mailer) {
                echo "<script>alert('Data Pengajuan Izin Terkirim');window.location='index.php'</script>";
            } else {
                echo "smtp gagal";
            }
        }
    } else {
        echo "<script>alert('Email notifikasi gagal terkirim!');</script>";
    }

    echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";
} catch (\Exception $e) {
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}
