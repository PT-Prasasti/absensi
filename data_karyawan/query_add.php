<?php
include '../koneksi.php';
 
$nip            = $_POST['nip'];
$nik            = $_POST['nik'];
$nama           = $_POST['nama'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tgl_lahir      = $_POST['tgl_lahir'];
$gender           = $_POST['gender'];
$telepon         = $_POST['telepon'];
$alamat         = $_POST['alamat'];
$kode_jabatan         = $_POST['kode_jabatan'];
$tgl_kerja         = $_POST['tgl_kerja'];
$foto           = uploadFile($nik, 'Foto', $_FILES['gambar'], 'foto/');

$query="INSERT INTO karyawan SET  nip='$nip',nik='$nik',nama='$nama',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',gender='$gender',telepon='$telepon', alamat='$alamat',kode_jabatan='$kode_jabatan',tgl_kerja='$tgl_kerja',foto='$foto'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data Berhasil di Simpan');window.location='index.php'</script>";

function uploadFile($nik, $upload, $file, $tujuan){
    $ekstensi_diperbolehkan	= array('png','jpg','pdf','jpeg');
    $namafile = $nik . $file['name'];
    $x = explode('.', $namafile);
    $ekstensi = strtolower(end($x));
    $namafile = $x[0] . date("YmdHis") . '.' . $ekstensi;
    $ukuran	= $file['size'];
    $file_tmp = $file['tmp_name'];
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
            $move = move_uploaded_file($file_tmp, $tujuan . $namafile);
            $file = $namafile;
        }else{
            echo "<script>alert('Ukuran file $upload terlalu besar'); window.location='form_add.php'</script>";
            return;
        }
    }
    return $file;
}
?>