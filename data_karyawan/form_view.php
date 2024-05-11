<?php include '../layout/header.php'; ?>

<?php
    $nip        = $_GET['nip'];
 
    $karyawan   = mysqli_query($koneksi, "select * from karyawan where nip='$nip'");
    $row        = mysqli_fetch_array($karyawan);

    $gender = array('Laki-Laki', 'Perempuan', 'Lain-Lain');
?>

<div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">   
            <div class="row ">
                <div class="col-lg-1 mt-3"></div>
                <div class="col-lg-10 mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Edit Data</b>
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
                                        <label for="" class="form-label">NIK</label>
                                        <input type="number" class="form-control" name="nik" value="<?php echo $row['nik'];?>" readonly required placeholder="NIK">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $row['nama'];?>" readonly required>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-7">
                                            <label for="" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $row['tempat_lahir'];?>" readonly required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Tgl Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $row['tgl_lahir'];?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select name="gender" class="form-control" readonly required>
                                        <?php
                                            foreach ($gender as $k){
                                                echo "<option value='$k' ";
                                                echo $row['gender']==$k?'selected="selected"':'';
                                                echo ">$k</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="4" readonly><?php echo $row['alamat'];?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jabatan / Posisi</label>
                                        <select id="" class="form-control" name="kode_jabatan" readonly>
                                            <option selected disabled>- Pilih -</option>
                                                <?php
                                                    $query ="select * from jabatan";
                                                    $hasil = mysqli_query($koneksi, $query);
                                                    while ($data = mysqli_fetch_array($hasil)) {
                                                ?>
                                            <option value="<?= $data['kode_jabatan'] ?>" <?php echo ($data['kode_jabatan'] == $row['kode_jabatan']) ? 'selected' : '' ?>><?= $data['nama_jabatan'] ?></option>

                                                <?php
                                                } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Telepon</label>
                                        <input type="number" class="form-control" name="telepon" value="<?php echo $row['telepon'];?>" readonly required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tanggal Masuk Kerja</label>
                                        <input type="date" class="form-control" name="tgl_kerja" value="<?php echo $row['tgl_kerja'];?>" readonly placeholder="" required>
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <img src="foto/<?php echo $row['foto'] ?>" alt="" >
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