<?php
session_start();
// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

// Panggil koneksi database
include "../config/teskoneksi.php"; 
$nama_pengguna = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun User</title>
    <!-- Memanggil CSS eksternal -->
    <link rel="stylesheet" href="../css/data.css">
</head>
<body>

    <h2>Manajemen Akun Pengguna</h2>
    
    <!-- Bagian Info Login & Sapaan -->
    <div class="user-info">
        <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>

    <!-- Menu Navigasi Admin -->
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="lihat_data.php">Data Pendaftar</a>
        <a href="lihat_user.php">Daftar Akun User</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <!-- Tabel Data Pengguna -->
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role / Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM users");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['role']); ?></td>
                <td>
                    <!-- Tombol Hapus User -->
                    <a href="../proces/hapus_user.php?id=<?php echo $row['id']; ?>" 
                       class="btn-hapus" 
                       onclick="return confirm('Yakin ingin menghapus akun user ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Panggil file JS untuk sapaan dinamis waktu -->
    <script src="../js/time.js"></script>

</body>
</html>