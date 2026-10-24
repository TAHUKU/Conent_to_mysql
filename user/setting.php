<?php
session_start();
include "../config/teskoneksi.php"; // Sesuaikan jalur file koneksi Anda

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil data user dari database untuk mengisi form
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="../css/setting.css"> <!-- Sesuaikan dengan CSS Anda -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <style>
        .settings-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        .alert-success { background-color: #d1fae5; color: #065f46; }
        .alert-danger { background-color: #fee2e2; color: #991b1b; }
    </style> -->
</head>
<body>

    <div class="settings-container">
        <h2><i class="fa-solid fa-gear"></i> Pengaturan Akun</h2>

        <!-- Notifikasi Sukses / Gagal -->
        <?php if (isset($_SESSION['pesan_sukses'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['pesan_sukses']; unset($_SESSION['pesan_sukses']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['pesan_error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['pesan_error']; unset($_SESSION['pesan_error']); ?></div>
        <?php endif; ?>

        <!-- Form 1: Ubah Informasi Profil -->
        <form action="../proces/proses_setting.php" method="POST" class="form-section">
            <h3>Informasi Profil</h3>
            <input type="hidden" name="aksi" value="update_profil">

            <div class="form-group">
                <label>Username</label>
                <input type="text" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" disabled style="background: #f1f5f9;">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>No. HP / WhatsApp</label>
                <input type="text" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-Laki" <?php echo ($user['jenis_kelamin'] ?? '') == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php echo ($user['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan Profil</button>
        </form>

        <form action="../proces/proses_setting.php" method="POST">
            <h3>Keamanan (Ubah Password)</h3>
            <input type="hidden" name="aksi" value="update_password">

            <!-- Password Saat Ini -->
            <div class="form-group">
                <label>Password Saat Ini</label>
                <input type="password" name="password_lama" id="password_lama" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password_lama', this)"></i>
            </div>

            <!-- Password Baru -->
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password_baru" id="password_baru" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password_baru', this)"></i>
            </div>

            <!-- Konfirmasi Password Baru -->
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('konfirmasi_password', this)"></i>
            </div>

          <div class="form-actions">
                <button type="submit" class="btn-submit btn-danger">Ubah Password</button>
                <a href="dashboard_user.php" class="back-link">Kembali ke Dashboard</a>
            </div>
        </form>

        </form>
    </div>

    <script src="../js/setting.js"></script>
</body>
</html>