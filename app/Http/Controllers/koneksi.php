<?php
date_default_timezone_set("Asia/Jakarta");
$host = "sql212.infinityfree.com"; // Sesuaikan jika berbeda di tabel MySQL Databases kamu
$user = "if0_42065662"; 
$pass = "nqabsensi21"; // Password akun hosting InfinityFree milikmu
$db   = "laravel_absensi_app"; // Masukkan nama lengkap databasemu yang ada di panel kiri tadi

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>