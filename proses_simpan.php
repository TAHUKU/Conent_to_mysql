<?php

include "teskoneksi.php";

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama'];
    $email        = $_POST['email'];
    $no_hp        = $_POST['telepon'];
    $alamat       = $_POST['alamat'];
    $Gender       = $_POST['Gender'];

    if (!is_numeric($no_hp)) {
    // Jika bukan angka, gagalkan penyimpanan dan beri peringatan
    echo "<script>alert('Nomor telepon harus diisi dengan angka!'); window.history.back();</script>";
    exit;
}

    $query = "INSERT INTO tes (nama_lengkap, email, no_hp, alamat, Gender) VALUES ('$nama_lengkap', '$email', '$no_hp', '$alamat', '$Gender')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='lihat_data.php';</script>";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>