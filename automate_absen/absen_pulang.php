<?php
include '../koneksi.php';

$tgl = date('Y-m-d');

// Cek karyawan yang sudah absen masuk tapi belum absen pulang sampai jam 23:00
$query = "SELECT * FROM absen WHERE tgl='$tgl' AND waktu_in IS NOT NULL AND waktu_out IS NULL";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $nip = $row['nip'];
    $waktu_in = $row['waktu_in'];

    // Hitung waktu_out sebagai waktu_in + 9 jam
    $waktu_out = date('Y-m-d H:i:s', strtotime($waktu_in) + 9 * 3600);

    // Update waktu_out pada tabel absen
    $update_query = "UPDATE absen SET waktu_out='$waktu_out' WHERE nip='$nip' AND tgl='$tgl' AND waktu_out IS NULL";
    mysqli_query($koneksi, $update_query);
}

echo "<script>alert('Update absen pulang completed.');</script>";
