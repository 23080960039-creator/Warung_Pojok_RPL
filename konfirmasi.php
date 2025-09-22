<?php
session_start();
include 'koneksi.php';

// Cek parameter kode_pesanan
if (!isset($_GET['kode_pesanan'])) {
    header("Location: index.php");
    exit();
}

$kode_pesanan = $_GET['kode_pesanan'];

// Ambil data pesanan
$query = "SELECT * FROM orders WHERE kode_pesanan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $kode_pesanan);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    header("Location: index.php");
    exit();
}

// Ambil item pesanan
$query_items = "SELECT * FROM order_items WHERE order_id = ?";
$stmt_items = $conn->prepare($query_items);
$stmt_items->bind_param("i", $order['id']);
$stmt_items->execute();
$items = $stmt_items->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - Warung Pojok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="konfirmasi.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-check-circle me-2"></i>Pesanan Berhasil</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h4>Terima kasih telah memesan di Warung Pojok!</h4>
                            <p>Pesanan Anda sedang diproses</p>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Detail Pesanan</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Kode Pesanan:</strong><br><?= $order['kode_pesanan'] ?></p>
                                    <p><strong>Tanggal Pesan:</strong><br><?= date('d M Y H:i', strtotime($order['order_date'])) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Nama Pelanggan:</strong><br><?= $order['nama_pelanggan'] ?></p>
                                    <p><strong>Status:</strong><br>
                                        <span class="badge badge-<?= $order['status'] ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Item Pesanan</h5>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?= $item['nama_menu'] ?></td>
                                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th>Rp <?= number_format($order['total'], 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="text-center">
                            <a href="index.php" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>