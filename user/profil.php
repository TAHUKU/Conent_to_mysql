<?php
session_start();
include "../config/teskoneksi.php";

// Keamanan: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// 1. Ambil data akun utama dari tabel 'users'
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
$data_user = mysqli_fetch_assoc($query_user);
$nama_pengguna = $data_user['nama_lengkap'] ?? $username;

// 2. Ambil data pendaftaran dari tabel 'tes' (jika ada)
$query_pendaftaran = mysqli_query($koneksi, "SELECT * FROM tes WHERE user = '$username'");
$data_pendaftaran = mysqli_fetch_assoc($query_pendaftaran);
$sudah_mendaftar = mysqli_num_rows($query_pendaftaran) > 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - v2</title>
    <!-- Panggil CSS Eksternal -->
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../favicon/lihat_data.png" type="image/x-icon">
</head>
<body class="dashboard-body">

    <!-- TOP BAR / HEADER V2 -->
    <header class="topbar-v2">
        <div class="topbar-brand">
            <i class="fa-solid fa-layer-group"></i>
            <span>PortalAplikasi</span>
        </div>

        <div class="topbar-right">
            <div class="user-greeting">
                <span>Halo</span>, <strong><?php echo htmlspecialchars($nama_pengguna); ?></strong>!
            </div>
            
            <!-- Profil Dropdown / Menu Akun -->
            <div class="profile-dropdown-container">
                <div class="profile-avatar active-avatar" onclick="toggleDropdown()">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="dropdown-menu-v2" id="dropdownMenu">
                    <a href="profil.php" style="font-weight: 600; color: #3b82f6;"><i class="fa-solid fa-id-card"></i> Profil Saya</a>
                    <a href="settings.php"><i class="fa-solid fa-gear"></i> Pengaturan Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="main-container-v2">
        
        <!-- NAVIGASI / TABS V2 -->
        <nav class="nav-tabs-v2">
            <a href="dashboard_user.php" class="nav-tab-item">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="lihat_data_user.php" class="nav-tab-item">
                <i class="fa-solid fa-table-list"></i> Lihat Data Pendaftar
            </a>
            <a href="form_pendaftaran.php" class="nav-tab-item">
                <i class="fa-solid fa-file-pen"></i> Form Pendaftaran
            </a>
        </nav>

        <!-- KARTU UTAMA PROFIL -->
        <div class="card-v2" style="max-width: 700px; margin: 0 auto;">
            
            <!-- Header Kartu -->
            <div class="card-header-v2" style="display: flex; align-items: center; gap: 20px;">
                <div class="card-icon blue" style="width: 60px; height: 60px; font-size: 24px; border-radius: 50%;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h3 style="font-size: 18px; margin-bottom: 4px;">Informasi Pribadi Akun</h3>
                    <p class="text-muted" style="margin: 0; font-size: 13px;">Rincian data identitas dan informasi akun Anda yang terdaftar di sistem.</p>
                </div>
            </div>

            <!-- Isi / Body Kartu -->
            <div class="card-body-v2" style="padding: 25px;">
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    
                    <!-- Detail Informasi per Baris -->
                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Username</span>
                        <strong style="color: #1e293b; font-size: 14px;"><?php echo htmlspecialchars($username); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Nama Lengkap</span>
                        <strong style="color: #1e293b; font-size: 14px;"><?php echo htmlspecialchars($nama_pengguna); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Email Terdaftar</span>
                        <strong style="color: #1e293b; font-size: 14px;"><?php echo htmlspecialchars($data_pendaftaran['email'] ?? $data_user['email'] ?? 'Belum diatur'); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Nomor Telepon / HP</span>
                        <strong style="color: #1e293b; font-size: 14px;"><?php echo htmlspecialchars($data_pendaftaran['no_hp'] ?? 'Belum diatur'); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Jenis Kelamin (Gender)</span>
                        <strong style="color: #1e293b; font-size: 14px;"><?php echo htmlspecialchars($data_pendaftaran['Gender'] ?? 'Belum diatur'); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Alamat Lengkap</span>
                        <strong style="color: #1e293b; font-size: 14px; text-align: right; max-width: 60%;"><?php echo htmlspecialchars($data_pendaftaran['alamat'] ?? 'Belum diatur'); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="color: #64748b; font-size: 14px; font-weight: 500;">Kata Sandi (Password)</span>
                        <strong style="color: #94a3b8; font-size: 14px; letter-spacing: 2px;">••••••••••••</strong>
                    </div>

                </div>
            </div>

            <!-- Footer Kartu: Tombol Aksi Cepat -->
            <div class="card-footer-v2" style="display: flex; gap: 12px; justify-content: flex-end; padding: 15px 25px;">
                <?php if ($sudah_mendaftar): ?>
                    <a href="edit.php" class="btn-v2 btn-primary" style="text-decoration: none;"><i class="fa-solid fa-pen-to-square"></i> Edit Data Diri</a>
                <?php else: ?>
                    <a href="form_pendaftaran.php" class="btn-v2 btn-primary" style="text-decoration: none;"><i class="fa-solid fa-plus"></i> Isi Form Pendaftaran</a>
                <?php endif; ?>
                <a href="setting.php" class="btn-v2 btn-secondary" style="text-decoration: none;"><i class="fa-solid fa-gear"></i> Ubah Sandi</a>
            </div>

        </div>

    </main>

    <!-- SCRIPT DROPDOWN PROFIL -->
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown-container')) {
                const menu = document.getElementById('dropdownMenu');
                if (menu && menu.style.display === 'block') {
                    menu.style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>