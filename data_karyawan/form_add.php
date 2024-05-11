<?php include '../layout/header.php'; ?>

<?php
    $query = mysqli_query($koneksi, "SELECT max(nip) as kodeMax FROM karyawan");
    $data = mysqli_fetch_array($query);
    $NIP = $data['kodeMax'];
    // $urutan = (int) substr($NIP, 3, 3);
    $urutan = (int) $NIP;
    $urutan++;
    // $huruf = "";
    // $NIP = $huruf . sprintf("%03s", $urutan);
    $NIP = sprintf("%03s", $urutan);
?>

<div class="content-wrapper">
    <div class="content"> 
        <div class="container-fluid">   
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Tambah Data Karyawan</b>
                        </div>
                        <div class="card-body">
                            <form method="post" action="query_add.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">NIP</label>
                                        <input type="text" class="form-control" name="nip" value="<?php echo $NIP ?>" readonly required placeholder="NIP">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">NIK</label>
                                        <input type="number" class="form-control" name="nik" required placeholder="NIK">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-7">
                                            <label for="" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Tgl Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="-"  selected disabled>- Pilih -</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Lain-Lain">Lain-Lain</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jabatan / Posisi</label>
                                        <select id="" class="form-control" name="kode_jabatan">
                                            <option selected disabled>- Pilih -</option>
                                            <?php
                                                    $query ="SELECT * FROM jabatan";
                                                    $hasil = mysqli_query($koneksi, $query);
                                                    while($data = mysqli_fetch_array($hasil))
                                                    {
                                                ?>
                                            <option value="<?= $data['kode_jabatan'] ?>"><?= $data['nama_jabatan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Telepon</label>
                                        <input type="number" class="form-control" name="telepon" placeholder="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tanggal Masuk Kerja</label>
                                        <input type="date" class="form-control" name="tgl_kerja" placeholder="" required>
                                    </div>


                                    <div class="mb-3">
                                    <label for="" class="form-label">Foto</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
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