<?php

include "../config/teskoneksi.php";

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama'];
    $email        = $_POST['email'];
    $no_hp        = $_POST['telepon'];
    $alamat       = $_POST['alamat'];
    $Gender       = $_POST['Gender'];

    // 1. Validasi nomor telepon harus angka
    if (!is_numeric($no_hp)) {
        echo "<script>alert('Nomor telepon harus diisi dengan angka!'); window.history.back();</script>";
        exit;
    }

    // 2. CEK APAKAH EMAIL ATAU NO HP SUDAH TERDAFTAR DI DATABASE
    // Kita gunakan OR supaya jika salah satu sudah ada, sistem langsung mendeteksi
    $cek_duplikat = "SELECT * FROM tes WHERE email = '$email' OR no_hp = '$no_hp'";
    $hasil_cek = mysqli_query($koneksi, $cek_duplikat);

    // mysqli_num_rows() berfungsi untuk menghitung berapa baris data yang ditemukan
    if (mysqli_num_rows($hasil_cek) > 0) {
        // Jika ditemukan lebih dari 0 baris, berarti data sudah pernah ada
        echo "<script>alert('Gagal! Email atau Nomor Telepon tersebut sudah terdaftar.'); window.history.back();</script>";
        exit; // Menghentikan proses agar tidak lanjut menyimpan
    }

    // 3. Jika aman (tidak ada yang sama), masukkan data baru ke tabel tes
    $query = "INSERT INTO tes (nama_lengkap, email, no_hp, alamat, Gender) VALUES ('$nama_lengkap', '$email', '$no_hp', '$alamat', '$Gender')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='lihat_data.php';</script>";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>