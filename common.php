<?php
require 'config.php';

function query($sql)
{
   global $conn;

   $mahasiswa = [];
   $query = mysqli_query($conn, $sql);
   while ($mhs = mysqli_fetch_assoc($query)) {
      $mahasiswa[] = $mhs;
   }
   return $mahasiswa;
}

function upload()
{
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   // cek apakah tidak ada gambar yang diupload
   if ($error === 4) {
      echo "<script>
               alert('pilih gambar terlebih dahulu')
            </script>";
      return false;
   }

   // cek apakah yang diupload adalah gambar
   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
               alert('yang anda upload bukan gambar!')
            </script>";
      return false;
   }

   // cek jika ukurannya terlalu besar
   if ($ukuranFile > 1000000) {
      echo "<script>
               alert('ukuran gambar terlalu besar!')
            </script>";
      return false;
   }

   // lolos pengecekan, gambar siap diupload
   // generate nama file
   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;
   move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

   return $namaFileBaru;
}

function tambah($mhs)
{
   global $conn;

   $nim = htmlspecialchars($mhs['nim']);
   $nama = htmlspecialchars($mhs['nama']);
   $email = htmlspecialchars($mhs['email']);
   $jurusan = htmlspecialchars($mhs['jurusan']);

   // upload gambar
   $gambar = upload();
   if (!$gambar) {
      return false;
   }

   $sql = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')";
   mysqli_query($conn, $sql);

   return mysqli_affected_rows($conn);
}

function hapus($id)
{
   global $conn;

   $sql = "DELETE FROM mahasiswa WHERE id = '$id'";
   mysqli_query($conn, $sql);

   return mysqli_affected_rows($conn);
}

function ubah($mhs)
{
   global $conn;

   $id = $mhs['id'];
   $nim = htmlspecialchars($mhs['nim']);
   $nama = htmlspecialchars($mhs['nama']);
   $email = htmlspecialchars($mhs['email']);
   $jurusan = htmlspecialchars($mhs['jurusan']);
   $gambarLama = htmlspecialchars($mhs['gambarLama']);

   // cek apakah user pilih gambar baru atau tidak
   if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
   } else {
      $gambar = upload();
   }

   $sql = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";
   mysqli_query($conn, $sql);

   return mysqli_affected_rows($conn);
}

function cari($keyword)
{
   $sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
   return query($sql);
}

function registrasi($user)
{
   global $conn;

   // ambil data yg di input oleh user
   $username = strtolower(stripslashes($user['username']));
   $password = mysqli_real_escape_string($conn, $user['password']);
   $confirm = mysqli_real_escape_string($conn, $user['confirm-pass']);

   // cek kesamaan password
   if ($password !== $confirm) {
      echo "Password tidak sesuai";
      return false;
   }

   // cek ketersediaan username/mencegah username kembar
   // apakah username sudah ada atau belum
   $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

   if (mysqli_fetch_assoc($query)) {
      echo "<p style='color: red'>username sudah terpakai</p>";
      return false;
   }

   // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

   // jika sudah lolos kondisi pengecekan -> masukkan data
   $sql = "INSERT INTO user VALUES ('', '$username', '$password')";
   mysqli_query($conn, $sql);

   // kembalikan fungsi ini untuk dicek di halaman registrasi/apakah berhasil atau tidak
   return mysqli_affected_rows($conn);
}
