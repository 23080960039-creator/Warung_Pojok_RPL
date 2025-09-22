<?php
session_start();
require 'koneksi.php';

// Cek jika keranjang kosong
if (!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) === 0) {
    echo "<script>alert('Keranjang masih kosong!'); window.location='keranjang.php';</script>";
    exit;
}

// Ambil data form
$nama_pelanggan = $_POST['nama_pelanggan'];
$nomor_meja = $_POST['nomor_meja'];
$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';
$metode_pembayaran = isset($_POST['metode_pembayaran']) ? $_POST['metode_pembayaran'] : 'Tunai';

// Hitung total
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $harga = isset($item['harga']) ? $item['harga'] : 0;
    $jumlah = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
    $total += $harga * $jumlah;
}

// Generate kode pesanan unik
$kode_pesanan = 'WP' . time();

// Simpan ke tabel orders 
$stmt = $conn->prepare("INSERT INTO orders (kode_pesanan, nama_pelanggan, total, status, metode_pembayaran, nomor_meja) VALUES (?, ?, ?, 'pending', ?, ?)");
$stmt->bind_param("sssss", $kode_pesanan, $nama_pelanggan, $total, $metode_pembayaran, $nomor_meja);
$stmt->execute();

if ($stmt->error) {
    echo "Gagal menyimpan pesanan: " . $stmt->error;
    exit;
}

$order_id = $stmt->insert_id;

// Simpan item ke order_items dan update stok menu
foreach ($_SESSION['keranjang'] as $item) {
    $menu_id = (int)$item['id'];  
    $nama_menu = isset($item['nama_menu']) ? $item['nama_menu'] : '';
    $harga = isset($item['harga']) ? (float)$item['harga'] : 0;
    $jumlah = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
    $subtotal = $harga * $jumlah;

    // Simpan item (pastikan menu_id valid)
    $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, menu_id, nama_menu, harga, quantity, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_item->bind_param("iisdis", $order_id, $menu_id, $nama_menu, $harga, $jumlah, $subtotal);
    $stmt_item->execute();

    if ($stmt_item->error) {
        echo "Gagal menyimpan item: " . $stmt_item->error;
        exit;
    }

    // Kurangi stok menu jika field tersedia bertipe INT
    $conn->query("UPDATE menu SET tersedia = GREATEST(tersedia - $jumlah, 0) WHERE id = $menu_id");
}

// Bersihkan keranjang
unset($_SESSION['keranjang']);

// Redirect ke nota
header("Location: nota.php?order_id=$order_id");
exit;
?>
