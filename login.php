<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PAUD Dikmas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; margin-bottom: 10px; color: #222; }
        p { text-align: center; color: #666; font-size: 0.9rem; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #444; font-size: 0.9rem; }
        input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; background: #fafafa; font-size: 0.95rem; }
        input:focus { outline: none; border-color: #2b78e4; background: #fff; }
        button { width: 100%; background: #2b78e4; color: #fff; border: none; padding: 14px; font-size: 1rem; font-weight: 600; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #1a61c7; }
        .btn-back { display: block; text-align: center; margin-top: 20px; color: #2b78e4; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <p>Hubungankan kredensial Anda untuk masuk ke sistem</p>
    
    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit">Masuk Ke Sistem</button>
        <a href="index.php" class="btn-back">&larr; Kembali ke Form Pengaduan</a>
    </form>
</div>

</body>
</html>