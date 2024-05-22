<?php
include 'koneksi.php';

$nip = $_POST['nip'];
$telepon = $_POST['telepon'];
$absen = $_POST['absen'];
$time = time();
$tgl = date('Y-m-d');
$current_hour = date('H');

function isHoliday($koneksi, $tgl) {
    $query = "SELECT * FROM jadwal WHERE '$tgl' BETWEEN DATE(mulai) AND DATE(selesai)";
    $result = mysqli_query($koneksi, $query);
    return mysqli_num_rows($result) > 0;
}

$cek = "SELECT * FROM karyawan WHERE nip='$nip' AND telepon='$telepon'";
if (mysqli_num_rows(mysqli_query($koneksi, $cek)) < 1) {
    echo "<script>alert('NIP dan telepon tidak ditemukan!');window.location='absen.php'</script>";
    return;
}

if ($absen == 'in') {
    $in = "SELECT * FROM absen WHERE nip='$nip' AND tgl = CURRENT_DATE LIMIT 1";
    if (mysqli_num_rows(mysqli_query($koneksi, $in)) > 0) {
        echo "<script>alert('Anda sudah absensi masuk hari ini!');window.location='absen.php'</script>";
        return;
    }
    if (isset($_POST['photo'])) {
        $data = $_POST['photo'];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $filename = time() . '.png';
        $file_destination = 'absensi/in/' . $filename;
        file_put_contents($file_destination, $data);
    }
    $query = "INSERT INTO absen SET nip='$nip', tgl='$tgl', waktu_in=CURRENT_TIMESTAMP,foto_in='$filename'";
    mysqli_query($koneksi, $query);
} else {
    // cek durasi kerja 8 jam
    $in = "SELECT * FROM absen WHERE nip='$nip' AND waktu_in = NULL AND tgl = CURRENT_DATE LIMIT 1";
    if (mysqli_num_rows(mysqli_query($koneksi, $in)) < 0) {
        echo "<script>alert('Anda belum absensi masuk!');window.location='absen.php'</script>";
        return;
    }
    $out = "SELECT * FROM absen WHERE nip='$nip' AND waktu_out != NULL AND tgl = CURRENT_DATE LIMIT 1";
    if (mysqli_num_rows(mysqli_query($koneksi, $out)) > 0) {
        echo "<script>alert('Anda sudah absensi keluar hari ini!');window.location='absen.php'</script>";
        return;
    }
    $dt = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absen WHERE nip='$nip' AND tgl=CURRENT_DATE LIMIT 1"));
    $start = strtotime($dt['waktu_in']);
    $end = time();
    $hours = ($end - $start) / 3600;
    $jam_masuk = date('H:i:s', $start);
    if ($hours < 8) {
        echo "<script>alert('Anda masuk jam $jam_masuk, jam kerja PT. Prasasti 8 jam');window.location='absen.php'</script>";
        return;
    }
    if (isset($_POST['photo'])) {
        $data = $_POST['photo'];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $filename = time() . '.png';
        $file_destination = 'absensi/out/' . $filename;
        file_put_contents($file_destination, $data);
    }
    $query = "UPDATE absen SET waktu_out=CURRENT_TIMESTAMP,foto_out='$filename' WHERE nip='$nip' AND tgl=CURRENT_DATE";
    mysqli_query($koneksi, $query);
}

echo "<script>alert('Data Berhasil di Simpan');window.location='absen.php'</script>";
