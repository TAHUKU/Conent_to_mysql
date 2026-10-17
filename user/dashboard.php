<?php
session_start();
// Pastikan hanya user biasa yang bisa akses
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

include "../config/teskoneksi.php"; 
$nama_pengguna = $_SESSION['username'];

// Cek apakah user ini sudah pernah mengisi form pendaftaran
// (Asumsi data pendaftaran mencatat username atau kita sesuaikan dengan kolom relasinya)
$cek_pendaftar = mysqli_query($koneksi, "SELECT * FROM tes WHERE user = '$nama_pengguna'");
$sudah_daftar = mysqli_num_rows($cek_pendaftar) > 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <!-- Memanggil CSS eksternal -->
    <link rel="stylesheet" href="../css/data.css">
</head>
<body>

    <h2>Dashboard User</h2>
    
    <!-- Bagian Info Login & Sapaan -->
    <div class="user-info">
        <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>

    <!-- Menu Navigasi User -->
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="../form_pendaftaran.php">Form Pendaftaran</a>
        <!-- <a href="../logout.php">Logout</a> -->
    </nav>

    <!-- Kartu Informasi / Selamat Datang -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Status Akun</h3>
            <p class="card-number" style="font-size: 1.5rem; color: #2ecc71;">Aktif</p>
            <p style="margin-top: 10px; color: #7f8c8d;">Selamat datang, <b><?php echo htmlspecialchars($nama_pengguna); ?></b>. Anda login sebagai User.</p>
        </div>

        <div class="card">
            <h3>Status Pendaftaran</h3>
            <?php if ($sudah_daftar) { ?>
                <!-- Teks jika sudah mendaftar -->
                <p class="card-number" style="font-size: 1.3rem; color: #27ae60;">Sudah Mendaftar</p>
                <p style="margin-top: 10px; color: #7f8c8d; font-size: 0.95rem;">
                    Data diri Anda telah tersimpan di sistem. Terima kasih telah mendaftar!
                </p>
               <a href="../admin/lihat_data.php" class="btn-lihat">Lihat Data Pendaftaran Saya</a>
            <?php } else { ?>
                <!-- Teks jika belum mendaftar -->
                <p class="card-number" style="font-size: 1.3rem; color: #e74c3c;">Belum Mendaftar</p>
                <p style="margin-top: 10px; margin-bottom: 15px; color: #7f8c8d; font-size: 0.95rem;">
                    Silakan lengkapi data diri Anda melalui tombol di bawah ini.
                </p>
                <a href="../form_pendaftaran.php" class="card-link">Isi Form Pendaftaran &rarr;</a>
            <?php } ?>
        </div>
    </div>

    <!-- Panggil file JS untuk sapaan dinamis waktu -->
    <script src="../js/time.js"></script>

</body>
</html>