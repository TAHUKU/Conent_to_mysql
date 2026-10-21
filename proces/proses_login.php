<?php
include "../config/teskoneksi.php";
session_start();
// $id_user = $row['id']; // ID dari tabel users
// mysqli_query($koneksi, "INSERT INTO riwayat_login (user_id, waktu_login) VALUES ('$id_user', NOW())");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Cari username di database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // 2. Cocokkan password yang di-input dengan password terenkripsi di database
        if (password_verify($password, $row['password'])) {
            
            // Simpan data penting ke dalam Session
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $row['role']; // Menyimpan status 'admin' atau 'user'

            $id_user =$row['id'];
            mysqli_query($koneksi, "UPDATE users SET riwayat_login = NOW() WHERE id = '$id_user'");

            // 3. CABANG / PENGKONDISIAN BERDASARKAN ROLE
            if ($row['role'] == 'admin') {
                // Jika yang login adalah admin, arahkan ke lihat data
                header("Location: ../admin/dashboard_admin.php");
                exit;
            } else {
                // Jika yang login adalah user biasa, arahkan ke halaman form
                header("Location: ../user/dashboard_user.php"); // Ganti 'form.php' dengan nama file form Anda
                exit;
            }

        } else {
            // Password salah
            echo "<script>alert('Password salah!'); window.location='login.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
    }
}
?>