<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/teskoneksi.php";

// Keamanan: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username_login = $_SESSION['username'];

// Perintah Hapus data KHUSUS milik user yang sedang login
$query = "DELETE FROM tes WHERE user = '$username_login'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data pendaftaran berhasil dihapus!');
            window.location='../user/dashboard.php';
          </script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>