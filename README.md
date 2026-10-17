
# Aplikasi Web Sederhana: Sistem Pendaftaran & Dashboard (PHP Native & MySQL)

Proyek web sederhana berbasis **PHP Native** dan **MySQL** yang dirancang untuk pembelajaran alur kerja *backend*, manajemen sesi (*session*), validasi data, serta penerapan keamanan dasar pada aplikasi web.

## 🚀 Fitur Utama
- **Autentikasi & Role Berbasis Sesi:** Sistem login terpisah untuk *Admin* dan *User* regular.
- **Manajemen Data Mandiri (Data Ownership):** User dapat mengisi, melihat, mengedit, hingga menghapus data pendaftaran mereka sendiri tanpa bisa mengakses data milik user lain.
- **Keamanan Dasar:**
  - Penerapan `error_reporting` dan penanganan *deprecated warnings*.
  - Pencegahan celah keamanan **SQL Injection** menggunakan `mysqli_real_escape_string()`.
- **Dashboard Dinamis:** Status pendaftaran user berubah secara *real-time* (Sudah Mendaftar / Belum Mendaftar) berdasarkan pengecekan database (`mysqli_num_rows`).

## 📁 Struktur Folder Proyek
```text
teskoneksi/
│
├── config/
│   └── teskoneksi.php       # Koneksi database & konfigurasi error
├── proces/
│   ├── proses_edit_user.php # Proses backend untuk update data diri
│   └── proses_hapus.php     # Proses backend untuk hapus data diri
├── user/
│   ├── dashboard.php        # Halaman utama user
│   └── edit_user.php        # Form edit data diri user
├── css/
│   └── look.css             # File styling antarmuka
└── login.php                # Halaman login utama 
```
## 🛠️ Teknologi yang Digunakan
- **PHP (Native)**
- **MySQL / MariaDB (Database, via phpMyAdmin / XAMPP)**
- **HTML5 & CSS3**
- **JavaScript (Untuk konfirmasi aksi)**

## ⚙️ Cara Menjalankan Proyek (Installation)
- **Pastikan Anda sudah menginstal XAMPP (atau Stack PHP/MySQL lokal lainnya).**
- **Kloning repositori ini atau unduh sebagai ZIP ke dalam folder htdocs Anda (contoh: htdocs/teskoneksi/).**
- **Nyalakan Apache dan MySQL melalui XAMPP Control Panel.**
- **Buat database baru di http://localhost/phpmyadmin/ dan impor tabel yang diperlukan.**
- **Sesuaikan konfigurasi koneksi database di config/teskoneksi.php jika diperlukan.**
- **Akses proyek melalui browser: http://localhost/teskoneksi/login.php**

**Dikembangkan sebagai sarana belajar eksplorasi logika pemrograman web dan keamanan siber dasar.**
