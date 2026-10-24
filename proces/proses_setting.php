<?php
session_start();
include "../config/teskoneksi.php";

if (!isset($_SESSION['username']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../user/setting.php");
    exit();
}

$username = $_SESSION['username'];
$aksi = $_POST['aksi'] ?? '';

// --- 1. PROSES UPDATE PROFIL ---
if ($aksi === 'update_profil') {
    $nama_lengkap  = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp         = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $gender        = mysqli_real_escape_string($koneksi, $_POST['gender']);

    $query = "UPDATE users SET 
                nama_lengkap = '$nama_lengkap', 
                email = '$email', 
                no_hp = '$no_hp', 
                gender = '$gender' 
              WHERE username = '$username'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan_sukses'] = "Profil berhasil diperbarui!";
    } else {
        $_SESSION['pesan_error'] = "Gagal memperbarui profil: " . mysqli_error($koneksi);
    }
    header("Location: ../user/setting.php");
    exit();
}

// --- 2. PROSES UBAH PASSWORD ---
if ($aksi === 'update_password') {
    $password_lama       = $_POST['password_lama'];
    $password_baru       = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil password tersimpan dari database
    $query_cek = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query_cek);
    $data = mysqli_fetch_assoc($result);

    // Cek password lama (support password_hash atau text biasa)
    $password_matched = password_verify($password_lama, $data['password']) || ($password_lama === $data['password']);

    if (!$password_matched) {
        $_SESSION['pesan_error'] = "Password saat ini salah!";
        header("Location: ../user/setting.php");
        exit();
    }

    if ($password_baru !== $konfirmasi_password) {
        $_SESSION['pesan_error'] = "Konfirmasi password baru tidak cocok!";
        header("Location:../user/setting.php");
        exit();
    }

    // Hash password baru sebelum disimpan
    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

    $query_update = "UPDATE users SET password = '$password_hash' WHERE username = '$username'";
    if (mysqli_query($koneksi, $query_update)) {
        $_SESSION['pesan_sukses'] = "Password berhasil diubah!";
    } else {
        $_SESSION['pesan_error'] = "Gagal mengubah password!";
    }
    header("Location: ../user/setting.php");
    exit();
}