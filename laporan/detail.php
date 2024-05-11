<?php 
    include '../layout/header.php'; 
    $nip=$_GET['nip'];
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
                            <label>: <?= $data['nip'] ?></label>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label">Nama</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <label>: <?= $data['nama'] ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-3 col-3">
                            <label class="col-form-label">Jabatan / Posisi</label>
                        </div>
                        <div class="col-lg-9 col-9">
                            <label>: <?= $data['nama_jabatan'] ?></label>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-3 col-3">
                            <label class="col-form-label">Telepon</label>
                        </div>
                        <div class="col-lg-9 col-9">
                            <label>: <?= $data['telepon'] ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="table1">
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
                                            $query="SELECT absen.id,absen.nip,absen.tgl,karyawan.nama,absen.keterangan,absen.status,karyawan.telepon,jabatan.nama_jabatan,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.nip='$nip'";
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
                                                <a class="text-warning mr-1" href='form_edit.php?id=<?php echo $dt['id']; ?>'>
                                                    <i data-feather="edit" width="20"></i> 
                                                </a>
                                                <a class="text-danger ml-1" onclick="hapus('<?php echo $dt['id']; ?>')" data-toggle="modal" data-target="#modal-delete">
                                                    <i data-feather="trash" width="20"></i> 
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
                    <div class="modal fade" id="modal-delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin untuk menghapus data tersebut ???</p>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Batal</button>
                                <a id="delete" class="btn btn-outline-danger">Hapus</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
    function hapus(id){
        var hps = document.querySelector('#delete');
        hps.href = 'query_delete.php?id='+id;
    }
</script>

<?php include '../layout/footer.php'; ?>
