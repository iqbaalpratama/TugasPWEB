<?php
include "koneksi.php";
session_start();
$imageFile = $_FILES['image']['tmp_name'];
$imageFileContents = file_get_contents($imageFile);
$base64_string = base64_encode($imageFileContents);
$username = $_POST['idUser'];
$password = md5($_POST["password"]);
$sql = mysqli_query($koneksi, "SELECT * FROM `user` WHERE username = '$username' and password = '$password'");
$cek = mysqli_num_rows($sql);
date_default_timezone_set('Asia/Jakarta');
// echo($cek);
// echo($username);
$image_name = "uploadFace\\".$username;

if(!$cek)
{
    $_SESSION["gagal"] = "Tidak berhasil upload file foto, silahkan cek username dan password";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=form.php">';
    exit();
}

if (!file_exists($image_name))
{
    if (!mkdir($image_name))
    {
        $m=array('msg' => "REJECTED, cant create folder");
        echo json_encode($m);
        return;
    }
}

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi)+1;
$fullName = $image_name."\\X__".$fileCount."_". date("YmdHis") .".png";
$str = explode("\\",$fullName);
$ifp = fopen($fullName, "wb");
fwrite($ifp, base64_decode($base64_string));
fclose($ifp);
if (!$ifp)
{
    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    echo json_encode($m);
    return;
}

// $command = escapeshellcmd("python checkFace.py ".$fullName);
// $output = shell_exec($command);

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);
$m = array('msg' => "Berhasil Mengirim"." total(".$fileCount.")");
echo json_encode($m);

while($row=mysqli_fetch_array($sql))
{
    $user_id = $row['id'];
}
$namafile = end($str);
$timestamp = date("Y-m-d H:i:s");
$query=mysqli_query($koneksi,"INSERT INTO log(id_user, filename, uploaded_at) VALUES('$user_id', '$namafile', '$timestamp')");
if($query)
{
    $_SESSION["sukses"] = "Upload file berhasil, silahkan cek di tabel log";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=form.php">';
    exit();
}
else{
    $_SESSION["gagal"] = "Upload file gagal";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=form.php">';
    exit();
}
$koneksi->close();
?>
