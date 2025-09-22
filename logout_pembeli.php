<?php
session_start();

// Hapus semua data pesanan
unset($_SESSION['pesanan']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Checkout Berhasil</title>
  </head>
  <body>
    <div class="container mt-5 text-center">
      <h1>Pesanan Berhasil Dibuat!</h1>
      <p>Terima kasih telah memesan. Silakan keluar untuk mengakhiri sesi Anda.</p>
      <a href="index.php" class="btn btn-danger mt-3">Keluar</a>
    </div>
  </body>
</html>
