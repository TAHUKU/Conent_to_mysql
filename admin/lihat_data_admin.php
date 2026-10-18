<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/teskoneksi.php";

// Keamanan: Cek apakah user sudah login DAN rolenya benar-benar admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak! Halaman ini khusus admin.'); window.location='login.php';</script>";
    exit();
}

// Menangkap kata kunci pencarian jika admin mengetiknya
$cari = "";
if (isset($_GET['cari'])) {
    // Amankan input pencarian menggunakan mysqli_real_escape_string
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    
    // Query dengan filter pencarian (mencari berdasarkan nama atau username)
    $query = mysqli_query($koneksi, "SELECT * FROM tes WHERE nama_lengkap LIKE '%$cari%' OR user LIKE '%$cari%'");
} else {
    // Jika tidak sedang mencari, tampilkan semua data pendaftar
    $query = mysqli_query($koneksi, "SELECT * FROM tes");
}
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Data Pendaftar - Admin Panel</title>
        <link rel="stylesheet" href="../css/lihat_data.css">
        <link rel="shortcut icon" href="../favicon/lihat_data.png" type="image/x-icon">
    </head>
<body>
    <div class="admin-container">
        <h2>Panel Admin - Seluruh Data Pendaftar</h2>
        <p>Login sebagai Administrator: <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></p>
        
        <!-- Form Pencarian -->
        <form action="lihat_data_admin.php" method="GET" class="search-form">
            <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari berdasarkan nama atau username..." class="search-input">
            <button type="submit" class="btn-cari">Cari</button>
            
            <?php if (!empty($cari)): ?>
                <a href="lihat_data_admin.php" class="btn-reset">Reset</a>
            <?php endif; ?>
        </form>

        <!-- Tabel Menampilkan Data -->
        <table class="admin-table">
            <tr>
                <th>No</th>
                <th>Username Akun</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Gender</th>
            </tr>
            <?php 
            $no = 1;
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['user'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_lengkap'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['no_hp'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['alamat'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['Gender'] ?? '') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='empty-row'>Tidak ada data pendaftar yang ditemukan.</td></tr>";
            }
            ?>
        </table>

        <div class="action-footer">
            <a href="dashboard_admin.php" class="back-link">&larr; Back to dashboard</a>
            <a href="../login.php" class="logout-link">Logout / Keluar &rarr;</a>

        </div>
    </div>
</body>
</html>