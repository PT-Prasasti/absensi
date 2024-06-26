<?php include '../layout/header.php'; ?>

<div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 mt-3 mb-3">
                    <h5 class="h3 mb-0 text-gray-800">Data Master Karyawan</h5>
                </div>
                <div class="col-md-6 text-right mt-3 mb-3">
                    <a href="form_add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class=" mr-1" data-feather="plus-square"></></i> Tambah Data
                    </a>
                    <!-- <a href="" type="button" id="print-data" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-print mr-2"></i> Cetak Data
                    </a> -->
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">Nama Karyawan</th>
                                    <th class="text-center">Telepon</th>
                                    <th class="text-center">Sisa Cuti</th>
                                    <th class="text-center"><i data-feather="grid"></i> </i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query ="select * from karyawan";
                                    $hasil = mysqli_query($koneksi, $query);
                                    while($data = mysqli_fetch_array($hasil))
                                    {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $data['nip'] ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td class="text-center"><?php echo $data['telepon'] ?></td>
                                    <td class="text-center"><?php echo $data['sisa_cuti'] ?> Hari</td>
                                    <td class="text-center">
                                        <a href='form_view.php?nip=<?php echo $data['nip']; ?> '>
                                            <i data-feather="book" class="text-primary mr-1" aria-hidden="true"></i>|
                                        </a>
                                        <a href='form_edit.php?nip=<?php echo $data['nip']; ?> '>
                                            <i data-feather="edit" class="text-warning mr-1 ml-1" aria-hidden="true"></i>|
                                        </a>
                                        <a onclick="hapus('<?php echo $data['nip']; ?>')" data-toggle="modal" data-target="#modal-delete">
                                            <i data-feather="trash-2" class=" ml-1 text-danger" aria-hidden="true"></i>
                                        </a>  
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin untuk menghapus data tersebut ???</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Batal</button>
            <a id="delete" class="btn btn-outline-danger">Hapus</a>
        </div>
        </div>
    </div>
</div>

<script>
    function hapus(id){
        var hps = document.querySelector('#delete');
        hps.href = 'query_delete.php?nip='+id;
    }
</script>

<script>
    document.querySelector('#print-data').addEventListener('click', function(){
        window.open('print_data.php')
    })
</script>

<?php include '../layout/footer.php'; ?>