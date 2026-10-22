<?php
session_start();
include "../config/teskoneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$nama_pengguna = $_SESSION['username'] ?? 'Admin';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

if (!empty($cari)) {
    $cari_clean = mysqli_real_escape_string($koneksi, $cari);
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username LIKE '%$cari_clean%' ORDER BY riwayat_login DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY riwayat_login DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Riwayat Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon/history.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/riwayat.css">
</head>
<body>

<div class="container">
    <!-- Judul Halaman -->
    <h2 class="page-title">Manajemen Akun Pengguna</h2>

    <!-- Kotak Info Sapaan & Logout -->
    <div class="user-info-box">
        <h3>Selamat Siang, <?php echo htmlspecialchars($nama_pengguna); ?></h3>
        <a href="../logout.php" class="btn-logout-box">Logout</a>
    </div>

    <!-- Navigasi Admin Gelap -->
    <nav class="admin-nav">
       <a href="dashboard_admin.php">Dashboard</a>
        <a href="search_data_user.php">Search Data Pendaftar</a>
        <a href="lihat_akun_user.php">Daftar Akun User</a>
        <a href="edit_data_user.php">Edit data</a>
        <a href="riwayat_login_user.php">Lihat riwayat login</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <!-- Form Pencarian -->
<div class="search-box">
        <form action="" method="GET">
            <input type="text" name="cari" placeholder="Cari username..." value="<?php echo htmlspecialchars($cari); ?>">
            <button type="submit">Cari</button>
            <!-- Tombol Reset Selalu Muncul -->
            <a href="riwayat_login_user.php" class="btn-reset-btn">Reset</a>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="8%">NO</th>
                    <th>USERNAME</th>
                    <th>ROLE / HAK AKSES</th>
                    <th>WAKTU LOGIN TERAKHIR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['username']) . "</strong></td>";
                        
                        $role_class = ($row['role'] == 'admin') ? 'role-admin' : 'role-user';
                        echo "<td><span class='badge-status {$role_class}'>" . htmlspecialchars($row['role']) . "</span></td>";
                        
                        echo "<td>";
                        if (!empty($row['riwayat_login'])) {
                            echo date('d-m-Y | H:i:s', strtotime($row['riwayat_login'])) . " WIB";
                        } else {
                            echo "<span class='text-belum-login'>Belum pernah login</span>";
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='no-data'>Tidak ada data user yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>