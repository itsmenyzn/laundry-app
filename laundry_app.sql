-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2022 pada 10.45
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
-- Database: `laundry_app`
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
(3, 'Express', 3, 6000),
(5, 'Express Pro', 2, 8000),
(6, 'Express Pro Max', 1, 10000),
(11, 'Paket Ngeboot', 10, 900000);

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
(64, 'jono supratman', '08123671', 'jono', '$2y$10$KLjHzvkrmlQg2NQHYQubEuUR8tpsifruWcuxAz51MDWjaMTqKlale', 'user');

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
  `berat` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `status` enum('Belum diproses','Sedang diproses','Selesai') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `tabel_pesanan`
--
ALTER TABLE `tabel_pesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
