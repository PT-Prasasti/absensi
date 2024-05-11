<?php include '../layout/header.php'; ?>
            
    <div class="main-content container-fluid">
        <section class="section">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-12 mb-2">
                                <span>Filter</span>
                            </div>
                            <div class="col-md-6 row d-flex align-items-center">
                                <div class="col-md-4">
                                    <input type="date" name="start" id="start" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <span>to</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="end" id="end" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button onclick="cari()" class="btn btn-primary">cari</button>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">List Absen <?php echo date('d / M / y');?></h4>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Jam Masuk</th>
                                            <th class="text-center">Jam Pulang</th>
                                            <th class="text-center">Keterlambatan</th>
                                            <th class="text-center">Jam Kerja</th>
                                            <th class="text-center"><i data-feather="aperture"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query ="SELECT absen.nip,absen.tgl,absen.foto_in,absen.foto_out,karyawan.nama,karyawan.telepon,absen.waktu_in AS masuk,absen.waktu_out AS keluar FROM absen JOIN karyawan ON absen.nip=karyawan.nip WHERE absen.tgl=CURRENT_DATE";
                                            $hasil = mysqli_query($koneksi, $query);
                                            $no=0;
                                            while($data = mysqli_fetch_array($hasil))
                                            {
                                                $jam = 0;
                                                $telat=0;
                                                $start = strtotime($data['masuk']);
                                                $end = strtotime($data['keluar']);
                                                $hours = ($end - $start) / 3600;
                                                if ($hours - floor($hours) >= 0.5) {
                                                    $jam += ceil($hours);
                                                } else {
                                                    $jam += round($hours);
                                                }
                                                $tgl=$data['tgl'];
                                                $strt= strtotime($tgl . ' 08:00:00');
                                                $en = strtotime($data['masuk']);
                                                $menit = ($en - $strt) / 60;
                                                if ($menit - floor($menit) >= 0.5) {
                                                    $telat += ceil($menit);
                                                } else {
                                                    $telat += round($menit);
                                                }
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $data['nip'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td class="text-center">
                                                <span class="<?= ($telat > 0) ? 'badge bg-danger' : '' ?>"><?= Date('H:i', $start) ?></span>
                                            </td>
                                            <td class="text-center"><?= isset($data['keluar']) ? Date('H:i', $end) : '-' ?></td>
                                            <td class="text-center"><?= ($telat > 0) ? $telat : '0' ?> Menit</td>
                                            <td class="text-center"><?= ($jam > 0) ? $jam : '0' ?> Jam</td>
                                            <td class="text-center">
                                                <button type="button" onclick="foto(`<?= $data['foto_in'] ?>`, `in`)" class="btn icon btn-success" data-toggle="modal" data-target="#exampleModal">
                                                    <i data-feather="log-in" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" onclick="foto(`<?= $data['foto_out']?>`, `out`)" class="btn icon btn-danger" data-toggle="modal" data-target="#exampleModal">
                                                    <i data-feather="log-out" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                                $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Presensi</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="d-flex justify-content-center">
                        <img id="foto" class="w-100">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function foto(id, cond) {
    if(cond == 'in'){
        document.querySelector('#exampleModalLabel').innerHTML = '';
        document.querySelector('#exampleModalLabel').innerHTML = 'Foto Absensi Masuk';
        document.querySelector("#foto").src = '../absensi/in/'+id;
    }else{
        document.querySelector('#exampleModalLabel').innerHTML = '';
        document.querySelector('#exampleModalLabel').innerHTML = 'Foto Absensi Keluar';
        document.querySelector("#foto").src = '../absensi/out/'+id;
    }
   
}
</script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  var labels = new Array()
  var data = new Array()

  $.get("data.php", function(response) {
        var json = JSON.parse(response)
        $.each(json.karyawan, function(index, value) {
            labels.push(value)
        })
        $.each(json.kerja, function(index, value) {
            data.push(value)
        })
        chart(labels, data)
  })

  function cari() {
    var start = $('input[name=start]').val()
    var end = $('input[name=end]').val()
    if(start === ""){
        alert('Isi tanggal awal dahulu')
    } else {
        if(end === ""){
            alert('Isi tanggal akhir dahulu')
        }
    }
    $.get("data.php?start="+start+"&end="+end, function(response) {
        var json = JSON.parse(response)
        $.each(json.karyawan, function(index, value) {
            labels.push(value)
        })
        $.each(json.kerja, function(index, value) {
            data.push(value)
        })
        chart(labels, data)
    })
  }

  function chart(labels, data) {
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: labels,
        datasets: [{
            label: 'Kekurangan Jam Kerja',
            data: data,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
  }
</script>

<?php include '../layout/footer.php'; ?>