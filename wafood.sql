-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2023 pada 17.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wafood`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detailtransaksi` int(11) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detailtransaksi`, `no_transaksi`, `id_menu`, `jumlah`) VALUES
(82, 'TR2005020001', 1, 1),
(83, 'TR2005020002', 1, 1),
(84, 'TR2005020002', 2, 1),
(85, 'TR2005020002', 7, 1),
(86, 'TR2005020002', 14, 1),
(87, 'TR2005020003', 1, 1),
(88, 'TR2005020003', 4, 1),
(89, 'TR2005020004', 3, 1),
(90, 'TR2005020004', 7, 1),
(91, 'TR2005020005', 1, 1),
(92, 'TR2005020005', 4, 1),
(93, 'TR2005020006', 1, 1),
(94, 'TR2005020006', 3, 1),
(95, 'TR2005020007', 1, 1),
(96, 'TR2005020007', 5, 1),
(97, 'TR2005020008', 1, 1),
(98, 'TR2005020008', 4, 1),
(99, 'TR2005020009', 1, 1),
(100, 'TR2005020009', 4, 1),
(101, 'TR2005020009', 6, 2),
(102, 'TR2005020009', 7, 1),
(103, 'TR2005020010', 1, 1),
(104, 'TR2005020010', 3, 1),
(105, 'TR2005020010', 7, 1),
(106, 'TR2005020010', 14, 1),
(112, 'TR2005020011', 1, 1),
(113, 'TR2005020011', 7, 1),
(114, 'TR2005020011', 14, 1),
(115, 'TR2005020012', 1, 1),
(116, 'TR2005020012', 3, 1),
(121, 'TR2005020013', 1, 1),
(122, 'TR2005020013', 7, 1),
(123, 'TR2005020013', 5, 1),
(124, 'TR2005020014', 1, 1),
(125, 'TR2005020014', 7, 1),
(126, 'TR2005020014', 5, 1),
(127, 'TR2005020015', 7, 1),
(128, 'TR2005020016', 3, 1),
(129, 'TR2005020017', 5, 1),
(130, 'TR2005020018', 8, 1),
(131, 'TR2005020019', 3, 2),
(132, 'TR2005020020', 5, 1),
(133, 'TR2005020021', 4, 1),
(135, 'TR2005020021', 7, 1),
(136, 'TR2005020021', 8, 1),
(137, 'TR2005020021', 16, 1),
(138, 'TR2005020022', 1, 1),
(139, 'TR2005020022', 3, 1),
(140, 'TR2005020022', 7, 1),
(142, 'TR2005020023', 5, 1),
(143, 'TR2005020024', 8, 1),
(144, 'TR2005020025', 1, 1),
(145, 'TR2005020025', 2, 1),
(146, 'TR2005020025', 5, 1),
(147, 'TR2005020026', 1, 2),
(148, 'TR2005020026', 3, 1),
(149, 'TR2005020026', 7, 1),
(150, 'TR2005020027', 1, 1),
(151, 'TR2005020028', 1, 1),
(152, 'TR2005020028', 2, 1),
(153, 'TR2005020029', 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `kd_menu` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `kd_menu`, `id_kategori`, `nama_menu`, `harga`, `terjual`, `stok`, `gambar`) VALUES
(1, 'MN2005020014', 1, 'Usus', 5000, 8, 2, 'usu_warteg.jpeg'),
(2, 'MN2005020013', 1, 'Kerang', 5000, 4, 1, 'kerang_warteg.jpg'),
(3, 'MN2005020018', 1, 'Ati Ampela', 5000, 4, 8, 'ati_ampela.jpg'),
(4, 'MN2005020004', 1, 'Tempek Orek', 5000, 1, 9, 'tempe.jpg'),
(5, 'MN2005020005', 2, 'Es Teh Manis', 4000, 6, 17, 'icedtea_02_small-removebg-preview.png'),
(6, 'MN2005020006', 2, 'Es jeruk', 3000, 0, 9, 'PhotoGrid_1505362693195_scaled-removebg-preview.png'),
(7, 'MN2005020007', 1, 'Nasi', 4000, 6, 6, 'nasi-removebg-preview.png'),
(8, 'MN2005020008', 2, 'Kopi Hitam', 4000, 3, 12, '1909_i305_022_P_m005_c20_realistic_coffee_set-02-removebg-preview.png'),
(9, 'MN2005020009', 1, 'Ayam goreng', 7000, 0, 9, 'resep-ayam-goreng-lengkuas-menu-20210303062406-removebg-preview.png'),
(14, 'MN2005020011', 2, 'Aqua 600ml', 4000, 1, 29, 'aqua-removebg-preview.png'),
(15, 'MN2005020012', 1, 'Telur Ceplok', 5000, 0, 15, 'telur.jpg'),
(16, 'MN2005020016', 1, 'Telur Dadar', 4000, 1, 8, '147127891-removebg-preview3.png'),
(18, 'MN2005020020', 2, 'Soda Susu', 5000, 0, 7, 'image_750x_6395a8d249c5e-removebg-preview.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `metode` int(11) NOT NULL,
  `tunai` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `nama_pembeli`, `tanggal_transaksi`, `total_harga`, `metode`, `tunai`, `kembalian`, `token`, `status`) VALUES
(37, 'TR2005020001', 'Umum', '2023-06-09', 5000, 1, 5000, 0, '', 1),
(38, 'TR2005020002', 'Umum', '2023-06-09', 18000, 1, 20000, 2000, '', 1),
(39, 'TR2005020003', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 0),
(40, 'TR2005020003', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 0),
(41, 'TR2005020003', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 0),
(42, 'TR2005020004', 'Umum', '2023-06-09', 11900, 2, 0, 0, '', 0),
(43, 'TR2005020005', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 0),
(44, 'TR2005020006', 'Umum', '2023-06-09', 12900, 2, 0, 0, '', 0),
(45, 'TR2005020007', 'Umum', '2023-06-09', 9000, 2, 0, 0, '', 0),
(46, 'TR2005020007', 'Umum', '2023-06-09', 9000, 2, 0, 0, '', 0),
(47, 'TR2005020008', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 0),
(48, 'TR2005020009', 'Umum', '2023-06-09', 20000, 2, 0, 0, '', 0),
(49, 'TR2005020009', 'Umum', '2023-06-09', 20000, 2, 0, 0, '', 0),
(50, 'TR2005020010', 'Umum', '2023-06-09', 20900, 2, 0, 0, '', 0),
(51, 'TR2005020011', 'Umum', '2023-06-09', 13000, 2, 0, 0, '', 0),
(54, 'TR2005020012', 'Umum', '2023-06-09', 12900, 2, 0, 0, 'ef0eb626-54c2-404a-bd26-1774ffe843c4', 3),
(57, 'TR2005020013', 'Umum', '2023-06-09', 13000, 2, 0, 0, '', 0),
(58, 'TR2005020013', 'Umum', '2023-06-09', 13000, 2, 0, 0, '', 0),
(59, 'TR2005020014', 'Umum', '2023-06-09', 13000, 2, 0, 0, '', 1),
(60, 'TR2005020015', 'Umum', '2023-06-09', 4000, 1, 5000, 1000, '', 1),
(63, 'TR2005020016', 'Umum', '2023-06-09', 5000, 2, 0, 0, '', 0),
(64, 'TR2005020017', 'Umum', '2023-06-09', 4000, 2, 0, 0, '', 1),
(65, 'TR2005020018', 'Umum', '2023-06-09', 4000, 2, 0, 0, '', 1),
(66, 'TR2005020019', 'Umum', '2023-06-09', 10000, 2, 0, 0, '', 1),
(68, 'TR2005020020', 'Umum', '2023-06-09', 4000, 2, 0, 0, '', 1),
(69, 'TR2005020021', 'Umum', '2023-06-09', 17000, 2, 0, 0, '25aa219c-c0c1-4c67-8c52-2f847a39e938', 3),
(70, 'TR2005020022', 'Umum', '2023-06-09', 14000, 2, 0, 0, '245e2c23-b6f9-4f95-b5f3-a736d848551a', 1),
(71, 'TR2005020023', 'Umum', '2023-06-10', 4000, 1, 5000, 1000, '', 1),
(72, 'TR2005020024', 'Umum', '2023-06-10', 4000, 2, 0, 0, '', 1),
(76, 'TR2005020025', 'Umum', '2023-06-10', 14000, 1, 14000, 0, '', 1),
(78, 'TR2005020026', 'Umum', '2023-06-10', 19000, 2, 0, 0, '', 1),
(79, 'TR2005020027', 'Umum', '2023-06-10', 5000, 2, 0, 0, '', 1),
(80, 'TR2005020028', 'Umum', '2023-06-10', 10000, 2, 0, 0, '', 1),
(81, 'TR2005020029', 'Umum', '2023-06-10', 4000, 1, 5000, 1000, '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$JFM23OFU6SPHCvWXHzKda.YDbWIojirNaL1aafGhjsbXzZEDRXQd6', '2023-05-29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detailtransaksi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
