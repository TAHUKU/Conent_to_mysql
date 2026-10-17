<?php
session_start(); // Wajib dipanggil paling atas agar $_SESSION terbaca
include "../config/teskoneksi.php";

if (isset($_POST['submit'])) {
    // Pastikan user sudah login, ambil username-nya
    $username_login = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $nama_lengkap   = $_POST['nama'];
    $email          = $_POST['email'];
    $no_hp          = $_POST['telepon'];
    $alamat         = $_POST['alamat'];
    $Gender         = $_POST['Gender'];

    // 1. Validasi nomor telepon harus angka
    if (!is_numeric($no_hp)) {
        echo "<script>alert('Nomor telepon harus diisi dengan angka!'); window.history.back();</script>";
        exit;
    }

    // 2. CEK APAKAH EMAIL ATAU NO HP SUDAH TERDAFTAR DI DATABASE
    $cek_duplikat = "SELECT * FROM tes WHERE email = '$email' OR no_hp = '$no_hp'";
    $hasil_cek = mysqli_query($koneksi, $cek_duplikat);

    if (mysqli_num_rows($hasil_cek) > 0) {
        echo "<script>alert('Gagal! Email atau Nomor Telepon tersebut sudah terdaftar.'); window.history.back();</script>";
        exit;
    }

    // 3. Masukkan data ke database, sertakan kolom 'user' untuk menyimpan username yang login
    // Pastikan tipe data kolom 'user' di tabel 'tes' sudah VARCHAR(50) di phpMyAdmin
    $query = "INSERT INTO tes (user, nama_lengkap, email, no_hp, alamat, Gender) 
              VALUES ('$username_login', '$nama_lengkap', '$email', '$no_hp', '$alamat', '$Gender')";
    
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika yang login user biasa, arahkan kembali ke dashboard user
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            echo "<script>alert('Pendaftaran berhasil!'); window.location='../user/dashboard.php';</script>";
        } else {
            // Jika admin yang menginputkan
            echo "<script>alert('Pendaftaran berhasil!'); window.location='../admin/lihat_data.php';</script>";
        }
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>