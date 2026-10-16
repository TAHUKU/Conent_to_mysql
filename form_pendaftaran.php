<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <h2>Form Pendaftaran Siswa/Peserta</h2>
    <form action="proces/proses_simpan.php" method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Nomor Telepon:</label><br>
       <input type="text" name="telepon" pattern="[0-9]+" title="Hanya boleh diisi angka" required>

            <label>alamat:</label><br>
        <input type="text" name="alamat" required><br><br>

             <label>Gender:</label><br>
            <select name="Gender" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br><br>

        <button type="submit" name="submit">Daftar Sekarang</button>
    </form>
    <br>
    <a href="lihat_data.php">Lihat Data Pendaftar</a>
</body>
</html>