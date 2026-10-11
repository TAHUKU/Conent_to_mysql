<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
</head>
<body>
    <h2>Form Pendaftaran Siswa/Peserta</h2>
    <form action="proses_simpan.php" method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="telepon" required><br><br>

            <label>alamat:</label><br>
        <input type="text" name="alamat" required><br><br>

        <button type="submit" name="submit">Daftar Sekarang</button>
    </form>
    <br>
    <a href="lihat_data.php">Lihat Data Pendaftar</a>
</body>
</html>