<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$host     = "localhost";
$user     = "root";     
$password = "";         
$database = "db_belajar";

$koneksi = mysqli_connect($host, $user, $password, $database);

// if (!$koneksi) {
//     die("Koneksi ke database gagal: " . mysqli_connect_error());
// } else {
//     echo "Koneksi ke database db_belajar berhasil!";
// }
?>