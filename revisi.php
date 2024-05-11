<?php
    include 'koneksi.php';
    session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Karyawan | PT. Prasasti</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/logo.png" height="80" class='mb-4'>
                        <h3><?= ucfirst($_SESSION['nama']) ?></h3> 
                    </div>
                    <form action="form_login.php" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu In</label>
                            <input type="time" class="form-control" name="waktu_in">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu Out</label>
                            <input type="time" class="form-control" name="waktu_out">
                        </div>
                        
                        <div class="divider">
                            <div class="divider-text">REVISI</div>
                        </div>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-block btn-primary float-right">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
    <script>
    document.querySelector('input[type=file][name=gambar]').addEventListener('change', function() {
        var filename = document.querySelector('input[type=file][name=gambar]').files[0].name;
        document.querySelector('.custom-file-label').innerHTML = filename;
    });
    </script>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>
</body>

</html>
