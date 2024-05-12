<?php 
    include '../layout/header_user.php'; 
    session_start();
    $nip=$_SESSION['nip'];
?>
    <div class="col-sm-12">
        <a href="../menu.php" class="btn btn-block mb-2 btn-danger"><b>- Menu -</b></a>
    </div>
    <div class="text-center">
        <div class="divider">
            <div class="divider-text text-primary"><b>Revisi Jam Absen</b></div>
        </div>
    </div>
    <div class="col-sm-12">
        <a href="form_add_user.php" class="btn btn-block mb-2 btn-success"><b>- Tambah Absen -</b></a>
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
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query="SELECT absen.id,absen.nip,absen.tgl,absen.status,absen.keterangan,karyawan.nama,karyawan.telepon,jabatan.nama_jabatan,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.nip='$nip'";
                                $hasil=mysqli_query($koneksi, $query);
                                while($dt=mysqli_fetch_array($hasil)){
                            ?>
                            <tr>
                                <td class="text-center">
                                    <a class="text-warning" href='form_edit_user.php?id=<?php echo $dt['id']; ?>'>
                                        <span class="badge bg-warning"><?= Date('d/m/Y', strtotime($dt['tgl'])) ?></span>
                                    </a>  
                                </td>
                                <td class="text-center"><?= Date('H:i', $start) ?></td>
                                <td class="text-center"><?= isset($dt['keluar']) ? Date('H:i', $end) : '-' ?></td>
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

<?php include '../layout/footer_user.php'; ?>
