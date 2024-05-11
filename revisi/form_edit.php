<?php include '../layout/header_revisi.php'; ?>

<?php
    $id        = $_GET['id'];
 
    $absen      = mysqli_query($koneksi, "SELECT * FROM absen JOIN karyawan ON absen.`nip`=karyawan.`nip` JOIN jabatan ON karyawan.`kode_jabatan`=jabatan.`kode_jabatan` WHERE id='$id'");
    $row        = mysqli_fetch_array($absen);

?>

<div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">   
            <div class="row ">
                <div class="col-lg-1 mt-3"></div>
                <div class="col-lg-10 mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Edit Data Absen</b>
                        </div>
                        <div class="card-body">
                            <form method="post" action="query_edit.php" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">NIP</label>
                                            <input type="text" class="form-control" name="nip" value="<?php echo $row['nip'];?>" readonly required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $row['nama'];?>" required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Jabatan / Posisi</label>
                                            <input type="text" class="form-control" name="nama_jabatan" placeholder="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>" required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" placeholder="telepon" value="<?php echo $row['telepon'];?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ID</label>
                                            <input type="text" class="form-control" name="id" value="<?php echo $row['id'];?>" readonly required>
                                        </div>
                                        <div class="mb-3" hidden>
                                            <label for="" class="form-label">ID</label>
                                            <input type="text" class="form-control" name="tgl" value="<?php echo $row['tgl'];?>" readonly required>
                                            <input type="text" class="form-control" name="foto_in" value="<?php echo $row['foto_in'];?>" readonly required>
                                            <input type="text" class="form-control" name="foto_out" value="<?php echo $row['foto_out'];?>" readonly required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Waktu In</label>
                                            <input type="text" class="form-control" name="waktu_in" placeholder="YYYY-MM-DD 00:00:00" value="<?php echo $row['waktu_in'];?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Waktu Out</label>
                                            <input type="text" class="form-control" name="waktu_out" placeholder="YYYY-MM-DD 00:00:00" value="<?php echo $row['waktu_out'];?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
                                        </div>
                                    </div>
                                </div>
                            
                            
                            
                           
                                <div class="mb-3 text-right">
                                    <a href="index.php" class="btn btn-danger btn-icon-split mr-2">
                                        <span class="text">KEMBALI</span>
                                    </a>
                                    <button type="submit" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-floppy-disk"></i>
                                        </span>
                                        <span class="text">SIMPAN</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[type=file][name=gambar]').addEventListener('change', function() {
        var filename = document.querySelector('input[type=file][name=gambar]').files[0].name;
        document.querySelector('.custom-file-label').innerHTML = filename;
    });
</script>

<?php include '../layout/footer.php'; ?>