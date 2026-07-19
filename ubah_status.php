<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once 'PengaduanOOP.php';

use App\Pengaduan\Pengaduan;

$host = "localhost";
$username = "root";
$password = "";
$database = "db_paud_dikmas";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int) $_GET['id'];
    $statusBaru = $_GET['status'];

    // Ambil data lama dari database untuk dibuat jadi objek Pengaduan
    $ambil = mysqli_query($koneksi, "SELECT nama, kategori, status FROM tbl_pengaduan WHERE id = $id");
    $data = mysqli_fetch_array($ambil);

    if ($data) {
        $pengaduan = new Pengaduan($data['nama'], $data['kategori'], $data['status']);
        $pengaduan->ubahStatus($statusBaru); // <-- pakai method OOP Elemen 4.2
        $pengaduan->updateStatusDatabase($koneksi, $id);
    }
}

header("Location: admin.php");
exit;