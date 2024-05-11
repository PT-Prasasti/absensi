<?php include '../layout/header.php'; ?>

<?php
    $kode_jabatan        = $_GET['kode_jabatan'];
 
    $jabatan   = mysqli_query($koneksi, "select * from jabatan where kode_jabatan='$kode_jabatan'");
    $row        = mysqli_fetch_array($jabatan);
?>

<div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">   
            <div class="row"> 
                <div class="col-lg-2  mt-3"></div>
                <div class="col-lg-8  mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Edit Data</b>
                        </div>
                        <div class="card-body">
                            <form method="post" action="query_edit.php"> 
                                <div class="mb-3">
                                    <label for="" class="form-label">Kode</label>
                                    <input type="text" class="form-control"  name="kode_jabatan" value="<?php echo $row['kode_jabatan'];?>" readonly required="required">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Jabatan / Posisi</label>
                                    <input type="text" class="form-control"  name="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>" required="required">
                                </div>
                                <div class="mb-3 text-right">
                                    <a href="index.php" class="btn btn-danger btn-icon-split mr-2">
                                        <span class="text">BATAL</span>
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