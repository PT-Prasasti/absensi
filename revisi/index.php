<?php 
    include '../layout/header_revisi.php'; 
    $nip=$_SESSION['nip'];
    $qry="SELECT karyawan.nip,karyawan.nama,karyawan.telepon,jabatan.nama_jabatan FROM karyawan JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan WHERE karyawan.nip='$nip'";
    $result=mysqli_query($koneksi, $qry);
    $data=mysqli_fetch_array($result);
?>
            
    <div class="main-content container-fluid">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label">NIP</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <label>: <?= ucfirst($_SESSION['nip']) ?></label>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label">Nama</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <label>: <?= ucfirst($_SESSION['nama']) ?></label>
                            <a href="form_add.php?nip=<?= ucfirst($_SESSION['nip']) ?>'" class="btn icon icon-left btn-success ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                Tambah Absen
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jam Masuk</th>
                                            <th class="text-center">Jam Pulang</th>
                                            <th class="text-center">Keterlambatan</th>
                                            <th class="text-center">Jam Kerja</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">
                                                <i data-feather="more-horizontal" width="20"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query="SELECT absen.id,absen.nip,absen.tgl,absen.status,absen.keterangan,karyawan.nama,karyawan.telepon,jabatan.nama_jabatan,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.nip='$nip'";
                                            $hasil=mysqli_query($koneksi, $query);
                                            $no=0;
                                            while($dt=mysqli_fetch_array($hasil)){
                                                $jam = 0;
                                                $telat=0;
                                                $start = strtotime($dt['masuk']);
                                                $end = strtotime($dt['keluar']);
                                                $hours = ($end - $start) / 3600;
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
                                            <td class="text-center"><?= Date('d/m/Y', strtotime($dt['tgl'])) ?></td>
                                            <td class="text-center"><?= Date('H:i', $start) ?></td>
                                            <td class="text-center"><?= isset($dt['keluar']) ? Date('H:i', $end) : '-' ?></td>
                                            <td class="text-center"><?= ($telat > 0) ? $telat : '0' ?> Menit</td>
                                            <td class="text-center"><?= ($jam > 0) ? $jam : '0' ?> Jam</td>
                                            <td class="text-center"><?= $dt['keterangan']; ?></td>
                                            <?php
                                                if($dt['status'] == 'Waiting for Approval'){
                                                    echo '<td class="text-center"><span class="badge bg-warning">Waiting for Approval</span></td>';
                                                } else if($dt['status'] == 'Approve'){
                                                    echo '<td class="text-center"><span class="badge bg-success">Approve</span></td>';
                                                } else if($dt['status'] == 'Declined'){
                                                    echo '<td class="text-center"><span class="badge bg-danger">Declined</span></td>';
                                                } else if($dt['status'] == ''){
                                                    echo '<td class="text-center"><span class="badge bg-info">Expired</span></td>';
                                                } 
                                            ?>
                                            <td class="text-center">
                                                <a class="text-warning" href='form_edit.php?id=<?php echo $dt['id']; ?>'>
                                                    <i data-feather="edit" width="20"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $no++;
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
