-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 10:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu`
--

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
-- Table structure for table `jawabans`
--

CREATE TABLE `jawabans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tugas_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_induk` varchar(255) NOT NULL,
  `file_jawab` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kompetensis`
--

CREATE TABLE `kompetensis` (
  `judul` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kompetensis`
--

INSERT INTO `kompetensis` (`judul`, `deskripsi`) VALUES
('Halaman Kompetensi', 'ini adalah deskripsi kompetensi');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(225) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', 'matematika', '2024-08-26 00:46:44', '2024-08-26 00:46:44'),
(2, 'Bahasa Indonesia', 'bahasa-indonesia', '2024-08-26 00:46:44', '2024-08-26 00:46:44'),
(3, 'Bahasa Inggris', 'bahasa-inggris', '2024-08-26 00:46:44', '2024-08-26 00:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `materis`
--

CREATE TABLE `materis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(225) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `matapelajaran_id` bigint(20) UNSIGNED NOT NULL,
  `konten` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materis`
--

INSERT INTO `materis` (`id`, `nama`, `slug`, `matapelajaran_id`, `konten`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Algebra Linear', 'algebra-linear', 1, '<p><span style=\"font-size: 14px;\">Aljabar linear adalah cabang matematika yang mempelajari vektor, ruang vektor (atau ruang linear), transformasi linear, dan sistem persamaan linear. Ini adalah dasar dari banyak cabang matematika dan ilmu terapan, termasuk fisika, ekonomi, statistik, dan ilmu komputer. Berikut adalah beberapa konsep kunci dalam aljabar linear:</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 1. **Vektor**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Vektor adalah objek matematis yang memiliki besar dan arah. Dalam konteks aljabar linear, vektor sering kali direpresentasikan sebagai daftar angka (koordinat) yang berhubungan dengan basis ruang vektor.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Operasi:** Penjumlahan vektor, pengurangan vektor, dan perkalian skalar dengan vektor.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 2. **Matriks**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Matriks adalah array persegi panjang yang terdiri dari angka-angka, yang diatur dalam baris dan kolom. Matriks digunakan untuk merepresentasikan sistem persamaan linear, transformasi linear, dan operasi lainnya dalam aljabar linear.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Operasi:** Penjumlahan matriks, pengurangan matriks, perkalian matriks, invers matriks, dan transpos matriks.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 3. **Sistem Persamaan Linear**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Sistem persamaan linear adalah sekumpulan persamaan linear yang melibatkan sejumlah variabel yang sama. Tujuannya adalah untuk menemukan nilai-nilai dari variabel-variabel tersebut yang membuat semua persamaan menjadi benar.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Metode Penyelesaian:** Eliminasi Gauss, eliminasi Gauss-Jordan, metode substitusi, dan metode Cramer.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 4. **Ruang Vektor**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Ruang vektor adalah kumpulan vektor yang dapat ditambahkan bersama-sama dan dikalikan dengan skalar, sambil memenuhi beberapa sifat tertentu (misalnya, komutatif, asosiatif).</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Basis dan Dimensi:** Basis dari ruang vektor adalah sekumpulan vektor yang linear independen dan yang span seluruh ruang. Dimensi dari ruang vektor adalah jumlah vektor dalam basisnya.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 5. **Transformasi Linear**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Transformasi linear adalah pemetaan antara dua ruang vektor yang mempertahankan operasi penjumlahan vektor dan perkalian skalar.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Representasi Matriks:** Setiap transformasi linear dapat direpresentasikan oleh sebuah matriks, dan operasi transformasi tersebut dapat dihitung dengan menggunakan perkalian matriks.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 6. **Determinan**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Determinan adalah skalar yang terkait dengan matriks persegi, yang memberikan informasi tentang sifat-sifat matriks, seperti apakah matriks memiliki invers atau tidak.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Kegunaan:** Determinan digunakan dalam berbagai aplikasi, termasuk dalam penyelesaian sistem persamaan linear, dan analisis transformasi linear.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">### 7. **Eigenvektor dan Eigenvalue**</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Definisi:** Eigenvektor dari sebuah matriks adalah vektor yang arah transformasinya tidak berubah oleh matriks tersebut, sedangkan eigenvalue adalah faktor skalar yang mengalikan eigenvektor tersebut dalam transformasi.</span></p><p><span style=\"font-size: 14px;\">&nbsp; &nbsp;- **Kegunaan:** Eigenvektor dan eigenvalue memiliki aplikasi dalam berbagai bidang, seperti dinamika sistem, statistik (analisis komponen utama), dan fisika kuantum.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">Jika ada konsep tertentu yang ingin dipelajari lebih dalam, atau jika kamu membutuhkan contoh soal dan penyelesaiannya, beri tahu saja!</span></p>', '8054-Article Text-29301-3-10-20221216.pdf', '2024-08-26 00:54:55', '2024-08-26 00:54:55');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_27_112011_create_mata_pelajarans_table', 1),
(6, '2022_09_27_112029_create_materis_table', 1),
(7, '2022_09_28_005119_create_soals_table', 1),
(8, '2022_09_28_060306_create_tugas_table', 1),
(9, '2022_09_28_062700_create_jawabans_table', 1),
(10, '2022_09_28_135953_create_penelitis_table', 1),
(11, '2022_12_14_024429_create_kompetensis_table', 1);

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
-- Table structure for table `penelitis`
--

CREATE TABLE `penelitis` (
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `dospem` varchar(255) NOT NULL,
  `ahli_materi` varchar(255) NOT NULL,
  `ahli_media` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penelitis`
--

INSERT INTO `penelitis` (`nim`, `nama`, `dospem`, `ahli_materi`, `ahli_media`, `created_at`, `updated_at`) VALUES
('17802241006', 'Desi Wulansari', 'Muslikhah Dwihartanti, S.I.P., M.Pd.', 'Nurnawati, S.Pd.', 'Dr. Sutirman, M.Pd', '2024-08-26 00:46:44', '2024-08-26 00:46:44');

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
-- Table structure for table `soals`
--

CREATE TABLE `soals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` longtext NOT NULL,
  `pilihan_a` varchar(255) NOT NULL,
  `pilihan_b` varchar(255) NOT NULL,
  `pilihan_c` varchar(255) NOT NULL,
  `pilihan_d` varchar(255) NOT NULL,
  `pilihan_e` varchar(255) NOT NULL,
  `kunci_jawaban` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soals`
--

INSERT INTO `soals` (`id`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `kunci_jawaban`, `created_at`, `updated_at`) VALUES
(1, 'Di bawah ini yang termasuk majas perbandingan?', 'Ironi', 'Repetisi', 'Sinisme', 'Metafora', 'Sarkasme', 'a', '2024-08-26 00:46:44', '2024-08-26 00:46:44'),
(2, 'Di bawah ini yang bukan termasuk majas perbandingan?', 'Alegori', 'Metafora', 'Litotes', 'Pleonasme', 'Hiperbola', 'd', '2024-08-26 00:46:44', '2024-08-26 00:46:44'),
(3, 'Sistem persamaan linear berkembang di Eropa bersamaan dengan dikenalkannya konsep koordinat dalam geometri, oleh René Descartes pada tahun?', '1633', '1634', '1635', '1636', '1637', 'e', '2024-08-26 00:46:44', '2024-08-26 00:46:44'),
(4, 'kata, frasa, atau imbuhan yang muncul bersamaan dengan noun atau noun phrase?', 'Noun', 'Determiner', 'Tense', 'Verb', 'Article', 'b', '2024-08-26 00:46:44', '2024-08-26 00:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matapelajaran_id` bigint(20) UNSIGNED NOT NULL,
  `konten` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `matapelajaran_id`, `konten`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Tentukan solusi dari sistem persamaan linear berikut menggunakan metode eliminasi Gauss:</p><p><span class=\"katex-display\"><span class=\"katex\"><span class=\"katex-mathml\"><math xmlns=\"http://www.w3.org/1998/Math/MathML\" display=\"block\"><semantics><mtable rowspacing=\"0.25em\" columnalign=\"right left\" columnspacing=\"0em\"><mtr><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mn>2</mn><mi>x</mi><mo>+</mo><mn>3</mn><mi>y</mi><mo>−</mo><mi>z</mi></mrow></mstyle></mtd><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mrow></mrow><mo>=</mo><mn>5</mn></mrow></mstyle></mtd></mtr><mtr><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mn>4</mn><mi>x</mi><mo>−</mo><mi>y</mi><mo>+</mo><mn>2</mn><mi>z</mi></mrow></mstyle></mtd><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mrow></mrow><mo>=</mo><mn>6</mn></mrow></mstyle></mtd></mtr><mtr><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mo>−</mo><mi>x</mi><mo>+</mo><mn>2</mn><mi>y</mi><mo>+</mo><mn>3</mn><mi>z</mi></mrow></mstyle></mtd><mtd><mstyle scriptlevel=\"0\" displaystyle=\"true\"><mrow><mrow></mrow><mo>=</mo><mo>−</mo><mn>1</mn></mrow></mstyle></mtd></mtr></mtable><annotation encoding=\"application/x-tex\">\\begin{aligned}\r\n2x + 3y - z &amp;= 5 \\\\\r\n4x - y + 2z &amp;= 6 \\\\\r\n-x + 2y + 3z &amp;= -1\r\n\\end{aligned}</annotation></semantics></math></span><span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"strut\"></span><span class=\"mord\"><span class=\"mtable\"><span class=\"col-align-r\"><span class=\"vlist-t vlist-t2\"><span class=\"vlist-r\"><span class=\"vlist\"><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\">2</span><span class=\"mord mathnormal\">x</span><span class=\"mspace\"></span><span class=\"mbin\">+</span><span class=\"mspace\"></span><span class=\"mord\">3</span><span class=\"mord mathnormal\">y</span><span class=\"mspace\"></span><span class=\"mbin\">−</span><span class=\"mspace\"></span><span class=\"mord mathnormal\">z</span></span><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\">4</span><span class=\"mord mathnormal\">x</span><span class=\"mspace\"></span><span class=\"mbin\">−</span><span class=\"mspace\"></span><span class=\"mord mathnormal\">y</span><span class=\"mspace\"></span><span class=\"mbin\">+</span><span class=\"mspace\"></span><span class=\"mord\">2</span><span class=\"mord mathnormal\">z</span></span><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\">−</span><span class=\"mord mathnormal\">x</span><span class=\"mspace\"></span><span class=\"mbin\">+</span><span class=\"mspace\"></span><span class=\"mord\">2</span><span class=\"mord mathnormal\">y</span><span class=\"mspace\"></span><span class=\"mbin\">+</span><span class=\"mspace\"></span><span class=\"mord\">3</span><span class=\"mord mathnormal\">z</span></span></span><span class=\"vlist-s\">​</span></span><span class=\"vlist-r\"><span class=\"vlist\"></span></span></span></span><span class=\"col-align-l\"><span class=\"vlist-t vlist-t2\"><span class=\"vlist-r\"><span class=\"vlist\"><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\"></span><span class=\"mspace\"></span><span class=\"mrel\">=</span><span class=\"mspace\"></span><span class=\"mord\">5</span></span><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\"></span><span class=\"mspace\"></span><span class=\"mrel\">=</span><span class=\"mspace\"></span><span class=\"mord\">6</span></span><span class=\"pstrut\"></span><span class=\"mord\"><span class=\"mord\"></span><span class=\"mspace\"></span><span class=\"mrel\">=</span><span class=\"mspace\"></span><span class=\"mord\">−</span><span class=\"mord\">1</span></span></span><span class=\"vlist-s\">​</span></span><span class=\"vlist-r\"><span class=\"vlist\"></span></span></span></span></span></span></span></span></span></span><br></p>', NULL, '2024-08-26 00:56:41', '2024-08-26 00:56:41');

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
  `level` varchar(255) NOT NULL DEFAULT 'mahasiswa',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Edu', 'admin@gmail.com', NULL, '$2y$10$eqmlYwg2Lr7g6hvQF3H/AO4V9y49oWXJYYkeELYiOEkkhVXGnnEJ.', 'admin', NULL, '2024-08-26 00:46:44', '2024-08-26 00:46:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jawabans`
--
ALTER TABLE `jawabans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materis`
--
ALTER TABLE `materis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `penelitis`
--
ALTER TABLE `penelitis`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawabans`
--
ALTER TABLE `jawabans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materis`
--
ALTER TABLE `materis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
