<?php
    include '../koneksi.php';
    session_start();
    $role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absen | PT. Prasasti</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="../assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />

</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header text-center">
                    <img src="../assets/images/logo.png" alt="" srcset="" width="70%">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="../dashboard/index.php" class='sidebar-link'>
                                <i data-feather="home" width="20"></i> 
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Laporan</li>
                        
                        <li class="sidebar-item">
                            <a href="../laporan/index.php" class='sidebar-link'>
                                <i data-feather="file" width="20"></i> 
                                <span>Laporan Absen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../laporanm/index.php" class='sidebar-link'>
                                <i data-feather="file" width="20"></i> 
                                <span>Laporan Dokumentasi</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Menu Approval</li>
                        <!-- <li class="sidebar-item">
                            <a href="../approve/index.php" class='sidebar-link'>
                                <i data-feather="check" width="20"></i> 
                                <span>Approval Revisi Absensi</span>
                            </a>
                        </li> -->
                        <?php
                            if($_SESSION['role'] == 'hrd') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Cuti Karyawan</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_cuti/list.php">List Cuti</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                         <?php
                            if($_SESSION['role'] == 'hod') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <?php
                                $query ="SELECT COUNT(status) AS total FROM cuti WHERE status='On Progress'";
                                $hasil = mysqli_query($koneksi, $query);
                                while($data = mysqli_fetch_array($hasil))
                                {
                            ?>
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Cuti Karyawan <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_cuti/index.php">Pengajuan Cuti <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></a>
                                </li>
                                
                                <li>
                                    <a href="../app_cuti/list.php">List Cuti</a>
                                </li>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($_SESSION['role'] == 'manager') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <?php
                                $query ="SELECT COUNT(status) AS total FROM cuti WHERE status='Approve HOD'";
                                $hasil = mysqli_query($koneksi, $query);
                                while($data = mysqli_fetch_array($hasil))
                                {
                            ?>
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Cuti Karyawan <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_cuti/index.php">Pengajuan Cuti <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></a>
                                </li>
                                
                                <li>
                                    <a href="../app_cuti/list.php">List Cuti</a>
                                </li>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($_SESSION['role'] == 'hrd') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Izin Karyawan</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_izin/list.php">List Cuti</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                         <?php
                            if($_SESSION['role'] == 'hod') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <?php
                                $query ="SELECT COUNT(status) AS total FROM izin WHERE status='On Progress'";
                                $hasil = mysqli_query($koneksi, $query);
                                while($data = mysqli_fetch_array($hasil))
                                {
                            ?>
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Izin Karyawan <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_izin/index.php">Pengajuan Izin <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></a>
                                </li>
                                
                                <li>
                                    <a href="../app_izin/list.php">List Izin</a>
                                </li>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($_SESSION['role'] == 'manager') {
                        ?>
                        <li class="sidebar-item  has-sub">
                            <?php
                                $query ="SELECT COUNT(status) AS total FROM izin WHERE status='Approve HOD'";
                                $hasil = mysqli_query($koneksi, $query);
                                while($data = mysqli_fetch_array($hasil))
                                {
                            ?>
                            <a href="#" class="sidebar-link">
                                <i data-feather="check" width="20"></i>  
                                <span>Data Izin Karyawan <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../app_izin/index.php">Pengajuan Izin <span class="badge bg-danger"><b><?php echo $data['total'] ?></b></span></a>
                                </li>
                                
                                <li>
                                    <a href="../app_izin/list.php">List Izin</a>
                                </li>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                        <?php
                            }
                        ?>


                        <li class="sidebar-title">Data Internal</li>
                        <li class="sidebar-item">
                            <a href="../data_tanggal/index.php" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i> 
                                <span>Data Tanggal Merah</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../data_karyawan/index.php" class='sidebar-link'>
                                <i data-feather="users" width="20"></i> 
                                <span>Data Karyawan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../data_jabatan/index.php" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i> 
                                <span>Data Jabatan / Posisi</span>
                            </a>
                        </li>
                        
                        <!-- <li class="sidebar-item">
                            <a href="index.html" class='sidebar-link'>
                                <i data-feather="settings" width="20"></i> 
                                <span>Data Admin</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar mr-1">
                                    <img src="../assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?= ucfirst($_SESSION['role']) ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="../admin.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>