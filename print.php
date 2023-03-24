<?php
require 'common.php';
require_once __DIR__ . '/vendor/autoload.php';

$mahasiswa = query("SELECT * FROM mahasiswa");
$mpdf = new \Mpdf\Mpdf();

$html = '
   <div id="content">
      <table border="1" cellpadding="10" cellspacing="0">
         <thead>
            <tr>
               <th>No.</th>
               <th>Gambar</th>
               <th>NIM</th>
               <th>Nama</th>
               <th>Email</th>
               <th>Jurusan</th>
            </tr>
         </thead>
         <tbody>';
$i = 1;
foreach ($mahasiswa as $mhs) {
   $html .=  '<tr>
                  <td>' . $i++ . '</td>
                  <td><img src="assets/img/' . $mhs["gambar"] . '" width="50" height="50"></td>
                  <td>' . $mhs["nim"] . '</td>
                  <td>' . $mhs["nama"] . '</td>
                  <td>' . $mhs["email"] . '</td>
                  <td>' . $mhs["jurusan"] . '</td>
               </tr>';
}
$html .= '</tbody>
      </table>
   </div>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I');
