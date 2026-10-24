<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <link rel="shortcut icon" href="../favicon/form_pendaftaran.png" type="image/x-icon">
    <link rel="stylesheet" href="css/pendaf.css">
</head>
<body>
    <h2>Form Pendaftaran Siswa/Peserta</h2>
    <form action="proces/proses_simpan.php" method="POST">
    <label>Nama Lengkap:</label>
    <input type="text" name="nama" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Nomor Telepon:</label>
    <input type="text" name="telepon" pattern="[0-9]+" title="Hanya boleh diisi angka" required>

    <label>Alamat:</label>
    <input type="text" name="alamat" required>

    <label>Gender:</label>
    <select name="Gender" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <button type="submit" name="submit">Daftar Sekarang</button>
    </form>
    <br>
    <a href="user/lihat_data_user.php">Lihat Data Pendaftar</a>
</body>
</html>