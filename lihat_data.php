<?php
// Panggil koneksi database
include "teskoneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar</title>
    <link rel="stylesheet" href="css/look.css">
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Data yang Sudah Masuk</h2>
    <a href="form_pendaftaran.php">+ Tambah Pendaftaran Baru</a>
    
    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Gender</th>
            <th>Aksi</th>

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
             
            
            echo "<td>";
            echo "<a href='edit.php?id=" . $row['user'] . "'>Edit</a> | ";
            echo "<a href='hapus.php?id=" . $row['user'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
            echo "</td>";
            
            echo "</tr>";
        }
        ?>
            <?php if (mysqli_num_rows($result) == 0): ?>
    <tr>
        <td colspan="7" style="text-align:center; padding:20px; color:#999;">
            Belum ada data pendaftar.
        </td>
    </tr>
<?php endif; ?>
    </table>

</body>
</html>