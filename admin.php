<?php
session_start();
// 1. Kunci Halaman Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// 2. Pengaturan Koneksi ke Database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_paud_dikmas";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

function tampilkanBadgeStatus($status)
{
    if ($status == 'Belum Diproses') {
        return '<span class="status-badge badge-warning">Belum Diproses</span>';
    } else {
        return '<span class="status-badge badge-success">Selesai</span>';
    }
}

// 3. Fitur Hapus Data
// PENTING: blok ini HARUS ditutup ( } ) sebelum bagian HTML di bawah,
// supaya bagian HTML dashboard tetap tampil saat tidak ada parameter ?hapus=
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);

    // Ambil nama file lampiran lama agar file fisiknya di folder 'uploads' juga terhapus bersih
    $cek_file = mysqli_query($koneksi, "SELECT lampiran FROM tbl_pengaduan WHERE id = '$id_hapus'");
    $data_file = mysqli_fetch_array($cek_file);
    if (!empty($data_file['lampiran']) && file_exists("uploads/" . $data_file['lampiran'])) {
        unlink("uploads/" . $data_file['lampiran']);
    }

    $query_hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengaduan WHERE id = '$id_hapus'");
    if ($query_hapus) {
        echo "<script>alert('Data laporan berhasil dihapus dari sistem!'); window.location.href='admin.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href='admin.php';</script>";
        exit;
    }
} // <- Tutup blok if(isset($_GET['hapus'])) DI SINI, bukan di bawah setelah HTML
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PP PAUD DIKMAS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            color: #000000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-header {
            background-color: #2b78e4;
            color: #ffffff;
            padding: 15px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffffff !important;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-nav {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.85rem;
            border: 1px solid #ffffff;
            padding: 6px 14px;
            border-radius: 4px;
            font-weight: 600;
            transition: background 0.3s, color 0.3s;
        }

        .btn-nav:hover {
            background-color: #ffffff;
            color: #2b78e4;
        }

        .btn-logout {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff !important;
        }

        .btn-logout:hover {
            background-color: #bd2130;
            color: #ffffff !important;
        }

        .content-container {
            max-width: 1200px;
            width: 100%;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .content-title {
            font-size: 1.6rem;
            color: #000000;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .card-table-wrapper {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            text-align: left;
        }

        .modern-table th {
            background-color: #2b78e4;
            color: #ffffff;
            font-weight: 600;
            padding: 14px;
            border: 1px solid #2b78e4;
            text-align: center;
        }

        .modern-table td {
            padding: 14px;
            border-bottom: 1px solid #cbd5e1;
            vertical-align: middle;
            color: #000000 !important;
        }

        .modern-table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .btn-table {
            display: inline-block;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 4px;
            text-align: center;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-table-view {
            color: #2b78e4;
            border-color: #2b78e4;
            background-color: transparent;
        }

        .btn-table-view:hover {
            background-color: #2b78e4;
            color: #ffffff;
        }

        .btn-table-delete {
            color: #dc3545;
            border-color: #dc3545;
            background-color: transparent;
        }

        .btn-table-delete:hover {
            background-color: #dc3545;
            color: #ffffff;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 700;
            border-radius: 20px;
            text-align: center;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #d97706;
            border: 1px solid #f59e0b;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #22c55e;
        }

        .text-center {
            text-align: center !important;
        }

        .text-muted {
            color: #64748b;
            font-style: italic;
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="header-container">
            <h1 class="logo-text">Halaman Admin - PAUD DIKMAS</h1>
            <div class="header-nav">
                <a href="index.php" class="btn-nav">Lihat Form Depan</a>
                <a href="logout.php" class="btn-nav btn-logout"
                    onclick="return confirm('Apakah Anda yakin ingin keluar?');">Logout</a>
            </div>
        </div>
    </header>

    <main class="content-container">
        <h2 class="content-title">Data Pengaduan Masyarakat</h2>

        <div class="card-table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 15%;">Nama Pelapor</th>
                        <th style="width: 15%;">Email</th>
                        <th style="width: 25%;">Isi Laporan</th>
                        <th style="width: 10%;">Lampiran</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 5%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $ambil_data = mysqli_query($koneksi, "SELECT * FROM tbl_pengaduan ORDER BY id DESC");

                    // perulangan baca data satu per satu sampai baris habis
                    if (mysqli_num_rows($ambil_data) == 0) {
                        echo "<tr><td colspan='8' class='text-center text-muted' style='padding: 30px;'>Belum ada laporan masyarakat yang masuk.</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_array($ambil_data)) {
                            $tanggal = (!empty($row['tanggal_kirim'])) ? date('d-m-Y H:i', strtotime($row['tanggal_kirim'])) : date('d-m-Y H:i');
                            //... tampilkan tiap kolom (nama, email, laporan, dst)...
                            ?>
                            <tr>
                                <td class="text-center" style="color: #000000 !important; font-weight: bold;"><?= $no++; ?></td>
                                <td class="text-center" style="color: #000000 !important; font-weight: 500;"><?= $tanggal; ?>
                                </td>
                                <td style="color: #000000 !important; font-weight: bold;"><?= htmlspecialchars($row['nama']); ?>
                                </td>
                                <td style="color: #000000 !important; font-weight: 500;"><?= htmlspecialchars($row['email']); ?>
                                </td>
                                <td style="color: #000000 !important;"><?= nl2br(htmlspecialchars($row['laporan'])); ?></td>

                                <td class="text-center">
                                    <?php if (!empty($row['lampiran'])): ?>
                                        <a href="uploads/<?= $row['lampiran']; ?>" target="_blank"
                                            class="btn-table btn-table-view">Lihat Berkas</a>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 0.85rem;">Tidak Ada</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo tampilkanBadgeStatus($row['status']); ?>
                                    <?php if ($row['status'] == 'Belum Diproses'): ?>
                                        <br>
                                        <a href="ubah_status.php?id=<?= $row['id']; ?>&status=Selesai"
                                            class="btn-table btn-table-view" style="margin-top:5px; display:inline-block;"
                                            onclick="return confirm('Tandai laporan ini sebagai Selesai?');">
                                            Tandai Selesai
                                        </a>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <a href="admin.php?hapus=<?= $row['id']; ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');"
                                        class="btn-table btn-table-delete">Hapus</a>
                                </td>
                            </tr>
                            <?php
                        } // Tutup while
                    } // Tutup else
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>