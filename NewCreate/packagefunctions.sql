-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Eyl 2025, 09:48:45
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `packagefunctions`
--

--
-- Tablo için tablo yapısı `logger`
--

CREATE TABLE `logger` (
  `LogID` int(11) NOT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `TableName` varchar(55) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `MessageText` text DEFAULT NULL,
  `File` varchar(2555) DEFAULT NULL,
  `Line` int(11) DEFAULT NULL,
  `TraceText` text DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Statüs` int(11) NOT NULL,
  `UserName` varchar(55) NOT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `Surname` varchar(25) DEFAULT NULL,
  `Gender` varchar(25) DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `Tel` varchar(25) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `ForgotPassword` varchar(255) DEFAULT NULL,
  `PasswordUpdateDate` datetime DEFAULT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `HashValue` varchar(2555) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`UserID`, `Type`, `Statüs`, `UserName`, `Name`, `Surname`, `Gender`, `Mail`, `Tel`, `Password`, `ForgotPassword`, `PasswordUpdateDate`, `CreateDate`, `UpdateDate`, `HashValue`, `IsActive`) VALUES
(1, 1, 1, 'UserTest', 'User', 'Test', 'Erkek', 'deneme@gmail.com', '05111111111', '$2y$10$1dFsIphG9GgilidVbaix/uUnlkOF1VcZST5YuYWLExid6GTQh6MnG', NULL, '2025-09-05 13:13:28', '2025-08-22 12:42:32', '2025-09-05 17:07:02', NULL, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`LogID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `logger`
--
ALTER TABLE `logger`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
