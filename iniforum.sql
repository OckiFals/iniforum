-- phpMyAdmin SQL Dump
-- version 4.4.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2015 at 02:49 AM
-- Server version: 5.5.43-MariaDB
-- PHP Version: 5.5.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iniforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `bio` varchar(180) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `photo` varchar(140) NOT NULL DEFAULT 'members/1.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `name`, `email`, `bio`, `type`, `photo`, `created_at`) VALUES
(1, 'rangga', '21232f297a57a5a743894a0e4a801fc3', 'Rangga', NULL, 'Aku ini binatang jalang', 2, 'members/1.png', '2015-05-05 16:35:53'),
(2, 'cinta', '21232f297a57a5a743894a0e4a801fc3', 'Cinta', NULL, NULL, 2, 'members/2.png', '2015-05-06 20:25:43'),
(3, 'ockifals', '21232f297a57a5a743894a0e4a801fc3', 'Ocki Bagus Pratama', NULL, NULL, 1, 'members/3.png', '2015-05-08 18:39:37'),
(4, 'samiun', '21232f297a57a5a743894a0e4a801fc3', 'Joko Samiun', NULL, NULL, 2, 'members/1.png', '2015-05-09 05:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `badwords`
--

CREATE TABLE IF NOT EXISTS `badwords` (
  `id` int(11) NOT NULL,
  `word` varchar(120) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '2' COMMENT '1: sara, 2: kasar'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badwords`
--

INSERT INTO `badwords` (`id`, `word`, `type`) VALUES
(1, 'anjing', 2),
(2, 'bego', 2),
(3, 'goblog', 2),
(4, 'asu', 2),
(5, 'jancok', 2),
(6, 'jancuk', 2),
(7, 'jancuak', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `photo` varchar(120) DEFAULT 'categories/meteor.png',
  `created_by` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo`, `created_by`, `description`, `created_at`) VALUES
(1, 'Wayang', 'categories/meteor.png', 3, 'Description of the category', '2015-05-08 18:50:47'),
(2, 'no-category', 'categories/meteor.png', 3, 'Description of the category', '2015-05-08 18:52:38'),
(3, 'Picisan', 'categories/meteor.png', 1, 'Description of the category', '2015-05-08 18:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_account` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `id_account`, `text`, `created_at`) VALUES
(1, 2, 2, 'Cinta itu omong kosong', '2015-05-16 03:32:14'),
(2, 2, 1, 'Padahal Cinta itu adalah kamu', '2015-05-16 04:25:01'),
(7, 2, 2, 'Tapi itu bohong!', '2015-05-16 05:39:46'),
(10, 6, 1, 'Nice', '2015-06-04 16:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `from_account` int(11) NOT NULL,
  `to_account` int(11) NOT NULL,
  `subject` varchar(80) NOT NULL DEFAULT 'no-subject',
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_account`, `to_account`, `subject`, `text`, `created_at`) VALUES
(1, 1, 2, 'no-subject', 'Cinta?', '2015-05-20 04:17:47'),
(2, 2, 1, '', 'Hallo Rangga. Apa kabar?', '2015-05-22 10:02:09'),
(3, 1, 2, '', 'Besok saya akan ke Jakarta, selama 2 hari. Bisa ketemu?', '2015-05-22 10:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT 'judul',
  `post` text NOT NULL,
  `viewers` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_account`, `id_category`, `title`, `post`, `viewers`, `created_at`, `modified_at`) VALUES
(2, 1, 1, 'Cinta?', '<p>Cinta adalah<br />\r\nbahaya yang lekas<br />\r\nJadi pudar</p>\r\n\r\n<p>ma&#39;lum mina alprograming bi dharurah</p>\r\n', 231, '2015-05-07 03:15:53', '2015-06-05 14:40:51'),
(6, 2, 1, 'Aku', '<p><img alt="Aku(puisi)" src="/iniforum/assets/img/members/uploads/chairil_anwar_aku.jpg" style="height:359px; width:240px" /></p>\r\n\r\n<p>Kalau sampai waktu ku<br />\r\n`Ku mau tak seorang `kan merayu<br />\r\nTidak juga kau</p>\r\n\r\n<p>Tak perlu sedu sedan itu</p>\r\n<hr />\r\n<p>Aku ini binatang jalang<br />\r\nDari kumpulannya terbuang</p>\r\n\r\n<p>Biar peluru menembus kulitku<br />\r\nAku tetap meradang menerjang</p>\r\n\r\n<p>Luka dan bisa kubawa berlari<br />\r\nBerlari<br />\r\nHingga hilang pedih peri</p>\r\n\r\n<p>Dan aku akan lebih tidak perduli</p>\r\n\r\n<p>Aku mau hidup seribu tahun lagi</p>\r\n\r\n<p>(Maret 1943)</p>\r\n', 31, '2015-05-12 15:26:42', '2015-06-05 14:41:22'),
(10, 1, 1, 'Sinta', '<p>Sinta, Ooo Sinta</p>\r\n\r\n<p>Kepada jagad semesta</p>\r\n\r\n<p>Ingin ku lukiskan</p>\r\n\r\n<p>Betapa surgawinya dirimu</p>\r\n', 9, '2015-05-15 12:52:20', '2015-05-17 11:03:04'),
(11, 1, 3, 'PULANGLAH( Aku Hilang ) ', '<p><span style="line-height:1.6em">pulanglah,&nbsp;</span></p>\r\n\r\n<p>senja telah usai&nbsp;<br />\r\ndan malam telah sampai&nbsp;</p>\r\n\r\n<p>tak perlu ada derai,&nbsp;<br />\r\napalagi gerimis di matamu yang manis&nbsp;<br />\r\nsebab ini sudah jalan&nbsp;</p>\r\n\r\n<p>jangan berfikir kau salah,&nbsp;<br />\r\nsebab memang tak ada yang salah.&nbsp;<br />\r\nini hanya sebuah tragedi&nbsp;<br />\r\nkarena cinta telah lama mati&nbsp;</p>\r\n\r\n<p>tak perlu dikenang,&nbsp;<br />\r\nmeski waktu akan melahirkan kenangan.&nbsp;<br />\r\nbuang saja, seperti kau membuang&nbsp;<br />\r\nsampah.&nbsp;<br />\r\nsebab aku cuma sampah&nbsp;</p>\r\n\r\n<p>cepat pulang,&nbsp;<br />\r\njangan pernah ada bimbang.&nbsp;<br />\r\napalagi khawatir aku sakit,&nbsp;<br />\r\nitu tidak perlu.&nbsp;<br />\r\nsebab aku tau cinta memang seperti itu&nbsp;</p>\r\n\r\n<p>pulanglah,&nbsp;<br />\r\nseperti aku yang akan pulang kepada&nbsp;<br />\r\nsunyi.&nbsp;<br />\r\nsebab sejatinya aku terlahir dari&nbsp;<br />\r\nrahimnya&nbsp;</p>\r\n\r\n<p>tak usah ucap selamat tinggal,&nbsp;<br />\r\napalagi lambaian tangan.&nbsp;<br />\r\nayunkan saja kakimu,&nbsp;<br />\r\nterus melangkah, jangan menoleh&nbsp;<br />\r\nkebelakang.&nbsp;<br />\r\nkarena mungkin aku telah hilang.&nbsp;</p>\r\n', 8, '2015-05-16 16:28:39', '2015-05-22 14:44:59'),
(12, 1, 1, 'Aku Tanpamu', '<p>Aku tanpamu seperti langit tanpa kemukus,</p>\r\n\r\n<p>apalah arti malam tanpa bintang,</p>\r\n\r\n<p>apalah guna samudra tanpa camar untuk nelayan yang mengharap ikan,</p>\r\n\r\n<p>apalah arti bangkai tanpa nazar.</p>\r\n\r\n<p>Pagi ini hanya hawa dingin menyeruak raga. Tak ada satu celah pun yang luput dari petualangan nya itu. Dingin menembus sampai ke ruang-ruang kenangan yang kosong, kecuali satu tempat yang memang diharamkan baginya, hati.</p>\r\n\r\n<p>Hati ini tetap hangat, itu yang harus kau ketahui; kau lah sebab.</p>\r\n\r\n<p>Embun dingin terbawa angin dari Puncak gunung Batu yang bila dicermati seperti dilepas begitu saja kemudian mengarah lurus menimpaku.</p>\r\n\r\n<p>bukan dilindungi jaringan ikat tapi dipanasi rasa cintaku padamu juga rasa cemburu ketika melihat kau bersama yang lain.</p>\r\n\r\n<p>Perlahan dingin menghilang, sinar surya menyongsong datangnya harapan. Harapan akan hari yang lebih baik.</p>\r\n\r\n<p>Cukup, cukup sudah aku tersesat dalam labirin yang penuh dengan lika-liku kehampaan ini,</p>\r\n\r\n<p>Aku hanya tahu bahwa...</p>\r\n\r\n<p>Aku tanpamu seperti perahu tanpa cadik, bagaimana melewati badai?</p>\r\n', 4, '2015-05-16 16:40:57', '2015-06-05 17:07:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `badwords`
--
ALTER TABLE `badwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_account_2` (`id_account`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ACCOUNt_FROM` (`from_account`),
  ADD KEY `ACCOUNT_TO` (`to_account`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`,`id_account`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `badwords`
--
ALTER TABLE `badwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_POST` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_from` FOREIGN KEY (`from_account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_to` FOREIGN KEY (`to_account`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_ACCOUNT` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CATEGORY` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
