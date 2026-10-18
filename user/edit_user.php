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

// Ambil data KHUSUS milik user yang sedang login
$query = mysqli_query($koneksi, "SELECT * FROM tes WHERE user = '$username_login'");
$data = mysqli_fetch_assoc($query);

// Jika user belum pernah mendaftar tapi mencoba akses halaman edit
if (!$data) {
    echo "<script>alert('Anda belum mendaftar data diri!'); window.location='dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Diri</title>
    <link rel="stylesheet" href="../css/data.css">
    <link rel="shortcut icon" href="../favicon/edit-info.png" type="image/x-icon">
</head>
<body>
    <div class="card" style="max-width: 500px; margin: 50px auto; padding: 20px;">
        <h2>Edit Data Diri Saya</h2>
        <form action="../proces/proses_edit_user.php" method="POST">
            
            <div style="margin-bottom: 15px;">
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama'] ?? ''); ?>" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email:</label><br>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Nomor HP:</label><br>
                <input type="text" name="no_hp" value="<?php echo htmlspecialchars($data['no_hp'] ?? ''); ?>" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Alamat:</label><br>
                <textarea name="alamat" required style="width: 100%; padding: 8px; margin-top: 5px; height: 80px;"><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn-lihat" style="border: none; cursor: pointer; width: 100%;">Simpan Perubahan</button>
            <a href="dashboard.php" style="display: block; text-align: center; margin-top: 15px; color: #7f8c8d; text-decoration: none;">Batal</a>
        </form>
    </div>
</body>
</html>