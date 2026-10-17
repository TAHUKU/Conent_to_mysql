<?php
session_start();
include "../config/teskoneksi.php";

// Pastikan hanya admin yang bisa mengeksekusi hapus
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cegah admin menghapus akunnya sendiri yang sedang aktif login
    // (Asumsi kolom primary key tabel users adalah 'id')
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Akun user berhasil dihapus!');
                window.location='../admin/lihat_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus user: " . mysqli_error($koneksi) . "');
                window.location='../admin/lihat_user.php';
              </script>";
    }
} else {
    header("Location: ../admin/lihat_user.php");
}
?>