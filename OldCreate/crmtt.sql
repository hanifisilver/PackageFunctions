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
-- Veritabanı: `crmtt`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `CompanyID` int(11) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `CompanyPerson` varchar(255) DEFAULT NULL,
  `CompanyPersonTel` varchar(25) DEFAULT NULL,
  `CompanyTaxNumber` varchar(25) DEFAULT NULL,
  `CompanyTaxOffice` varchar(55) DEFAULT NULL,
  `CompanyFax` varchar(25) DEFAULT NULL,
  `Address` varchar(2555) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hardware`
--

CREATE TABLE `hardware` (
  `ID` int(11) NOT NULL,
  `UstPlatform` tinyint(1) DEFAULT 0,
  `YonOkIsiklari` tinyint(1) DEFAULT 0,
  `YerdenEmis` tinyint(1) DEFAULT 0,
  `DogalDususArkaSulama` tinyint(1) DEFAULT 0,
  `OnYikamaUnitesi` tinyint(1) DEFAULT 0,
  `TozBastirma` tinyint(1) DEFAULT 0,
  `Toma` tinyint(1) DEFAULT 0,
  `5VanaliSuSebili` tinyint(1) DEFAULT 0,
  `Dalgakiran` tinyint(1) DEFAULT 0,
  `MenholKapak` tinyint(1) DEFAULT 0,
  `Merdiven` tinyint(1) DEFAULT 0,
  `Epoksi` tinyint(1) DEFAULT 0,
  `KaldirmaMapasi` tinyint(1) DEFAULT 0,
  `SeviyeGostergesi` tinyint(1) DEFAULT 0,
  `DonerLamba` tinyint(1) DEFAULT 0,
  `Projektor` tinyint(1) DEFAULT 0,
  `MalzemeDolabi` tinyint(1) DEFAULT 0,
  `BasincliBosaltma` tinyint(1) DEFAULT 0,
  `ArkaBosaltma` tinyint(1) DEFAULT 0,
  `AluminyumPompa` tinyint(1) DEFAULT 0,
  `HortumMakarasi` tinyint(1) DEFAULT 0,
  `TankSaci` tinyint(1) DEFAULT 0,
  `TankHavalandirma` tinyint(1) DEFAULT 0,
  `Bisikletlik` tinyint(1) DEFAULT 0,
  `Reflektor` tinyint(1) DEFAULT 0,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `invoicecounter`
--

CREATE TABLE `invoicecounter` (
  `CounterID` int(11) NOT NULL,
  `InvoiceNumber` varchar(25) NOT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `CompanyCode` varchar(10) DEFAULT NULL,
  `Year` varchar(5) DEFAULT NULL,
  `Month` varchar(5) DEFAULT NULL,
  `Counter` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

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
-- Tablo için tablo yapısı `mycompanyinformations`
--

CREATE TABLE `mycompanyinformations` (
  `MyCompanyID` int(11) NOT NULL,
  `MyCompanyName` varchar(255) DEFAULT NULL,
  `MyCompanyAddress` varchar(2555) DEFAULT NULL,
  `MyCompanyTaxNumber` varchar(25) DEFAULT NULL,
  `MyCompanyTaxOffice` varchar(55) DEFAULT NULL,
  `BankName` varchar(255) DEFAULT NULL,
  `IBAN` varchar(55) DEFAULT NULL,
  `MyCompanyTel` varchar(25) DEFAULT NULL,
  `MyCompanyWebSite` varchar(55) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mycompanyinformations`
--

INSERT INTO `mycompanyinformations` (`MyCompanyID`, `MyCompanyName`, `MyCompanyAddress`, `MyCompanyTaxNumber`, `MyCompanyTaxOffice`, `BankName`, `IBAN`, `MyCompanyTel`, `MyCompanyWebSite`, `CreateDate`, `UpdateDate`, `IsActive`) VALUES
(1, 'Demo Şirket İsmi A.Ş.', 'Demo Şirket Adres Bilgisi', '8360414575', 'Demo Vergi Dairesi', 'Demo Bankası / Demo Şubesi', 'TR00 0000 0000 0000 0000 0000 00', '0212 212 12 12', 'www.hanifimehmetgumus.com', '0000-00-00 00:00:00', '2025-09-05 17:06:59', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offerpersons`
--

CREATE TABLE `offerpersons` (
  `PersonID` int(11) NOT NULL,
  `PersonName` varchar(55) DEFAULT NULL,
  `PersonTel` varchar(25) DEFAULT NULL,
  `PersonTitle` varchar(55) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `offerpersons`
--

INSERT INTO `offerpersons` (`PersonID`, `PersonName`, `PersonTel`, `PersonTitle`, `CreateDate`, `UpdateDate`, `IsActive`) VALUES
(1, 'Kişi 1', '05111111111', 'Satış Sorumlusu', '2025-08-29 16:07:36', '2025-08-29 16:07:36', 1),
(2, 'Kişi 2', '05222222222', 'Genel Müdür', '2025-08-29 16:07:36', '2025-08-29 16:07:36', 1),
(3, 'Kişi 3', '05333333333', 'Satış Sorumlusu', '2025-08-29 16:07:36', '2025-09-05 10:53:59', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offers`
--

CREATE TABLE `offers` (
  `OfferID` int(11) NOT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `CounterID` int(11) DEFAULT NULL,
  `HardwareID` int(11) DEFAULT NULL,
  `OfferStatus` int(11) DEFAULT NULL,
  `OfferType` varchar(50) DEFAULT NULL,
  `OfferPerson` varchar(55) DEFAULT NULL,
  `OfferPersonTel` varchar(55) DEFAULT NULL,
  `OfferStainless` tinyint(1) DEFAULT NULL,
  `OfferLitter` varchar(55) DEFAULT NULL,
  `OfferSac` int(11) DEFAULT NULL,
  `OfferMenhol` int(11) DEFAULT NULL,
  `OfferHase` int(11) DEFAULT NULL,
  `OfferSubTotal` varchar(55) DEFAULT NULL,
  `OfferKDV` varchar(55) DEFAULT NULL,
  `OfferTotalPrice` varchar(55) DEFAULT NULL,
  `Note` varchar(2555) DEFAULT NULL,
  `OfferDeleveryTime` int(11) DEFAULT NULL,
  `OfferPayment` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `HashValue` varchar(2555) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proformainvoice`
--

CREATE TABLE `proformainvoice` (
  `ProformaID` int(11) NOT NULL,
  `OfferID` int(11) DEFAULT NULL,
  `ProformaCounterNumber` int(11) NOT NULL,
  `Currency` varchar(25) NOT NULL,
  `ProductDescription` varchar(2555) NOT NULL,
  `Count` int(11) NOT NULL,
  `UnitePrice` varchar(55) NOT NULL,
  `SubTotal` varchar(55) NOT NULL,
  `KDV` varchar(55) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `HashValue` varchar(2555) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
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
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`UserID`, `Statüs`, `UserName`, `Name`, `Surname`, `Gender`, `Mail`, `Tel`, `Password`, `ForgotPassword`, `PasswordUpdateDate`, `CreateDate`, `UpdateDate`, `IsActive`) VALUES
(1, 1, 'Deneme', 'Mehmet Hanifi', 'Gümüş', 'Erkek', 'deneme@gmail.com', '05333333333', '$2y$10$1dFsIphG9GgilidVbaix/uUnlkOF1VcZST5YuYWLExid6GTQh6MnG', NULL, '2025-09-05 13:13:28', '2025-08-22 12:42:32', '2025-09-05 17:07:02', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Tablo için indeksler `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `invoicecounter`
--
ALTER TABLE `invoicecounter`
  ADD PRIMARY KEY (`CounterID`);

--
-- Tablo için indeksler `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`LogID`);

--
-- Tablo için indeksler `offerpersons`
--
ALTER TABLE `offerpersons`
  ADD PRIMARY KEY (`PersonID`);

--
-- Tablo için indeksler `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`OfferID`);

--
-- Tablo için indeksler `proformainvoice`
--
ALTER TABLE `proformainvoice`
  ADD PRIMARY KEY (`ProformaID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Tablo için AUTO_INCREMENT değeri `hardware`
--
ALTER TABLE `hardware`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `invoicecounter`
--
ALTER TABLE `invoicecounter`
  MODIFY `CounterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Tablo için AUTO_INCREMENT değeri `logger`
--
ALTER TABLE `logger`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `offerpersons`
--
ALTER TABLE `offerpersons`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `offers`
--
ALTER TABLE `offers`
  MODIFY `OfferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Tablo için AUTO_INCREMENT değeri `proformainvoice`
--
ALTER TABLE `proformainvoice`
  MODIFY `ProformaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
