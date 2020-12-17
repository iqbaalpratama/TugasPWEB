<?php session_start(); ?>
<html>
<head>
    <title>Tabel Log</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="container">
    <div class="container_tabel">
        <?php
        include "koneksi.php";
        $query=mysqli_query($koneksi,"SELECT user.username, log.* FROM log, user WHERE user.id = log.id_user Order By log.uploaded_at ASC");
        $c=0;
        if (isset($_SESSION["sukses"]))
        {
            echo '<div class="alert alert-success alert-dismissable" id="success-alert">';
            echo '<strong>'. $_SESSION["sukses"].'</strong>';
            echo '</div>';
            unset($_SESSION["sukses"]);
        }
        if (isset($_SESSION["gagal"]))
        {
            echo '<div class="alert alert-danger alert-dismissable" id="danger-alert">';
            echo '<strong>'. $_SESSION["gagal"].'</strong>';
            echo '</div>';
            unset($_SESSION["gagal"]);
        }
        ?>
        <h4 class="judul">Tabel Log</h4>
        <div class="table-responsive">
            <table border="1" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Nomor</th>
                        <th>Username</th>
                        <th>Nama File</th>
                        <th>Waktu Upload</th>
                    </tr>
            <?php
            while($row=mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?php echo $c=$c+1;?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['filename'];?></td>
                <td><?php echo $row['uploaded_at'];?></td>
            <?php
            }
            ?>
            </table>
        </div>
        <a href="register.php" class="btn btn-success">Register</a>
        <a href="form.php" class="btn btn-primary">Upload</a>
        </div>
    </div>
<?php
$koneksi->close();
?>
</body>
</html>