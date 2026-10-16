<?php
include "teskoneksi.php";

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Role dipatok otomatis jadi "user", jadi tidak bisa diubah-ubah orang lain
    $role = 'user';

    // Masukkan data ke tabel users
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>