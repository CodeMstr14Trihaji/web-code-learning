<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username sudah terdaftar
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "Username sudah terdaftar. <a href='register.html'>Coba lagi</a>";
    exit;
}

// Hash password
// $hash = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
$simpan = mysqli_query($koneksi, $query);

if ($simpan) {
    echo "Registrasi berhasil. <a href='index.html'>Login sekarang</a>";
} else {
    echo "Gagal registrasi: " . mysqli_error($koneksi);
}
?>
