<?php
// koneksi.php
$koneksi = mysqli_connect("localhost", "root", "", "login_db");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
