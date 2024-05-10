-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 08.00
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_akun`
--

CREATE TABLE `data_akun` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_akun`
--

INSERT INTO `data_akun` (`id`, `username`, `password`, `level`, `nama`) VALUES
(3, '0223023', 'sahaware', '1', 'burhan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_karyawan` varchar(200) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `gajipokok` decimal(10,0) NOT NULL DEFAULT 0,
  `foto` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `nik_leader` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('leader','hc','biasa','ceo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_karyawan`
--

INSERT INTO `data_karyawan` (`id_karyawan`, `nik`, `nama_karyawan`, `id_posisi`, `id_kelas`, `email`, `telepon`, `alamat`, `status`, `gajipokok`, `foto`, `type`, `nik_leader`, `password`, `level`) VALUES
(24, '0223001', 'Hasbi Ceo', 5, 1, 'jonijoniyesspapaa@gmail.com', '081223583131', 'Jl. Pagarsih Barat, Gg. Madrasah No 255', 'Aktif', '10000000', 'download_(1).png', 'Office', '', '$2y$10$EJnNLRQHgbT9X0In2BjLXu49zg4SymTKK.Z2ziNBHlDcugA07I2ba', 'ceo'),
(25, '0223002', 'Hasbi Radifan', 5, 2, 'jonijoniyesspapaa@gmail.com', '54321', 'Jl. qwerty', 'Aktif', '12000000', 'default.jpg', 'Project Base', '', '$2y$10$oaI2q5EgZhYEEKfeeGx8/e.S5oZblAn/6uARbKTQUrVhYeARpriqK', 'hc'),
(26, '0223003', 'Hasbi Karyawan', 10, 1, 'jonijoniyesspapaa@gmail.com', '081234', 'Jl. Ahmad Yani', 'Aktif', '12000000', 'default.jpg', 'Project Base', '02223004', '$2y$10$Od3nIlRZK1NgAJZ3LPwrAO/W6w7dbpDB02KWVqFqqlMqM0s136TAi', 'biasa'),
(29, '0223005', 'Fauzan Naufal Ramadhani', 6, 1, 'jonijoniyesspapaa@gmail.com', '081223583131', 'Jl. Pagarsih Barat, Gg. Madrasah No 255', 'Aktif', '12000000', 'default.jpg', 'Office', '', '$2y$10$LE6zEyPO.9ytFdtfzCnuOeVX1BCDrg6.3GK9oLAju8F5kRhsJiu/G', 'biasa'),
(32, '0223004', 'Hasbi Leader', 5, 1, 'jonijoniyesspapaa@gmail.com', '0812344', 'Jl. Soekarno', 'Aktif', '12000000', 'ironman.png', 'Office', '', '$2y$10$vyR86e9xNQ.cutdtFfbLC.hCdk2HOwRsDOpplBGW6/kHCLtcZwoD.', 'leader'),
(34, '0223007', 'Joni', 7, 2, 'jonijoniyesspapaa@gmail.com', '1124', 'Jl. apdas', 'Aktif', '10000000', 'default.jpg', 'Office', '123445', '$2y$10$K8Df1cd4yz8de7vnzhUH0./wCDQqaPLOWYn66EPuU.leC2/db0BMS', 'biasa'),
(37, '0223006', 'Lionel Messi', 6, 1, 'jonijoniyesspapaa@gmail.com', '081223583131', 'Jl. Pagarsih Barat, Gg. Madrasah No 255', 'Aktif', '12000000', 'default.jpg', 'Office', '', '$2y$10$itvxC.kAnIX3WpupOu1YKu/pIhpfHLxEbHhqmmG.R7H8cncEf5EOq', 'leader'),
(47, '022308', 'Joni', 7, 2, 'jonijoniyesspapaa@gmail.com', '1124', 'Jl. apdas', 'Aktif', '10000000', 'default.jpg', 'Project Base', '123445', '$2y$10$K8Df1cd4yz8de7vnzhUH0./wCDQqaPLOWYn66EPuU.leC2/db0BMS', 'biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_keseluruhan`
--

CREATE TABLE `data_keseluruhan` (
  `id_keseluruhan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `ulasan` text NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_keseluruhan`
--

INSERT INTO `data_keseluruhan` (`id_keseluruhan`, `nama`, `kategori`, `ulasan`, `file`) VALUES
(8, 'jatmiko kuncoro', 'php,java,python', 'sdeec', ''),
(9, 'bagus', 'php', 'ssss', ''),
(10, 'jatmiko kuncoro', 'php', 'mkk', 'jawaban_tes_pelamar.pdf'),
(11, 'jatmiki', 'php', 'mnjgu', 'jawaban_tes_pelamar_(4)1.pdf'),
(12, 'hangus', 'php,java,python', 'jbdiyubdbbuchoi3 idn3ic3unec ', 'Soal_Kuis.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mitra`
--

CREATE TABLE `data_mitra` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `keahlian` varchar(255) NOT NULL,
  `tools` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(11) NOT NULL,
  `alamat` text NOT NULL,
  `rate_total` decimal(10,0) NOT NULL,
  `dokumen_kerjasama` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_mitra`
--

INSERT INTO `data_mitra` (`id`, `nama_perusahaan`, `nama_karyawan`, `keahlian`, `tools`, `email`, `telepon`, `alamat`, `rate_total`, `dokumen_kerjasama`, `status`, `tanggal_masuk`, `tanggal_keluar`) VALUES
(14, 'PT. ABC', 'Tango', 'a:2:{i:0;s:8:\"Contoh 1\";i:1;s:8:\"Contoh 2\";}', 'a:2:{i:0;s:8:\"Contoh 3\";i:1;s:8:\"Contoh 4\";}', 'fauzan@gmail.com', '08122358313', 'Jl. Pagarsih Barat, Gg. Madrasah No 255', '50000', 'link', 'Aktif', '2023-03-26', '2023-04-19'),
(15, 'PT. ABC', 'Fauzan Naufal Nur Ramadhani', 'a:1:{i:0;s:8:\"Contoh 1\";}', 'a:1:{i:0;s:8:\"Contoh 4\";}', 'kakang@gmail.com', '08122358313', 'Jl. Pagarsih Barat, Gg. Madrasah No 255', '50000', 'link', 'Aktif', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nilai`
--

CREATE TABLE `data_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `kalkulasi_nilai` varchar(11) NOT NULL,
  `sertifikat` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_nilai`
--

INSERT INTO `data_nilai` (`id_nilai`, `id_karyawan`, `kalkulasi_nilai`, `sertifikat`) VALUES
(3, 32, '44', 'Soal_Kuis11'),
(4, 38, '99', 'Soal_Kuis11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pelamar`
--

CREATE TABLE `data_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama_pekerjaan` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `submit_tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pelamar`
--

INSERT INTO `data_pelamar` (`id_pelamar`, `nama_pekerjaan`, `nama_lengkap`, `pendidikan`, `cv`, `alamat`, `telepon`, `email`, `submit_tanggal`) VALUES
(1, 'frontend', 'fredy', 'd3', 'cv.pdf', 'lembang', 877171959, 'fredygunawan@gmail.com', '01-09-2002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pes`
--

CREATE TABLE `data_pes` (
  `id_pes` int(12) NOT NULL,
  `id_karyawan` int(12) NOT NULL,
  `id_jenis_ujian` int(30) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `durasi_ujian` varchar(50) NOT NULL,
  `timer_ujian` varchar(50) NOT NULL,
  `status_ujian` varchar(50) NOT NULL,
  `status_ujian_ujian` varchar(50) NOT NULL,
  `file_soal` varchar(50) NOT NULL,
  `file_jawaban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pes`
--

INSERT INTO `data_pes` (`id_pes`, `id_karyawan`, `id_jenis_ujian`, `tanggal_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `file_soal`, `file_jawaban`) VALUES
(2, 25, 8, '2023-05-03', '15', '', '', '', 'Kartu_Ujian_Selvina8.pdf', 'Soal_Kuis11.pdf'),
(4, 26, 8, '2023-05-04', '60', '', '', '', 'Soal_Kuis18.pdf', 'Soal_Kuis11.pdf'),
(5, 25, 8, '2023-05-03', '15', '', '', '', 'Kartu_Ujian_Selvina8.pdf', 'Soal_Kuis11.pdf'),
(6, 25, 8, '2023-05-03', '15', '', '', '', 'Kartu_Ujian_Selvina8.pdf', 'Kartu_Ujian_Selvina9.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_posisi`
--

CREATE TABLE `data_posisi` (
  `id_posisi` int(11) NOT NULL,
  `nama_posisi` varchar(100) NOT NULL,
  `kode` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_posisi`
--

INSERT INTO `data_posisi` (`id_posisi`, `nama_posisi`, `kode`) VALUES
(5, 'Front End Developer', '001'),
(6, 'Back End Developer', '002'),
(7, 'QA', '003'),
(9, 'Fullstack Developer', '004'),
(10, 'QC', '005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelola`
--

CREATE TABLE `kelola` (
  `id` int(11) NOT NULL,
  `nama_pekerjaan` varchar(225) NOT NULL,
  `kualifikasi` varchar(225) NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelola`
--

INSERT INTO `kelola` (`id`, `nama_pekerjaan`, `kualifikasi`, `tanggal_berakhir`, `img`) VALUES
(2, 'frontend', 'menguasai vuejs', '2023-02-11', 'dd.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___bpjs`
--

CREATE TABLE `payroll___bpjs` (
  `id` int(11) NOT NULL,
  `id_datakaryawan` int(11) NOT NULL,
  `id_databpjs` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___bpjs`
--

INSERT INTO `payroll___bpjs` (`id`, `id_datakaryawan`, `id_databpjs`, `jumlah`, `total`) VALUES
(9, 25, 1, 2, 300000),
(10, 32, 4, 1, 50000),
(11, 26, 2, 2, 200000),
(13, 27, 1, 5, 750000),
(14, 29, 2, 4, 400000),
(15, 24, 4, 3, 150000),
(17, 34, 2, 5, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___databpjs`
--

CREATE TABLE `payroll___databpjs` (
  `id` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___databpjs`
--

INSERT INTO `payroll___databpjs` (`id`, `kelas`, `nilai`) VALUES
(1, 'Kelas 1', '150000'),
(2, 'Kelas 2', '100000'),
(4, 'Kelas 3', '50000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___datapajak`
--

CREATE TABLE `payroll___datapajak` (
  `id` int(11) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___datapajak`
--

INSERT INTO `payroll___datapajak` (`id`, `golongan`, `kode`, `tarif`) VALUES
(1, 'Tidak Kawin (TK)', 'TK/0', 54000000),
(2, 'Tidak Kawin (TK)', 'TK/1', 58500000),
(9, 'Tidak Kawin (TK)', 'TK/2', 63000000),
(10, 'Tidak Kawin (TK)', 'TK/3', 67500000),
(11, 'Kawin (K)', 'K/0', 58500000),
(12, 'Kawin (K)', 'K/1', 63000000),
(13, 'Kawin (K)', 'K/2', 67500000),
(14, 'Kawin (K)', 'K/3', 72000000),
(15, 'Kawin + Istri (KI)', 'K/I/0', 112500000),
(16, 'Kawin + Istri (KI)', 'K/I/1', 117000000),
(17, 'Kawin + Istri (KI)', 'K/I/2', 121500000),
(18, 'Kawin + Istri (KI)', 'K/I/3', 126000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___pajak`
--

CREATE TABLE `payroll___pajak` (
  `id` int(11) NOT NULL,
  `id_datakaryawan` int(11) NOT NULL,
  `id_datapajak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___pajak`
--

INSERT INTO `payroll___pajak` (`id`, `id_datakaryawan`, `id_datapajak`) VALUES
(2, 29, 1),
(8, 32, 1),
(10, 25, 1),
(13, 26, 1),
(14, 24, 1),
(16, 37, 1),
(17, 34, 1),
(18, 47, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___pengajuangaji`
--

CREATE TABLE `payroll___pengajuangaji` (
  `id` int(11) NOT NULL,
  `bulan_tahun` varchar(255) NOT NULL,
  `id_datakaryawan` int(11) NOT NULL,
  `nama_posisi` varchar(155) NOT NULL,
  `type` varchar(255) NOT NULL,
  `gajipokok` decimal(20,0) NOT NULL DEFAULT 0,
  `pajak` decimal(20,0) DEFAULT 0,
  `t_kinerja` decimal(20,0) DEFAULT 0,
  `t_fungsional` decimal(10,0) DEFAULT 0,
  `t_jabatan` decimal(10,0) DEFAULT 0,
  `t_bpjs` decimal(10,0) DEFAULT 0,
  `potongan` decimal(20,0) DEFAULT 0,
  `bonus` decimal(20,0) DEFAULT 0,
  `total` decimal(10,0) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___pengajuangaji`
--

INSERT INTO `payroll___pengajuangaji` (`id`, `bulan_tahun`, `id_datakaryawan`, `nama_posisi`, `type`, `gajipokok`, `pajak`, `t_kinerja`, `t_fungsional`, `t_jabatan`, `t_bpjs`, `potongan`, `bonus`, `total`, `status`) VALUES
(994, '202304', 24, 'Front End Developer', 'Office', '10000000', '250000', '500000', '700000', '1000000', '400000', '100000', '200000', '12450000', 'Belum dibayar'),
(995, '202304', 25, 'Front End Developer', 'Office', '12000000', '250000', '1200000', '500000', '250000', '450000', '250000', '300000', '14200000', 'Belum dibayar'),
(996, '202304', 26, 'QC', 'Office', '12000000', '250000', '1000000', '1000000', '200000', '300000', '150000', '0', '14100000', 'Belum dibayar'),
(997, '202304', 29, 'Back End Developer', 'Office', '12000000', '250000', '500000', '500000', '1000000', '300000', '350000', '500000', '14200000', 'Belum dibayar'),
(998, '202304', 32, 'Front End Developer', 'Office', '12000000', '250000', '1000000', '1000000', '1000000', '1000000', '500000', '1000000', '16250000', 'Belum dibayar'),
(999, '202304', 37, 'Back End Developer', 'Office', '12000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '15750000', 'Belum dibayar'),
(1000, '202304', 34, 'QA', 'Office', '10000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '13750000', 'Belum dibayar'),
(1001, '202304', 47, 'QA', 'Project Base', '10000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '13750000', 'Belum dibayar'),
(1010, '202305', 24, 'Front End Developer', 'Office', '10000000', '250000', '500000', '700000', '1000000', '400000', '100000', '200000', '12450000', 'Belum dibayar'),
(1011, '202305', 25, 'Front End Developer', 'Project Base', '12000000', '250000', '1200000', '500000', '250000', '450000', '250000', '300000', '14200000', 'Belum dibayar'),
(1012, '202305', 26, 'QC', 'Project Base', '12000000', '250000', '1000000', '1000000', '200000', '300000', '150000', '0', '14100000', 'Belum dibayar'),
(1013, '202305', 29, 'Back End Developer', 'Office', '12000000', '250000', '500000', '500000', '1000000', '300000', '350000', '500000', '14200000', 'Belum dibayar'),
(1014, '202305', 32, 'Front End Developer', 'Office', '12000000', '250000', '1000000', '1000000', '1000000', '1000000', '500000', '1000000', '16250000', 'Belum dibayar'),
(1015, '202305', 37, 'Back End Developer', 'Office', '12000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '15750000', 'Belum dibayar'),
(1016, '202305', 34, 'QA', 'Office', '10000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '13750000', 'Belum dibayar'),
(1017, '202305', 47, 'QA', 'Project Base', '10000000', '250000', '1000000', '1000000', '1000000', '1000000', '1000000', '1000000', '13750000', 'Belum dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___pengajuanratemitra`
--

CREATE TABLE `payroll___pengajuanratemitra` (
  `id` int(11) NOT NULL,
  `bulan_tahun` varchar(30) NOT NULL,
  `id_datamitra` int(11) NOT NULL,
  `rate_total` decimal(10,0) DEFAULT 0,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___pengajuanratemitra`
--

INSERT INTO `payroll___pengajuanratemitra` (`id`, `bulan_tahun`, `id_datamitra`, `rate_total`, `status`) VALUES
(29, '202305', 14, '50000', 'Sudah dibayar'),
(33, '202304', 15, '50000', 'Sudah dibayar'),
(37, '202304', 14, '50000', 'Belum dibayar'),
(39, '202305', 15, '50000', 'Belum dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll___perhitungan`
--

CREATE TABLE `payroll___perhitungan` (
  `id` int(11) NOT NULL,
  `id_datakaryawan` int(11) NOT NULL,
  `t_kinerja` decimal(10,0) NOT NULL DEFAULT 0,
  `t_fungsional` decimal(10,0) NOT NULL DEFAULT 0,
  `t_jabatan` decimal(10,0) NOT NULL DEFAULT 0,
  `t_bpjs` decimal(10,0) NOT NULL DEFAULT 0,
  `potongan` decimal(10,0) NOT NULL DEFAULT 0,
  `bonus` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll___perhitungan`
--

INSERT INTO `payroll___perhitungan` (`id`, `id_datakaryawan`, `t_kinerja`, `t_fungsional`, `t_jabatan`, `t_bpjs`, `potongan`, `bonus`) VALUES
(4, 24, '500000', '700000', '1000000', '400000', '100000', '200000'),
(5, 25, '1200000', '500000', '250000', '450000', '250000', '300000'),
(6, 27, '60000', '45', '45', '450000', '500', '1'),
(7, 26, '1000000', '1000000', '200000', '300000', '150000', '0'),
(12, 29, '500000', '500000', '1000000', '300000', '350000', '500000'),
(13, 32, '1000000', '1000000', '1000000', '1000000', '500000', '1000000'),
(14, 37, '1000000', '1000000', '1000000', '1000000', '1000000', '1000000'),
(15, 34, '1000000', '1000000', '1000000', '1000000', '1000000', '1000000'),
(16, 47, '1000000', '1000000', '1000000', '1000000', '1000000', '1000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `performances___detail_penilaian_kuesioner`
--

CREATE TABLE `performances___detail_penilaian_kuesioner` (
  `id_detail_penilaian` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_penilaian_kuesioner` int(11) NOT NULL,
  `nik_penilai` varchar(100) NOT NULL,
  `nik_menilai` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `performances___detail_penilaian_kuesioner`
--

INSERT INTO `performances___detail_penilaian_kuesioner` (`id_detail_penilaian`, `id_kuesioner`, `id_penilaian_kuesioner`, `nik_penilai`, `nik_menilai`, `tanggal`, `nilai`) VALUES
(21, 1, 3, '0223002', '0223001', '04/2023', 4),
(22, 2, 3, '0223002', '0223001', '04/2023', 5),
(23, 3, 3, '0223002', '0223001', '04/2023', 5),
(24, 4, 3, '0223002', '0223001', '04/2023', 5),
(25, 5, 3, '0223002', '0223001', '04/2023', 5),
(26, 6, 3, '0223002', '0223001', '04/2023', 5),
(27, 7, 3, '0223002', '0223001', '04/2023', 5),
(28, 8, 3, '0223002', '0223001', '04/2023', 5),
(29, 9, 3, '0223002', '0223001', '04/2023', 5),
(30, 10, 3, '0223002', '0223001', '04/2023', 4),
(31, 11, 3, '0223002', '0223001', '04/2023', 5),
(32, 12, 3, '0223002', '0223001', '04/2023', 5),
(33, 13, 3, '0223002', '0223001', '04/2023', 5),
(34, 14, 3, '0223002', '0223001', '04/2023', 5),
(35, 15, 3, '0223002', '0223001', '04/2023', 5),
(36, 16, 3, '0223002', '0223001', '04/2023', 5),
(37, 17, 3, '0223002', '0223001', '04/2023', 5),
(38, 18, 3, '0223002', '0223001', '04/2023', 5),
(39, 19, 3, '0223002', '0223001', '04/2023', 4),
(40, 20, 3, '0223002', '0223001', '04/2023', 5),
(41, 1, 4, '0223003', '0223001', '04/2023', 4),
(42, 2, 4, '0223003', '0223001', '04/2023', 5),
(43, 3, 4, '0223003', '0223001', '04/2023', 5),
(44, 4, 4, '0223003', '0223001', '04/2023', 5),
(45, 5, 4, '0223003', '0223001', '04/2023', 5),
(46, 6, 4, '0223003', '0223001', '04/2023', 4),
(47, 7, 4, '0223003', '0223001', '04/2023', 5),
(48, 8, 4, '0223003', '0223001', '04/2023', 5),
(49, 9, 4, '0223003', '0223001', '04/2023', 5),
(50, 10, 4, '0223003', '0223001', '04/2023', 5),
(51, 11, 4, '0223003', '0223001', '04/2023', 5),
(52, 12, 4, '0223003', '0223001', '04/2023', 5),
(53, 13, 4, '0223003', '0223001', '04/2023', 5),
(54, 14, 4, '0223003', '0223001', '04/2023', 5),
(55, 15, 4, '0223003', '0223001', '04/2023', 4),
(56, 16, 4, '0223003', '0223001', '04/2023', 5),
(57, 17, 4, '0223003', '0223001', '04/2023', 5),
(58, 18, 4, '0223003', '0223001', '04/2023', 5),
(59, 19, 4, '0223003', '0223001', '04/2023', 5),
(60, 20, 4, '0223003', '0223001', '04/2023', 5),
(61, 1, 5, '0223009', '0223001', '04/2023', 4),
(62, 2, 5, '0223009', '0223001', '04/2023', 5),
(63, 3, 5, '0223009', '0223001', '04/2023', 5),
(64, 4, 5, '0223009', '0223001', '04/2023', 4),
(65, 5, 5, '0223009', '0223001', '04/2023', 5),
(66, 6, 5, '0223009', '0223001', '04/2023', 5),
(67, 7, 5, '0223009', '0223001', '04/2023', 5),
(68, 8, 5, '0223009', '0223001', '04/2023', 5),
(69, 9, 5, '0223009', '0223001', '04/2023', 5),
(70, 10, 5, '0223009', '0223001', '04/2023', 3),
(71, 11, 5, '0223009', '0223001', '04/2023', 5),
(72, 12, 5, '0223009', '0223001', '04/2023', 5),
(73, 13, 5, '0223009', '0223001', '04/2023', 4),
(74, 14, 5, '0223009', '0223001', '04/2023', 5),
(75, 15, 5, '0223009', '0223001', '04/2023', 5),
(76, 16, 5, '0223009', '0223001', '04/2023', 5),
(77, 17, 5, '0223009', '0223001', '04/2023', 5),
(78, 18, 5, '0223009', '0223001', '04/2023', 4),
(79, 19, 5, '0223009', '0223001', '04/2023', 5),
(80, 20, 5, '0223009', '0223001', '04/2023', 5),
(141, 1, 9, '0223002', '0223002', '04/2023', 4),
(142, 2, 9, '0223002', '0223002', '04/2023', 5),
(143, 3, 9, '0223002', '0223002', '04/2023', 4),
(144, 4, 9, '0223002', '0223002', '04/2023', 5),
(145, 5, 9, '0223002', '0223002', '04/2023', 5),
(146, 6, 9, '0223002', '0223002', '04/2023', 5),
(147, 7, 9, '0223002', '0223002', '04/2023', 5),
(148, 8, 9, '0223002', '0223002', '04/2023', 5),
(149, 9, 9, '0223002', '0223002', '04/2023', 5),
(150, 10, 9, '0223002', '0223002', '04/2023', 5),
(151, 11, 9, '0223002', '0223002', '04/2023', 5),
(152, 12, 9, '0223002', '0223002', '04/2023', 5),
(153, 14, 9, '0223002', '0223002', '04/2023', 5),
(154, 15, 9, '0223002', '0223002', '04/2023', 4),
(155, 16, 9, '0223002', '0223002', '04/2023', 5),
(156, 17, 9, '0223002', '0223002', '04/2023', 5),
(157, 18, 9, '0223002', '0223002', '04/2023', 5),
(158, 19, 9, '0223002', '0223002', '04/2023', 5),
(159, 20, 9, '0223002', '0223002', '04/2023', 5),
(160, 1, 10, '0223001', '0223002', '04/2023', 4),
(161, 2, 10, '0223001', '0223002', '04/2023', 5),
(162, 3, 10, '0223001', '0223002', '04/2023', 4),
(163, 4, 10, '0223001', '0223002', '04/2023', 4),
(164, 5, 10, '0223001', '0223002', '04/2023', 5),
(165, 6, 10, '0223001', '0223002', '04/2023', 5),
(166, 7, 10, '0223001', '0223002', '04/2023', 4),
(167, 8, 10, '0223001', '0223002', '04/2023', 5),
(168, 9, 10, '0223001', '0223002', '04/2023', 5),
(169, 10, 10, '0223001', '0223002', '04/2023', 5),
(170, 11, 10, '0223001', '0223002', '04/2023', 5),
(171, 12, 10, '0223001', '0223002', '04/2023', 4),
(172, 13, 10, '0223001', '0223002', '04/2023', 5),
(173, 14, 10, '0223001', '0223002', '04/2023', 3),
(174, 15, 10, '0223001', '0223002', '04/2023', 4),
(175, 16, 10, '0223001', '0223002', '04/2023', 5),
(176, 17, 10, '0223001', '0223002', '04/2023', 5),
(177, 18, 10, '0223001', '0223002', '04/2023', 5),
(178, 19, 10, '0223001', '0223002', '04/2023', 1),
(179, 20, 10, '0223001', '0223002', '04/2023', 5),
(180, 1, 11, '0223003', '0223002', '04/2023', 4),
(181, 2, 11, '0223003', '0223002', '04/2023', 5),
(182, 3, 11, '0223003', '0223002', '04/2023', 5),
(183, 4, 11, '0223003', '0223002', '04/2023', 5),
(184, 5, 11, '0223003', '0223002', '04/2023', 5),
(185, 6, 11, '0223003', '0223002', '04/2023', 5),
(186, 7, 11, '0223003', '0223002', '04/2023', 5),
(187, 8, 11, '0223003', '0223002', '04/2023', 5),
(188, 9, 11, '0223003', '0223002', '04/2023', 5),
(189, 10, 11, '0223003', '0223002', '04/2023', 5),
(190, 11, 11, '0223003', '0223002', '04/2023', 4),
(191, 12, 11, '0223003', '0223002', '04/2023', 5),
(192, 13, 11, '0223003', '0223002', '04/2023', 5),
(193, 14, 11, '0223003', '0223002', '04/2023', 5),
(194, 15, 11, '0223003', '0223002', '04/2023', 5),
(195, 16, 11, '0223003', '0223002', '04/2023', 5),
(196, 17, 11, '0223003', '0223002', '04/2023', 5),
(197, 18, 11, '0223003', '0223002', '04/2023', 5),
(198, 19, 11, '0223003', '0223002', '04/2023', 5),
(199, 20, 11, '0223003', '0223002', '04/2023', 5),
(200, 1, 12, '0223006', '0223002', '04/2023', 5),
(201, 2, 12, '0223006', '0223002', '04/2023', 5),
(202, 3, 12, '0223006', '0223002', '04/2023', 5),
(203, 4, 12, '0223006', '0223002', '04/2023', 5),
(204, 5, 12, '0223006', '0223002', '04/2023', 5),
(205, 6, 12, '0223006', '0223002', '04/2023', 5),
(206, 7, 12, '0223006', '0223002', '04/2023', 5),
(207, 8, 12, '0223006', '0223002', '04/2023', 5),
(208, 9, 12, '0223006', '0223002', '04/2023', 5),
(209, 10, 12, '0223006', '0223002', '04/2023', 5),
(210, 11, 12, '0223006', '0223002', '04/2023', 5),
(211, 12, 12, '0223006', '0223002', '04/2023', 5),
(212, 13, 12, '0223006', '0223002', '04/2023', 5),
(213, 14, 12, '0223006', '0223002', '04/2023', 4),
(214, 16, 12, '0223006', '0223002', '04/2023', 4),
(215, 17, 12, '0223006', '0223002', '04/2023', 5),
(216, 19, 12, '0223006', '0223002', '04/2023', 4),
(217, 20, 12, '0223006', '0223002', '04/2023', 5),
(218, 1, 13, '0223001', '0223003', '04/2023', 4),
(219, 2, 13, '0223001', '0223003', '04/2023', 5),
(220, 3, 13, '0223001', '0223003', '04/2023', 5),
(221, 4, 13, '0223001', '0223003', '04/2023', 5),
(222, 5, 13, '0223001', '0223003', '04/2023', 5),
(223, 6, 13, '0223001', '0223003', '04/2023', 5),
(224, 7, 13, '0223001', '0223003', '04/2023', 5),
(225, 8, 13, '0223001', '0223003', '04/2023', 5),
(226, 9, 13, '0223001', '0223003', '04/2023', 5),
(227, 10, 13, '0223001', '0223003', '04/2023', 5),
(228, 11, 13, '0223001', '0223003', '04/2023', 5),
(229, 12, 13, '0223001', '0223003', '04/2023', 5),
(230, 13, 13, '0223001', '0223003', '04/2023', 5),
(231, 14, 13, '0223001', '0223003', '04/2023', 5),
(232, 15, 13, '0223001', '0223003', '04/2023', 5),
(233, 16, 13, '0223001', '0223003', '04/2023', 5),
(234, 17, 13, '0223001', '0223003', '04/2023', 5),
(235, 18, 13, '0223001', '0223003', '04/2023', 5),
(236, 19, 13, '0223001', '0223003', '04/2023', 5),
(237, 20, 13, '0223001', '0223003', '04/2023', 5),
(238, 1, 14, '0223002', '0223003', '04/2023', 4),
(239, 2, 14, '0223002', '0223003', '04/2023', 5),
(240, 3, 14, '0223002', '0223003', '04/2023', 5),
(241, 4, 14, '0223002', '0223003', '04/2023', 5),
(242, 5, 14, '0223002', '0223003', '04/2023', 5),
(243, 6, 14, '0223002', '0223003', '04/2023', 5),
(244, 7, 14, '0223002', '0223003', '04/2023', 5),
(245, 8, 14, '0223002', '0223003', '04/2023', 5),
(246, 9, 14, '0223002', '0223003', '04/2023', 4),
(247, 10, 14, '0223002', '0223003', '04/2023', 5),
(248, 11, 14, '0223002', '0223003', '04/2023', 5),
(249, 12, 14, '0223002', '0223003', '04/2023', 5),
(250, 13, 14, '0223002', '0223003', '04/2023', 5),
(251, 14, 14, '0223002', '0223003', '04/2023', 5),
(252, 15, 14, '0223002', '0223003', '04/2023', 5),
(253, 16, 14, '0223002', '0223003', '04/2023', 5),
(254, 17, 14, '0223002', '0223003', '04/2023', 5),
(255, 18, 14, '0223002', '0223003', '04/2023', 5),
(256, 19, 14, '0223002', '0223003', '04/2023', 5),
(257, 20, 14, '0223002', '0223003', '04/2023', 5),
(258, 1, 15, '0223003', '0223003', '04/2023', 4),
(259, 2, 15, '0223003', '0223003', '04/2023', 5),
(260, 3, 15, '0223003', '0223003', '04/2023', 5),
(261, 4, 15, '0223003', '0223003', '04/2023', 5),
(262, 5, 15, '0223003', '0223003', '04/2023', 4),
(263, 6, 15, '0223003', '0223003', '04/2023', 5),
(264, 7, 15, '0223003', '0223003', '04/2023', 5),
(265, 8, 15, '0223003', '0223003', '04/2023', 5),
(266, 9, 15, '0223003', '0223003', '04/2023', 5),
(267, 10, 15, '0223003', '0223003', '04/2023', 5),
(268, 11, 15, '0223003', '0223003', '04/2023', 5),
(269, 12, 15, '0223003', '0223003', '04/2023', 5),
(270, 13, 15, '0223003', '0223003', '04/2023', 5),
(271, 14, 15, '0223003', '0223003', '04/2023', 5),
(272, 15, 15, '0223003', '0223003', '04/2023', 5),
(273, 16, 15, '0223003', '0223003', '04/2023', 5),
(274, 17, 15, '0223003', '0223003', '04/2023', 5),
(275, 18, 15, '0223003', '0223003', '04/2023', 5),
(276, 19, 15, '0223003', '0223003', '04/2023', 5),
(277, 20, 15, '0223003', '0223003', '04/2023', 4),
(278, 1, 16, '0223006', '0223003', '04/2023', 4),
(279, 2, 16, '0223006', '0223003', '04/2023', 5),
(280, 3, 16, '0223006', '0223003', '04/2023', 5),
(281, 4, 16, '0223006', '0223003', '04/2023', 5),
(282, 5, 16, '0223006', '0223003', '04/2023', 5),
(283, 6, 16, '0223006', '0223003', '04/2023', 5),
(284, 7, 16, '0223006', '0223003', '04/2023', 5),
(285, 8, 16, '0223006', '0223003', '04/2023', 5),
(286, 9, 16, '0223006', '0223003', '04/2023', 5),
(287, 10, 16, '0223006', '0223003', '04/2023', 5),
(288, 11, 16, '0223006', '0223003', '04/2023', 4),
(289, 12, 16, '0223006', '0223003', '04/2023', 5),
(290, 13, 16, '0223006', '0223003', '04/2023', 5),
(291, 14, 16, '0223006', '0223003', '04/2023', 5),
(292, 15, 16, '0223006', '0223003', '04/2023', 5),
(293, 16, 16, '0223006', '0223003', '04/2023', 5),
(294, 17, 16, '0223006', '0223003', '04/2023', 5),
(295, 18, 16, '0223006', '0223003', '04/2023', 5),
(296, 19, 16, '0223006', '0223003', '04/2023', 5),
(297, 1, 17, '0223003', '0223004', '04/2023', 4),
(298, 2, 17, '0223003', '0223004', '04/2023', 5),
(299, 3, 17, '0223003', '0223004', '04/2023', 5),
(300, 4, 17, '0223003', '0223004', '04/2023', 5),
(301, 5, 17, '0223003', '0223004', '04/2023', 5),
(302, 6, 17, '0223003', '0223004', '04/2023', 5),
(303, 7, 17, '0223003', '0223004', '04/2023', 5),
(304, 8, 17, '0223003', '0223004', '04/2023', 5),
(305, 9, 17, '0223003', '0223004', '04/2023', 5),
(306, 10, 17, '0223003', '0223004', '04/2023', 5),
(307, 11, 17, '0223003', '0223004', '04/2023', 5),
(308, 12, 17, '0223003', '0223004', '04/2023', 5),
(309, 13, 17, '0223003', '0223004', '04/2023', 5),
(310, 14, 17, '0223003', '0223004', '04/2023', 5),
(311, 15, 17, '0223003', '0223004', '04/2023', 5),
(312, 16, 17, '0223003', '0223004', '04/2023', 5),
(313, 17, 17, '0223003', '0223004', '04/2023', 5),
(314, 18, 17, '0223003', '0223004', '04/2023', 4),
(315, 19, 17, '0223003', '0223004', '04/2023', 5),
(316, 1, 18, '0223004', '0223004', '04/2023', 4),
(317, 2, 18, '0223004', '0223004', '04/2023', 5),
(318, 3, 18, '0223004', '0223004', '04/2023', 5),
(319, 4, 18, '0223004', '0223004', '04/2023', 5),
(320, 5, 18, '0223004', '0223004', '04/2023', 5),
(321, 6, 18, '0223004', '0223004', '04/2023', 5),
(322, 7, 18, '0223004', '0223004', '04/2023', 5),
(323, 8, 18, '0223004', '0223004', '04/2023', 5),
(324, 9, 18, '0223004', '0223004', '04/2023', 5),
(325, 10, 18, '0223004', '0223004', '04/2023', 5),
(326, 11, 18, '0223004', '0223004', '04/2023', 5),
(327, 13, 18, '0223004', '0223004', '04/2023', 5),
(328, 14, 18, '0223004', '0223004', '04/2023', 5),
(329, 15, 18, '0223004', '0223004', '04/2023', 5),
(330, 16, 18, '0223004', '0223004', '04/2023', 5),
(331, 17, 18, '0223004', '0223004', '04/2023', 5),
(332, 18, 18, '0223004', '0223004', '04/2023', 5),
(333, 19, 18, '0223004', '0223004', '04/2023', 5),
(334, 1, 19, '0223006', '0223004', '04/2023', 4),
(335, 3, 19, '0223006', '0223004', '04/2023', 4),
(336, 5, 19, '0223006', '0223004', '04/2023', 4),
(337, 6, 19, '0223006', '0223004', '04/2023', 5),
(338, 8, 19, '0223006', '0223004', '04/2023', 5),
(339, 9, 19, '0223006', '0223004', '04/2023', 5),
(340, 10, 19, '0223006', '0223004', '04/2023', 5),
(341, 11, 19, '0223006', '0223004', '04/2023', 5),
(342, 12, 19, '0223006', '0223004', '04/2023', 5),
(343, 13, 19, '0223006', '0223004', '04/2023', 5),
(344, 14, 19, '0223006', '0223004', '04/2023', 5),
(345, 15, 19, '0223006', '0223004', '04/2023', 5),
(346, 16, 19, '0223006', '0223004', '04/2023', 5),
(347, 17, 19, '0223006', '0223004', '04/2023', 5),
(348, 18, 19, '0223006', '0223004', '04/2023', 5),
(349, 19, 19, '0223006', '0223004', '04/2023', 5),
(350, 20, 19, '0223006', '0223004', '04/2023', 5),
(351, 1, 20, '0223002', '0223004', '04/2023', 4),
(352, 2, 20, '0223002', '0223004', '04/2023', 4),
(353, 3, 20, '0223002', '0223004', '04/2023', 5),
(354, 4, 20, '0223002', '0223004', '04/2023', 5),
(355, 5, 20, '0223002', '0223004', '04/2023', 4),
(356, 6, 20, '0223002', '0223004', '04/2023', 5),
(357, 7, 20, '0223002', '0223004', '04/2023', 5),
(358, 8, 20, '0223002', '0223004', '04/2023', 5),
(359, 9, 20, '0223002', '0223004', '04/2023', 5),
(360, 10, 20, '0223002', '0223004', '04/2023', 5),
(361, 11, 20, '0223002', '0223004', '04/2023', 5),
(362, 12, 20, '0223002', '0223004', '04/2023', 5),
(363, 13, 20, '0223002', '0223004', '04/2023', 5),
(364, 14, 20, '0223002', '0223004', '04/2023', 5),
(365, 15, 20, '0223002', '0223004', '04/2023', 5),
(366, 16, 20, '0223002', '0223004', '04/2023', 5),
(367, 17, 20, '0223002', '0223004', '04/2023', 5),
(368, 18, 20, '0223002', '0223004', '04/2023', 5),
(369, 19, 20, '0223002', '0223004', '04/2023', 5),
(370, 20, 20, '0223002', '0223004', '04/2023', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `performances___inputjamkerja`
--

CREATE TABLE `performances___inputjamkerja` (
  `id_jamkerja` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `total_kerja` varchar(500) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `due_date` date NOT NULL,
  `complete_date` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `done_kerja` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `performances___penilaian_kinerja`
--

CREATE TABLE `performances___penilaian_kinerja` (
  `id_penilaian_kinerja` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `total_kerja` varchar(50) NOT NULL,
  `done_kerja` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL,
  `kategorisasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `performances___penilaian_kinerja`
--

INSERT INTO `performances___penilaian_kinerja` (`id_penilaian_kinerja`, `nik`, `tanggal`, `total_kerja`, `done_kerja`, `nilai`, `kategorisasi`) VALUES
(32, '0223001', '04/2023', '20', '19', 95, 'Sangat Baik'),
(33, '0223002', '04/2023', '20', '18', 90, 'Sangat Baik'),
(34, '0223003', '04/2023', '20', '15', 75, 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `performances___penilaian_kuesioner`
--

CREATE TABLE `performances___penilaian_kuesioner` (
  `id_penilaian_kuesioner` int(11) NOT NULL,
  `nik_penilai` varchar(100) DEFAULT NULL,
  `nik_menilai` varchar(100) DEFAULT NULL,
  `tanggal` varchar(100) NOT NULL,
  `total_nilai` int(11) NOT NULL,
  `total_soal` int(11) DEFAULT 0,
  `saran` varchar(750) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `performances___penilaian_kuesioner`
--

INSERT INTO `performances___penilaian_kuesioner` (`id_penilaian_kuesioner`, `nik_penilai`, `nik_menilai`, `tanggal`, `total_nilai`, `total_soal`, `saran`) VALUES
(1, '0223001', '0223001', '04/2023', 98, 20, 'menilai diri sendiri'),
(3, '0223002', '0223001', '04/2023', 97, 20, 'menilai ceo'),
(4, '0223003', '0223001', '04/2023', 97, 20, 'menilai leader'),
(5, '0223007', '0223001', '04/2023', 94, 20, 'menilai leader'),
(9, '0223002', '0223002', '04/2023', 92, 19, 'semoga makin baik'),
(10, '0223001', '0223002', '04/2023', 88, 20, 'mskkmes'),
(11, '0223003', '0223002', '04/2023', 98, 20, 'kmdksnkds'),
(12, '0223006', '0223002', '04/2023', 87, 18, 'menilai rekan 2'),
(13, '0223001', '0223003', '04/2023', 99, 20, 'menilai hasbi karyawan'),
(14, '0223002', '0223003', '04/2023', 98, 20, 'hasbi karyawan'),
(15, '0223003', '0223003', '04/2023', 97, 20, 'jkdsdn'),
(16, '0223006', '0223003', '04/2023', 93, 19, 'lsdlsdm'),
(17, '0223003', '0223004', '03/2023', 93, 19, 'menilai leader'),
(18, '0223004', '0223004', '03/2023', 89, 18, 'DNSIND'),
(19, '0223006', '0223004', '03/2023', 82, 17, 'DSMJD'),
(20, '0223002', '0223004', '03/2023', 96, 20, 'sds');

-- --------------------------------------------------------

--
-- Struktur dari tabel `recruitment___hasiltes`
--

CREATE TABLE `recruitment___hasiltes` (
  `id_hasiltes` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `hasil_link` varchar(255) NOT NULL,
  `hasil-file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai_pg` varchar(255) NOT NULL,
  `nilai_tes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `recruitment___pekerjaan`
--

CREATE TABLE `recruitment___pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `id_posisi` varchar(255) NOT NULL,
  `kualifikasi` varchar(225) NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi_pekerjaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `recruitment___pekerjaan`
--

INSERT INTO `recruitment___pekerjaan` (`id_pekerjaan`, `id_posisi`, `kualifikasi`, `tanggal_berakhir`, `foto`, `deskripsi_pekerjaan`) VALUES
(3, '5', 'bhbhjv', '2023-04-22', 'default.jpg', 'bkjbk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `recruitment___pelamar`
--

CREATE TABLE `recruitment___pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `file_cv` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hasil_interview` varchar(255) NOT NULL,
  `telepon` int(11) NOT NULL,
  `tanggal_interview` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `link_interview` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_kuesioner`
--

CREATE TABLE `soal_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `kuesioner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_kuesioner`
--

INSERT INTO `soal_kuesioner` (`id_kuesioner`, `kuesioner`) VALUES
(1, 'Askfnsifbisfbsib'),
(2, 'fauzan'),
(3, 'Bagaimana Cara berkomunikasi karyawan tersebut?'),
(4, 'Apakah Karyawan bekerja selama 8 jam'),
(5, 'Apakah Karyawan Dapat bekerja tim?'),
(6, 'Apakah Karyawan Dapat ber-adaptatsi dalam tim?'),
(7, 'Memiliki tanggung jawab daam erkejaan dan task yang dikerjakan'),
(8, 'mdbsjdbs'),
(9, 'kdjbjbfjdbf'),
(10, 'kdbfjdkbfkdbkdf'),
(11, 'kbdbskdbskdbsbdks'),
(12, 'skdksbdsbdkbsdkbskdbksbdksbkdbks'),
(13, 'sdbdjasbdbakdbksa'),
(14, ' ABDNSABDASBJDBASJDASDJ'),
(15, 'skdnkdsnkdnsknds'),
(16, 'Apakah Karyawan bekerja selama 8 jam'),
(17, 'sds'),
(18, 'Apakah Karyawan Dapat bekerja tim?'),
(19, 'Apakah Karyawan Dapat ber-adaptatsi dalam tim?'),
(20, 'Apakah Karyawan Dapat bekerja tim?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(5) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `id_soal_ujian` int(5) NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(26, 24, 16, 'C', '1'),
(27, 25, 18, 'A', '0'),
(28, 25, 16, 'C', '1'),
(29, 25, 17, 'B', '0'),
(30, 25, 19, 'C', '0'),
(31, 25, 20, 'C', '1'),
(32, 26, 19, 'B', '1'),
(33, 26, 20, 'C', '1'),
(34, 26, 18, 'B', '1'),
(35, 26, 16, 'C', '1'),
(36, 26, 17, 'D', '1'),
(37, 0, 0, '', ''),
(38, 0, 0, '', ''),
(39, 0, 0, '', ''),
(40, 0, 0, '', ''),
(41, 0, 0, '', ''),
(42, 0, 0, '', ''),
(43, 0, 0, '', ''),
(44, 0, 0, '', ''),
(45, 0, 0, '', ''),
(46, 0, 0, '', ''),
(47, 0, 0, '', ''),
(48, 0, 0, '', ''),
(49, 52, 36, 'A', '0'),
(50, 52, 35, 'B', '0'),
(51, 52, 34, 'D', '0'),
(52, 52, 32, 'C', '0'),
(53, 53, 32, 'C', '0'),
(54, 53, 36, 'E', '0'),
(55, 53, 35, 'A', '1'),
(56, 53, 34, 'C', '0'),
(57, 53, 38, 'A', '1'),
(58, 53, 39, 'B', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int(11) NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(8, 'Pre-test'),
(9, 'Post-Test\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Senior'),
(2, 'Junior');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_jenis_ujian` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `deadline` time NOT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `status_ujian_ujian` int(11) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `soal_file` varchar(50) NOT NULL,
  `jawaban_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id_posisi`, `id_karyawan`, `id_jenis_ujian`, `tanggal_ujian`, `jam_ujian`, `deadline`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `benar`, `salah`, `nilai`, `soal_file`, `jawaban_file`) VALUES
(8, 7, 47, 1, '2020-06-13', '15:46:00', '00:00:00', 5, 300, 2, 2, '0', '0', '0', '', ''),
(52, 5, 29, 8, '2023-03-29', '15:15:00', '00:00:00', 120, 7200, 2, 2, '0', '4', '0', '', ''),
(53, 5, 32, 8, '2023-03-30', '14:50:00', '00:00:00', 15, 900, 2, 2, '3', '3', '50', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal_ujian` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci_jawaban` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal_ujian`, `id_posisi`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`) VALUES
(32, 5, 'aunbucis', ' wkjcnwi', 'kj ciwcixwj', 'dicwd', 'kjcijw', 'kn cw', 'E'),
(33, 6, 'w', 'w', 'w', 'f', 'fw', 'fw', 'E'),
(34, 5, 'sdg', 'vwdv', 'vwd', 'vw', 'vdwvwd', 'vdwvw', 'E'),
(35, 5, 'ianccdniius', 'cce\r\n', 'cd3cd', 'cdc', 'c3c3cd', 'c3d3', 'A'),
(36, 5, 'apa kepanjangan dari html', 'kjanec', 'ks cuw', ' ucscw', ' juschw', 'usc yh', 'B'),
(38, 5, 'jika melakukan pengerjaan dalam kode php ketika tidak meggunakan titik koma eror atau tidak', 'ya', 'tidak', 'bisa jadi', 'kemungkinan bisa', 'tidak ada yang benar', 'A'),
(39, 5, 'hjhjjhhj', 'ded', 'dee', 'feef', 'efded', 'dede', 'B'),
(43, 5, 'kucing dan anj', 'y', 't', 'e', 'f', 'd', 'a'),
(44, 5, 'kucing dan tikus bertengkar', 'y', 't', 'e', 'f', 'd', 'a'),
(45, 5, 'jika ada yang bilang aku tak peduli padamu jangan pernah kau hiraukan', 'd', 'g', 'v', 'b', 'm', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__dosen`
--

CREATE TABLE `training__dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip` char(12) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `matkul_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `training__dosen`
--

INSERT INTO `training__dosen` (`id_dosen`, `nip`, `nama_dosen`, `email`, `matkul_id`) VALUES
(1, '12345678', 'Koro Sensei', 'korosensei@gmail.com', 1),
(3, '01234567', 'Tobirama Sensei', 'tobirama@gmail.com', 5);

--
-- Trigger `training__dosen`
--
DELIMITER $$
CREATE TRIGGER `edit_user_dosen` BEFORE UPDATE ON `training__dosen` FOR EACH ROW UPDATE `users` SET `email` = NEW.email, `username` = NEW.nip WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_user_dosen` BEFORE DELETE ON `training__dosen` FOR EACH ROW DELETE FROM `users` WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__h_ujian`
--

CREATE TABLE `training__h_ujian` (
  `id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `nilai_bobot` decimal(10,2) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__h_ujian`
--

INSERT INTO `training__h_ujian` (`id`, `ujian_id`, `mahasiswa_id`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(1, 1, 1, '1,2,3', '1:B:N,2:A:N,3:D:N', 3, '100.00', '100.00', '2019-02-16 08:35:05', '2019-02-16 08:36:05', 'N'),
(2, 2, 1, '3,2,1', '3:D:N,2:C:N,1:D:N', 1, '33.00', '100.00', '2019-02-16 10:11:14', '2019-02-16 10:12:14', 'N'),
(3, 3, 1, '5,6', '5:C:N,6:D:N', 2, '100.00', '100.00', '2019-02-16 11:06:25', '2019-02-16 11:07:25', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__jurusan`
--

CREATE TABLE `training__jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__jurusan`
--

INSERT INTO `training__jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Sistem Informasi'),
(2, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__jurusan_matkul`
--

CREATE TABLE `training__jurusan_matkul` (
  `id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__jurusan_matkul`
--

INSERT INTO `training__jurusan_matkul` (`id`, `matkul_id`, `jurusan_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__kelas`
--

CREATE TABLE `training__kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__kelas`
--

INSERT INTO `training__kelas` (`id_kelas`, `nama_kelas`, `jurusan_id`) VALUES
(1, '12.1E.13', 1),
(2, '11.1A.13', 1),
(3, '10.1D.13', 1),
(7, '12.1A.10', 2),
(8, '12.1B.10', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__matkul`
--

CREATE TABLE `training__matkul` (
  `id_matkul` int(11) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__matkul`
--

INSERT INTO `training__matkul` (`id_matkul`, `nama_matkul`) VALUES
(1, 'Bahasa Inggris'),
(2, 'Dasar Pemrograman'),
(3, 'Enterpreneurship'),
(5, 'Matematika Advanced');

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__m_ujian`
--

CREATE TABLE `training__m_ujian` (
  `id_ujian` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `nama_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `jenis` enum('acak','urut') NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `terlambat` datetime NOT NULL,
  `token` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__m_ujian`
--

INSERT INTO `training__m_ujian` (`id_ujian`, `dosen_id`, `matkul_id`, `nama_ujian`, `jumlah_soal`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
(1, 1, 1, 'First Test', 3, 1, 'acak', '2019-02-15 17:25:40', '2019-02-20 17:25:44', 'DPEHL'),
(2, 1, 1, 'Second Test', 3, 1, 'acak', '2019-02-16 10:05:08', '2019-02-17 10:05:10', 'GOEMB'),
(3, 3, 5, 'Try Out 01', 2, 1, 'acak', '2019-02-16 07:00:00', '2019-02-28 14:00:00', 'IFSDH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `training__tb_soal`
--

CREATE TABLE `training__tb_soal` (
  `id_soal` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe_file` varchar(50) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `file_a` varchar(255) NOT NULL,
  `file_b` varchar(255) NOT NULL,
  `file_c` varchar(255) NOT NULL,
  `file_d` varchar(255) NOT NULL,
  `file_e` varchar(255) NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training__tb_soal`
--

INSERT INTO `training__tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`) VALUES
(1, 1, 1, 1, '', '', '<p>Dian : The cake is scrumptious! I love i<br>Joni : … another piece?<br>Dian : Thank you. You should tell me the recipe.<br>Joni : I will.</p><p>Which of the following offering expressions best fill the blank?</p>', '<p>Do you mind if you have</p>', '<p>Would you like</p>', '<p>Shall you hav</p>', '<p>Can I have you</p>', '<p>I will bring you</p>', '', '', '', '', '', 'B', 1550225760, 1550225760),
(2, 1, 1, 1, '', '', '<p>Fitri : The French homework is really hard. I don’t feel like to do it.<br>Rahmat : … to help you?<br>Fitri : It sounds great. Thanks, Rahmat!</p><p><br></p><p>Which of the following offering expressions best fill the blank?</p>', '<p>Would you like me</p>', '<p>Do you mind if I</p>', '<p>Shall I</p>', '<p>Can I</p>', '<p>I will</p>', '', '', '', '', '', 'A', 1550225952, 1550225952),
(3, 1, 1, 1, 'd166959dabe9a81e4567dc44021ea503.jpg', 'image/jpeg', '<p>What is the picture describing?</p><p><small class=\"text-muted\">Sumber gambar: meros.jp</small></p>', '<p>The students are arguing with their lecturer.</p>', '<p>The students are watching their preacher.</p>', '<p>The teacher is angry with their students.</p>', '<p>The students are listening to their lecturer.</p>', '<p>The students detest the preacher.</p>', '', '', '', '', '', 'D', 1550226174, 1550226174),
(5, 3, 5, 1, '', '', '<p>(2000 x 3) : 4 x 0 = ...</p>', '<p>NULL</p>', '<p>NaN</p>', '<p>0</p>', '<p>1</p>', '<p>-1</p>', '', '', '', '', '', 'C', 1550289702, 1550289724),
(6, 3, 5, 1, '98a79c067fefca323c56ed0f8d1cac5f.png', 'image/png', '<p>Nomor berapakah ini?</p>', '<p>Sembilan</p>', '<p>Sepuluh</p>', '<p>Satu</p>', '<p>Tujuh</p>', '<p>Tiga</p>', '', '', '', '', '', 'D', 1550289774, 1550289774);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(8, 'fauzan@gmail.com', 'wlsgEN0n2uFSIZKfmlW9LOaY4ja56BN3U36NEyivjps=', 1678348592),
(14, 'ronaldo@gmail.com', '8FkZo0Q/GCz7XlwwZ9nB+LuQt1T5B+fXee6nuBmHj9s=', 1679820161);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_akun`
--
ALTER TABLE `data_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `id_posisi` (`id_posisi`);

--
-- Indeks untuk tabel `data_keseluruhan`
--
ALTER TABLE `data_keseluruhan`
  ADD PRIMARY KEY (`id_keseluruhan`);

--
-- Indeks untuk tabel `data_mitra`
--
ALTER TABLE `data_mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `data_pelamar`
--
ALTER TABLE `data_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indeks untuk tabel `data_pes`
--
ALTER TABLE `data_pes`
  ADD PRIMARY KEY (`id_pes`);

--
-- Indeks untuk tabel `data_posisi`
--
ALTER TABLE `data_posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indeks untuk tabel `kelola`
--
ALTER TABLE `kelola`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___bpjs`
--
ALTER TABLE `payroll___bpjs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___databpjs`
--
ALTER TABLE `payroll___databpjs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___datapajak`
--
ALTER TABLE `payroll___datapajak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___pajak`
--
ALTER TABLE `payroll___pajak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datakaryawan` (`id_datakaryawan`);

--
-- Indeks untuk tabel `payroll___pengajuangaji`
--
ALTER TABLE `payroll___pengajuangaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___pengajuanratemitra`
--
ALTER TABLE `payroll___pengajuanratemitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payroll___perhitungan`
--
ALTER TABLE `payroll___perhitungan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `performances___detail_penilaian_kuesioner`
--
ALTER TABLE `performances___detail_penilaian_kuesioner`
  ADD PRIMARY KEY (`id_detail_penilaian`),
  ADD KEY `id_penilaian_kuesioner` (`id_penilaian_kuesioner`),
  ADD KEY `id_kuesioer` (`id_kuesioner`);

--
-- Indeks untuk tabel `performances___inputjamkerja`
--
ALTER TABLE `performances___inputjamkerja`
  ADD PRIMARY KEY (`id_jamkerja`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `performances___penilaian_kinerja`
--
ALTER TABLE `performances___penilaian_kinerja`
  ADD PRIMARY KEY (`id_penilaian_kinerja`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `performances___penilaian_kuesioner`
--
ALTER TABLE `performances___penilaian_kuesioner`
  ADD PRIMARY KEY (`id_penilaian_kuesioner`),
  ADD KEY `nik_penilai` (`nik_penilai`),
  ADD KEY `menilai` (`nik_menilai`);

--
-- Indeks untuk tabel `recruitment___hasiltes`
--
ALTER TABLE `recruitment___hasiltes`
  ADD PRIMARY KEY (`id_hasiltes`);

--
-- Indeks untuk tabel `recruitment___pekerjaan`
--
ALTER TABLE `recruitment___pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indeks untuk tabel `recruitment___pelamar`
--
ALTER TABLE `recruitment___pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indeks untuk tabel `soal_kuesioner`
--
ALTER TABLE `soal_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_matakuliah` (`id_posisi`),
  ADD KEY `id_mahasiswa` (`id_karyawan`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`);

--
-- Indeks untuk tabel `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `id_matakuliah` (`id_posisi`);

--
-- Indeks untuk tabel `training__dosen`
--
ALTER TABLE `training__dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `matkul_id` (`matkul_id`);

--
-- Indeks untuk tabel `training__h_ujian`
--
ALTER TABLE `training__h_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_id` (`ujian_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indeks untuk tabel `training__jurusan`
--
ALTER TABLE `training__jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `training__jurusan_matkul`
--
ALTER TABLE `training__jurusan_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`),
  ADD KEY `matkul_id` (`matkul_id`);

--
-- Indeks untuk tabel `training__kelas`
--
ALTER TABLE `training__kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indeks untuk tabel `training__matkul`
--
ALTER TABLE `training__matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `training__m_ujian`
--
ALTER TABLE `training__m_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `matkul_id` (`matkul_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `training__tb_soal`
--
ALTER TABLE `training__tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `matkul_id` (`matkul_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_akun`
--
ALTER TABLE `data_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `data_keseluruhan`
--
ALTER TABLE `data_keseluruhan`
  MODIFY `id_keseluruhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_mitra`
--
ALTER TABLE `data_mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_nilai`
--
ALTER TABLE `data_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_pelamar`
--
ALTER TABLE `data_pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_pes`
--
ALTER TABLE `data_pes`
  MODIFY `id_pes` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `data_posisi`
--
ALTER TABLE `data_posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kelola`
--
ALTER TABLE `kelola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `payroll___bpjs`
--
ALTER TABLE `payroll___bpjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `payroll___databpjs`
--
ALTER TABLE `payroll___databpjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `payroll___datapajak`
--
ALTER TABLE `payroll___datapajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `payroll___pajak`
--
ALTER TABLE `payroll___pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `payroll___pengajuangaji`
--
ALTER TABLE `payroll___pengajuangaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT untuk tabel `payroll___pengajuanratemitra`
--
ALTER TABLE `payroll___pengajuanratemitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `payroll___perhitungan`
--
ALTER TABLE `payroll___perhitungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `performances___detail_penilaian_kuesioner`
--
ALTER TABLE `performances___detail_penilaian_kuesioner`
  MODIFY `id_detail_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT untuk tabel `performances___inputjamkerja`
--
ALTER TABLE `performances___inputjamkerja`
  MODIFY `id_jamkerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `performances___penilaian_kinerja`
--
ALTER TABLE `performances___penilaian_kinerja`
  MODIFY `id_penilaian_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `performances___penilaian_kuesioner`
--
ALTER TABLE `performances___penilaian_kuesioner`
  MODIFY `id_penilaian_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `recruitment___hasiltes`
--
ALTER TABLE `recruitment___hasiltes`
  MODIFY `id_hasiltes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `recruitment___pekerjaan`
--
ALTER TABLE `recruitment___pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `recruitment___pelamar`
--
ALTER TABLE `recruitment___pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal_kuesioner`
--
ALTER TABLE `soal_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `training__dosen`
--
ALTER TABLE `training__dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `training__h_ujian`
--
ALTER TABLE `training__h_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `training__jurusan`
--
ALTER TABLE `training__jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `training__jurusan_matkul`
--
ALTER TABLE `training__jurusan_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `training__kelas`
--
ALTER TABLE `training__kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `training__matkul`
--
ALTER TABLE `training__matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `training__m_ujian`
--
ALTER TABLE `training__m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `training__tb_soal`
--
ALTER TABLE `training__tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD CONSTRAINT `id_posisi_fk` FOREIGN KEY (`id_posisi`) REFERENCES `data_posisi` (`id_posisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `performances___detail_penilaian_kuesioner`
--
ALTER TABLE `performances___detail_penilaian_kuesioner`
  ADD CONSTRAINT `performances___detail_penilaian_kuesioner_ibfk_1` FOREIGN KEY (`id_penilaian_kuesioner`) REFERENCES `performances___penilaian_kuesioner` (`id_penilaian_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performances___detail_penilaian_kuesioner_ibfk_2` FOREIGN KEY (`id_kuesioner`) REFERENCES `soal_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `performances___penilaian_kinerja`
--
ALTER TABLE `performances___penilaian_kinerja`
  ADD CONSTRAINT `performances___penilaian_kinerja_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `data_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `performances___penilaian_kuesioner`
--
ALTER TABLE `performances___penilaian_kuesioner`
  ADD CONSTRAINT `performances___penilaian_kuesioner_ibfk_1` FOREIGN KEY (`nik_penilai`) REFERENCES `data_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performances___penilaian_kuesioner_ibfk_2` FOREIGN KEY (`nik_menilai`) REFERENCES `data_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
