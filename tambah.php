<?php
session_start();
require 'config.php';
require 'common.php';

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if (isset($_POST['submit'])) {
   if (tambah($_POST) > 0) {
      echo "<script> 
               alert('data berhasil ditambahkan')
               document.location.href = 'index.php'
            </script>";
   } else {
      echo "<script> 
               alert('data gagal ditambahkan')
               document.location.href = 'index.php'
            </script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Data Mahasiswa</title>
   <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
   <h1>Tambah Data Mahasiswa</h1>

   <br><br>

   <form action="" method="POST" enctype="multipart/form-data">
      <label for="nim">NIM : </label>
      <input type="text" id="nim" name="nim" required>

      <label for="nama">Nama : </label>
      <input type="text" id="nama" name="nama" required>

      <label for="email">Email : </label>
      <input type="text" id="email" name="email" required>

      <label for="jurusan">Jurusan : </label>
      <input type="text" id="jurusan" name="jurusan" required>

      <label for="gambar">Gambar : </label>
      <input type="file" id="gambar" name="gambar" required>

      <br>

      <button type="submit" name="submit">Kirim!</button>
   </form>
</body>

</html>