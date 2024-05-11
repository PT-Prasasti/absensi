<?php 
    include '../layout/header_user.php'; 
    $id        = $_GET['id'];
 
    $absen      = mysqli_query($koneksi, "SELECT * FROM absen JOIN karyawan ON absen.`nip`=karyawan.`nip` JOIN jabatan ON karyawan.`kode_jabatan`=jabatan.`kode_jabatan` WHERE id='$id'");
    $row        = mysqli_fetch_array($absen);
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
                            <div class="divider-text text-primary"><b>Revisi Jam Absen</b></div>
                        </div>
                        <h4 class="text-white"><?php echo $row['tgl'];?></h4>
                    </div>
                    <form action="query_edit_user.php" method="POST">
                        <div class="form-group position-relative has-icon-left" hidden>
                            <div class="position-relative">
                                <input type="text" name="id" class="form-control" value="<?php echo $row['id'];?>">
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="text" name="waktu_in" class="form-control" value="<?php echo $row['waktu_in'];?>">
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="text" name="waktu_out" class="form-control" placeholder="YYYY-MM-DD 00:00:00">
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
                            </div>
                        </div>
                        <div class="mb-3" hidden>
                            <label for="" class="form-label">ID</label>
                            <input type="text" class="form-control" name="tgl" value="<?php echo $row['tgl'];?>" readonly required>
                            <input type="text" class="form-control" name="foto_in" value="<?php echo $row['foto_in'];?>" readonly required>
                            <input type="text" class="form-control" name="foto_out" value="<?php echo $row['foto_out'];?>" readonly required>
                            <input type="text" class="form-control" name="telepon" placeholder="telepon" value="<?php echo $row['telepon'];?>" required readonly>
                            <input type="text" class="form-control" name="nama_jabatan" placeholder="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>" required readonly>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $row['nama'];?>" required readonly>
                            <input type="text" class="form-control" name="nip" value="<?php echo $row['nip'];?>" readonly required>
                        </div>
                        <div class="clearfix mt-5">
                            <button type="submit" class="btn btn-block btn-success float-right"><b>- SIMPAN -</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include '../layout/footer_user.php'; ?>
