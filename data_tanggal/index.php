<?php include '../layout/header.php'; ?>

<div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="alert alert-warning" role="alert">
                        <h4>Input Tanggal Merah</h4>
                    </div>
                    <div class="card">
                        <form action="proses.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-label">Keterangan</div>
                                    <textarea name="kegiatan" class="form-control" id="kegiatan" cols="30"
                                        rows="2"></textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="form-label">Tgl Mulai</div>
                                    <input type="datetime-local" class="form-control" name="mulai" id="mulai">
                                </div>
                                <div class="form-group mt-4">
                                    <div class="form-label">Tgl Selesai</div>
                                    <input type="datetime-local" class="form-control" name="selesai" id="selesai">
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: [ 
                        <?php 

                            //melakukan koneksi ke database
                            $koneksi    = mysqli_connect('localhost', 'root', '', 'absensi');
                            //mengambil data dari tabel jadwal
                            $data       = mysqli_query($koneksi,'select * from jadwal');
                            //melakukan looping
                            while($d = mysqli_fetch_array($data)){     
                        ?>
                        {
                            title: '<?php echo $d['kegiatan']; ?>', //menampilkan title dari tabel
                            start: '<?php echo $d['mulai']; ?>', //menampilkan tgl mulai dari tabel
                            end: '<?php echo $d['selesai']; ?>' //menampilkan tgl selesai dari tabel
                        },
                        <?php } ?>

                        ],
                    selectOverlap: function (event) {
                        return event.rendering === 'background';
                    }
                });
    
                calendar.render();
            });
        </script>





<!-- <div class="content-wrapper">
    <div class="content">   
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 mt-3 mb-3">
                    <h5 class="h3 mb-0 text-gray-800">Data Tanggal Merah</h5>
                </div>
                <div class="col-md-6 text-right mt-3 mb-3">
                    <a href="form_add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="mr-1" data-feather="plus-square"></i> Tambah Data
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center"><i data-feather="grid"></i> </i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query ="select * from tanggal";
                                    $hasil = mysqli_query($koneksi, $query);
                                    while($data = mysqli_fetch_array($hasil))
                                    {
                                ?>
                                <tr>
                                    <td hidden><?php echo $data['id'] ?></td>
                                    <td class="text-center"><?php echo $data['tanggal'] ?></td>
                                    <td class="text-center"><?php echo $data['status'] ?></td>
                                    <td><?php echo $data['keterangan'] ?></td>
                                    <td class="text-center">
                                        <a href='form_edit.php?id=<?php echo $data['id']; ?> '>
                                            <i data-feather="edit" class="mr-1 text-warning" aria-hidden="true"></i>|
                                        </a>
                                        <a onclick="hapus('<?php echo $data['id']; ?>')" data-toggle="modal" data-target="#modal-delete">
                                            <i class="ml-1 text-danger" data-feather="trash-2" aria-hidden="true"></i>
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
        hps.href = 'query_delete.php?id='+id;
    }
</script>

<script>
    document.querySelector('#print-data').addEventListener('click', function(){
        window.open('print_data.php')
    })
</script> -->

<?php include '../layout/footer.php'; ?>