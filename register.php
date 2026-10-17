<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pendaftaran Akun</title>
    <link rel="stylesheet" href="css/log_reg.css">
</head>
<body>

    <div class="form-container">
        <h2>Form Pendaftaran Akun</h2>
        <form action="proces/proses_register.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="daftar">Daftar Sekarang</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>

</body>
</html>