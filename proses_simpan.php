<?php

include "teskoneksi.php";

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama'];
    $email        = $_POST['email'];
    $no_hp        = $_POST['telepon'];
    $alamat       = $_POST['alamat'];

    $query = "INSERT INTO tes (nama_lengkap, email, no_hp, alamat) VALUES ('$nama_lengkap', '$email', '$no_hp', '$alamat')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='lihat_data.php';</script>";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>