<?php
require 'config.php';
require 'common.php';

if (isset($_POST['submit'])) {

   // apakah fungsi registrasi user berhasil?
   // kembalikan nilai lebih dari 0 untuk mengujinya / karena untuk menunjukkan data di tabel terpengaruh / data bertambah
   if (registrasi($_POST) > 0) {
      $username = $_POST['username'];

      echo "<script>
               alert('Pendaftaran Berhasil. Selamat Bergabung $username')
               document.location.href = 'login.php'
            </script>";
   } else {
      echo mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrasi</title>
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

   <h1>Registrasi User</h1>

   <form action="" method="POST">
      <label for="username">Username :</label>
      <input type="text" id="username" name="username">

      <label for="password">Password :</label>
      <input type="password" id="password" name="password">

      <br>

      <label for="confirm-pass">Konfirmasi Password :</label>
      <input type="password" id="confirm-pass" name="confirm-pass">

      <br>

      <button type="submit" name="submit" style="width: 100%">Registrasi</button>

      <p>
         Sudah Punya Akun?<a href="login.php">Login</a>
      </p>
   </form>
</body>

</html>