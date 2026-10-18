<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="css/log_reg.css">
    <link rel="shortcut icon" href="favicon/login.png" type="image/x-icon">
</head>
<body>

    <div class="form-container">
        <h2>Silakan Login</h2>
        <form action="proces/proses_login.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
        
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>

</body>
</html>