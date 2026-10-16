<?php
// 1. Hubungkan ke database
include "../config/teskoneksi.php";

// 2. Tangkap ID yang dikirim lewat URL (menggunakan GET)
$id = $_GET['id'];

// 3. Buat perintah SQL untuk menghapus data berdasarkan ID
$query = "DELETE FROM tes WHERE user = '$id'";

// 4. Jalankan query penghapusan
$result = mysqli_query($koneksi, $query);

// 5. Cek apakah berhasil, lalu kembalikan ke halaman lihat data
if ($result) {
    // Jika berhasil dihapus, lempar balik ke lihat_data.php
    header("Location: lihat_data.php");
    exit;
} else {
    // Jika gagal
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>