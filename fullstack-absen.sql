-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Waktu pembuatan: 20 Okt 2023 pada 16.05
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fullstack-absen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` bigint(20) UNSIGNED NOT NULL,
  `nim_mahasiswa_absen` bigint(20) NOT NULL,
  `id_log_absen` int(11) NOT NULL,
  `pertemuan_log_absen` int(11) NOT NULL,
  `keterangan_log_absen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `nim_mahasiswa_absen`, `id_log_absen`, `pertemuan_log_absen`, `keterangan_log_absen`) VALUES
(1, 12345, 1, 1, 1),
(2, 67890, 1, 1, 2),
(3, 9876, 1, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akademik`
--

CREATE TABLE `akademik` (
  `id_akademik` bigint(20) UNSIGNED NOT NULL,
  `tahun_akademik` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nama_semester_akademik` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `akademik`
--

INSERT INTO `akademik` (`id_akademik`, `tahun_akademik`, `nama_semester_akademik`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2023/2024', 'GANJIL', NULL, '2023-06-09 14:08:33', '2023-06-09 14:08:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identity_log_book`
--

CREATE TABLE `identity_log_book` (
  `id_identity` bigint(20) UNSIGNED NOT NULL,
  `id_kelas_identity` int(11) NOT NULL,
  `id_prodi_identity` text COLLATE utf8_unicode_ci NOT NULL,
  `jml_mhs` int(11) NOT NULL,
  `id_makul_identity` text COLLATE utf8_unicode_ci NOT NULL,
  `id_makul_group` int(11) NOT NULL,
  `id_dosen_identity` int(11) NOT NULL,
  `id_akademik_identity` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `identity_log_book`
--

INSERT INTO `identity_log_book` (`id_identity`, `id_kelas_identity`, `id_prodi_identity`, `jml_mhs`, `id_makul_identity`, `id_makul_group`, `id_dosen_identity`, `id_akademik_identity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 3, '11111', 11111, 29, 1, NULL, '2023-06-09 14:11:54', '2023-06-09 14:11:54'),
(2, 1, '0', 2, '22222', 22222, 29, 1, NULL, '2023-06-09 14:51:16', '2023-06-09 14:51:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identity_log_book_detail`
--

CREATE TABLE `identity_log_book_detail` (
  `id_identity_detail` bigint(20) UNSIGNED NOT NULL,
  `id_identity_logbook` int(11) NOT NULL,
  `id_mhs_identity` bigint(20) NOT NULL,
  `nama_mahasiswa` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `identity_log_book_detail`
--

INSERT INTO `identity_log_book_detail` (`id_identity_detail`, `id_identity_logbook`, `id_mhs_identity`, `nama_mahasiswa`) VALUES
(1, 1, 12345, '(12345) Aaaaa Aaaaa'),
(2, 1, 67890, '(67890) Bbbbb Bbbbbb'),
(3, 1, 9876, '(9876) Ccccc Ccccc'),
(4, 2, 12345, '(12345) Aaaaa Aaaaa'),
(5, 2, 54321, '(54321) Ddddd Ddddd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `kode_kelas` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Pagi', NULL, '2023-06-09 14:11:03', '2023-06-09 14:11:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `id_identity_log` int(11) NOT NULL,
  `pertemuan_log` int(11) NOT NULL DEFAULT 0,
  `hari_log` date NOT NULL,
  `waktu_mulai_log` time NOT NULL,
  `waktu_selesai_log` time NOT NULL,
  `id_ruang_log` int(11) NOT NULL,
  `materi_log` text COLLATE utf8_unicode_ci NOT NULL,
  `metode_pbm_log` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_mhs_hadir_log` int(11) NOT NULL DEFAULT 0,
  `qr_code_log` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_is_verif` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_identity_log`, `pertemuan_log`, `hari_log`, `waktu_mulai_log`, `waktu_selesai_log`, `id_ruang_log`, `materi_log`, `metode_pbm_log`, `jumlah_mhs_hadir_log`, `qr_code_log`, `log_is_verif`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-06-09', '21:12:00', '22:12:00', 12345, 'CRUD', 'Praktikum', 3, 'storage/assets/gallery/1686320263.svg', 1, NULL, '2023-06-09 14:17:43', '2023-06-09 14:17:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim_mahasiswa` bigint(20) UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `email_mahasiswa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_mahasiswa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim_mahasiswa`, `nama_mahasiswa`, `id_prodi`, `id_dosen`, `email_mahasiswa`, `password_mahasiswa`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9876, 'Ccccc Ccccc', 69, 29, 'ccc@gmail.com', 'd39ba36915557c1fe4d2078de5067d34', NULL, '2023-06-09 14:04:56', '2023-06-09 14:04:56'),
(12345, 'Aaaaa Aaaaa', 69, 29, 'aaa@gmail.com', '5787be38ee03a9ae5360f54d9026465f', NULL, '2023-06-09 14:04:06', '2023-06-09 14:04:06'),
(54321, 'Ddddd Ddddd', 96, 30, 'dddd@gmail.com', 'd438a02c00fd457ff310b8dd41599ab3', NULL, '2023-06-09 14:05:09', '2023-06-09 14:05:09'),
(67890, 'Bbbbb Bbbbbb', 96, 30, 'bbbbb@gmail.com', '5787be38ee03a9ae5360f54d9026465f', NULL, '2023-06-09 14:04:32', '2023-06-09 14:04:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mata_kuliah` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nama_mata_kuliah` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sks_mata_kuliah` tinyint(4) NOT NULL,
  `semester_mata_kuliah` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `id_mata_kuliah`, `id_prodi`, `nama_mata_kuliah`, `sks_mata_kuliah`, `semester_mata_kuliah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 11111, 69, 'Bahasa Pemrograman 1', 5, 1, NULL, '2023-06-09 14:09:59', '2023-06-09 14:09:59'),
(2, 22222, 69, 'Kalkulus', 4, 1, NULL, '2023-06-09 14:50:19', '2023-06-09 14:50:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_02_205538_create_prodi_table', 1),
(6, '2023_03_02_211628_create_mata_kuliah_table', 1),
(7, '2023_03_03_222759_create_ruang_table', 1),
(8, '2023_03_03_232901_create_akademik_table', 1),
(9, '2023_03_07_194649_create_identity_log_book_table', 1),
(10, '2023_03_07_200727_create_kelas_table', 1),
(11, '2023_03_09_212248_create_log_table', 1),
(12, '2023_03_16_211846_create_absen_table', 1),
(13, '2023_04_01_092409_create_mahasiswa_table', 1),
(14, '2023_05_19_170229_create_identity_log_book_detail_table', 1),
(15, '2023_06_09_213528_create_identity_log_book_prodi_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `id_prodi`, `nama_prodi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 69, 'Sistem Komputer', NULL, '2023-06-09 14:09:13', '2023-06-11 14:04:11'),
(2, 96, 'Sistem Informasi', NULL, '2023-06-11 14:17:15', '2023-06-11 14:17:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id`, `id_ruang`, `nama_ruang`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 12345, 'Ringgit', NULL, '2023-06-09 14:05:39', '2023-06-09 14:05:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_induk` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profesi` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
  `roles` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nomor_induk`, `name`, `username`, `email`, `email_verified_at`, `password`, `profesi`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(28, '', 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$vycTqKUduWJ4PZ5mFDvLDuv5j04oM/0WpJUNfiRjwtW7I8LFCLGG6', 'Staff', 1, 'gqgxh3kB7KUFpwkrDIQSl9Sk1SeYdurmd4M36zdJwrZKzdoB1PFOeShL3BNS', '2022-05-23 23:16:48', '2022-05-23 23:16:48'),
(29, '1234567890', 'Ernes Cahyo Nugroho, S.Si, M.Kom', 'ernes', 'ernes@gmail.com', NULL, '$2y$10$WuF4fl6q4xCqcyZMEgeSIOdT8s0ZbUFA6Ae8A3YaRj0kcjEOokpIW', 'Dosen', 0, NULL, '2023-06-09 14:03:13', '2023-06-09 14:03:13'),
(30, '123123123', 'Budi Sumboro, S.Si, M.Kom', 'budi', 'budi@gmail.com', NULL, '$2y$10$pRdYw.D1wrW0u5Ae4GxIceYgGgdraHZ.L7/E9cUyGB5Pxj8MeuNO6', 'Dosen', 0, NULL, '2023-06-11 14:16:49', '2023-06-11 14:16:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `akademik`
--
ALTER TABLE `akademik`
  ADD PRIMARY KEY (`id_akademik`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `identity_log_book`
--
ALTER TABLE `identity_log_book`
  ADD PRIMARY KEY (`id_identity`);

--
-- Indeks untuk tabel `identity_log_book_detail`
--
ALTER TABLE `identity_log_book_detail`
  ADD PRIMARY KEY (`id_identity_detail`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim_mahasiswa`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `akademik`
--
ALTER TABLE `akademik`
  MODIFY `id_akademik` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `identity_log_book`
--
ALTER TABLE `identity_log_book`
  MODIFY `id_identity` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `identity_log_book_detail`
--
ALTER TABLE `identity_log_book_detail`
  MODIFY `id_identity_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `nim_mahasiswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67891;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
