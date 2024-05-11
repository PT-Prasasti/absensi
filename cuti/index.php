<?php 
    include '../layout/header_cuti.php'; 
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
                                Pengajuan Cuti
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
                                            <th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Akhir</th>
                                            <th class="text-center">Lama Cuti</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">
                                                <i data-feather="more-horizontal" width="20"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $query ="select * from cuti join karyawan on cuti.`nip`= karyawan.`nip`";
                                        $hasil = mysqli_query($koneksi, $query);
                                        while($data = mysqli_fetch_array($hasil))
                                        {
                                    ?>
                                    <tbody>
                                    
                                        <tr>
                                        
                                            <td class="text-center"><?= Date('d-m-Y', strtotime($data['tanggal_mulai'])) ?></td>
                                            <td class="text-center"><?= Date('d-m-Y', strtotime($data['tanggal_akhir'])) ?></td>
                                            <td class="text-center"><?php echo $data['lama'] ?> Hari</td>
                                            <td class=""><?php echo $data['keterangan'] ?></td>
                                            <?php
                                                if($data['status'] == 'On Progress'){
                                                    echo '<td class="text-center"><span class="badge bg-warning">On Progress</span></td>';
                                                } else if($data['status'] == 'Approve'){
                                                    echo '<td class="text-center"><span class="badge bg-success">Approve</span></td>';
                                                } else if($data['status'] == 'Declined'){
                                                    echo '<td class="text-center"><span class="badge bg-danger">Declined</span></td>';
                                                } 
                                            ?>
                                            <td class="text-center">
                                                <a class="text-danger" onclick="hapus('<?php echo $data['kode_cuti']; ?>')" data-toggle="modal" data-target="#modal-delete">
                                                    <i data-feather="trash" width="20"></i> 
                                                </a>
                                            </td>
                                            
                                        </tr>
                                    
                                    </tbody>
                                    <?php } ?>
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
                                <p>Apakah Anda yakin untuk menghapus pengajuan cuti tersebut ???</p>
                                
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
    function hapus(kode_cuti){
        var hps = document.querySelector('#delete');
        hps.href = 'query_delete.php?kode_cuti='+kode_cuti;
    }
    </script>

<?php include '../layout/footer.php'; ?>
