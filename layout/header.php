<?php
    include '../koneksi.php';
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

</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header text-center">
                    <img src="../assets/images/logo.png" alt="" srcset="" width="80%">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="../dashboard/index.php" class='sidebar-link'>
                                <i data-feather="home" width="20"></i> 
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
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

                        <li class="sidebar-item">
                            <a href="../approve/index.php" class='sidebar-link'>
                                <i data-feather="check" width="20"></i> 
                                <span>Approval Revisi Absensi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../app_cuti/index.php" class='sidebar-link'>
                                <i data-feather="check" width="20"></i> 
                                <span>Approval Pengajuan Cuti</span>
                            </a>
                        </li>


                        <li class="sidebar-title">Menu Internal</li>
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
                        <li class="sidebar-item">
                            <a href="index.html" class='sidebar-link'>
                                <i data-feather="settings" width="20"></i> 
                                <span>Data Admin</span>
                            </a>
                        </li>
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
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Admin</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="../index.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>