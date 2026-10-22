<?php
session_start();
// Karena di dalam folder admin, naik satu tingkat ke config
include "../config/teskoneksi.php"; 

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$nama_pengguna = $_SESSION['username'];
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// 1. Tentukan jumlah data yang ingin ditampilkan per halaman
$batas = 5;

// 2. Tentukan halaman saat ini (jika tidak ada di URL, berarti halaman 1)
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// 3. Hitung total seluruh data (termasuk jika sedang melakukan pencarian)
if (!empty($cari)) {
    $cari_clean = mysqli_real_escape_string($koneksi, $cari);
    $query_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tes WHERE nama_lengkap LIKE '%$cari_clean%' OR user LIKE '%$cari_clean%'");
} else {
    $query_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tes");
}
$row_jumlah = mysqli_fetch_assoc($query_jumlah);
$total_data = $row_jumlah['total'];

// 4. Hitung total halaman yang tersedia (dibulatkan ke atas)
$total_halaman = ceil($total_data / $batas);

// 5. Query utama dengan membatasi data (LIMIT & OFFSET)
if (!empty($cari)) {
    $cari_clean = mysqli_real_escape_string($koneksi, $cari);
    $query = mysqli_query($koneksi, "SELECT * FROM tes WHERE nama_lengkap LIKE '%$cari_clean%' OR user LIKE '%$cari_clean%' LIMIT $halaman_awal, $batas");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM tes LIMIT $halaman_awal, $batas");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Data Pengguna</title>
    <!-- Panggil CSS dengan naik satu tingkat (../) -->
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon/lihat_data.png" type="image/x-icon">
</head>
<body>

    <h2>Daftar Data Pendaftaran</h2>
    
    <!-- Bagian Info Login & Logout -->
    <div class="user-info">
        <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>

    <!-- Navigasi Admin -->
    <nav>
       <a href="dashboard_admin.php">Dashboard</a>
        <a href="search_data_user.php">Search Data Pendaftar</a>
        <a href="lihat_akun_user.php">Daftar Akun User</a>
        <a href="edit_data_user.php">Edit data</a>
        <a href="riwayat_login_user.php">Lihat riwayat login</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <!-- Tabel Data -->
    <table class="data-table">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Gender</th>
        </tr>

        <?php
        $no = $halaman_awal + 1; 

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_lengkap'] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars($row['no_hp'] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars($row['alamat'] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars($row['Gender'] ?? '') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data pendaftar yang ditemukan.</td></tr>";
        }
        ?>
    </table>

    <!-- Navigasi Tombol Pagination (Halaman 1, 2, 3...) -->
    <?php if ($total_halaman > 1): ?>
        <div class="pagination" style="margin-top: 20px; text-align: center;">
            <?php if($halaman > 1): ?>
                <a href="?halaman=<?php echo $halaman - 1; ?><?php echo !empty($cari) ? '&cari='.urlencode($cari) : ''; ?>" class="btn-page">&laquo; Sebelumnya</a>
            <?php endif; ?>

            <?php for($x = 1; $x <= $total_halaman; $x++): ?>
                <?php if($x == $halaman): ?>
                    <a href="?halaman=<?php echo $x; ?><?php echo !empty($cari) ? '&cari='.urlencode($cari) : ''; ?>" class="btn-page active"><?php echo $x; ?></a>
                <?php else: ?>
                    <a href="?halaman=<?php echo $x; ?><?php echo !empty($cari) ? '&cari='.urlencode($cari) : ''; ?>" class="btn-page"><?php echo $x; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($halaman < $total_halaman): ?>
                <a href="?halaman=<?php echo $halaman + 1; ?><?php echo !empty($cari) ? '&cari='.urlencode($cari) : ''; ?>" class="btn-page">Berikutnya &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>

    <!-- Panggil JS dengan naik satu tingkat (../) -->
    <script src="../js/time.js"></script>

</body>
</html>