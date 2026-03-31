<?php
// Konfigurasi koneksi ke database
$host     = "localhost";
$user     = "root";       // sesuaikan dengan username MySQL kamu
$password = "";           // sesuaikan dengan password MySQL kamu
$database = "portfolio_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>