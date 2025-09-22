<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warung Pojok - Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link accesskey="" rel="stylesheet" href="index.css">
</head>

  <div class="jumbotron jumbotron-fluid text-center mb-4">
    <div class="container">
      <h1 class="display-4 font-weight-bold">WARUNG <span>POJOKowi</span></h1>
      <hr class="my-4 bg-light" />
      <p class="lead font-weight-bold">
        Silahkan Pilih Jenis Login<br />
        Selamat Datang
      </p>
    </div>
  </div>

  <!-- Login Options -->
  <div class="container">
    <div class="login-container text-center">
      <h3 class="mb-4">Pilih Jenis Login</h3>
      <div class="login-option">
        <a href="login.php">
          <button class="btn btn-primary w-100">
            <i class="fas fa-user-shield mr-2"></i> Masuk sebagai Admin
          </button>
        </a>
        <a href="pesanan.php">
          <button class="btn btn-outline-primary w-100">
            <i class="fas fa-user mr-2"></i> Masuk sebagai Pembeli
          </button>
        </a>
      </div>
    </div>
  </div>

  <footer>
    <div class="container text-center">
      <p>&copy; 2024 Warung Pojok. All rights reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>