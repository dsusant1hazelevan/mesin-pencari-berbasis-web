<?php
//silahkan rubah detail koneksi di bawah ini sesuai dengan server sobat
$koneksi = new mysqli("localhost", "root", "", "mesin_pencari");
if ($koneksi->connect_errno) {
    echo "Gagal melakukan koneksi ke database: " . $koneksi->connect_error;
}
?>