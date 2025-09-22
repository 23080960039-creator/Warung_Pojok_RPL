<?php
require 'koneksi.php';

if (!isset($_GET['order_id'])) {
    echo "Order ID tidak ditemukan!";
    exit;
}

$order_id = (int)$_GET['order_id'];

// Ambil data pesanan
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

// Ambil item-item
$stmt_items = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Pesanan - Warung Pojok</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="nota.css">
</head>
<body class="bg-light">
<div class="container position-relative">

    <a href="logout_pembeli.php" class="btn btn-danger logout-btn">Logout</a>

    <div class="nota shadow">
        <div class="header mb-4">
            <h2>Warung Pojok</h2>
            <p><strong>Nota Pembelian</strong></p>
        </div>

        <p><strong>Kode Pesanan:</strong> <?= $order['kode_pesanan'] ?></p>
        <p><strong>Nama Pelanggan:</strong> <?= $order['nama_pelanggan'] ?></p>
        <p><strong>Nomor Meja:</strong> <?= htmlspecialchars($order['nomor_meja'] ?? '-') ?></p> <!-- ✅ DITAMBAHKAN -->
        <p><strong>Tanggal:</strong> <?= date("d-m-Y H:i", strtotime($order['order_date'])) ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= ucfirst($order['metode_pembayaran']) ?></p>

        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($item = $items_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($item['nama_menu']) ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th>Rp <?= number_format($order['total'], 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>

        <?php if (strtolower($order['metode_pembayaran']) === 'qris'): ?>
            <div class="payment text-center">
                <p><strong>Silakan scan QRIS berikut untuk pembayaran:</strong></p>
                <img src="images/qris.png" alt="QRIS" width="200">
            </div>
        <?php elseif (strtolower($order['metode_pembayaran']) === 'tunai'): ?>
            <div class="payment text-center">
                <p><strong>Pembayaran dilakukan secara tunai.</strong></p>
            </div>
        <?php endif; ?>

        <div class="footer">
            <p>Terima kasih telah memesan di <strong>Warung Pojok</strong>!</p>
        </div>
    </div>
</div>
</body>
</html>
