<?php
include '../koneksi.php';

$tgl = date('Y-m-d');
$currentTime = date('H:i:s');

// Fungsi untuk mengecek apakah hari ini adalah hari libur atau tidak
function isHoliday($koneksi, $tgl) {
    $query = "SELECT * FROM jadwal WHERE '$tgl' BETWEEN DATE(mulai) AND DATE(selesai)";
    $result = mysqli_query($koneksi, $query);
    return mysqli_num_rows($result) > 0;
}

if (!isHoliday($koneksi, $tgl) && $currentTime >= '12:00:00') {
    $query = "SELECT * FROM karyawan WHERE nip NOT IN (SELECT nip FROM absen WHERE tgl='$tgl' AND waktu_in IS NULL)";
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $nip = $row['nip'];
        
        // Generate kode izin
        $queryKode = mysqli_query($koneksi, "SELECT max(kode_izin) as kodeMax FROM izin");
        $dataKode = mysqli_fetch_array($queryKode);
        $kodeizin = $dataKode['kodeMax'];
        $urutan = (int) substr($kodeizin, 3, 3);
        $urutan++;
        $huruf = "PI-";
        $kodeizin = $huruf . sprintf("%03s", $urutan);
        
        // Tambahkan data ke tabel izin
        $insert_alpha = "INSERT INTO izin (kode_izin, nip, tanggal_mulai, tanggal_akhir, lama, keterangan, status, type) VALUES ('$kodeizin', '$nip', '$tgl', '$tgl', '1', 'Tidak Presensi Masuk Melebihi Jam 12 Siang.', 'Done', 'Alfa')";
        $query = mysqli_query($koneksi, $insert_alpha);
    }
}