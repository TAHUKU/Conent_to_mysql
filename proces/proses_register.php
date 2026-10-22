<?php
include "../config/teskoneksi.php";

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Role dipatok otomatis jadi "user"
    $role = 'user';

    // Masukkan data ke tabel users
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Popup Sukses di Tengah
        echo "<html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'></head><body style='font-family: Inter, sans-serif;'>";
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Pendaftaran berhasil! Silakan login.',
                icon: 'success',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                window.location = '../login.php';
            });
        </script>";
        echo "</body></html>";
        exit;
    } else {
        $error_msg = mysqli_error($koneksi);
        // Popup Gagal di Tengah
        echo "<html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'></head><body style='font-family: Inter, sans-serif;'>";
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Gagal mendaftar: " . addslashes($error_msg) . "',
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                window.location = '../register.php';
            });
        </script>";
        echo "</body></html>";
        exit;
    }
}
?>