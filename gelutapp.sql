-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Jun 2021 pada 11.50
-- Versi server: 5.6.38
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gelutapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_master`
--

CREATE TABLE `group_master` (
  `group_id` int(11) NOT NULL,
  `group_unique_id` int(200) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `img` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `group_master`
--

INSERT INTO `group_master` (`group_id`, `group_unique_id`, `group_name`, `img`) VALUES
(1, 523681095, 'test', '1623577537_grp_1623535367_grp_IMG-20210611-WA0000.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_users`
--

CREATE TABLE `group_users` (
  `group_users_tbl_id` int(11) NOT NULL,
  `group_unique_id` int(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(200) NOT NULL,
  `user_lname` varchar(200) NOT NULL,
  `admin_role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `group_users`
--

INSERT INTO `group_users` (`group_users_tbl_id`, `group_unique_id`, `user_id`, `user_fname`, `user_lname`, `admin_role`) VALUES
(1, 523681095, 1076880883, 'gus', 'tom', 1),
(2, 523681095, 289603980, 'Bagus', 'Utomo', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_shared` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `time`, `file_shared`) VALUES
(1, 289603980, 1076880883, 'tes', '2021-06-13 16:48:08', 0),
(2, 1076880883, 289603980, 'yoi', '2021-06-13 16:48:37', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `gelutid` varchar(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `gelutid`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(1, 289603980, 'bagus', 'Bagus', 'Utomo', 'bagusutomo144@gmail.com', '$2y$10$IKscCNEQt/Ri8S6K6jPV6uulF6DiXLIzfVdxQTuOo3OXOj6Z7xkKG', '16235774131623497244avatar5.png', 'Active Now'),
(2, 1076880883, 'tomo', 'gus', 'tom', 'bagusutomo370@gmail.com', '$2y$10$3RVs/LCO9rz3L.3IiRiXXu9/zMpfNJArluzMpc90/gK9mJk0FHYEO', '16235775031623497017_grp_avatar.png', 'Active now');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `group_master`
--
ALTER TABLE `group_master`
  ADD PRIMARY KEY (`group_id`);

--
-- Indeks untuk tabel `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`group_users_tbl_id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `group_master`
--
ALTER TABLE `group_master`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `group_users`
--
ALTER TABLE `group_users`
  MODIFY `group_users_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
