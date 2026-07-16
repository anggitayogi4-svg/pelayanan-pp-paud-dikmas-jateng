<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - PP PAUD Dikmas Jawa Tengah</title>
    <style>
        /* Ubah atau timpa kode hero lawas dengan ini */
        .hero-section {
            background: linear-gradient(135deg, #2b78e4 0%, #1a61c7 100%);
            color: #ffffff;
            padding: 60px 20px;
        }

        .hero-container {
            max-width: 1100px;
            /* Diperlebar agar muat teks + gambar */
            margin: 0 auto;
        }

        /* Flexbox untuk membagi wilayah kiri dan kanan */
        .flex-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            text-align: left;
            /* Teks rata kiri agar seimbang dengan gambar di kanan */
        }

        .hero-text-content {
            flex: 1;
        }

        .hero-image-content {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        /* Mengatur ukuran gambar agar proporsional dan transparan */
        .img-fluid-transparent {
            max-width: 100%;
            height: auto;
            max-height: 350px;
            /* Batasi tinggi maksimal agar tidak terlalu besar */
            object-fit: contain;
            filter: drop-shadow(0px 10px 20px rgba(0, 0, 0, 0.15));
            /* Memberi efek bayangan halus pada gambar transparan */
        }

        /* Responsif: Jika dibuka di HP, gambar otomatis pindah ke bawah teks */
        @media (max-width: 768px) {
            .flex-hero {
                flex-direction: column;
                text-align: center;
            }

            .img-fluid-transparent {
                max-height: 250px;
                margin-top: 20px;
            }
        }

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

        /* Header */
        .main-header {
            background-color: #2b78e4;
            color: #ffffff;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo-text {
            font-size: 1.2rem;
            font-weight: 600;
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

        /* Hero Section / Sambutan Utama */
        .hero-section {
            background: linear-gradient(135deg, #2b78e4 0%, #1a61c7 100%);
            color: #ffffff;
            text-align: center;
            padding: 80px 20px;
        }

        .hero-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-section h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.1rem;
            margin-bottom: 35px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Tombol Utama */
        .btn-main-action {
            display: inline-block;
            background-color: #ffcc00;
            /* Warna kuning kontras menarik perhatian */
            color: #222222;
            text-decoration: none;
            padding: 15px 35px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s, background-color 0.3s;
        }

        .btn-main-action:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
        }

        /* Fitur / Informasi Singkat */
        .info-section {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
            flex: 1;
        }

        .info-section h3 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.6rem;
            color: #222;
        }

        .grid-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .card-info {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
            border-top: 4px solid #2b78e4;
        }

        .card-info h4 {
            font-size: 1.2rem;
            margin-bottom: 12px;
            color: #2b78e4;
        }

        .card-info p {
            font-size: 0.95rem;
            color: #666666;
            line-height: 1.5;
        }

        /* Footer */
        .main-footer {
            background-color: #222222;
            color: #aaaaaa;
            text-align: center;
            padding: 20px 0;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <!-- Header Atas -->
    <header class="main-header">
        <div class="header-container">
            <h1 class="logo-text">PP PAUD DIKMAS JAWA TENGAH</h1>
            <a href="login.php" class="btn-admin">Login Admin</a>
        </div>
    </header>

    <!-- Bagian Banner Utama (Hero) dengan Layout Kiri-Kanan -->
    <!-- Bagian Banner Utama (Hero) Desain Tengah Elegan -->
    <section class="hero-section">
        <div class="hero-container">
            <h2>Sistem Layanan Pengaduan & Aspirasi Masyarakat</h2>
            <p>Suara Anda penting bagi kami. Laporkan segala kendala, saran, atau aduan terkait pelayanan PAUD dan
                Pendidikan Masyarakat demi pelayanan yang lebih baik dan transparan.</p>
            <div style="margin-top: 30px;">
                <a href="login_pengaduan.php" class="btn-main-action">Buat Laporan Sekarang &rarr;</a>
            </div>
        </div>
    </section>

    <!-- Bagian Informasi Alur Kerja -->
    <section class="info-section">
        <h3>Alur Pengaduan Masyarakat</h3>
        <div class="grid-info">
            <div class="card-info">
                <h4>1. Tulis Laporan</h4>
                <p>Isi formulir pengaduan secara lengkap dan lampirkan foto bukti fisik jika diperlukan.</p>
            </div>
            <div class="card-info">
                <h4>2. Verifikasi Data</h4>
                <p>Tim admin internal PP PAUD Dikmas akan memeriksa dan memverifikasi laporan yang masuk.</p>
            </div>
            <div class="card-info">
                <h4>3. Tindak Lanjut</h4>
                <p>Laporan akan diteruskan ke divisi terkait untuk segera diselesaikan secara tuntas.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; 2022 PP PAUD Dikmas Jawa Tengah. Semua Hak Dilindungi.</p>
    </footer>

</body>

</html>