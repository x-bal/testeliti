-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2022 pada 04.04
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_testeliti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `nama_quiz` varchar(128) NOT NULL,
  `minute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `secret_key`
--

CREATE TABLE `secret_key` (
  `id_key` int(11) NOT NULL,
  `key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `no_soal` int(11) NOT NULL,
  `a` char(3) NOT NULL,
  `b` char(3) NOT NULL,
  `c` char(3) NOT NULL,
  `d` char(3) NOT NULL,
  `e` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal_selesai` int(11) NOT NULL,
  `skor` varchar(500) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `avatar`) VALUES
(1, 'Tyto Mulyono', 'tyto@tytomulyono.com', 'tyto', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'logo.png'),
(2, 'Admin', 'admin@email.com', 'admin', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'logo.png'),
(3, 'aaasss', 'admin@gmail.comzs', 'qq', '$2a$08$wB303OEwUTWzZudzfbxK0e7dbLXx0mb85sbbCGqtwGgtOSSQA2dHy', '81773735360811db0281a6.sql');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `secret_key`
--
ALTER TABLE `secret_key`
  ADD PRIMARY KEY (`id_key`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `secret_key`
--
ALTER TABLE `secret_key`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
