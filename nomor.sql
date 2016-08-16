-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 16. Agustus 2016 jam 22:51
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nomor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `idgroups` int(11) NOT NULL AUTO_INCREMENT,
  `namagroups` varchar(100) NOT NULL,
  PRIMARY KEY (`idgroups`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`idgroups`, `namagroups`) VALUES
(1, 'admin'),
(2, 'owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grupprovider`
--

CREATE TABLE IF NOT EXISTS `grupprovider` (
  `idgrupprovider` int(11) NOT NULL AUTO_INCREMENT,
  `namagrupprovider` varchar(50) NOT NULL,
  PRIMARY KEY (`idgrupprovider`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `grupprovider`
--

INSERT INTO `grupprovider` (`idgrupprovider`, `namagrupprovider`) VALUES
(1, 'indosat'),
(2, 'telkomsel'),
(3, 'esia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisoperator`
--

CREATE TABLE IF NOT EXISTS `jenisoperator` (
  `idjenisoperator` int(11) NOT NULL AUTO_INCREMENT,
  `namajenisoperator` varchar(50) NOT NULL,
  PRIMARY KEY (`idjenisoperator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `jenisoperator`
--

INSERT INTO `jenisoperator` (`idjenisoperator`, `namajenisoperator`) VALUES
(1, 'gsm'),
(2, 'cdma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int(11) NOT NULL AUTO_INCREMENT,
  `namakategori` varchar(50) NOT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'nomor cantik'),
(2, 'nomor berpasangan'),
(3, 'nomor tahun'),
(4, 'nomor biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idproduct` int(11) NOT NULL AUTO_INCREMENT,
  `nomorproduct` varchar(50) NOT NULL,
  `potongnomorproduct` varchar(40) NOT NULL,
  `hargaproduct` int(11) NOT NULL,
  `idprovider` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `statuspasangan` int(11) NOT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`idproduct`, `nomorproduct`, `potongnomorproduct`, `hargaproduct`, `idprovider`, `idkategori`, `statuspasangan`) VALUES
(1, '085733163557', '8573316355', 10000, 1, 4, 0),
(2, '085733333333', '8573333333', 1000000, 1, 1, 0),
(3, '08573535333', '857353533', 100000, 1, 2, 1),
(4, '08573535335', '857353533', 500000, 1, 2, 1),
(10, '08888888888', '888888888', 5000, 5, 1, 0),
(11, '0989089089809', '98908908980', 70000, 1, 1, 0),
(12, '0857555555', '85755555', 10000, 1, 1, 2),
(13, '0857555556', '85755555', 10000, 1, 1, 2),
(14, '08544444447', '854444444', 200000, 1, 1, 0),
(15, '0878786767678', '87878676767', 12099000, 8, 3, 0),
(16, '08756565656', '875656565', 110000, 8, 4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `idprovider` int(11) NOT NULL AUTO_INCREMENT,
  `namaprovider` varchar(50) NOT NULL,
  `logoprovider` text NOT NULL,
  `idgrupprovider` int(11) NOT NULL,
  `idjenisoperator` int(11) NOT NULL,
  PRIMARY KEY (`idprovider`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `provider`
--

INSERT INTO `provider` (`idprovider`, `namaprovider`, `logoprovider`, `idgrupprovider`, `idjenisoperator`) VALUES
(1, 'im3', 'file_18062016093736.png', 1, 1),
(2, 'axis', 'axis.png', 1, 1),
(3, 'simpati', 'simpati.png', 2, 1),
(4, 'kartu as', 'kartuas.png', 2, 1),
(5, 'flexi', 'flexi.png', 2, 2),
(6, 'three', '3.png', 1, 1),
(7, 'smartfren', 'smartfren.png', 2, 2),
(8, 'xl', 'xl.png', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namalengkap` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `createdon` varchar(100) NOT NULL,
  `idgroups` int(11) NOT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `namalengkap`, `alamat`, `nohp`, `email`, `createdon`, `idgroups`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'majid', 'bulaksari', '082882822', 'majdijdijd@gmail.com', '22222222', 1),
(2, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'saifudin', 'sememi', '242323232', 'safdfas@gmail.com', '33333333', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
