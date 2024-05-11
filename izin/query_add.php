<?php
include '../koneksi.php';

$kode_izin          = $_POST['kode_izin'];
$nip                = $_POST['nip'];
$tanggal_mulai      = $_POST['tanggal_mulai'];
$tanggal_akhir      = $_POST['tanggal_akhir'];
$lama               = $_POST['lama'];
$keterangan         = $_POST['keterangan'];
$alasan             = $_POST['type'];
// $bukti_sakit        = $_POST['bukti_sakit'];
$status             = 'On Progress';

// // Check if file is uploaded
// if ($bukti_sakit['error'] === UPLOAD_ERR_OK) {

//     // Generate a unique filename for the uploaded file
//     $filename = uniqid() . '.' . $bukti_sakit['name'];

//     // Move the uploaded file to the "bukti_sakit" directory
//     move_uploaded_file($bukti_sakit['tmp_name'], '../bukti_sakit/' . $filename);

//     // Update the "bukti_sakit" field with the filename
//     $bukti_sakit = $filename;
// }

// Insert data into "izin" table
$query = "INSERT INTO izin SET kode_izin='$kode_izin', nip='$nip', tanggal_mulai='$tanggal_mulai', tanggal_akhir='$tanggal_akhir', lama='$lama', keterangan='$keterangan', type='$alasan', status='$status'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Pengajuan Izin Terkirim');window.location='index.php?nip=$nip'</script>";
?>
