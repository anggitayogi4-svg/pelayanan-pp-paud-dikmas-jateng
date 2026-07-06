<?php
// 1. Hubungkan ke database db_paud_dikmas
$host     = "localhost";
$username = "root";
$password = ""; 
$database = "db_paud_dikmas";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Ambil ID data yang ingin dihapus dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Jalankan perintah hapus data berdasarkan ID di tabel tbl_pengaduan
    $query = "DELETE FROM tbl_pengaduan WHERE id = '$id'";
    $hapus = mysqli_query($koneksi, $query);

    // 4. Berikan notifikasi dan kembalikan admin ke halaman admin.php
    if ($hapus) {
        echo "<script>
                alert('Laporan berhasil dihapus!');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus laporan.');
                window.location.href = 'admin.php';
              </script>";
    }
} else {
    // Jika tidak ada ID yang dikirim, langsung lempar kembali ke halaman admin
    header("Location: admin.php");
}

mysqli_close($koneksi);
?>