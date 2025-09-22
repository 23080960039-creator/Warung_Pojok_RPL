<?php
session_start();
include 'koneksi.php';

if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {

    //ambil data 
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $cart          = $_SESSION['cart'];
    $total         = array_sum(array_column($cart, 'subtotal'));
    $kode_pesanan  = 'ORD' . time();

    //simpan orders 
    mysqli_query($conn,
        "INSERT INTO orders (kode_pesanan, nama_pelanggan, total)
        VALUES ('$kode_pesanan', '$nama_pelanggan', $total)"
    );
    $order_id = mysqli_insert_id($conn);

    //simpan detail item 
    foreach ($cart as $item) {
        $menu_id   = $item['id'];
        $nama_menu = mysqli_real_escape_string($conn, $item['nama_menu']);
        $harga     = $item['harga'];
        $quantity  = $item['quantity'];
        $subtotal  = $item['subtotal'];

        mysqli_query($conn,
            "INSERT INTO order_items (order_id, menu_id, nama_menu, harga, quantity, subtotal)
            VALUES ($order_id, $menu_id, '$nama_menu', $harga, $quantity, $subtotal)"
        );
    }

    //kosongkan keranjang 
    unset($_SESSION['cart']);

    //set flash message & redirect ke menu 
    $_SESSION['flash'] = "Pesanan Anda berhasil diproses dengan kode: <strong>$kode_pesanan</strong>";
    header("Location: daftar_menu.php");
    exit;
}
header("Location: daftar_menu.php");
exit;
?>
