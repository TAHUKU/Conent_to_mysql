<?php
include "teskoneksi.php";

// Tangkap ID yang dikirim dari URL
$id = $_GET['id'];

// Ambil data berdasarkan ID user
$query = "SELECT * FROM tes WHERE user = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
if (!$row) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='lihat_data.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pendaftar</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <h2>Edit Data Pendaftar</h2>
    <form action="proses_edit.php" method="POST">
        <!-- Kirim ID secara tersembunyi (hidden) agar sistem tahu data mana yang diubah -->
        <input type="hidden" name="user" value="<?php echo $row['user']; ?>">

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" value="<?php echo $row['nama_lengkap']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="telepon" value="<?php echo $row['no_hp']; ?>" required><br><br>

        <label>Alamat:</label><br>
        <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>" required><br><br>

       <label>Gender:</label><br>
        <select name="Gender" required>
            <option value="Laki-laki" <?php echo ($row['Gender'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="Perempuan" <?php echo ($row['Gender'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
        </select><br><br>
        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
    <br>
    <a href="lihat_data.php">Kembali ke Daftar Data</a>
</body>
</html>