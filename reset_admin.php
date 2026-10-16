<?php
include "teskoneksi.php";

// Password baru yang ingin Anda gunakan
$password_asli = "tess123";

// Enkripsi resmi menggunakan standar PHP (password_hash)
$password_baru = password_hash($password_asli, PASSWORD_DEFAULT);

// Perbarui password untuk username Admin321
$query = "UPDATE users SET password = '$password_baru' WHERE username = 'Admin321'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "Password admin berhasil diperbarui! Silakan hapus file ini.";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>