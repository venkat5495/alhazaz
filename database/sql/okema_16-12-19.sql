-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2019 at 11:44 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `okema`
--

-- --------------------------------------------------------

--
-- Table structure for table `advert_banners`
--

CREATE TABLE `advert_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ar_description` text COLLATE utf8mb4_unicode_ci,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` int(11) NOT NULL,
  `banner_category` int(11) NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deactive',
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advert_banners`
--

INSERT INTO `advert_banners` (`id`, `name`, `ar_name`, `description`, `ar_description`, `banner`, `product_category`, `banner_category`, `status`, `start_time`, `end_time`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Spring Collection', 'مجموعة الربيع', 'The  Spring Collection is back at half price', 'مجموعة الربيع عادت بنصف السعر', 'images/banner/banner_1573302718.jpg', 9, 1, 'active', '2019-07-17', '2019-07-30', 12, '2019-07-11 12:34:56', '2019-11-12 18:57:04'),
(2, 'Hello Summer', 'مرحبا بالصيف', 'The Hello Summer is back at half price', 'مرحبا الصيف هو العودة بنصف السعر', 'images/banner/banner_1573302760.jpg', 9, 1, 'active', '2019-07-15', '2019-07-30', 12, '2019-07-11 12:35:57', '2019-11-12 18:57:43'),
(3, 'Slider 3', 'شريط التمرير 3', NULL, NULL, 'images/banner/banner_1562823402.png', 4, 2, 'active', '2019-07-30', '2019-07-31', 12, '2019-07-11 12:36:42', '2019-07-11 12:38:55'),
(4, 'Slider 5', 'شريط التمرير 4', 'This is testing description', 'هذا هو اختبار الوصف', 'images/banner/banner_1562823618.png', 3, 3, 'active', '2019-07-16', '2019-07-30', 12, '2019-07-11 12:40:18', '2019-07-12 16:59:52'),
(5, 'Slider 4', 'شريط التمرير 5', NULL, NULL, 'images/banner/banner_1562823636.png', 6, 2, 'active', '2019-07-15', '2019-07-30', 12, '2019-07-11 12:40:36', '2019-07-11 12:42:29'),
(6, 'Slider 6', 'شريط التمرير 6', 'This is testing description', 'هذا هو اختبار الوصف', 'images/banner/banner_1562823683.png', 8, 3, 'active', '2019-07-24', '2019-08-05', 12, '2019-07-11 12:41:23', '2019-07-12 17:00:11'),
(7, 'Slider 7', 'شريط التمرير 7', NULL, NULL, 'images/banner/banner_1562823708.png', 2, 4, 'active', '2019-07-15', '2019-07-30', 12, '2019-07-11 12:41:48', '2019-07-11 12:41:48'),
(8, 'Banner 1', 'راية 1', NULL, NULL, 'images/banner/banner_1562841332.png', 2, 5, 'active', '2019-07-11', '2019-07-30', 12, '2019-07-11 17:35:32', '2019-07-11 17:35:32'),
(9, 'Banner 2', 'راية 1', NULL, NULL, 'images/banner/banner_1562841361.png', 6, 5, 'active', '2019-07-15', '2019-07-30', 12, '2019-07-11 17:36:01', '2019-07-11 17:36:01'),
(10, 'dffgdhd', NULL, 'dfdf', NULL, 'images/banner/banner_1567685622.jpg', 1, 1, 'deactive', '2019-09-25', '2019-10-24', 12, '2019-09-05 19:13:42', '2019-09-05 19:13:42'),
(16, 'Simplyfy Everything', 'تبسيط كل شيء', 'The Simplify Everything is back at half price', 'تبسيط كل شيء عاد بنصف السعر', 'images/banner/banner_1573302564.jpg', 9, 1, 'active', '2019-11-09', '2019-11-09', 12, '2019-11-09 19:29:24', '2019-11-12 18:58:41'),
(17, 'Shoping Banner', 'راية التسوق', 'Shoping Banner', 'راية التسوق', 'images/banner/banner_1573551382.png', 9, 8, 'active', '2019-11-12', '2019-11-12', 12, '2019-11-12 16:36:23', '2019-11-12 16:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo`, `url`, `published`, `created_at`, `updated_at`) VALUES
(7, 'uploads/banners/FgHeZTyrY9p1jpfoyjOOTCa7s4XLIm9LIsFfpLqA.jpeg', '#', 0, '2019-04-28 07:07:02', '2019-09-13 11:15:58'),
(8, 'uploads/banners/dqfjuQihAa5YeV6Mt0jpvuRTejsdm9yyMiRz0QmZ.jpeg', '#', 0, '2019-04-28 07:07:23', '2019-09-13 11:16:00'),
(9, 'uploads/banners/XsrzK5NAbKH640qKuhbUkDinmiDxRLcLeRioTSUw.jpeg', '#', 0, '2019-04-28 07:07:35', '2019-09-13 11:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `banner_categories`
--

CREATE TABLE `banner_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_categories`
--

INSERT INTO `banner_categories` (`id`, `name`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Main Slider Banner', 'active', 12, '2019-07-11 12:27:44', '2019-07-11 12:27:44'),
(2, 'Main Banner on Home', 'active', 12, '2019-07-11 12:28:00', '2019-07-11 12:28:06'),
(3, 'Special Selection for You', 'active', 12, '2019-07-11 12:28:47', '2019-07-11 12:28:47'),
(4, 'In The Spotlight', 'active', 12, '2019-07-11 12:28:58', '2019-07-11 12:28:58'),
(8, 'Shoping Banner', 'active', 12, '2019-11-12 16:33:47', '2019-11-12 16:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banner` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `orders` int(11) NOT NULL DEFAULT '0',
  `is_enable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `ar_name`, `logo`, `created_at`, `updated_at`, `banner`, `featured`, `orders`, `is_enable`) VALUES
(2, 'Lakme', 'اكمي', 'uploads/brands/B1myfxh21z9SDx7a2adioyJC6CR5wXpNNhBMl0Yr.png', '2019-03-12 06:06:13', '2019-09-30 21:38:07', NULL, 0, 2, 1),
(3, 'Maybelline Newyork', 'مايبيلين نيويورك', 'uploads/brands/oa13LZrElsW2O952c7EtSCLkyTH8YdVQLpolC0qR.png', '2019-04-28 18:38:32', '2019-11-25 12:47:26', NULL, 0, 1, 1),
(4, 'Nykaa Cosmatics', 'Nykaa مستحضرات التجميل', 'uploads/brands/Km4p8XHOmu0NKGzrsnqOw3voG7q2wiOZeVSIgFD5.png', '2019-04-28 18:39:15', '2019-09-23 17:04:19', NULL, 0, 3, 1),
(5, 'M.A.C', 'ماك', 'uploads/brands/vS4gwTbkAi9mIB7N2iBmamqZk0XpCWTdAm2v4d1L.png', '2019-04-28 18:40:09', '2019-09-23 17:04:22', NULL, 0, 6, 1),
(6, 'Clinique', 'كلينيك', 'uploads/brands/SGlCA0lbgEhPCmSQjw2hQoxBO3dZYJ3TxCq2lEpf.png', '2019-04-28 18:43:00', '2019-11-25 12:47:26', NULL, 0, 4, 1),
(7, 'Forest Essential', 'الغابات الأساسية', 'uploads/brands/VpCbPucNcalh6haqxPEJ370VE75HxaMfbxuu31Qt.png', '2019-04-28 18:43:38', '2019-09-23 17:04:33', NULL, 0, 0, 1),
(8, 'The Face Shop', 'واجهة المحل', 'uploads/brands/f5UcCbFDBA3DFBZHefAEg9M1q17kneImaqmS38Ag.png', '2019-04-28 18:44:06', '2019-09-23 17:04:38', NULL, 0, 0, 1),
(9, 'InnisFree', 'InnisFree', 'uploads/brands/7XUTOn2MG5icB1Oahe5rRK6r7VDlBx9E2aaKzMW9.png', '2019-04-28 18:44:35', '2019-09-23 17:04:42', NULL, 0, 0, 1),
(10, 'Bobbi Brown', 'بوبي براون', 'uploads/brands/IyLDUQU57a6ivx3MGhNvX4imIgvuJDDRZoNnu1m7.png', '2019-04-28 18:47:41', '2019-09-23 17:04:46', NULL, 0, 0, 1),
(11, 'Wella', 'يلا', 'uploads/brands/hNEsplOkNzGMPFxDIBvFejSb8EnaiodOzCSpD0Sf.png', '2019-04-28 18:48:04', '2019-09-23 18:19:20', NULL, 0, 0, 1),
(12, 'L\'oreal Paris', 'L \'أوريل باريس', 'uploads/brands/KxPRLaYwYelnPhQCArBwXLR9ZhWKh6s1ywgyXkci.png', '2019-04-28 18:48:51', '2019-04-28 18:48:51', NULL, 0, 0, 0),
(13, 'Biotique', 'Biotique', 'uploads/brands/QLuXS15auolyO2XAUVu0CsNkDEQpSwsiRFKu5Ln9.png', '2019-04-28 18:49:29', '2019-04-28 18:49:29', NULL, 0, 0, 0),
(14, 'Tresemme', 'Tresemme', 'uploads/brands/D1WX6uOHPFy4LZRYzsfp637NdfniuFi7r1tWNGjB.png', '2019-04-28 18:50:15', '2019-04-28 18:50:15', NULL, 0, 0, 0),
(15, 'L.A. Girls', 'ال اي قيرل', 'uploads/brands/ovFLPyWaF1Kv7FPGLJM701QVXKQrS4rcFfHG8mvD.png', '2019-04-28 18:51:29', '2019-09-23 19:02:04', NULL, 0, 0, 1),
(16, 'Face Canada', 'وجه كندا', 'uploads/brands/vY6Uk5fiy6eZmzehiAR5pBzNhJssrPlNeuiv1NKb.png', '2019-04-28 18:51:57', '2019-04-28 18:51:57', NULL, 0, 0, 0),
(17, 'Kaya', 'هكذا', 'uploads/brands/kq0PYWzilVMnEr9qpMko5IlpKxIpQBNpjXs7vZY8.png', '2019-04-28 18:53:13', '2019-04-28 18:53:13', NULL, 0, 0, 0),
(18, 'Himalaya', 'هيمالايا', 'uploads/brands/4XHiBlJ47tfv0OnnL6L1XwCr5QetZAmwuXC2jotF.png', '2019-04-28 18:53:52', '2019-04-28 18:53:52', NULL, 0, 0, 0),
(19, 'Ponds', 'البرك', 'uploads/brands/yk7c64u333m09hQdTiXBuqU7kObIgbbzMfO2F8TL.png', '2019-04-28 18:54:26', '2019-04-28 18:54:26', NULL, 0, 0, 0),
(20, 'Lotus', 'لوتس', 'uploads/brands/DaM8OHrwjtSn3YFDLRJhhnP2qkrECfl4Yr1NO11W.png', '2019-04-28 18:54:50', '2019-04-28 18:54:50', NULL, 0, 0, 0),
(21, 'WOW', 'رائع', 'uploads/brands/zVthYd3l7XdG7LkyPjHP4eZKQPxCGPA0uve8iToz.png', '2019-04-28 18:55:14', '2019-04-28 18:55:14', NULL, 0, 0, 0),
(22, 'The Balm', 'البلسم', 'uploads/brands/YM4E3YRPNxwhFsGoc1XBIBKznqLHZhgNQK2M1xnv.png', '2019-04-28 18:55:47', '2019-04-28 18:55:47', NULL, 0, 0, 0),
(23, 'Vaseline', 'فازلين', 'uploads/brands/0mJLWbCbpQMmtQC3YyHW5rGL5d4N0V3TuP2rtCIl.png', '2019-04-28 18:56:20', '2019-09-23 19:02:18', NULL, 0, 0, 1),
(24, 'Ogx', 'Ogx', 'uploads/brands/H5fs7AaVBfuYSYJAyTv6nHQOEX9fQ8GLLzbjCDvm.png', '2019-04-28 18:56:44', '2019-04-28 18:56:44', NULL, 0, 0, 0),
(25, 'Mama Earth', 'ماما الأرض', 'uploads/brands/pTS1TUmOcmMGya1GBD793Y1lcVM2eYkJ8XFTR9E8.png', '2019-04-28 18:57:13', '2019-04-28 18:57:13', NULL, 0, 0, 0),
(26, 'Bella Cotton', 'بيلا قطن', 'uploads/brands/C0c2ECBsVNgnTflQ17vrLXn27pHIUlf06cGljA5g.png', '2019-04-28 18:57:38', '2019-04-28 18:57:38', NULL, 0, 0, 0),
(27, 'Syska', 'Syska', 'uploads/brands/Q7Tk2AGxgjPPzlgG3JJCmwlSLLueUvjQMj73RWyJ.png', '2019-04-28 18:58:06', '2019-04-28 18:58:06', NULL, 0, 0, 0),
(29, 'Beuty Box', 'صندوق الجمال', 'uploads/brands/gttwx0eudz1cbOqITDq63jEDwiTYQoIJtRUgwQVp.png', '2019-05-19 17:31:58', '2019-05-19 17:31:58', 'uploads/brands/6WYtpr43yq2SOdcYlm7gWAyvZyrioOGmgfHlGc8M.jpeg', 1, 0, 0),
(31, 'Tresemme', 'Tresemme', 'uploads/brands/Bu8gwxnqh5VO4a9dOO6xZpLC6195FlgmFP7DtGlw.png', '2019-07-27 15:38:16', '2019-07-27 15:38:16', 'uploads/brands/fDJIcRX7cerUREwcS5Pu4XfPn8A2VOruucIfou6L.png', 1, 17, 0),
(32, 'Amazone', 'الأمازون', 'uploads/brands/LSthtnGcmnU3DFVqBsMFjHTVW5BCGMbqQSExwdfC.png', '2019-07-27 17:00:48', '2019-09-12 16:36:02', 'uploads/brands/svqgpZFtP50IE9gUoI0XBKhSbzXr8ydaWlRinZon.png', 1, 7, 0),
(36, 'براون', 'براون', 'uploads/brands/3VTXgkEfNkCBx9m3GheS1UsYJxCHjjjste0zcEVg.png', '2019-09-22 00:29:47', '2019-09-23 18:18:57', 'uploads/brands/7v8NPG9LksZfYC5IiJa7AfXO0J5Si0d2k3ToGmLT.png', 1, 1, 1),
(37, 'ال اي قيرل', 'ال اي قيرل', 'uploads/brands/Kz56sdp78tlKKSXLuVEzBWASh8z1EceoLKsAB5Xl.png', '2019-09-22 18:55:17', '2019-09-23 18:42:25', 'uploads/brands/beEsjO0yidvY8VE7B2rk8uUSoTkHspBYBpkSKaUP.png', 0, 1, 1),
(38, 'ريفلوشن', 'ريفلوشن', 'uploads/brands/ndVaFVHKZcVPqmQE2FjmAmD4BeATfw8Bh5gICJYr.png', '2019-09-23 17:57:24', '2019-11-20 12:15:04', 'uploads/brands/iwCnef2fzIHLFttNcQuuKMlsVGgBM6XGt8UdKVxV.png', 1, 3, 0),
(39, 'NYX', 'نيكس', 'uploads/brands/gDjZLz1A3VwX5sBKFnasN8It15l01wn8fXJfStrU.png', '2019-09-23 18:36:07', '2019-11-20 12:34:14', 'uploads/brands/JUM8cIwKL8byQ3CNhZHN28hKrKZHBsXehAIg426T.png', 0, 4, 1),
(40, 'Make-Up-For-Ever', 'ميك اب فور ايفر', 'uploads/brands/jmdrLls7EejBdVHz2zXRviRnJIwcOm0DSEkWWFMQ.png', '2019-09-23 18:54:02', '2019-09-23 18:54:10', 'uploads/brands/kGd3pnJnr3lyrjxCYi78QhDrkcu9ZVTCIFtwmYXj.jpeg', 0, 5, 1),
(41, 'Nars', 'نارس', 'uploads/brands/IEcZv2pVJFO20sqY1K6ktti7Re8aETbQuLJzp6gS.png', '2019-09-23 19:12:25', '2019-09-23 19:13:16', 'uploads/brands/wo0NPAfFKk5RQ2SKaUy7P7uNDFFxQLHXxWM6Sr4I.png', 0, 6, 1),
(42, 'Maybelline', 'ميبلين', 'uploads/brands/CxYdnacLGT9nvlq8uLOaGgJe03uxqZvEoiDhXwIS.png', '2019-09-23 19:17:56', '2019-11-20 12:20:43', 'uploads/brands/o0SGazLevv2phTVDhhM9mSyYbmQfMnM09YRbqN78.png', 0, 7, 1),
(43, 'Bourjois', 'برجوا', 'uploads/brands/2bKIfo84Pse15M0lUVhtpG328DvNcI2AsUZBmF42.png', '2019-09-23 20:10:35', '2019-09-23 20:10:55', 'uploads/brands/rRxbm5lxYjwERhROHSsPNLrgD2GHn0AmiMEP3iF7.png', 0, 8, 1),
(44, 'Topface', 'توب فيس', 'uploads/brands/MLYOJywnYKAa8HqS6YlBxQf6jLtGJuGdCpEU7BBS.png', '2019-09-23 20:27:48', '2019-09-23 20:28:51', 'uploads/brands/cEXjyqD167O0MO6tIcyeG1gcHicBb76HM8a28ijb.png', 0, 9, 1),
(45, 'ريفلون', 'ريفلون', 'uploads/brands/ISjSRw04BHdCHyUVzkCCbqhqB77N92lJ8TUAbz9o.png', '2019-09-23 20:34:01', '2019-09-23 20:37:59', 'uploads/brands/Ie2FRYChsqVXc4JCMWmh5V558ssA1uUbMkAAfRgg.png', 0, 10, 1),
(46, 'Max-Factor', 'ماكس فاكتور', 'uploads/brands/30rcjpxnkdELcqQiGBU1UUXSvHE0A9vUbfX4rohy.png', '2019-09-23 20:44:04', '2019-09-23 20:44:11', 'uploads/brands/GHdo7xyhHB5R3C8WRi3PdQIimOSpH8LKzDH1Hp7R.png', 0, 11, 1),
(47, 'Rimmel-London', 'ريميل لندن', 'uploads/brands/HJXPuAPNnViv9XcWwd56nNMEQjOQeBYC93TNBSaS.png', '2019-09-23 20:59:27', '2019-09-23 20:59:33', 'uploads/brands/Xy7maD3OTCOr6VwOq3oHqwJhk64utyV7aTWYjNif.png', 0, 12, 1),
(48, 'Okema', 'اوكيما', 'uploads/brands/DA6y5SJA1DlfezhfVhSYUPeIEO0dq37iDI54yQto.jpeg', '2019-09-24 20:35:19', '2019-09-24 20:35:34', 'uploads/brands/HudKmX9GNy1lEae5hFKQESKBOarTbiRsjKUelcCW.jpeg', 1, 1, 1),
(49, 'Anastasia', 'انستازيا', 'uploads/brands/FJHcIbCNWiqeCKhl7C8fRiSPpTzyQ2d3vLG8OqDP.png', '2019-09-30 21:39:25', '2019-09-30 21:43:29', 'uploads/brands/D5u2xsBIHtyX58R0ITwheDBr1lefOpY1gb5rYWPT.png', 1, 2, 1),
(50, 'Please', 'برجوا', 'uploads/brands/pl0uopphiwWKzm2UtYjcsLt2nOnvs1M9yGJndYIX.jpeg', '2019-09-30 22:07:50', '2019-09-30 22:07:59', 'uploads/brands/vdK22poMkeSGaJCpVEYdsBN1VoM4gtN7nrdprgIE.jpeg', 0, 2, 1),
(51, 'De from make up for ever', 'دي من ميك اب فور ايفر', 'uploads/brands/ge2GLBij31VejrKcl0cl8o9g8am9AdOk2h6fCDqh.png', '2019-09-30 22:25:29', '2019-09-30 22:25:38', 'uploads/brands/Epw9oOwWeertTP09lHdpOXFH0Vj9DcJgSfpe1EGX.png', 0, 1, 1),
(52, 'Estee Lauder', 'استي لودر', 'uploads/brands/Sp47p10uZgnoN0aWodKFxzgDmfKwRXHayL1fNeIi.jpeg', '2019-09-30 22:33:18', '2019-09-30 22:33:32', 'uploads/brands/CQjfOGvUz65wtrJAZ2UwS1sQUDgyS3AuN3MxdJLW.jpeg', 0, 2, 1),
(54, 'Benefit', 'بنفت', 'uploads/brands/Ahkv5a9DBXp4T77OQqtfdGObUQ3g1pB2H833181p.png', '2019-09-30 22:59:30', '2019-09-30 22:59:39', 'uploads/brands/BJY6GO371LVf5Ib6c6yHaBm8uL7IpInG3xdpJ2Bw.png', 0, 2, 1),
(55, 'Dermacol', 'ديرماكول', 'uploads/brands/PAUL09N6TzNxP3Sx10zKA5VtmJqaARdPObSqysv2.png', '2019-10-01 00:39:18', '2019-10-01 01:15:56', 'uploads/brands/p1yP1aLpDDKp5rceogKSlfoU1hgnuW7scdpKuOXa.png', 0, 2, 1),
(56, 'Missha', 'ميشا', 'uploads/brands/YIgEKXLiThGJiF3fgGbnHn827YpCyvGK6wqyIKN2.png', '2019-10-01 01:15:46', '2019-10-01 01:16:05', 'uploads/brands/wG34rxXmsDqLhLmo9cDZAMNtxAMvgALDtiroGP9i.png', 0, 2, 1),
(57, 'Huda Beauty', 'هدى بيوتي', 'uploads/brands/v60y9W16IXDGsAijl1wnkbMGXuZbZEt6TbgOE0HZ.png', '2019-10-01 01:23:48', '2019-10-01 01:35:19', 'uploads/brands/zXGudCwFpKW2iVJUY9Tx7XJQn6qswAMwllvWJNJ3.png', 0, 2, 1),
(58, 'Elv', 'ايلف', 'uploads/brands/NZQqSQVl8PN7NnC5EqiseItcf6VVhFVwzgAg0l6N.png', '2019-10-01 01:31:08', '2019-10-01 01:35:11', 'uploads/brands/jUTW6v62tGgSBNTMsMlOq4jMKhUO6PRz3YConNTm.png', 0, 1, 1),
(59, 'Dolce & Gabbana', 'دولتشي اند جابانا', 'uploads/brands/WCPjDQM5tcOXwvymkLC8W953py5XDPX7jrbOri6m.jpeg', '2019-10-01 01:39:48', '2019-10-01 09:03:07', 'uploads/brands/av22Ib8Xf60cZIvdP0jmpIGadWQ3nIUudwP5N5pD.jpeg', 0, 2, 1),
(60, 'Tofesed', 'توفيسد', 'uploads/brands/451JhrnvMsMEe6TPmoJn202idcsaszq5L9oxscDe.png', '2019-10-01 09:02:59', '2019-10-01 09:03:15', 'uploads/brands/XoL2NPlkfGobMRuL1aFGAJii4esTZInxYTmCWmyV.png', 0, 2, 1),
(61, 'DiorSkin', 'ديورسكين', 'uploads/brands/xkz8S8UAgOtNyaOgF1TdS0TZtTSyJy7i6iAoD2tT.png', '2019-10-01 09:14:38', '2019-10-01 09:40:08', 'uploads/brands/QbNdvm6MGnisMe55BN4mNnHhmo8TckwdmBx2sCmD.png', 0, 2, 1),
(62, 'Cat Vone D', 'كات ڤون دي', 'uploads/brands/aDxZfnB6hUvvauWRQ4iEW5AVVWBeuqqNakYGnlsD.png', '2019-10-01 09:39:58', '2019-10-01 09:40:17', 'uploads/brands/d49NRWvmY5zQe2ZruTgQiiug9GWr1NseGiuA3E7C.png', 0, 2, 1),
(63, 'Gucci', 'قوتشي', 'uploads/brands/sTcEvhxCCnJliFNezSy7Macux6tmiPWw574ca5Ki.jpeg', '2019-10-01 09:55:25', '2019-10-01 09:55:31', 'uploads/brands/QBK2ZMpTJJePf8P0GTdQ0Cmpuomcg8udiCXIODpj.jpeg', 0, 2, 1),
(64, 'L\'Oreal Paris', 'لوريال باريس', 'uploads/brands/2vxxCIt06E5nBF3m15SHlWvJjlz37DxDqz6NMjDp.png', '2019-10-01 10:08:19', '2019-10-01 10:08:27', 'uploads/brands/orlEcGiedMEeDRgfAXeIyRgLTZ2q6WXTvB7sk7V6.png', 0, 2, 1),
(65, 'Garnier', 'غارنييه', 'uploads/brands/0MWudJfpib3uciIqAI86w5TiTCGvJOWngexEPlYr.png', '2019-10-01 12:21:32', '2019-11-23 11:19:30', 'uploads/brands/pUEmXQ34xh4kzz87eCoZWEb16jeuoZry5zP6E7yf.png', 0, 2, 1),
(66, 'Amorus', 'Amorus', 'uploads/brands/9QrXGkK21pL9vBMFkeJ4OI0BEIrIC1b7H8A8rVUn.png', '2019-11-20 12:48:09', '2019-11-25 12:51:45', 'uploads/brands/OlTXNRgD6bpKk6t5ZyMuJ2px8K84kQnxfJqowIu3.png', 1, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'home_default_currency', '28', '2018-10-16 01:35:52', '2019-05-19 16:31:36'),
(2, 'system_default_currency', '28', '2018-10-16 01:36:58', '2019-05-19 16:31:43'),
(3, 'currency_format', '1', '2018-10-17 03:01:59', '2018-10-17 03:01:59'),
(4, 'symbol_format', '2', '2018-10-17 03:01:59', '2019-10-04 23:13:39'),
(5, 'no_of_decimals', '0', '2018-10-17 03:01:59', '2018-10-17 03:01:59'),
(6, 'product_activation', '1', '2018-10-28 01:38:37', '2019-02-04 01:11:41'),
(7, 'vendor_system_activation', '0', '2018-10-28 07:44:16', '2019-10-04 23:10:17'),
(8, 'show_vendors', '1', '2018-10-28 07:44:47', '2019-02-04 01:11:13'),
(9, 'paypal_payment', '0', '2018-10-28 07:45:16', '2019-09-09 17:32:36'),
(10, 'stripe_payment', '0', '2018-10-28 07:45:47', '2019-09-09 17:33:47'),
(11, 'cash_payment', '0', '2018-10-28 07:46:05', '2019-09-09 17:35:07'),
(12, 'payumoney_payment', '0', '2018-10-28 07:46:27', '2019-03-05 05:41:36'),
(13, 'best_selling', '1', '2018-12-24 08:13:44', '2019-09-13 11:20:32'),
(14, 'paypal_sandbox', '1', '2019-01-16 12:44:18', '2019-01-16 12:44:18'),
(15, 'sslcommerz_sandbox', '1', '2019-01-16 12:44:18', '2019-03-14 00:07:26'),
(16, 'sslcommerz_payment', '0', '2019-01-24 09:39:07', '2019-04-28 16:57:43'),
(17, 'vendor_commission', '20', '2019-01-31 06:18:04', '2019-04-13 06:49:26'),
(18, 'verification_form', '[{\"type\":\"text\",\"label\":\"Your name\"},{\"type\":\"text\",\"label\":\"Shop name\"},{\"type\":\"text\",\"label\":\"Email\"},{\"type\":\"text\",\"label\":\"License No\"},{\"type\":\"text\",\"label\":\"Full Address\"},{\"type\":\"text\",\"label\":\"Phone Number\"},{\"type\":\"file\",\"label\":\"Tax Papers\"}]', '2019-02-03 11:36:58', '2019-02-16 06:14:42'),
(19, 'google_analytics', '1', '2019-02-06 12:22:35', '2019-02-06 12:22:35'),
(20, 'facebook_login', '1', '2019-02-07 12:51:59', '2019-02-08 19:41:15'),
(21, 'google_login', '0', '2019-02-07 12:52:10', '2019-04-28 16:59:10'),
(22, 'twitter_login', '0', '2019-02-07 12:52:20', '2019-04-28 16:59:11'),
(23, 'payumoney_payment', '1', '2019-03-05 11:38:17', '2019-03-05 11:38:17'),
(24, 'payumoney_sandbox', '1', '2019-03-05 11:38:17', '2019-03-05 05:39:18'),
(36, 'facebook_chat', '0', '2019-04-15 11:45:04', '2019-04-15 11:45:04'),
(37, 'sms_setting', '{\"sender_name\":\"Okema\",\"username\":\"Okema\",\"password\":\"123456\"}', '2019-09-09 15:58:01', '2019-10-22 23:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured` int(1) NOT NULL DEFAULT '0',
  `orders` int(11) NOT NULL DEFAULT '0',
  `is_enable` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `ar_name`, `banner`, `icon`, `featured`, `orders`, `is_enable`, `created_at`, `updated_at`) VALUES
(9, 'Makeup', 'المكياج', 'uploads/categories/banner/xNhCYm3P7MoHQ2d4URjaGWfmR4z3IuAOTMq13dLq.jpeg', 'uploads/categories/icon/w2fiJTgLuJRgwjSru7yYVAGble5K92UBkNG26YiW.png', 1, 1, 1, '2019-11-22 12:32:15', '2019-11-22 19:32:15'),
(10, 'Perfume', 'العطور', 'uploads/categories/banner/3lz1tfstN9Qry5Y4bnIoLMcJMuwO5U06PnAWLXKx.jpeg', 'uploads/categories/icon/xXSBNFUUZFdEYSc3xhmIbxUooGy84TWtnDxSHnHY.png', 1, 2, 1, '2019-11-25 05:54:32', '2019-11-25 12:54:32'),
(11, 'Care', 'العناية', 'uploads/categories/banner/89SCwIxdyGWjxtkt3AqnvZgjyMp3ZcKZD1jIRBpq.jpeg', 'uploads/categories/icon/3DWI2atHulG60sQiF0GhfOMj1ByZhqyk7PHd2Vh9.png', 1, 3, 1, '2019-11-25 05:54:31', '2019-11-25 12:54:31'),
(12, 'Nails', 'الأظافر', 'uploads/categories/banner/5bnblGExcqrnNNp2efTpvaY6lS741mtoeH9Fgz2u.jpeg', 'uploads/categories/icon/b6CKBU4D6wwGoyx0iyH5pDExMyypg73xxAMo8hkJ.png', 1, 4, 1, '2019-11-25 05:54:40', '2019-11-25 12:54:40'),
(13, 'Lenses', 'عدسات', 'uploads/categories/banner/YjBkOT5NEhUxzqAz2tzjNjSvqClvyBiPsJwlW1C1.jpeg', 'uploads/categories/icon/iyPujsnjWwx6wxX8pwcOEEOuXv6odQWnjbnelhHM.png', 1, 5, 1, '2019-11-05 11:03:55', '2019-11-05 18:03:55'),
(14, 'Sun glasses', 'نظارات شمسية', 'uploads/categories/banner/0VXC8eleC9icGcJQyk7lBsPsBtTrPAh0MDBlCi4h.jpeg', NULL, 1, 6, 1, '2019-09-21 14:40:18', '2019-09-21 21:40:18'),
(15, 'Devices', 'الأجهزة', 'uploads/categories/banner/y8sYWZJs6cOnrGBwSps2Lm7uNsZxbtG4T9wMKhjJ.jpeg', 'uploads/categories/icon/KGphNGlRP6I2bG86mBjnklJjfP32NwhY3qKhVhBU.png', 1, 7, 1, '2019-11-05 11:05:43', '2019-11-05 18:05:43'),
(16, 'Electronics', 'الألكترونيات', 'uploads/categories/banner/oxKBa1fP62rEt3YSFeSiPk3BE9wLEQTTwBKgmmEp.jpeg', 'uploads/categories/icon/mHBOpEoFX4l14mavnY6NvGXvWJn1THV4MKkhEHro.png', 1, 8, 1, '2019-11-04 06:31:38', '2019-11-04 13:31:38'),
(17, 'Home Accessories', 'إكسسوارات المنزل', 'uploads/categories/banner/4njKzJfC21HG1hXkkXrBNKxkTFvSAe0wcJIWVDCX.jpeg', NULL, 1, 9, 1, '2019-11-20 06:09:03', '2019-11-20 13:09:03'),
(18, 'test', 'test', 'uploads/categories/banner/Z7WoSLncs9vEkADAu8WfqRDMgp1pBsDeUpl1tK3k.jpeg', 'uploads/categories/icon/tl6OkzEBgbtlx2Re8x9VBTHjZ09wjvnletISg8fe.jpeg', 1, 10, 0, '2019-11-25 05:56:18', '2019-11-25 12:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IndianRed', '#CD5C5C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(2, 'LightCoral', '#F08080', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(3, 'Salmon', '#FA8072', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(4, 'DarkSalmon', '#E9967A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(5, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(6, 'Crimson', '#DC143C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(7, 'Red', '#FF0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(8, 'FireBrick', '#B22222', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(9, 'DarkRed', '#8B0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(10, 'Pink', '#FFC0CB', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(11, 'LightPink', '#FFB6C1', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(12, 'HotPink', '#FF69B4', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(13, 'DeepPink', '#FF1493', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(14, 'MediumVioletRed', '#C71585', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(15, 'PaleVioletRed', '#DB7093', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(16, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(17, 'Coral', '#FF7F50', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(18, 'Tomato', '#FF6347', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(19, 'OrangeRed', '#FF4500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(20, 'DarkOrange', '#FF8C00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(21, 'Orange', '#FFA500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(22, 'Gold', '#FFD700', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(23, 'Yellow', '#FFFF00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(24, 'LightYellow', '#FFFFE0', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(25, 'LemonChiffon', '#FFFACD', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(26, 'LightGoldenrodYellow', '#FAFAD2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(27, 'PapayaWhip', '#FFEFD5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(28, 'Moccasin', '#FFE4B5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(29, 'PeachPuff', '#FFDAB9', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(30, 'PaleGoldenrod', '#EEE8AA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(31, 'Khaki', '#F0E68C', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(32, 'DarkKhaki', '#BDB76B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(33, 'Lavender', '#E6E6FA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(34, 'Thistle', '#D8BFD8', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(35, 'Plum', '#DDA0DD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(36, 'Violet', '#EE82EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(37, 'Orchid', '#DA70D6', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(38, 'Fuchsia', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(39, 'Magenta', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(40, 'MediumOrchid', '#BA55D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(41, 'MediumPurple', '#9370DB', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(42, 'Amethyst', '#9966CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(43, 'BlueViolet', '#8A2BE2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(44, 'DarkViolet', '#9400D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(45, 'DarkOrchid', '#9932CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(46, 'DarkMagenta', '#8B008B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(47, 'Purple', '#800080', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(48, 'Indigo', '#4B0082', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(49, 'SlateBlue', '#6A5ACD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(50, 'DarkSlateBlue', '#483D8B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(51, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(52, 'GreenYellow', '#ADFF2F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(53, 'Chartreuse', '#7FFF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(54, 'LawnGreen', '#7CFC00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(55, 'Lime', '#00FF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(56, 'LimeGreen', '#32CD32', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(57, 'PaleGreen', '#98FB98', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(58, 'LightGreen', '#90EE90', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(59, 'MediumSpringGreen', '#00FA9A', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(60, 'SpringGreen', '#00FF7F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(61, 'MediumSeaGreen', '#3CB371', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(62, 'SeaGreen', '#2E8B57', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(63, 'ForestGreen', '#228B22', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(64, 'Green', '#008000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(65, 'DarkGreen', '#006400', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(66, 'YellowGreen', '#9ACD32', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(67, 'OliveDrab', '#6B8E23', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(68, 'Olive', '#808000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(69, 'DarkOliveGreen', '#556B2F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(70, 'MediumAquamarine', '#66CDAA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(71, 'DarkSeaGreen', '#8FBC8F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(72, 'LightSeaGreen', '#20B2AA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(73, 'DarkCyan', '#008B8B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(74, 'Teal', '#008080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(75, 'Aqua', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(76, 'Cyan', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(77, 'LightCyan', '#E0FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(78, 'PaleTurquoise', '#AFEEEE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(79, 'Aquamarine', '#7FFFD4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(80, 'Turquoise', '#40E0D0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(81, 'MediumTurquoise', '#48D1CC', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(82, 'DarkTurquoise', '#00CED1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(83, 'CadetBlue', '#5F9EA0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(84, 'SteelBlue', '#4682B4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(85, 'LightSteelBlue', '#B0C4DE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(86, 'PowderBlue', '#B0E0E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(87, 'LightBlue', '#ADD8E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(88, 'SkyBlue', '#87CEEB', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(89, 'LightSkyBlue', '#87CEFA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(90, 'DeepSkyBlue', '#00BFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(91, 'DodgerBlue', '#1E90FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(92, 'CornflowerBlue', '#6495ED', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(93, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(94, 'RoyalBlue', '#4169E1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(95, 'Blue', '#0000FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(96, 'MediumBlue', '#0000CD', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(97, 'DarkBlue', '#00008B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(98, 'Navy', '#000080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(99, 'MidnightBlue', '#191970', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(100, 'Cornsilk', '#FFF8DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(101, 'BlanchedAlmond', '#FFEBCD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(102, 'Bisque', '#FFE4C4', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(103, 'NavajoWhite', '#FFDEAD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(104, 'Wheat', '#F5DEB3', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(105, 'BurlyWood', '#DEB887', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(106, 'Tan', '#D2B48C', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(107, 'RosyBrown', '#BC8F8F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(108, 'SandyBrown', '#F4A460', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(109, 'Goldenrod', '#DAA520', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(110, 'DarkGoldenrod', '#B8860B', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(111, 'Peru', '#CD853F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(112, 'Chocolate', '#D2691E', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(113, 'SaddleBrown', '#8B4513', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(114, 'Sienna', '#A0522D', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(115, 'Brown', '#A52A2A', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(116, 'Maroon', '#800000', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(117, 'White', '#FFFFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(118, 'Snow', '#FFFAFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(119, 'Honeydew', '#F0FFF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(120, 'MintCream', '#F5FFFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(121, 'Azure', '#F0FFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(122, 'AliceBlue', '#F0F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(123, 'GhostWhite', '#F8F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(124, 'WhiteSmoke', '#F5F5F5', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(125, 'Seashell', '#FFF5EE', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(126, 'Beige', '#F5F5DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(127, 'OldLace', '#FDF5E6', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(128, 'FloralWhite', '#FFFAF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(129, 'Ivory', '#FFFFF0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(130, 'AntiqueWhite', '#FAEBD7', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(131, 'Linen', '#FAF0E6', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(132, 'LavenderBlush', '#FFF0F5', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(133, 'MistyRose', '#FFE4E1', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(134, 'Gainsboro', '#DCDCDC', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(135, 'LightGrey', '#D3D3D3', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(136, 'Silver', '#C0C0C0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(137, 'DarkGray', '#A9A9A9', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(138, 'Gray', '#808080', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(139, 'DimGray', '#696969', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(140, 'LightSlateGray', '#778899', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(141, 'SlateGray', '#708090', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(142, 'DarkSlateGray', '#2F4F4F', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(143, 'Black', '#000000', '2018-11-05 02:12:30', '2018-11-05 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe'),
(247, 'AF', 'Afghanistan'),
(248, 'AL', 'Albania'),
(249, 'DZ', 'Algeria'),
(250, 'DS', 'American Samoa'),
(251, 'AD', 'Andorra'),
(252, 'AO', 'Angola'),
(253, 'AI', 'Anguilla'),
(254, 'AQ', 'Antarctica'),
(255, 'AG', 'Antigua and Barbuda'),
(256, 'AR', 'Argentina'),
(257, 'AM', 'Armenia'),
(258, 'AW', 'Aruba'),
(259, 'AU', 'Australia'),
(260, 'AT', 'Austria'),
(261, 'AZ', 'Azerbaijan'),
(262, 'BS', 'Bahamas'),
(263, 'BH', 'Bahrain'),
(264, 'BD', 'Bangladesh'),
(265, 'BB', 'Barbados'),
(266, 'BY', 'Belarus'),
(267, 'BE', 'Belgium'),
(268, 'BZ', 'Belize'),
(269, 'BJ', 'Benin'),
(270, 'BM', 'Bermuda'),
(271, 'BT', 'Bhutan'),
(272, 'BO', 'Bolivia'),
(273, 'BA', 'Bosnia and Herzegovina'),
(274, 'BW', 'Botswana'),
(275, 'BV', 'Bouvet Island'),
(276, 'BR', 'Brazil'),
(277, 'IO', 'British Indian Ocean Territory'),
(278, 'BN', 'Brunei Darussalam'),
(279, 'BG', 'Bulgaria'),
(280, 'BF', 'Burkina Faso'),
(281, 'BI', 'Burundi'),
(282, 'KH', 'Cambodia'),
(283, 'CM', 'Cameroon'),
(284, 'CA', 'Canada'),
(285, 'CV', 'Cape Verde'),
(286, 'KY', 'Cayman Islands'),
(287, 'CF', 'Central African Republic'),
(288, 'TD', 'Chad'),
(289, 'CL', 'Chile'),
(290, 'CN', 'China'),
(291, 'CX', 'Christmas Island'),
(292, 'CC', 'Cocos (Keeling) Islands'),
(293, 'CO', 'Colombia'),
(294, 'KM', 'Comoros'),
(295, 'CG', 'Congo'),
(296, 'CK', 'Cook Islands');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_spend` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `coupon_qty` int(11) NOT NULL,
  `used_qty` int(11) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `min_spend`, `discount`, `coupon_qty`, `used_qty`, `start_time`, `end_time`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'DEEP', 200.00, 50.00, 0, 0, '2019-11-25', '2019-11-30', 12, '2019-11-25 14:14:16', '2019-11-25 14:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double(10,5) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `exchange_rate`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, 'U.S. Dollar', '$', 1.00000, 0, 'USD', '2018-10-09 11:35:08', '2019-09-23 15:43:01'),
(2, 'Australian Dollar', '$', 1.28000, 0, 'AUD', '2018-10-09 11:35:08', '2019-04-29 03:03:55'),
(5, 'Brazilian Real', 'R$', 3.25000, 0, 'BRL', '2018-10-09 11:35:08', '2019-04-29 03:05:32'),
(6, 'Canadian Dollar', '$', 1.27000, 0, 'CAD', '2018-10-09 11:35:08', '2019-04-29 03:05:34'),
(7, 'Czech Koruna', 'Kč', 20.65000, 0, 'CZK', '2018-10-09 11:35:08', '2019-04-29 03:05:51'),
(8, 'Danish Krone', 'kr', 6.05000, 0, 'DKK', '2018-10-09 11:35:08', '2019-04-29 03:05:49'),
(9, 'Euro', '€', 0.85000, 0, 'EUR', '2018-10-09 11:35:08', '2019-04-29 03:05:46'),
(10, 'Hong Kong Dollar', '$', 7.83000, 0, 'HKD', '2018-10-09 11:35:08', '2019-04-29 03:05:44'),
(11, 'Hungarian Forint', 'Ft', 255.24000, 0, 'HUF', '2018-10-09 11:35:08', '2019-04-29 03:05:39'),
(12, 'Israeli New Sheqel', '₪', 3.48000, 0, 'ILS', '2018-10-09 11:35:08', '2019-04-29 03:07:35'),
(13, 'Japanese Yen', '¥', 107.12000, 0, 'JPY', '2018-10-09 11:35:08', '2019-04-29 03:06:09'),
(14, 'Malaysian Ringgit', 'RM', 3.91000, 0, 'MYR', '2018-10-09 11:35:08', '2019-04-29 03:06:13'),
(15, 'Mexican Peso', '$', 18.72000, 0, 'MXN', '2018-10-09 11:35:08', '2019-04-29 03:06:17'),
(16, 'Norwegian Krone', 'kr', 7.83000, 0, 'NOK', '2018-10-09 11:35:08', '2019-04-29 03:06:21'),
(17, 'New Zealand Dollar', '$', 1.38000, 0, 'NZD', '2018-10-09 11:35:08', '2019-04-29 03:06:25'),
(18, 'Philippine Peso', '₱', 52.26000, 0, 'PHP', '2018-10-09 11:35:08', '2019-04-29 03:06:29'),
(19, 'Polish Zloty', 'zł', 3.39000, 0, 'PLN', '2018-10-09 11:35:08', '2019-04-29 03:06:33'),
(20, 'Pound Sterling', '£', 0.72000, 0, 'GBP', '2018-10-09 11:35:08', '2019-04-29 03:06:37'),
(21, 'Russian Ruble', 'руб', 55.93000, 0, 'RUB', '2018-10-09 11:35:08', '2019-04-29 03:06:40'),
(22, 'Singapore Dollar', '$', 1.32000, 0, 'SGD', '2018-10-09 11:35:08', '2019-04-29 03:06:45'),
(23, 'Swedish Krona', 'kr', 8.19000, 0, 'SEK', '2018-10-09 11:35:08', '2019-04-29 03:06:55'),
(24, 'Swiss Franc', 'CHF', 0.94000, 0, 'CHF', '2018-10-09 11:35:08', '2019-04-29 03:06:59'),
(26, 'Thai Baht', '฿', 31.39000, 0, 'THB', '2018-10-09 11:35:08', '2019-04-29 03:07:02'),
(27, 'Taka', '৳', 84.00000, 0, 'BDT', '2018-10-09 11:35:08', '2019-04-29 03:29:06'),
(28, 'Saudi riyal', 'SR', 22.38000, 1, 'SR', '2018-10-09 11:35:08', '2019-04-29 03:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 13, '2019-10-31 13:36:57', '2019-10-31 13:36:57'),
(2, 14, '2019-10-31 13:39:49', '2019-10-31 13:39:49'),
(3, 15, '2019-10-31 13:54:23', '2019-10-31 13:54:23'),
(4, 16, '2019-10-31 13:57:52', '2019-10-31 13:57:52'),
(5, 17, '2019-10-31 15:52:59', '2019-10-31 15:52:59'),
(6, 18, '2019-10-31 16:56:21', '2019-10-31 16:56:21'),
(7, 19, '2019-11-01 12:06:22', '2019-11-01 12:06:22'),
(8, 20, '2019-11-01 13:11:21', '2019-11-01 13:11:21'),
(9, 21, '2019-11-01 13:21:09', '2019-11-01 13:21:09'),
(10, 22, '2019-11-02 12:48:00', '2019-11-02 12:48:00'),
(11, 23, '2019-11-04 12:37:10', '2019-11-04 12:37:10'),
(12, 24, '2019-11-04 12:57:23', '2019-11-04 12:57:23'),
(13, 25, '2019-11-04 16:36:51', '2019-11-04 16:36:51'),
(14, 26, '2019-11-04 16:41:41', '2019-11-04 16:41:41'),
(15, 27, '2019-11-04 17:21:40', '2019-11-04 17:21:40'),
(16, 28, '2019-11-04 18:37:51', '2019-11-04 18:37:51'),
(17, 29, '2019-11-04 19:05:22', '2019-11-04 19:05:22'),
(18, 30, '2019-11-04 19:06:46', '2019-11-04 19:06:46'),
(19, 31, '2019-11-05 12:16:12', '2019-11-05 12:16:12'),
(20, 32, '2019-11-05 13:44:21', '2019-11-05 13:44:21'),
(21, 33, '2019-11-05 15:24:01', '2019-11-05 15:24:01'),
(22, 34, '2019-11-05 15:26:07', '2019-11-05 15:26:07'),
(23, 35, '2019-11-05 19:11:52', '2019-11-05 19:11:52'),
(24, 36, '2019-11-06 12:57:11', '2019-11-06 12:57:11'),
(25, 37, '2019-11-06 12:58:35', '2019-11-06 12:58:35'),
(26, 38, '2019-11-06 17:17:14', '2019-11-06 17:17:14'),
(27, 39, '2019-11-06 18:47:08', '2019-11-06 18:47:08'),
(28, 40, '2019-11-06 19:35:59', '2019-11-06 19:35:59'),
(29, 41, '2019-11-07 17:58:43', '2019-11-07 17:58:43'),
(30, 42, '2019-11-08 22:13:01', '2019-11-08 22:13:01'),
(31, 43, '2019-11-08 22:16:53', '2019-11-08 22:16:53'),
(32, 44, '2019-11-08 22:17:12', '2019-11-08 22:17:12'),
(33, 45, '2019-11-08 22:26:06', '2019-11-08 22:26:06'),
(34, 46, '2019-11-09 13:32:37', '2019-11-09 13:32:37'),
(35, 47, '2019-11-09 18:00:21', '2019-11-09 18:00:21'),
(36, 48, '2019-11-09 19:40:41', '2019-11-09 19:40:41'),
(37, 49, '2019-11-11 16:51:51', '2019-11-11 16:51:51'),
(38, 50, '2019-11-12 11:17:18', '2019-11-12 11:17:18'),
(39, 51, '2019-11-12 11:18:41', '2019-11-12 11:18:41'),
(40, 52, '2019-11-12 11:21:39', '2019-11-12 11:21:39'),
(41, 53, '2019-11-12 11:59:26', '2019-11-12 11:59:26'),
(42, 54, '2019-11-16 11:25:07', '2019-11-16 11:25:07'),
(43, 55, '2019-11-18 16:07:01', '2019-11-18 16:07:01'),
(44, 56, '2019-11-22 13:41:04', '2019-11-22 13:41:04'),
(45, 57, '2019-11-22 17:13:59', '2019-11-22 17:13:59'),
(46, 58, '2019-11-22 17:21:30', '2019-11-22 17:21:30'),
(47, 59, '2019-11-22 17:46:41', '2019-11-22 17:46:41'),
(48, 60, '2019-11-22 17:51:10', '2019-11-22 17:51:10'),
(49, 61, '2019-11-22 18:16:41', '2019-11-22 18:16:41'),
(50, 62, '2019-11-22 18:17:50', '2019-11-22 18:17:50'),
(51, 63, '2019-11-22 18:18:54', '2019-11-22 18:18:54'),
(52, 64, '2019-11-25 13:21:41', '2019-11-25 13:21:41'),
(53, 65, '2019-11-27 11:27:15', '2019-11-27 11:27:15'),
(54, 66, '2019-11-27 14:18:45', '2019-11-27 14:18:45'),
(55, 67, '2019-11-27 14:21:37', '2019-11-27 14:21:37'),
(56, 68, '2019-11-27 16:19:56', '2019-11-27 16:19:56'),
(57, 69, '2019-11-27 16:28:53', '2019-11-27 16:28:53'),
(58, 70, '2019-11-27 16:28:53', '2019-11-27 16:28:53'),
(59, 71, '2019-11-27 16:34:40', '2019-11-27 16:34:40'),
(60, 72, '2019-11-27 18:15:11', '2019-11-27 18:15:11'),
(61, 73, '2019-11-27 18:46:57', '2019-11-27 18:46:57'),
(62, 74, '2019-11-27 18:48:04', '2019-11-27 18:48:04'),
(63, 75, '2019-11-27 18:50:19', '2019-11-27 18:50:19'),
(64, 76, '2019-11-27 18:52:06', '2019-11-27 18:52:06'),
(65, 77, '2019-11-28 12:05:01', '2019-11-28 12:05:01'),
(66, 78, '2019-11-28 15:53:55', '2019-11-28 15:53:55'),
(67, 79, '2019-11-28 15:53:55', '2019-11-28 15:53:55'),
(68, 80, '2019-12-06 18:58:37', '2019-12-06 18:58:37'),
(69, 81, '2019-12-08 13:29:14', '2019-12-08 13:29:14'),
(70, 82, '2019-12-09 12:05:43', '2019-12-09 12:05:43'),
(71, 83, '2019-12-09 12:11:21', '2019-12-09 12:11:21'),
(72, 84, '2019-12-09 12:17:26', '2019-12-09 12:17:26'),
(73, 85, '2019-12-09 17:20:58', '2019-12-09 17:20:58'),
(74, 86, '2019-12-09 17:49:52', '2019-12-09 17:49:52'),
(75, 87, '2019-12-10 16:36:38', '2019-12-10 16:36:38'),
(76, 88, '2019-12-13 17:21:46', '2019-12-13 17:21:46'),
(77, 89, '2019-12-13 17:55:55', '2019-12-13 17:55:55'),
(78, 90, '2019-12-13 19:18:21', '2019-12-13 19:18:21'),
(79, 91, '2019-12-16 11:47:04', '2019-12-16 11:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `firebase_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser_info` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `user_id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 19, 'gyhhh', NULL, NULL, 'gghh', '2019-11-05 12:10:33', '2019-11-05 12:10:33'),
(2, 19, 'gyhhh', NULL, NULL, 'gghh', '2019-11-05 12:10:34', '2019-11-05 12:10:34'),
(3, 26, 'hello', NULL, NULL, 'Asdsvdssds', '2019-11-05 19:35:36', '2019-11-05 19:35:36'),
(4, 52, 'rvr', NULL, NULL, 'Grg', '2019-11-12 12:27:39', '2019-11-12 12:27:39'),
(5, 1, 'JimmieTriva', 'yourmail@gmail.com', '89822683276', 'Zfdgrgr grgrgr grhgrhr', '2019-12-05 17:43:29', '2019-12-05 17:43:29'),
(6, 1, 'Wafaa', 'w-1400@hotmail.com', '0542444577', 'الموقع لا يعمل \r\nما تفتح ولا صفحة للمنتجات غير المعروضة بالصفحة الرئيسية فقط', '2019-12-08 13:39:26', '2019-12-08 13:39:26'),
(7, 1, 'Ernestocruse', 'inbox293@glmux.com', '81276614441', 'We offer all essay creating products sites record as well as their service fees | The biggest foundation of people assessments.\r\n \r\nhttps://abookreport0.blogspot.com/2019/07/fences-play-by-august-wilson-essay.html\r\nhttps://paperwritingservicereviews12.blogspot.com/2019/11/developing-website-essays.html\r\nhttps://professionalessaywritingservice.blogspot.com/2018/01/cialis-can-ensure-charm-of-spontaneous.html\r\nhttps://creativebookreportideas1.blogspot.com/2019/08/water-level-determination-measurement.html\r\nhttps://writeinrainpaper1.blogspot.com/2019/09/report-essay-example-topics-and-well.html\r\nhttps://customwritingtips2.blogspot.com/2019/05/public-outcry-and-acceptance-to-darwins.html\r\nhttps://helpwritingessay1.blogspot.com/2019/05/connection-of-figurative-language-in.html\r\nhttps://helpwritingessay1.blogspot.com/2019/08/the-actual-cause-of-hundred-years-war.html\r\nhttps://tipsforwritingaspeech.blogspot.com/2019/05/leading-and-managing-change.html\r\nhttps://helptowritearesearchpaper.blogspot.com/2019/06/book-report-on-aaafathers-and-sonsaaa.html\r\nhttps://bestcornellnotes.blogspot.com/2019/08/checkpoint-patient-self-determination.html\r\nhttps://1essayserviceonline.blogspot.com/2019/05/childhood-mortality-in-nineteenth.html\r\nhttps://customtermpaperreview1s.blogspot.com/2019/07/introduction-to-jungle-warfare-history.html\r\nhttps://rainforestwritingpaper1.blogspot.com/2019/10/fire-control-project-overview-essay.html\r\nhttps://exampleofawellwrittenessay123.blogspot.com/2019/05/world-war-z-movie-vs-novel.html\r\nhttps://bestcustomessaywriting1.blogspot.com/2019/05/the-act-of-manipulation-is-to-control.html\r\nhttps://domyhomeworkforme1.blogspot.com/2019/09/beowulfgrendel-trial-or-debate-activity.html\r\nhttps://bestresearchpaperwritingservice.blogspot.com/2017/12/itas-okay-to-slip-up.html\r\nhttps://canyouwriteanessayforme.blogspot.com/2019/05/enterprise-strategy-essay.html\r\nhttps://howtomakeabookreport1.blogspot.com/2019/07/civil-war-and-abolition-of-slavery.html\r\nhttps://dissertationwritingservicesreviews2.blogspot.com/2017/02/the-top-four-proven-seo-tips-for-your.html\r\nhttps://analysisessayhelp1.blogspot.com/2019/08/niels-bohr.html\r\nhttps://englisheditingservice1.blogspot.com/2019/07/the-impact-of-substance-abuse-in-work.html\r\nhttps://editingandwritingservices1.blogspot.com/2019/04/effect-of-luxury-cars-on-uk-market.html\r\nhttps://researchpapertopics1.blogspot.com/2019/05/emerson-defines-beauty-in-poet-essay.html\r\nhttps://collegeessaystructure.blogspot.com/2019/11/angina-pectoris-essays-rtt-aging.html\r\nhttps://helpwithpaperwriting.blogspot.com/2019/08/corporate-governance-in-islamic-banks.html\r\nhttps://purchaseessay12.blogspot.com/2019/06/service-learning-project-paper-essay.html\r\nhttps://mlastyleessaysample.blogspot.com/2019/11/proofs-for-godaaas-existence-essay.html\r\nhttps://customwritingtips2.blogspot.com/2019/07/what-are-limits-of-social-identity.html\r\nhttps://graduateschooladmissionessay10.blogspot.com/2019/09/examining-crime-and-gender-crimes.html\r\nhttps://writingservicescompany0.blogspot.com/2019/09/beginner-essay-example-for-free.html\r\nhttps://customwritingservicereview.blogspot.com/2019/11/joan-of-england-queen-of-sicily.html\r\nhttps://topicofatermpaper.blogspot.com/2019/08/william-faulkner-as-i-lay-dying-study.html\r\nhttps://essaywritingexamples12.blogspot.com/2019/07/translation-and-its-role-in.html\r\nhttps://analysisessayhelp1.blogspot.com/2019/10/bill-gates-and-steve-jobs-essay-example.html\r\nhttps://handwritingpaper12.blogspot.com/2019/09/folk-traditions-of-trinidad-and-tobago.html\r\nhttps://uclaapplicationessayprompts.blogspot.com/2019/06/create-new-animal-assignment-example.html\r\nhttps://howtowriteapaperpresentation12.blogspot.com/2019/08/tibetan-culture-and-art-essays-research.html\r\nhttps://essayproblog.blogspot.com/2019/10/information-management-case-study_18.html\r\nhttps://writingservicesonline-us.blogspot.com/2018/07/foster-care.html\r\nhttps://topbestessaywritingservicesuniversity.blogspot.com/2017/05/kalsarp-yog-and-vedic-astrology.html\r\nhttps://essaywritingcompany1.blogspot.com/2019/03/ethos-outline-essay.html\r\nhttps://reportwritingassignment12.blogspot.com/2019/11/integrating-four-skills-in-clt-context.html\r\nhttps://essayswriting1.blogspot.com/2019/10/determining-concentration-of-sulphuric.html\r\nhttps://academicpaperwriters12.blogspot.com/2019/06/opinion-on-us-correctional-facility.html\r\nhttps://dissertationhelpservices1.blogspot.com/2019/09/symbolism-in-chapter-17-of-chopinaaas.html\r\nhttps://allessayinenglish1.blogspot.com/2019/09/collaboration-of-nurses-on-prevention.html\r\nhttps://phdproposalservice0.blogspot.com/2019/10/political-science-politics-in-quebec.html\r\nhttps://collegereportsonline.blogspot.com/2019/02/bloodlines-chapter-twenty-two.html\r\nhttps://goodessayconclusions.blogspot.com/2019/08/essay.html\r\nhttps://spiderwritingpaper1.blogspot.com/2019/09/recovery-of-platinum-group-metals-pgms.html\r\nhttps://reflectiveessayhelp123.blogspot.com/2019/08/palaeolithic-type-diet-and-metabolic.html\r\nhttps://dissertationproofreading1.blogspot.com/2019/05/analyzing-supply-of-demand-simulation.html\r\nhttps://papercheap1.blogspot.com/2019/02/research-ethics-stanford-prison.html\r\nhttps://top5ubestessaywritingservices.blogspot.com/2019/07/charge-of-light-brigade-essay-example.html\r\nhttps://applicationessayexamples1.blogspot.com/2019/05/single-mom-and-going-back-to-school.html\r\nhttps://professionalessaywritingservice.blogspot.com/2019/10/business-memo-essay-example-topics-and.html\r\nhttps://admissionessaywritingservices2.blogspot.com/2019/09/hasbro-inc.html\r\nhttps://assignmenthelpservice1.blogspot.com/2019/05/qualitative-research-method-assignment.html\r\nhttps://bookreviewexamples1.blogspot.com/2019/04/project-manament-article-example-topics.html\r\nhttps://1engineeringessaywritingservice.blogspot.com/2019/04/three-river-source-ecological.html\r\nhttps://casestudythesisstatement2.blogspot.com/2019/10/citizens-have-to-guaranteed-minimum.html\r\nhttps://researcharticlecritique.blogspot.com/2019/06/health-care-reform-in-united-states.html\r\nhttps://writingonpaper123.blogspot.com/2019/09/what-role-has-human-rights-act-1998-had.html\r\nhttps://differencebookreportandabookreview.blogspot.com/2019/06/reprocessing-nuclear-fuel-essay-example.html\r\nhttps://dissertationeditors1.blogspot.com/2019/09/marriages-in-frankenstein-jane-eyre.html\r\nhttps://researchpapertopics1.blogspot.com/2019/06/supply-chain-management-essay-example.html\r\nhttps://helpmewriteanessay123.blogspot.com/2019/09/formation-of-national-bank-essay.html\r\nhttps://researchproposaltemplate12.blogspot.com/2019/07/aaaa-good-man-is-hard-to-findaaa-by.html\r\nhttps://essayhelp0.blogspot.com/2019/04/analysis-of-telecommunications-industry.html\r\nhttps://followtheguidelines.blogspot.com/2019/04/the-spirit-of-1968-politicised-everyday.html\r\nhttps://victorianwritingpaper1.blogspot.com/2019/07/strategies-and-definitions-of-3d.html\r\nhttps://writetermpaper1.blogspot.com/2019/10/physics-of-neurons-essay-physics-neuron.html\r\nhttps://stepsinwritingatermpaper1.blogspot.com/2019/08/facilities-planning-essay-example-for.html\r\nhttps://helpwithcustomtermpaper12.blogspot.com/2019/09/essay.html\r\nhttps://nursingapplicationessay12.blogspot.com/2019/07/strengths-and-weaknesses-of-situational.html\r\nhttps://journalpaperwriting1.blogspot.com/2019/09/the-mozart-effect-essay-essays-research.html\r\nhttps://mlaannotatedbibliographyexample0.blogspot.com/2019/11/teamwork-and-leadership-essay-example.html\r\nhttps://writingintroductiontoresearchpaper.blogspot.com/2019/09/development-and-diversity-essay-example.html\r\nhttps://cutewritingpaper.blogspot.com/2019/06/investigation-of-my-personality.html\r\nhttps://proofreadessaysonline.blogspot.com/2019/04/cambridge-university-press-essay.html\r\nhttps://exampleessay1.blogspot.com/2019/07/astronautics-space-essay-example-topics.html\r\nhttps://writingessaysfordummies12.blogspot.com/2019/06/the-short-run-and-of-macro-economy.html\r\nhttps://bestcustom123.blogspot.com/2019/08/mcdonalds-as-good-corporate-citizens.html\r\nhttps://superherowritingpaper1.blogspot.com/2019/09/overview-of-telecommunications-sector.html\r\nhttps://paperhelptestimonials.blogspot.com/2019/05/economics-and-book-online-essay.html\r\nhttps://buyaessayforcheap.blogspot.com/2019/07/power-of-suppliers-essay.html\r\nhttps://howtowritepersuasiveessays.blogspot.com/2019/10/the-vulnerability-of-man-essay-example.html\r\nhttps://howtowriteasciencefairresearchpaper.blogspot.com/2019/09/genetically-modified-food-and-crops.html\r\nhttps://coldwaressay-us.blogspot.com/2019/10/the-obligation-to-obey-law-normative.html\r\nhttps://professionaleditingservice0.blogspot.com/2019/05/history-of-21st-february.html\r\nhttps://helpmewritemythesis.blogspot.com/2019/07/solving-eating-difficulty-in-children.html\r\nhttps://admissionessaywriters12.blogspot.com/2019/06/critically-evaluate-how-international.html\r\nhttps://helpwithaessay.blogspot.com/2019/04/study-of-sound-in-citizen-kane-film.html\r\nhttps://topcustomwritingservices123.blogspot.com/2019/06/fire-resistant-properties-of-building.html\r\nhttps://writemythesisproposal0.blogspot.com/2019/08/global-executive-attributes-essay.html\r\nhttps://songwritingpaper.blogspot.com/2019/07/persuasion.html\r\nhttps://termpaperwritingservice123.blogspot.com/2019/07/quebrals-reflections-on-development.html\r\nhttps://applicationessayexamples1.blogspot.com/2019/05/the-holy-grail-essay-example-topics-and.html', '2019-12-14 23:44:28', '2019-12-14 23:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_products`
--

CREATE TABLE `favourite_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('follow','unfollow') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'follow',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourite_products`
--

INSERT INTO `favourite_products` (`id`, `product_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(15, 4, 16, 'follow', '2019-11-01 11:44:25', '2019-11-01 11:44:25'),
(2, 151, 16, 'follow', '2019-11-01 11:43:52', '2019-11-01 11:43:52'),
(18, 15, 28, 'follow', '2019-11-04 19:03:16', '2019-11-04 19:03:16'),
(19, 2, 30, 'follow', '2019-11-05 10:59:21', '2019-11-05 10:59:21'),
(20, 20, 30, 'follow', '2019-11-05 12:06:55', '2019-11-05 12:06:55'),
(430, 22, 19, 'follow', '2019-11-06 16:02:06', '2019-11-06 16:02:06'),
(425, 2, 19, 'follow', '2019-11-06 16:01:38', '2019-11-06 16:01:38'),
(428, 20, 19, 'follow', '2019-11-06 16:02:03', '2019-11-06 16:02:03'),
(443, 15, 40, 'follow', '2019-11-07 16:47:24', '2019-11-07 16:47:24'),
(413, 15, 19, 'follow', '2019-11-06 15:33:12', '2019-11-06 15:33:12'),
(422, 3, 34, 'follow', '2019-11-06 15:54:04', '2019-11-06 15:54:04'),
(450, 5, 41, 'follow', '2019-11-08 12:18:59', '2019-11-08 12:18:59'),
(298, 5, 13, 'follow', '2019-11-06 11:45:12', '2019-11-06 11:45:12'),
(441, 2, 40, 'follow', '2019-11-07 16:46:09', '2019-11-07 16:46:09'),
(432, 22, 37, 'follow', '2019-11-06 16:04:16', '2019-11-06 16:04:16'),
(424, 22, 34, 'follow', '2019-11-06 15:54:09', '2019-11-06 15:54:09'),
(156, 5, 35, 'follow', '2019-11-05 19:13:42', '2019-11-05 19:13:42'),
(426, 19, 19, 'follow', '2019-11-06 16:01:38', '2019-11-06 16:01:38'),
(429, 21, 19, 'follow', '2019-11-06 16:02:05', '2019-11-06 16:02:05'),
(448, 3, 40, 'follow', '2019-11-07 16:57:47', '2019-11-07 16:57:47'),
(481, 4, 45, 'follow', '2019-11-08 22:31:31', '2019-11-08 22:31:31'),
(423, 21, 34, 'follow', '2019-11-06 15:54:08', '2019-11-06 15:54:08'),
(439, 5, 19, 'follow', '2019-11-06 16:49:41', '2019-11-06 16:49:41'),
(447, 6, 40, 'follow', '2019-11-07 16:57:40', '2019-11-07 16:57:40'),
(548, 6, 65, 'follow', '2019-11-28 14:20:08', '2019-11-28 14:20:08'),
(551, 2, 65, 'follow', '2019-11-28 14:27:04', '2019-11-28 14:27:04'),
(557, 7, 88, 'follow', '2019-12-13 17:34:29', '2019-12-13 17:34:29'),
(547, 23, 65, 'follow', '2019-11-28 14:15:35', '2019-11-28 14:15:35'),
(544, 6, 67, 'follow', '2019-11-28 13:21:37', '2019-11-28 13:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `feature_brands`
--

CREATE TABLE `feature_brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `orders` int(11) NOT NULL DEFAULT '0',
  `is_enable` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_brands`
--

INSERT INTO `feature_brands` (`id`, `title`, `image`, `description`, `brand_id`, `orders`, `is_enable`, `created_at`, `updated_at`) VALUES
(2, 'Lake Me Kajal', 'uploads/feature_brand/jv71IkNCdZeMS5o9CgtYncIXAD6AvgLGgsrzpKY6.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 1, 1, '2019-04-30 00:10:15', '2019-07-27 16:13:51'),
(3, 'Maybelline Newyork EyeLiner', 'uploads/feature_brand/ebL2ZhbWA7UYqy1rHNeYuaxci5qAH3e7uC9VskJI.jpeg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 1, '2019-04-30 00:10:35', '2019-07-27 16:12:44'),
(4, 'تجربة علامة تجارية ماركة', 'uploads/feature_brand/CuGMB0FjHcRoVqAaeSPvL9mUStwfmMWIgCLWRhzn.jpeg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4, 3, 1, '2019-04-30 00:11:00', '2019-07-27 16:11:52'),
(6, 'Amorus Angled Definer Professional Makeup Brush', 'uploads/feature_brand/MKnWDuNyVBi2Bcweg9DAoZTNZV18m8JJQlcvEC4W.jpeg', 'The Amorus Professional Makeup Brushes are perfect for flawless makeup application. Best for professional makeup artists and any anyone who wants the finest quality makeup brushes for precision makeup.', 66, 6, 1, '2019-11-20 12:53:57', '2019-11-22 18:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `flash_deals`
--

CREATE TABLE `flash_deals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` int(20) DEFAULT NULL,
  `end_date` int(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flash_deals`
--

INSERT INTO `flash_deals` (`id`, `title`, `ar_name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Eiff', NULL, 1563494400, 1564444800, 0, '2019-03-13 23:59:03', '2019-11-06 17:59:59'),
(4, 'Test Deal', 'asasaass', 1575072000, 1575072000, 0, '2019-07-19 16:57:25', '2019-11-06 17:52:43'),
(5, 'Test', NULL, 1565222400, 1565827200, 0, '2019-08-05 15:30:27', '2019-08-05 15:30:27'),
(6, 'Test Flash Deal', 'Flat 20% Off', 1565740800, 1567209600, 1, '2019-08-05 16:11:20', '2019-08-22 11:08:32'),
(7, '50% OFF', NULL, 1565654400, 1565827200, 0, '2019-08-05 18:54:13', '2019-08-10 18:04:30'),
(8, 'Best Season Deal', 'أفضل صفقة الموسم', 1566777600, 1567814400, 0, '2019-08-10 12:52:31', '2019-09-05 18:34:57'),
(9, 'sub arabic', 'sub arabic', 1567814400, 1569456000, 0, '2019-09-06 15:59:55', '2019-11-06 17:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_products`
--

CREATE TABLE `flash_deal_products` (
  `id` int(11) NOT NULL,
  `flash_deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` double(8,2) DEFAULT '0.00',
  `discount_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flash_deal_products`
--

INSERT INTO `flash_deal_products` (`id`, `flash_deal_id`, `product_id`, `discount`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 10.00, 'amount', '2019-11-06 17:50:52', '2019-11-06 17:50:52'),
(9, 3, 1, 2.00, 'amount', '2019-07-19 23:56:39', '2019-07-19 23:56:39'),
(10, 3, 6, 2.00, 'amount', '2019-07-19 23:56:39', '2019-07-19 23:56:39'),
(14, 5, 23, 50.00, 'amount', '2019-08-05 22:30:27', '2019-08-05 22:30:27'),
(15, 5, 24, 50.00, 'amount', '2019-08-05 22:30:27', '2019-08-05 22:30:27'),
(16, 5, 47, 15.00, 'amount', '2019-08-05 22:30:27', '2019-08-05 22:30:27'),
(26, 4, 11, 0.00, 'amount', '2019-08-06 01:59:55', '2019-08-06 01:59:55'),
(27, 4, 13, 2.00, 'amount', '2019-08-06 01:59:55', '2019-08-06 01:59:55'),
(85, 7, 50, 50.00, 'percent', '2019-08-11 01:01:55', '2019-08-11 01:01:55'),
(88, 6, 50, 20.00, 'amount', '2019-08-14 19:52:42', '2019-08-14 19:52:42'),
(89, 6, 54, 49.00, 'amount', '2019-08-14 19:52:42', '2019-08-14 19:52:42'),
(115, 8, 50, 7.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(116, 8, 55, 5.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(117, 8, 57, 8.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(118, 8, 58, 2.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(119, 8, 59, 7.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(120, 8, 60, 5.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(121, 8, 61, 3.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(122, 8, 62, 2.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(123, 8, 66, 5.00, 'percent', '2019-08-26 23:28:52', '2019-08-26 23:28:52'),
(145, 9, 57, 50.00, 'amount', '2019-09-07 20:05:15', '2019-09-07 20:05:15'),
(146, 9, 60, 10.00, 'amount', '2019-09-07 20:05:15', '2019-09-07 20:05:15'),
(147, 9, 61, 110.00, 'amount', '2019-09-07 20:05:15', '2019-09-07 20:05:15'),
(148, 9, 62, 35.00, 'amount', '2019-09-07 20:05:15', '2019-09-07 20:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `frontend_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_sidebar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_cart_qty` int(11) DEFAULT NULL,
  `max_cart_qty` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `frontend_color`, `logo`, `admin_logo`, `admin_login_background`, `admin_login_sidebar`, `favicon`, `site_name`, `address`, `description`, `phone`, `email`, `facebook`, `instagram`, `twitter`, `youtube`, `google_plus`, `min_cart_qty`, `max_cart_qty`, `created_at`, `updated_at`) VALUES
(1, '5', 'uploads/logo/f729CDIttXCJWvBYnrQMXbP4arvdXFWJCvYwZ7Eh.png', 'uploads/admin_logo/EY9bPyFRZ23T7aNOWuqL4IuqOP3ua1cY2PHma9qH.svg', 'uploads/admin_login_background/VzO9jvbvecS94jR6rMt6X0yz85gmH88CS7C6GG4b.jpeg', 'uploads/admin_login_sidebar/GbUel0RwSoPBpI0FaWFJcBTno41bpI2vZ3PQOXRE.jpeg', 'uploads/favicon/8YTs201hutGapCI7KYb4TVxGSKfLOH701YDLPlWl.png', 'Okema', 'Demo Address', 'Okema is a Multi-store system is such a platform to build a borderless marketplace.', '1234567890', 'admin@example.com', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.youtube.com', 'https://www.googleplus.com', 2, 4, '2019-11-22 05:15:44', '2019-11-22 12:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `home_categories`
--

CREATE TABLE `home_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subsubcategories` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rtl` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2019-01-20 12:13:20', '2019-09-09 18:10:18'),
(4, 'Arabic', 'sa', 1, '2019-04-29 03:47:40', '2019-09-09 18:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_04_29_110825_table_extra_brand_field_create', 2),
(5, '2019_05_26_065347_create_tax_settings_table', 3),
(6, '2019_06_22_062201_create_coupons_table', 3),
(8, '2019_06_29_083052_add_api_fields_to_users_table', 3),
(9, '2019_07_01_100825_add_gender_to_users_table', 3),
(10, '2019_07_02_061758_add_verification_code_to_users_table', 4),
(11, '2019_07_04_065322_add_ar_name_to_categories_table', 5),
(12, '2019_07_04_070228_add_ar_name_to_sub_categories_table', 5),
(13, '2019_07_04_070847_add_ar_name_to_sub_sub_categories_table', 5),
(14, '2019_07_04_071131_add_ar_name_to_brands_table', 5),
(15, '2019_07_04_090834_add_ar_name_to_products_table', 5),
(16, '2019_07_05_050248_create_favourite_products_table', 5),
(17, '2019_06_22_111938_create_advert_banners_table', 6),
(18, '2019_07_08_082747_create_banner_categories_table', 6),
(19, '2019_07_12_071556_add_bod_to_users_table', 7),
(20, '2019_07_12_092314_add_description_to_advert_banners_table', 8),
(21, '2019_07_18_120651_add_ar_name_to_advert_banners_table', 9),
(22, '2019_07_19_054612_create_user_addresses_table', 10),
(23, '2019_07_22_045548_create_cart_items_table', 11),
(24, '2019_07_22_114843_create_offers_table', 12),
(25, '2019_07_23_032732_create_product_offers_table', 12),
(26, '2019_07_24_091319_add_offer_id_to_order_details_table', 13),
(27, '2019_07_29_034234_create_review_likes_table', 14),
(28, '2019_08_01_063251_add_slug_to_policies', 15),
(29, '2019_08_05_055904_add_colorname_to_products_table', 16),
(30, '2019_08_07_082820_create_enquiries_table', 17),
(31, '2019_08_07_121418_add_otp_flag_to_users_table', 18),
(32, '2019_08_08_105741_add_coupon_fields_to_orders_table', 19),
(33, '2019_08_09_061847_add_ar_description_to_products', 20),
(34, '2019_08_10_113255_add_ar_title_fields_to_flash_deals_table', 20),
(35, '2017_05_16_121531_create_devices_table', 21),
(36, '2019_08_13_061707_create_notifications_table', 21),
(37, '2019_08_13_103433_add_notification_date_fields_to_users_table', 21),
(38, '2019_08_17_044303_add_cart_fields_to_general_settings_table', 22),
(39, '2019_08_19_071955_add_color_fields_to_order_details_table', 23),
(40, '2019_09_09_061252_add_fields_to_enquiries_table', 24),
(41, '2019_11_02_051953_add_quantity_to_products', 25),
(42, '2019_11_04_050921_add_icon_to_sub_sub_categories', 26),
(43, '2019_12_14_103705_add_local_sku_to_products_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `armessage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification_type` enum('offer','deal','order') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `armessage`, `user_id`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 12:47:52', '2019-11-08 12:47:52'),
(2, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 14:13:16', '2019-11-08 14:13:16'),
(3, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 14:15:29', '2019-11-08 14:15:29'),
(4, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 14:20:06', '2019-11-08 14:20:06'),
(5, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 14:21:34', '2019-11-08 14:21:34'),
(6, 'Your order no. 20191108-1022 is on_delivery', 'طلبك لا.20191108-1022 هو on_delivery', 41, 'order', '2019-11-08 14:23:02', '2019-11-08 14:23:02'),
(7, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 14:23:20', '2019-11-08 14:23:20'),
(8, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 14:24:50', '2019-11-08 14:24:50'),
(9, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 14:29:58', '2019-11-08 14:29:58'),
(10, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 15:27:10', '2019-11-08 15:27:10'),
(11, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 15:37:58', '2019-11-08 15:37:58'),
(12, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 15:46:41', '2019-11-08 15:46:41'),
(13, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 15:49:36', '2019-11-08 15:49:36'),
(14, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 15:50:18', '2019-11-08 15:50:18'),
(15, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 15:51:43', '2019-11-08 15:51:43'),
(16, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 15:52:39', '2019-11-08 15:52:39'),
(17, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 15:53:24', '2019-11-08 15:53:24'),
(18, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 16:01:47', '2019-11-08 16:01:47'),
(19, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 16:03:17', '2019-11-08 16:03:17'),
(20, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 16:09:23', '2019-11-08 16:09:23'),
(21, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 16:16:56', '2019-11-08 16:16:56'),
(22, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 16:28:27', '2019-11-08 16:28:27'),
(23, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 16:49:15', '2019-11-08 16:49:15'),
(24, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 16:51:36', '2019-11-08 16:51:36'),
(25, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 18:50:39', '2019-11-08 18:50:39'),
(26, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 18:51:49', '2019-11-08 18:51:49'),
(27, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 18:52:19', '2019-11-08 18:52:19'),
(28, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 18:52:58', '2019-11-08 18:52:58'),
(29, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-08 18:54:26', '2019-11-08 18:54:26'),
(30, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-08 18:54:49', '2019-11-08 18:54:49'),
(31, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 11:06:14', '2019-11-09 11:06:14'),
(32, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-09 12:00:46', '2019-11-09 12:00:46'),
(33, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 12:24:07', '2019-11-09 12:24:07'),
(34, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-09 12:25:27', '2019-11-09 12:25:27'),
(35, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 12:26:36', '2019-11-09 12:26:36'),
(36, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-09 12:28:09', '2019-11-09 12:28:09'),
(37, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 12:28:27', '2019-11-09 12:28:27'),
(38, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-09 12:31:16', '2019-11-09 12:31:16'),
(39, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 12:31:44', '2019-11-09 12:31:44'),
(40, 'Your order no. 20191108-1022 is on_review', 'طلبك لا.20191108-1022 هو on_review', 41, 'order', '2019-11-09 12:38:01', '2019-11-09 12:38:01'),
(41, 'Your order no. 20191108-1022 is pending', 'طلبك لا.20191108-1022 هو pending', 41, 'order', '2019-11-09 13:05:59', '2019-11-09 13:05:59'),
(42, 'Your order no. 20191109-1023 is on_review', 'طلبك لا.20191109-1023 هو on_review', 40, 'order', '2019-11-09 13:27:12', '2019-11-09 13:27:12'),
(43, 'Your order no. 20191109-1023 is pending', 'طلبك لا.20191109-1023 هو pending', 40, 'order', '2019-11-09 13:27:27', '2019-11-09 13:27:27'),
(44, 'Your order no. 20191109-1023 is on_review', 'طلبك لا.20191109-1023 هو on_review', 40, 'order', '2019-11-09 13:29:23', '2019-11-09 13:29:23'),
(45, 'Your order no. 20191109-1023 is pending', 'طلبك لا.20191109-1023 هو pending', 40, 'order', '2019-11-09 13:37:39', '2019-11-09 13:37:39'),
(46, 'Your order no. 20191109-1023 is on_review', 'طلبك لا.20191109-1023 هو on_review', 40, 'order', '2019-11-09 13:37:58', '2019-11-09 13:37:58'),
(47, 'Your order no. 20191109-1023 is pending', 'طلبك لا.20191109-1023 هو pending', 40, 'order', '2019-11-09 13:59:53', '2019-11-09 13:59:53'),
(48, 'Your order no. 20191109-1023 is on_review', 'طلبك لا.20191109-1023 هو on_review', 40, 'order', '2019-11-09 14:01:05', '2019-11-09 14:01:05'),
(49, 'Your order no. 20191109-1023 is pending', 'طلبك لا.20191109-1023 هو pending', 40, 'order', '2019-11-11 13:55:42', '2019-11-11 13:55:42'),
(50, 'Your order no. 20191109-1023 is on_review', 'طلبك لا.20191109-1023 هو on_review', 40, 'order', '2019-11-11 14:02:06', '2019-11-11 14:02:06'),
(51, 'Your order no. 20191109-1023 is pending', 'طلبك لا.20191109-1023 هو pending', 40, 'order', '2019-11-11 14:04:16', '2019-11-11 14:04:16'),
(52, 'Your order no. 20191116-1031 is on_review', 'طلبك لا.20191116-1031 هو on_review', 26, 'order', '2019-11-16 13:26:50', '2019-11-16 13:26:50'),
(53, 'Your order no. 20191116-1031 is pending', 'طلبك لا.20191116-1031 هو pending', 26, 'order', '2019-11-16 13:29:34', '2019-11-16 13:29:34'),
(54, 'Your order no. 20191116-1031 is on_review', 'طلبك لا.20191116-1031 هو on_review', 26, 'order', '2019-11-16 14:33:11', '2019-11-16 14:33:11'),
(55, 'Your order no. 20191116-1031 is pending', 'طلبك لا.20191116-1031 هو pending', 26, 'order', '2019-11-16 14:33:22', '2019-11-16 14:33:22'),
(56, 'Your order no. 20191116-1031 is on_review', 'طلبك لا.20191116-1031 هو on_review', 26, 'order', '2019-11-16 14:42:34', '2019-11-16 14:42:34'),
(57, 'Your order no. 20191116-1031 is pending', 'طلبك لا.20191116-1031 هو pending', 26, 'order', '2019-11-16 14:42:44', '2019-11-16 14:42:44'),
(58, 'Your order no. 20191116-1031 is on_review', 'طلبك لا.20191116-1031 هو on_review', 26, 'order', '2019-11-16 15:25:22', '2019-11-16 15:25:22'),
(59, 'Your order no. 20191116-1031 is pending', 'طلبك لا.20191116-1031 هو pending', 26, 'order', '2019-11-16 15:25:33', '2019-11-16 15:25:33'),
(60, 'Your order no. 20191119-1032 is on_review', 'طلبك لا.20191119-1032 هو on_review', 26, 'order', '2019-11-20 13:00:31', '2019-11-20 13:00:31'),
(61, 'Your order no. 20191119-1032 is pending', 'طلبك لا.20191119-1032 هو pending', 26, 'order', '2019-11-20 13:05:33', '2019-11-20 13:05:33'),
(62, 'Your order no. 20191120-1033 is on_review', 'طلبك لا.20191120-1033 هو on_review', 53, 'order', '2019-11-20 16:35:48', '2019-11-20 16:35:48'),
(63, 'Your order no. 20191119-1032 is on_review', 'طلبك لا.20191119-1032 هو on_review', 26, 'order', '2019-11-20 17:16:55', '2019-11-20 17:16:55'),
(64, 'Your order no. 20191119-1032 is pending', 'طلبك لا.20191119-1032 هو pending', 26, 'order', '2019-11-20 17:20:49', '2019-11-20 17:20:49'),
(65, 'Your order no. 20191119-1032 is on_review', 'طلبك لا.20191119-1032 هو on_review', 26, 'order', '2019-11-20 17:21:17', '2019-11-20 17:21:17'),
(66, 'Your order no. 20191120-1034 is on_review', 'طلبك لا.20191120-1034 هو on_review', 26, 'order', '2019-11-26 12:56:28', '2019-11-26 12:56:28'),
(67, 'Your order no. 20191120-1034 is pending', 'طلبك لا.20191120-1034 هو pending', 26, 'order', '2019-11-26 12:57:47', '2019-11-26 12:57:47'),
(68, 'Your order no. 20191120-1034 is on_review', 'طلبك لا.20191120-1034 هو on_review', 26, 'order', '2019-11-26 12:58:44', '2019-11-26 12:58:44'),
(69, 'Your order no. 20191120-1034 is pending', 'طلبك لا.20191120-1034 هو pending', 26, 'order', '2019-11-26 13:01:04', '2019-11-26 13:01:04'),
(70, 'Your order no. 20191120-1034 is on_review', 'طلبك لا.20191120-1034 هو on_review', 26, 'order', '2019-11-26 13:01:25', '2019-11-26 13:01:25'),
(71, 'Your order no. 20191127-1050 is on_review', 'طلبك لا.20191127-1050 هو on_review', 46, 'order', '2019-11-27 16:47:30', '2019-11-27 16:47:30'),
(72, 'Your order no. 20191127-1050 is pending', 'طلبك لا.20191127-1050 هو pending', 46, 'order', '2019-11-27 16:50:58', '2019-11-27 16:50:58'),
(73, 'Your order no. 20191127-1050 is on_review', 'طلبك لا.20191127-1050 هو on_review', 46, 'order', '2019-11-27 17:07:29', '2019-11-27 17:07:29'),
(74, 'Your order no. 20191127-1050 is pending', 'طلبك لا.20191127-1050 هو pending', 46, 'order', '2019-11-27 17:11:28', '2019-11-27 17:11:28'),
(75, 'Your order no. 20191128-1055 is on_review', 'طلبك لا.20191128-1055 هو on_review', 79, 'order', '2019-11-28 17:41:06', '2019-11-28 17:41:06'),
(76, 'Your order no. 20191128-1055 is pending', 'طلبك لا.20191128-1055 هو pending', 79, 'order', '2019-11-28 17:41:38', '2019-11-28 17:41:38'),
(77, 'Your order no. 20191128-1055 is on_review', 'طلبك لا.20191128-1055 هو on_review', 79, 'order', '2019-11-28 17:41:46', '2019-11-28 17:41:46'),
(78, 'Your order no. 20191128-1055 is pending', 'طلبك لا.20191128-1055 هو pending', 79, 'order', '2019-11-28 17:41:57', '2019-11-28 17:41:57'),
(79, 'Your order no. 20191128-1055 is on_review', 'طلبك لا.20191128-1055 هو on_review', 79, 'order', '2019-11-28 17:43:20', '2019-11-28 17:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `ar_name`, `description`, `ar_description`, `banner`, `discount`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '15% OFF', '5 ٪ من', 'This is test description', 'هذا هو وصف الاختبار', 'images/offer/offer_1569646180.gif', 15.00, '2019-09-06', '2019-09-30', '2019-07-24 17:29:34', '2019-09-28 11:49:40'),
(2, '25% OFF', '25 ٪ من', 'This is test description', 'هذا هو وصف الاختبار', 'images/offer/offer_1568694348.jpg', 25.00, '2019-09-07', '2019-09-30', '2019-07-24 17:30:16', '2019-09-17 11:25:48'),
(3, '10% Off', 'خصم 10', 'Limited Time Sale Offer Discount', 'عرض بيع لفترة محدودة الخصم', 'images/offer/offer_1565008398.jpg', 10.00, '2019-08-05', '2019-08-31', '2019-08-05 19:33:18', '2019-08-09 16:27:16'),
(4, 'Flat 20% Off', 'شقة 20 ٪ من', 'Flat 20% Off', 'شقة 20 ٪ من', 'images/offer/offer_1565008432.jpg', 20.00, '2019-08-05', '2019-08-31', '2019-08-05 19:33:52', '2019-08-09 16:26:57'),
(5, '5% Cash Back', '5 ٪ كاش باك', '5% Cash Back', '5 ٪ كاش باك', 'images/offer/offer_1565008491.jpg', 5.00, '2019-08-05', '2019-08-31', '2019-08-05 19:34:51', '2019-08-09 16:27:40'),
(9, 'Test Notification', 'Test Notification', 'Test Notification', 'Test Notification', 'images/offer/offer_1566026460.webp', 10.00, '2019-08-17', '2019-08-30', '2019-08-17 14:21:00', '2019-08-17 14:21:00'),
(10, '5 % OFF', 'ما يصل الى 5٪ من', 'This is description', 'This is test description', 'images/offer/offer_1566027558.webp', 5.00, '2019-08-17', '2019-08-20', '2019-08-17 14:39:18', '2019-08-17 14:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci,
  `payment_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `grand_total` double(8,2) DEFAULT NULL,
  `code` mediumtext COLLATE utf8_unicode_ci,
  `coupon_code` text COLLATE utf8_unicode_ci,
  `discount_amount` text COLLATE utf8_unicode_ci,
  `date` int(20) NOT NULL,
  `viewed` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `guest_id`, `shipping_address`, `payment_type`, `payment_status`, `payment_details`, `grand_total`, `code`, `coupon_code`, `discount_amount`, `date`, `viewed`, `created_at`, `updated_at`) VALUES
(1, 19, NULL, '{\"address\":\"surat\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"Tolat\",\"phone\":\"966903341893\",\"postal_code\":\"935001\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191101-1001', NULL, NULL, 1572566400, 0, '2019-11-01 13:38:15', '2019-11-01 13:38:15'),
(2, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191101-1001', NULL, NULL, 1572566400, 1, '2019-11-01 13:38:44', '2019-11-01 14:20:44'),
(3, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191101-1002', NULL, NULL, 1572566400, 0, '2019-11-01 13:41:07', '2019-11-01 13:41:08'),
(4, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'unpaid', NULL, 86.40, '20191101-1003', NULL, NULL, 1572566400, 0, '2019-11-01 13:42:34', '2019-11-01 13:42:34'),
(5, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191101-1004', NULL, NULL, 1572566400, 0, '2019-11-01 13:45:29', '2019-11-01 13:45:29'),
(6, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191101-1005', NULL, NULL, 1572566400, 0, '2019-11-01 13:53:16', '2019-11-01 13:53:16'),
(7, 21, NULL, '{\"address\":\"new Zealand UAE Singapore and Australia\",\"checkout_type\":\"user\",\"city\":\"the Facebook\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"fffff\",\"phone\":\"966747474747\",\"postal_code\":\"55555\"}', 'cash_on_delivery', 'order_cancelled', NULL, 154.35, '20191101-1006', NULL, NULL, 1572566400, 0, '2019-11-01 14:27:34', '2019-11-01 15:34:09'),
(8, 19, NULL, '{\"address\":\"Piplod\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"Tolat\",\"phone\":\"966903341893\",\"postal_code\":\"123456\"}', 'cash_on_delivery', 'unpaid', NULL, 105.00, '20191104-1007', NULL, NULL, 1572825600, 0, '2019-11-04 17:13:02', '2019-11-04 17:13:02'),
(9, 27, NULL, '{\"address\":\"Katargam\",\"checkout_type\":\"user\",\"city\":\"mumbai\",\"country\":\"Saudi Arabia\",\"email\":\"android1@mailinator.com\",\"name\":\"Tolat\",\"phone\":\"966903341896\",\"postal_code\":\"395001\"}', 'cash_on_delivery', 'unpaid', NULL, 56.70, '20191104-1008', NULL, NULL, 1572825600, 0, '2019-11-04 18:19:33', '2019-11-04 18:19:33'),
(10, 19, NULL, '{\"address\":\"Gopitalav\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"Tolat\",\"phone\":\"966903341893\",\"postal_code\":\"395003\"}', 'cash_on_delivery', 'unpaid', NULL, 38.59, '20191105-1009', NULL, NULL, 1572912000, 0, '2019-11-05 14:02:24', '2019-11-05 14:02:24'),
(11, 19, NULL, '{\"address\":\"Piplod\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"Tolat\",\"phone\":\"966903341893\",\"postal_code\":\"123456\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191105-1010', NULL, NULL, 1572912000, 0, '2019-11-05 14:04:08', '2019-11-05 14:04:08'),
(12, 19, NULL, '{\"address\":\"j uvuvuuvuvbu\",\"checkout_type\":\"user\",\"city\":\"hJi\",\"country\":\"Saudi Arabia\",\"email\":\"fff@gmail.com\",\"name\":\"Bhavesh\",\"phone\":\"966903341893\",\"postal_code\":\"66969\"}', 'cash_on_delivery', 'order_cancelled', NULL, 38.59, '20191105-1011', NULL, NULL, 1572912000, 0, '2019-11-05 15:37:11', '2019-11-05 15:48:52'),
(13, 37, NULL, '{\"address\":\"guj\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"okema one\",\"phone\":\"966989898923\",\"postal_code\":\"369852\"}', 'cash_on_delivery', 'order_cancelled', NULL, 38.59, '20191106-1012', NULL, NULL, 1572998400, 0, '2019-11-06 16:19:51', '2019-11-06 17:25:35'),
(14, 37, NULL, '{\"address\":\"ind\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"N/A\",\"name\":\"okema one\",\"phone\":\"966989898989\",\"postal_code\":\"8282\"}', 'cash_on_delivery', 'unpaid', NULL, 75.60, '20191106-1013', NULL, NULL, 1572998400, 0, '2019-11-06 16:25:38', '2019-11-06 16:25:38'),
(15, 37, NULL, '{\"address\":\"B- 111, dwarkadish apartment, near navi chopati, lakhnow road, surat, gujarat.\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"N/A\",\"name\":\"okema one\",\"phone\":\"966989898989\",\"postal_code\":\"4646\"}', 'cash_on_delivery', 'unpaid', NULL, 69.30, '20191106-1014', NULL, NULL, 1572998400, 0, '2019-11-06 16:33:16', '2019-11-06 16:33:16'),
(16, 37, NULL, '{\"address\":\"hh,bisgous ous s9ua abaaoa6 sudhgutyouhaveaotherquestionsandIwillhavetotheaslasttime\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"okema one\",\"phone\":\"966989898989\",\"postal_code\":\"8383\"}', 'cash_on_delivery', 'unpaid', NULL, 18.90, '20191106-1015', NULL, NULL, 1572998400, 0, '2019-11-06 16:40:32', '2019-11-06 16:40:32'),
(17, 37, NULL, '{\"address\":\"10, sue sus8sgvugv xwibxe bcj hcoc cocc cohxo xoyfh foychcodoy oudou y9f9yo ofocoixhckhxh cvojvoycif vpflj ojoufuv9uvoug\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"okema one\",\"phone\":\"966989898923\",\"postal_code\":\"225533\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191106-1016', NULL, NULL, 1572998400, 0, '2019-11-06 16:53:25', '2019-11-06 16:53:25'),
(18, 37, NULL, '{\"address\":\"B- 111, dwarkadish apartment, near navi chopati, lakhnow road, surat, gujarat.\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"N/A\",\"name\":\"okema one\",\"phone\":\"966989898989\",\"postal_code\":\"4646\"}', 'cash_on_delivery', 'unpaid', NULL, 105.00, '20191106-1017', NULL, NULL, 1572998400, 0, '2019-11-06 16:56:33', '2019-11-06 16:56:33'),
(19, 37, NULL, '{\"address\":\"10, sue sus8sgvugv xwibxe bcj hcoc cocc cohxo xoyfh foychcodoy oudou y9f9yo ofocoixhckhxh cvojvoycif vpflj ojoufuv9uvoug\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"okema one\",\"phone\":\"966989898923\",\"postal_code\":\"225533\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191106-1018', NULL, NULL, 1572998400, 0, '2019-11-06 17:16:31', '2019-11-06 17:16:31'),
(20, 40, NULL, '{\"address\":\"Surat Gujarat395001\",\"checkout_type\":\"user\",\"city\":\"Surat\",\"country\":\"Saudi Arabia\",\"email\":\"android1@mailinatyor.com\",\"name\":\"Tolat\",\"phone\":\"966561245367\",\"postal_code\":\"395001\"}', 'cash_on_delivery', 'order_cancelled', NULL, 0.00, '20191107-1019', NULL, NULL, 1573084800, 0, '2019-11-07 18:16:05', '2019-11-07 18:27:58'),
(21, 40, NULL, '{\"address\":\"Surat Gujarat395001\",\"checkout_type\":\"user\",\"city\":\"Surat\",\"country\":\"Saudi Arabia\",\"email\":\"android1@mailinatyor.com\",\"name\":\"Tolat\",\"phone\":\"966561245367\",\"postal_code\":\"395001\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.90, '20191107-1020', NULL, NULL, 1573084800, 0, '2019-11-07 18:25:14', '2019-11-07 18:27:53'),
(22, 40, NULL, '{\"address\":\"surat\",\"checkout_type\":\"user\",\"city\":\"395001\",\"country\":\"Saudi Arabia\",\"email\":\"N/A\",\"name\":\"Tolat\",\"phone\":\"966561245367\",\"postal_code\":\"395001\"}', 'cash_on_delivery', 'order_cancelled', NULL, 0.00, '20191107-1021', NULL, NULL, 1573084800, 1, '2019-11-07 18:29:38', '2019-11-09 13:26:16'),
(23, 41, NULL, '{\"address\":\"wtatat\",\"checkout_type\":\"user\",\"city\":\"sfarF\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"tsgagsg\",\"phone\":\"966542154879\",\"postal_code\":\"4542427\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191108-1022', NULL, NULL, 1573171200, 1, '2019-11-08 12:46:55', '2019-11-08 12:47:49'),
(24, 40, NULL, '{\"address\":\"Surat Gujarat395001\",\"checkout_type\":\"user\",\"city\":\"Surat\",\"country\":\"Saudi Arabia\",\"email\":\"android1@mailinatyor.com\",\"name\":\"Tolat\",\"phone\":\"966561245367\",\"postal_code\":\"395001\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191109-1023', NULL, NULL, 1573257600, 1, '2019-11-09 13:26:45', '2019-11-09 13:27:09'),
(25, 46, NULL, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.90, '20191109-1024', NULL, NULL, 1573257600, 0, '2019-11-09 14:22:11', '2019-11-09 16:40:23'),
(26, 47, NULL, '{\"address\":\"Hfjgf\",\"city\":\"khchk\",\"country\":\"Saudi Arabia\",\"postal_code\":\"86580\",\"phone\":\"966999999999\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"hv\"}', 'cash_on_delivery', 'unpaid', NULL, 63.79, '20191109-1025', NULL, NULL, 1573257600, 1, '2019-11-09 19:32:56', '2019-11-20 13:29:09'),
(27, 37, NULL, '{\"address\":\"10, sue sus8sgvugv xwibxe bcj hcoc cocc cohxo xoyfh foychcodoy oudou y9f9yo ofocoixhckhxh cvojvoycif vpflj ojoufuv9uvoug\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"okema one\",\"phone\":\"966989898923\",\"postal_code\":\"225533\"}', 'cash_on_delivery', 'unpaid', NULL, 37.80, '20191109-1026', NULL, NULL, 1573257600, 0, '2019-11-09 19:33:14', '2019-11-09 19:33:14'),
(28, 52, NULL, '{\"address\":\"Fvgyvy\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5252\",\"phone\":\"888888888888\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"okema three\"}', 'cash_on_delivery', 'order_cancelled', NULL, 0.00, '20191112-1027', NULL, NULL, 1573516800, 0, '2019-11-12 11:32:20', '2019-11-12 11:39:12'),
(29, 52, NULL, '{\"address\":\"Fvgyvy\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5252\",\"phone\":\"888888888888\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"okema three\"}', 'cash_on_delivery', 'unpaid', NULL, 25.20, '20191112-1028', NULL, NULL, 1573516800, 0, '2019-11-12 11:38:08', '2019-11-12 11:38:08'),
(30, 26, NULL, '{\"address\":\"Vrtvtv\",\"city\":\"gggg\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5825466\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.90, '20191112-1029', NULL, NULL, 1573516800, 0, '2019-11-12 12:50:30', '2019-11-12 12:51:42'),
(31, 52, NULL, '{\"address\":\"Ggg hfhsjgz ur edipsd chewpincedwbcjdlw ccjbdwlc salcjnsac daljncda cdbcjs cidncjkd cljjd i cj cjcb ksnda lnfksjsj cjoje fm scbl sj dbp hckhs ch shc os cha cna skc hsk cand faks ckbs chea ckhsqchekq chekq cdkhw ckhsqchsf svvkshqvvskq ckhsvcke chevxk\",\"city\":\"surat surat surat\",\"country\":\"Saudi Arabia\",\"postal_code\":\"85858858\",\"phone\":\"888888888888\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"okema\"}', 'cash_on_delivery', 'unpaid', NULL, 88.99, '20191112-1030', NULL, NULL, 1573516800, 0, '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(32, 26, NULL, '{\"address\":\"Vrtvtv\",\"city\":\"gggg\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5825466\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, 25.20, '20191116-1031', NULL, NULL, 1573862400, 1, '2019-11-16 13:25:14', '2019-11-16 13:26:47'),
(33, 26, NULL, '{\"address\":\"Vrtvtv\",\"city\":\"gggg\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5825466\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, 38.59, '20191119-1032', NULL, NULL, 1574121600, 1, '2019-11-19 19:42:28', '2019-11-20 13:00:28'),
(34, 53, NULL, '{\"address\":\"surat\",\"checkout_type\":\"user\",\"city\":\"surat\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"wwww\",\"phone\":\"966574512326\",\"postal_code\":\"935881\"}', 'cash_on_delivery', 'unpaid', NULL, 0.00, '20191120-1033', NULL, NULL, 1574208000, 1, '2019-11-20 16:34:55', '2019-11-20 16:35:42'),
(35, 26, NULL, '{\"address\":\"Fyvyvychcycychcychcyvycycycycycycycgcycycycgcycychvychcchcycgcycycgcgcgcycycgchcgcgcgcgcgcgcgcgcycgcgcgcgcgvhvhvhvhvhvhvhvhvgvgcgcvgcgvgvgvgvgvyvyvyvyvyvycycyc\",\"city\":\"Surat\",\"country\":\"Saudi Arabia\",\"postal_code\":\"828272\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, 18.90, '20191120-1034', NULL, NULL, 1574208000, 1, '2019-11-20 19:57:53', '2019-11-26 12:55:37'),
(36, 26, NULL, '{\"address\":\"Vrtvtv\",\"city\":\"gggg\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5825466\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'order_cancelled', NULL, 38.59, '20191122-1035', NULL, NULL, 1574380800, 0, '2019-11-22 14:27:46', '2019-11-22 14:29:33'),
(37, 64, NULL, '{\"name\":\"admin1\",\"email\":\"admin@hauchi.com\",\"address\":\"california\",\"country\":\"Saudi Arabia\",\"city\":\"sdsd\",\"postal_code\":\"395006\",\"phone\":\"23243424\",\"checkout_type\":null}', NULL, 'unpaid', NULL, 51.75, '20191125-1036', '', '0', 1574640000, 0, '2019-11-25 13:25:38', '2019-11-25 13:25:38'),
(38, 60, NULL, '{\"name\":\"admin1\",\"email\":\"admin@hauchi.com\",\"address\":\"california\",\"country\":\"Saudi Arabia\",\"city\":\"surat\",\"postal_code\":\"395006\",\"phone\":\"87746465454\",\"checkout_type\":null}', NULL, 'unpaid', NULL, 51.75, '20191125-1037', '', '0', 1574640000, 0, '2019-11-25 13:36:06', '2019-11-25 13:36:06'),
(39, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1038', NULL, NULL, 1574812800, 0, '2019-11-27 12:52:13', '2019-11-27 12:52:13'),
(40, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1039', NULL, NULL, 1574812800, 0, '2019-11-27 12:52:18', '2019-11-27 12:52:18'),
(41, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1040', NULL, NULL, 1574812800, 0, '2019-11-27 12:52:35', '2019-11-27 12:52:35'),
(42, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1041', NULL, NULL, 1574812800, 0, '2019-11-27 12:52:44', '2019-11-27 12:52:44'),
(43, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1042', NULL, NULL, 1574812800, 0, '2019-11-27 12:58:49', '2019-11-27 12:58:49'),
(44, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1043', NULL, NULL, 1574812800, 0, '2019-11-27 12:59:05', '2019-11-27 12:59:05'),
(45, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'order_cancelled', NULL, 77.17, '20191127-1044', NULL, NULL, 1574812800, 0, '2019-11-27 13:24:52', '2019-11-28 14:10:45'),
(46, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'order_cancelled', NULL, 25.20, '20191127-1045', NULL, NULL, 1574812800, 0, '2019-11-27 13:25:24', '2019-11-28 14:10:41'),
(47, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1046', NULL, NULL, 1574812800, 0, '2019-11-27 13:25:45', '2019-11-27 13:25:45'),
(48, 46, NULL, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1047', NULL, NULL, 1574812800, 0, '2019-11-27 15:29:20', '2019-11-27 15:29:20'),
(49, NULL, 985086, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, NULL, '20191127-1048', NULL, NULL, 1574812800, 0, '2019-11-27 15:48:33', '2019-11-27 15:48:33'),
(50, 46, NULL, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.00, '20191127-1049', NULL, NULL, 1574812800, 0, '2019-11-27 16:05:09', '2019-11-27 16:50:46'),
(51, 46, NULL, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, 18.90, '20191127-1050', NULL, NULL, 1574812800, 1, '2019-11-27 16:46:47', '2019-11-27 16:47:27'),
(52, 67, NULL, '{\"address\":\"King Salman Rd, King Khalid International Airport, Riyadh 13415, Saudi Arabia\",\"checkout_type\":\"user\",\"city\":\"Riyadh\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"yyy\",\"phone\":\"966512345678\",\"postal_code\":\"13415\"}', 'cash_on_delivery', 'order_cancelled', NULL, 132.30, '20191128-1051', NULL, NULL, 1574899200, 0, '2019-11-28 13:30:41', '2019-11-28 13:50:38'),
(53, 67, NULL, '{\"address\":\"King Salman Rd, King Khalid International Airport, Riyadh 13415, Saudi Arabia\",\"checkout_type\":\"user\",\"city\":\"Riyadh\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"yyy\",\"phone\":\"966512345678\",\"postal_code\":\"13415\"}', 'cash_on_delivery', 'order_cancelled', NULL, 37.80, '20191128-1052', NULL, NULL, 1574899200, 0, '2019-11-28 13:33:07', '2019-11-28 13:50:46'),
(54, 65, NULL, '{\"address\":\"9580 Muzdalifah, An Naseem, Makkah 24241 5314, Saudi Arabia\",\"city\":\"Al Naseem\",\"country\":\"Saudi Arabia\",\"postal_code\":\"24241\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.90, '20191128-1053', NULL, NULL, 1574899200, 0, '2019-11-28 13:57:00', '2019-11-28 14:10:01'),
(55, 65, NULL, '{\"address\":\"19212, Saudi Arabia\",\"city\":\"ey\",\"country\":\"Saudi Arabia\",\"postal_code\":\"16388\",\"phone\":\"966966555555555\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"test\"}', 'cash_on_delivery', 'order_cancelled', NULL, 18.90, '20191128-1054', NULL, NULL, 1574899200, 0, '2019-11-28 14:11:12', '2019-11-28 14:11:40'),
(56, 79, NULL, '{\"address\":\"3078 Prince Mohammed Ibn Salman Ibn Abdulaziz Rd, Al Aqiq, Riyadh 13515 6168, Saudi Arabia\",\"checkout_type\":\"user\",\"city\":\"Riyadh\",\"country\":\"Saudi Arabia\",\"email\":\"null\",\"name\":\"bad SG\",\"phone\":\"966512356789\",\"postal_code\":\"13515\"}', 'cash_on_delivery', 'unpaid', NULL, 1913.89, '20191128-1055', NULL, NULL, 1574899200, 1, '2019-11-28 16:51:41', '2019-11-28 17:40:54'),
(57, 46, NULL, '{\"address\":\"Viguvvufu\",\"city\":\"hguivghh\",\"country\":\"Saudi Arabia\",\"postal_code\":\"5595585\",\"phone\":\"966572516916\",\"email\":\"N\\/A\",\"checkout_type\":\"guest\",\"name\":\"vinen\"}', 'cash_on_delivery', 'unpaid', NULL, 0.04, '20191212-1056', NULL, NULL, 1576108800, 0, '2019-12-12 14:06:17', '2019-12-12 14:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `variation` longtext COLLATE utf8_unicode_ci,
  `color` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) DEFAULT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unpaid',
  `delivery_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `seller_id`, `product_id`, `offer_id`, `variation`, `color`, `price`, `tax`, `shipping_cost`, `quantity`, `payment_status`, `delivery_status`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 35, NULL, 'Black', NULL, 0.00, 0.00, 0.00, 4, 'unpaid', 'pending', '2019-11-01 13:38:15', '2019-11-01 13:38:15'),
(2, 2, 12, 21, NULL, 'AliceBlue', NULL, 0.00, 0.00, 0.00, 1, 'unpaid', 'on_review', '2019-11-01 13:38:44', '2019-11-01 14:20:50'),
(3, 3, 12, 18, NULL, 'White', NULL, 0.00, 0.00, 0.00, 2, 'unpaid', 'pending', '2019-11-01 13:41:08', '2019-11-01 13:41:08'),
(4, 3, 12, 14, NULL, 'Fuchsia', NULL, 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-01 13:41:08', '2019-11-01 13:41:08'),
(5, 3, 12, 19, NULL, 'Black', NULL, 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-01 13:41:08', '2019-11-01 13:41:08'),
(6, 4, 12, 2, NULL, 'SandyBrown', NULL, 72.00, 14.40, 0.00, 4, 'unpaid', 'pending', '2019-11-01 13:42:34', '2019-11-01 13:42:34'),
(7, 5, 12, 22, NULL, 'Black', NULL, 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-01 13:45:29', '2019-11-01 13:45:29'),
(8, 6, 12, 30, NULL, 'Black', NULL, 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-01 13:53:16', '2019-11-01 13:53:16'),
(9, 7, 12, 1, NULL, 'Chocolate', '#D2691E', 147.00, 7.35, 0.00, 4, 'unpaid', 'order_cancelled', '2019-11-01 14:27:34', '2019-11-01 15:34:09'),
(10, 8, 12, 20, NULL, 'Amethyst', '#9966CC', 100.00, 5.00, 0.00, 1, 'unpaid', 'pending', '2019-11-04 17:13:02', '2019-11-04 17:13:02'),
(11, 9, 12, 7, NULL, 'Bisque', '#FFE4C4', 54.00, 2.70, 0.00, 3, 'unpaid', 'pending', '2019-11-04 18:19:33', '2019-11-04 18:19:33'),
(12, 10, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'pending', '2019-11-05 14:02:24', '2019-11-05 14:02:24'),
(13, 11, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 2, 'unpaid', 'pending', '2019-11-05 14:04:08', '2019-11-05 14:04:08'),
(14, 12, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-05 15:37:11', '2019-11-05 15:48:52'),
(15, 13, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-06 16:19:51', '2019-11-06 17:25:35'),
(16, 14, 12, 7, NULL, 'Bisque', '#FFE4C4', 72.00, 3.60, 0.00, 4, 'unpaid', 'pending', '2019-11-06 16:25:38', '2019-11-06 16:25:38'),
(17, 15, 12, 7, NULL, 'Bisque', '#FFE4C4', 18.00, 0.90, 0.00, 1, 'unpaid', 'pending', '2019-11-06 16:33:16', '2019-11-06 16:33:16'),
(18, 15, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 48.00, 2.40, 0.00, 2, 'unpaid', 'pending', '2019-11-06 16:33:16', '2019-11-06 16:33:16'),
(19, 16, 12, 2, NULL, 'SandyBrown', '#F4A460', 18.00, 0.90, 0.00, 1, 'unpaid', 'pending', '2019-11-06 16:40:32', '2019-11-06 16:40:32'),
(20, 17, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-06 16:53:25', '2019-11-06 16:53:25'),
(21, 18, 12, 20, NULL, 'Amethyst', '#9966CC', 100.00, 5.00, 0.00, 1, 'unpaid', 'pending', '2019-11-06 16:56:33', '2019-11-06 16:56:33'),
(22, 19, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-06 17:16:31', '2019-11-06 17:16:31'),
(23, 20, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-07 18:16:05', '2019-11-07 18:27:58'),
(24, 21, 12, 7, NULL, 'Bisque', '#FFE4C4', 18.00, 0.90, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-07 18:25:14', '2019-11-07 18:27:53'),
(25, 22, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-07 18:29:38', '2019-11-07 18:29:55'),
(26, 23, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-08 12:46:55', '2019-11-09 13:05:59'),
(27, 24, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-09 13:26:45', '2019-11-11 14:04:16'),
(28, 25, 12, 7, NULL, 'Bisque', '#FFE4C4', 18.00, 0.90, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-09 14:22:11', '2019-11-09 16:40:23'),
(29, 26, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'pending', '2019-11-09 19:32:56', '2019-11-09 19:32:56'),
(30, 26, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 24.00, 1.20, 0.00, 1, 'unpaid', 'pending', '2019-11-09 19:32:56', '2019-11-09 19:32:56'),
(31, 27, 12, 7, NULL, 'Bisque', '#FFE4C4', 36.00, 1.80, 0.00, 2, 'unpaid', 'pending', '2019-11-09 19:33:14', '2019-11-09 19:33:14'),
(32, 28, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-12 11:32:20', '2019-11-12 11:39:12'),
(33, 29, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 24.00, 1.20, 0.00, 1, 'unpaid', 'pending', '2019-11-12 11:38:08', '2019-11-12 11:38:08'),
(34, 29, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-12 11:38:08', '2019-11-12 11:38:08'),
(35, 30, 12, 2, NULL, 'SandyBrown', '#F4A460', 18.00, 0.90, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-12 12:50:30', '2019-11-12 12:51:42'),
(36, 31, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 48.00, 2.40, 0.00, 2, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(37, 31, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(38, 31, 12, 22, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(39, 31, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(40, 31, 12, 15, NULL, 'Amethyst', '#9966CC', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(41, 31, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'pending', '2019-11-12 13:13:43', '2019-11-12 13:13:43'),
(42, 32, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 24.00, 1.20, 0.00, 1, 'unpaid', 'pending', '2019-11-16 13:25:14', '2019-11-16 15:25:33'),
(43, 33, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'on_review', '2019-11-19 19:42:28', '2019-11-20 17:21:17'),
(44, 34, 12, 19, NULL, 'Black', '#000000', 0.00, 0.00, 0.00, 1, 'unpaid', 'on_review', '2019-11-20 16:34:55', '2019-11-20 16:35:48'),
(45, 35, 12, 2, NULL, 'SandyBrown', '#F4A460', 18.00, 0.90, 0.00, 1, 'unpaid', 'on_review', '2019-11-20 19:57:53', '2019-11-26 13:01:25'),
(46, 36, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-22 14:27:46', '2019-11-22 14:29:33'),
(47, 37, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 0.00, 15.00, 1, 'unpaid', 'pending', '2019-11-25 13:25:38', '2019-11-25 13:25:38'),
(48, 38, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 0.00, 15.00, 1, 'unpaid', 'pending', '2019-11-25 13:36:06', '2019-11-25 13:36:06'),
(49, 45, 12, 1, NULL, 'Chocolate', '#D2691E', 73.50, 3.68, 0.00, 2, 'unpaid', 'order_cancelled', '2019-11-27 13:24:52', '2019-11-28 14:10:45'),
(50, 46, 12, 4, NULL, 'DarkGoldenrod', '#B8860B', 24.00, 1.20, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-27 13:25:24', '2019-11-28 14:10:41'),
(51, 50, 12, 6, NULL, NULL, '', 18.00, 0.00, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-27 16:05:09', '2019-11-27 16:50:46'),
(52, 51, 12, 6, NULL, NULL, '', 18.00, 0.90, 0.00, 1, 'unpaid', 'pending', '2019-11-27 16:46:47', '2019-11-27 17:11:28'),
(53, 52, 12, 2, NULL, 'AliceBlue', '#F0F8FF', 54.00, 2.70, 0.00, 3, 'unpaid', 'order_cancelled', '2019-11-28 13:30:41', '2019-11-28 13:50:38'),
(54, 52, 12, 6, NULL, NULL, '', 72.00, 3.60, 0.00, 4, 'unpaid', 'order_cancelled', '2019-11-28 13:30:41', '2019-11-28 13:50:38'),
(55, 53, 12, 6, NULL, NULL, '', 36.00, 1.80, 0.00, 2, 'unpaid', 'order_cancelled', '2019-11-28 13:33:07', '2019-11-28 13:50:46'),
(56, 54, 12, 6, NULL, NULL, '', 18.00, 0.90, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-28 13:57:00', '2019-11-28 14:10:01'),
(57, 55, 12, 6, NULL, NULL, '', 18.00, 0.90, 0.00, 1, 'unpaid', 'order_cancelled', '2019-11-28 14:11:12', '2019-11-28 14:11:40'),
(58, 56, 12, 2, NULL, 'AliceBlue', '#F0F8FF', 36.00, 1.80, 0.00, 2, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(59, 56, 12, 21, NULL, 'AliceBlue', '#F0F8FF', 0.00, 0.00, 0.00, 1, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(60, 56, 12, 1, NULL, 'Chocolate', '#D2691E', 36.75, 1.84, 0.00, 1, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(61, 56, 12, 23, NULL, 'AliceBlue', '#F0F8FF', 250.00, 12.50, 0.00, 1, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(62, 56, 12, 23, NULL, 'AntiqueWhite', '#FAEBD7', 250.00, 12.50, 0.00, 1, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(63, 56, 12, 23, NULL, 'Aqua', '#00FFFF', 250.00, 12.50, 0.00, 1, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(64, 56, 12, 23, NULL, 'Aquamarine', '#7FFFD4', 1000.00, 50.00, 0.00, 4, 'unpaid', 'on_review', '2019-11-28 16:51:41', '2019-11-28 17:43:20'),
(65, 57, 12, 22, NULL, 'Bisque', '#FFE4C4', 0.00, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-12-12 14:06:17', '2019-12-12 14:06:17'),
(66, 57, 12, 22, NULL, 'Black', '#000000', 0.04, 0.00, 0.00, 1, 'unpaid', 'pending', '2019-12-12 14:06:17', '2019-12-12 14:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `name` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `slug` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `name`, `content`, `created_at`, `updated_at`, `slug`, `sa_content`) VALUES
(7, 'Support Policy', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgba(0, 0, 0, 0.016); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Support Policy</span><br>', '2019-08-01 18:48:40', '2019-08-01 18:48:40', 'support-policy', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgba(0, 0, 0, 0.016); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Support Policy</span><br>'),
(8, 'Return Policy', '<h2 style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 2rem; line-height: 1.2; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">What is a refund and return/exchange policy?</h2><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In a majority of counties, there are laws that protect the rights of the consumers. These laws dictate the bare minimum of a refund and return policy that you have to abide by. Well-written refund policy can boost your sales and increase profits, while overly restrictive refund policy can scare potential customers away and cost you dearly.</p><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Return and refund policy should typically address the following few points:</p><ul style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; list-style: disc; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">Clearly state if returns, exchanges, and refunds are accepted by a company.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">The number of days customers have to return or exchange a product.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">List any products that may be exempt from returns.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">Outline any other requirements that customer has to meet to be eligible for a refund.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">SaaS companies often include information about prorated or partial refunds.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">For physical products, it’s a good practice to include some details about shipping charges in the event of a return.</li></ul><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Since refund policy is a legal agreement, it can help an online business in the instances when some of the customers claim their rights are not being respected. Let’s see exactly why you need a refund policy on your website.</p><br>', '2019-08-01 19:00:07', '2019-08-01 19:00:07', 'return-policy', '<h2 style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 2rem; line-height: 1.2; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">What is a refund and return/exchange policy?</h2><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In a majority of counties, there are laws that protect the rights of the consumers. These laws dictate the bare minimum of a refund and return policy that you have to abide by. Well-written refund policy can boost your sales and increase profits, while overly restrictive refund policy can scare potential customers away and cost you dearly.</p><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Return and refund policy should typically address the following few points:</p><ul style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; list-style: disc; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">Clearly state if returns, exchanges, and refunds are accepted by a company.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">The number of days customers have to return or exchange a product.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">List any products that may be exempt from returns.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">Outline any other requirements that customer has to meet to be eligible for a refund.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">SaaS companies often include information about prorated or partial refunds.</li><li style=\"box-sizing: border-box; border: 0px; font: inherit; margin: 0px 0px 0px 15px; padding: 0px;\">For physical products, it’s a good practice to include some details about shipping charges in the event of a return.</li></ul><p style=\"box-sizing: border-box; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; margin: 0px 0px 15px; padding: 0px; color: rgb(51, 51, 51); letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Since refund policy is a legal agreement, it can help an online business in the instances when some of the customers claim their rights are not being respected. Let’s see exactly why you need a refund policy on your website.</p><br>'),
(9, 'Seller Policy', '<h3 data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px; padding: 0px; font-weight: bold; font-size: 1.2em; font-family: Bogle; color: rgb(51, 51, 51); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><ul><li>Standard &amp; Express&nbsp;shipping</li></ul></h3><p data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Standard and&nbsp;Express (optional) shipping can be enabled or disabled through Seller Center.</p><ul data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 0px 0px 0px 30px; padding: 0px; list-style: disc; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px;\">Express shipping is optional.</p></li><li style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px;\">The following transit times are recommended when selecting&nbsp;Standard or&nbsp;Express shipping:</p><ul style=\"box-sizing: border-box; margin: 0px 0px 0px 30px; padding: 0px; list-style: disc;\"><li style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px;\">Standard shipping: 2-5 business days</p></li><li style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px;\">Express shipping: 1-2 business days</p></li></ul></li></ul><p data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px 0px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">​However, the Seller can make any adjustments to their transit times as necessary to reflect their average ship times to the same regions.</p><ul data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 0px 0px 0px 30px; padding: 0px; list-style: disc; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px;\">The shipping price for Standard and Express shipping is up to the Seller.&nbsp;Sellers can charge customers for these faster methods or offer any of these methods for free.</p></li></ul><p data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">We highly recommend offering both shipping options to customers&nbsp;so they can select the shipping time that best suits their needs. Customers will also be pleasantly surprised if you offer Standard or Express shipping for free, especially during holiday or promotional seasons.</p>', '2019-08-01 19:05:55', '2019-08-01 19:05:55', 'seller-policy', '<h3 data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px; padding: 0px; font-weight: bold; font-size: 1.2em; font-family: Bogle; color: rgb(51, 51, 51); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><pre class=\"tw-data-text tw-ta tw-text-medium\" data-placeholder=\"Translation\" id=\"tw-target-text\" dir=\"rtl\" style=\"unicode-bidi: isolate; font-size: 25px; line-height: 36px; background-color: rgb(248, 249, 250); border: none; padding: 0px 0.14em 0px 0px; position: relative; margin: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: right; width: 283px; white-space: pre-wrap; overflow-wrap: break-word; color: rgb(34, 34, 34); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><span tabindex=\"0\" lang=\"ar\">الشحن القياسية و صريحة</span></pre>&nbsp;</h3><p data-aura-rendered-by=\"196:2;a\" style=\"box-sizing: border-box; margin: 5px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Bogle; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><br></p><pre class=\"tw-data-text tw-ta tw-text-small\" data-placeholder=\"Translation\" id=\"tw-target-text\" dir=\"rtl\" style=\"unicode-bidi: isolate; background-color: rgb(248, 249, 250); border: none; padding: 0px 0.14em 0px 0px; position: relative; margin: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: justify; width: 283px; white-space: pre-wrap; overflow-wrap: break-word; font-size: 16px; line-height: 24px; font-weight: 400; color: rgb(34, 34, 34); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"font-family: inherit;\">يمكن تمكين أو تعطيل الشحن المعياري والتعبير السريع (اختياري) من خلال مركز البائع. الشحن السريع هو اختياري. يوصى بأوقات النقل التالية عند اختيار الشحن المعياري أو السريع: الشحن المعياري: 2-5 أيام عمل إكسبريس الشحن: 1-2 يوم عمل ، يمكن للبائع إجراء أي تعديلات على أوقات العبور الخاصة بهم حسب الضرورة لتعكس متوسط ​​أوقات شحنهم إلى نفس المناطق. إن سعر الشحن للشحن المعياري والتعبير السريع يعود إلى البائع. يمكن للبائعين تحصيل رسوم من العملاء مقابل هذه الطرق الأسرع أو تقديم أي من هذه الطرق مجانًا. نوصي بشدة بتقديم كلا خياري الشحن للعملاء حتى يتمكنوا من تحديد وقت الشحن الذي يناسب احتياجاتهم. سوف يفاجأ العملاء أيضًا إذا قدمت شحنًا قياسيًا أو سريعًا مجانًا ، خاصةً خلال العطلات أو المواسم الترويجية.</span><br></pre><p><br></p>'),
(10, 'Terms and Condition', '<h2 style=\"box-sizing: border-box; font-family: Georgia, &quot;Times New Roman&quot;, serif; font-weight: 600; line-height: 1.1; color: rgb(51, 51, 51); margin: 30px 0px; font-size: 30px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><span id=\"What_are_Terms_and_Conditions\" style=\"box-sizing: border-box;\">What are Terms and Conditions</span></h2><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Terms and Conditions agreements act as a legal contract between you (the company) who has the website or mobile app and the user who access your website and mobile app.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Having a Terms and Conditions agreement is completely optional. No laws require you to have one. Not even the super-strict and wide-reaching General Data Protection Regulation (<a href=\"https://termsfeed.com/blog/gdpr/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">GDPR</a>).</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">It’s up to you to set the rules and guidelines that the user must agree to. You can think of your Terms and Conditions agreement as the legal agreement where you<span>&nbsp;</span><strong style=\"box-sizing: border-box; font-weight: 700;\">maintain your rights</strong><span>&nbsp;</span>to exclude users from your app in the event that they abuse your app, where you maintain your legal rights against potential app abusers, and so on.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Terms and Conditions are also known as Terms of Service or Terms of Use.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">You can use this agreement anywhere, regardless of what platform your business operates on:</p><ul style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Websites</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">WordPress blogs or blogs on any kind of platform: Joomla!, Drupal etc.</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">E-commerce shops</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Mobile apps: iOS, Android or Windows phone</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\"><a href=\"https://termsfeed.com/blog/facebook-terms-of-service-login-details-app-details/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">Facebook apps</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Desktop apps</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\"><a href=\"https://termsfeed.com/blog/terms-use-privacy-policy-saas-applications/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">SaaS apps</a></li></ul><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Desktop apps usually have an<span>&nbsp;</span><a href=\"https://termsfeed.com/blog/eula-saas-apps/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">EULA</a><span>&nbsp;</span>(End-User License Agreement) instead of a Terms and Conditions agreement, but your business can use<span>&nbsp;</span><em style=\"box-sizing: border-box;\">both</em>. Mobile apps are increasingly using Terms and Conditions along with an EULA if the mobile app has an online service component, i.e. it connects with a server.</p><h3 style=\"box-sizing: border-box; font-family: Georgia, &quot;Times New Roman&quot;, serif; font-weight: 600; line-height: 1.1; color: rgb(51, 51, 51); margin: 30px 0px; font-size: 24px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><span id=\"What_to_include_in_a_Terms_and_Conditions\" style=\"box-sizing: border-box;\">What to include in a Terms and Conditions</span></h3><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In your Terms and Conditions, you can include rules and guidelines on how users can access and use your website and mobile app.</p><br>', '2019-08-01 19:08:46', '2019-08-01 19:08:46', 'terms-and-condition', '<h2 style=\"box-sizing: border-box; font-family: Georgia, &quot;Times New Roman&quot;, serif; font-weight: 600; line-height: 1.1; color: rgb(51, 51, 51); margin: 30px 0px; font-size: 30px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><span id=\"What_are_Terms_and_Conditions\" style=\"box-sizing: border-box;\">What are Terms and Conditions</span></h2><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Terms and Conditions agreements act as a legal contract between you (the company) who has the website or mobile app and the user who access your website and mobile app.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><pre class=\"tw-data-text tw-ta tw-text-small\" data-placeholder=\"Translation\" id=\"tw-target-text\" dir=\"rtl\" style=\"unicode-bidi: isolate; background-color: rgb(248, 249, 250); border: none; padding: 0px 0.14em 0px 0px; position: relative; margin: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: right; width: 283px; white-space: pre-wrap; overflow-wrap: break-word; font-size: 16px; line-height: 24px; font-weight: 400; color: rgb(34, 34, 34); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><span tabindex=\"0\" lang=\"ar\">وجود اتفاقية شروط وأحكام اختياري تمامًا. لا توجد قوانين تتطلب منك الحصول على واحدة. لا حتى اللوائح العامة الصارمة والواسعة النطاق لحماية البيانات (GDPR). الأمر متروك لكم لوضع القواعد والإرشادات التي يجب على المستخدم الموافقة عليها. يمكنك التفكير في اتفاقية الشروط والأحكام الخاصة بك باعتبارها الاتفاقية القانونية حيث تحافظ على حقوقك في استبعاد المستخدمين من التطبيق الخاص بك في حالة قيامهم بإساءة استخدام التطبيق الخاص بك ، حيث تحافظ على حقوقك القانونية ضد طلبات الحماية المحتملة ، وما إلى ذلك. الشروط والأحكام تُعرف أيضًا باسم \"شروط الخدمة\" أو \"شروط الاستخدام\". يمكنك استخدام هذه الاتفاقية في أي مكان ، بغض النظر عن النظام الأساسي الذي تعمل عليه شركتك:</span></pre><br></p><ul style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Websites</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">WordPress blogs or blogs on any kind of platform: Joomla!, Drupal etc.</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">E-commerce shops</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Mobile apps: iOS, Android or Windows phone</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\"><a href=\"https://termsfeed.com/blog/facebook-terms-of-service-login-details-app-details/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">Facebook apps</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\">Desktop apps</li><li style=\"box-sizing: border-box; margin: 0px 0px 12px;\"><a href=\"https://termsfeed.com/blog/terms-use-privacy-policy-saas-applications/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">SaaS apps</a></li></ul><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Desktop apps usually have an<span>&nbsp;</span><a href=\"https://termsfeed.com/blog/eula-saas-apps/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 83, 167); text-decoration: none;\">EULA</a><span>&nbsp;</span>(End-User License Agreement) instead of a Terms and Conditions agreement, but your business can use<span>&nbsp;</span><em style=\"box-sizing: border-box;\">both</em>. Mobile apps are increasingly using Terms and Conditions along with an EULA if the mobile app has an online service component, i.e. it connects with a server.</p><h3 style=\"box-sizing: border-box; font-family: Georgia, &quot;Times New Roman&quot;, serif; font-weight: 600; line-height: 1.1; color: rgb(51, 51, 51); margin: 30px 0px; font-size: 24px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><span id=\"What_to_include_in_a_Terms_and_Conditions\" style=\"box-sizing: border-box;\">What to include in a Terms and Conditions</span></h3><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In your Terms and Conditions, you can include rules and guidelines on how users can access and use your website and mobile app.</p>');
INSERT INTO `policies` (`id`, `name`, `content`, `created_at`, `updated_at`, `slug`, `sa_content`) VALUES
(11, 'Privacy Policy', '<p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">A Privacy Policy is a document where you disclose what personal data you collect from your website’s visitors, how you collect it, how you use it and other important details about your privacy practices.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In this post, we’ll take a look at what Privacy Policies are and why you likely need to have one posted on your website. We’ll also go over some important clauses that are useful to include in your Privacy Policy. Finally, we’ll look at how different websites display their Privacy Policies.</p><div id=\"toc_container\" class=\"no_bullets\" style=\"box-sizing: border-box; background: rgb(249, 249, 249); border: 1px solid rgb(238, 238, 238); border-radius: 3px; padding: 15px 25px; margin-bottom: 25px; width: 845px; display: block; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><p class=\"toc_title\" style=\"box-sizing: border-box; margin: 0px; text-align: left; font-weight: 700; padding: 0px;\">Contents</p><ul class=\"toc_list\" style=\"box-sizing: border-box; margin: 1em 0px 0px; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Required_by_Law\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">1</span><span>&nbsp;</span>Required by Law</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Required_by_Third_Party_Services\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">2</span><span>&nbsp;</span>Required by Third Party Services</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Transparency\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">3</span><span>&nbsp;</span>Transparency</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Recommended_Clauses_for_Privacy_Policies\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4</span><span>&nbsp;</span>Recommended Clauses for Privacy Policies</a><ul style=\"box-sizing: border-box; margin: 10px 0px 0px 1.5em; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Type_of_Information_You_Collect\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.1</span><span>&nbsp;</span>Type of Information You Collect</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#How_the_Collected_Information_is_Processed_and_Shared\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.2</span><span>&nbsp;</span>How the Collected Information is Processed and Shared</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Use_of_Cookies_and_Tracking\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.3</span><span>&nbsp;</span>Use of Cookies and Tracking</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Changes_to_the_Privacy_Policy\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.4</span><span>&nbsp;</span>Changes to the Privacy Policy</a></li></ul></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Examples_of_Websites_with_Privacy_Policies\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5</span><span>&nbsp;</span>Examples of Websites with Privacy Policies</a><ul style=\"box-sizing: border-box; margin: 10px 0px 0px 1.5em; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Reddit\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.1</span><span>&nbsp;</span>Reddit</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Canva\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.2</span><span>&nbsp;</span>Canva</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#The_New_York_Times\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.3</span><span>&nbsp;</span>The New York Times</a></li></ul></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Summary\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">6</span><span>&nbsp;</span>Summary</a></li></ul></div><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Privacy Policies are legally binding agreements you are<span>&nbsp;</span><strong style=\"box-sizing: border-box; font-weight: bold;\">required</strong><span>&nbsp;</span>to post on your website if you’re collecting any sort of personal information from your site’s visitors or customers.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">A Privacy Policy is an important legal document that lets users understand the various ways a website might be collecting personal information. The purpose of a Privacy Policy is to inform users of your data collection practices in order to protect the customer’s privacy.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Your Privacy Policy should disclose how the website/app collects information, how the information is used, whether or not it is shared with third parties and how it is protected and stored.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">There are 3 main reasons for having a Privacy Policy: (1) you’re required by law, (2) you’re required by third party services, (3) you want to be transparent.</p><br>', '2019-08-01 19:10:34', '2019-08-01 19:10:34', 'privacy-policy', '<p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">A Privacy Policy is a document where you disclose what personal data you collect from your website’s visitors, how you collect it, how you use it and other important details about your privacy practices.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">In this post, we’ll take a look at what Privacy Policies are and why you likely need to have one posted on your website. We’ll also go over some important clauses that are useful to include in your Privacy Policy. Finally, we’ll look at how different websites display their Privacy Policies.</p><div id=\"toc_container\" class=\"no_bullets\" style=\"box-sizing: border-box; background: rgb(249, 249, 249); border: 1px solid rgb(238, 238, 238); border-radius: 3px; padding: 15px 25px; margin-bottom: 25px; width: 845px; display: block; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><p class=\"toc_title\" style=\"box-sizing: border-box; margin: 0px; text-align: left; font-weight: 700; padding: 0px;\">Contents</p><ul class=\"toc_list\" style=\"box-sizing: border-box; margin: 1em 0px 0px; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Required_by_Law\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">1</span><span>&nbsp;</span>Required by Law</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Required_by_Third_Party_Services\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">2</span><span>&nbsp;</span>Required by Third Party Services</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Transparency\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">3</span><span>&nbsp;</span>Transparency</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Recommended_Clauses_for_Privacy_Policies\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4</span><span>&nbsp;</span>Recommended Clauses for Privacy Policies</a><ul style=\"box-sizing: border-box; margin: 10px 0px 0px 1.5em; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Type_of_Information_You_Collect\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.1</span><span>&nbsp;</span>Type of Information You Collect</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#How_the_Collected_Information_is_Processed_and_Shared\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.2</span><span>&nbsp;</span>How the Collected Information is Processed and Shared</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Use_of_Cookies_and_Tracking\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.3</span><span>&nbsp;</span>Use of Cookies and Tracking</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Changes_to_the_Privacy_Policy\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">4.4</span><span>&nbsp;</span>Changes to the Privacy Policy</a></li></ul></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Examples_of_Websites_with_Privacy_Policies\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5</span><span>&nbsp;</span>Examples of Websites with Privacy Policies</a><ul style=\"box-sizing: border-box; margin: 10px 0px 0px 1.5em; padding: 0px; background: 0px center; list-style: none;\"><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Reddit\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.1</span><span>&nbsp;</span>Reddit</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Canva\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.2</span><span>&nbsp;</span>Canva</a></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#The_New_York_Times\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_2\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">5.3</span><span>&nbsp;</span>The New York Times</a></li></ul></li><li style=\"box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; background: 0px center; list-style: none;\"><a href=\"https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Summary\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(219, 102, 0); text-decoration: none; text-shadow: none;\"><span class=\"toc_number toc_depth_1\" style=\"box-sizing: border-box; margin: 0px 10px 0px 0px;\">6</span><span>&nbsp;</span>Summary</a></li></ul></div><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Privacy Policies are legally binding agreements you are<span>&nbsp;</span><strong style=\"box-sizing: border-box; font-weight: bold;\">required</strong><span>&nbsp;</span>to post on your website if you’re collecting any sort of personal information from your site’s visitors or customers.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">A Privacy Policy is an important legal document that lets users understand the various ways a website might be collecting personal information. The purpose of a Privacy Policy is to inform users of your data collection practices in order to protect the customer’s privacy.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Your Privacy Policy should disclose how the website/app collects information, how the information is used, whether or not it is shared with third parties and how it is protected and stored.</p><p style=\"box-sizing: border-box; margin: 0px 0px 25px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">There are 3 main reasons for having a Privacy Policy: (1) you’re required by law, (2) you’re required by third party services, (3) you want to be transparent.</p><br>'),
(12, 'About Us', 'تطبيق متخصص بالمكياج والعطور ومنتجات العنايه بالشعر والعناية بالبشره والاضافر وجميع الاجهزه الكهربائيه الخاصه بالشعر والجسم... يتميز التطبيق ببيع كل المنتجات الاصليه والمصرح بها وأسعار منافسه جدآ تناسب الجميع.ويوجد اسعار جمله الجمله بخصومات قويه للمندوبين وأصحاب المشاغل.موزعين معتمدين للعديد من الماركات في التجميل واجهره الشعر وغيره.....يوجد عروض وتخفيضات موسميه وشهريه بشكل دوري', '2019-11-18 11:53:25', '2019-11-18 18:53:25', 'about-us', 'تطبيق متخصص بالمكياج والعطور ومنتجات العنايه بالشعر والعناية بالبشره والاضافر وجميع الاجهزه الكهربائيه الخاصه بالشعر والجسم... يتميز التطبيق ببيع كل المنتجات الاصليه والمصرح بها وأسعار منافسه جدآ تناسب الجميع.ويوجد اسعار جمله الجمله بخصومات قويه للمندوبين وأصحاب المشاغل.موزعين معتمدين للعديد من الماركات في التجميل واجهره الشعر وغيره.....يوجد عروض وتخفيضات موسميه وشهريه بشكل دوري');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_by` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subsubcategory_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `photos` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flash_deal_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_provider` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` mediumtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `ar_description` text COLLATE utf8_unicode_ci,
  `unit_price` double(8,2) DEFAULT NULL,
  `purchase_price` double(8,2) DEFAULT NULL,
  `choice_options` mediumtext COLLATE utf8_unicode_ci,
  `colors` mediumtext COLLATE utf8_unicode_ci,
  `colorname` text COLLATE utf8_unicode_ci,
  `quantity` int(11) DEFAULT NULL,
  `globle_sku` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_sku` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `variations` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `todays_deal` int(11) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '1',
  `featured` int(11) NOT NULL DEFAULT '0',
  `current_stock` int(10) NOT NULL DEFAULT '0',
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `discount_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `tax_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'flat_rate',
  `shipping_cost` double(8,2) DEFAULT '0.00',
  `num_of_sale` int(11) NOT NULL DEFAULT '0',
  `meta_title` mediumtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `ar_name`, `added_by`, `user_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `brand_id`, `photos`, `thumbnail_img`, `featured_img`, `flash_deal_img`, `video_provider`, `video_link`, `tags`, `description`, `ar_description`, `unit_price`, `purchase_price`, `choice_options`, `colors`, `colorname`, `quantity`, `globle_sku`, `local_sku`, `variations`, `todays_deal`, `published`, `featured`, `current_stock`, `unit`, `discount`, `discount_type`, `tax`, `tax_type`, `shipping_type`, `shipping_cost`, `num_of_sale`, `meta_title`, `meta_description`, `meta_img`, `pdf`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'خافي عيوب كونسيلر برو- GC976', 'خافي عيوب كونسيلر برو- GC976', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/2dov4dfCxT2IlE0hC4pJxWyXDpj4WIVOTEJNZZIZ.jpeg\"]', 'uploads/products/thumbnail/avKyqMLvFavH9E7ixGiLAh65BLHE7dr38lx78z78.png', 'uploads/products/featured/TFOZ9VdHJmsWN2IAVKB0cJu67NgmUyfAmYPT2MIi.png', 'uploads/products/flash_deal/xKgHCbO7XCl87q96u33BUSgaXHlPYaPsObmraz9n.png', 'dailymotion', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', '<p>خافي عيوب كونسيلر برو من ال اي قيرل :</p><p>خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', '<p>خافي عيوب كونسيلر برو من ال اي قيرل :</p><p>خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', 50.00, 36.75, '[]', '[\"#D2691E\"]', '[\"Chocolate\"]', NULL, NULL, NULL, '{\"Chocolate\":{\"price\":\"50.00\",\"sku\":\"GC-C-Chocolate\",\"qty\":3,\"code\":\"#D2691E\"}}', 1, 1, 0, 0, 'شامل الضريبه', 13.25, 'amount', 5.00, NULL, 'local_pickup', 15.00, 13, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب كونسيلر برو من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', 'uploads/products/meta/g4MFFLjrIN0H7EdBVoSz7CuAUYEdPpxwTlRFRd5x.jpeg', NULL, '-----GC976-0GXJL', '2019-09-23 14:45:50', '2019-11-28 16:51:41'),
(2, 'Conceal Concealer - GC990', 'خافي عيوب كونسيلر برو  - GC990', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/0twSkR9lGHIfmXD7m41e3s22k7zC2lYGNJVE2IT8.jpeg\"]', 'uploads/products/thumbnail/wKyz4BahLTMKkHxBsty8V0zQBdboDYE2uMexECv8.jpeg', 'uploads/products/featured/0UG1f5QqgiBq6S0XKRLQDPpDRpGoq8GAYPf4hsha.jpeg', 'uploads/products/flash_deal/Yc2fxa49cgGHpFUK79Sm9HJNM1LBRIQ3Vtn2DjAz.jpeg', 'youtube', NULL, 'خافي،عيوب ،كونسيلر،برو،الوجه،البشره،', '<p>خافي عيوب كونسيلر برو من ال اي قيرل :</p><p>خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الداكنة على البشرة. مناسب للبشرة الغامقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', '<p>خافي عيوب كونسيلر برو من ال اي قيرل :</p><p>خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الداكنة على البشرة. مناسب للبشرة الغامقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', 18.00, 12.00, '[]', '[\"#F0F8FF\"]', '[\"AliceBlue\"]', NULL, NULL, NULL, '{\"AliceBlue\":{\"price\":\"18.00\",\"sku\":\"CC-G-AliceBlue\",\"qty\":8,\"code\":\"#F0F8FF\"}}', 1, 1, 0, 0, 'شلمل الضريبه', 0.00, 'amount', 5.00, NULL, 'local_pickup', 15.00, 9, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الداكنة على البشرة. مناسب للبشرة الغامقة.\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', 'uploads/products/meta/KZv2Vg2SbFhpCqhYCcQ7F0jFcWsOmNlLkfSsoXIK.jpeg', NULL, 'Conceal-Concealer---GC990-dOy42', '2019-09-23 21:39:54', '2019-11-28 16:51:41'),
(3, 'Conceal Concealer - GC994', 'خافي عيوب كونسيلر برو  - GC994', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/GUTMZSAIUJRZrTvPPmRbGkpYpOKVUcSg5KptKw9O.png\"]', 'uploads/products/thumbnail/A52iG7GJ3OvXASq3FZvb7Jv0xiVI8zsCWBb8UVdn.jpeg', 'uploads/products/featured/cdTSuJ1W0PgtjeigBTxYBCU6t6xJMyO2ZXiFyBRp.jpeg', 'uploads/products/flash_deal/gkrNCHiXOl4iEaRnig3RDIPyQhIF5c6K0ISuLE52.jpeg', 'youtube', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', 'L.A.Girl Pro Conceal Concealer :L.A. Girl\'s HD Pro Concealer is crease-resistant with opaque coverage in a creamy, yet lightweight texture.The long-wearing formula camouflages darkness under the eyes, redness and skin imperfections.Provides complete, natural-looking coverage,evens skin tone, covers dark circles and minimizes fine lines around the eyes.A lighter version of our popular Orange Corrector -conceals blue/purple undertones on fair skin tones and counteracts general dullness', 'خافي عيوب كونسيلر برو من ال اي قيرل :خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة كالبقع السمراء و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.', 26.25, 20.00, '[]', '[\"#FFDAB9\"]', '[\"PeachPuff\"]', NULL, NULL, NULL, '{\"PeachPuff\":{\"price\":\"26.25\",\"sku\":\"CC-G-PeachPuff\",\"qty\":0,\"code\":\"#FFDAB9\"}}', 1, 1, 0, 0, 'شامل الضريبه', 0.00, 'amount', 5.00, NULL, 'flat_rate', 50.00, 19, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة كالبقع السمراء و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', 'uploads/products/meta/NYjQHqh3AsKKAoBlW08AItPCW4cWmyBcTPXwXQbv.png', NULL, 'Conceal-Concealer---GC994-fxM94', '2019-09-23 22:29:24', '2019-11-27 14:07:14'),
(4, 'Conceal Concealer - GC991', 'خافي عيوب كونسيلر برو- GC991', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/tFvxT0jiHuLzvG4OeXRvpizuJbojxJqyQtWyPxI8.png\"]', 'uploads/products/thumbnail/2KGQXeNyLfas7BeDIeNRHPXAXpVPtLffyAgyBKAY.jpeg', 'uploads/products/featured/PGsriYxwKtCfC8fPJPi2zyLpvPp4cmqRuCeeSnNf.jpeg', 'uploads/products/flash_deal/Q7Lk5GalyJ5geYYQaY74FOdKwQFpU8nOjkX1V78M.jpeg', 'youtube', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', '<p>L.A.Girl Pro Conceal Concealer :</p><p>L.A. Girl\'s HD Pro Concealer is crease-resistant with opaque coverage in a creamy, yet lightweight texture.The long-wearing formula camouflages darkness under the eyes, redness and skin imperfections.Provides complete, natural-looking coverage,evens skin tone, covers dark circles and minimizes fine lines around the eyes.Corrects dullness caused by blue undertones and brightens under eye circles.</p>', '<p>خافي عيوب كونسيلر برو من ال اي قيرل :</p><p>خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء الخفيفة وعيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', 24.00, 18.00, '[]', '[\"#B8860B\",\"#A9A9A9\"]', '[\"DarkGoldenrod\",\"DarkGray\"]', NULL, NULL, NULL, '{\"DarkGoldenrod\":{\"price\":\"24.00\",\"sku\":\"CC-G-DarkGoldenrod\",\"qty\":3,\"code\":\"#B8860B\"},\"DarkGray\":{\"price\":\"24.00\",\"sku\":\"CC-G-DarkGray\",\"qty\":\"10\",\"code\":\"#A9A9A9\"}}', 1, 1, 0, 0, 'شامل الضريبه', 0.00, 'amount', 5.00, NULL, 'flat_rate', 50.00, 8, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء الخفيفة وعيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', NULL, NULL, 'Conceal-Concealer---GC991-uOKMd', '2019-09-23 22:53:48', '2019-11-28 14:10:41'),
(5, 'مجموعه تحديد الوجه ايكونك', 'مجموعه تحديد الوجه ايكونك', 'admin', 12, 9, 52, 87, 38, '[\"uploads\\/products\\/photos\\/E6OdGOUjwKdVjZdewSiM8rTLMGMAHcgpBfjpqs4i.png\",\"uploads\\/products\\/photos\\/CMNkeZrRPt2MC3wOgaxtSNzdHvQGdpa63sh3UVEx.png\"]', 'uploads/products/thumbnail/FpeNmLKt67sWKv5LaTkliKl80W20qk9ExA3sfMga.jpeg', 'uploads/products/featured/THoWC6hbgkBzyMmYKR0uFcCJj0WwXM0MHRZ6r9EV.jpeg', 'uploads/products/flash_deal/W9fydczs7CDfKRCcsd9H30lotSF0P4lzQ7gq4Xof.jpeg', 'youtube', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', 'مجموعه تحديد الوجه ايكونك من رڤلوشين:تمتعي بتحديد مثالي لملامح وجهك من&nbsp;رڤلوشين&nbsp;، تمكنك من الحصول على مظهر بشرة متألق من خلال تحديد الوجه واخفاء الهالات وعيوب البشرة.تأتي بعلبة احترافية تحتوي على 8 درجات ترابيه متدرجه لتغطية العيوب وتحديد الوجه بالكونتور بقوام باودر ليمنحك تغطية مثاليه بلا تكتل.اختيار مثالي لمظهر بشرة متألقه تزيد من تميز حضورك.', 'مجموعه تحديد الوجه ايكونك من رڤلوشين:تمتعي بتحديد مثالي لملامح وجهك من&nbsp;رڤلوشين&nbsp;، تمكنك من الحصول على مظهر بشرة متألق من خلال تحديد الوجه واخفاء الهالات وعيوب البشرة.تأتي بعلبة احترافية تحتوي على 8 درجات ترابيه متدرجه لتغطية العيوب وتحديد الوجه بالكونتور بقوام باودر ليمنحك تغطية مثاليه بلا تكتل.اختيار مثالي لمظهر بشرة متألقه تزيد من تميز حضورك.', 98.70, 70.00, '[]', '[]', '[]', NULL, NULL, NULL, '[]', 1, 1, 0, 0, 'شامل الضريبه', 0.00, 'amount', 5.00, NULL, 'flat_rate', 50.00, 0, 'Revolution Iconic Lights and Contour Pro:', 'this palette has shades to suit different skin tones\r\n\r\nwith 8 buildable shades designed to contour, sculpt and highlight.', NULL, NULL, '----0GKnW', '2019-09-23 23:15:25', '2019-11-27 14:07:24'),
(6, 'خافي عيوب كونسيلر برو  - GC992', 'خافي عيوب كونسيلر برو  - GC992', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/cUvdBLqbqNq4DwALwz1OiXDT2wfdPGM8gTjRlE4E.jpeg\"]', 'uploads/products/thumbnail/5aFsOFxB0l2lNYJPeT7S4faahKNSYtkxuhNQMi0n.jpeg', 'uploads/products/featured/8RP0bZz2WKsXGsE1nAltAFf30kS363kydYOgqBsI.jpeg', 'uploads/products/flash_deal/YMfd7zuHuJTIlLaNXyzxj9f1B2KFOZlX8LlorZNQ.jpeg', 'youtube', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', '<p>خافي عيوب كونسيلر برو من ال اي قيرل</p><p> :خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الحمراء على البشرة وتقليل الإحمرار .يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.&nbsp;</p>', '<p>خافي عيوب كونسيلر برو من ال اي قيرل</p><p> :خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الحمراء على البشرة وتقليل الإحمرار .يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.&nbsp;</p>', 26.25, 18.00, '[]', '[]', '[]', 0, NULL, NULL, '[]', 1, 1, 0, 0, 'شامل الضريبه', 0.00, 'amount', 5.00, NULL, 'flat_rate', 50.00, 6, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب من ال اي قيرل، يعمل على تصحيح عيوب البشرة وموازنة لون البقع الحمراء على البشرة وتقليل الإحمرار .\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', 'uploads/products/meta/J3SMHKeDJb4ImPqR8QxYYeaWl9gDaCuaaAcm6L5z.jpeg', NULL, '-------GC992-eHV63', '2019-09-24 01:46:22', '2019-11-28 14:11:12'),
(7, 'Conceal Concealer - GC973', 'خافي عيوب كونسيلر برو  - GC973', 'admin', 12, 9, 52, 87, 37, '[\"uploads\\/products\\/photos\\/qg9S2iyAouT7tqN9FjJkBg3Yz6sachLfMZsYLKXr.jpeg\",\"uploads\\/products\\/photos\\/uCjfshMUHqAeTj6ANx4oHNnZijNKbuAGVLOADHsa.png\"]', 'uploads/products/thumbnail/cAmD7q7hV59Fnf9FrwUcpEkWKjUBy4syFCBzCwfK.jpeg', 'uploads/products/featured/zV4EnBIJP6IgHY04BJn2ruPDySRJDt7UKs6gFzV4.jpeg', 'uploads/products/flash_deal/kF38cRoU2rhoR8QTLLFaIsbNgI6aXgl6ggDwFnII.jpeg', 'youtube', NULL, 'كريم،بشرة،خافي،عيوب،مكياج،الوجه،', '<p>L.A.Girl Pro Conceal Concealer</p><p> :L.A. Girl\'s HD Pro Concealer is crease-resistant with opaque coverage in a creamy, yet lightweight texture.The long-wearing formula camouflages darkness under the eyes, redness and skin imperfections.Provides complete, natural-looking coverage,evens skin tone, covers dark circles and minimizes fine lines around the eyes.</p>', '<p>خافي عيوب كونسيلر برو من ال اي قيرل</p><p> :خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.يتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.يأتي بعلبة ذات تصميم مرن مزودة&nbsp; برأس فرشاة ناعمة ليضمن لك دمج أفضل.اختيار رائع لإطلالة خالية من العيوب.</p>', 26.25, 18.00, '[]', '[\"#FFE4C4\"]', '[\"Bisque\"]', NULL, NULL, NULL, '{\"Bisque\":{\"price\":\"18.00\",\"sku\":\"CC-G-Bisque\",\"qty\":0,\"code\":\"#FFE4C4\"}}', 1, 1, 0, 0, 'شامل الضريبه', 0.00, 'amount', 5.00, NULL, 'flat_rate', 50.00, 7, 'خافي عيوب كونسيلر برو من ال اي قيرل :', 'خافي عيوب من ال اي قيرل، يعمل على إخفاء هالات العين السوداء و عيوب البشرة و توحيد لونها بالإضافة إلى ملئ خطوط التجاعيد الدقيقة.\r\n\r\nيتميز بقوام كريمي خفيف على البشرة ذو ثبات طويل. ويمنحك تغطية كاملة مشرقة.\r\n\r\nيأتي بعلبة ذات تصميم مرن مزودة  برأس فرشاة ناعمة ليضمن لك دمج أفضل.\r\n\r\nاختيار رائع لإطلالة خالية من العيوب.', 'uploads/products/meta/f4H6JwRWiK6p255he8HDsa3Feh5VXqwMqhq7l80D.jpeg', NULL, 'Conceal-Concealer---GC973-8IskU', '2019-09-24 02:34:38', '2019-11-27 14:07:21'),
(21, 'Murphy Concealer Brush - G10', 'فرشاة كونسيلر من مورفي - G10', 'admin', 12, 9, 58, 114, 2, '[\"uploads\\/products\\/photos\\/L7jOjUZm2En3HlLOPeThidfXs8UzKdYHJki2jIvz.jpeg\"]', 'uploads/products/thumbnail/L00XGLuwyw7iCugKIKUyrBiWhVrbPuQnouyi9ZyT.jpeg', 'uploads/products/featured/jnnVEBY9oncudlMQmVXsWTBdyFleMHVRZUQ4Xuj4.jpeg', 'uploads/products/flash_deal/TO5JnERIwvGrDVL1hhm8OKVwFOApKY3zbENTAJ2l.jpeg', 'youtube', NULL, 'فرش الوجة', '<p>Morphe Concealer Brush:\r\n</p><p>\r\nThe Murphy Concealer is a concealer brush used to conceal blemishes under the eyes and around the nose.\r\n\r\nIdeal in integrating and distributing concealer naturally.</p>', '<p>فرشاه كونسيلر من مورفي :\r\n</p><p>\r\nفرشاه كونسيلر من مورفي، فرشاه تستخدم لإخفاء العيوب تحت العينين وحول الانف.\r\n\r\nمثاليه في دمج وتوزيع الكونسيلر بشكل طبيعي.</p>', 0.01, 0.01, '[]', '[\"#F0F8FF\"]', '[\"AliceBlue\"]', NULL, NULL, NULL, '{\"AliceBlue\":{\"price\":\"0.01\",\"sku\":\"MCB-G-AliceBlue\",\"qty\":3,\"code\":\"#F0F8FF\"}}', 1, 1, 0, 0, 'وحدة', 0.01, 'amount', 5.00, NULL, 'flat_rate', 0.01, 8, 'فرشاة كونسيلر من مورفي - G10', 'فرشاة وجه ماركة\r\nفرش وجة\r\nفرشاة وجة اصلية', NULL, NULL, 'Murphy-Concealer-Brush---G10-ViKYI', '2019-09-29 16:30:09', '2019-11-28 16:51:41'),
(22, 'Real Techniques Travel Essential Brushes Set - 3 Brushes', 'مجموعة الفرش الاساسية للسفر من ريل تكنيك - 3 فرش', 'admin', 12, 9, 58, 114, 2, '[\"uploads\\/products\\/photos\\/PViX8jwHuToKWodxfw2uYq7gt0xNeEclAK57aQ8J.jpeg\"]', 'uploads/products/thumbnail/QH0xUJVWLmoIu4pGI6f0Zh9FC3uDvLNUkINhYt5p.jpeg', 'uploads/products/featured/mCkaeD5D9FMcK4PmDFi82tlxN64b4LA8Lsqx0M2j.jpeg', 'uploads/products/flash_deal/FxgsL2dGQeDttegTwcyRAmyK5c3aHVOaI4ZBu4QL.jpeg', 'youtube', NULL, 'فرش الوجة', '<p>Real Techniques Essential Travel Set:\r\n</p><p>\r\nContains everything you need to apply perfect makeup away from home or while traveling.\r\n\r\nUse with cream, powder and liquid products and make it easier for you to merge and apply makeup\r\n\r\nA perfect choice of brushes designed to make your look beautiful.\r\n\r\n&nbsp; It comes with a case that you can use as a brush holder</p><p>About the product:\r\n</p><p>\r\n1- Foundation brush</p><p>\r\n\r\n2 - multi-use brush: for powder, blush and bronzer\r\n</p><p>\r\n3 - Eyeshadow brush<br></p>', '<p>مجموعة الفرش الاساسية للسفر من ريل تكنيك :\r\n</p><p>\r\nتحتوي على كل ماتحتاجينه لتطبيق مكياج مثالي بعيدا عن المنزل او اثناء السفر.\r\n\r\nتستخدم مع المنتجات الكريمية والبودرة والسائلة وتسهل عليك عملية الدمج ووضع المكياج\r\n\r\nاختيار مثالي لفرش مصممة خصيصاً لجعل إطلالتك جميلة.\r\n\r\n تأتي مع حافظة بامكانك استخدامها كحامل للفرش</p><p>عن المنتج :\r\n</p><p>\r\n1- فرشاة كريم الاساس</p><p>\r\n\r\n2-فرشاة متعددة الاستخدام : للبودرة واحمر الخدود والبرونزر\r\n</p><p>\r\n3- فرشاة ظل العيون</p>', 0.01, 0.01, '[]', '[\"#FFE4C4\",\"#000000\"]', '[\"Bisque\",\"Black\"]', NULL, 'testing', NULL, '{\"Bisque\":{\"price\":\"0.01\",\"sku\":\"RTTEBS-3B-Bisque\",\"qty\":9,\"code\":\"#FFE4C4\",\"img\":\"uploads\\/products\\/color\\/0M6KpNHOvv6jtzwSjgRv1gk09liFauG6SvOtHVeS.jpeg\"},\"Black\":{\"price\":\"0.05\",\"sku\":\"RTTEBS-3B-Blackgfgdfgh\",\"qty\":17,\"code\":\"#000000\",\"img\":\"uploads\\/products\\/color\\/nbuNOGKbbYEhlh8AIhRFaMunKVorhgMESzlH6XU3.jpeg\"}}', 1, 1, 0, 0, 'وحدة', 0.01, 'amount', 5.00, NULL, 'flat_rate', 0.01, 4, 'مجموعة الفرش الاساسية للسفر من ريل تكنيك - 3 فرش', 'فرش مكياج\r\nفرش ماركة\r\nفرش اصلية', NULL, NULL, 'Real-Techniques-Travel-Essential-Brushes-Set---3-Brushes-rg7o3', '2019-09-29 16:41:10', '2019-12-12 14:06:17'),
(23, 'Amorus Pointed Powder Professional Makeup Brush #921  (Pack of 1)', 'Amorus Pointed Powder Professional Makeup Brush #921  (Pack of 1)', 'admin', 12, 9, 58, 117, 0, '[\"uploads\\/products\\/photos\\/uGtPmEyth1XPEYtVXThRSi50GJM3ixEt5t6N9JDp.jpeg\"]', 'uploads/products/thumbnail/27qNShhbjfHPXRA30Ux3wgEsT3EndvGM5O9BIawB.jpeg', 'uploads/products/featured/0u6TocN9MEcUVUTZaTGdghzS7SYOKODQHPj5ZaFd.jpeg', 'uploads/products/flash_deal/sv8uGNDYQEM7LOG50vUCGjJE3B3xUtLCfzLTPgR6.jpeg', 'youtube', NULL, 'brush ,makeup', 'The Amorus Professional Makeup Brushes are perfect for flawless makeup application. Best for professional makeup artists and any anyone who wants the finest quality makeup brushes for precision makeu', 'The Amorus Professional Makeup Brushes are perfect for flawless makeup application. Best for professional makeup artists and any anyone who wants the finest quality makeup brushes for precision makeu', 250.00, 250.00, '[]', '[\"#F0F8FF\",\"#FAEBD7\",\"#00FFFF\",\"#7FFFD4\"]', '[\"AliceBlue\",\"AntiqueWhite\",\"Aqua\",\"Aquamarine\"]', NULL, NULL, NULL, '{\"AliceBlue\":{\"price\":\"250.00\",\"sku\":\"APPPMB#(o1-AliceBlue\",\"qty\":9,\"code\":\"#F0F8FF\"},\"AntiqueWhite\":{\"price\":\"250.00\",\"sku\":\"APPPMB#(o1-AntiqueWhite\",\"qty\":9,\"code\":\"#FAEBD7\"},\"Aqua\":{\"price\":\"250.00\",\"sku\":\"APPPMB#(o1-Aqua\",\"qty\":9,\"code\":\"#00FFFF\"},\"Aquamarine\":{\"price\":\"250.00\",\"sku\":\"APPPMB#(o1-Aquamarine\",\"qty\":6,\"code\":\"#7FFFD4\"}}', 0, 1, 0, 0, 'unit', 0.00, 'amount', 5.00, NULL, 'free', 0.00, 4, NULL, NULL, NULL, NULL, 'Amorus-Pointed-Powder-Professional-Makeup-Brush-921--Pack-of-1-ebfp7', '2019-11-25 13:02:22', '2019-11-28 16:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_offers`
--

CREATE TABLE `product_offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stocks` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 15, 21, 4, 'rdg', '2019-11-04 11:37:03', '2019-11-04 11:37:03'),
(2, 20, 19, 3, 'good', '2019-11-04 13:02:53', '2019-11-04 13:02:53'),
(3, 2, 27, 4, 'Good', '2019-11-04 18:24:44', '2019-11-04 18:24:44'),
(4, 2, 30, 2, '5iyiyky', '2019-11-05 10:49:20', '2019-11-05 10:49:20'),
(5, 20, 30, 5, 'good', '2019-11-05 11:42:39', '2019-11-05 11:42:39'),
(6, 4, 31, 5, 'ititjt', '2019-11-05 12:17:24', '2019-11-05 12:17:24'),
(7, 19, 31, 5, 'hruti', '2019-11-05 12:30:28', '2019-11-05 12:30:28'),
(8, 2, 31, 5, 'tutiy', '2019-11-05 12:34:15', '2019-11-05 12:34:15'),
(9, 15, 31, 2, 'hshah', '2019-11-05 12:37:56', '2019-11-05 12:37:56'),
(10, 20, 31, 5, 'QP', '2019-11-05 12:43:37', '2019-11-05 12:43:37'),
(11, 1, 31, 5, 'urjtjt', '2019-11-05 12:49:20', '2019-11-05 12:49:20'),
(12, 22, 31, 5, 'ititk', '2019-11-05 13:09:40', '2019-11-05 13:09:40'),
(13, 1, 32, 1, 'ww', '2019-11-05 13:45:52', '2019-11-05 13:45:52'),
(14, 7, 32, 5, 'iiii', '2019-11-05 13:56:01', '2019-11-05 13:56:01'),
(15, 19, 32, 2, 'yyyy', '2019-11-05 14:09:29', '2019-11-05 14:09:29'),
(16, 4, 32, 5, 'Good for use', '2019-11-05 14:14:15', '2019-11-05 14:14:15'),
(17, 4, 34, 1, 'jsjsjsj', '2019-11-05 19:37:45', '2019-11-05 19:37:45'),
(18, 3, 19, 5, 'itiyk', '2019-11-06 13:24:39', '2019-11-06 13:24:39'),
(19, 21, 19, 4, 'rrrr', '2019-11-06 13:55:25', '2019-11-06 13:55:25'),
(20, 20, 37, 5, 'hhhh', '2019-11-06 15:53:16', '2019-11-06 15:53:16'),
(21, 21, 37, 2, 'uvu', '2019-11-06 15:55:02', '2019-11-06 15:55:02'),
(22, 6, 37, 1, 'gyvu', '2019-11-06 15:55:53', '2019-11-06 15:55:53'),
(23, 2, 37, 3, 'dhdjd', '2019-11-06 16:02:50', '2019-11-06 16:02:50'),
(24, 22, 37, 4, 'h6hub', '2019-11-06 16:09:15', '2019-11-06 16:09:15'),
(25, 22, 19, 3, 'rutjt', '2019-11-06 16:16:50', '2019-11-06 16:16:50'),
(26, 4, 19, 2, 'iyku', '2019-11-06 16:23:53', '2019-11-06 16:23:53'),
(27, 19, 19, 2, 'rurjt', '2019-11-06 16:37:48', '2019-11-06 16:37:48'),
(28, 1, 19, 3, 's5stst', '2019-11-06 16:41:19', '2019-11-06 16:41:19'),
(29, 5, 19, 2, 'uritjt', '2019-11-06 16:53:57', '2019-11-06 16:53:57'),
(30, 6, 19, 1, 'itoy', '2019-11-06 17:01:28', '2019-11-06 17:01:28'),
(31, 2, 19, 3, 'iyitktkt', '2019-11-06 17:05:37', '2019-11-06 17:05:37'),
(32, 4, 38, 1, 'rrrrr', '2019-11-06 17:18:02', '2019-11-06 17:18:02'),
(33, 15, 38, 1, 'uritit', '2019-11-06 17:24:01', '2019-11-06 17:24:01'),
(34, 22, 38, 3, 'dsysysy', '2019-11-06 17:26:41', '2019-11-06 17:26:41'),
(35, 19, 38, 3, 'jtitit', '2019-11-06 17:39:11', '2019-11-06 17:39:11'),
(36, 6, 38, 3, 'titittutj', '2019-11-06 17:40:21', '2019-11-06 17:40:21'),
(37, 1, 38, 4, 'itur', '2019-11-06 17:45:13', '2019-11-06 17:45:13'),
(38, 20, 38, 1, 'ururt', '2019-11-06 17:49:16', '2019-11-06 17:49:16'),
(39, 5, 38, 3, 'ururjt', '2019-11-06 18:05:22', '2019-11-06 18:05:22'),
(40, 3, 37, 2, 'jgjgjy', '2019-11-06 18:44:52', '2019-11-06 18:44:52'),
(41, 22, 39, 3, 'rhr', '2019-11-06 18:47:35', '2019-11-06 18:47:35'),
(42, 6, 39, 5, 'ststs', '2019-11-06 18:50:04', '2019-11-06 18:50:04'),
(43, 3, 39, 4, 'iyoyu', '2019-11-06 18:53:12', '2019-11-06 18:53:12'),
(44, 15, 39, 1, 'i6iy', '2019-11-06 18:59:30', '2019-11-06 18:59:30'),
(45, 19, 39, 4, 'hshshshs', '2019-11-06 19:03:27', '2019-11-06 19:03:27'),
(46, 21, 39, 1, 'hsysyw', '2019-11-06 19:06:25', '2019-11-06 19:06:25'),
(47, 2, 39, 2, 'shshhsh', '2019-11-06 19:14:57', '2019-11-06 19:14:57'),
(48, 5, 39, 4, 'shshsaha', '2019-11-06 19:20:20', '2019-11-06 19:20:20'),
(49, 4, 39, 5, 'isjsjsj', '2019-11-06 19:26:01', '2019-11-06 19:26:01'),
(50, 15, 40, 5, 'hshsh', '2019-11-06 19:36:49', '2019-11-06 19:36:49'),
(51, 19, 40, 4, 'hshshsh', '2019-11-07 17:04:36', '2019-11-07 17:04:36'),
(52, 2, 26, 4, 'Vhvuvyyhtyhh', '2019-11-08 13:54:08', '2019-11-08 13:54:08'),
(53, 4, 26, 4, 'Hush shush', '2019-11-08 14:01:08', '2019-11-08 14:01:08'),
(54, 7, 26, 4, 'Tdrryhhy', '2019-11-08 14:06:19', '2019-11-08 14:06:19'),
(55, 22, 41, 5, 'hdhdh', '2019-11-09 11:42:42', '2019-11-09 11:42:42'),
(56, 4, 47, 3, 'Ggggg', '2019-11-09 18:58:00', '2019-11-09 18:58:00'),
(57, 2, 47, 1, 'Vchxhfxfhxghc', '2019-11-09 19:12:06', '2019-11-09 19:12:06'),
(58, 1, 46, 1, 'Gvgvgvg', '2019-11-11 13:03:15', '2019-11-11 13:03:15'),
(59, 7, 46, 3, 'Gvgv', '2019-11-11 13:07:47', '2019-11-11 13:07:47'),
(60, 2, 46, 3, 'Ggvvhgv', '2019-11-11 13:14:15', '2019-11-11 13:14:15'),
(61, 6, 46, 3, 'Dbhbcdhs', '2019-11-11 13:21:15', '2019-11-11 13:21:15'),
(62, 19, 52, 1, 'Nice', '2019-11-12 11:29:49', '2019-11-12 11:29:49'),
(63, 7, 65, 5, 'Jhcjh', '2019-11-27 12:33:20', '2019-11-27 12:33:20'),
(64, 3, 46, 1, 'Hshe', '2019-11-27 18:26:37', '2019-11-27 18:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `review_likes`
--

CREATE TABLE `review_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `review_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_likes`
--

INSERT INTO `review_likes` (`id`, `user_id`, `review_id`, `created_at`, `updated_at`) VALUES
(8, 19, 10, '2019-11-06 13:09:38', '2019-11-06 13:09:38'),
(7, 19, 5, '2019-11-06 13:09:37', '2019-11-06 13:09:37'),
(9, 19, 7, '2019-11-06 13:11:20', '2019-11-06 13:11:20'),
(10, 13, 1, '2019-11-06 13:17:32', '2019-11-06 13:17:32'),
(16, 19, 3, '2019-11-06 13:27:54', '2019-11-06 13:27:54'),
(28, 19, 19, '2019-11-06 13:55:38', '2019-11-06 13:55:38'),
(31, 37, 6, '2019-11-06 14:06:13', '2019-11-06 14:06:13'),
(32, 19, 15, '2019-11-06 15:35:27', '2019-11-06 15:35:27'),
(33, 37, 2, '2019-11-06 15:46:56', '2019-11-06 15:46:56'),
(35, 37, 19, '2019-11-06 15:54:46', '2019-11-06 15:54:46'),
(42, 44, 13, '2019-11-08 23:14:42', '2019-11-08 23:14:42'),
(43, 44, 28, '2019-11-08 23:14:43', '2019-11-08 23:14:43'),
(44, 47, 16, '2019-11-09 18:58:37', '2019-11-09 18:58:37'),
(47, 47, 55, '2019-11-09 19:17:15', '2019-11-09 19:17:15'),
(48, 47, 41, '2019-11-09 19:17:16', '2019-11-09 19:17:16'),
(49, 47, 34, '2019-11-09 19:17:17', '2019-11-09 19:17:17'),
(50, 47, 25, '2019-11-09 19:17:18', '2019-11-09 19:17:18'),
(51, 47, 24, '2019-11-09 19:17:20', '2019-11-09 19:17:20'),
(52, 47, 12, '2019-11-09 19:17:23', '2019-11-09 19:17:23'),
(53, 47, 56, '2019-11-09 19:18:15', '2019-11-09 19:18:15'),
(54, 47, 49, '2019-11-09 19:18:16', '2019-11-09 19:18:16'),
(55, 47, 32, '2019-11-09 19:18:17', '2019-11-09 19:18:17'),
(56, 47, 26, '2019-11-09 19:18:18', '2019-11-09 19:18:18'),
(57, 47, 17, '2019-11-09 19:18:20', '2019-11-09 19:18:20'),
(58, 47, 53, '2019-11-09 19:18:22', '2019-11-09 19:18:22'),
(59, 47, 6, '2019-11-09 19:18:24', '2019-11-09 19:18:24'),
(61, 52, 15, '2019-11-12 11:30:28', '2019-11-12 11:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `query` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `query`, `count`, `created_at`, `updated_at`) VALUES
(1, 'اجهزة الشعر', 16, '2019-11-15 13:09:28', '2019-11-15 13:09:33'),
(2, 'CONCEALER CONCEALER PRO', 1, '2019-11-25 13:14:51', '2019-11-25 13:14:51'),
(3, 'اجهزه', 2, '2019-12-06 10:49:30', '2019-12-06 10:49:31'),
(4, 'ساونا', 1, '2019-12-10 22:36:58', '2019-12-10 22:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT '0',
  `verification_info` longtext COLLATE utf8_unicode_ci,
  `cash_on_delivery_status` int(1) NOT NULL DEFAULT '0',
  `sslcommerz_status` int(1) NOT NULL DEFAULT '0',
  `stripe_status` int(1) DEFAULT '0',
  `paypal_status` int(1) NOT NULL DEFAULT '0',
  `paypal_client_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_client_secret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssl_store_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssl_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_secret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_to_pay` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revisit` int(11) NOT NULL,
  `sitemap_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `keyword`, `author`, `revisit`, `sitemap_link`, `description`, `created_at`, `updated_at`) VALUES
(1, 'responsive,template,developer,Okema', 'Okema', 11, 'http://okemasa.com/', '<p>Okema Multi-Store system is such a platform to build a borderless marketplace both for physical and digital goods.<br></p>', '2019-10-23 04:27:58', '2019-10-22 22:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliders` longtext COLLATE utf8_unicode_ci,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `orders` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `ar_name`, `category_id`, `orders`, `created_at`, `updated_at`) VALUES
(52, 'face', 'الوجه', 9, 1, '2019-09-21 22:45:45', '2019-09-21 22:45:45'),
(53, 'Lips', 'الشفاه', 9, 2, '2019-09-21 22:56:33', '2019-09-21 22:56:33'),
(54, 'Eyes', 'العيون', 9, 3, '2019-09-21 22:58:22', '2019-09-21 22:58:22'),
(55, 'Eyebrow', 'الحواجب', 9, 4, '2019-09-21 22:59:12', '2019-09-22 01:12:28'),
(56, 'Cheek', 'الخدود', 9, 5, '2019-09-21 22:59:52', '2019-09-22 01:15:05'),
(57, 'Highlighter', 'الإضاءة', 9, 6, '2019-09-21 23:00:34', '2019-09-22 01:28:46'),
(58, 'Brushes &amp; Tools', 'فرش وأدوات', 9, 7, '2019-09-21 23:01:13', '2019-09-22 01:28:04'),
(59, 'Makeup Removers', 'مزيل المكياج', 9, 7, '2019-09-21 23:01:46', '2019-09-22 01:27:19'),
(60, 'Women Perfumes', 'عطور نسائية', 10, 1, '2019-09-21 23:02:42', '2019-09-22 01:35:29'),
(61, 'Niche Perfumes', 'عطورات النيش الفاخرة', 10, 2, '2019-09-21 23:03:26', '2019-09-22 01:36:17'),
(62, 'Men Perfume', 'عطور رجاليه', 10, 3, '2019-09-21 23:04:44', '2019-09-22 01:37:12'),
(63, 'Unisex Perfumes', 'عطور للجنسين', 10, 4, '2019-09-21 23:05:31', '2019-09-22 01:38:11'),
(64, 'Children Perfumes', 'عطور اطفال', 10, 5, '2019-09-21 23:06:04', '2019-09-22 01:39:29'),
(65, 'Hair Mist', 'عطور شعر', 10, 6, '2019-09-21 23:07:29', '2019-09-22 01:40:33'),
(66, 'Gift Set', 'طقم الهدايا', 10, 7, '2019-09-21 23:08:35', '2019-09-22 01:41:48'),
(67, 'Sunscreen', 'واقي شمس', 11, 1, '2019-09-21 23:12:26', '2019-09-22 01:48:10'),
(68, 'Tan', 'التسمير_التان', 11, 2, '2019-09-21 23:13:13', '2019-09-22 01:48:44'),
(69, 'Body Care', 'العناية بالجسم', 11, 3, '2019-09-21 23:15:41', '2019-09-22 01:49:45'),
(70, 'Hair Care', 'العناية بالشعر', 11, 4, '2019-09-21 23:16:09', '2019-09-22 01:51:41'),
(71, 'Face Care', 'العناية بالوجه', 11, 5, '2019-09-21 23:17:47', '2019-09-22 01:52:13'),
(72, 'Mouth Care', 'العناية بالفم', 11, 6, '2019-09-21 23:18:41', '2019-09-22 01:52:51'),
(73, 'Hand Care', 'العناية باليدين', 11, 7, '2019-09-21 23:19:12', '2019-09-22 01:53:34'),
(74, 'Foot Care', 'العناية بالقدم', 11, 8, '2019-09-21 23:19:45', '2019-09-22 01:54:36'),
(75, 'Nails Polish', 'طلاء الأظافر', 12, 1, '2019-09-21 23:21:12', '2019-09-22 01:55:17'),
(76, 'Nails Care', 'العناية بالأظافر', 12, 2, '2019-09-21 23:23:04', '2019-09-22 01:56:20'),
(77, 'Nails Polish Remover', 'مزيل طلاء الأظافر', 12, 3, '2019-09-21 23:23:58', '2019-09-22 01:56:47'),
(78, 'Nail Tools', 'أدوات الأظافر', 12, 5, '2019-09-21 23:24:24', '2019-09-22 01:57:19'),
(79, 'Beauteous Lenses', 'عدسات بيوتيس', 13, 1, '2019-09-21 23:27:23', '2019-09-22 01:58:06'),
(81, 'Naturel Lenses', 'عدسات ناتشورل', 13, 3, '2019-09-21 23:28:58', '2019-09-22 01:59:37'),
(82, 'Luminous Lenses', 'عدسات ليمونوس', 13, 4, '2019-09-21 23:29:33', '2019-09-22 02:00:21'),
(83, 'My Lense Lenses', 'عدسات ماي لينس', 13, 5, '2019-09-21 23:30:25', '2019-09-22 02:01:35'),
(84, 'Diva Lenses', 'عدسات ديفا', 13, 6, '2019-09-21 23:30:56', '2019-09-22 02:02:10'),
(85, 'Lens Me Lenses', 'عدسات لنس مي', 13, 7, '2019-09-21 23:31:23', '2019-09-22 02:03:08'),
(86, 'Anesthesia Lenses', 'عدسات انيستيزيا', 13, 8, '2019-09-21 23:32:08', '2019-09-22 02:03:50'),
(87, 'Women sunglasses', 'نظارات نسائية', 14, 1, '2019-09-21 23:33:04', '2019-09-22 02:04:33'),
(88, 'Men sunglasses', 'نظارات رجالية', 14, 2, '2019-09-21 23:33:27', '2019-09-22 02:05:26'),
(89, 'Hair Devices', 'أجهزة الشعر', 15, 1, '2019-09-22 00:05:29', '2019-09-22 02:07:08'),
(90, 'Facial Devices', 'أجهزة الوجه', 15, 2, '2019-09-22 00:05:58', '2019-09-22 02:07:43'),
(91, 'Body Devices', 'أجهزة الجسم', 15, 3, '2019-09-22 00:06:26', '2019-09-22 02:09:29'),
(92, 'Men Devices', 'أجهزة رجالية', 15, 4, '2019-09-22 00:07:11', '2019-09-22 02:10:06'),
(93, 'Female Devices', 'أجهزة نسائية', 15, 5, '2019-09-22 00:07:37', '2019-09-22 02:10:50'),
(94, 'Cases and Covers', 'أغطية و كڤرات', 16, 1, '2019-09-22 00:10:58', '2019-09-22 02:11:56'),
(95, 'Wires and Cables', 'أسلاك وكيابل', 16, 2, '2019-09-22 00:11:48', '2019-09-22 02:12:45'),
(96, 'Power Bank Charger', 'بطاريات وشواحن متنقلة', 16, 3, '2019-09-22 00:12:44', '2019-09-22 02:13:46'),
(97, 'Speakers and Earphone', 'سماعات', 16, 4, '2019-09-22 00:13:08', '2019-09-22 02:14:17'),
(98, 'Accessories', 'أكسسوارات', 16, 5, '2019-09-22 00:13:28', '2019-09-22 02:14:59'),
(99, 'Coffee', 'القهوة', 17, 1, '2019-09-22 00:15:21', '2019-09-22 02:15:29'),
(100, 'Storage & Organization', 'التنظيم والتخزين', 17, 2, '2019-09-22 00:15:50', '2019-09-22 02:18:05'),
(101, 'Bottles &amp; Cups', 'كوب و قارورة', 17, 3, '2019-09-22 00:16:22', '2019-09-22 02:18:41'),
(102, 'Home Decor', 'تحف و ديكورات', 17, 3, '2019-09-22 00:16:49', '2019-09-22 02:19:34'),
(103, 'Home Fragances', 'فواحات ومعطرات', 17, 5, '2019-09-22 00:18:31', '2019-09-22 02:20:16'),
(104, 'Pinkesh lens', 'Pinkesh lens', 13, 52, '2019-11-20 13:42:06', '2019-11-20 13:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brands` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `orders` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_sub_categories`
--

INSERT INTO `sub_sub_categories` (`id`, `sub_category_id`, `name`, `ar_name`, `icon`, `brands`, `orders`, `created_at`, `updated_at`) VALUES
(87, 52, 'مصحح و خافي عيوب', 'مصحح و خافي عيوب', 'uploads/sub subcategories/icon/0VqGuyTDBjmKOybjWd1u7zEmuUFBGExWVrKjvGmL.png', '[\"37\",\"38\",\"40\",\"44\",\"45\",\"46\",\"47\"]', 1, '2019-09-22 16:09:58', '2019-11-04 13:32:42'),
(88, 52, 'Foundation', 'كريم الأساس', 'uploads/sub subcategories/icon/CJqX5kPQe0cg79hGsIt0oCHhGPSmITpSn89iclWE.png', '[\"3\",\"5\",\"38\",\"44\",\"45\",\"47\",\"50\",\"51\",\"52\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\"]', 2, '2019-09-22 16:11:26', '2019-11-04 13:33:00'),
(89, 52, 'Face Primer', 'برايمر الوجه', 'uploads/sub subcategories/icon/jg77gfaFF9Xbk9N9ljHC0AWkTd45PhaiLqdP6yiG.png', '[\"3\"]', 3, '2019-09-22 17:24:34', '2019-11-04 13:33:18'),
(90, 52, 'Powder', 'بودرة الوجه', NULL, '[\"3\"]', 4, '2019-09-22 17:27:46', '2019-09-22 17:27:46'),
(91, 52, 'Makeup Spray', 'بخاخ المكياج', NULL, '[\"2\"]', 5, '2019-09-22 17:28:53', '2019-09-22 17:28:53'),
(92, 52, 'BB &amp; CC Cream', 'كريم بي بي و سي سي', NULL, '[\"4\"]', 6, '2019-09-22 17:30:08', '2019-09-22 17:30:08'),
(93, 52, 'Face Sets', 'مجموعة الوجه', NULL, '[\"5\"]', 7, '2019-09-22 17:31:08', '2019-09-22 17:31:08'),
(94, 53, 'Lipstick', 'أحمر الشفاة', NULL, '[\"4\"]', 8, '2019-09-22 17:35:55', '2019-09-22 17:35:55'),
(95, 53, 'Liquid Lipstick', 'أحمر الشفاة السائل', NULL, '[\"4\"]', 9, '2019-09-22 17:37:16', '2019-09-22 17:37:16'),
(96, 53, 'Lip Gloss', 'ملمع الشفاة', NULL, '[\"4\"]', 10, '2019-09-22 17:38:09', '2019-09-22 17:38:09'),
(97, 53, 'Lip Liner', 'محددات الشفاة', NULL, '[\"4\"]', 11, '2019-09-22 17:39:07', '2019-09-22 17:39:07'),
(98, 53, 'برايمر الشفاة', 'برايمر الشفاة', NULL, '[\"3\"]', 12, '2019-09-22 17:40:38', '2019-09-22 17:42:05'),
(99, 53, 'Lip Sets', 'مجموعة أحمر الشفاة', NULL, '[\"3\"]', 13, '2019-09-22 17:41:50', '2019-09-22 17:41:50'),
(100, 54, 'Mascara', 'ماسكارا', NULL, '[\"2\"]', 14, '2019-09-22 17:44:33', '2019-09-22 17:44:33'),
(101, 54, 'Eyeliner', 'محددات العيون', NULL, '[\"2\"]', 15, '2019-09-22 17:46:05', '2019-09-22 17:46:05'),
(102, 54, 'Eyeshadow', 'ظلال العيون', NULL, '[\"2\"]', 16, '2019-09-22 17:47:02', '2019-09-22 17:47:02'),
(103, 54, 'Eye Primer', 'برايمر العيون', NULL, '[\"2\"]', 17, '2019-09-22 17:47:57', '2019-09-22 17:47:57'),
(104, 52, 'Gel &amp; Powder', 'جل وبودرة الحواجب', NULL, '[\"3\",\"49\"]', 18, '2019-09-22 17:49:24', '2019-09-30 21:47:49'),
(105, 55, 'Eyebrow Pencil', 'أقلام الحواجب', NULL, '[\"2\"]', 19, '2019-09-22 17:50:45', '2019-09-22 17:50:45'),
(106, 55, 'Eyebrow Mascara', 'ماسكارا الحواجب', NULL, '[\"3\"]', 20, '2019-09-22 17:51:57', '2019-09-22 17:51:57'),
(107, 55, 'Eyebrow Sets', 'مجموعة الحواجب', NULL, '[\"2\"]', 21, '2019-09-22 17:56:54', '2019-09-22 17:56:54'),
(108, 56, 'Blush', 'أحمر الخدود', NULL, '[\"3\"]', 22, '2019-09-22 17:58:13', '2019-09-22 17:58:13'),
(109, 56, 'Contour', 'كنتور', NULL, '[\"3\"]', 23, '2019-09-22 17:59:41', '2019-09-22 17:59:41'),
(110, 56, 'Bronzer', 'برونزر', NULL, '[\"3\"]', 24, '2019-09-22 18:00:32', '2019-09-22 18:00:32'),
(111, 57, 'Powder Highlighter', 'هايلايتر بودرة', NULL, '[\"20\"]', 25, '2019-09-22 18:01:51', '2019-09-22 18:01:51'),
(112, 57, 'Liquid Highlighter', 'هايلايتر سائل', NULL, '[\"10\"]', 26, '2019-09-22 18:02:49', '2019-09-22 18:02:49'),
(113, 57, 'Palette &amp; Set', 'مجموعة و باليت', NULL, '[\"16\"]', 27, '2019-09-22 18:04:17', '2019-09-22 18:04:17'),
(114, 58, 'فرش الوجه', 'فرش الوجه', NULL, '[\"2\"]', 28, '2019-09-22 18:06:29', '2019-09-22 18:06:44'),
(115, 58, 'Eye Brushes', 'فرش العيون', NULL, '[\"2\"]', 29, '2019-09-22 18:08:07', '2019-09-22 18:08:07'),
(116, 58, 'Eyebrow Brushes', 'فرش الحواجب', NULL, '[\"1\"]', 30, '2019-09-22 18:10:57', '2019-09-22 18:10:57'),
(117, 58, 'Lip Brushes', 'فرش الشفاة', NULL, '[\"1\"]', 31, '2019-09-22 18:11:46', '2019-09-22 18:11:46'),
(118, 58, 'Sponges &amp; Tools', 'اسفنجات و أدوات', NULL, '[\"1\"]', 32, '2019-09-22 18:13:00', '2019-09-22 18:13:00'),
(119, 52, 'Brush Sets', 'مجموعات فرش المكياج', NULL, '[\"5\"]', 33, '2019-09-22 18:14:23', '2019-09-29 15:07:21'),
(121, 87, 'Aviator Frame Style', 'نظارات أفياتور', NULL, '[\"35\"]', 34, '2019-09-22 18:22:46', '2019-09-22 18:22:46'),
(122, 87, 'Round Frame Style', 'نظارات دائرية', NULL, '[\"1\"]', 35, '2019-09-22 18:24:12', '2019-09-22 18:24:12'),
(123, 87, 'Square Frame Style', 'نظارات مربعة', NULL, '[\"1\"]', 36, '2019-09-22 18:25:36', '2019-09-22 18:25:36'),
(124, 87, 'Cat Eyes Frame Style', 'نظارات كات ايز', NULL, '[\"1\"]', 37, '2019-09-22 18:26:48', '2019-09-22 18:26:48'),
(125, 87, 'Less than 99 SR sunglasses', 'نظارات اقل من 99 ريال', NULL, '[\"1\"]', 38, '2019-09-22 18:29:54', '2019-09-22 18:29:54'),
(126, 88, 'Aviator Frame Style', 'نظارات أفياتور', NULL, '[\"2\"]', 39, '2019-09-22 18:31:29', '2019-09-22 18:31:29'),
(127, 88, 'Cat Eyes Frame Style', 'ظارات كات ايز', NULL, '[\"1\"]', 40, '2019-09-22 18:33:10', '2019-09-22 18:33:10'),
(128, 88, 'Less than 99 SR sunglasses', 'نظارات أقل من 99 ريال', NULL, '[\"2\"]', 41, '2019-09-22 18:35:10', '2019-09-22 18:35:10'),
(129, 88, 'Round Frame Style', 'نظارات دائرية', NULL, '[\"1\"]', 42, '2019-09-22 18:37:02', '2019-09-22 18:37:02'),
(130, 88, 'Square Frame Style', 'نظارات مربعة', NULL, '[\"2\"]', 43, '2019-09-22 18:38:15', '2019-09-22 18:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `tax_settings`
--

CREATE TABLE `tax_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_setting` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_settings`
--

INSERT INTO `tax_settings` (`id`, `tax_setting`, `created_at`, `updated_at`) VALUES
(1, '5.00', '2019-07-25 07:00:00', '2019-07-25 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otp_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `gender` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1=male 2=female',
  `dob` date DEFAULT NULL,
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `api_token` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` enum('android','iphone') COLLATE utf8_unicode_ci NOT NULL,
  `device_token` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` int(11) DEFAULT NULL,
  `notification_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `provider_id`, `user_type`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `avatar`, `avatar_original`, `address`, `country`, `city`, `postal_code`, `phone`, `otp_status`, `gender`, `dob`, `balance`, `api_token`, `device_type`, `device_token`, `verification_code`, `notification_read`, `created_at`, `updated_at`) VALUES
(12, NULL, 'admin', 'shojib', 'admin@okema.com', NULL, '$2y$10$h9aOgZuW.jUKqdwoAINoGekYH/gPazZwdOROGMHU4F/kMVH69qzhC', 'VtIV9Gv71DK9eARBpvFoyD8Em3pscvJygeEseRlThbOkUI7Ce9uYyFCMbuvz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', NULL, 0.00, '', 'android', '', NULL, NULL, '2019-04-25 02:51:27', '2019-04-25 02:51:27'),
(13, NULL, 'customer', 'Hardik', NULL, NULL, '$2y$10$Nt/f1yZFPVtv.n8Px8t3RudxBPsdYT/QPWA.7n1whdS0Tl2nsQPLG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4000040000', '0', '1', NULL, 0.00, 'xE4xWjjYzLHfefgxWhvKd-b6hdfdedidM6dHjo0tMxbuDEqGqElhi', 'iphone', 'IPHONE6S', 4749, NULL, '2019-10-31 13:36:57', '2019-11-12 11:53:17'),
(14, NULL, 'customer', 'Bhavesh', 'bhavesh@gmail.com', NULL, '$2y$10$5afTPbVXPVrNIk5ij7XDc.bFud6CJ.i42Zq3RQbU5yKTVBlUHLbdO', NULL, NULL, 'null', 'Surat', NULL, NULL, NULL, '9668585858585', '0', '1', '1998-12-26', 0.00, 'WsQlPQLsJmbHl8DKzViMd-bFH69adJ6jMG4b3ysvrBZZ4gYCYJPHv', 'android', 'euuEKOKZ44g:APA91bFfC0qdkJcB2w8iCqD9GESk-A4uGDfKj3O27X6kFWiFA2yTwdHyDLDZWyM4t41G0RD54RyXuuANiFkzm2BUcZGhkk_0BNk9yR5OgDI_sFnZXy8YaUZ7Jlx6XK6LFm8tFFabnxhb', 1693, NULL, '2019-10-31 13:39:49', '2019-10-31 13:41:36'),
(15, NULL, 'customer', 'eeeeee', NULL, NULL, '$2y$10$Cc/OMhld4dOL5zxMEdnb3OcowtZmDGZ56OaVM5zTwV4EDRTDTY8Tq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9666969696969', '0', '1', NULL, 0.00, 'zAqWhQQVYDnpbaJq0ItHv-6f6CF6E6gDhcOWiwoHIhcEZKltx7WaF', 'android', 'fzxPggUUeZ4:APA91bHG118DwbOW-I0Off64VPvtI7F5_0jleOW3vHKa3mzbVyPCYK_6qv8lJkExRzl2wCQOceMy6te1tswxLmIiM2OEMCEduIIf7N_vcxiOXAeHvT_xsvC-XAjPb_eKJg5PEjf9JKGb', 6061, NULL, '2019-10-31 13:54:23', '2019-10-31 13:54:23'),
(16, NULL, 'customer', 'tttt', NULL, NULL, '$2y$10$jw2GHFUuH1OzcC97uq5Adu7fXBbcxqXhd2lkFwQxdg61sxCj0JR7y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9665858585858', '0', '1', NULL, 0.00, 'Fzi5rJi9pJIYBcR5LZGUu-b4HC6d9aD4obZ9f4mTrKfDbQgW6kiNV', 'android', 'ePh2ethnURo:APA91bGRtOD2Tqr25Jn3JbgaEXxl4EkSrAunugvQcf6dZZnmJE7-JlT_YrsWpkZWTfZUSWaWaMDaEcOUQKqfodkZcrd6_Ct08IZhu9NUNLU0ihjAjiDIYfTqHbDr7RqyTicI4ygLYKi0', 9570, NULL, '2019-10-31 13:57:52', '2019-11-05 13:23:58'),
(17, NULL, 'customer', 'eeee', 'b@b.b', NULL, '$2y$10$ZS2Y0MYGUjjxDX5ThWlwZuOhIrFxmqVrQmhoJoxpNvFmDKqgJ1RTO', NULL, NULL, 'uploads/profiles/ALhdN7kHHNlrcqDjflE5MSDguqIi14xibdII6phi.png', NULL, NULL, NULL, NULL, '966585858585', '0', '1', '1960-01-01', 0.00, 'Ij9RteUIjQdV84eZSVrRt-bf7c7bbj7jr5QY835N78rif4191Zo9N', 'android', 'eEQjfixtKQQ:APA91bHqTWdTjRoph031-2A-H-5ZyNj82O6DdodOeM1c1ySNbuQntxFQS7X74Eb2aMpean6LKBNqhfTXXM3GZVAIfEUH_zZDRN4Mw7lLK0JouWX2QRy90Z4yeIc0C9oO2laWLQa2YrW5', 6289, NULL, '2019-10-31 15:52:59', '2019-10-31 16:27:35'),
(18, NULL, 'customer', 'harna', NULL, NULL, '$2y$10$Fv.uuQYBjPSowdsEw6Ei/ODgShEpP90bgSUGuhKu4ntSrw6UwUd9i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9669904250112', '0', '1', NULL, 0.00, 'VL8rIt4lcBwyuUDlCj01I-9F0cI354EDODkIN74w0cOglZmqocupE', 'android', 'dVONpDolRUc:APA91bGUhGbjga4amRJz5AOq4e-AYgE2X9hgYhcfXzIkhO38SHPrhBj3Ukhd6NtWj5X-qQ1TTJayeoEL4qxdrhHYfxsH4o6IjqfgNX-J9dazjCwufQz0at8TLdDA36aDx-gHIVg_C_pK', 9631, NULL, '2019-10-31 16:56:20', '2019-11-04 18:45:43'),
(19, NULL, 'customer', 'Bhavesh', 'fff@gmail.com', NULL, '$2y$10$i.xhUFyGXaYAtnPod/deG.XP6fOMNaFw/9lpzfoSyqaG0RqJW4aIe', NULL, NULL, 'uploads/profiles/1quvP6aVsgaoRB0OZOpLaEqo4eeQrS0If7AxIK4F.png', NULL, NULL, NULL, NULL, '9669033418930', '0', '1', '1998-07-07', 0.00, 'XmKHpreCwvj1CmRI7077G-6fh2jc2g4dI7M6PMFDoIMixNInun5p3', 'android', 'e75MY6V_pqA:APA91bEuK-ryeoua2RI0C7jhM_9Gp2j8nKrv566wPtWPstWrPvAMcJ8qBnGjaEeO6pTgCRgFxAxu0T_tNyLU5CU_EDrIAUjWYGqx5SgcN_R3TrZMWtcEtK2UDDmm5XwfsY1Xwe1z-sqj', 8650, NULL, '2019-11-01 12:06:22', '2019-11-05 13:05:09'),
(20, NULL, 'customer', 'harna', NULL, NULL, '$2y$10$46fEjYCAQg3ix5k.ui6ERu3asTy2gmOiEM7IP8UdeJgyFz4s217P.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9669173807564', '0', '1', NULL, 0.00, 'w7huoBTA74d6l97DTAtCo-3F6CF4cj6aDGhrC4nl4luLC81xH8Dhu', 'android', 'eTWnjQKz02A:APA91bEpC4jFvIKADY7A8yMaEJt_zMqep-FAckYdj20mAX40YhVww8btN_gQBBbDeyFw_Rli6cng3ZoNEdS4knyVwdLMhHkljyVirsMYi1a_vLjrRWgc9Bi8mvS0oXCD18GGoqzjwY9V', 8183, NULL, '2019-11-01 13:11:21', '2019-11-01 14:22:50'),
(21, NULL, 'customer', 'fffff', 'ee@ee.ee', NULL, '$2y$10$satapTwaKYAFZ90i2oaCHOOPk9gXJzVg1Z3FXiL8AEpKMY/zFnRo6', NULL, NULL, 'uploads/profiles/z29FSHSLZrl7e9YNplLVF9T7UBvv3pWwMeLgaBTV.png', 'xhxh', NULL, NULL, NULL, '9667474747474', '0', '1', '1960-01-01', 0.00, 'tWHtY1kYfH2WDpB54C78q-3FH7191eE4qbIsugZhdFfOYmjpzGE4m', 'android', 'euqnfhK7_Ko:APA91bFUcPo8-FcehTYCzZEvzvDTVbxCzF1i9CqdP3bW7ylp3fFo9Xprd616tr_plgapduHqcThX4ePV7O-1riSkFFo2pHoZEC1hTWd6FLr5g3lLFBQPem9M0zZH25SqLMDvi_x0P9mx', 2789, NULL, '2019-11-01 13:21:09', '2019-11-01 14:05:40'),
(22, NULL, 'customer', 'Bhavesh', 'zz@zz.zz', NULL, '$2y$10$Akaz6PqJZaGoc/byVS2Yj.I4e7cVCedLXMewZbUkuHpZbpE84FEkS', NULL, NULL, 'uploads/profiles/WjmFZlJWfVSrDph5p011EMCCG7vVuqhfpMbCEMwz.png', 'shsh', NULL, NULL, NULL, '9666363634646', '0', '1', '1960-01-01', 0.00, 'ogvsri1zgEM8yUOw9hBfY-bf1C9hDgiajAWp9hRbhKIT9b33ONgw2', 'android', 'cl2z-X0hULo:APA91bF6cGCy65PBpTx9I3Br3k2-ANfP6kdoz9GPFoJL9x1dkAtkuJUhkk9rNiJs2LRGS0cyDXLFJTwW5rIom-J_3rnLKC_eUUtwH4BGkCdEWfb2mJ2BwcJ_k3-ravpZk6vcixR6mo_F', 9941, NULL, '2019-11-02 12:48:00', '2019-11-02 14:30:20'),
(23, NULL, 'customer', 'Tolat', NULL, NULL, '$2y$10$r3kFo5NWHtJx.9sUxXy28.Ne/XvH8lid8icoUsXYNIr8FlQJuYldy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9669033418650', '0', '1', NULL, 0.00, 'BF5Xsz2ykexWzz1v7BNGQ-BfH6ieFid5IQjiOiP1hrvwG4ynL0rLf', 'android', 'ebaOsSP1jV0:APA91bHc0n3qSqKeF-4_yxqQeThd2b0UujvwQGq_NGYRUhdVWI1XfKx8Jk8iaguBN0-a4kdajM5SpgOQhLUH4F-Dosu_UxsC_pFRq0ExKGifL74imCiLYdMintG5fQUpFanT9I_tjRFo', 3547, NULL, '2019-11-04 12:37:10', '2019-11-04 12:37:10'),
(24, NULL, 'customer', 'Tolat', NULL, NULL, '$2y$10$EZQhoqO4b8kfuiGvdFoGsu.endhFIgLFzkZZZs3Z12KLwEpMpNcJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9666077815360', '0', '1', NULL, 0.00, 'zBbPapYhhUGeD31KohEKn-07hCi9H1Ed58EjogWbxh6uWSabjXZhP', 'android', 'eOrf5w_2xiQ:APA91bHyEriRyF79n8IIo-940Z1dbRTdD2m3LAWWyE1sSCeeFx7Imp3575YUXJXj4GxFVOEcTM7rtQNn5qyK2UNfqc9sFM1iRuiSLy8YQjgaNRaa2S4SJfHLKFBkml1XQ6n1ApclsxBS', 8498, NULL, '2019-11-04 12:57:23', '2019-11-04 12:57:23'),
(25, NULL, 'customer', 'vinen', NULL, NULL, '$2y$10$i9o.LTR3Ne2YWBaaRIMSEefLa9YsUeoQ/540UzC8UaNaCIYwzeSGK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '515515151', '0', '1', NULL, 0.00, 'ptS8TETXCHhbcCRH8TZTX-bFhcIga2eD3RRDVEwWWoQfFjxWfw4tA', 'iphone', 'N/A', 4981, NULL, '2019-11-04 16:36:51', '2019-11-04 16:37:24'),
(26, NULL, 'customer', 'vinen', 'vin@gmail.com', NULL, '$2y$10$sgyswhiFIiHssE6vo3FpJOmJWdy0fRXiBXtr18dmg/J7NfcuYwmj6', NULL, NULL, 'uploads/profiles/xjy2WpL4v58xpanzSqX5U2wmNqdxqaBJHWPseW5o.jpeg', NULL, NULL, NULL, NULL, '572516916', '0', '1', '1996-06-08', 0.00, '5EKbtElzRcIH92Z5te1Qx-2Fh5faAah76RNcCvuPURAkGpTLXzCgI', 'iphone', 'cyC8lsf4gtE:APA91bHAPW1-sZL-zauxHudgN-INO77sbTfgMC0fCm_Qn2PA4Z2E0_ehpHlCWPSVegp8gLM784cqEKj9yDQLezrhP3bzkskK5KQpS1PNbSjUFLkjwd6UjMwyWdEPRz3gyeJ7SQWtE5y7', 3464, NULL, '2019-11-04 16:41:41', '2019-11-23 16:07:54'),
(27, NULL, 'customer', 'Tolat', 'android1@mailinator.com', NULL, '$2y$10$jNnq/1v8I8Up1xQyygbRFuWA8TFrKvX4rxLxFLIA3YecAGI73gfcm', NULL, NULL, 'uploads/profiles/mDbdIkAwwDG6eYm6SlDiSJGqBp5Sec7R5JUIrOAX.png', 'test', NULL, NULL, NULL, '9669033418968', '0', '1', '1960-01-01', 0.00, 'U6fxPy0RHPOo6BhF6hw7Y-bFhciGCjAaTbR7wS10f5uUMpqPzHWlA', 'android', 'dj6yswM3zZ8:APA91bFE_eMWb36Q3BaNYmRHx_X3FgGabdjq8pjK-sNzgvCSYkoTl3obzEB4oaBUTiuQGNDBwOu8aSlgEVygUm071fYZxYmKg3xl55JhO8O97wztmXAFjS220ClEZ_I4KJXlBJTbMXnE', 3505, NULL, '2019-11-04 17:21:40', '2019-11-04 18:13:25'),
(28, NULL, 'customer', 'Tolat', NULL, NULL, '$2y$10$iIC60/YLc4VI1DEsxvKssO2RmB67aDUI1.BvLY6vK4wP/GqxI5I0i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9666464646464', '0', '1', NULL, 0.00, 'elPXKh0kX1NtqyQiSJP3B-BfHCigHeH3wBYE3Pg4D5u9WEkpdgySU', 'android', 'fY2g0uE5meQ:APA91bEtR2ghIsaQmwUZ6V8e27cNuQWmZ-gp_zSeqmugIV2b3TNuCA3S5VFxdmjYxknGBIQ53puLjzx0fiaMEBKnIedxY358nwwODriTeuWlPC7EFffETrulvOznxR-AbRWnKxDDgKWm', 6393, NULL, '2019-11-04 18:37:51', '2019-11-04 18:37:51'),
(29, NULL, 'customer', 'okema', NULL, NULL, '$2y$10$vD2BnL8tLSl9DpCwxVBSZeyJQuma54hqvG9YMEcI22NdiD2EHY5fe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9669999999999', '0', '1', NULL, 0.00, 'hWj4HWL58iBN67EvPMBwt-5FhCigjbCcLBMzjxtrYJ34brSsYULjm', 'android', 'clQArxiFf6U:APA91bFCMe2F0D0CA8IL_gR8FFsjvxiwQXZCRiElQiBafDyZEpVKriMc4SfR7pZV_Ij1tcvqvWpEzoO71gZYAFiK2Mn_RWFb7ASqQuoWhWDjyFOofcqtODsrrazddF2cvxdGyaAgtkit', 9002, NULL, '2019-11-04 19:05:22', '2019-11-04 19:05:37'),
(30, NULL, 'customer', 'okema', NULL, NULL, '$2y$10$g//FN4pa/gvNRG/lNZtYK.jK67Rl2ASQC.21w7.Kch7hIanN52VyG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9662356898956', '0', '1', NULL, 0.00, '5D5jDFdKeW93ezjBGNaCT-291Ci93cagsPf0EqBoAmTR4Xu0vqQ8q', 'android', 'clQArxiFf6U:APA91bFCMe2F0D0CA8IL_gR8FFsjvxiwQXZCRiElQiBafDyZEpVKriMc4SfR7pZV_Ij1tcvqvWpEzoO71gZYAFiK2Mn_RWFb7ASqQuoWhWDjyFOofcqtODsrrazddF2cvxdGyaAgtkit', 2168, NULL, '2019-11-04 19:06:46', '2019-11-04 19:06:46'),
(31, NULL, 'customer', 'Bhavesh', NULL, NULL, '$2y$10$GBnTfp0o5MRfH/FeKDNByehPTlCrz3XhdQVO8TOLslIXbsu5U/RL2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9668080806040', '0', '1', NULL, 0.00, '57jhmIjJ6OkiPtE0xTEpG-B11c5DAjH7VIAzzuKLOm6VF7M12lqGF', 'android', 'dgy2RQCbrZg:APA91bGilFp7YntT84TuCvVBRo_YPcvEm8dC-kRBPoT-3eB-s8PSsDMrZ2ZJjMznTCOoSww3K-LE3r02AQMgwVw_4fpxjLNLrw7JxijPJiWc-E4RywAzU8rVhKo_0c2l_55aLyXFDx2n', 6788, NULL, '2019-11-05 12:16:12', '2019-11-05 12:16:12'),
(32, NULL, 'customer', 'qqq', NULL, NULL, '$2y$10$5BqEltYfntKnkUK2hcYYFe1ydpcShj2uKmygLCpfQ42HW972BlwR6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9664545454512', '0', '1', NULL, 0.00, '91EIE4vBO4jroGsHtircX-b1Hcjdg34bWUsTjYkKtx4YRZG4Mm9o6', 'android', 'cKJc0rScD5U:APA91bGv0zXUW5UKRTQYZRJ_KVk_5Iy1B_szEAjkxG0NV3Kt5Y9pnRT1Q-OVVX7Ph51XD4fSQ-jxXoPDV9ytm3YQ21_ow_losCedcb419W1tp_oHI0BLLLhNeRst4clmFkaTHhMCoOr7', 7539, NULL, '2019-11-05 13:44:21', '2019-11-05 13:44:21'),
(33, NULL, 'customer', 'Okema', NULL, NULL, '$2y$10$V/jwlKEMsdIbUcFtl4jfXeoR.BM5EfNVpPRUfUUS5Wpm5Fptb8bHy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9665461234567', '0', '1', NULL, 0.00, 'xvoE2oDUNi4ROiKhSiQir-bFh0JecceBLk9HsMxsPkCFGDven5vTn', 'android', 'cxho6WsjqVc:APA91bEASbwb4ZFKIORzTz49r6UieEf-wW2KZSmBKqUKuFL9cEHZpxh6PzR0ozmsmo3EQXeNkdy9qQ1SFfJhikRzJnQped8CUFFMQKupqLgh5Rk8I2u1EVfRrZuhlkhRDryYPQazcGnI', 6377, NULL, '2019-11-05 15:24:01', '2019-11-05 15:24:01'),
(34, NULL, 'customer', 'Okema', NULL, NULL, '$2y$10$xfvh3ul3UZn0aH/KvMXtCOHvlVD/vA2aTfIOrMmI3qGH3mjN4YqzS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9664612364890', '0', '1', NULL, 0.00, 'DpcAFfuDIc57Z3dzJLRnU-bFHcJe56G2AkPyU8oGHQaoJvGLCfeuF', 'android', 'cxho6WsjqVc:APA91bEASbwb4ZFKIORzTz49r6UieEf-wW2KZSmBKqUKuFL9cEHZpxh6PzR0ozmsmo3EQXeNkdy9qQ1SFfJhikRzJnQped8CUFFMQKupqLgh5Rk8I2u1EVfRrZuhlkhRDryYPQazcGnI', 5633, NULL, '2019-11-05 15:26:07', '2019-11-05 15:26:07'),
(35, NULL, 'customer', 'Haresh', NULL, NULL, '$2y$10$fNUEGFoyERW8v6Djy/Y5PusMYZGd42JZlwS7FyGDvJfBeq.1a0cSm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7574972644', '0', '1', NULL, 0.00, 'vUz9boddhDQUCKbSjpd5j-bfHd7GfiI4mscxJL4Oyxmpo36Oy8bCu', 'iphone', 'IPHONE6S', 1345, NULL, '2019-11-05 19:11:52', '2019-11-11 16:51:21'),
(36, NULL, 'customer', 'okema one', NULL, NULL, '$2y$10$ovaOu2MnHdEtQGyfBvjtCOSfw8YlAACH4ljZkx41r/8bm/wnW1Dua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966989898989', '0', '1', NULL, 0.00, 'DtTJOgeYhPQaAxzqJgln4-Bfh7abji3bXbcZyXJJXLEOPOoOiJR24', 'android', 'f30wo2WBbh4:APA91bFRMFMTv2pUm7cmkY6zSJ_pkNa56VlR92qoJjWZMjsin0cUjYygFYHdtBGer7JNNq1qJzUfsOYr9De_Hw9658EtDJWHCVSUZ21qijlZcOmXJwAQA1EJdWX5kaR0lhrZrMUEeaU_', 2234, NULL, '2019-11-06 12:57:11', '2019-11-06 12:57:25'),
(37, NULL, 'customer', 'okema one', 'ggg@gmail.com', NULL, '$2y$10$rsVgtkRDZhKQUPg1O8P/AOL4ZEM.GZtAqxGpiDw.wchkjJ5G6FKeK', NULL, NULL, 'null', 'ygf5f5ftctvt', NULL, NULL, NULL, '9669898989898', '0', '1', '1960-01-01', 0.00, 'G3LI7BS9bLMW1cEDGrsMn-bFh5fDEH0fmW0BTRQ9UMVA3nRw79Pjo', 'android', 'dqYJSxY2tow:APA91bENdF-Q9A6eKaguq7h9Tzjx22EVXRw_izciQ9pltKDXaqEuKUdHuTgMT1Ex2XZ4zJRDQFEltOL9afyCN0sXZGbju_uiRFYt8fkQeOPg-DsZRKfJoUGa55O7WysdRoqorVm1ICW1', 9516, NULL, '2019-11-06 12:58:35', '2019-11-12 11:59:15'),
(38, NULL, 'customer', 'rrrr', NULL, NULL, '$2y$10$Ei/0C.428kV8LTLYb71bK.3vhteXa7I.moy4KuNSJYIvEt55RGH8O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9665421326498', '0', '1', NULL, 0.00, 'zkOHFnD21Qfy8EvVaneDL-bFHD2dfedeQj1bPwIKk4T7WyTtqXJjm', 'android', 'eGFuE4s9kDE:APA91bF6aqqzgD7k_z6XUTZSm7HIwP1mHV6-ps_2xfTqPexvYNbL4bvKoiJRKwJuSusv9h38QxmJM0dN0Vd6lSlIWTlaEWRJ8N3qEkKWWRtjfUFtlVYBKN6A7uhUkcAYipLEgX2lTCCz', 2919, NULL, '2019-11-06 17:17:14', '2019-11-06 17:17:14'),
(39, NULL, 'customer', 'ututt', NULL, NULL, '$2y$10$htaOtbZOOsaYzw5ZRlo/Cub5/fpkqHyCJcTf49uSGsZvHtCThX3oe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9665858961973', '0', '1', NULL, 0.00, '65CQCmGY93hoAWKpUt9kS-b2hdAEaic8WxgqCPEh8qH8FVvnLq28H', 'android', 'cqeu_nXeN0c:APA91bEHYCPFdA5QYZGU2dbCrs0W790O2st05i3rmFmxFno0Hi4pfWGGlGXu3wy226DYp4dIwVHDk-oJYB9cZ3eikPSFN9_jvAWna4BDtLvXn0UVqst84qevgEvG1_LgHXVxUhhPejbO', 4168, NULL, '2019-11-06 18:47:08', '2019-11-06 18:47:08'),
(40, NULL, 'customer', 'Tolat', 'android1@mailinatyor.com', NULL, '$2y$10$k/u2hfAtrXJala0QkdDmTuzX/1yNwX2s0VDfehVVWE4WxGHA32TC.', NULL, NULL, 'null', NULL, NULL, NULL, NULL, '9665612453679', '0', '1', '1960-01-01', 0.00, 'jNHroJE2WE7nlHjy01ZKh-BF1D0eDh5j81fK4DayVYTpWh5FzqYBg', 'android', 'eSzIelbjbN0:APA91bGwYecwCy1CC6O0jKo2n8U_bBliFh_pKCbVR8QA3n2HQKWEjeMvFnt6qEe2tEfiB20FZCq3ivTOu29P94E_a-u3c5GHf3_UPfXhDHUNTMOvte9uBqE7min5uWdFFt3Qw_OU8XvD', 2391, NULL, '2019-11-06 19:35:59', '2019-11-07 11:02:30'),
(41, NULL, 'customer', 'tsgagsg', NULL, NULL, '$2y$10$hV3BqCXMq/bKThVTA36MNO3UAQ2zyH/nDQK8wVUhU1uS//nJeG.s2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9665421548798', '0', '1', NULL, 0.00, 'TJabYYHu5cCvyuWS6ZHr0-BfHdbce8CDaMK6Sfm0N1eGM4B5XhfRb', 'android', 'f--8I__mOsU:APA91bHXHc9HKR20Eobs9EmamoHAXLt4Cdn7K9RRngvyY107vnElmv88be7UpiGQ-5pERuJpoIImvsAJHQOXNiQ-2WkgUyXAYE9nTIZ8hs7XMu2tZLPISJYBx-1ftGnGMXUx2f44q6It', 6501, NULL, '2019-11-07 17:58:43', '2019-11-07 17:58:43'),
(42, NULL, 'customer', 'ashraf Abdulraheem', NULL, NULL, '$2y$10$5AaJe6A50j8B08fVflrlIO9SCuKbvEgfZ4v1g33c8aW93AiE7Lroi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966966556219146', '0', '1', NULL, 0.00, '1xiDXkmqjO4BU8i9nrwdJ-40hDccfJI3zDZ9uWcsS8q1tsz8CqmoH', 'android', 'ci-dzSMTJdM:APA91bFYqhJWy9EoHwnrDPHdJxMw5UnU-yinRBR6NOWQG1uIZLkR_Vd70ZSyLAyypZHDxSLLUmkGmSk1a7WlVgHZ9T4y2lPtdgCBK3uDs18BuV1kHG1nDK35_WPZoY844MWMCTYeW7lG', 2516, NULL, '2019-11-08 22:13:01', '2019-11-08 22:13:01'),
(43, NULL, 'customer', 'ashraf almashhari', NULL, NULL, '$2y$10$ep3eYZ0aQoO0eOi8/YfK0.WoZ5F.sYFIRgTUKJv6RDfMmldVNDWs2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966556219146', '0', '1', NULL, 0.00, 'ULkTtYPfAkEYtsIeZplOR-bfhdCcgCBDjifrAUEaDpgqsUrfZEjQz', 'android', 'ci-dzSMTJdM:APA91bFYqhJWy9EoHwnrDPHdJxMw5UnU-yinRBR6NOWQG1uIZLkR_Vd70ZSyLAyypZHDxSLLUmkGmSk1a7WlVgHZ9T4y2lPtdgCBK3uDs18BuV1kHG1nDK35_WPZoY844MWMCTYeW7lG', 3839, NULL, '2019-11-08 22:16:53', '2019-11-08 22:16:53'),
(44, NULL, 'customer', 'ashraf almashhari', NULL, NULL, '$2y$10$yqSYatS.GFGLTxK.nNbi0enbUMxU0/31176fkfBpo7jFOD8XVTYCe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966+966556219146', '0', '1', NULL, 0.00, '26O4ceYr7lM5t5lYWXIFA-BfHdCcg8dCPLMiXSh65YjbP0KDMlIfR', 'android', 'ci-dzSMTJdM:APA91bFYqhJWy9EoHwnrDPHdJxMw5UnU-yinRBR6NOWQG1uIZLkR_Vd70ZSyLAyypZHDxSLLUmkGmSk1a7WlVgHZ9T4y2lPtdgCBK3uDs18BuV1kHG1nDK35_WPZoY844MWMCTYeW7lG', 6823, NULL, '2019-11-08 22:17:12', '2019-11-08 22:17:12'),
(45, NULL, 'customer', 'saber', NULL, NULL, '$2y$10$IyqfFQ7DPaW.X1oyllcie.9medTTYzhf3cRIgCQlmVRd.XvI2ytoS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966966500250471', '0', '1', NULL, 0.00, 'BqqjUQx9vwrbMFlMLds3w-BFh7cc9igJ2XY3uimEHDAS9UaVUeRVN', 'android', 'dtoxTvdcWXY:APA91bHL3fCr67i9ADK80SR-OWolNTp6JgOGXM7vWtpdZw-_RKQwbMvThL4RJkhgKubXqOT-XsXkLv5WNKWkNgzvrvQeiOsPbk7af0VcWyGcGClLdRLD6ENYOxL5Xd_cIiY-er1eKEaj', 3322, NULL, '2019-11-08 22:26:06', '2019-11-08 22:27:49'),
(46, NULL, 'customer', 'viven', 'vin31@gmail.com', NULL, '$2y$10$OH0fMNMwcJbvDuGa1KqLJOEV03g5M0ZmV1UcOVR/HvDxRxn/g4kea', NULL, NULL, 'uploads/profiles/LUmrOr0VkkQzWjpfJXhTqsBTrZNsJrvLfA76gK26.jpeg', NULL, NULL, NULL, NULL, '966572516916', '0', '1', '1988-08-14', 0.00, 'KgJLnYlC4YS0R8ZKyqH68-bF250dEb3EkBI2qnnAC0FgIhAaPP1dQ', 'iphone', 'e0GDBjw7y4k:APA91bFxDRllBxR2eSV5yRrc2j1MuXyUakoJxU8dZp6d-PhZ5Iih2lzhz0HBSZ005itOFzNh6Pqw1cZ0abOqlB3hMk7mbgZAVyOKhztaIsvv3J4YhivHU5DL0gYPV9gaS6V7mXNoTETV', 3937, NULL, '2019-11-09 13:32:37', '2019-12-12 14:02:24'),
(47, NULL, 'customer', 'okema', 'ddd@gmail.com', NULL, '$2y$10$YSGkRqYrhqOSux/fsPeUUOPMhhSmzaY26tz/wkZEEb0Bo8RUlI/dK', NULL, NULL, 'uploads/profiles/TOdrG7laMz1DziqRoNSuq6SBxy6xiTz0RQmEXQMe.jpeg', NULL, NULL, NULL, NULL, '966999999999', '0', '1', '2002-11-09', 0.00, 'v60t3iQwIdgrHBjxjykFb-34hdc6I679FUVR1drT84MRYLARNtsOs', 'iphone', 'N/A', 8615, NULL, '2019-11-09 18:00:21', '2019-11-09 18:27:57'),
(48, NULL, 'customer', 'ghaghara', NULL, NULL, '$2y$10$0ji.Jp.SIlIoDlyVRhtHGuAiQ7ccy9WFSP7Umr8GB5/G7g4paYXo.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966887545978', '0', '1', NULL, 0.00, '1GhaI0LjIcSGjRUVewLlI-BFhddA90ebcG11VX2QNGAtvbHEUE1dK', 'iphone', 'N/A', 8354, NULL, '2019-11-09 19:40:41', '2019-11-09 19:40:41'),
(49, NULL, 'customer', 'Haresh', NULL, NULL, '$2y$10$gYKgNs0Bgm8CZXrbZZWKceZmkiRb3QA6XqcOpBfU9AsHa8B66GS3O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9033601405', '0', '1', NULL, 0.00, '3CMBMJrQGDjs1mL41ROmF-6f192g7d6FMNknRPnrKQf2iyaCxCvUp', 'iphone', 'IPHONE6S', 5825, NULL, '2019-11-11 16:51:51', '2019-11-11 16:58:41'),
(50, NULL, 'customer', 'okema two', NULL, NULL, '$2y$10$cNBn2nlnQr2dObXImCS1FuTE8MhQNHcnl97nhsr.uG27KN1XrAYzq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '999999999', '0', '1', NULL, 0.00, 'weahTqDVAtoA3gtGseK0w-3F66f6CeacFdvPZvF9Mj7wELukw5Rpd', 'iphone', 'N/A', 4602, NULL, '2019-11-12 11:17:18', '2019-11-12 11:20:32'),
(51, NULL, 'customer', 'okema two', NULL, NULL, '$2y$10$Al6eZ0rLSPjd7TnayvV9ROcFyv2F10H9B7NgocKa2cK8u.lctsjYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '522028288', '0', '1', NULL, 0.00, 'E774mIsyhQl7jNhCtYHyR-BFHDfd2dC9ccQV995c5omy0jaAtnR4g', 'iphone', 'N/A', 8052, NULL, '2019-11-12 11:18:41', '2019-11-12 11:18:41'),
(52, NULL, 'customer', 'asfdsf', 'ttt@gmail.com', '2019-11-22 17:46:59', '$2y$10$mFsevQvBt3ECgWsPhLplded3rWbs.do58Zf.Tnfl8cW.sygY2hi3K', 'kJoOuzEgFNyaZsmgRnwTdKNhcrkwG2Oc6QmJecyi95Nlb5r9mAzKGoDLsuCK', NULL, 'uploads/profiles/XTFzdVgqzJrNHv5UYxuUAhe0II2wJJXoHfpG2wjk.jpeg', NULL, NULL, NULL, NULL, '888888887', '0', '2', '1990-11-12', 0.00, 'ShMZ2VqZy2nn3uqGYX12F-BfhdfdD86CCxeYAKwElRv08gHtdDQFO', 'iphone', 'N/A', 2165, '2019-11-22 17:44:08', '2019-11-12 11:21:39', '2019-11-22 17:50:54'),
(53, NULL, 'customer', 'wwww', NULL, NULL, '$2y$10$.x3od1envBRT.1IyD787ZeZP7ivYEMjOKEK8nwerQ8c6NNm8iJVUq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966574512326', '0', '1', NULL, 0.00, 'RxBu1zq9tjVdahjPlTkSb-bFhdf6ehggvfZGDLvPCmWC7JIUZtyMO', 'android', 'czmEA1gTcX0:APA91bE0Wmx6eoGNdfzZ41qBi64KL6pRdytUHnwbs0UZ0rcGhVP1krSqhPYp42Twml8iOzZaHTThg2WKX4FruJBGmNviyqBbtxQTTxB9wuTH12gmlLXAbXYwk3WVTVIlvnC0_5KQx46F', 5472, NULL, '2019-11-12 11:59:26', '2019-11-12 11:59:45'),
(54, NULL, 'customer', 'vines', NULL, NULL, '$2y$10$RUCA69cOlnRqKVBpIToQtu8OlEApHAaeX1akxJ9vXpm/kGnl3kNgy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '562516916', '0', '1', NULL, 0.00, 'L7zlurrJytwETkTNpsKPC-Bfhd13ida1Zt2JafBbNbDIwDdOePC2p', 'iphone', 'N/A', 6424, NULL, '2019-11-16 11:25:07', '2019-11-16 11:25:07'),
(55, NULL, 'customer', 'vinen', NULL, NULL, '$2y$10$FpOLvBFyFuzESk54cG3VHuP75/urYQyeuvPMNTQCVczX59Zr7ngBG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '572516961', '0', '1', NULL, 0.00, '3TzsBkdJtEa1QWCEAOVNn-bFH0agIAcbG23HOgHnpQFOKdH2EBbyz', 'iphone', 'eLr7WzfbpOk:APA91bHekL18uet5mJBp_bVFO2oLV5r2_EuJTrHbGFVlMlFnSIgTuLQEjhXjmODfNj-v6PB8CVx_pg18ECduO-XJqiqv-8uG_TxBccfn_WWlHCr9mDGc-0OcQHwQp95hXan43YKpTrHP', 3375, NULL, '2019-11-18 16:07:01', '2019-11-18 16:07:01'),
(56, NULL, 'customer', 'tttt', NULL, NULL, '$2y$10$WLUOgSIMp/7fX1Ei7BUsquq21w0LSghwD2o/eaXdJ9h/6vfUx1zYy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9662525252525', '0', '1', NULL, 0.00, 'frOPqmCTPHWnAxKSIoEn7-b8h7eaeige2v56dtWzDpnszmK43ukjL', 'android', 'd91R-knmcf0:APA91bERqFpTiP_ZwKyidVUAaWorqv6xWuXUSK8yOwr_tvIoJkEVOWuc_gBWN3JOC02gKqJfPTvbWV9395ZqN6OWUNx1-B6d8wIopKR7OxxSkY14JDlwqxrYbi3ajqgy6N3OIlYbOjsE', 5223, NULL, '2019-11-22 13:41:04', '2019-11-22 13:41:04'),
(57, NULL, 'customer', 'dsgfdsf', NULL, '2019-11-22 17:30:19', '$2y$10$H2QOyaiIK5D6p/yufHCN7.Vrd5b/71rRkNQ7XwGoUjJPSHToY2iZ.', 'j6P88U3ynVgqRUbrz25U6cHMEHA4NTd5O11o76K0ikHaFKX7vLjZjZjb7X4S', NULL, NULL, NULL, NULL, NULL, NULL, '123456789', '0', '1', NULL, 0.00, '', 'android', '', 2773, '2019-11-22 17:30:20', '2019-11-22 17:13:59', '2019-11-22 17:30:26'),
(58, NULL, 'customer', 'dfedsf', NULL, '2019-11-22 17:21:39', '$2y$10$sJ5KE4RuRGKVGmrLQpeEoO52DcRZu15R0fWoRN3f5ao.wD5ZvvluK', 'F54g872sDKreFC91LII4hKHkamjpYqaOldDfnegTsvRnOIBV2EVu6ybrWQ63', NULL, NULL, NULL, NULL, NULL, NULL, '888888889', '0', '1', NULL, 0.00, '', 'android', '', 8613, '2019-11-22 17:22:29', '2019-11-22 17:21:30', '2019-11-22 17:22:35'),
(59, NULL, 'customer', 'Haresh Narola', NULL, '2019-11-25 12:42:36', '$2y$10$fT92i0tIyrcrW9SpynYrGekCipZOROO8Z3unDQix98MvV63dpbHFW', '8SYuegtHN6E7kYa2T0nYXN98Vntne01ybd9bMCsUHPmUWyig4gtCrZATzRCp', NULL, NULL, NULL, NULL, NULL, NULL, '987654321', '1', '1', NULL, 0.00, '', 'android', '', 5458, '2019-11-25 12:42:37', '2019-11-22 17:46:41', '2019-11-25 12:42:37'),
(60, NULL, 'customer', 'test', NULL, '2019-11-25 13:56:48', '$2y$10$b93QxKKusPdR78vhWauK0.YU9Jp6br82Lzb6HZ711Yfn2bA9Dbtm2', '8dsJ0Y0qs0mIWEyRJeVBXQgYOFo2GVYZvMw8mv10CA6CbB8vir69TRSn7S8p', NULL, NULL, NULL, NULL, NULL, NULL, '888888888', '1', '1', NULL, 0.00, '', 'android', '', 8728, '2019-11-25 13:56:48', '2019-11-22 17:51:10', '2019-11-25 13:56:48'),
(61, NULL, 'customer', 'dasfds', NULL, '2019-11-22 18:17:24', '$2y$10$96GdhBofbMsM2zjPDRDjaOFYAn3QPgF1T8rw0pKDWKvusAG.g.BZy', 'MwoLfkvelQn3bR6BFasdx0gmyQgczbp2GTkD02Pkwx3EeuWaHCNAer4pCmuA', NULL, NULL, NULL, NULL, NULL, NULL, '111111111', '0', '1', NULL, 0.00, '', 'android', '', 7622, '2019-11-22 18:17:25', '2019-11-22 18:16:41', '2019-11-22 18:17:30'),
(62, NULL, 'customer', 'Haresh Narola', NULL, '2019-11-22 18:17:58', '$2y$10$lPiYrCpRxEkPGF0JDsJs8.gPUdK8HkJJ5nHi1i6AeTpaGDyk8VMnq', 'xxIqw4SvRdNTs99Gal3SlDSdr19prlMWkFTj04uUKzkjVlOikcmro4esaApe', NULL, NULL, NULL, NULL, NULL, NULL, '222222222', '0', '1', NULL, 0.00, '', 'android', '', 9861, '2019-11-22 18:18:00', '2019-11-22 18:17:50', '2019-11-22 18:18:07'),
(63, NULL, 'customer', 'asfasf', NULL, '2019-11-22 18:19:03', '$2y$10$6dpmmjPXqlmwWGC/aTNrO.cplDr0leDDNnX4pANBlGvACKU.S2iBK', '7YoQQmIyO6ozmob8vqqUDgH9HmmrRbvuoexGeiis89p5y40ObX77mUg1GYJU', NULL, NULL, NULL, NULL, NULL, NULL, '333333333', '0', '1', NULL, 0.00, '', 'android', '', 1119, '2019-11-22 18:19:04', '2019-11-22 18:18:54', '2019-11-22 18:19:17'),
(64, NULL, 'customer', 'Nike', NULL, '2019-11-25 13:21:53', '$2y$10$.H87o8kN74RTvT72qVjEh.Gjv9Q.f5Dq8qGThUvggONc4bhl5MDuC', '93k743SXTKMVkSLVJe3qRlIlNdKqnCFnyNwG1SVxOJzhaQyXdMqrmoGGXCCy', NULL, NULL, NULL, NULL, NULL, NULL, '666666666', '0', '1', NULL, 0.00, '', 'android', '', 1461, '2019-11-25 13:21:54', '2019-11-25 13:21:41', '2019-11-25 13:27:43'),
(65, NULL, 'customer', 'test', 'rrr@gmail.com', NULL, '$2y$10$75ro8U3wIouxrFI0a3wTROe4Eo2IJgH2z7Mu2mLlVQfpkvLLpQZTG', NULL, NULL, 'uploads/profiles/53dcRpoGhPsTd1Ir20SQKGBax6j0DOuYQ8oTUJOk.jpeg', NULL, NULL, NULL, NULL, '966555555555', '0', '2', '1994-11-19', 0.00, 'Asrz5m2gISOfPMhBY5lZr-b494jC15g3xVgP4kKgHj7I1Rqfr38hZ', 'iphone', 'cms4uEn9w9o:APA91bFduSj4MC_TpTfWoCiqf374zxYRjZUXxFddOC-SmBThnxR9zu-Y_c382kiQT2V6z0_8amCbbzumN5Q7V6DCRavEP18CxGygvsfvOuAAj348xrR6XOMyUdcET77wE_b20Ugp2vqp', 9417, NULL, '2019-11-27 11:27:15', '2019-11-28 14:24:29'),
(66, NULL, 'customer', 'ghhgg', NULL, NULL, '$2y$10$TydXpmULdwBBUQTvQSdFXOCiFG5HoiwnztS/iWUxoFJbPUac1yWeG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966523568956', '0', '1', NULL, 0.00, '3Ev3dyr2428lHAkxXMmt9-b8h5i4jb5Fluuao65TVDZ5tc0fPC4Ek', 'iphone', 'ceMZZy2ScF4:APA91bGO2kWTMI7NGonReFNLbNW5WXtK41Yk4-1mjAahWR1-dt9wGTPXqoaAGBdAGsw78Kx2DFY8_-9OW23fIqaIPZOHVlBF1p_9GCkcDqnhBf-8NH-aE_6M3lqi02LQhTwbz0BBhPIx', 5722, NULL, '2019-11-27 14:18:45', '2019-11-27 14:18:45'),
(67, NULL, 'customer', 'Heda', NULL, NULL, '$2y$10$LbuFWAagEe7oQiIKaALDT.TuNbrblKPjhOPvt9sQLnwAoDOIyhO5i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512345678', '0', '1', NULL, 0.00, 'JHppXDVHi5ZVeWh78zSUQ-10h84e9iJboAyA5H0g2ByyDCBJWA70r', 'android', 'cQAD0b8ktlk:APA91bG7it5J0_f_pkW2Fpg1pgMoXSDq04GRHzJ8MJamp4OlcXmtPcWh-A99GO3X-ITLHHINZ-2TtZHYlSKlncOG9yt8dFzCukPpKLpLm0Q44IheOFBgww4omo4gIYJIB-ki99UP5C-w', 6004, NULL, '2019-11-27 14:21:37', '2019-11-28 18:34:51'),
(68, NULL, 'customer', 'so', NULL, NULL, '$2y$10$LIr1C4Ddb.KaZ4GDPD.JhurjaQMl3coa.6the.8j3Q4EXlc0RC.RC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966550123456', '0', '1', NULL, 0.00, 'GmkSJBHCMFdUhDvRQR5Ly-b40eIE6djGOV8soQjUOjOYYZbcM5QL8', 'android', 'fqXRNxT1hTA:APA91bE7RaNp9ucKFozDKEnaAUxfrFejVnGaqagryc3TjKfMrYY7DSSmdSp6AhrmRhgNZ3cEoXXLFJQpNFA3QIZ-GSm8Q5Kxz3V-5ngA-BvEAlRhO7p7F_swccQ9HPuuLrrFgzNOvgW5', 6397, NULL, '2019-11-27 16:19:56', '2019-11-27 16:19:56'),
(69, NULL, 'customer', 'vinen', NULL, NULL, '$2y$10$wDbbxrW3kNu56stu6UTRHuDiHz1Gur.I64RK2Q9VO1iY5thI61nNa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966505875552', '0', '1', NULL, 0.00, 'OB8Xf8aiOPeOVuPpaknun-BfhEiegjDcHpcVTGWpGePOkDEPWNgv3', 'android', 'c0Hw_unDNMA:APA91bFjw3WZqVdnH9QiM8Jnwfq1SsxKiB9ftvJtvxETuCtlWXwAFHXoUoqtWhkrWhyjATje2nhRR8YFsXZzgKXj8LcZJNt0PWB8PyDxVrDuvO42m2UfZCx97SLkiNcW3NHbDfns8ufY', 7502, NULL, '2019-11-27 16:28:52', '2019-11-27 16:28:52'),
(70, NULL, 'customer', 'vinen', NULL, NULL, '$2y$10$7/BlAVbZVrOfmp8IxS9CeO6eHABuWDvyCZgBOqBkmLcvHDLj1QTqi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966505875552', '0', '1', NULL, 0.00, 'a8lUjdomdT15j2bNwtgYj-bFhe14g8d8FcxB8K2ZfESrJQtd98aW0', 'android', 'c0Hw_unDNMA:APA91bFjw3WZqVdnH9QiM8Jnwfq1SsxKiB9ftvJtvxETuCtlWXwAFHXoUoqtWhkrWhyjATje2nhRR8YFsXZzgKXj8LcZJNt0PWB8PyDxVrDuvO42m2UfZCx97SLkiNcW3NHbDfns8ufY', 9463, NULL, '2019-11-27 16:28:53', '2019-11-27 16:28:53'),
(71, NULL, 'customer', 'sdh', NULL, NULL, '$2y$10$jMwpDUq/iT6xIg19mO1g4eOUPTpsg2tc2/UT5Aw9bUYxCwHkECHSa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512456789', '0', '1', NULL, 0.00, 'I4Pk2TEg1DaFMD4rgVfsA-bfHE01HcIArxoZEiYtHXRPMkczJ8cnt', 'android', 'c0Hw_unDNMA:APA91bFjw3WZqVdnH9QiM8Jnwfq1SsxKiB9ftvJtvxETuCtlWXwAFHXoUoqtWhkrWhyjATje2nhRR8YFsXZzgKXj8LcZJNt0PWB8PyDxVrDuvO42m2UfZCx97SLkiNcW3NHbDfns8ufY', 3410, NULL, '2019-11-27 16:34:40', '2019-11-27 16:34:40'),
(72, NULL, 'customer', 'yyyg', NULL, NULL, '$2y$10$6kEN6lWdICdAyARlv3GWyuzrXG99K7a1ZAdXe5GyBJ0D44T/ZhQIa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966525802580', '0', '1', NULL, 0.00, 'QwgG7VLydVSGFzLT9M544-bfh5I12Dbb5RClLM4OI92pKcAiswuO9', 'android', 'eIb9TIxUTtQ:APA91bEj4o6a-f2yrs5dHEgI0PX9YbmBSL6Uip_aVfyXDLQL2gjqg1Gri-eT3OTmCgpsbqDclRw3ftsFIPBhyKJEUIr_JxPgrVVIQhyR5HY95Pmqt2HcHQOJhBN3ElCP-Lm13m7DgCKF', 2696, NULL, '2019-11-27 18:15:11', '2019-11-27 18:15:11'),
(73, NULL, 'customer', 'yyy', NULL, NULL, '$2y$10$yxd2cf0wnLch2nG8aJ/NLuVMLmEZ2YFQRYbxsvKBr2Mys7v01qm3.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966525252525', '0', '1', NULL, 0.00, 'NrEh8SCAnDOCnlVjVmojT-bfHeIFfC1AKll2f5xAlGPPA4pyFi7X7', 'android', 'eilp4vU2Brk:APA91bEMV4qncDkCGtv_JWkahFy9dfL3TcGc3w5hWZBNyomBGC3ZbpzHMiKbOPyBw-IUbpOf5luIGFK8sbJlYP8ygFmJfTzEYew65Fg8RsBKbe5b5gHnmC2qZwL82GlfhKYcRtv62W0q', 5055, NULL, '2019-11-27 18:46:57', '2019-11-27 18:47:00'),
(74, NULL, 'customer', '6yyy', NULL, NULL, '$2y$10$Y5c085rB.gbQxZKLygS9pePsk2kAQWig1FbdLQVL8LKP390SfE9am', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966525253625', '0', '1', NULL, 0.00, 'xcOpfVFzBbBYbEITIDKGk-bf9e05fCiehUkSmtuM3nWocMOwH8iD9', 'android', 'eilp4vU2Brk:APA91bEMV4qncDkCGtv_JWkahFy9dfL3TcGc3w5hWZBNyomBGC3ZbpzHMiKbOPyBw-IUbpOf5luIGFK8sbJlYP8ygFmJfTzEYew65Fg8RsBKbe5b5gHnmC2qZwL82GlfhKYcRtv62W0q', 6768, NULL, '2019-11-27 18:48:04', '2019-11-27 18:48:04'),
(75, NULL, 'customer', 'vinen', NULL, NULL, '$2y$10$5Xy6SUrl2IIvJPYWvz6U5.ggrXIKqxHiUaZ3BPs9ORyy.KSNAi4s.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966572516961', '0', '1', NULL, 0.00, 'xvsUwiqvpbaT1QYTJXOjj-bf7e8ffeb7GS440siPdyXP3Ls0odjPm', 'iphone', 'd4c-MfBsip4:APA91bHHWU8ODUaDI6bMbau0tluucZrUCHqyvs1RN7DipRlZaJLr6_KQwS72IHCpamp6jRSKh73G_4fcNklfNKDAIhQLSew1dKHkF9TrLiK96XM03njsH-XKy_7HLETaY3fOn5zuc37b', 7997, NULL, '2019-11-27 18:50:19', '2019-11-27 18:50:19'),
(76, NULL, 'customer', 'yyyy', NULL, NULL, '$2y$10$/cz/6qHTNQxY8cmUJLY8d.WA/YjzC3Vakvz0kNLl6kmJWSf75GtnG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966580808080', '0', '1', NULL, 0.00, 'CDSKapTs50wy0imXfVkE7-786eifFFcGFxzL0LVgrXAc9IhbA2Vyb', 'android', 'cwIepVMsonM:APA91bEgzGd5BWbDXt1JVmAq1ijJvbcUH7e5j4ysSKwPt0MIkF0PG94o7CWSL4iB3jjjWo9KFcZReWFlcNq8zRZa0fBgkitoLhZ-ce-5WWF-HPQ38RWpbSsFQHlq1yaRHH6ELvih5852', 3026, NULL, '2019-11-27 18:52:06', '2019-11-27 18:52:06'),
(77, NULL, 'customer', 'hhhh', NULL, NULL, '$2y$10$8FzYHAw/Iol7t6jj8EpZOuqcmIRajQUPeWISpwqsIFi0vUAWjY/ly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966521451253', '0', '1', NULL, 0.00, 'FjrDFKmr4zT1wd0PXsYum-bf7ejB8FaBRcC7e8hCyl9AYEH3te7wD', 'android', 'eKjO49tsC34:APA91bGS9Zh-muoTq9JunQEpy5D_PkSAki-Z90fcMuEWpwTNgufCjPugisJs1MixaT0lwdzlGOhCI2o4JKAxZdtCCW4TDEaElCJ6kH5ZwpMWoy-oXGIk4uPxTRRu9O_lUpEGWjDHH8rc', 5708, NULL, '2019-11-28 12:05:01', '2019-11-28 12:05:01'),
(78, NULL, 'customer', 'bad SG', NULL, NULL, '$2y$10$9Rre2FT/q0BgkkJk.y6YX.ySCET.G11b6toKHXhX24QK1/DqToC7u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512356789', '0', '1', NULL, 0.00, 'pnlurAYUw8HRYV4YMTped-bfHeJdb926wDCPbEsTFGx9oQKyxDsQF', 'android', 'eu5EfI1NL6s:APA91bG1nHHjvSaEReXUArtSbr9aefO391yIjDUvTtJgH784GWGkR_fbSPEbH1TdxddXZ72NHpR4TEP5omAvFzTw4-J0NARG1BKRGjQnDSV8Fpwt5CJZph_USrilJOlM6_i0tvH4G67x', 1854, NULL, '2019-11-28 15:53:55', '2019-11-28 15:53:55'),
(79, NULL, 'customer', 'bad SG', NULL, NULL, '$2y$10$s2pi.4p4S85j1pYb3QSX.ee4hs0HedR5zE3Ei7VeqxZYkpwN8lISe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512356789', '0', '1', NULL, 0.00, 'FgI4feGQRNWs86Eu7O07T-174EjdbcD8tSAk1HVLBVvJbhYyFuExg', 'android', 'eu5EfI1NL6s:APA91bG1nHHjvSaEReXUArtSbr9aefO391yIjDUvTtJgH784GWGkR_fbSPEbH1TdxddXZ72NHpR4TEP5omAvFzTw4-J0NARG1BKRGjQnDSV8Fpwt5CJZph_USrilJOlM6_i0tvH4G67x', 8423, NULL, '2019-11-28 15:53:55', '2019-11-28 15:53:55'),
(80, NULL, 'customer', 'guuh', NULL, NULL, '$2y$10$MbtFVHEYUnkk9XH7.3g4quEOzZMxuNa9Cex0YZ7L6UdgfKNtA0J26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966523568978', '0', '1', NULL, 0.00, 'eETgbwPMiaB25WoKlRyYf-bfHf5Dd9bhBWc0z57YauT2yGsuDqs3n', 'android', 'c_kd5mzvbRA:APA91bFFipwdSUR-7D_I_LqX5puaO0e0XoapseShKRHO1JsPMbW3g7bWEop_mYn7NmzjnqoID4LWFmPGc2P6NtTW_swfcLj5oygVlaD82OyS3qWkR_ZKeDnsgGctiwnawANSNzP8A7Ea', 1492, NULL, '2019-12-06 18:58:37', '2019-12-06 18:58:37'),
(81, NULL, 'customer', 'wafaa alharby', NULL, '2019-12-08 13:30:39', '$2y$10$sMU.NC3CMkEA4/bJhKxF4Ob0IKIywFat1FSI7r/aYlOpiQC/j7dRS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '174802977', '1', '1', NULL, 0.00, '', 'android', '', 9999, '2019-12-08 13:30:40', '2019-12-08 13:29:14', '2019-12-08 13:30:40'),
(82, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$v41X8paIjwkCVwVkrRu.kOd/OMLPYay07l6GqJnvnKwQA9mP7F4sm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966525825825', '0', '1', NULL, 0.00, 'upqf1mBllahaYt3oO1EI3-BfhFiGHJEd5jhBuLKPexJmP5UkTPoF7', 'android', 'cdgPlHWKRP8:APA91bGsAxzechcWYmpeLgQJC-mZ8MbRhM_vA42L_-5QHTk9j93m1iYVpBGk-mzG-J6VOrBKcADAd9neMFkq6fgf6aNKlZ9_NkR86PUaiF_XKbExJAzN7mlS6-o8tdpqT3fDerCKlGbQ', 5254, NULL, '2019-12-09 12:05:43', '2019-12-09 12:05:43'),
(83, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$MtHnFsl9x11heoyH9gZIYOt/pn2U3XonXo5.79c0OqxWYvCxHiIz2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966514785236', '0', '1', NULL, 0.00, 'jZjWaoXrquZvI9Q5zmqNo-bFHf9g3CibxAMMWR0njbbzJxpuTOLyu', 'android', 'eMjqASK6Cdg:APA91bG-uPWPyKeIveSgXwyBwAsZx7ie0Woo4aWkoVmursFY0mYRty71vA8OuWbgfftd48xQvzwvC7QZnYKjpSWOLyMrTWydg8aFN16t8hvLb9chnbLY23lChjCaIrD391oARi3SmwBu', 7312, NULL, '2019-12-09 12:11:21', '2019-12-09 12:11:21'),
(84, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$VoAFzb/6Z8OTogqde/cc3OdmwINv8G8dy4ZjyeM1wpx8hjl4iDr.K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966589562323', '0', '1', NULL, 0.00, '9O7ueCKTqnVGHYLzAuCCy-6fHfii8if0rTj6HGHiKTBuKLmMhwtJm', 'android', 'cwW9xfqs0cc:APA91bGbS1PS2MEVecpL-DfEjVrFOf0qkW6NdLMmrd_7QLPhBMa5vhH-vU7Cc7p3U4_xUmOFRP-KXQfuyUk2nPIOHJog7TIE3CJQlJHZSgBHn8rHBRNblNbpxsvMMd54gojRQsoFBNR2', 6871, NULL, '2019-12-09 12:17:26', '2019-12-09 17:20:58'),
(85, NULL, 'customer', 'هاريش نارولا', NULL, '2019-12-10 16:35:43', '$2y$10$hma851CsonGat.CyepQybegCRsmlFTLBC93qeoqr9vDpPi35orskS', 'HGhVKu6T3AzdH5u3FXdclgLDrNK6gRoevU1IZFaiGeLJ39wHUaC1OeY0hvui', NULL, NULL, NULL, NULL, NULL, NULL, '231123832', '0', '1', NULL, 0.00, '', 'android', '', 8332, '2019-12-10 16:35:44', '2019-12-09 17:20:58', '2019-12-10 16:35:49'),
(86, NULL, 'customer', 'حارس', NULL, NULL, '$2y$10$/c3QXIKkXZqkRH1QqUxFzukUik9o2LSVJahkstY31SQtNgeEePC3m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966589656321', '0', '1', NULL, 0.00, 'BYmyKONv9AxA1MzPpnRmt-bf3FIi52Bg6kCDbVzq7d9QlikVddpOR', 'iphone', 'IPHONE6S', 6242, NULL, '2019-12-09 17:49:52', '2019-12-09 17:50:16'),
(87, NULL, 'customer', 'هاريش نارولا', NULL, '2019-12-10 16:36:49', '$2y$10$PBmnJMJK/GtcG0.jnV.71ewitUCDfAGr0oY8vE74tgaO4ntQxOTTS', '4NiyvqMoiRGhrJfP0859IFRoChqrhwLhaIVHsXPoVuTpUo3hZaTw0rJy68ts', NULL, NULL, NULL, NULL, NULL, NULL, '222142923', '0', '1', NULL, 0.00, '', 'android', '', 9386, '2019-12-10 16:36:50', '2019-12-10 16:36:38', '2019-12-10 16:37:24'),
(88, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$gEflcvk8b4f0L4xiHh6XZ.LveLQUdWG8OUa5fImcJL3eE4y6pPrbu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512356895', '0', '1', NULL, 0.00, 'wEudQH0bYKdzFC8jDjkd2-bfh83D4DaiMv7Uh2neu6CH3yDsyTAsc', 'android', 'c-1wnYPJUJg:APA91bE5o_c_VR6VG_6DIBTOjnLD-iS45R0mhxC5hDCMpyFcFdD5j-2XnWT0hxOSSrOZri0ikW890DDYjJHYb1_wE5zBDP6oEPhnINOHhXSZUT1WFW2hZ7hqfwIpbp_7hq2_u6f9oSE6', 1377, NULL, '2019-12-13 17:21:46', '2019-12-13 17:35:08'),
(89, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$1vKJ66fzXxsSgDtYQRqkEOnnC4vOGVB64EcuCV1EhmqOK.cLu9TL2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966523895147', '0', '1', NULL, 0.00, 'VT648kL8JWtCi9Q3ahKjn-BfhgC34ff2mOIcJzEJHmzGOIaKJmslA', 'android', 'dsifQ2iL9eM:APA91bGP6p3VDCtmVKoJ_ldcep_2IQtreczPT5mak4jZ3NPn2xRFn4GfsAollhR-1MebYCIlw-v4FUvv1cB2e3Fak7GtwPtFRniGgHdPQheWYRglNiT9gf_K1QcVdbgoAL2arzB4cmii', 6159, NULL, '2019-12-13 17:55:55', '2019-12-13 17:55:55'),
(90, NULL, 'customer', 'بافيش', NULL, NULL, '$2y$10$Bh9a7zgEkd5mpX3dkqJ9SOc.NeRiu2RZMFsxEaMzGh.1QM0Mj1/ye', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966512346788', '0', '1', NULL, 0.00, 'G2egWOA51vcMYPs5yEmeB-B09G1Dj9aBpt9Gfq7q64Mvm2kzfUXcC', 'android', 'fgcOw0RxHPw:APA91bE7coWfEREtvUxOyV5RbOuPSZmmTqEVt0BTyxzeLZEALB1jfbkrgp36mN_yX9CFmmfE57PUlv9_s-glHVqyBW-TPeEXWuuYxAaaegwSgp07lx4d60IAftaOcU_AoGU4IufA8fD_', 5828, NULL, '2019-12-13 19:18:21', '2019-12-13 19:18:21'),
(91, NULL, 'customer', 'mohammed zaid', NULL, NULL, '$2y$10$dq8Eo5IntwONXSoGC31ejeMSRoQMWHYuedTItb6.98YXnMRn1CAM2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '966552153306', '0', '1', NULL, 0.00, 'HRS2T0ALQ3N6dIHZ8UAzM-BfhG2Hb4CeyBvcY0nL9PrWRcpyfoUGe', 'iphone', 'd7YF8fwZZT8:APA91bGQRT30Igus832AXO9VioaVqLBcN8YXd4m_0Xn4uHBEtowjlsGuHfHSVshLuiI1qfZXpGG95KNlbsPesn0aIi-RTsgBz5a00TH30ph6YKNhT1zHJqU0JnEIQqtSlyaVCmrD65nx', 4455, NULL, '2019-12-16 11:47:04', '2019-12-16 11:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('home','office','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `full_name`, `email`, `type`, `title`, `address`, `country_name`, `country_id`, `city`, `postal_code`, `phone`, `created_at`, `updated_at`) VALUES
(1, 16, 'fffff', 'null', 'home', 'title', 'Surat', 'Saudi Arabia', 190, 'surat', '935880', '966585858585', '2019-11-01 11:53:38', '2019-11-01 11:53:38'),
(2, 19, 'Bhavesh', 'fff@gmail.com', 'home', 'title', 'j uvuvuuvuvbu', 'Saudi Arabia', 190, 'hJi', '66969', '966903341893', '2019-11-01 12:29:22', '2019-11-05 14:08:03'),
(3, 21, 'fffff', 'null', 'home', 'title', 'new Zealand UAE Singapore and Australia', 'Saudi Arabia', 190, 'the Facebook', '55555', '966747474747', '2019-11-01 13:37:01', '2019-11-01 13:37:01'),
(5, 19, 'Tolat', 'null', 'office', 'title', 'Gopitalav', 'Saudi Arabia', 190, 'surat', '395003', '966903341893', '2019-11-04 16:10:42', '2019-11-04 16:13:46'),
(6, 27, 'Tolat', 'android1@mailinator.com', 'home', 'title', 'Katargam', 'Saudi Arabia', 190, 'mumbai', '395001', '966903341896', '2019-11-04 18:18:07', '2019-11-04 18:18:39'),
(7, 28, 'Tolat', 'null', 'home', 'title', 'Surat', 'Saudi Arabia', 190, 'Surat', '39501', '966646464646', '2019-11-04 18:51:17', '2019-11-04 18:51:17'),
(8, 32, 'qqq', 'null', 'home', 'title', 'katargam', 'Saudi Arabia', 190, 'Surat', '369550', '966454545451', '2019-11-05 14:27:27', '2019-11-05 14:27:27'),
(9, 34, 'Okema', 'null', 'home', 'title', 'vuvivkvkg', 'Saudi Arabia', 190, 'igg', '89', '966461236489', '2019-11-05 15:33:49', '2019-11-05 15:33:49'),
(10, 37, 'okema one', 'null', 'home', 'title', '10, sue sus8sgvugv xwibxe bcj hcoc cocc cohxo xoyfh foychcodoy oudou y9f9yo ofocoixhckhxh cvojvoycif vpflj ojoufuv9uvoug', 'Saudi Arabia', 190, 'surat', '225533', '966989898923', '2019-11-06 15:44:24', '2019-11-06 16:37:48'),
(12, 37, 'okema one', 'N/A', 'other', 'home', 'B- 111, dwarkadish apartment, near navi chopati, lakhnow road, surat, gujarat.', 'Saudi Arabia', 190, 'surat', '4646', '966989898989', '2019-11-06 16:32:51', '2019-11-06 16:32:51'),
(13, 37, 'okema one', 'null', 'office', 'title', 'vouczhpspsgosgsofsys soycs s6fve 7sge ee sjs si sjs sus zus usgis sshs agoabsn susi aoya', 'Saudi Arabia', 190, 'surat', '6644', '966989898989', '2019-11-06 16:38:22', '2019-11-06 16:38:22'),
(16, 40, 'Tolat', 'android1@mailinatyor.com', 'home', 'title', 'Surat Gujarat395001', 'Saudi Arabia', 190, 'Surat', '395001', '966561245367', '2019-11-07 11:03:50', '2019-11-07 18:15:24'),
(19, 41, 'tsgagsg', 'null', 'home', 'title', 'wtatat', 'Saudi Arabia', 190, 'sfarF', '4542427', '966542154879', '2019-11-07 18:50:35', '2019-11-07 18:50:35'),
(15, 38, 'rrrr', 'null', 'other', 'title', 'hrhr', 'Saudi Arabia', 190, 'thth', '5959', '966542132649', '2019-11-06 19:07:15', '2019-11-06 19:08:22'),
(18, 40, 'Tolat', 'N/A', 'other', 'Gym', 'surat', 'Saudi Arabia', 190, '395001', '395001', '966561245367', '2019-11-07 18:28:40', '2019-11-07 18:28:40'),
(20, 46, 'vinen', 'N/A', 'home', 'Home', 'Viguvvufu', 'Saudi Arabia', 190, 'hguivghh', '5595585', '966572516916', '2019-11-09 13:35:30', '2019-11-09 14:14:22'),
(25, 47, 'hv', 'N/A', 'other', 'hckhf', 'Hfjgf', 'Saudi Arabia', 190, 'khchk', '86580', '966999999999', '2019-11-09 19:32:13', '2019-11-09 19:32:33'),
(24, 47, 'bjckhvjo', 'N/A', 'home', 'Home', 'Fugfugfhihip', 'Saudi Arabia', 190, 'cgcgjc', '83225', '966999999999', '2019-11-09 19:31:11', '2019-11-09 19:32:03'),
(27, 26, 'vinen', 'N/A', 'home', 'Home', '6061 Al Ulaya, Al Wurud, Riyadh 12251 2832, Saudi Arabia', 'Saudi Arabia', 190, 'Al Worood', '12251', '966572516916', '2019-11-12 12:50:14', '2019-11-26 11:56:20'),
(28, 52, 'okema', 'N/A', 'other', 'Offic', 'Ggg hfhsjgz ur edipsd chewpincedwbcjdlw ccjbdwlc salcjnsac daljncda cdbcjs cidncjkd cljjd i cj cjcb ksnda lnfksjsj cjoje fm scbl sj dbp hckhs ch shc os cha cna skc hsk cand faks ckbs chea ckhsqchekq chekq cdkhw ckhsqchsf svvkshqvvskq ckhsvcke chevxk', 'Saudi Arabia', 190, 'surat surat surat', '85858858', '888888888888', '2019-11-12 13:12:22', '2019-11-12 13:12:22'),
(29, 52, 'okema three', 'N/A', 'home', 'Home', 'Cgcxjvskqhxvhkqs', 'Saudi Arabia', 190, 'hisvxohs', '55876543', '888888888888', '2019-11-12 13:12:36', '2019-11-12 13:12:36'),
(30, 53, 'wwww', 'null', 'home', 'title', 'surat', 'Saudi Arabia', 190, 'surat', '935881', '966574512326', '2019-11-20 16:34:48', '2019-11-20 16:34:48'),
(31, 26, 'vinen', 'N/A', 'office', 'Office', 'Fyvyvychcycychcychcyvycycycycycycycgcycycycgcycychvychcchcycgcycycgcgcgcycycgchcgcgcgcgcgcgcgcgcycgcgcgcgcgvhvhvhvhvhvhvhvhvgvgcgcvgcgvgvgvgvgvyvyvyvyvyvycycyc', 'Saudi Arabia', 190, 'Surat', '828272', '966572516916', '2019-11-20 19:57:43', '2019-11-20 19:57:43'),
(32, 41, 'tsgagsg', 'null', 'office', 'title', '19859, Saudi Arabia', 'Saudi Arabia', 190, 'gh', '19859', '966542154879', '2019-11-23 19:05:50', '2019-11-23 19:05:50'),
(33, 64, 'admin1', 'admin@hauchi.com', 'home', '', 'california', 'Saudi Arabia', 0, 'surat', '395006', '56656565656', '2019-11-25 13:24:39', '2019-11-25 13:24:39'),
(34, 64, 'admin1', 'admin@hauchi.com', 'home', '', 'california', 'Saudi Arabia', 0, 'sdsd', '395006', '23243424', '2019-11-25 13:25:36', '2019-11-25 13:25:36'),
(35, 60, 'admin1', 'admin@hauchi.com', 'home', '', 'california', 'Saudi Arabia', 0, 'surat', '395006', '87746465454', '2019-11-25 13:35:59', '2019-11-25 13:35:59'),
(36, 65, 'test', 'N/A', 'home', 'Home', '19212, Saudi Arabia', 'Saudi Arabia', 190, 'ey', '16388', '966966555555555', '2019-11-27 12:49:10', '2019-11-28 14:00:06'),
(39, 79, 'bad SG', 'null', 'home', 'title', '3078 Prince Mohammed Ibn Salman Ibn Abdulaziz Rd, Al Aqiq, Riyadh 13515 6168, Saudi Arabia', 'Saudi Arabia', 190, 'Riyadh', '13515', '966523567892', '2019-11-28 15:56:37', '2019-11-28 17:19:37'),
(38, 67, 'yyy', 'null', 'home', 'title', 'King Salman Rd, King Khalid International Airport, Riyadh 13415, Saudi Arabia', 'Saudi Arabia', 190, 'Riyadh', '13415', '966512345678', '2019-11-28 13:07:17', '2019-11-28 13:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 59, 2, '2019-11-23 15:50:42', '2019-11-23 15:50:42'),
(5, 59, 22, '2019-11-23 15:51:31', '2019-11-23 15:51:31'),
(6, 59, 3, '2019-11-23 15:52:56', '2019-11-23 15:52:56'),
(7, 60, 1, '2019-11-23 19:30:22', '2019-11-23 19:30:22'),
(8, 64, 21, '2019-11-25 13:26:27', '2019-11-25 13:26:27'),
(9, 64, 1, '2019-11-25 13:26:55', '2019-11-25 13:26:55'),
(10, 64, 6, '2019-11-25 13:27:04', '2019-11-25 13:27:04'),
(11, 60, 23, '2019-11-25 14:25:23', '2019-11-25 14:25:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advert_banners`
--
ALTER TABLE `advert_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_categories`
--
ALTER TABLE `banner_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_firebase_token_unique` (`firebase_token`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiries_user_id_foreign` (`user_id`);

--
-- Indexes for table `favourite_products`
--
ALTER TABLE `favourite_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_brands`
--
ALTER TABLE `feature_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deals`
--
ALTER TABLE `flash_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_categories`
--
ALTER TABLE `home_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_offers`
--
ALTER TABLE `product_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_offers_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_category_id` (`sub_category_id`);

--
-- Indexes for table `tax_settings`
--
ALTER TABLE `tax_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advert_banners`
--
ALTER TABLE `advert_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banner_categories`
--
ALTER TABLE `banner_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favourite_products`
--
ALTER TABLE `favourite_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `feature_brands`
--
ALTER TABLE `feature_brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flash_deals`
--
ALTER TABLE `flash_deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_categories`
--
ALTER TABLE `home_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_offers`
--
ALTER TABLE `product_offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `review_likes`
--
ALTER TABLE `review_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tax_settings`
--
ALTER TABLE `tax_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
