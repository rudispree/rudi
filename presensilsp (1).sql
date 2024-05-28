-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 03:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensilsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) NOT NULL,
  `kode_cabang` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `lokasi_kantor` varchar(255) NOT NULL,
  `radius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `kode_cabang`, `nama_cabang`, `lokasi_kantor`, `radius`) VALUES
(4, '004', 'LSP DIGITAL MARKETING', '-7.278897072365858,112.7653285393248', 23500);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `kode_dept` varchar(50) NOT NULL,
  `nama_dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_dept`, `nama_dept`) VALUES
(1, 'MKTMd', 'Marketingd'),
(2, 'HRD', 'Human Resource Development d'),
(3, 'MGR', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id` int(11) NOT NULL,
  `kode_jam_kerja` char(8) NOT NULL,
  `nama_jam_kerja` varchar(255) DEFAULT NULL,
  `awal_jam_masuk` time DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `akhir_jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`id`, `kode_jam_kerja`, `nama_jam_kerja`, `awal_jam_masuk`, `jam_masuk`, `akhir_jam_masuk`, `jam_pulang`) VALUES
(1, 'JK01', 'REGULER', '05:08:43', '09:04:00', '23:30:43', '17:00:43'),
(4, 'JK02', 'SIANG', '13:00:00', '13:00:00', '22:02:00', '22:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` int(15) NOT NULL,
  `nama_lengkap` varchar(80) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `no_hp` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_lengkap`, `jabatan`, `no_hp`, `password`, `remember_token`) VALUES
(12345, 'Rudi', 'IT G Jelas', '0878787897878', '$2y$10$a9jvU6Y4akaaR5Ec.tut8eE5hpRC4Del5C9B3xLxaMjk1yycs2e6G', '');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `nik` int(50) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `no_hp` varchar(200) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `kode_dept` char(12) DEFAULT NULL,
  `kode_cabang` int(11) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`nik`, `nama_lengkap`, `jabatan`, `no_hp`, `foto`, `password`, `kode_dept`, `kode_cabang`, `remember_token`) VALUES
(333, 'husnul', 'Instruktur', '1212121212', '333.png', '$2y$10$pZIZo.7DAXONBNFXUZZNU.eDbGcAdhoU2yuy1F7f00grN1XkHRMOu', 'MKTMd', 4, NULL),
(1111, 'Dodot', 'Wakil Dekan', '11111', '1111.PNG', '$2y$10$je639WABbKXR3xuUV6SQNOUDaF61htopTOjZVchjMAmCBNykLKFca', 'MKTM', 3, NULL),
(12345, 'dadan sutisna x d', 'sadsad', '323432423', '12345.PNG', '$2y$10$O/OiXym6qN7zdfkGlClNYev8tSi6al7.mcgm2lDM2USS3jq4WNw7y', 'STF', NULL, NULL),
(22222, 'ajeng f', 'staf', '23222', '22222.png', '$2y$10$hFRlmpfPmWXo/teJkWf9UuYGLxOog4HfqC6OfuRnDpm20kVpkodOq', 'STF', NULL, NULL),
(77777, 'cilok', 'sadsad', '323432423', '22222.png', '$2y$10$TDjYpfQYV6ixgK0LUiqr.eK1t3t59mGfHK4mkbENcoH7Calerd8vC', 'STF', NULL, NULL),
(113434, 'dadan sutisna x d', 'sadsad', '323432423', '12345.PNG', '$2y$10$GnypVVEL8rOkFHuC6wvtQevswn2Jvjm5usYNDRuOqUmTjp.8kTC4y', 'STF', NULL, NULL),
(113435, 'ajeng f', 'staf', '23222', '12345.PNG', '$2y$10$JEO4sytqzh/vqd1Wz6FmWOOP2dbl3YB7PMtllcmazdhSoWtdDnFv2', 'STF', NULL, NULL),
(113436, 'cilok', 'sadsad', '323432423', 'RUDI.JPG', '$2y$10$DJ09T5NGdv.e9K6oPEs5IuBac/ugudN18syTu/ywlbJLufNA0MV1y', 'STF', NULL, NULL),
(113438, 'Rudi', 'Admin', '098765432123', 'RUDI.JPG', '$2y$10$CMPh5TUtBsivbRj5bqMz.O2R77Gv9Be7JJgn1zqNkQEMAleQTQ87O', 'STF', NULL, NULL),
(123456, 'Rudi', 'Instruktur', '1212121212', '123456.png', '$2y$10$YtBycSCOV0WnRVXbYCu9K.pexGjWzfBv3sDyYEQuKqhyN/TamkJ/G', 'HRD', 4, NULL),
(333333, 'devi', 'Wakil Dekan', '23232332', '333333.PNG', '$2y$10$4qlLX5.07bkb6IQPKZMGJ.ArwnS/bPD/dzM9YcNxA6eVmDyW1GdTC', 'STF', NULL, NULL),
(1234567, 'Cery', 'Instruktur', '121212121', '1234567.png', '$2y$10$LyQMQSNdC5LWdA8JaVh1yeonm.QAcplWZtDO1NV0/w0n8ZPLTtuua', 'MKTM', 2, NULL),
(43424243, 'Dodot', 'Wakil Dekan', '123131312', '43424243.png', '$2y$10$IqRMUF32x.dOjyepXtod3Ow02A.6tGT.AzEzL.wpXBmypGE5.E7Wm', 'HRD', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_jamkerja`
--

CREATE TABLE `konfigurasi_jamkerja` (
  `id` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `hari` varchar(40) NOT NULL,
  `kode_jam_kerja` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi_jamkerja`
--

INSERT INTO `konfigurasi_jamkerja` (`id`, `nik`, `hari`, `kode_jam_kerja`) VALUES
(25, '43424243', 'senin', 'JK02'),
(26, '43424243', 'Selasa', 'JK02'),
(27, '43424243', 'Rabu', 'JK02'),
(28, '43424243', 'Kamis', 'JK02'),
(29, '43424243', 'Jumat', 'JK02'),
(30, '43424243', 'Sabtu', 'JK02'),
(31, '123456', 'senin', 'JK01'),
(32, '123456', 'Selasa', 'JK01'),
(33, '123456', 'Rabu', 'JK01'),
(34, '123456', 'Kamis', 'JK01'),
(35, '123456', 'Jumat', 'JK01'),
(36, '123456', 'Sabtu', 'JK01');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_lokasi`
--

CREATE TABLE `konfigurasi_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi_kantor` varchar(255) DEFAULT NULL,
  `radius` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi_lokasi`
--

INSERT INTO `konfigurasi_lokasi` (`id`, `lokasi_kantor`, `radius`) VALUES
(1, '-6.240945232965073,106.62980881017731', 33);

-- --------------------------------------------------------

--
-- Table structure for table `master_cuti`
--

CREATE TABLE `master_cuti` (
  `kode_cuti` int(11) NOT NULL,
  `kode_cuti_karyawan` varchar(50) NOT NULL,
  `nama_cuti` varchar(255) NOT NULL,
  `jml_hari` smallint(6) NOT NULL,
  `tgl_izin_dari` date DEFAULT NULL,
  `tgl_izin_sampai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_cuti`
--

INSERT INTO `master_cuti` (`kode_cuti`, `kode_cuti_karyawan`, `nama_cuti`, `jml_hari`, `tgl_izin_dari`, `tgl_izin_sampai`) VALUES
(2, 'KBD', 'cuti melahirkandfdfd', 4, '2023-10-14', '2023-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `id` int(11) NOT NULL,
  `nik` int(25) NOT NULL,
  `tgl_izin_dari` date NOT NULL,
  `tgl_izin_sampai` date NOT NULL,
  `status` char(10) NOT NULL,
  `kode_cuti_karyawan` varchar(50) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `doc_sid` varchar(255) DEFAULT NULL,
  `status_approved` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`id`, `nik`, `tgl_izin_dari`, `tgl_izin_sampai`, `status`, `kode_cuti_karyawan`, `keterangan`, `doc_sid`, `status_approved`) VALUES
(21, 123456, '2023-09-24', '2023-09-26', 'i', '', 'ssss', NULL, '0'),
(22, 123456, '2023-09-26', '2023-09-28', 'i', '', 'czxczcz', NULL, '1'),
(23, 123456, '2023-09-28', '2023-09-30', 's', '', 'sdsdsd', NULL, NULL),
(24, 123456, '2023-09-27', '2023-09-30', 's', '', 'sdsdsds', '875787245.jpg', NULL),
(25, 123456, '2023-11-02', '2023-11-09', 'c', '2', 'sdsdsd', NULL, NULL),
(26, 123456, '2023-11-03', '2023-11-10', 'c', '2', 'ssdsdsd', NULL, NULL),
(27, 123456, '2023-11-04', '2023-11-06', 'i', NULL, 'Sakit demam', NULL, NULL),
(28, 123456, '2023-11-04', '2023-11-13', 'i', NULL, 'hjh', NULL, NULL),
(29, 123456, '2023-11-10', '2023-11-13', 'c', '2', 'ghgh', NULL, NULL),
(30, 123456, '2023-11-04', '2023-11-06', 's', NULL, 'zxzxzxzx', '199764380.png', NULL),
(31, 123456, '2023-11-04', '2023-11-12', 's', NULL, 'zxzxz', '1708552774.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `nik` int(15) DEFAULT NULL,
  `tgl_presensi` date DEFAULT NULL,
  `jam_in` time DEFAULT NULL,
  `jam_out` time DEFAULT NULL,
  `foto_in` varchar(200) DEFAULT NULL,
  `foto_out` varchar(255) DEFAULT NULL,
  `lokasi_in` text DEFAULT NULL,
  `lokasi_out` text DEFAULT NULL,
  `kode_jam_kerja` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `nik`, `tgl_presensi`, `jam_in`, `jam_out`, `foto_in`, `foto_out`, `lokasi_in`, `lokasi_out`, `kode_jam_kerja`) VALUES
(65, 123456, '2023-09-07', '08:36:21', NULL, '123456-2023-09-07_in.png', NULL, '-6.2521344,106.6074112', NULL, 'JK01'),
(66, 123456, '2023-09-08', '09:24:14', NULL, '123456-2023-09-08_in.png', NULL, '-6.2065573,106.6026064', NULL, 'JK01'),
(67, 123456, '2023-09-12', '17:27:23', NULL, '123456-2023-09-12_in.png', NULL, '-6.2409661,106.6300685', NULL, 'JK01'),
(69, 123456, '2023-09-13', '22:12:36', NULL, '123456-2023-09-13_in.png', NULL, '-6.2685184,106.5811968', NULL, 'JK01'),
(70, 123456, '2023-09-14', '08:18:46', NULL, '123456-2023-09-14_in.png', NULL, '-6.2408788,106.6300375', NULL, 'JK01'),
(71, 123456, '2023-09-15', '08:16:28', NULL, '123456-2023-09-15_in.png', NULL, '-6.2334598,106.6409313', NULL, 'JK01'),
(72, 123456, '2023-09-18', '16:58:33', '17:02:10', '123456-2023-09-18_in.png', '123456-2023-09-18_out.png', '-6.2408076,106.6298915', '-6.2409518,106.6299778', 'JK01'),
(73, 123456, '2023-09-19', '08:27:03', '21:33:05', '123456-2023-09-19_in.png', '123456-2023-09-19_out.png', '-6.2409341,106.6300928', '-6.2128128,106.6041344', 'JK01'),
(74, 123456, '2023-09-20', '08:33:17', NULL, '123456-2023-09-20_in.png', NULL, '-6.233442,106.6513858', NULL, 'JK01'),
(75, 123456, '2023-09-21', '08:28:20', NULL, '123456-2023-09-21_in.png', NULL, '-6.2334598,106.6409313', NULL, 'JK01'),
(76, 123456, '2023-09-22', '21:49:52', '21:50:10', '123456-2023-09-22_in.png', '123456-2023-09-22_out.png', '-6.2029824,106.6139648', '-6.2029824,106.6139648', 'JK01'),
(77, 123456, '2023-09-23', '08:21:53', NULL, '123456-2023-09-23_in.png', NULL, '-6.240952,106.6300644', NULL, 'JK01'),
(78, 123456, '2023-09-25', '08:33:30', '20:07:24', '123456-2023-09-25_in.png', '123456-2023-09-25_out.png', '-6.2334598,106.6409313', '-6.2409499,106.6300604', 'JK01'),
(79, 123456, '2023-09-26', '08:29:04', NULL, '123456-2023-09-26_in.png', NULL, '-6.2334598,106.6409313', NULL, 'JK01'),
(80, 123456, '2023-09-27', '08:13:53', NULL, '123456-2023-09-27_in.png', NULL, '-6.2334598,106.6409313', NULL, 'JK01'),
(81, 123456, '2023-10-03', '08:24:43', NULL, '123456-2023-10-03_in.png', NULL, '-6.2408864,106.6300558', NULL, 'JK01'),
(82, 123456, '2023-10-13', '06:32:49', NULL, '123456-2023-10-13_in.png', NULL, '-7.278700222602697,112.76522533979279', NULL, 'JK01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'firja', 'firja@gmail.com', NULL, '$2y$10$O/OiXym6qN7zdfkGlClNYev8tSi6al7.mcgm2lDM2USS3jq4WNw7y', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `konfigurasi_jamkerja`
--
ALTER TABLE `konfigurasi_jamkerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_cuti`
--
ALTER TABLE `master_cuti`
  ADD PRIMARY KEY (`kode_cuti`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `nik` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `nik` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234567891;

--
-- AUTO_INCREMENT for table `konfigurasi_jamkerja`
--
ALTER TABLE `konfigurasi_jamkerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_cuti`
--
ALTER TABLE `master_cuti`
  MODIFY `kode_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
