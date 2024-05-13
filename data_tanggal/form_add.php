<?php include '../layout/header.php'; ?>

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
                                    <label for="" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" required="required">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="-"  selected disabled>- Pilih -</option>
                                        <option value="Merah">Merah</option>
                                        <option value="Hitam">Hitam</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan">
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