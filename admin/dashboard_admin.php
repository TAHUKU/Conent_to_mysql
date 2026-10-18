<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

include "../config/teskoneksi.php"; 
$nama_pengguna = $_SESSION['username'];

// Hitung Statistik
$query_pendaftar = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tes");
$total_pendaftar = mysqli_fetch_assoc($query_pendaftar)['total'];

$query_users = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users");
$total_users = mysqli_fetch_assoc($query_users)['total'];

$query_laki = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tes WHERE Gender='Laki-laki'");
$total_laki = mysqli_fetch_assoc($query_laki)['total'];

$query_perempuan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tes WHERE Gender='Perempuan'");
$total_perempuan = mysqli_fetch_assoc($query_perempuan)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/data.css">
    <link rel="shortcut icon" href="../favicon/dashboard_admin.png" type="image/x-icon">
    <!-- Load Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h2>Dashboard Utama</h2>
    
    <div class="user-info">
        <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>

    <nav>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="search_data_user.php">Search Data Pendaftar</a>
        <a href="lihat_akun_user.php">Daftar Akun User</a>
        <a href="edit_data_user.php">Edit data</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <!-- Kartu Statistik Angka -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Total Pendaftar</h3>
            <p class="card-number"><?php echo $total_pendaftar; ?></p>
            <a href="lihat_data_user.php" class="card-link">Lihat Detail &rarr;</a>
        </div>

        <div class="card">
            <h3>Total Akun User</h3>
            <p class="card-number"><?php echo $total_users; ?></p>
            <a href="lihat_user.php" class="card-link">Lihat Detail &rarr;</a>
        </div>

        <div class="card card-info">
            <h3>Pendaftar Laki-Laki</h3>
            <p class="card-number"><?php echo $total_laki; ?></p>
        </div>

        <div class="card card-info">
            <h3>Pendaftar Perempuan</h3>
            <p class="card-number"><?php echo $total_perempuan; ?></p>
        </div>
    </div>

<!-- Container untuk Bar Chart -->
    <div class="chart-container">
        <h3>Grafik Statistik Pendaftar Berdasarkan Gender</h3>
        <canvas id="genderChart" 
                data-laki="<?php echo $total_laki; ?>" 
                data-perempuan="<?php echo $total_perempuan; ?>">
        </canvas>
    </div>

    <script src="../js/time.js"></script>
    <script src="../js/bar.js"></script>

</body>
</html>