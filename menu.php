<?php
include 'koneksi.php';
session_start();
$nip = $_SESSION['nip'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Karyawan | PT. Prasasti</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class=" pt-4">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="assets/images/logo.png" height="80" class=''>
                                <p id="clock"></p>
                                <p></p>
                            </div>
                            <div class="divider">
                                <div class="divider-text text-primary"><b>PT. Prambanan Sarana Sejati</b></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="absen.php" class="btn btn-block mb-2 btn-primary"><b>- Absen -</b></a>
                                </div>
                                <div class="col-sm-12">
                                    <a href="revisi/index_user.php" class="btn btn-block mb-2 btn-success"><b>- Revisi
                                            Jam Absen -</b></a>
                                </div>
                                <div class="col-sm-12">
                                    <a href="cuti/form_add_user.php" class="btn btn-block mb-2 btn-warning"><b>-
                                            Pengajuan Cuti -</b></a>
                                </div>
                                <div class="col-sm-12">
                                    <a href="login_izin.php" class="btn btn-block mb-2 btn-info"><b>- Pengajuan Izin
                                            -</b></a>
                                </div>
                                <div class="text-white">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <a href="query_logout.php" class="btn btn-block mb-2 btn-danger"><b>- Keluar
                                            -</b></a>
                                </div>

                                <div class="divider">
                                    <div class="divider-text text-primary"><b>Daftar Absen</b></div>
                                </div>

                                <div class="col-md-12" style="font-size:10px">
                                    <div class="card">
                                        <div class="px-0 pb-0">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Tanggal</th>
                                                            <th class="text-center">Masuk</th>
                                                            <th class="text-center">Pulang</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $query = "SELECT absen.id,absen.nip,absen.tgl,absen.status,absen.keterangan,karyawan.nama,karyawan.telepon,jabatan.nama_jabatan,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.nip='$nip'";
                                                        $hasil = mysqli_query($koneksi, $query);
                                                        while ($dt = mysqli_fetch_array($hasil)) {
                                                        ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?= Date('d/m/Y', strtotime($dt['tgl'])) ?></td>
                                                                <td class="text-center"><?= Date('H:i', $start) ?></td>
                                                                <td class="text-center">
                                                                    <?= isset($dt['keluar']) ? Date('H:i', $end) : '-' ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>


</body>

</html>