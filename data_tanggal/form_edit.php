<?php include '../layout/header.php'; ?>

<?php
    $id        = $_GET['id'];
    $tanggal   = mysqli_query($koneksi, "select * from tanggal where id='$id'");
    $row        = mysqli_fetch_array($tanggal);

    $status = array('Merah', 'Hitam');
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
                                    <label for="" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control"  name="id" value="<?php echo $row['id'];?>" readonly required="required" hidden>
                                    <input type="text" class="form-control"  name="tanggal" value="<?php echo $row['tanggal'];?>" readonly required="required">
                                </div>
                                <select name="status" class="form-control" required>
                                    <?php
                                        foreach ($status as $k){
                                            echo "<option value='$k' ";
                                            echo $row['status']==$k?'selected="selected"':'';
                                            echo ">$k</option>";
                                        }
                                    ?>
                                </select>
                                <div class="mb-3">
                                    <label for="" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control"  name="keterangan" value="<?php echo $row['keterangan'];?>">
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