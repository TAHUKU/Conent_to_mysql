<?php
session_start();

include "../config/teskoneksi.php"; 
$nama_pengguna = $_SESSION['username'] ?? 'Admin';

// Ambil data pendaftar hari ini
$query_notif = "SELECT * FROM users WHERE DATE(notifikasi) = CURDATE() ORDER BY id DESC LIMIT 0, 25";
$result_notif = mysqli_query($koneksi, $query_notif);
$jumlah_notif = mysqli_num_rows($result_notif);

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
    <!-- Load FontAwesome untuk Ikon Lonceng -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <h2>Dashboard Utama</h2>
    
   <!-- Bagian Sapaan, Ikon Lonceng, & Tombol Logout -->
    <div class="user-info" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
    <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna ?? ''); ?>"></h2>
        
        <div style="display: flex; align-items: center; gap: 15px;">
            <!-- Dropdown Notifikasi Lonceng -->
            <div class="notification-wrapper" style="position: relative;">
               <button class="notification-btn" onclick="toggleNotificationDropdown()" style="background: none; border: none; font-size: 20px; cursor: pointer; position: relative; padding: 5px; color: #333;">
                    <i class="fa-solid fa-bell"></i>
                    <?php if ($jumlah_notif > 0): ?>
                        <span id="notificationBadge" class="notification-badge" data-count="<?php echo $jumlah_notif; ?>" style="position: absolute; top: -2px; right: -2px; background-color: #ef4444; color: white; font-size: 10px; font-weight: bold; padding: 2px 5px; border-radius: 50%;"><?php echo $jumlah_notif; ?></span>
                    <?php endif; ?>
                </button>

                <!-- Kotak Dropdown -->
                <div id="notifDropdown" class="notification-dropdown">
                    <div class="notification-header">
                        Pendaftaran Hari Ini (<?php echo $jumlah_notif; ?>)
                    </div>
                    <div class="notification-body">
                        <?php if ($jumlah_notif > 0): ?>
                            <?php while ($row_notif = mysqli_fetch_assoc($result_notif)): ?>
                                <div class="notification-item">
                                    <div>Akun <span class="username"><?php echo htmlspecialchars($row_notif['username']); ?></span> mendaftar secara mandiri.</div>
                                    <div class="time"><i class="fa-regular fa-clock"></i> <?php echo $row_notif['notifikasi']; ?></div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="notification-empty">Belum ada pendaftar baru hari ini.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout yang Dipindah ke Atas -->
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </div>

    <!-- Navigasi Menu (Logout di bawah sudah dihapus agar tidak duplikat) -->
    <nav>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="search_data_user.php">Search Data Pendaftar</a>
        <a href="lihat_akun_user.php">Daftar Akun User</a>
        <a href="edit_data_user.php">Edit data</a>
        <a href="riwayat_login_user.php">Lihat riwayat login</a>
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
            <a href="lihat_akun_user.php" class="card-link">Lihat Detail &rarr;</a>
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
    <script src="../js/notif.js"></script>


</body>
</html>