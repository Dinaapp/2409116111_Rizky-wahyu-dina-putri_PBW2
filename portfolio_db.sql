-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2026 at 03:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `issuer` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `title`, `issuer`, `image`) VALUES
(1, 'Sertifikat HCIA - DATACOM', 'HUAWEI', 'huawei.png'),
(2, 'Sertifikat Study Club Soft Skill', 'INFORSA', 'image.png'),
(3, 'Sertifikat Kegiatan APLIKASI 2025', 'INFORSA', 'Rizky Wahyu Dina Putri.jpg'),
(4, 'Sertifikat Kegiatan INSEVENT 2025', 'INFORSA', 'Sertif.png');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `role`, `company`, `year`, `description`, `photo`) VALUES
(1, 'Bindam Division Committee Member (Student Mentor Support)', 'INFORSA', '2025', 'Berperan dalam mendukung pengembangan dan pendampingan mahasiswa baru. Membantu koordinasi kegiatan pembinaan, komunikasi, serta memastikan program berjalan efektif dan terstruktur.', 'aplikasi.jpeg'),
(2, 'Member Of Bureau (INFORSA 2025/2026)', 'INFORSA', '2025', 'Berpartisipasi dalam perencanaan dan pelaksanaan program kerja organisasi. Terlibat dalam pengembangan program kewirausahaan, pengelolaan strategi pemasaran, serta hingga evaluasi hasil penjualan.', 'biro.jpeg'),
(3, 'INSEVENT 2025 Committee (Public Relations and Funding Division)', 'INFORSA', '2025', 'Bertanggung jawab dalam membangun komunikasi dengan pihak eksternal dan calon sponsor. Menyusun proposal kerja sama, mengelola hubungan mitra, serta mendukung publikasi dan keberlanjutan pendanaan kegiatan.', 'insevent.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `hero_subtitle` varchar(255) DEFAULT NULL,
  `who_i_am_title` varchar(100) DEFAULT NULL,
  `who_i_am_desc1` text,
  `who_i_am_desc2` text,
  `what_i_do_title` varchar(100) DEFAULT NULL,
  `what_i_do_desc1` text,
  `what_i_do_desc2` text,
  `photo` varchar(255) DEFAULT NULL,
  `badge` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `hero_subtitle`, `who_i_am_title`, `who_i_am_desc1`, `who_i_am_desc2`, `what_i_do_title`, `what_i_do_desc1`, `what_i_do_desc2`, `photo`, `badge`) VALUES
(1, 'Rizky Wahyu Dina Putri', 'Built from passion, shaped by courage, driven by purpose.', 'Cat Person & Lifelong Learner', 'Halo! Aku Dinap, seorang cat person yang percaya kalau hidup itu harus seimbang antara logika dan hati.', 'Aku suka hal-hal yang kreatif, detail, dan meaningful. Selain menghabiskan waktu dengan kucing-kucing lucu, aku juga senang belajar hal baru, eksplor ide, dan mengembangkan diri.', 'Learn, Build & Grow', 'Saat ini aku menempuh studi di bidang Sistem Informasi, di mana aku belajar menggabungkan teknologi dan bisnis untuk menciptakan solusi yang relevan dan bermanfaat.', 'Selalu belajar teknologi terbaru dan berkomitmen untuk menghasilkan karya terbaik di setiap proyek.', 'IMG_4269.jpg', 'Cat Dev');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `level` varchar(5) DEFAULT NULL,
  `category` enum('technical','soft') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `level`, `category`) VALUES
(1, 'Web Development', '80', 'technical'),
(2, 'Business Analysis', '85', 'technical'),
(3, 'UI/UX Design', '90', 'technical'),
(4, 'Communication', '85', 'soft'),
(5, 'TeamWork', '90', 'soft'),
(6, 'Problem Solving', '85', 'soft');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
