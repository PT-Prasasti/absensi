<?php 
    include '../layout/header_user.php'; 
    session_start();
    $nip=$_SESSION['nip'];
 
    $karyawan   = mysqli_query($koneksi, "SELECT * FROM karyawan join jabatan on karyawan.kode_jabatan=jabatan.kode_jabatan WHERE nip='$nip'");
    $row        = mysqli_fetch_array($karyawan);

    $query = mysqli_query($koneksi, "SELECT max(kode_cuti) as kodeMax FROM cuti");
    $data = mysqli_fetch_array($query);
    $kodecuti = $data['kodeMax'];
    $urutan = (int) substr($kodecuti, 3, 3);
    $urutan++;
    $huruf = "PC-";
    $kodecuti = $huruf . sprintf("%03s", $urutan);
?>
    <div class="row">
        <div class=" col-sm-12 mx-auto">
            <div class="">
                <div class="card-body">
                    <div class="col-sm-12">
                        <a href="../menu.php" class="btn btn-block mb-2 btn-danger"><b>- Menu -</b></a>
                    </div>
                    <div class="text-center">
                        <div class="divider">
                            <div class="divider-text text-primary"><b>Pengajuan Cuti</b></div>
                        </div>
                    </div>
                    <form action="query_add_user.php" method="POST">
                        <h5 class="text-white">Saldo Cuti : <?php echo $row['sisa_cuti'];?></h5>
                        <div class="form-group position-relative has-icon-left">
                            <label for="" class="form-label text-white">Tanggal Cuti / Dari - Sampai</label>
                            <div class="position-relative row">
                                <div class="col-sm-12 mb-2">
                                    <input type="date" name="tanggal_mulai" class="form-control">
                                </div>
                                <div class="col-sm-12">
                                    <input type="date" name="tanggal_akhir" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="number" name="lama" class="form-control" placeholder="0 Hari" required>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
                            </div>
                        </div>
                        <div class="mb-3" hidden>
                            <input type="text" class="form-control" name="foto_in" value="<?php echo $row['foto_in'];?>" readonly required>
                            <input type="text" class="form-control" name="foto_out" value="<?php echo $row['foto_out'];?>" readonly required>
                            <input type="text" class="form-control" name="telepon" placeholder="telepon" value="<?php echo $row['telepon'];?>" required readonly>
                            <input type="text" class="form-control" name="nama_jabatan" placeholder="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>" required readonly>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $row['nama'];?>" required readonly>
                            <input type="text" class="form-control" name="nip" value="<?php echo $row['nip'];?>" readonly required>
                            <input type="text" class="form-control" name="kode_cuti" value="<?php echo $kodecuti ?>">
                        </div>
                        
                        <div class="clearfix mt-3 mb-3">
                            <button type="submit" class="btn btn-block btn-success float-right"><b>- SIMPAN -</b></button>
                        </div>
                    </form>

                    <div class="text-center">
                        <div class="divider">
                            <div class="divider-text text-primary"><b>Daftar Cuti</b></div>
                        </div>
                    </div>
                    <div class="col-md-12" style="font-size:10px">
                        <div class="card">
                            <div class="px-0 pb-0">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Lama</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query ="select * from cuti join karyawan on cuti.`nip`= karyawan.`nip` WHERE cuti.`nip` = '$nip'";
                                                $hasil = mysqli_query($koneksi, $query);
                                                while($data = mysqli_fetch_array($hasil))
                                                {
                                            ?>
                                            <tbody>
                                    
                                                <tr>
                                                
                                                    <td class="text-center"><?= Date('d-m-Y', strtotime($data['tanggal_mulai'])) ?></td>
                                                    <td class="text-center"><?php echo $data['lama'] ?></td>
                                                    <?php
                                                        if($data['status'] == 'On Progress'){
                                                            echo '<td class="text-center"><span class="badge bg-warning">On Progress</span></td>';
                                                        } else if($data['status'] == 'Approve HOD'){
                                                            echo '<td class="text-center"><span class="badge bg-success">Approve HOD</span></td>';
                                                        } else if($data['status'] == 'Approve Manager'){
                                                            echo '<td class="text-center"><span class="badge bg-success">Done</span></td>';
                                                        } else if($data['status'] == 'Declined'){
                                                            echo '<td class="text-center"><span class="badge bg-danger">Declined</span></td>';
                                                        } 
                                                    ?>
                                                    
                                                </tr>
                                            
                                            </tbody>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../layout/footer_user.php'; ?>
