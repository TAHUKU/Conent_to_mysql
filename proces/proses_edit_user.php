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

// Ambil data yang dikirim dari form edit
$nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
$email  = mysqli_real_escape_string($koneksi, $_POST['email']);
$no_hp  = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

// Perbarui data KHUSUS milik user yang sedang login
$query = "UPDATE tes SET 
            nama_lengkapgit = '$nama', 
            email = '$email', 
            no_hp = '$no_hp', 
            alamat = '$alamat' 
          WHERE user = '$username_login'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data diri berhasil diperbarui!');
            window.location='../user/dashboard.php';
          </script>";
} else {
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}
?>