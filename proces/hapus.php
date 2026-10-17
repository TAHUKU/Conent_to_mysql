<?php
// 1. Hubungkan ke database
include "../config/teskoneksi.php";

// 2. Tangkap ID yang dikirim lewat URL (menggunakan GET)
$id = $_GET['id'];

// 3. Buat perintah SQL untuk menghapus data berdasarkan ID
$query = "DELETE FROM tes WHERE user = '$id'";

// 4. Jalankan query penghapusan
$result = mysqli_query($koneksi, $query);

// 5. Cek apakah berhasil, lalu tampilkan alert dan kembalikan ke lihat data
if ($result) {
    // Tampilkan pop-up notifikasi berhasil, lalu redirect ke halaman lihat_data.php
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location='../admin/lihat_data.php';
          </script>";
    exit;
} else {
    // Jika gagal
    echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
            window.location='../admin/lihat_data.php';
          </script>";
}
?>