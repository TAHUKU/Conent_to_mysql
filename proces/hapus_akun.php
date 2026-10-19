<?php
// 1. Hubungkan ke database
include "../config/teskoneksi.php";

// 2. Tangkap ID yang dikirim lewat URL (menggunakan GET)
// Gunakan intval() untuk keamanan tambahan agar $id pasti berupa angka
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Buat perintah SQL untuk menghapus data berdasarkan kolom id yang benar
// Sesuaikan "tes" dengan nama tabel yang datanya ingin Anda hapus
$query = "DELETE FROM users WHERE id = '$id'";

// 4. Jalankan query penghapusan
$result = mysqli_query($koneksi, $query);

// 5. Cek apakah berhasil, lalu tampilkan alert dan kembalikan ke halaman admin
if ($result) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location='../admin/lihat_data_user.php';
          </script>";
    exit;
} else {
    echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
            window.location='../admin/lihat_akun_user.php';
          </script>";
}
?>