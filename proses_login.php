<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "db_paud_dikmas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Enkripsi password input dengan MD5 untuk dicocokkan dengan database
    $password_md5 = md5($password);

    $query = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password_md5'";
    $hasil = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($hasil) == 1) {
        // Jika cocok, buat session aktif
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;

        header("Location: admin.php");
        exit;
    } else {
        // Jika salah, beri peringatan
        echo "<script>alert('Username atau Password salah!'); window.location.href='login.php';</script>";
    }
}
?>