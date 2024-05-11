<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'admin' && $password == 'cp4no17' || $username == 'manager' && $password == 'manager123' || $username == 'hod' && $password == 'hod123') {
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $username;
    $_SESSION['admin'] = 'iya';
    header("location:dashboard/index.php");
} else {
    header("location:admin.php?pesan=gagal");
}
