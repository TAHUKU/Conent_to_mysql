<?php
session_start();
include "../config/teskoneksi.php";

// Cek autentikasi login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// 1. Ambil data akun untuk sapaan / profil (dari tabel users)
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($query_user);
$nama_pengguna = $user['nama_lengkap'] ?? $username;

// 2. CEK APAKAH USER INI SUDAH MENDAFTAR ATAU BELUM (di tabel pendaftaran, misal: tabel 'tes')
// Sesuaikan nama kolom 'user' atau 'username' di bawah ini dengan kolom yang menyimpan nama user/username di tabel 'tes' Anda
$query_pendaftaran = mysqli_query($koneksi, "SELECT * FROM tes WHERE user = '$username'");
$sudah_mendaftar = mysqli_num_rows($query_pendaftaran) > 0;
$data_pendaftaran = mysqli_fetch_assoc($query_pendaftaran); // Ambil datanya jika ada
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - v2</title>
    <!-- CSS Eksternal -->
    <link rel="stylesheet" href="../css/data.css">
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../favicon/user.png" type="image/x-icon">
</head>
<body class="dashboard-body">

    <!-- TOP BAR / HEADER -->
    <header class="topbar-v2">
        <div class="topbar-brand">
            <i class="fa-solid fa-layer-group"></i>
            <span>PortalAplikasi</span>
        </div>

        <div class="topbar-right">
            <div class="user-greeting">
                <span id="sapaan-waktu">Halo</span>, <strong><?php echo htmlspecialchars($nama_pengguna); ?></strong>!
            </div>
            
            <!-- Profil Dropdown / Menu Akun -->
            <div class="profile-dropdown-container">
                <div class="profile-avatar" onclick="toggleDropdown()">
                    <i class="fa-solid fa-user"></i>
                </div>
                <!-- Menu Dropdown -->
                <div class="dropdown-menu-v2" id="dropdownMenu">
    <!-- Menu Baru: Menuju halaman profil lengkap -->
                <a href="profil.php"><i class="fa-solid fa-id-card"></i> Profil Saya</a>
                
                <!-- Menu Pengaturan / Ubah Password -->
                <a href="settings.php"><i class="fa-solid fa-gear"></i> Pengaturan Sandi</a>
                
                <div class="dropdown-divider"></div>
                
                <a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="main-container-v2">
        
        <!-- NAVIGASI / TABS -->
        <nav class="nav-tabs-v2">
            <a href="dashboard_user.php" class="nav-tab-item active">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="../form_pendaftaran.php" class="nav-tab-item">
                <i class="fa-solid fa-file-pen"></i> Form Pendaftaran
            </a>
            <a href="setting.php" class="nav-tab-item">
                <i class="fa-solid fa-gear"></i> Pengaturan Akun
            </a>
        </nav>

        <!-- HERO WELCOME BANNER -->
        <section class="hero-banner">
            <div class="hero-text">
                <h1>Selamat Datang Kembali, <?php echo htmlspecialchars($nama_pengguna); ?>! 👋</h1>
                <p>Kelola data diri, pantau status pendaftaran, dan sesuaikan pengaturan akun Anda dengan mudah di sini.</p>
            </div>
            <div class="hero-badge">
                <i class="fa-solid fa-shield-halved"></i> Akun Terverifikasi
            </div>
        </section>

        <!-- GRID KONTROL / KARTU INFORMASI -->
        <div class="dashboard-grid-v2">
            
            <!-- Card 1: Status Akun -->
            <div class="card-v2">
                <div class="card-header-v2">
                    <div class="card-icon blue">
                        <i class="fa-solid fa-id-badge"></i>
                    </div>
                    <div>
                        <h3>Status Akun</h3>
                        <span class="badge-status active">Aktif & Aman</span>
                    </div>
                </div>
                <div class="card-body-v2">
                    <p>Anda masuk sebagai <strong>User</strong> dengan username <code><?php echo htmlspecialchars($username); ?></code>.</p>
                    <ul class="info-list">
                        <li><span>Email:</span> <strong><?php echo htmlspecialchars($user['email'] ?? 'Belum diatur'); ?></strong></li>
                        <li><span>No. HP:</span> <strong><?php echo htmlspecialchars($user['no_hp'] ?? 'Belum diatur'); ?></strong></li>
                    </ul>
                </div>
                <div class="card-footer-v2">
                    <a href="setting.php" class="btn-v2 btn-outline">Edit Profil & Sandi</a>
                </div>
            </div>

            <!-- Card 2: Status Pendaftaran -->
            <!-- Card 2: Status Pendaftaran -->
            <div class="card-v2">
                <div class="card-header-v2">
                    <div class="card-icon <?php echo $sudah_mendaftar ? 'green' : 'blue'; ?>">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h3>Status Pendaftaran</h3>
                        <?php if ($sudah_mendaftar): ?>
                            <span class="badge-status success">Sudah Mendaftar</span>
                        <?php else: ?>
                            <span class="badge-status" style="background: #fef3c7; color: #d97706;">Belum Mendaftar</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card-body-v2">
                    <?php if ($sudah_mendaftar): ?>
                        <p>Data diri Anda telah tersimpan dengan aman di dalam sistem basis data kami.</p>
                        <p class="text-muted">Silakan periksa kembali detail data atau lakukan perubahan jika ada informasi yang perlu diperbarui.</p>
                    <?php else: ?>
                        <p>Anda belum mengisi formulir pendaftaran data diri. Silakan isi form terlebih dahulu untuk melengkapi data Anda.</p>
                    <?php endif; ?>
                </div>

                <div class="card-footer-v2 action-group">
                    <?php if ($sudah_mendaftar): ?>
                        <a href="lihat_data_user.php" class="btn-v2 btn-primary">Lihat Data</a>
                        <a href="edit.php" class="btn-v2 btn-secondary">Edit Data</a>
                    <?php else: ?>
                        <a href="../form_pendaftaran.php" class="btn-v2 btn-primary" style="width: 100%;">Isi Form Pendaftaran</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>
    <script src="../js/dash_user.js"></script>
</body>
</html>