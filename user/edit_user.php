<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/teskoneksi.php";

// Keamanan: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username_login = $_SESSION['username'];

// Ambil data KHUSUS milik user yang sedang login dari tabel pendaftaran (tes)
$query = mysqli_query($koneksi, "SELECT * FROM tes WHERE user = '$username_login'");
$data = mysqli_fetch_assoc($query);

// Ambil data user aktif untuk sapaan di topbar
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username_login'");
$user_info = mysqli_fetch_assoc($query_user);
$nama_pengguna = $user_info['nama_lengkap'] ?? $username_login;

// Jika user belum pernah mendaftar tapi mencoba akses halaman edit
if (!$data) {
    echo "<script>alert('Anda belum mendaftar data diri!'); window.location='dashboard_user.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Diri - v2</title>
    <!-- Panggil CSS Eksternal -->
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../favicon/edit-info.png" type="image/x-icon">
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
                <div class="profile-avatar" onclick="toggleDropdown()">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="dropdown-menu-v2" id="dropdownMenu">
                    <a href="settings.php"><i class="fa-solid fa-gear"></i> Pengaturan Akun</a>
                    <div class="dropdown-divider"></div>
                    <a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>
        <!-- KARTU FORM EDIT -->
        <div class="card-v2" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header-v2">
                <div class="card-icon blue">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h3>Edit Data Diri Saya</h3>
                    <p class="text-muted" style="margin: 0; font-size: 13px;">Perbarui informasi data diri Anda dengan benar pada formulir di bawah.</p>
                </div>
            </div>

            <div class="card-body-v2">
                <form action="../proces/proses_edit_user.php" method="POST">
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Nama Lengkap:</label>
                        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama_lengkap'] ?? $data['nama'] ?? ''); ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Email:</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Nomor HP:</label>
                        <input type="text" name="no_hp" value="<?php echo htmlspecialchars($data['no_hp'] ?? ''); ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Alamat:</label>
                        <textarea name="alamat" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; height: 90px; resize: vertical; font-size: 14px;"><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-actions" style="display: flex; gap: 12px; align-items: center;">
                        <button type="submit" class="btn-v2 btn-primary" style="flex: 1; padding: 10px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px;">Simpan Perubahan</button>
                        <a href="dashboard_user.php" class="btn-v2 btn-secondary" style="text-align: center; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-size: 14px;">Batal</a>
                    </div>
                </form>
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