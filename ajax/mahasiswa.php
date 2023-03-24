<?php
require '/xampp/htdocs/kampus/common.php';

$keyword = $_GET["keyword"];
$sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
$mahasiswa = query($sql);

?>

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