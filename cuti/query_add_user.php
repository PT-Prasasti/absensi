<?php
include '../koneksi.php';

$kode_cuti          = $_POST['kode_cuti'];
$nip                = $_POST['nip'];
$tanggal_mulai      = $_POST['tanggal_mulai'];
$tanggal_akhir      = $_POST['tanggal_akhir'];
$lama               = $_POST['lama'];
$keterangan         = $_POST['keterangan'];
$status             = 'On Progress';

$querySisaCuti = "SELECT sisa_cuti FROM karyawan WHERE nip = '$nip'";
$resultSisaCuti = mysqli_query($koneksi, $querySisaCuti);
$rowSisaCuti = mysqli_fetch_assoc($resultSisaCuti);
$sisaCutiSebelumnya = $rowSisaCuti['sisa_cuti'];

if ($sisaCutiSebelumnya >= $lama) {
    $query1 = "INSERT INTO cuti SET  kode_cuti='$kode_cuti', nip='$nip', tanggal_mulai='$tanggal_mulai', tanggal_akhir='$tanggal_akhir', lama='$lama', keterangan='$keterangan', status='$status'";
    mysqli_query($koneksi, $query1);

    $query2 = "INSERT INTO app_cuti SET  kode_cuti='$kode_cuti', nip='$nip', lama='$lama', status='$status'";
    mysqli_query($koneksi, $query2);

    $query3 = "UPDATE karyawan SET sisa_cuti = sisa_cuti - $lama WHERE nip = '$nip'";
    mysqli_query($koneksi, $query3);

    echo "<script>alert('Data Pengajuan Cuti Terkirim');window.location='form_add_user.php?nip=$nip'</script>";
} else {
    echo "<script>alert('Gagal mengajukan cuti. Sisa cuti tidak mencukupi');window.location='form_add_user.php?nip=$nip'</script>";
}
?>
