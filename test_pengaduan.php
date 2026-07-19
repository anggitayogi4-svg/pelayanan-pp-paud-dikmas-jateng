<?php
// File ini membuktikan class PengaduanOOP.php bekerja DAN
// benar-benar bisa menyimpan data ke database (tbl_pengaduan).
// Setelah dijalankan, cek admin.php untuk lihat datanya muncul.

require_once 'PengaduanOOP.php';

use App\Pengaduan\Pengaduan;
use App\Pengaduan\PengaduanUrgent;

// --- Koneksi ke database (sama seperti di admin.php) ---
$host = "localhost";
$username = "root";
$password = "";
$database = "db_paud_dikmas";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

echo "<h2>Uji Coba Class Pengaduan (Bukti Elemen 4.1 - 4.4)</h2>";

// --- Elemen 4.1: buat objek dari class Pengaduan ---
$laporan1 = new Pengaduan("Budi Santoso", "Fasilitas Rusak");
echo "Nama pelapor (lewat getter getNama()): " . $laporan1->getNama() . "<br>";
echo "Status awal (default constructor): " . $laporan1->status . "<br><br>";

// --- Elemen 4.2: uji method ubahStatus() dengan tipe data & percabangan ---
$laporan1->ubahStatus("Selesai");
echo "Status setelah diubah ke 'Selesai': " . $laporan1->status . "<br>";

$laporan1->ubahStatus("Ngasal"); // nilai tidak valid
echo "Status jika diisi nilai TIDAK VALID ('Ngasal'): " . $laporan1->status . " (otomatis kembali ke default)<br><br>";

// --- Elemen 4.3 & 4.4: inheritance, polymorphism, interface ---
$laporanBiasa = new Pengaduan("Siti Aminah", "Kebersihan");
$laporanUrgent = new PengaduanUrgent("Andi Wijaya", "Keamanan");

echo "Notifikasi dari Pengaduan biasa:<br>";
echo $laporanBiasa->kirimNotifikasi("Laporan Anda sedang diproses") . "<br><br>";

echo "Notifikasi dari PengaduanUrgent (method di-override / polymorphism):<br>";
echo $laporanUrgent->kirimNotifikasi("Laporan Anda sedang diproses") . "<br><br>";

// ================================================================
// BUKTI TAMBAHAN: menyimpan objek ke database via simpanKeDatabase()
// ================================================================
echo "<hr><h3>Uji Coba Simpan ke Database</h3>";

$berhasil1 = $laporanBiasa->simpanKeDatabase($koneksi);
$berhasil2 = $laporanUrgent->simpanKeDatabase($koneksi, "bukti_urgent.pdf");

if ($berhasil1) {
    echo "Data 'Siti Aminah' berhasil disimpan ke tabel tbl_pengaduan.<br>";
} else {
    echo "Gagal menyimpan data 'Siti Aminah': " . mysqli_error($koneksi) . "<br>";
}

if ($berhasil2) {
    echo "Data 'Andi Wijaya' (dengan lampiran) berhasil disimpan ke tabel tbl_pengaduan.<br>";
} else {
    echo "Gagal menyimpan data 'Andi Wijaya': " . mysqli_error($koneksi) . "<br>";
}

echo "<br><a href='admin.php'>Cek hasilnya di halaman Admin &raquo;</a>";