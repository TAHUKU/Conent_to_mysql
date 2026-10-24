<?php
session_start();
$batas_waktu = 1800; 

if (isset($_SESSION['terakhir_aktivitas'])) {
    if ((time() - $_SESSION['terakhir_aktivitas']) > $batas_waktu) {
        session_unset();
        session_destroy();
        header("Location: ../login.php?pesan=timeout");
        exit;
    }
}
$_SESSION['terakhir_aktivitas'] = time();
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
    <link rel="shortcut icon" href="../favicon/user.png" type="image/x-icon">
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
        <a href="dashboard_user.php">Dashboard</a>
        <a href="../form_pendaftaran.php">Form Pendaftaran</a>
        <a href="setting.php" class="nav-item">
        <i class="fa-solid fa-gear"></i> Pengaturan Akun
</a>
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
               <a href="lihat_data_user.php" class="btn-lihat">Lihat Data Pendaftaran Saya</a>
               <a href="edit_user.php" class="btn-lihat" style="background-color: #3498db; margin-left: 10px;">Edit Data Diri Saya</a>
               <a href="../proces/proses_hapus_user.php" class="btn-lihat" style="background-color: #e74c3c; margin-left: 10px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini?');">Hapus Pendaftaran</a>
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
    <script src="../js/auto_logout.js"></script>


</body>
</html>