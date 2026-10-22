<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran Akun</title>
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Terpisah -->
    <link rel="stylesheet" href="css/log_reg.css">
    <link rel="shortcut icon" href="favicon/add-user.png" type="image/x-icon">
</head>
<body>

    <div class="form-container">
        <h2>Form Pendaftaran Akun</h2>
        <form action="proces/proses_register.php" method="POST">
            
            <!-- Input Username -->
            <div class="form-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-user icon-left"></i>
                    <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>

            <!-- Input Password dengan Show/Hide -->
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock icon-left"></i>
                    <input type="password" name="password" id="password" class="password-input" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" name="daftar">Daftar Sekarang</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
<script src="js/register.js"></script>
</body>
</html>