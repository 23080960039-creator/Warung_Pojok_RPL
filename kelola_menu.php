<?php
session_start();
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM menu WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: kelola_menu.php");
        exit;
    }
}

// Ambil semua menu
$menus = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Warung Pojok</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel ="stylesheet" href="kelola_menu.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-utensils"></i> Kelola Menu
            </h1>
            <div>
                <a href="admin_dashboard.php" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
                <a href="tambah_menu.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Menu
                </a>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Cari menu...">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        
        <table class="menu-table">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($menu = mysqli_fetch_assoc($menus)): ?>
                <tr>
                    <td><?= htmlspecialchars($menu['nama_menu']) ?></td>
                    <td class="price">Rp <?= number_format($menu['harga'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($menu['kategori']) ?></td>
                    <td><?= $menu['stok'] ?></td>
                    <td>
                        <span class="badge <?= $menu['tersedia'] ? 'badge-success' : 'badge-danger' ?>">
                            <?= $menu['tersedia'] ? 'Tersedia' : 'Habis' ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="edit_menu.php?id=<?= $menu['id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="kelola_menu.php?hapus=<?= $menu['id'] ?>" 
                            onclick="return confirm('Yakin ingin menghapus menu ini?')" 
                            class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Simple search functionality
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.menu-table tbody tr');
            
            rows.forEach(row => {
                const menuName = row.querySelector('td:first-child').textContent.toLowerCase();
                if (menuName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>