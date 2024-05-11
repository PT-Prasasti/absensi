<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
        <div class="text-center mb-3">
            <img src="../assets/logo.jpg" width="10%">
            <h5><u>LAPORAN DATA KARYAWAN</u></h5>

            <div class="text-right">
                <p id="tanggalwaktu"></p>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">TEMPAT, TANGGAL LAHIR</th>
                    <th class="text-center">ZONA KERJA</th>
                    <th class="text-center">KATEGORI KLINER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    include '../koneksi.php';
                    $hasil = mysqli_query($koneksi, "SELECT * FROM karyawan");
                    while($data = mysqli_fetch_array($hasil)){
                ?>
                <tr>
                    <td class="text-center"><?php echo $no ?></td>
                    <td class="text-center"><?php echo $data['nik'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['tempat_lahir'] ?>, <?php echo $data['tgl_lahir'] ?></td>
                    <td><?php echo $data['zona'] ?></td>
                    <td><?php echo $data['kliner'] ?></td>
                </tr>
                <?php
                $no++;
                    }?>
            </tbody>
        </table>

        <script>
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
        else (a=tw.getTime());
        tw.setTime(a);
        var tahun= tw.getFullYear ();
        var hari= tw.getDay ();
        var bulan= tw.getMonth ();
        var tanggal= tw.getDate ();
        var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
        var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
        document.getElementById("tanggalwaktu").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun+" Jam " + ((tw.getHours() < 10) ? "0" : "") + tw.getHours() + ":" + ((tw.getMinutes() < 10)? "0" : "") + tw.getMinutes() + (" W.I.B ");
        </script>

        <script>
            window.print()
        </script>
    </body>
</html>