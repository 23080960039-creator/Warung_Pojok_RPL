-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warung_pojok`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `created_at`) VALUES
(1, 'admin', 'admin123', 'Admin Warung', '2025-05-29 08:19:00'),
(2, 'huda', '123456', 'hudaabdulmajid', '2025-05-29 09:17:02'),
(3, 'salsa', 'sal123', 'Salsabila Savitri', '2025-06-01 22:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT 1,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `kategori`, `harga`, `deskripsi`, `gambar`, `tersedia`, `stok`) VALUES
(1, 'Kopi Arabika', 'Minuman', 5000.00, 'Kopi arabika pilihan dengan rasa yang khas', 'arabika.jpg', 1, 30),
(2, 'Kopi Americano', 'Minuman', 5000.00, 'Kopi americano dengan rasa yang kuat', 'americano.jpeg', 1, 30),
(3, 'Cappuccino', 'Minuman', 5000.00, 'Cappuccino dengan busa susu yang lembut', 'capucino.jpg', 1, 30),
(4, 'Cafe Latte', 'Minuman', 7000.00, 'Cafe latte dengan rasa yang creamy', 'cafe latte.jpg', 1, 30),
(5, 'Espresso', 'Minuman', 5000.00, 'Espresso dengan kekentalan yang pas', 'expresso.jpg', 1, 30),
(6, 'Long Black', 'Minuman', 6000.00, 'Long black dengan aroma kopi yang kuat', 'long back.jpg', 1, 30),
(7, 'Ice Coffee', 'Minuman', 5000.00, 'Ice coffee segar untuk hari yang panas', 'icecoffe.jpg', 1, 30),
(8, 'Kopi Susu', 'Minuman', 8000.00, 'Kopi susu dengan perpaduan rasa yang pas', 'kopisusu.jpg', 1, 30),
(9, 'Mocca Latte', 'Minuman', 9000.00, 'Mocca latte dengan coklat dan kopi', 'mocca latte.jpg', 1, 30),
(10, 'Donat', 'Makanan', 7000.00, 'Donat lembut dengan berbagai topping', 'donat.jpg', 1, 30),
(11, 'Roti Gandum', 'Makanan', 7000.00, 'Roti gandum sehat dan bergizi', 'roti gandum.jpg', 1, 30),
(12, 'Croissant', 'Makanan', 7000.00, 'Croissant renyah dan lembut', 'croise.jpg', 1, 30),
(13, 'Ayam Geprek + Es Teh', 'Makanan', 25000.00, 'Ayam geprek dengan es teh gratis', 'ayamgeprekfreeesteh.jpg', 1, 30),
(14, 'Ayam Geprek Mozarella', 'Makanan', 27000.00, 'Ayam geprek dengan mozarella leleh', 'ayamgeprekmozarella.jpg', 1, 30),
(15, 'Ayam Geprek Original', 'Makanan', 23000.00, 'Ayam geprek original dengan sambal', 'ayamgeprekori.jpg', 1, 30),
(16, 'Ayam Geprek Sambal Hijau', 'Makanan', 26000.00, 'Ayam geprek dengan sambal hijau', 'ayamgepreksambalhijau.jpg', 1, 30),
(17, 'Ayam Geprek Sambal Matah', 'Makanan', 26000.00, 'Ayam geprek dengan sambal matah', 'ayamgepreksambalmatah.jpg', 1, 30),
(18, 'Ayam Geprek Sambal Setan', 'Makanan', 26000.00, 'Ayam geprek dengan sambal super pedas', 'ayamgepreksambalsetan.jpg', 1, 30),
(19, 'Ayam Geprek Sambal Terasi', 'Makanan', 26000.00, 'Ayam geprek dengan sambal terasi', 'ayamgepreksambalterasi.jpg', 1, 30),
(20, 'French Fries', 'Makanan', 12000.00, 'Kentang goreng renyah', 'frenchfries.jpg', 1, 30),
(21, 'Hamburger', 'Makanan', 20000.00, 'Hamburger dengan daging juicy', 'hamburger.jpg', 1, 30),
(22, 'Kebab', 'Makanan', 12000.00, 'Kebab dengan daging dan sayuran segar', 'kebab.jpg', 1, 30),
(24, 'Eskrim', 'Minuman', 8000.00, 'Eskrim berbagai rasa', 'eskrim.jpg', 1, 30),
(25, 'Es Jeruk', 'Minuman', 5000.00, 'Es jeruk segar', 'esjeruk.jpg', 1, 30),
(26, 'Jus Mangga', 'Minuman', 8000.00, 'Jus mangga alami', 'jusmangga.jpg', 1, 30),
(27, 'Jus Alpukat', 'Minuman', 10000.00, 'Alpukat yang manis dan pastinya sehat', 'juspukat.jpg', 1, 30),
(28, 'Es Teh', 'Minuman', 4000.00, 'Teh manis dingin', 'tehobeng.jpg', 1, 30),
(29, 'Mie Ayam', 'Makanan', 17000.00, 'Mie ayam dengan pangsit', 'mieayam.jpg', 1, 30),
(30, 'Mie Ayam Bakso', 'Makanan', 19000.00, 'Mie ayam dengan bakso', 'mieayambakso.jpg', 1, 30),
(31, 'Nasi Goreng', 'Makanan', 20000.00, 'Nasi goreng spesial', 'nasgor.jpg', 1, 30),
(35, 'Es Degan', 'Minuman', 20000.00, 'Es kelapa muda segar dengan manis gula asli', 'es_degan.jpg', 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','diproses','selesai','dibatalkan') DEFAULT 'pending',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `nomor_meja` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `kode_pesanan`, `nama_pelanggan`, `order_date`, `total`, `status`, `metode_pembayaran`, `catatan`, `nomor_meja`) VALUES
(2, 'WP1748793607', 'Sari', '2025-06-01 16:00:07', 228000.00, 'selesai', 'Tunai', NULL, NULL),
(3, 'WP1748794163', 'Santoso', '2025-06-01 16:09:23', 49000.00, 'selesai', 'Tunai', NULL, NULL),
(4, 'WP1748794866', 'Doni', '2025-06-01 16:21:06', 17000.00, 'selesai', 'Tunai', NULL, NULL),
(5, 'WP1748795134', 'Doni', '2025-06-01 16:25:34', 19000.00, 'selesai', 'Tunai', NULL, NULL),
(6, 'WP1748795470', 'Susanti', '2025-06-01 16:31:10', 39000.00, 'selesai', 'Tunai', NULL, NULL),
(7, 'WP1748795637', 'Susanti', '2025-06-01 16:33:57', 38000.00, 'selesai', 'qris', NULL, NULL),
(8, 'WP1748798573', 'Jono', '2025-06-01 17:22:53', 32000.00, 'selesai', 'tunai', NULL, NULL),
(9, 'WP1748817443', 'Leni', '2025-06-01 22:37:23', 54000.00, 'selesai', 'qris', NULL, NULL),
(10, 'WP1748817770', 'Desi', '2025-06-01 22:42:50', 34000.00, 'selesai', 'tunai', NULL, NULL),
(11, 'WP1748817939', 'Priska', '2025-06-01 22:45:39', 25000.00, 'selesai', 'qris', NULL, NULL),
(12, 'WP1748818179', 'Sasa', '2025-06-01 22:49:39', 7000.00, 'selesai', 'tunai', NULL, NULL),
(13, 'WP1748819752', 'Rama', '2025-06-01 23:15:52', 32000.00, 'selesai', 'qris', NULL, NULL),
(14, 'WP1748820044', 'Didi', '2025-06-01 23:20:44', 7000.00, 'selesai', 'tunai', NULL, NULL),
(15, 'WP1748820423', 'Fitri', '2025-06-01 23:27:03', 26000.00, 'selesai', 'tunai', NULL, NULL),
(16, 'WP683ce36d6f04f', 'Zara', '2025-06-01 23:34:05', 43000.00, 'selesai', 'tunai', NULL, '7'),
(17, 'WP1748821052', 'Zara', '2025-06-01 23:37:32', 17000.00, 'selesai', 'tunai', NULL, NULL),
(18, 'WP683ce4a281558', 'dodo', '2025-06-01 23:39:14', 27000.00, 'selesai', 'tunai', NULL, '8'),
(19, 'WP683ce55fed506', 'Dodo', '2025-06-01 23:42:23', 26000.00, 'selesai', 'tunai', NULL, '6'),
(20, 'WP683ce6117db19', 'Zidan', '2025-06-01 23:45:21', 20000.00, 'selesai', 'qris', NULL, '9'),
(21, 'WP683ce73b4eaba', 'Akila', '2025-06-01 23:50:19', 20000.00, 'selesai', 'tunai', NULL, '1'),
(22, 'WP683ce8e3ec1b4', 'Harry', '2025-06-01 23:57:23', 16000.00, 'selesai', 'tunai', NULL, '7'),
(23, 'WP683ceb24b3cbd', 'Tsani', '2025-06-02 00:07:00', 26000.00, 'selesai', 'qris', NULL, '3'),
(24, 'WP683cec95acbc1', 'Tsani', '2025-06-02 00:13:09', 26000.00, 'selesai', 'qris', NULL, '3'),
(25, 'WP683ced1274a33', 'Tsani', '2025-06-02 00:15:14', 26000.00, 'selesai', 'qris', NULL, '3'),
(26, 'WP683cefa3dbd5c', 'Tsani', '2025-06-02 00:26:11', 26000.00, 'selesai', 'tunai', NULL, '3'),
(27, 'WP1748824061', 'Tsani', '2025-06-02 00:27:41', 26000.00, 'selesai', 'tunai', NULL, NULL),
(28, 'WP683cf086978d7', 'Tito', '2025-06-02 00:29:58', 26000.00, 'selesai', 'qris', NULL, '10'),
(29, 'WP683cf09b22668', 'Tito', '2025-06-02 00:30:19', 26000.00, 'selesai', 'tunai', NULL, '10'),
(30, 'WP683cf0b265d64', 'Tito', '2025-06-02 00:30:42', 26000.00, 'selesai', 'tunai', NULL, '10'),
(31, 'WP1748824264', 'Tito', '2025-06-02 00:31:04', 26000.00, 'selesai', 'tunai', NULL, NULL),
(32, 'WP1748824294', 'Tito', '2025-06-02 00:31:34', 5000.00, 'selesai', 'tunai', NULL, NULL),
(33, 'WP1748824319', 'Tito', '2025-06-02 00:31:59', 19000.00, 'selesai', 'tunai', NULL, NULL),
(34, 'WP1748824346', 'Tito', '2025-06-02 00:32:26', 17000.00, 'selesai', 'tunai', NULL, NULL),
(35, 'WP1748824667', 'Indah', '2025-06-02 00:37:47', 7000.00, 'selesai', 'qris', NULL, NULL),
(36, 'WP1748824697', 'Indah', '2025-06-02 00:38:17', 7000.00, 'selesai', 'qris', NULL, NULL),
(37, 'WP1748824871', 'Indah', '2025-06-02 00:41:11', 7000.00, 'selesai', 'tunai', NULL, NULL),
(38, 'WP1748825190', 'Indah', '2025-06-02 00:46:30', 26000.00, 'selesai', 'tunai', NULL, '9'),
(39, 'WP1748825307', 'Diva', '2025-06-02 00:48:27', 8000.00, 'selesai', 'qris', NULL, '7'),
(40, 'WP1748825461', 'Diva', '2025-06-02 00:51:01', 5000.00, 'selesai', 'qris', NULL, '7'),
(41, 'WP1748825843', 'Diah', '2025-06-02 00:57:23', 25000.00, 'selesai', 'tunai', NULL, '8'),
(42, 'WP1748825983', 'Diah', '2025-06-02 00:59:43', 25000.00, 'selesai', 'tunai', NULL, '8'),
(43, 'WP1748825985', 'Diah', '2025-06-02 00:59:45', 25000.00, 'selesai', 'tunai', NULL, '8'),
(44, 'WP1748826335', 'Diah', '2025-06-02 01:05:35', 25000.00, 'selesai', 'tunai', NULL, '8'),
(45, 'WP1748826440', 'Vio', '2025-06-02 01:07:20', 9000.00, 'selesai', 'qris', NULL, '2'),
(46, 'WP1748826904', 'Dina', '2025-06-02 01:15:04', 20000.00, 'selesai', 'tunai', NULL, '11'),
(47, 'WP1748827303', 'Indah', '2025-06-02 01:21:43', 12000.00, 'selesai', 'qris', NULL, '8'),
(48, 'WP1748833622', 'Carissa', '2025-06-02 03:07:02', 19000.00, 'selesai', 'qris', NULL, '12'),
(49, 'WP1748834011', 'Sania', '2025-06-02 03:13:31', 26000.00, 'selesai', 'tunai', NULL, '13'),
(50, 'WP1748835490', 'Susanti', '2025-06-02 03:38:10', 34000.00, 'selesai', 'tunai', NULL, '14'),
(51, 'WP1748835923', 'Jasmine', '2025-06-02 03:45:23', 5000.00, 'selesai', 'tunai', NULL, '1'),
(52, 'WP1748836562', 'soni', '2025-06-02 03:56:02', 10000.00, 'selesai', 'qris', NULL, '2'),
(53, 'WP1748836690', 'Sofi', '2025-06-02 03:58:10', 7000.00, 'selesai', 'tunai', NULL, '3'),
(54, 'WP1748837010', 'Desi', '2025-06-02 04:03:30', 9000.00, 'selesai', 'qris', NULL, '4'),
(55, 'WP1748837610', 'Rosi', '2025-06-02 04:13:30', 47000.00, 'selesai', 'tunai', NULL, '5'),
(56, 'WP1748837959', 'Hanif', '2025-06-02 04:19:19', 26000.00, 'selesai', 'tunai', NULL, '8'),
(57, 'POJOK1748838099', 'Indah', '2025-06-02 04:21:39', 0.00, 'selesai', 'tunai', 'tidak ada', '5'),
(58, 'WP1748838455', 'Tami', '2025-06-02 04:27:35', 26000.00, 'selesai', 'tunai', NULL, '8'),
(59, 'WP1748839166', 'Lala', '2025-06-02 04:39:26', 69000.00, 'selesai', 'tunai', NULL, '9'),
(60, 'WP1748839631', 'Quinsha', '2025-06-02 04:47:11', 733000.00, 'selesai', 'tunai', NULL, '300'),
(61, 'WP1748839780', 'Quinsha', '2025-06-02 04:49:40', 36000.00, 'selesai', 'tunai', NULL, '3'),
(62, 'WP1748839881', 'Arletta', '2025-06-02 04:51:21', 30000.00, 'selesai', 'qris', NULL, '26'),
(63, 'WP1748840252', 'Budi', '2025-06-02 04:57:32', 64000.00, 'selesai', 'qris', NULL, '1'),
(64, 'WP1748850467', 'Zahra', '2025-06-02 07:47:47', 24000.00, 'selesai', 'qris', NULL, '2'),
(65, 'WP1748850798', 'Leni', '2025-06-02 07:53:18', 33000.00, 'selesai', 'tunai', NULL, '5'),
(66, 'WP1748851173', 'Sandrina', '2025-06-02 07:59:33', 26000.00, 'selesai', 'tunai', NULL, '4'),
(67, 'WP1748867874', 'Rani', '2025-06-02 12:37:54', 26000.00, 'selesai', 'tunai', NULL, '3');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `nama_menu`, `harga`, `quantity`, `subtotal`) VALUES
(1, 1, 1, 'americano', 15000.00, 1, 15000.00),
(2, 1, 1, 'americano', 15000.00, 1, 15000.00),
(3, 1, 7, 'ayamgepreksambalmatah', 26000.00, 1, 26000.00),
(4, 1, 1, 'americano', 15000.00, 1, 15000.00),
(5, 2, 29, 'mocca latte', 18000.00, 1, 18000.00),
(6, 3, 1, 'americano', 15000.00, 1, 15000.00),
(7, 4, 1, 'americano', 15000.00, 1, 15000.00),
(8, 4, 1, 'americano', 15000.00, 1, 15000.00),
(9, 5, 13, 'croise', 10000.00, 1, 10000.00),
(10, 6, 5, 'ayam geprek original', 23000.00, 2, 46000.00),
(11, 6, 9, 'ayam geprek sambal terasi', 26000.00, 1, 26000.00),
(12, 44, 0, 'Ayam Geprek + Es Teh', 25000.00, 1, 25000.00),
(13, 45, 0, 'Mocca Latte', 9000.00, 1, 9000.00),
(14, 46, 0, 'Nasi Goreng', 20000.00, 1, 20000.00),
(15, 47, 0, 'French Fries', 12000.00, 1, 12000.00),
(16, 48, 0, 'Cappuccino', 5000.00, 2, 10000.00),
(17, 48, 0, 'Es Teh', 4000.00, 1, 4000.00),
(18, 48, 0, 'Ice Coffee', 5000.00, 1, 5000.00),
(19, 49, 0, 'Ayam Geprek Sambal Matah', 26000.00, 1, 26000.00),
(20, 50, 0, 'Hamburger', 20000.00, 1, 20000.00),
(21, 50, 0, 'Donat', 7000.00, 2, 14000.00),
(22, 51, 0, 'Es Jeruk', 5000.00, 1, 5000.00),
(23, 52, 0, 'Cappuccino', 5000.00, 2, 10000.00),
(24, 53, 0, 'Cafe Latte', 7000.00, 1, 7000.00),
(25, 54, 0, 'Mocca Latte', 9000.00, 1, 9000.00),
(26, 55, 0, 'Ayam Geprek Mozarella', 27000.00, 1, 27000.00),
(27, 55, 0, 'Es Degan', 20000.00, 1, 20000.00),
(28, 56, 0, 'Ayam Geprek Sambal Terasi', 26000.00, 1, 26000.00),
(29, 58, 0, 'Ayam Geprek Sambal Terasi', 26000.00, 1, 26000.00),
(30, 59, 0, 'Ayam Geprek Sambal Setan', 26000.00, 1, 26000.00),
(31, 59, 0, 'Mie Ayam Bakso', 19000.00, 1, 19000.00),
(32, 59, 0, 'French Fries', 12000.00, 2, 24000.00),
(33, 60, 0, 'Mie Ayam', 17000.00, 1, 17000.00),
(34, 60, 0, 'Donat', 7000.00, 100, 700000.00),
(35, 60, 0, 'Jus Mangga', 8000.00, 1, 8000.00),
(36, 60, 0, 'Eskrim', 8000.00, 1, 8000.00),
(37, 61, 0, 'Ayam Geprek Mozarella', 27000.00, 1, 27000.00),
(38, 61, 0, 'Mocca Latte', 9000.00, 1, 9000.00),
(39, 62, 0, 'Nasi Goreng', 20000.00, 1, 20000.00),
(40, 62, 0, 'Jus Alpukat', 10000.00, 1, 10000.00),
(41, 63, 0, 'Ayam Geprek Sambal Hijau', 26000.00, 1, 26000.00),
(42, 63, 0, 'Croissant', 7000.00, 1, 7000.00),
(43, 63, 0, 'Ayam Geprek Sambal Setan', 26000.00, 1, 26000.00),
(44, 63, 0, 'Es Jeruk', 5000.00, 1, 5000.00),
(45, 64, 0, 'Es Teh', 4000.00, 1, 4000.00),
(46, 64, 0, 'Nasi Goreng', 20000.00, 1, 20000.00),
(47, 65, 0, 'Eskrim', 8000.00, 1, 8000.00),
(48, 65, 0, 'Ayam Geprek + Es Teh', 25000.00, 1, 25000.00),
(49, 66, 0, 'Ayam Geprek Sambal Hijau', 26000.00, 1, 26000.00),
(50, 67, 0, 'Ayam Geprek Sambal Terasi', 26000.00, 1, 26000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
