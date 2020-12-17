<?php session_start(); ?>
<html>
<head>
    <title>Form Login Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
        function validate(form)
        {
            if(form.idUser.value == "" || form.password.value == "" || form.image.value =="")
            {
                alert('Username, password, file foto tidak boleh kosong');
                return false;
            }
            else
            {
                return true;
            }

        }
    </script>
</head>
<body>
    <div class="container">
        <div class="container_admin">
        <?php
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
    <a href="log-table.php" class="btn btn-primary"><i class="fa fa-home"></i> Tabel Log</a>
    <h4 class="judul">FORM REGISTER AKUN</h4>
    <form action="registrasi.php" method="post" onsubmit="return validate(this)" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Username:</label>
            <input type="text" class="form-control" placeholder="Masukkan username" name="idUser" id="idUser">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" placeholder="Masukkan password" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary text-center">Register</button>
    </form>
    <p style="font-weight: bold;">Sudah punya akun? upload file <a href="form.php" style="color:blue">disini</a></p>
    </div>
    </div>
</body>
</html>