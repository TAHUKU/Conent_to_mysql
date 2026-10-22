<?php
session_start();
// include "config/teskoneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Admin</title>
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Panggil CSS Eksternal -->
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <h2>Selamat Datang</h2>
        <p>Silakan masuk ke akun Anda</p>
    </div>

    <!-- Form Login -->
    <form action="cek_login.php" method="POST">
        
        <!-- Input Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-user icon-left"></i>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="off">
            </div>
        </div>

        <!-- Input Password dengan Fitur Show/Hide -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock icon-left"></i>
                <input type="password" id="password" name="password" class="password-input" placeholder="Masukkan password" required>
                <!-- Tombol Toggle Mata -->
                <button type="button" id="togglePasswordBtn" class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn-login">Masuk Sekarang</button>

    </form>

    <div class="login-footer">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
</div>

<!-- Panggil JavaScript Eksternal -->
<script src="js/login.js"></script>

</body>
</html>