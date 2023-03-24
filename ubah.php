<?php
session_start();
require 'config.php';
require 'common.php';

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$id = $_GET["id"];
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];

if (isset($_POST['submit'])) {
   if (ubah($_POST) > 0) {
      echo "<script> 
               alert('data berhasil disimpan')
               document.location.href = 'index.php'
            </script>";
   } else {
      echo "<script> 
               alert('data gagal disimpan')
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
   <title>Edit Data Mahasiswa</title>
   <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
   <h1>Edit Data Mahasiswa</h1>

   <br>

   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $id ?>">
      <input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">

      <label for="nim">NIM : </label>
      <input type="text" id="nim" name="nim" required value="<?= $mhs['nim'] ?>">

      <label for="nama">Nama : </label>
      <input type="text" id="nama" name="nama" required value="<?= $mhs['nama'] ?>">

      <label for="email">Email : </label>
      <input type="text" id="email" name="email" required value="<?= $mhs['email'] ?>">

      <label for="jurusan">Jurusan : </label>
      <input type="text" id="jurusan" name="jurusan" required value="<?= $mhs['jurusan'] ?>">

      <label for="gambar">Gambar : </label>
      <img src="assets/img/<?= $mhs['gambar'] ?>" alt="" width="40">
      <input type="file" id="gambar" name="gambar">

      <br>

      <button type=" submit" name="submit">Simpan!</button>
   </form>
</body>

</html>