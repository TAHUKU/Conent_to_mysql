<?php
session_start();
include "../config/teskoneksi.php"; 

// Perbaikan urutan: Cek sesi login dulu sebelum mengambil data username
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
$data_user = mysqli_fetch_assoc($query_user);
$nama_pengguna = $data_user['nama_lengkap'] ?? $username;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Pendaftaran - v2</title>
    <!-- Panggil CSS Eksternal -->
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../favicon/lihat_data.png" type="image/x-icon">
</head>
<body class="dashboard-body">

    <!-- TOP BAR / HEADER V2 -->
    <header class="topbar-v2">
        <div class="topbar-brand">
            <i class="fa-solid fa-layer-group"></i>
            <span>PortalAplikasi</span>
        </div>

        <div class="topbar-right">
            <div class="user-greeting">
                <span>Halo</span>, <strong><?php echo htmlspecialchars($nama_pengguna); ?></strong>!
            </div>
            
            <!-- Profil Dropdown / Menu Akun -->
            <div class="profile-dropdown-container">
                <div class="profile-avatar" onclick="toggleDropdown()">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="dropdown-menu-v2" id="dropdownMenu">
                    <a href="settings.php"><i class="fa-solid fa-gear"></i> Pengaturan Akun</a>
                    <div class="dropdown-divider"></div>
                    <a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="main-container-v2">
        
        <!-- NAVIGASI / TABS V2 -->
        <nav class="nav-tabs-v2">
            <a href="dashboard_user.php" class="nav-tab-item">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="lihat_data_user.php" class="nav-tab-item active">
                <i class="fa-solid fa-table-list"></i> Lihat Data Pendaftar
            </a>
            <a href="form_pendaftaran.php" class="nav-tab-item">
                <i class="fa-solid fa-file-pen"></i> Form Pendaftaran
            </a>
        </nav>

        <!-- KARTU KONTEN TABEL -->
        <div class="card-v2">
            <div class="card-header-v2">
                <div class="card-icon blue">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <div>
                    <h3>Daftar Data Pendaftaran</h3>
                    <p class="text-muted" style="margin: 0; font-size: 13px;">Berikut adalah rekapitulasi data pendaftar yang tersimpan di dalam sistem.</p>
                </div>
            </div>

            <div class="card-body-v2" style="padding: 0;">
                <div class="table-responsive">
                    <table class="data-table-v2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Gender</th>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tes";
                            $result = mysqli_query($koneksi, $query);
                            $no = 1;

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td><strong>" . htmlspecialchars($row['nama_lengkap']) . "</strong></td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                                    echo "<td><span class='badge-gender'>" . htmlspecialchars($row['Gender']) . "</span></td>";

                                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                                        echo "<td>
                                                <div class='action-buttons'>
                                                    <a href='../edit.php?id=" . $row['user'] . "' class='btn-v2 btn-secondary' style='padding: 6px 12px; font-size: 12px;'>Edit</a> 
                                                    <a href='../proces/hapus.php?id=" . $row['user'] . "' class='btn-v2 btn-danger-soft' style='padding: 6px 12px; font-size: 12px;' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                                                </div>
                                              </td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' style='text-align: center; padding: 35px; color: #64748b;'>Belum ada data pendaftaran yang tersedia.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- SCRIPT DROPDOWN PROFIL -->
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown-container')) {
                const menu = document.getElementById('dropdownMenu');
                if (menu && menu.style.display === 'block') {
                    menu.style.display = 'none';
                }
            }
        }
    </script>
    <script src="../js/time.js"></script>

</body>
</html>