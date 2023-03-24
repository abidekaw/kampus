<?php
// phpinfo();
session_start();
require 'common.php';

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

// setup pagination
// $data = count(query("SELECT * FROM mahasiswa"));
// $dataTampil = 2;
// $halaman = ceil($data / $dataTampil);
// $halamanAktif = (isset($_GET['pages']) ? $_GET['pages'] : 1);
// $dataAwal = $dataTampil * $halamanAktif - $dataTampil;

// $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $dataAwal, $dataTampil");
$mahasiswa = query("SELECT * FROM mahasiswa");

if (isset($_POST['cari'])) {
   $mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Admin</title>
   <link rel="stylesheet" href="assets/css/style.css">
   <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
   <script src="assets/js/script.js"></script>
</head>

<body style="text-align: center">
   <h1>Daftar Mahasiswa</h1>

   <form action="" method="post">
      <input type="text" name="keyword" placeholder="masukkan pencarian..." autofocus autocomplete="OFF" size="30" id="search">
      <button type="submit" name="cari" id="submit">Cari!</button>
      <img src="./assets/img/loader.gif" class="loader">
   </form>

   <div class="wrap">
      <div>
         <a href="tambah.php">Tambah Data Mahasiswa</a>
         <span>||</span>
         <a href="print.php" target="_blank">Cetak!</a>
      </div>
      <div>
         <span>Halo, Selamat Datang <?= $_SESSION["admin"] ?>!</span>
         <span>||</span>
         <span><a href="logout.php">Logout</a></span>
      </div>
   </div>

   <div id="content">
      <table border="1" cellpadding="10" cellspacing="0">
         <thead>
            <tr>
               <th>No.</th>
               <th>Aksi</th>
               <th>Gambar</th>
               <th>NIM</th>
               <th>Nama</th>
               <th>Email</th>
               <th>Jurusan</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $mhs) : ?>
               <tr>
                  <td><?= $i ?></td>
                  <td><a href="ubah.php?id=<?= $mhs["id"] ?>">Ubah</a> | <a href="hapus.php?id=<?= $mhs['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
                  <td><img src="assets/img/<?= $mhs["gambar"] ?>" alt="<?= $mhs["nama"] ?>" width="50" height="50"></td>
                  <td><?= $mhs["nim"] ?></td>
                  <td><?= $mhs["nama"] ?></td>
                  <td><?= $mhs["email"] ?></td>
                  <td><?= $mhs["jurusan"] ?></td>
               </tr>
               <?php $i++; ?>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>

   <!-- <div class="pagination">
      <?php for ($i = 1; $i <= $halaman; $i++) : ?>
         <?php if ($i == $halamanAktif) : ?>
            <a href="?pages=<?= $i ?>" style="font-weight: bold"><?= $i ?></a>
         <?php else : ?>
            <a href="?pages=<?= $i ?>"><?= $i ?></a>
         <?php endif; ?>
      <?php endfor; ?>
   </div> -->
</body>

</html>