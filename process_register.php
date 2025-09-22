<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    // Validasi input kosong
    if (empty($nama) || empty($username) || empty($password) || empty($confirm)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Semua field harus diisi!'];
        header("Location: register.php");
        exit;
    }

    // Validasi konfirmasi password
    if ($password !== $confirm) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Konfirmasi password tidak cocok!'];
        header("Location: register.php");
        exit;
    }

    // Cek apakah username sudah ada di tabel admin
    $check = mysqli_prepare($conn, "SELECT id FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($check, "s", $username);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Username sudah digunakan!'];
        header("Location: register.php");
        exit;
    }

    // Simpan ke tabel admin (password tanpa hash)
    $stmt = mysqli_prepare($conn, "INSERT INTO admin (nama, username, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama, $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Pendaftaran admin berhasil! Silakan login.'];
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Gagal mendaftar: ' . mysqli_error($conn)];
        header("Location: register.php");
        exit;
    }
}
?>