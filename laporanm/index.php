<?php include '../layout/header.php'; ?>
            
    <div class="main-content container-fluid">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Laporan Absen Karyawan Bulan <?php echo date('M'); ?></h4>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Total Jam Kerja</th>
                                            <th class="text-center">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query ="SELECT absen.nip,karyawan.nama,GROUP_CONCAT(absen.waktu_in) AS masuk,GROUP_CONCAT(absen.waktu_out) AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) GROUP BY absen.nip";
                                            $hasil = mysqli_query($koneksi, $query);
                                            while($data = mysqli_fetch_array($hasil))
                                            {
                                                $jam=0;
                                                $masuk = explode(',', $data['masuk']);
                                                $keluar = explode(',', $data['keluar']);
                                                $no=0;
                                                foreach($keluar as $item){
                                                    $start = strtotime($masuk[$no]);
                                                    $end = strtotime($keluar[$no]);
                                                    $hours = ($end - $start) / 3600;
                                                    if ($hours - floor($hours) >= 0.5) {
                                                        $jam += ceil($hours);
                                                    } else {
                                                        $jam += round($hours);
                                                    }
                                                    $no++;
                                                }
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $data['nip']; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td class="text-center"><?= ($jam > 0) ? $jam : '0'; ?> Jam</td>
                                            <td class="text-center">
                                                <a href='detail.php?nip=<?= $data['nip'] ?>' class="btn icon btn-primary">
                                                    <i data-feather="file-text"></i>
                                                </a>
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
        </section>
    </div>

<?php include '../layout/footer.php'; ?>