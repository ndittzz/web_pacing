-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2025 pada 13.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
(2, 'pacing', '0a9497a4537b3734f62721cf26aa1717');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `hadir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `tanggal`, `jam_mulai`, `jam_selesai`, `kegiatan`, `tempat`, `hadir`) VALUES
(1, '2025-07-23', '00:10:00', '15:10:00', 'akjsbdja', 'asbdkasbd', 'siapa saja yang hadir tdk tau'),
(2, '2025-07-23', '12:11:00', '02:11:00', 'asd', 'asd', 'ads'),
(3, '2025-07-24', '13:11:00', '13:11:00', 'awikwok', 'mantab213', 'oke oke'),
(4, '2025-07-25', '12:13:00', '04:13:00', 'kiwkiwww', 'mantab', 'omke omke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `belanja_desa`
--

CREATE TABLE `belanja_desa` (
  `id` int(11) NOT NULL,
  `tahun_anggaran_id` int(11) NOT NULL,
  `bidang` enum('Penyelenggaraan Pemerintahan','Pelaksanaan Pembangunan','Pembinaan Kemasyarakatan','Pemberdayaan Masyarakat','Penanggulangan Bencana') NOT NULL,
  `sub_bidang` varchar(100) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `belanja_desa`
--

INSERT INTO `belanja_desa` (`id`, `tahun_anggaran_id`, `bidang`, `sub_bidang`, `jumlah`, `created_at`) VALUES
(2, 7, 'Penyelenggaraan Pemerintahan', 'Belanja Siltap, Tunjangan dan Operasional Pemdes', 493874881.00, '2025-07-21 07:39:13'),
(3, 7, 'Penyelenggaraan Pemerintahan', 'Tata Praja Pemerintahan, Perencanaan, Keuangan dan Pelaporan', 5000000.00, '2025-07-21 07:46:21'),
(4, 7, 'Penyelenggaraan Pemerintahan', 'Sub Bidang Pertahanan', 4000000.00, '2025-07-21 07:47:50'),
(5, 7, 'Pelaksanaan Pembangunan', 'Sub Bidang Pendidikan', 31559000.00, '2025-07-21 07:48:19'),
(6, 7, 'Pelaksanaan Pembangunan', 'Sub Bidang Kesehatan', 90320000.00, '2025-07-21 07:50:00'),
(7, 7, 'Pelaksanaan Pembangunan', 'Sub Bidang Pekerjaan Umum dan Penataan Ruang', 1151838000.00, '2025-07-21 07:50:25'),
(8, 7, 'Pelaksanaan Pembangunan', 'Sub Bidang Kawasan Pemukiman', 10000000.00, '2025-07-21 07:50:38'),
(11, 7, 'Pelaksanaan Pembangunan', 'Sub Bidang Perhubungan, Komunikasi dan Informatika', 1250000.00, '2025-07-21 07:57:07'),
(12, 7, 'Pembinaan Kemasyarakatan', 'Sub Bidang Ketenteraman, Ketertiban Umum dan Perlindungan Masyarakat', 3520000.00, '2025-07-21 08:50:15'),
(13, 7, 'Pembinaan Kemasyarakatan', 'Sub Bidang Kebudayaan dan Keagamaan', 10000000.00, '2025-07-21 08:50:36'),
(14, 7, 'Pembinaan Kemasyarakatan', 'Sub Bidang Kelembagaan Masyarakat', 14600000.00, '2025-07-21 08:50:55'),
(15, 7, 'Pemberdayaan Masyarakat', 'Sub Bidang Pertanian dan Peternakan', 40330000.00, '2025-07-21 08:52:04'),
(16, 7, 'Pemberdayaan Masyarakat', 'Sub Bidang Peningkatan Kapasitas Aparatur Desa', 9500000.00, '2025-07-21 08:52:27'),
(17, 7, 'Penanggulangan Bencana', 'Sub Bidang Keadaan Darurat', 79200000.00, '2025-07-21 08:52:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `penulis` varchar(100) DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal`, `penulis`) VALUES
(8, 'cek', 'cek', '1753073556_Kucing-Domestik-1.jpg', '2025-07-31', 'cek'),
(9, 'cekkkk', 'cekkkkkkk', '1753074086_Kucing-Domestik-1.jpg', '2025-08-08', 'cekkkkk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `deskripsi`, `gambar`, `tanggal`) VALUES
(2, 'kucinggggg', 'ini kucingggg', 'galeri_1752756159.jpg', '2025-08-09'),
(7, 'sfaadsas', 'asdadsasasd', 'galeri_1753074241.jpg', '2025-07-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pejabat`
--

CREATE TABLE `pejabat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `riwayat_pendidikan` text DEFAULT NULL,
  `riwayat_jabatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pejabat`
--

INSERT INTO `pejabat` (`id`, `nama`, `gambar`, `tempat_lahir`, `tanggal_lahir`, `jabatan`, `periode`, `kategori`, `riwayat_pendidikan`, `riwayat_jabatan`) VALUES
(1, 'Budi Santoso', 'slider1.jpg', 'Klaten', '1988-11-26', 'Kepala Desa', '2020-2026', 'Perangkat Desa', 'SMA Negeri 2 Klaten (2003–2006)\nSI Universitas Atmajaya Yogyakarta (2006–2011)', 'Anggota DPRD Kabupaten Klaten (2014–2019)\nKetua DPRD Kabupaten Klaten (2019–2024)'),
(2, 'Siti Aminah', 'slider1.jpg', 'Klaten', '1990-03-15', 'Ketua BPD', '2021-2027', 'BPD', 'SMA Negeri 1 Klaten (2005–2008)\nS1 Universitas Gadjah Mada (2008–2012)', 'Sekretaris BPD (2015–2021)\nKetua BPD (2021–2027)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembiayaan_desa`
--

CREATE TABLE `pembiayaan_desa` (
  `id` int(11) NOT NULL,
  `tahun_anggaran_id` int(11) NOT NULL,
  `jenis` enum('penerimaan','pengeluaran') NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembiayaan_desa`
--

INSERT INTO `pembiayaan_desa` (`id`, `tahun_anggaran_id`, `jenis`, `jumlah`, `created_at`) VALUES
(2, 7, 'penerimaan', 17828498.00, '2025-07-21 08:53:16'),
(5, 7, 'pengeluaran', 0.00, '2025-07-21 09:22:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan_desa`
--

CREATE TABLE `pendapatan_desa` (
  `id` int(11) NOT NULL,
  `tahun_anggaran_id` int(11) NOT NULL,
  `kategori` enum('Pendapatan Asli Desa','Dana Desa','Bagi Hasil Pajak & Retribusi','Alokasi Dana Desa','Bantuan Provinsi','Bantuan Kabupaten','Pendapatan Lainnya') DEFAULT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendapatan_desa`
--

INSERT INTO `pendapatan_desa` (`id`, `tahun_anggaran_id`, `kategori`, `jumlah`, `created_at`) VALUES
(7, 7, 'Pendapatan Asli Desa', 136025000.00, '2025-07-21 07:21:31'),
(8, 7, 'Dana Desa', 685385000.00, '2025-07-21 07:25:21'),
(9, 7, 'Bagi Hasil Pajak & Retribusi', 31451210.00, '2025-07-21 07:25:33'),
(10, 7, 'Alokasi Dana Desa', 309307173.00, '2025-07-21 07:25:43'),
(11, 7, 'Bantuan Provinsi', 755000000.00, '2025-07-21 07:25:54'),
(12, 7, 'Bantuan Kabupaten', 10000000.00, '2025-07-21 07:26:04'),
(13, 7, 'Pendapatan Lainnya', 0.00, '2025-07-21 07:26:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_kelamin`
--

CREATE TABLE `penduduk_kelamin` (
  `id` int(11) NOT NULL,
  `laki_laki` int(50) NOT NULL,
  `perempuan` int(50) NOT NULL,
  `total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk_kelamin`
--

INSERT INTO `penduduk_kelamin` (`id`, `laki_laki`, `perempuan`, `total`) VALUES
(1, 893, 1024, 1917);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_pekerjaan`
--

CREATE TABLE `penduduk_pekerjaan` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk_pekerjaan`
--

INSERT INTO `penduduk_pekerjaan` (`id`, `kategori`, `total`) VALUES
(5, 'PNS', 26),
(7, 'ABRI', 16),
(8, 'Swasta', 8),
(9, 'Wiraswasta', 16),
(10, 'Petani', 183),
(11, 'Pertukangan', 4),
(12, 'Buruh Tani', 318),
(13, 'Pensiunan', 13),
(14, 'Nelayan', 0),
(15, 'Pemulung', 0),
(16, 'Jasa', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_pendidikan`
--

CREATE TABLE `penduduk_pendidikan` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk_pendidikan`
--

INSERT INTO `penduduk_pendidikan` (`id`, `kategori`, `total`) VALUES
(7, 'Taman Kanak-Kanak', 0),
(8, 'SD/Sederajat', 178),
(9, 'SMP/Sederajat', 114),
(10, 'SMA/Sederajat', 58),
(11, 'Akademi (D1 - D3)', 11),
(12, 'Sarjana (S1 - S3)', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_usia`
--

CREATE TABLE `penduduk_usia` (
  `id` int(11) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk_usia`
--

INSERT INTO `penduduk_usia` (`id`, `kategori`, `total`) VALUES
(1, '0-3', 97),
(3, '4-6', 65),
(4, '7-12', 162),
(5, '13-15', 76),
(6, '16-18', 74),
(7, '19+', 1173);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `tanggal` date NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `tanggal`, `konten`, `gambar`) VALUES
(1, 'besok kantor libur', '2025-07-22', '<p>jadi gini, besok libur karna</p><ol><li>acara dies</li><li>ntah gatau</li></ol><p><br></p><p><strong><em><u>rrrahh</u></em></strong></p>', 'pengumuman_1753075152.jpg'),
(2, 'ini judul', '2025-07-24', '<h1><strong>ini konten guise</strong></h1><p>jadi intinya ini ada konten ges</p><p><br></p><p>ini konten dienter</p>', 'pengumuman_1753075537.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potensi`
--

CREATE TABLE `potensi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `penulis` varchar(100) NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `potensi`
--

INSERT INTO `potensi` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal`, `penulis`) VALUES
(0, 'cek', 'cekkk', 'potensi_1753074589.jpg', '2025-06-07', 'cekk'),
(5, 'Tes Potensi 1', 'Ini potensi pertama', 'potensi_1752742993.png', '2025-07-17', 'Leon'),
(8, 'Potensi Pertanian Desa Pacing ', 'Desa Pacing merupakan salah satu desa di kabupaten Klaten yang memiliki potensi dibagian pertanian.  Sebagian besar wilayah di desa Pacing merupakan sawah , hal ini sejajar dengan kondisi penduduk di desa ini yang mayoritas bermata pencaharian sebagai petani', 'potensi_1752746276.jpg', '2025-07-17', 'Tim Pengembang Website'),
(10, 'gatau', 'keren', 'potensi_1752813079.png', '2025-08-09', 'delphi');

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
(1, 'legenda', '<p>	Konon cerita para leluhur desa Pacing pada zaman dahulu kala di desa Pacing belum mempunyai sebuah nama. Maka pada saat itu kehadiran Belanda menjajah negara kesatuan Republik Indonesia dan Belanda pada saat itu sampai perkampungan yang belum ada nama tersebut.</p><p>	Karena didaerah tersebut banyak ditumbuhi tumbuhan semacam bunga yang sangat elok, cantik dan amat mempesona yaitu bunga pacing. Maka dari itu para leluhur desa, bunga tersebut dijadikan nama sebuah desa&nbsp;yaitu desa Pacing dan sampai saat ini jadilah sebuah nama desa yaitu Desa Pacing.</p><p class=\"ql-align-justify\">	<span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Adapun penampakan bunga tersebut seperti gambar disamping :</span></p><p><br></p><p><br></p>', 'legenda_1752857368.jpg', '2025-07-18 16:49:28'),
(2, 'sejarah_umum', '<p>	<span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Menurut informasi &nbsp;dari kalangan tokoh masyarakat yang dapat dijadikan sebagai nara sumber tentang sejarah berdirinya Desa Pacing telah dapat ditarik kesimpulan bahwa, Desa Pacing dulunya merupakan tempat rawa-rawa yang di sekitarnya ditumbuhi </span><em style=\"background-color: transparent; color: rgb(0, 0, 0);\">pohon pacing </em><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">( sejenis tanaman dengan tinggi kurang lebih 2-4 meter yang dapat tumbuh di tanah yang basah ) sehingga ketika menjadi hunian dinamakan “Desa Pacing”, tetapi sekarang keberadaan pohon tersebut sudah tidak ada lagi.</span></p>', NULL, '2025-07-18 16:50:11'),
(3, 'penutup', '<p class=\"ql-align-justify\">	<span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Demikian sejarah pembangunan Desa Pacing yang dapat disajikan oleh Tim penyusun RPJM Des tahun 2019 – 2025 yang dikumpulkan dari berbagai sumber melalui lokakarya desa, apabila masih ada hal – hal yang kurang sempurna Tim mohon maaf. Mudah mudahan Tim penyusun periode RPJM Desa yang akan datang dapat menyempurnakan sejarah pembangunan Desa Pacing.</span></p><p class=\"ql-align-justify\">	<span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Atas nama Tim Penyusun RPJMDes Desa Pacing periode tahun 2019 – 2025 mengucapkan terima kasih kepada sumber yang telah membantu tersusunnya Sejarah Pembangunan Desa Pacing. AAMIIN.</span></p>', NULL, '2025-07-18 16:51:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_anggaran`
--

CREATE TABLE `tahun_anggaran` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_anggaran`
--

INSERT INTO `tahun_anggaran` (`id`, `tahun`, `created_at`) VALUES
(7, 2024, '2025-07-21 07:21:31'),
(8, 2024, '2025-07-21 07:25:21'),
(9, 2024, '2025-07-21 07:25:33'),
(10, 2024, '2025-07-21 07:25:43'),
(11, 2024, '2025-07-21 07:25:54'),
(12, 2024, '2025-07-21 07:26:04'),
(13, 2024, '2025-07-21 07:26:16');

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
(2, 'Iro Dimejo', 'Tegalsari', '-', '-', '2025-07-18 16:25:49', '2025-07-18 16:51:56'),
(3, 'Mangun Rejo', 'Pacing', '-', '-', '2025-07-18 16:52:10', '2025-07-18 16:52:10'),
(4, 'Handoyo Sastro', 'Tegalsari', '-', '-', '2025-07-18 16:52:22', '2025-07-18 16:52:22'),
(5, 'Tukiman', 'Pacing', '-', '-', '2025-07-18 16:52:48', '2025-07-18 16:52:48'),
(6, 'Suwandi', 'Gadungan Wedi', '1966-1974', 'Carteker', '2025-07-18 16:53:08', '2025-07-18 16:53:08'),
(7, 'Darto Warsono', 'Karangasem', '1974-1989', '-', '2025-07-18 16:53:25', '2025-07-18 16:53:25'),
(8, 'Lempar Sugiyanto', 'Tegalsari', '1989-1997', '-', '2025-07-18 16:53:41', '2025-07-18 16:53:41'),
(9, 'H. Radi', 'Pacing', '1998-2013', 'Dua periode', '2025-07-18 16:54:00', '2025-07-18 16:54:00'),
(10, 'Sulinah', 'Pacing', '2013-2019', '-', '2025-07-18 16:54:18', '2025-07-18 16:54:18'),
(11, 'Lami Wiyono', 'Tegalsari', '2019- Sekarang', '-', '2025-07-18 16:54:35', '2025-07-18 16:54:35');

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
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `belanja_desa`
--
ALTER TABLE `belanja_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_anggaran_id` (`tahun_anggaran_id`);

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
-- Indeks untuk tabel `pejabat`
--
ALTER TABLE `pejabat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembiayaan_desa`
--
ALTER TABLE `pembiayaan_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_anggaran_id` (`tahun_anggaran_id`);

--
-- Indeks untuk tabel `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_anggaran_id` (`tahun_anggaran_id`);

--
-- Indeks untuk tabel `penduduk_kelamin`
--
ALTER TABLE `penduduk_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penduduk_pekerjaan`
--
ALTER TABLE `penduduk_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penduduk_pendidikan`
--
ALTER TABLE `penduduk_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penduduk_usia`
--
ALTER TABLE `penduduk_usia`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `tahun_anggaran`
--
ALTER TABLE `tahun_anggaran`
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
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `belanja_desa`
--
ALTER TABLE `belanja_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pejabat`
--
ALTER TABLE `pejabat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembiayaan_desa`
--
ALTER TABLE `pembiayaan_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penduduk_kelamin`
--
ALTER TABLE `penduduk_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tahun_anggaran`
--
ALTER TABLE `tahun_anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `belanja_desa`
--
ALTER TABLE `belanja_desa`
  ADD CONSTRAINT `belanja_desa_ibfk_1` FOREIGN KEY (`tahun_anggaran_id`) REFERENCES `tahun_anggaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembiayaan_desa`
--
ALTER TABLE `pembiayaan_desa`
  ADD CONSTRAINT `pembiayaan_desa_ibfk_1` FOREIGN KEY (`tahun_anggaran_id`) REFERENCES `tahun_anggaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  ADD CONSTRAINT `pendapatan_desa_ibfk_1` FOREIGN KEY (`tahun_anggaran_id`) REFERENCES `tahun_anggaran` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
