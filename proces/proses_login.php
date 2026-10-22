<?php
include "../config/teskoneksi.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Cari username di database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // 2. Cocokkan password
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $row['role']; 

            $id_user = $row['id'];
            mysqli_query($koneksi, "UPDATE users SET riwayat_login = NOW() WHERE id = '$id_user'");

            // Berhasil Login (Opsional: Bisa pakai SweetAlert sukses juga, atau langsung redirect)
            if ($row['role'] == 'admin') {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<body style='font-family: Inter, sans-serif;'></body>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Login Berhasil!',
                            text: 'Selamat datang, Admin.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location = '../admin/dashboard_admin.php';
                        });
                    });
                </script>";
                exit;
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<body style='font-family: Inter, sans-serif;'></body>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Login Berhasil!',
                            text: 'Selamat datang.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location = '../user/dashboard_user.php';
                        });
                    });
                </script>";
                exit;
            }

        } else {
            // Password Salah - Popup di Tengah
            echo "<html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'></head><body style='font-family: Inter, sans-serif;'>";
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Password salah!',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#3b82f6'
                }).then(() => {
                    window.location = '../login.php';
                });
            </script>";
            echo "</body></html>";
        }
    } else {
        // Username Tidak Ditemukan - Popup di Tengah
        echo "<html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'></head><body style='font-family: Inter, sans-serif;'>";
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Username tidak ditemukan!',
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                window.location = '../login.php';
            });
        </script>";
        echo "</body></html>";
    }
}
?>