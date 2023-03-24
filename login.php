<?php
session_start();
require 'config.php';
require 'common.php';

// cek cookie
if (isset($_COOKIE['id']) && $_COOKIE['username']) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   // ambil username berdasarkan id
   $sql = "SELECT username FROM user WHERE id = $id";
   $query = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($query);

   if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
   }
}

if (isset($_SESSION["login"])) {
   header("Location: index.php");
   exit;
}

if (isset($_POST['submit'])) {
   global $conn;

   // tangkap input user
   $username = $_POST['username'];
   $password = $_POST['password'];

   // cek apakah data yg diinput oleh user ada di db
   $sql = "SELECT * FROM user WHERE username = '$username'";
   $query = mysqli_query($conn, $sql);

   if (mysqli_num_rows($query) === 1) {
      // cek password
      $row = mysqli_fetch_assoc($query);

      // $verify = password_verify($password, $row["password"]);
      if (password_verify($password, $row["password"])) {
         // set session
         $_SESSION["login"] = true;
         $_SESSION["admin"] = $row["username"];

         // cek remember me
         if (isset($_POST['remember'])) {
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username'], time() + 60));
         }

         header("Location: index.php");
         exit;
      }
   }

   $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Login</title>
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   <h1>Halaman Login</h1>

   <form action="" method="POST">
      <label for="username">Username :</label>
      <input type="text" id="username" name="username">

      <label for="password">Password :</label>
      <input type="password" id="password" name="password">

      <br>

      <input type="checkbox" name="remember" id="remember"> Remember me

      <br>

      <button type="submit" name="submit" style="width: 100%">Login</button>

      <p>Belum Punya Akun?
         <a href="registrasi.php">Daftar</a>
      </p>
   </form>

   <?php if (isset($error)) : ?>
      <p style="color: red">username atau password tidak sesuai!</p>
   <?php endif ?>
</body>

</html>