<?php
// ==========================================
// ELEMEN 3.4: ARRAY DIMENSI, TIPE, PANJANG & PENGURUTAN
// ==========================================
// 1. Array satu dimensi berisi kategori laporan (tipe data: array of string)
$daftar_kategori = array("Kurikulum", "Pelayanan", "Lainnya", "Sarana Prasarana");

// 2. Menghitung panjang array dengan fungsi count()
$jumlah_kategori = count($daftar_kategori);

// 3. Pengurutan array secara alfabetis (A-Z) dengan fungsi sort()
sort($daftar_kategori);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan & Aspirasi - PAUD Dikmas Jawa Tengah</title>
    
    <!-- KODE CSS LANGSUNG DI DALAM HTML AGAR ANTI-GAGAL -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            color: #333333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-header {
            background-color: #2b78e4;
            color: #ffffff;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo-text {
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-admin {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.9rem;
            border: 1px solid #ffffff;
            padding: 6px 15px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .btn-admin:hover {
            background-color: #ffffff;
            color: #2b78e4;
        }

        .content-container {
            flex: 1;
            max-width: 750px;
            width: 100%;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-section {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .form-section h2 {
            color: #222222;
            font-size: 1.6rem;
            margin-bottom: 8px;
            text-align: center;
        }

        .subtitle {
            color: #666666;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #444444;
            font-size: 0.9rem;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            background-color: #fafafa;
            font-size: 0.95rem;
            color: #333333;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2b78e4;
            background-color: #ffffff;
        }

        .form-group input[type="file"] {
            display: block;
            margin-top: 5px;
            font-size: 0.9rem;
        }

        .file-hint {
            display: block;
            color: #888888;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #2b78e4;
            color: #ffffff;
            border: none;
            padding: 14px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(43, 120, 228, 0.2);
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn-submit:hover {
            background-color: #1a61c7;
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .main-footer {
            background-color: #222222;
            color: #aaaaaa;
            text-align: center;
            padding: 15px 0;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <h1 class="logo-text">PAUD DIKMAS JAWA TENGAH</h1>
            <a href="login.php" class="btn-admin">Login Admin</a>
        </div>
    </header>

    <main class="content-container">
        <section class="form-section">
            <h2>Layanan Pengaduan & Aspirasi Masyarakat</h2>
            <p class="subtitle">Sampaikan laporan Anda langsung kepada tim pelayanan PAUD Dikmas Jawa Tengah</p>

            <form action="proses_simpan.php" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                </div>

                <!-- BAGIAN YANG DIPERBAIKI MENGGUNAKAN ARRAY & FOREACH -->
                <div class="form-group">
                    <label for="kategori">Kategori Laporan</label>
                    <select id="kategori" name="kategori" required>
                        <option value="" disabled selected>-- Pilih Kategori (Total: <?php echo $jumlah_kategori; ?>) --</option>
                        <?php 
                        // Perulangan foreach untuk mengeluarkan data dari dalam array buatan sendiri
                        foreach ($daftar_kategori as $kategori) {
                            echo "<option value='" . htmlspecialchars($kategori) . "'>" . htmlspecialchars($kategori) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="laporan">Isi Laporan / Aspirasi</label>
                    <textarea id="laporan" name="laporan" rows="6" placeholder="Tuliskan aduan atau masukan Anda secara jelas..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="lampiran">Unggah Lampiran / Bukti (Opsional)</label>
                    <input type="file" id="lampiran" name="lampiran" accept="image/*,.pdf">
                    <small class="file-hint">Format yang diizinkan: Gambar (JPG/PNG) atau PDF</small>
                </div>

                <button type="submit" class="btn-submit">Kirim Laporan Masyarakat</button>

            </form>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; 2022 PAUD Dikmas Jawa Tengah. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>
