-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Mar 2022, 19:00:29
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `seobridge`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `analysis`
--

CREATE TABLE `analysis` (
  `analysis_id` int(11) NOT NULL,
  `analysis_url` text NOT NULL,
  `analysis_title` text NOT NULL,
  `analysis_h1` int(11) NOT NULL,
  `analysis_h2` int(11) NOT NULL,
  `analysis_h3` int(11) NOT NULL,
  `analysis_h4` int(11) NOT NULL,
  `analysis_h5` int(11) NOT NULL,
  `analysis_h6` int(11) NOT NULL,
  `analysis_canonical` text NOT NULL,
  `analysis_robots` text NOT NULL,
  `analysis_image` text NOT NULL,
  `analysis_imagealt` text NOT NULL,
  `analysis_lang` text NOT NULL,
  `analysis_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `backlink_monitor`
--

CREATE TABLE `backlink_monitor` (
  `backlink_id` int(11) NOT NULL,
  `backlink_url` text NOT NULL,
  `backlink_domain` text NOT NULL,
  `backlink_robots` text NOT NULL,
  `backlink_alive` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`analysis_id`);

--
-- Tablo için indeksler `backlink_monitor`
--
ALTER TABLE `backlink_monitor`
  ADD PRIMARY KEY (`backlink_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `analysis`
--
ALTER TABLE `analysis`
  MODIFY `analysis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `backlink_monitor`
--
ALTER TABLE `backlink_monitor`
  MODIFY `backlink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
