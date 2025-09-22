<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin) {
        $_SESSION['role'] = 'admin';
        $_SESSION['nama'] = $admin['nama']; 
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Pojok - Admin Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <div class="jumbotron jumbotron-fluid text-center mb-4">
        <div class="container">
            <h1 class="display-4 font-weight-bold">LOGIN <span>ADMIN</span></h1>
            <hr class="my-4 bg-light" />
            <p class="lead font-weight-bold">
                Masukkan username dan password Anda<br />
                untuk mengakses panel admin
            </p>
        </div>
    </div>

    
    <div class="container">
        <div class="login-container">
            <h3 class="mb-4 text-center"><i class="fas fa-user-shield mr-2"></i> Admin Login</h3>
            
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            
            <div class="text-center mt-3">
                <p>Belum punya akun? <a href="register.php" class="register-link">Daftar sebagai admin</a></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p>&copy; 2024 Warung Pojok. All rights reserved.</p>
        </div>
    </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>