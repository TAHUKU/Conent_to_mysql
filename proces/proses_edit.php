<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../config/teskoneksi.php";

if (isset($_POST['update'])) {
    $id           = $_POST['user'];
    $nama_lengkap = $_POST['nama'];
    $email        = $_POST['email'];
    $no_hp        = $_POST['telepon'];
    $alamat       = $_POST['alamat'];
    $Gender       = $_POST['Gender'];


    // Query SQL untuk mengubah data berdasarkan ID user
    $query = "UPDATE tes SET nama_lengkap='$nama_lengkap', email='$email', no_hp='$no_hp', alamat='$alamat' , Gender='$Gender' WHERE user='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='../admin/lihat_data.php';</script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
