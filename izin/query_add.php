<?php
include '../koneksi.php';
include '../mailer.php';

$kode_izin          = $_POST['kode_izin'];
$nip                = $_POST['nip'];
$nama               = $_POST['nama'];
$tanggal_mulai      = $_POST['tanggal_mulai'];
$tanggal_akhir      = $_POST['tanggal_akhir'];
$lama               = $_POST['lama'];
$keterangan         = $_POST['keterangan'];
$alasan             = $_POST['type'];
$status             = 'On Progress';
$start = date('Y-m-d', strtotime($tanggal_mulai));
$end = date('Y-m-d', strtotime($tanggal_akhir));

$today = date('Y-m-d');
$threeDaysBefore = date('Y-m-d', strtotime('-3 days', strtotime($tanggal_mulai)));

if ($alasan == 'Izin') {
    if ($today < $threeDaysBefore) {
        $query = "INSERT INTO izin SET kode_izin='$kode_izin', nip='$nip', tanggal_mulai='$tanggal_mulai', tanggal_akhir='$tanggal_akhir', lama='$lama', keterangan='$keterangan', type='$alasan', status='$status', bukti_sakit=''";
        if (mysqli_query($koneksi, $query)) {
            $link = 'https://absen.pt-prasasti.com/app_izin/index.php';
            $subject = "Pengajuan Izin dari $nama. Segera lakukan konfirmasi.";
            $mailer = new Mailer($subject, $link, $nama, $lama, $start, $end, $keterangan, $alasan);
            if ($mailer) {
                echo "<script>alert('Data Pengajuan Izin Terkirim');window.location='../menu.php'</script>";
            } else {
                echo "smtp gagal";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data izin. Silakan coba lagi.');window.location='../menu.php'</script>";
        }
    } else {
        echo "<script>alert('Pengajuan izin harus dilakukan minimal 3 hari sebelum tanggal mulai izin.');window.location='../menu.php'</script>";
    }
} else {
    // Upload file
    if (isset($_FILES['bukti_sakit'])) {
        $file_name = $_FILES['bukti_sakit']['name'];
        $file_tmp = $_FILES['bukti_sakit']['tmp_name'];
        $file_size = $_FILES['bukti_sakit']['size'];
        $file_type = $_FILES['bukti_sakit']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $upload_dir = '../bukti_sakit/';

        $new_file_name = uniqid() . '.' . $file_ext;

        if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
            $query = "INSERT INTO izin SET kode_izin='$kode_izin', nip='$nip', tanggal_mulai='$tanggal_mulai', tanggal_akhir='$tanggal_akhir', lama='$lama', keterangan='$keterangan', type='$alasan', bukti_sakit='$new_file_name', status='$status'";
            if (mysqli_query($koneksi, $query)) {
                $link = 'https://absen.pt-prasasti.com/app_izin/index.php';
                $subject = "Pengajuan Izin dari $nama. Segera lakukan konfirmasi.";
                $mailer = new Mailer($subject, $link, $nama, $lama, $start, $end, $keterangan, $alasan);
                if ($mailer) {
                    echo "<script>alert('Data Pengajuan Izin Terkirim');window.location='../menu.php'</script>";
                } else {
                    echo "smtp gagal";
                }
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan data izin sakit. Silakan coba lagi.');window.location='index.php?nip=$nip'</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');window.location='index.php?nip=$nip'</script>";
        }
    } else {
        echo "<script>alert('Berkas bukti sakit tidak terunggah.');window.location='index.php?nip=$nip'</script>";
    }
}
