<?php
date_default_timezone_set('Asia/Jakarta');
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "absensi-native-eprass";
$koneksi = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
 
if(!$koneksi){
die ("Koneksi database gagal: ".mysqli_connect_errno().
" - ".mysqli_connect_error());
}
 
 
?>