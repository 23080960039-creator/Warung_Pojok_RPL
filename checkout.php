<?php
session_start();
include 'koneksi.php'; // pastikan ini membuat variabel $conn

// Validasi: cek apakah keranjang kosong
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    die("Keranjang kosong, tidak bisa checkout.");
}

$nama_pelanggan = $_POST['nama_pelanggan'] ?? 'Pelanggan';
$metode_pembayaran = $_POST['metode_pembayaran'] ?? 'tunai';
$kode_pesanan = 'POJOK' . time();
$catatan = $_POST['catatan'] ?? '';
$total = 0;

//Hitung total pesanan
foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) {
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id_menu");
    $menu = mysqli_fetch_assoc($query);
    if (!$menu) continue;

    $subtotal = $menu['harga'] * $jumlah;
    $total += $subtotal;
}

// Simpan ke tabel orders
mysqli_query($conn, "INSERT INTO orders (kode_pesanan, nama_pelanggan, total, metode_pembayaran, catatan) 
    VALUES ('$kode_pesanan', '$nama_pelanggan', $total, '$metode_pembayaran', '$catatan')");

// Ambil ID order terakhir
$order_id = mysqli_insert_id($conn);

// Proses detail pesanan
foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) {
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id_menu");
    $menu = mysqli_fetch_assoc($query);
    if (!$menu) continue;

    // Periksa stok cukup
    if ($menu['stok'] < $jumlah) {
        die("Stok tidak cukup untuk menu: " . htmlspecialchars($menu['nama_menu']));
    }

    // Kurangi stok
    $stok_baru = $menu['stok'] - $jumlah;
    $update_stok = mysqli_query($conn, "UPDATE menu SET stok = $stok_baru WHERE id = $id_menu");

    if (!$update_stok) {
        die("Gagal mengurangi stok: " . mysqli_error($conn));
    }

    // Simpan ke order_items
    $harga = $menu['harga'];
    $subtotal = $harga * $jumlah;

    mysqli_query($conn, "INSERT INTO order_items (order_id, menu_id, nama_menu, harga, quantity, subtotal)
        VALUES ($order_id, $id_menu, '{$menu['nama_menu']}', $harga, $jumlah, $subtotal)");
}

// Kosongkan keranjang setelah checkout
unset($_SESSION['keranjang']);

// Tampilkan konfirmasi
echo "✅ Pesanan berhasil!<br>";
echo "Kode Pesanan: <strong>$kode_pesanan</strong><br>";
echo "<a href='index.php'>Kembali ke menu</a>";
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - POJOK Restaurant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <div class="container">
        <div class="checkout-card">
            <div class="checkout-header">
                <h2>Checkout Pesanan</h2>
            </div>
            
            <div class="checkout-body">
                <?php if(isset($kode_pesanan)): ?>
                    <!-- Success Message -->
                    <div class="success-message">
                        <div class="success-icon">✓</div>
                        <h3>Pesanan Berhasil!</h3>
                        <p>Terima kasih telah memesan di POJOK Restaurant.</p>
                        <p><strong>Kode Pesanan:</strong> <?= $kode_pesanan ?></p>
                        <p><strong>Total:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>
                        <?php if(!empty($catatan)): ?>
                            <p><strong>Catatan:</strong><br><?= nl2br(htmlspecialchars($catatan)) ?></p>
                        <?php endif; ?>
                        <a href="index.php" class="back-link">Kembali ke Menu Utama</a>
                    </div>
                <?php else: ?>
                
                    <div class="order-summary">
                        <h3>Ringkasan Pesanan</h3>
                        <?php 
                        $total = 0;
                        foreach($_SESSION['keranjang'] as $id_menu => $jumlah): 
                            $query = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id_menu");
                            $menu = mysqli_fetch_assoc($query);
                            if(!$menu) continue;
                            $subtotal = $menu['harga'] * $jumlah;
                            $total += $subtotal;
                        ?>
                            <div class="order-item">
                                <span><?= htmlspecialchars($menu['nama_menu']) ?> (<?= $jumlah ?>x)</span>
                                <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="order-total">
                            <span>Total</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>
                    
                    
                    <form method="post" action="checkout.php">
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="tunai">Tunai</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="catatan">Catatan (opsional)</label>
                            <textarea id="catatan" name="catatan" placeholder="Contoh: jangan pedas, antar ke meja 3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn">Konfirmasi Pesanan</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>