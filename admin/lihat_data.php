<?php
session_start();
// Karena di dalam folder admin, naik satu tingkat ke config
include "../config/teskoneksi.php"; 
$nama_pengguna = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Data Pengguna</title>
    <!-- Panggil CSS dengan naik satu tingkat (../) -->
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <h2>Daftar Data Pendaftaran</h2>
    
    <!-- Bagian Info Login & Logout -->
    <div class="user-info">
        <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>

    <!-- Navigasi Admin -->
 <!-- Navigasi Admin yang sudah diberi gaya -->
 <nav>
    <a href="lihat_data.php">Data Pendaftar</a>
    <!-- <a href="lihat_user.php">Daftar Akun User</a> -->
    <!-- <a href="../logout.php">Logout</a> -->
</nav>

    <!-- Tabel Data -->
    <table class="data-table">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Gender</th>
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>

        <?php
        $query = "SELECT * FROM tes";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama_lengkap'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['no_hp'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<td>
                        <a href='../edit.php?id=" . $row['user'] . "' class='btn-edit'>Edit</a> 
                        <a href='../proces/hapus.php?id=" . $row['user'] . "' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                      </td>";
            }

           echo "</tr>";// (Catatan: perbaiki tanda kutip echo baris ini jika sempat error)
        }
        ?>
    </table>

    <!-- Panggil JS dengan naik satu tingkat (../) -->
    <script src="../js/time.js"></script>

</body>
</html>