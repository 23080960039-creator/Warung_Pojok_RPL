<?php
session_start();

// Cek apakah sesi pesanan ada
if (!isset($_SESSION['pesanan']) || empty($_SESSION['pesanan'])) {
    header("Location: index.php"); // Redirect ke keranjang jika tidak ada pesanan
    exit();
}

// Hapus semua data pesanan setelah checkout
unset($_SESSION['pesanan']);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
