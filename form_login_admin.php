<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if (md5($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['role'] = $row['role'];

        header("location:dashboard/index.php");
    } else {
        header("location:admin.php?pesan=gagal");
    }
} else {
    header("location:admin.php?pesan=gagal");
}
