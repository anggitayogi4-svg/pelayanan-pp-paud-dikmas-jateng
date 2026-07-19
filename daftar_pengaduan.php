<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Pengadu - PP PAUD Dikmas Jateng</title>
    <style>
        /* Menggunakan CSS yang sama dengan login agar konsisten */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f4f7f6;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-header {
            background-color: #2b78e4;
            color: #fff;
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
            color: #fff;
            text-decoration: none;
        }

        .auth-section {
            max-width: 450px;
            width: 100%;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .auth-container {
            background: #fff;
            padding: 35px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #2b78e4;
        }

        .auth-container h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #222;
        }

        .auth-container p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .form-control:focus {
            border-color: #2b78e4;
        }

        .btn-submit {
            width: 100%;
            background-color: #ffcc00;
            color: #222;
            border: none;
            padding: 12px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #e6b800;
        }

        .switch-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .switch-text a {
            color: #2b78e4;
            text-decoration: none;
            font-weight: 600;
        }

        .main-footer {
            background-color: #222;
            color: #aaa;
            text-align: center;
            padding: 20px 0;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <a href="index.php" class="logo-text">PP PAUD DIKMAS JAWA TENGAH</a>
        </div>
    </header>

    <main class="auth-section">
        <div class="auth-container">
            <h2>Daftar Akun</h2>
            <p>Buat akun baru untuk dapat mengunggah pengaduan dan memantau statusnya.</p>

            <!-- Saat sukses daftar, balikkan ke login_pengaduan.php -->
            <form action="login_pengaduan.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" required
                        placeholder="Nama sesuai KTP">
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        placeholder="Contoh: user@gmail.com">
                </div>
                <div class="form-group">
                    <label for="username">Username Baru</label>
                    <input type="text" id="username" name="username" class="form-control" required
                        placeholder="Gunakan huruf kecil/angka">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required
                        placeholder="Minimal 6 karakter">
                </div>
                <button type="submit" class="btn-submit">Daftar Sekarang</button>
            </form>

            <div class="switch-text">
                Sudah punya akun? <a href="login_pengaduan.php">Login Kembali</a>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2022 PP PAUD Dikmas Jawa Tengah. Semua Hak Dilindungi.</p>
    </footer>
</body>

</html>