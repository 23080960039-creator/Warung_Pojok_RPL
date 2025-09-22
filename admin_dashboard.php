<?php
session_start();

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// ===================================================================
// BAGIAN LOGIKA: AMBIL SEMUA DATA DASHBOARD DALAM SATU QUERY
// ===================================================================

// [DIPERBAIKI] Mengganti 'created_at' menjadi 'order_date' sesuai struktur tabel Anda
$query_dashboard = "
    SELECT
        COUNT(*) AS total_pesanan,
        SUM(CASE WHEN DATE(order_date) = CURDATE() THEN total ELSE 0 END) AS pendapatan_hari_ini,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pesanan_pending
    FROM
        orders
";

$result = mysqli_query($conn, $query_dashboard);
// Ambil hasilnya, jika tidak ada data, berikan nilai default 0.
$dashboard_data = mysqli_fetch_assoc($result) ?? [
    'total_pesanan' => 0,
    'pendapatan_hari_ini' => 0,
    'pesanan_pending' => 0
];

// ===================================================================
// BAGIAN TAMPILAN (VIEW): HTML HANYA MENAMPILKAN VARIABEL
// ===================================================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - Warung Pojok</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }
        .card-link .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar position-fixed">
        <div class="p-3">
            <h4 class="text-white mb-4">Warung Pojok</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="kelola_pesanan_admin.php"><i class="fas fa-list-alt me-2"></i>Kelola Pesanan</a></li>
                <li class="nav-item"><a class="nav-link" href="kelola_menu.php"><i class="fas fa-utensils me-2"></i>Kelola Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan.php"><i class="fas fa-chart-line me-2"></i>Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="logout_admin.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
    
    <main class="flex-grow-1">
        <div class="container-fluid py-4">
            <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?></h2>
            <hr>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Pesanan</h5>
                            <h2><?= $dashboard_data['total_pesanan'] ?></h2>
                            <p class="mb-0">Total semua pesanan</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <a href="laporan.php" class="card-link">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan Hari Ini</h5>
                                <h2>Rp <?= number_format($dashboard_data['pendapatan_hari_ini'], 0, ',', '.') ?></h2>
                                <p class="mb-0">Pendapatan tanggal <?= date('d/m/Y') ?></p>
                                <small class="mt-2 d-block" style="opacity: 0.8;">Klik untuk lihat laporan detail</small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <a href="kelola_pesanan_admin.php" class="card-link">
                        <div class="card bg-warning text-dark h-100">
                            <div class="card-body">
                                <h5 class="card-title">Pesanan Pending</h5>
                                <h2><?= $dashboard_data['pesanan_pending'] ?></h2>
                                <p class="mb-0">Pesanan belum diproses</p>
                                <small class="mt-2 d-block" style="opacity: 0.8;">Klik untuk kelola pesanan</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>