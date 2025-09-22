<?php
session_start();
include 'koneksi.php';

// Ambil semua pesanan dari tabel orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$orders = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Warung Pojok</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel ="stylesheet" href="kelola_pesanan_admin.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-clipboard-list"></i> Kelola Pesanan
            </h1>
            <a href="admin_dashboard.php" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
        
        <?php if (mysqli_num_rows($orders) > 0): ?>
            <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                <?php 
                $order_id = $order['id'];
                $status_class = 'status-' . $order['status'];
                ?>
                
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="order-id"><?= $order['kode_pesanan'] ?></span>
                            <span> • </span>
                            <span class="customer-name"><?= $order['nama_pelanggan'] ?></span>
                        </div>
                        <span class="order-status <?= $status_class ?>"><?= $order['status'] ?></span>
                    </div>
                    
                    <div class="order-body">
                        <div class="order-meta">
                            <div class="meta-item">
                                <span class="meta-label">Nomor Meja</span>
                                <span class="meta-value"><?= htmlspecialchars($order['nomor_meja'] ?? '-') ?></span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Total Pesanan</span>
                                <span class="meta-value price">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Metode Pembayaran</span>
                                <span class="meta-value"><?= ucfirst($order['metode_pembayaran']) ?></span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Tanggal Pesanan</span>
                                <span class="meta-value"><?= date('d M Y H:i', strtotime($order['order_date'])) ?></span>
                            </div>
                        </div>
                        
                        <h5 style="margin-bottom: 15px; font-size: 16px;">Rincian Pesanan:</h5>
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
                                while ($item = mysqli_fetch_assoc($items)):
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nama_menu']) ?></td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        
                        <form method="post" action="update_status.php" class="status-form">
                            <input type="hidden" name="order_id" value="<?= $order_id ?>">
                            <select name="status" class="form-select">
                                <?php foreach (['pending' => 'Pending', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $value => $label): ?>
                                    <option value="<?= $value ?>" <?= $value == $order['status'] ? 'selected' : '' ?>>
                                        <?= $label ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync-alt"></i> Update Status
                            </button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard"></i>
                </div>
                <h3 style="margin-bottom: 10px; color: var(--text);">Belum ada pesanan</h3>
                <p class="empty-text">Tidak ada pesanan yang ditemukan</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>