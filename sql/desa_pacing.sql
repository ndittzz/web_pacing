-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2025 pada 18.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa_pacing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'pacing', 'mantab'),
(2, 'pacing', '0a9497a4537b3734f62721cf26aa1717');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `penulis` varchar(100) DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal`, `penulis`) VALUES
(6, 'banjir', 'banjir', '1752849069_Screenshot (871).png', '2025-07-18 21:31:09', 'delphi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `deskripsi`, `gambar`, `tanggal`) VALUES
(2, 'kucinggggg', 'ini kucingggg', 'galeri_1752756159.jpg', '2025-07-17 19:37:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potensi`
--

CREATE TABLE `potensi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `penulis` varchar(100) NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `potensi`
--

INSERT INTO `potensi` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal`, `penulis`) VALUES
(5, 'Tes Potensi 1', 'Ini potensi pertama', 'potensi_1752742993.png', '2025-07-17 15:48:25', 'Leon'),
(8, 'Potensi Pertanian Desa Pacing ', 'Desa Pacing merupakan salah satu desa di kabupaten Klaten yang memiliki potensi dibagian pertanian.  Sebagian besar wilayah di desa Pacing merupakan sawah , hal ini sejajar dengan kondisi penduduk di desa ini yang mayoritas bermata pencaharian sebagai petani', 'potensi_1752746276.jpg', '2025-07-17 16:57:56', 'Tim Pengembang Website'),
(10, 'gatau', 'keren', 'potensi_1752813079.png', '2025-07-18 11:31:19', 'delphi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah_desa`
--

CREATE TABLE `sejarah_desa` (
  `id` int(11) NOT NULL,
  `bagian` enum('legenda','sejarah_umum','penutup') NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sejarah_desa`
--

INSERT INTO `sejarah_desa` (`id`, `bagian`, `konten`, `gambar`, `updated_at`) VALUES
(1, 'legenda', '<p>fak</p>', 'legenda_1752855018.png', '2025-07-18 16:10:18'),
(2, 'sejarah_umum', '<p>bebas</p>', NULL, '2025-07-18 16:13:40'),
(3, 'penutup', '<p>tutup</p><p><br></p>', NULL, '2025-07-18 16:16:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokoh_sejarah`
--

CREATE TABLE `tokoh_sejarah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tokoh_sejarah`
--

INSERT INTO `tokoh_sejarah` (`id`, `nama`, `alamat`, `periode`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Shah Delphi Muhammad', 'Klaten', '2020 - 2025', 'pp', '2025-07-18 16:25:49', '2025-07-18 16:25:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visimisi`
--

CREATE TABLE `visimisi` (
  `id_vm` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visimisi`
--

INSERT INTO `visimisi` (`id_vm`, `visi`, `misi`) VALUES
(3, '<p>Terwujudnya&nbsp;Masyarakat Desa Pacing yang lebih baik dan sejahtera</p>', '<p>Mewujudkan Tata Kelola Pemerintahan Desa yang Baik.</p><p>Meningkatkan Pelayanan Pemenuhan Hak hak Dasar Rakyat.</p><p>Pembangunan Infrastruktur Dasar.</p>');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `potensi`
--
ALTER TABLE `potensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sejarah_desa`
--
ALTER TABLE `sejarah_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tokoh_sejarah`
--
ALTER TABLE `tokoh_sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visimisi`
--
ALTER TABLE `visimisi`
  ADD PRIMARY KEY (`id_vm`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `potensi`
--
ALTER TABLE `potensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sejarah_desa`
--
ALTER TABLE `sejarah_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tokoh_sejarah`
--
ALTER TABLE `tokoh_sejarah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `visimisi`
--
ALTER TABLE `visimisi`
  MODIFY `id_vm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
