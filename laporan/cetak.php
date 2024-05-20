<?php
    include '../koneksi.php';
    $nip=$_GET['nip'];
    $qry="SELECT * FROM karyawan JOIN jabatan ON karyawan.`kode_jabatan`=jabatan.`kode_jabatan` WHERE karyawan.`nip`='$nip'";
    $result=mysqli_query($koneksi, $qry);
    $data=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CETAK LAPORAN ABSEN <?= strtoupper($data['nama']) ?> BULAN  <?= strtoupper(date('M Y')) ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
        <div class=" border-bottom border-dark py-2 mb-4">
            <div class="d-flex justify-content-center align-items-center row">
                <div class="col-md-12 text-center">
                    <img src="../assets/images/logo.png" alt="logo" width="20%">
                    <h4 style="color: #2a81eb;">PT. PRAMBANAN SARANA SEJATI</h4>

                </div>
            </div>
        </div>
        <div class="text-center">
            <h5>LAPORAN ABSEN <?= strtoupper($data['nama']) ?> BULAN  <?= strtoupper(date('M Y')) ?></h5>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-12">
            <table class="table mb-0" id="">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jam Masuk</th>
                            <th class="text-center">Jam Pulang</th>
                            <th class="text-center">Jam Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query="SELECT absen.id,absen.nip,absen.tgl,karyawan.nama,karyawan.telepon,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.nip='$nip' ORDER BY absen.tgl ASC  ";
                            $hasil=mysqli_query($koneksi, $query);
                            $no=1;
                            while($dt=mysqli_fetch_array($hasil)){
                                $jam = 0;
                                $telat=0;
                                $start = strtotime($dt['masuk']);
                                $end = strtotime($dt['keluar']);
                                $hours = ($end - $start) / 3600 - 1;
                                if ($hours - floor($hours) >= 0.5) {
                                    $jam += ceil($hours);
                                } else {
                                    $jam += round($hours);
                                }
                                $tgl=$dt['tgl'];
                                $strt= strtotime($tgl . ' 08:00:00');
                                $en = strtotime($dt['masuk']);
                                $menit = ($en - $strt) / 60;
                                if ($menit - floor($menit) >= 0.5) {
                                    $telat += ceil($menit);
                                } else {
                                    $telat += round($menit);
                                }
                        ?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td class="text-center"><?= Date('d/m/Y', strtotime($dt['tgl'])) ?></td>
                            <td class="text-center"><?= Date('H:i', $start) ?></td>
                            <td class="text-center"><?= isset($dt['keluar']) ? Date('H:i', $end) : '-' ?></td>
                            <td class="text-center"><?= ($jam > 0) ? $jam : '0' ?> Jam</td>
                        </tr>
                        <?php
                            $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <table class="table mb-0" id="">
                    <thead>
                        <tr>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query="SELECT type, SUM(lama) AS total from izin where nip='$nip' group by type";
                            $hasil=mysqli_query($koneksi, $query);
                            while($dt=mysqli_fetch_array($hasil)){
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $dt['type'] ?></td>
                            <td class="text-center"><?php echo $dt['total'] ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 row">
                
            </div>
        </div>
                

        <script>
            window.print()
        </script>

        <style type="text/css" media="print">
            @page { 
                size: portrait;
            }
        </style>
    </body>
</html>