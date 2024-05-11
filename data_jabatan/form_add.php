<?php include '../layout/header.php'; ?>

<?php
    $query = mysqli_query($koneksi, "SELECT max(kode_jabatan) as kodeMax FROM jabatan");
    $data = mysqli_fetch_array($query);
    $kodejabatan = $data['kodeMax'];
    $urutan = (int) substr($kodejabatan, 3, 3);
    $urutan++;
    $huruf = "JB-";
    $kodejabatan = $huruf . sprintf("%03s", $urutan);
?>

<div class="content-wrapper">
    <div class="content"> 
        <div class="container-fluid">   
            <div class="row">
                <div class="col-lg-2  mt-3"></div>
                <div class="col-lg-8  mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Tambah Data :</b>
                        </div>
                        <div class="card-body">
                            <form method="post" action="query_add.php">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kode Jabatan / Posisi</label>
                                    <input type="text" class="form-control" name="kode_jabatan" value="<?php echo $kodejabatan ?>" readonly required="required">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Jabatan / Posisi</label>
                                    <input type="text" class="form-control" name="nama_jabatan" placeholder="Nama Jabatan Posisi" required>
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

<?php include '../layout/footer.php'; ?>