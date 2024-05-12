<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Karyawan | PT. Prasasti</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/logo.png" height="80" class='mb-4'>
                        <h3 class="text-white">Silakan Masuk</h3>
                    </div>
                    <form action="form_login_user.php" method="POST">
                        <div class="form-group position-relative has-icon-left">
                            <label for="nip" class="text-white">NIP</label>
                            <div class="position-relative">
                                <input type="number" name="nip" class="form-control" id="nip">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="telepon" class="text-white">Telepon</label>
                            </div>
                            <div class="position-relative">
                                <input type="number" name="telepon" class="form-control" id="telepon">
                                <div class="form-control-icon">
                                    <i data-feather="phone"></i>
                                </div>
                            </div>
                        </div>
                    <div class="clearfix mt-5">
                        <button type="submit" class="btn btn-block btn-success float-right"><b>- SIGN IN -</b></button>
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
</body>

</html>
