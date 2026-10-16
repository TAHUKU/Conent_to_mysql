<?php
session_start();
include "teskoneksi.php";
$nama_pengguna = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Data Pengguna</title>
    <!-- Memanggil CSS Eksternal -->
    <link rel="stylesheet" href="css/look.css">
</head>
<body>

    <h2>Daftar Data Pendaftaran</h2>
    
    <!-- Bagian Info Login & Logout -->
    <div class="user-info">
    <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <!-- Tabel Data dengan class "data-table" -->
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

            // Kolom aksi khusus admin atau tampilan bersih untuk user biasa
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<td>
                        <a href='edit.php?id=" . $row['user'] . "' class='btn-edit'>Edit</a> 
                        <a href='hapus.php?id=" . $row['user'] . "' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                      </td>";
            }

            echo "</tr>";
        }
        ?>
    </table>

    <!-- <h2 id="teks-sapaan" data-nama="<?php echo htmlspecialchars($nama_pengguna); ?>"></h2> -->

    <!-- Panggil file JavaScript di bagian bawah sebelum tag penutup body -->
    <script src="js/time.js"></script>

</body>
</html>