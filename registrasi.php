<?php
session_start();
?>
<?php
include 'koneksi.php';
$username=$_POST['idUser'];
$password=md5($_POST['password']);
$query=mysqli_query($koneksi,"INSERT INTO user(username, password) VALUES('$username','$password')");
if($query)
{
    $_SESSION["sukses"] = "Akun berhasil ditambahkan";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=register.php">';
    exit();
}
else{
    $_SESSION["gagal"] = "Akun gagal ditambahkan";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=register.php">';
    exit();
}
$koneksi->close();
?>