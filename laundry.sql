-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2022 pada 14.18
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_paketharga`
--

CREATE TABLE `tabel_paketharga` (
  `id` int(10) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `lama` int(10) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_paketharga`
--

INSERT INTO `tabel_paketharga` (`id`, `nama_paket`, `lama`, `harga`) VALUES
(3, 'Reguler', 3, 7000),
(5, 'Express', 2, 10000),
(6, 'Spesial', 1, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_pengguna`
--

CREATE TABLE `tabel_pengguna` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_pengguna`
--

INSERT INTO `tabel_pengguna` (`id`, `nama`, `telepon`, `username`, `password`, `level`) VALUES
(61, 'adminya', '082134124813', 'admin', '$2y$10$bLIk4W/rkESx2ZO0L9GFaODlQiUKj68lO2sSkI.z/4Q39qiiDumnm', 'admin'),
(64, 'jono supratman', '08123671', 'jono', '$2y$10$KLjHzvkrmlQg2NQHYQubEuUR8tpsifruWcuxAz51MDWjaMTqKlale', 'user'),
(65, 'adhitya mhrdika', '0812372141', 'nytz', '$2y$10$Cbm9LDEPDDKLujW0QAR.Tud0vIbBjlYW1LMnwzYWA4sTquCReHt0C', 'admin'),
(66, 'ditya', '0821321321', 'adit123', '$2y$10$Q5Tx4iYnyWW0QDOJAcfkT.wPJRCaMQ9NY91GInHk2bBlN7WYn5UhG', 'user'),
(67, 'aditya', '081237123', 'ikikjos77', '$2y$10$TCcGu/1iGZC9JT4t1zzCReigEL.qoqZI.C9Ysrdo3VllBUXU3skBC', 'user'),
(68, 'nama aowkoakwo', '018237123', 'anjay123', '$2y$10$p06RKFewewu3DERI4k86q.XPL4lyS.VguzDGj6ynBlgHMtq9rIb5G', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_pesanan`
--

CREATE TABLE `tabel_pesanan` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `berat` int(50) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `status` enum('Pending','Belum diproses','Sedang diproses','Selesai diproses','Permintaan pengantaran','Sedang diantar','Selesai','Batal') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_pesanan`
--

INSERT INTO `tabel_pesanan` (`id`, `username`, `telepon`, `alamat`, `nama_paket`, `berat`, `harga`, `status`, `tanggal`) VALUES
(38, 'jono', '08123671', 'jalan barat daya no 128 B', 'Reguler', 10, 100000, 'Batal', '2022-08-31'),
(42, 'jono', '0821321321', 'jalan barat daya no 128 B', 'Reguler', 11, 77000, 'Batal', '2022-09-04'),
(43, 'jono', '0821321321', 'jalan barat daya no 128 B', 'Express', 11, 110000, 'Selesai', '2022-09-03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_paketharga`
--
ALTER TABLE `tabel_paketharga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_paket` (`nama_paket`);

--
-- Indeks untuk tabel `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `tabel_pesanan`
--
ALTER TABLE `tabel_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_paket` (`nama_paket`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_paketharga`
--
ALTER TABLE `tabel_paketharga`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tabel_pesanan`
--
ALTER TABLE `tabel_pesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tabel_pesanan`
--
ALTER TABLE `tabel_pesanan`
  ADD CONSTRAINT `tabel_pesanan_ibfk_1` FOREIGN KEY (`nama_paket`) REFERENCES `tabel_paketharga` (`nama_paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
