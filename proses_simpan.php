<?php
// 1. Pengaturan Koneksi ke Database MySQL
$host     = "localhost";
$username = "root";
$password = ""; // Kosongkan jika menggunakan bawaan XAMPP
$database = "db_paud_dikmas";

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// 2. Memproses data ketika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil input dari form dan bersihkan dari karakter berbahaya
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $laporan  = mysqli_real_escape_string($koneksi, $_POST['laporan']);
    
    $nama_file_baru = null; // Default jika user tidak mengunggah file

    // 3. Proses Unggah File Lampiran (Jika Ada)
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $nama_file_asli = $_FILES['lampiran']['name'];
        $ukuran_file    = $_FILES['lampiran']['size'];
        $tmp_file       = $_FILES['lampiran']['tmp_name'];
        
        // Ambil ekstensi file (contoh: .jpg atau .pdf)
        $ekstensi = pathinfo($nama_file_asli, PATHINFO_EXTENSION);
        $ekstensi = strtolower($ekstensi);
        
        // Batasi jenis file yang boleh masuk demi keamanan
        $ekstensi_diperbolehkan = array('jpg', 'jpeg', 'png', 'pdf');
        
        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
            // Batasi ukuran file maksimal 5MB (5 * 1024 * 1024 bytes)
            if ($ukuran_file <= 5242880) {
                // Beri nama unik baru menggunakan fungsi waktu agar file tidak saling menimpa
                $nama_file_baru = time() . '_' . uniqid() . '.' . $ekstensi;
                $folder_tujuan  = 'uploads/' . $nama_file_baru;
                
                // Pindahkan file dari folder sementara ke folder 'uploads'
                move_uploaded_file($tmp_file, $folder_tujuan);
            } else {
                echo "<script>alert('Gagal! Ukuran file terlalu besar, maksimal 5MB.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Gagal! Format file tidak didukung. Gunakan JPG, PNG, atau PDF.'); window.history.back();</script>";
            exit;
        }
    }

    // 4. Menyimpan Semua Data ke Tabel MySQL
    $query = "INSERT INTO tbl_pengaduan (nama, email, kategori, laporan, lampiran) 
              VALUES ('$nama', '$email', '$kategori', '$laporan', '$nama_file_baru')";
              
    $simpan = mysqli_query($koneksi, $query);

    // 5. Berikan umpan balik (feedback) sukses/gagal ke pengguna
    if ($simpan) {
        echo "<script>
                alert('Terima kasih! Laporan Anda berhasil dikirim dan akan segera kami proses.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Maaf, terjadi kesalahan sistem saat menyimpan laporan.');
                window.history.back();
              </script>";
    }
}

// Tutup koneksi ke database setelah selesai
mysqli_close($koneksi);
?>