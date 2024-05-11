<?php include '../layout/header_cuti.php'; ?>

<?php
    $nip=$_SESSION['nip'];
 
    $karyawan   = mysqli_query($koneksi, "SELECT * FROM karyawan join jabatan on karyawan.kode_jabatan=jabatan.kode_jabatan WHERE nip='$nip'");
    $row        = mysqli_fetch_array($karyawan);

    $query = mysqli_query($koneksi, "SELECT max(kode_izin) as kodeMax FROM izin");
    $data = mysqli_fetch_array($query);
    $kodeizin = $data['kodeMax'];
    $urutan = (int) substr($kodeizin, 3, 3);
    $urutan++;
    $huruf = "PTM-";
    $kodecuti = $huruf . sprintf("%03s", $urutan);
?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-1 mt-3"></div>
                <div class="col-lg-10 mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <b>Form Pengajuan Tidak Masuk</b>
                        </div>
                        <div class="card-body">
                            <form method="post" action="query_add.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">NIP</label>
                                            <input type="text" class="form-control" name="kode_izin"
                                                value="<?php echo $kodeizin ?>" hidden>
                                            <input type="text" class="form-control" name="nip"
                                                value="<?php echo $row['nip'];?>" readonly required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama"
                                                value="<?php echo $row['nama'];?>" required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Jabatan / Posisi</label>
                                            <input type="text" class="form-control" name="nama_jabatan"
                                                placeholder="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>"
                                                required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" placeholder="telepon"
                                                value="<?php echo $row['telepon'];?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="" class="form-label">Tanggal Cuti / Dari</label>
                                                    <input type="date" class="form-control" name="tanggal_mulai"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="" class="form-label">Tanggal Cuti / Sampai</label>
                                                    <input type="date" class="form-control" name="tanggal_akhir"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Lama Cuti</label>
                                            <input type="number" class="form-control" name="lama" placeholder="0 Hari"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" rows="5"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Alasan</label>
                                            <select name="type" id="type" class="form-select">
                                                <option value="0" disabled selected>- Pilih Alasan Izin -</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 hidden" id="container_sakit">
                                            <label for="bukti_sakit">Bukti Surat Dokter</label>
                                            <input type="file" name="bukti_sakit" id="bukti_sakit" class="form-control">
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
    const alasanSelect = document.getElementById('type');
    const buktiSakitInput = document.getElementById('bukti_sakit');
    const buktiSakitContainer = document.getElementById('container_sakit');; // Get the parent container

    alasanSelect.addEventListener('change', function () {
        const selectedValue = this.value;

        if (selectedValue === 'Sakit') {
            buktiSakitContainer.classList.remove('hidden'); // Show the container
        } else {
            buktiSakitContainer.classList.add('hidden'); // Hide the container
        }
    });
</script>

<?php include '../layout/footer.php'; ?>