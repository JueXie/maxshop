-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-07-07 13:14:03
-- 服务器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `maxshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `max_cart`
--

DROP TABLE IF EXISTS `max_cart`;
CREATE TABLE IF NOT EXISTS `max_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_cart`
--

INSERT INTO `max_cart` (`cart_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(5, 14, 'a:4:{i:32;i:3;i:33;i:2;i:30;i:1;i:31;i:1;}', '2020-03-20 05:55:05', '2020-03-26 17:00:35'),
(6, 13, 'a:1:{i:34;i:1;}', '2020-03-20 06:14:45', '2020-06-23 09:10:38'),
(7, 15, 'a:1:{i:35;i:1;}', '2020-06-23 19:40:56', '2020-07-03 13:12:58'),
(8, 16, 'a:1:{i:33;i:1;}', '2020-06-30 12:15:36', '2020-06-30 12:16:33');

-- --------------------------------------------------------

--
-- 表的结构 `max_category`
--

DROP TABLE IF EXISTS `max_category`;
CREATE TABLE IF NOT EXISTS `max_category` (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child` varchar(512) DEFAULT NULL,
  `display` varchar(20) NOT NULL DEFAULT 'sub_category' COMMENT 'sub_category,both,product',
  `preview_img` varchar(512) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_category`
--

INSERT INTO `max_category` (`category_id`, `name`, `parent_id`, `child`, `display`, `preview_img`, `created_at`, `updated_at`) VALUES
(47, '电动工具', 0, 'a:2:{i:1;i:49;i:2;i:48;}', 'sub_category', 'http://maxshop.natapp1.cc/upload/images/20200622/0c6eda753d180ade34cf27370bfc1037.jpg', '2020-06-21 23:57:12', '2020-06-22 00:47:40'),
(48, '冲击钻', 47, NULL, 'sub_category', 'http://maxshop.natapp1.cc/upload/images/20200622/0da19ef3a9cf475a1bfb3b825cd059a2.png', '2020-06-22 00:01:55', '2020-06-22 00:47:40'),
(49, '角磨机', 47, NULL, 'product', 'http://maxshop.natapp1.cc/upload/images/20200622/6815e7129131d0efb460fd734b5e0777.png', '2020-06-22 00:47:00', '2020-06-22 00:47:00'),
(50, '启动工具', 0, 'a:1:{i:0;i:51;}', 'sub_category', 'http://maxshop.natapp1.cc/upload/images/20200706/763c4850d3197160a90881cb34e971be.png', '2020-07-06 14:07:08', '2020-07-06 14:07:30'),
(51, '启动角磨机', 50, NULL, 'sub_category', 'http://maxshop.natapp1.cc/upload/images/20200706/43da88bfc50a9473e4dc3c55f6223654.png', '2020-07-06 14:07:30', '2020-07-06 14:07:30');

-- --------------------------------------------------------

--
-- 表的结构 `max_images`
--

DROP TABLE IF EXISTS `max_images`;
CREATE TABLE IF NOT EXISTS `max_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `max_images`
--

INSERT INTO `max_images` (`img_id`, `name`, `path`, `url`, `created_at`, `updated_at`) VALUES
(262, '43da88bfc50a9473e4dc3c55f6223654', '/upload/images/20200706/43da88bfc50a9473e4dc3c55f6223654.png', 'http://maxshop.natapp1.cc/upload/images/20200706/43da88bfc50a9473e4dc3c55f6223654.png', '2020-07-06 14:07:29', '2020-07-06 14:07:29'),
(261, '763c4850d3197160a90881cb34e971be', '/upload/images/20200706/763c4850d3197160a90881cb34e971be.png', 'http://maxshop.natapp1.cc/upload/images/20200706/763c4850d3197160a90881cb34e971be.png', '2020-07-06 14:07:07', '2020-07-06 14:07:07'),
(260, '4233985c8e91116bb4ce7b15f860210a', '/upload/images/20200629/4233985c8e91116bb4ce7b15f860210a.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/4233985c8e91116bb4ce7b15f860210a.jpg', '2020-06-29 06:58:41', '2020-06-29 06:58:41'),
(259, '7dd1fae3637e13dffdb9681f2c85485c', '/upload/images/20200629/7dd1fae3637e13dffdb9681f2c85485c.png', 'http://maxshop.natapp1.cc/upload/images/20200629/7dd1fae3637e13dffdb9681f2c85485c.png', '2020-06-29 06:58:39', '2020-06-29 06:58:39'),
(258, '1de3f7af920bd83fcb78e78702d4eef6', '/upload/images/20200629/1de3f7af920bd83fcb78e78702d4eef6.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/1de3f7af920bd83fcb78e78702d4eef6.jpg', '2020-06-29 06:58:31', '2020-06-29 06:58:31'),
(257, 'ead946b972897b1e9a3e137eafe2e487', '/upload/images/20200629/ead946b972897b1e9a3e137eafe2e487.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/ead946b972897b1e9a3e137eafe2e487.jpg', '2020-06-29 06:58:28', '2020-06-29 06:58:28'),
(256, 'a7fadca0ec958f940649f5ff93322dca', '/upload/images/20200629/a7fadca0ec958f940649f5ff93322dca.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/a7fadca0ec958f940649f5ff93322dca.jpg', '2020-06-29 06:58:24', '2020-06-29 06:58:24'),
(255, '61a12f9b453b5a3912ff7495850677e0', '/upload/images/20200629/61a12f9b453b5a3912ff7495850677e0.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/61a12f9b453b5a3912ff7495850677e0.jpg', '2020-06-29 06:58:21', '2020-06-29 06:58:21'),
(254, '047c6337921b912ab86112995f4a6ad8', '/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg', 'http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg', '2020-06-29 06:58:17', '2020-06-29 06:58:17'),
(253, '0da19ef3a9cf475a1bfb3b825cd059a2', '/upload/images/20200622/0da19ef3a9cf475a1bfb3b825cd059a2.png', 'http://maxshop.natapp1.cc/upload/images/20200622/0da19ef3a9cf475a1bfb3b825cd059a2.png', '2020-06-22 00:47:40', '2020-06-22 00:47:40'),
(252, '6815e7129131d0efb460fd734b5e0777', '/upload/images/20200622/6815e7129131d0efb460fd734b5e0777.png', 'http://maxshop.natapp1.cc/upload/images/20200622/6815e7129131d0efb460fd734b5e0777.png', '2020-06-22 00:46:59', '2020-06-22 00:46:59'),
(251, '00cc29bc17a870db123d2edb7c9c9f37', '/upload/images/20200622/00cc29bc17a870db123d2edb7c9c9f37.png', 'http://maxshop.natapp1.cc/upload/images/20200622/00cc29bc17a870db123d2edb7c9c9f37.png', '2020-06-22 00:01:54', '2020-06-22 00:01:54'),
(250, '0c6eda753d180ade34cf27370bfc1037', '/upload/images/20200622/0c6eda753d180ade34cf27370bfc1037.jpg', 'http://maxshop.natapp1.cc/upload/images/20200622/0c6eda753d180ade34cf27370bfc1037.jpg', '2020-06-21 23:57:11', '2020-06-21 23:57:11'),
(195, '62608f0655fd46aa82405170c99d76eb', '/upload/images/20200318/62608f0655fd46aa82405170c99d76eb.jpg', 'http://maxshop.cn/upload/images/20200318/62608f0655fd46aa82405170c99d76eb.jpg', '2020-03-17 23:51:37', '2020-03-17 23:51:37'),
(196, '6a6db6dae0ee6ddaef647d6111aa4717', '/upload/images/20200318/6a6db6dae0ee6ddaef647d6111aa4717.jpg', 'http://maxshop.cn/upload/images/20200318/6a6db6dae0ee6ddaef647d6111aa4717.jpg', '2020-03-17 23:51:39', '2020-03-17 23:51:39'),
(197, 'f4c150b851ab49b350c0281d6319a79b', '/upload/images/20200318/f4c150b851ab49b350c0281d6319a79b.jpg', 'http://maxshop.cn/upload/images/20200318/f4c150b851ab49b350c0281d6319a79b.jpg', '2020-03-17 23:51:41', '2020-03-17 23:51:41'),
(198, 'c0428dac0f49b2f79cc9e83dcd4052ef', '/upload/images/20200318/c0428dac0f49b2f79cc9e83dcd4052ef.jpg', 'http://maxshop.cn/upload/images/20200318/c0428dac0f49b2f79cc9e83dcd4052ef.jpg', '2020-03-18 01:38:04', '2020-03-18 01:38:04'),
(199, '6d86c821165db90e5a11bc2ebe1461a8', '/upload/images/20200320/6d86c821165db90e5a11bc2ebe1461a8.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/6d86c821165db90e5a11bc2ebe1461a8.jpg', '2020-03-20 05:49:25', '2020-03-20 05:49:25'),
(200, '37e420401a1b61d67f385b7c73e044ac', '/upload/images/20200320/37e420401a1b61d67f385b7c73e044ac.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/37e420401a1b61d67f385b7c73e044ac.jpg', '2020-03-20 05:49:32', '2020-03-20 05:49:32'),
(201, '1790006da0d0859a7bae67655777d562', '/upload/images/20200320/1790006da0d0859a7bae67655777d562.png', 'http://maxshop.natapp1.cc//upload/images/20200320/1790006da0d0859a7bae67655777d562.png', '2020-03-20 05:49:35', '2020-03-20 05:49:35'),
(202, '1666570cfacdcd24e767d919b1bea02f', '/upload/images/20200320/1666570cfacdcd24e767d919b1bea02f.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/1666570cfacdcd24e767d919b1bea02f.jpg', '2020-03-20 05:49:38', '2020-03-20 05:49:38'),
(203, 'ae20cd18476cdc4351cba95ff99e793d', '/upload/images/20200320/ae20cd18476cdc4351cba95ff99e793d.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/ae20cd18476cdc4351cba95ff99e793d.jpg', '2020-03-20 05:49:40', '2020-03-20 05:49:40'),
(204, '3895973df23d7f0e83e0db75902e0d94', '/upload/images/20200320/3895973df23d7f0e83e0db75902e0d94.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/3895973df23d7f0e83e0db75902e0d94.jpg', '2020-03-20 05:49:45', '2020-03-20 05:49:45'),
(205, '5ea52b3046b8dfdea1b40db52ca367be', '/upload/images/20200320/5ea52b3046b8dfdea1b40db52ca367be.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/5ea52b3046b8dfdea1b40db52ca367be.jpg', '2020-03-20 05:49:48', '2020-03-20 05:49:48'),
(206, '80332b437bf528d111abf15a9a3bf814', '/upload/images/20200320/80332b437bf528d111abf15a9a3bf814.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/80332b437bf528d111abf15a9a3bf814.jpg', '2020-03-20 05:50:16', '2020-03-20 05:50:16'),
(207, '872fff501a949a22a3162299272884d9', '/upload/images/20200320/872fff501a949a22a3162299272884d9.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/872fff501a949a22a3162299272884d9.jpg', '2020-03-20 05:58:37', '2020-03-20 05:58:37'),
(208, '3d5d2fd8e3f973d949eb6cfa5d60bbb3', '/upload/images/20200320/3d5d2fd8e3f973d949eb6cfa5d60bbb3.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/3d5d2fd8e3f973d949eb6cfa5d60bbb3.jpg', '2020-03-20 05:58:39', '2020-03-20 05:58:39'),
(209, '1729dbc7b22aa1922123b21cc24b4711', '/upload/images/20200320/1729dbc7b22aa1922123b21cc24b4711.png', 'http://maxshop.natapp1.cc//upload/images/20200320/1729dbc7b22aa1922123b21cc24b4711.png', '2020-03-20 05:58:42', '2020-03-20 05:58:42'),
(210, 'b51faca4c80a7c0b2737683907246047', '/upload/images/20200320/b51faca4c80a7c0b2737683907246047.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/b51faca4c80a7c0b2737683907246047.jpg', '2020-03-20 05:59:03', '2020-03-20 05:59:03'),
(211, '496546bd9a2178a8857b39467157e39f', '/upload/images/20200320/496546bd9a2178a8857b39467157e39f.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/496546bd9a2178a8857b39467157e39f.jpg', '2020-03-20 05:59:06', '2020-03-20 05:59:06'),
(212, '139c71581cd7d18fea62bc2b4985be27', '/upload/images/20200320/139c71581cd7d18fea62bc2b4985be27.jpg', 'http://maxshop.natapp1.cc//upload/images/20200320/139c71581cd7d18fea62bc2b4985be27.jpg', '2020-03-20 05:59:08', '2020-03-20 05:59:08'),
(213, 'c65648736549d839cdd73ba2dc81b681', '/upload/images/20200320/c65648736549d839cdd73ba2dc81b681.png', 'http://maxshop.natapp1.cc//upload/images/20200320/c65648736549d839cdd73ba2dc81b681.png', '2020-03-20 05:59:11', '2020-03-20 05:59:11'),
(214, '913de7ebb35f5afda248026f5145f406', '/upload/images/20200321/913de7ebb35f5afda248026f5145f406.jpg', 'http://maxshop.natapp1.cc/upload/images/20200321/913de7ebb35f5afda248026f5145f406.jpg', '2020-03-21 05:17:52', '2020-03-21 05:17:52'),
(215, 'a65b72b65c9bf88afb29555dbb1f4e25', '/upload/images/20200322/a65b72b65c9bf88afb29555dbb1f4e25.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/a65b72b65c9bf88afb29555dbb1f4e25.jpg', '2020-03-22 03:42:50', '2020-03-22 03:42:50'),
(216, '7db86184db309c5e7e2991d10e25afe2', '/upload/images/20200322/7db86184db309c5e7e2991d10e25afe2.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/7db86184db309c5e7e2991d10e25afe2.jpg', '2020-03-22 03:43:15', '2020-03-22 03:43:15'),
(217, 'd02bed9bf8a38cc3889dea1ae59a9447', '/upload/images/20200322/d02bed9bf8a38cc3889dea1ae59a9447.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/d02bed9bf8a38cc3889dea1ae59a9447.jpg', '2020-03-22 04:26:23', '2020-03-22 04:26:23'),
(218, '9718d6017c54b172f558f827c2a9b58e', '/upload/images/20200322/9718d6017c54b172f558f827c2a9b58e.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/9718d6017c54b172f558f827c2a9b58e.jpg', '2020-03-22 04:28:48', '2020-03-22 04:28:48'),
(219, 'cd90a759a65e60da8b11c37ef89b68b0', '/upload/images/20200322/cd90a759a65e60da8b11c37ef89b68b0.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/cd90a759a65e60da8b11c37ef89b68b0.jpg', '2020-03-22 04:29:14', '2020-03-22 04:29:14'),
(220, '17cb258cdb6fbdd0f597124d787803bd', '/upload/images/20200322/17cb258cdb6fbdd0f597124d787803bd.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/17cb258cdb6fbdd0f597124d787803bd.jpg', '2020-03-22 04:29:34', '2020-03-22 04:29:34'),
(221, '735076468bab35d39cb7e17695f2d9a0', '/upload/images/20200322/735076468bab35d39cb7e17695f2d9a0.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/735076468bab35d39cb7e17695f2d9a0.jpg', '2020-03-22 05:49:35', '2020-03-22 05:49:35'),
(222, '31fea14e4da55e169adfc931536677df', '/upload/images/20200322/31fea14e4da55e169adfc931536677df.png', 'http://maxshop.natapp1.cc/upload/images/20200322/31fea14e4da55e169adfc931536677df.png', '2020-03-22 05:49:54', '2020-03-22 05:49:54'),
(223, 'def4e84cef0157ca27b792ea3ada37a0', '/upload/images/20200322/def4e84cef0157ca27b792ea3ada37a0.png', 'http://maxshop.natapp1.cc/upload/images/20200322/def4e84cef0157ca27b792ea3ada37a0.png', '2020-03-22 05:50:15', '2020-03-22 05:50:15'),
(224, '6e622cdd757221561525b2c56fe60296', '/upload/images/20200322/6e622cdd757221561525b2c56fe60296.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/6e622cdd757221561525b2c56fe60296.jpg', '2020-03-22 06:06:32', '2020-03-22 06:06:32'),
(225, '260d993d9b205366a6a5b50a76e4ce4b', '/upload/images/20200322/260d993d9b205366a6a5b50a76e4ce4b.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/260d993d9b205366a6a5b50a76e4ce4b.jpg', '2020-03-22 06:06:49', '2020-03-22 06:06:49'),
(226, '490397ae87f0b2ab7c636a39c028894b', '/upload/images/20200322/490397ae87f0b2ab7c636a39c028894b.jpg', 'http://maxshop.natapp1.cc/upload/images/20200322/490397ae87f0b2ab7c636a39c028894b.jpg', '2020-03-22 06:07:08', '2020-03-22 06:07:08'),
(227, 'ea10fe68cb01829baa98ebbc5bcd7373', '/upload/images/20200324/ea10fe68cb01829baa98ebbc5bcd7373.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/ea10fe68cb01829baa98ebbc5bcd7373.jpg', '2020-03-23 20:53:18', '2020-03-23 20:53:18'),
(228, 'e8e6efdbdb46dd366ba86a13c39db8e9', '/upload/images/20200324/e8e6efdbdb46dd366ba86a13c39db8e9.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/e8e6efdbdb46dd366ba86a13c39db8e9.jpg', '2020-03-23 20:53:29', '2020-03-23 20:53:29'),
(229, '44a9d41cda69de34d07af538203a974f', '/upload/images/20200324/44a9d41cda69de34d07af538203a974f.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/44a9d41cda69de34d07af538203a974f.jpg', '2020-03-23 20:53:34', '2020-03-23 20:53:34'),
(230, 'cbda6e7b9509177308985fdc91fb7405', '/upload/images/20200324/cbda6e7b9509177308985fdc91fb7405.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/cbda6e7b9509177308985fdc91fb7405.jpg', '2020-03-23 20:53:37', '2020-03-23 20:53:37'),
(231, '3f82048a8cb270023e340f60bfa6e41e', '/upload/images/20200324/3f82048a8cb270023e340f60bfa6e41e.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/3f82048a8cb270023e340f60bfa6e41e.jpg', '2020-03-23 20:53:40', '2020-03-23 20:53:40'),
(232, '48214a94928cd2fe403f98ab1d94ed62', '/upload/images/20200324/48214a94928cd2fe403f98ab1d94ed62.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/48214a94928cd2fe403f98ab1d94ed62.jpg', '2020-03-23 20:54:07', '2020-03-23 20:54:07'),
(233, '29fee02ce9051f47b7cf0fc612e06cac', '/upload/images/20200324/29fee02ce9051f47b7cf0fc612e06cac.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/29fee02ce9051f47b7cf0fc612e06cac.jpg', '2020-03-23 20:54:10', '2020-03-23 20:54:10'),
(234, '8cdcf65f8b96f7ca8e41a0e4735b18c7', '/upload/images/20200324/8cdcf65f8b96f7ca8e41a0e4735b18c7.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/8cdcf65f8b96f7ca8e41a0e4735b18c7.jpg', '2020-03-23 20:54:14', '2020-03-23 20:54:14'),
(235, '4540b4cab542a26054e2d392e0b1b945', '/upload/images/20200324/4540b4cab542a26054e2d392e0b1b945.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/4540b4cab542a26054e2d392e0b1b945.jpg', '2020-03-23 20:54:18', '2020-03-23 20:54:18'),
(236, '60a57238985847d596dc97870e05f30d', '/upload/images/20200324/60a57238985847d596dc97870e05f30d.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/60a57238985847d596dc97870e05f30d.jpg', '2020-03-23 20:54:40', '2020-03-23 20:54:40'),
(237, '829c5c848c3648f024eb1df119b325c9', '/upload/images/20200324/829c5c848c3648f024eb1df119b325c9.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/829c5c848c3648f024eb1df119b325c9.jpg', '2020-03-23 20:54:42', '2020-03-23 20:54:42'),
(238, '5b9985a2b4c6790cf7862224bab476da', '/upload/images/20200324/5b9985a2b4c6790cf7862224bab476da.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/5b9985a2b4c6790cf7862224bab476da.jpg', '2020-03-23 20:54:46', '2020-03-23 20:54:46'),
(239, 'c5f47a270d253b5d911878adc5ab0b4a', '/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg', '2020-03-23 23:44:51', '2020-03-23 23:44:51'),
(240, '10dfea6c9e285d6227bee8f7884ee41a', '/upload/images/20200324/10dfea6c9e285d6227bee8f7884ee41a.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/10dfea6c9e285d6227bee8f7884ee41a.jpg', '2020-03-23 23:45:14', '2020-03-23 23:45:14'),
(241, '3f515519ee2ef46c4ca04bce91c61972', '/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg', '2020-03-24 01:10:09', '2020-03-24 01:10:09'),
(242, '5c462dd5cf2e2a11e16c4ee1ce24e594', '/upload/images/20200324/5c462dd5cf2e2a11e16c4ee1ce24e594.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/5c462dd5cf2e2a11e16c4ee1ce24e594.jpg', '2020-03-24 01:10:14', '2020-03-24 01:10:14'),
(243, 'ceecf52faaf12d033139e56c16b199f2', '/upload/images/20200324/ceecf52faaf12d033139e56c16b199f2.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/ceecf52faaf12d033139e56c16b199f2.jpg', '2020-03-24 01:10:18', '2020-03-24 01:10:18'),
(244, '1a427404d6bf2cfff0accc0674654ae5', '/upload/images/20200324/1a427404d6bf2cfff0accc0674654ae5.jpg', 'http://maxshop.natapp1.cc/upload/images/20200324/1a427404d6bf2cfff0accc0674654ae5.jpg', '2020-03-24 01:10:21', '2020-03-24 01:10:21'),
(245, '37f1aa6f6f52a1d20111732b5b782ceb', '/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg', 'http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg', '2020-04-15 23:11:24', '2020-04-15 23:11:24'),
(246, '606dc182a50e1a8b4dce21d4860e977a', '/upload/images/20200416/606dc182a50e1a8b4dce21d4860e977a.jpg', 'http://maxshop.natapp1.cc/upload/images/20200416/606dc182a50e1a8b4dce21d4860e977a.jpg', '2020-04-15 23:11:29', '2020-04-15 23:11:29'),
(247, '62077adfa99a05c4637f72a14edc572d', '/upload/images/20200416/62077adfa99a05c4637f72a14edc572d.jpg', 'http://maxshop.natapp1.cc/upload/images/20200416/62077adfa99a05c4637f72a14edc572d.jpg', '2020-04-15 23:11:33', '2020-04-15 23:11:33'),
(248, '74709fa4ca9894d3bbb8465c5f3ae075', '/upload/images/20200416/74709fa4ca9894d3bbb8465c5f3ae075.jpg', 'http://maxshop.natapp1.cc/upload/images/20200416/74709fa4ca9894d3bbb8465c5f3ae075.jpg', '2020-04-15 23:11:35', '2020-04-15 23:11:35'),
(249, '326ffc09473fdcd1b66f8bd2557173e5', '/upload/images/20200416/326ffc09473fdcd1b66f8bd2557173e5.jpg', 'http://maxshop.natapp1.cc/upload/images/20200416/326ffc09473fdcd1b66f8bd2557173e5.jpg', '2020-04-15 23:11:38', '2020-04-15 23:11:38');

-- --------------------------------------------------------

--
-- 表的结构 `max_options`
--

DROP TABLE IF EXISTS `max_options`;
CREATE TABLE IF NOT EXISTS `max_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `max_key` varchar(20) NOT NULL,
  `max_value` varchar(8192) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_options`
--

INSERT INTO `max_options` (`option_id`, `max_key`, `max_value`, `created_at`, `updated_at`) VALUES
(23, 'wxpaymentnotify', 'SUCCESS', '2020-06-29 07:23:37', '2020-06-29 07:23:37'),
(22, 'wxpaymentnotify', 'SUCCESS', '2020-06-29 06:24:28', '2020-06-29 06:24:28'),
(21, 'wxpaymentnotify', 'SUCCESS', '2020-06-29 06:15:35', '2020-06-29 06:15:35'),
(20, 'wxpaymentnotify', 'SUCCESS', '2020-06-29 03:17:10', '2020-06-29 03:17:10'),
(19, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 16:08:12', '2020-06-28 16:08:12'),
(18, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 15:35:35', '2020-06-28 15:35:35'),
(17, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 15:32:08', '2020-06-28 15:32:08'),
(16, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 15:22:15', '2020-06-28 15:22:15'),
(15, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 15:20:31', '2020-06-28 15:20:31'),
(14, 'wxpaymentnotify', 'SUCCESS', '2020-06-28 15:10:14', '2020-06-28 15:10:14');

-- --------------------------------------------------------

--
-- 表的结构 `max_order`
--

DROP TABLE IF EXISTS `max_order`;
CREATE TABLE IF NOT EXISTS `max_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trade_no` varchar(30) NOT NULL,
  `order_data` varchar(4096) DEFAULT NULL,
  `status` varchar(10) NOT NULL COMMENT 'pending/paid/logistics/success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_order`
--

INSERT INTO `max_order` (`order_id`, `user_id`, `trade_no`, `order_data`, `status`, `created_at`, `updated_at`) VALUES
(91, 15, 'f1f7e3e320200703115926', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.3;s:9:\"sub_total\";d:0.06;s:9:\"sub_count\";i:3;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:3;s:12:\"normal_price\";i:30;s:5:\"price\";i:6;}}', 'pending', '2020-07-03 03:59:26', '2020-07-03 03:59:26'),
(90, 15, '593d267a20200702181445', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-02 10:14:45', '2020-07-02 10:14:45'),
(89, 15, 'ce7faac620200702181313', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-02 10:13:13', '2020-07-02 10:13:13'),
(88, 15, '02eeb96920200702180627', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-02 10:06:27', '2020-07-02 10:06:27'),
(87, 15, 'fac907b420200702180626', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-02 10:06:26', '2020-07-02 10:06:26'),
(86, 15, '301f7baa20200701224138', 'a:3:{s:7:\"address\";N;s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-01 14:41:38', '2020-07-01 14:41:38'),
(85, 15, '0dfb6d3e20200701223132', 'a:3:{s:7:\"address\";N;s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-01 14:31:32', '2020-07-01 14:31:32'),
(84, 15, '1b61cc0020200701222602', 'a:3:{s:7:\"address\";N;s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'pending', '2020-07-01 14:26:02', '2020-07-01 14:26:02'),
(83, 16, '1b78dedd20200630201607', 'a:3:{s:7:\"address\";a:9:{s:12:\"nationalCode\";s:6:\"440111\";s:9:\"telNumber\";s:11:\"18527945951\";s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:9:\"江先生\";s:10:\"postalCode\";s:6:\"510080\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"白云区\";s:10:\"detailInfo\";s:29:\"石井镇潭村文明2巷4号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:3:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_34\";a:6:{s:12:\"normal_price\";d:1235.1;s:9:\"sub_total\";d:85.59;s:9:\"sub_count\";i:1;s:5:\"title\";s:7:\"demo123\";s:10:\"product_id\";i:34;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}}s:5:\"count\";i:3;s:12:\"normal_price\";i:1358920;s:5:\"price\";i:20861;}}', 'pending', '2020-06-30 12:16:07', '2020-06-30 12:16:07'),
(82, 15, 'aefbce2020200630185101', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:3:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}}s:5:\"count\";i:3;s:12:\"normal_price\";i:1313110;s:5:\"price\";i:20002;}}', 'pending', '2020-06-30 10:51:01', '2020-06-30 10:51:01'),
(81, 15, 'ca4b922b20200630185045', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:3:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}}s:5:\"count\";i:3;s:12:\"normal_price\";i:1313110;s:5:\"price\";i:20002;}}', 'pending', '2020-06-30 10:50:45', '2020-06-30 10:50:45'),
(80, 15, 'bab5268620200630185029', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:77700;s:5:\"price\";i:7700;}}', 'pending', '2020-06-30 10:50:29', '2020-06-30 10:50:29'),
(79, 15, '5801fcfc20200630185010', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:4:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_34\";a:6:{s:12:\"normal_price\";d:1235.1;s:9:\"sub_total\";d:85.59;s:9:\"sub_count\";i:1;s:5:\"title\";s:7:\"demo123\";s:10:\"product_id\";i:34;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}}s:5:\"count\";i:4;s:12:\"normal_price\";i:1436620;s:5:\"price\";i:28561;}}', 'pending', '2020-06-30 10:50:10', '2020-06-30 10:50:10'),
(78, 15, '7f6f65aa20200630184120', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:4:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_34\";a:6:{s:12:\"normal_price\";d:1235.1;s:9:\"sub_total\";d:85.59;s:9:\"sub_count\";i:1;s:5:\"title\";s:7:\"demo123\";s:10:\"product_id\";i:34;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}}s:5:\"count\";i:4;s:12:\"normal_price\";i:1436620;s:5:\"price\";i:28561;}}', 'pending', '2020-06-30 10:41:20', '2020-06-30 10:41:20'),
(77, 15, '3740582120200630183430', 'a:3:{s:7:\"address\";N;s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:4:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_34\";a:6:{s:12:\"normal_price\";d:1235.1;s:9:\"sub_total\";d:85.59;s:9:\"sub_count\";i:1;s:5:\"title\";s:7:\"demo123\";s:10:\"product_id\";i:34;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}s:10:\"product_32\";a:6:{s:12:\"normal_price\";i:777;s:9:\"sub_total\";i:77;s:9:\"sub_count\";i:1;s:5:\"title\";s:13:\"测试商品3\";s:10:\"product_id\";i:32;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg\";}}s:5:\"count\";i:4;s:12:\"normal_price\";i:1436620;s:5:\"price\";i:28561;}}', 'pending', '2020-06-30 10:34:30', '2020-06-30 10:34:30'),
(76, 15, '1e210c2520200630183410', 'a:3:{s:7:\"address\";a:9:{s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:6:\"张三\";s:12:\"nationalCode\";s:6:\"510000\";s:9:\"telNumber\";s:12:\"020-81167888\";s:10:\"postalCode\";s:6:\"510000\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"海珠区\";s:10:\"detailInfo\";s:18:\"新港中路397号\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:3:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}s:10:\"product_34\";a:6:{s:12:\"normal_price\";d:1235.1;s:9:\"sub_total\";d:85.59;s:9:\"sub_count\";i:1;s:5:\"title\";s:7:\"demo123\";s:10:\"product_id\";i:34;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg\";}s:10:\"product_33\";a:6:{s:12:\"normal_price\";i:12354;s:9:\"sub_total\";i:123;s:9:\"sub_count\";i:1;s:5:\"title\";s:15:\"测试产品123\";s:10:\"product_id\";i:33;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg\";}}s:5:\"count\";i:3;s:12:\"normal_price\";i:1358920;s:5:\"price\";i:20861;}}', 'pending', '2020-06-30 10:34:10', '2020-06-30 10:34:10'),
(75, 15, '7e11bcd720200629214018', 'a:3:{s:7:\"address\";a:9:{s:12:\"nationalCode\";s:6:\"440111\";s:9:\"telNumber\";s:11:\"18127945951\";s:6:\"errMsg\";s:16:\"chooseAddress:ok\";s:8:\"userName\";s:9:\"温小姐\";s:10:\"postalCode\";s:6:\"510080\";s:12:\"provinceName\";s:9:\"广东省\";s:8:\"cityName\";s:9:\"广州市\";s:10:\"countyName\";s:9:\"白云区\";s:10:\"detailInfo\";s:24:\"石井街道潭村车站\";}s:7:\"payment\";s:12:\"微信支付\";s:9:\"cart_data\";a:4:{s:7:\"content\";a:1:{s:10:\"product_35\";a:6:{s:12:\"normal_price\";d:0.1;s:9:\"sub_total\";d:0.02;s:9:\"sub_count\";i:1;s:5:\"title\";s:18:\"一分钱的商品\";s:10:\"product_id\";i:35;s:8:\"main_img\";s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg\";}}s:5:\"count\";i:1;s:12:\"normal_price\";i:10;s:5:\"price\";i:2;}}', 'paid', '2020-06-29 13:40:18', '2020-06-29 13:44:28');

-- --------------------------------------------------------

--
-- 表的结构 `max_payment`
--

DROP TABLE IF EXISTS `max_payment`;
CREATE TABLE IF NOT EXISTS `max_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `preview_img` varchar(512) DEFAULT NULL,
  `payment_data` varchar(4196) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_payment`
--

INSERT INTO `max_payment` (`payment_id`, `name`, `preview_img`, `payment_data`, `created_at`, `updated_at`) VALUES
(2, '微信支付', '/images/wechat-payment-logo.png', 'a:4:{s:6:\"app_id\";s:22:\"1231啊啊实打实的\";s:6:\"mch_id\";s:17:\"12312阿松大是\";s:7:\"mch_key\";s:15:\"阿松大暗示\";s:9:\"mch_title\";s:18:\"阿松大阿松大\";}', '2020-04-03 08:43:52', '2020-04-09 00:49:37'),
(3, '支付宝', '/images/alipay-payment-logo.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `max_products`
--

DROP TABLE IF EXISTS `max_products`;
CREATE TABLE IF NOT EXISTS `max_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `info` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'simple',
  `parent_id` int(11) DEFAULT 0,
  `stock` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存',
  `main_img` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '主图',
  `category_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT '分类',
  `slide_img` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '轮播图',
  `content` varchar(4096) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '详情页',
  `normal_price` decimal(8,2) NOT NULL DEFAULT 0.00 COMMENT '正常价格',
  `hot_sale_price` decimal(8,2) NOT NULL DEFAULT 0.00 COMMENT '促销价',
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `max_products`
--

INSERT INTO `max_products` (`product_id`, `title`, `info`, `type`, `parent_id`, `stock`, `main_img`, `category_id`, `slide_img`, `content`, `normal_price`, `hot_sale_price`, `status`, `created_at`, `updated_at`) VALUES
(33, '测试产品123', '11000', 'simple', 0, 1111, 'http://maxshop.natapp1.cc/upload/images/20200324/3f515519ee2ef46c4ca04bce91c61972.jpg', 43, 'a:2:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/5c462dd5cf2e2a11e16c4ee1ce24e594.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/ceecf52faaf12d033139e56c16b199f2.jpg\";}', 'a:1:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/1a427404d6bf2cfff0accc0674654ae5.jpg\";}', '12354.00', '123.00', 'public', '2020-03-24 01:10:26', '2020-03-24 05:21:26'),
(32, '测试商品3', 'U1980', 'simple', 0, 7777, 'http://maxshop.natapp1.cc/upload/images/20200324/c5f47a270d253b5d911878adc5ab0b4a.jpg', 43, 'a:1:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/829c5c848c3648f024eb1df119b325c9.jpg\";}', 'a:1:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/5b9985a2b4c6790cf7862224bab476da.jpg\";}', '777.00', '77.00', 'public', '2020-03-23 20:54:51', '2020-03-24 05:20:48'),
(30, '测试商品1', 'U1980-', 'simple', 0, 999, 'http://maxshop.natapp1.cc/upload/images/20200324/ea10fe68cb01829baa98ebbc5bcd7373.jpg', 42, 'a:2:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/e8e6efdbdb46dd366ba86a13c39db8e9.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/44a9d41cda69de34d07af538203a974f.jpg\";}', 'a:2:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/cbda6e7b9509177308985fdc91fb7405.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/3f82048a8cb270023e340f60bfa6e41e.jpg\";}', '999.00', '99.00', 'public', '2020-03-23 20:53:55', '2020-03-24 05:20:54'),
(27, '啊啊啊', NULL, 'child', 26, 111, 'http://maxshop.natapp1.cc//upload/images/20200320/872fff501a949a22a3162299272884d9.jpg', NULL, NULL, NULL, '111.00', '0.00', 'public', '2020-03-20 05:59:13', '2020-03-20 05:59:13'),
(28, '表不表', NULL, 'child', 26, 222, 'http://maxshop.natapp1.cc//upload/images/20200320/3d5d2fd8e3f973d949eb6cfa5d60bbb3.jpg', NULL, NULL, NULL, '222.00', '0.00', 'public', '2020-03-20 05:59:13', '2020-03-20 05:59:13'),
(29, '踩踩踩', NULL, 'child', 26, 333, 'http://maxshop.natapp1.cc//upload/images/20200320/1729dbc7b22aa1922123b21cc24b4711.png', NULL, NULL, NULL, '333.00', '0.00', 'public', '2020-03-20 05:59:13', '2020-03-20 05:59:13'),
(31, '测试商品2', 'U1980', 'simple', 0, 8888, 'http://maxshop.natapp1.cc/upload/images/20200324/48214a94928cd2fe403f98ab1d94ed62.jpg', 43, 'a:2:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/29fee02ce9051f47b7cf0fc612e06cac.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/8cdcf65f8b96f7ca8e41a0e4735b18c7.jpg\";}', 'a:1:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200324/4540b4cab542a26054e2d392e0b1b945.jpg\";}', '888.00', '88.00', 'public', '2020-03-23 20:54:25', '2020-03-24 05:20:59'),
(25, '测试的商品', 'U1980', 'simple', 0, 1000, 'http://maxshop.natapp1.cc//upload/images/20200320/37e420401a1b61d67f385b7c73e044ac.jpg', 41, 'a:3:{i:0;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/1790006da0d0859a7bae67655777d562.png\";i:1;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/1666570cfacdcd24e767d919b1bea02f.jpg\";i:2;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/ae20cd18476cdc4351cba95ff99e793d.jpg\";}', 'a:2:{i:0;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/3895973df23d7f0e83e0db75902e0d94.jpg\";i:1;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/5ea52b3046b8dfdea1b40db52ca367be.jpg\";}', '900.00', '720.00', 'public', '2020-03-20 05:50:00', '2020-03-23 20:12:07'),
(26, '哦我是猪？', 'U1980', 'variable', 0, 0, 'http://maxshop.natapp1.cc/upload/images/20200324/10dfea6c9e285d6227bee8f7884ee41a.jpg', 46, 'a:2:{i:0;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/496546bd9a2178a8857b39467157e39f.jpg\";i:1;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/139c71581cd7d18fea62bc2b4985be27.jpg\";}', 'a:1:{i:0;s:86:\"http://maxshop.natapp1.cc//upload/images/20200320/b51faca4c80a7c0b2737683907246047.jpg\";}', '0.00', '0.00', 'public', '2020-03-20 05:59:13', '2020-03-24 05:26:37'),
(34, 'demo123', '12312413', 'simple', 0, 100000, 'http://maxshop.natapp1.cc/upload/images/20200416/37f1aa6f6f52a1d20111732b5b782ceb.jpg', 41, 'a:3:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/606dc182a50e1a8b4dce21d4860e977a.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/62077adfa99a05c4637f72a14edc572d.jpg\";i:2;s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/74709fa4ca9894d3bbb8465c5f3ae075.jpg\";}', 'a:1:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200416/326ffc09473fdcd1b66f8bd2557173e5.jpg\";}', '1235.10', '85.59', 'public', '2020-04-15 23:11:56', '2020-04-15 23:11:56'),
(35, '一分钱的商品', '12123123', 'simple', 0, 10000, 'http://maxshop.natapp1.cc/upload/images/20200629/047c6337921b912ab86112995f4a6ad8.jpg', 47, 'a:4:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/61a12f9b453b5a3912ff7495850677e0.jpg\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/a7fadca0ec958f940649f5ff93322dca.jpg\";i:2;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/ead946b972897b1e9a3e137eafe2e487.jpg\";i:3;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/1de3f7af920bd83fcb78e78702d4eef6.jpg\";}', 'a:2:{i:0;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/7dd1fae3637e13dffdb9681f2c85485c.png\";i:1;s:85:\"http://maxshop.natapp1.cc/upload/images/20200629/4233985c8e91116bb4ce7b15f860210a.jpg\";}', '0.10', '0.02', 'public', '2020-06-29 06:58:56', '2020-06-29 07:22:23');

-- --------------------------------------------------------

--
-- 表的结构 `max_product_meta`
--

DROP TABLE IF EXISTS `max_product_meta`;
CREATE TABLE IF NOT EXISTS `max_product_meta` (
  `p_meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`p_meta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `max_product_meta`
--

INSERT INTO `max_product_meta` (`p_meta_id`, `product_id`, `slug`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(10, 17, '销量', 'sales', 'i:0;', '2020-03-16 23:57:34', '2020-03-16 23:57:34'),
(9, 16, '销量', 'sales', 'i:0;', '2020-03-16 05:48:26', '2020-03-16 05:48:26'),
(8, 15, '销量', 'sales', 'i:0;', '2020-03-16 05:44:38', '2020-03-16 05:44:38'),
(7, 14, '销量', 'sales', 'i:0;', '2020-03-16 05:42:31', '2020-03-16 05:42:31'),
(6, 13, '销量', 'sales', 'i:0;', '2020-03-16 05:40:27', '2020-03-16 05:40:27'),
(11, 18, '销量', 'sales', 'i:0;', '2020-03-17 00:00:04', '2020-03-17 00:00:04'),
(12, 19, '销量', 'sales', 'i:0;', '2020-03-17 23:40:55', '2020-03-17 23:40:55'),
(13, 22, '销量', 'sales', 'i:0;', '2020-03-17 23:49:19', '2020-03-17 23:49:19'),
(14, 23, '销量', 'sales', 'i:0;', '2020-03-17 23:51:47', '2020-03-17 23:51:47'),
(15, 25, '销量', 'sales', 'i:0;', '2020-03-20 05:50:00', '2020-03-20 05:50:00'),
(16, 26, '销量', 'sales', 'i:0;', '2020-03-20 05:59:13', '2020-03-20 05:59:13'),
(17, 30, '销量', 'sales', 'i:0;', '2020-03-23 20:53:55', '2020-03-23 20:53:55'),
(18, 31, '销量', 'sales', 'i:0;', '2020-03-23 20:54:25', '2020-03-23 20:54:25'),
(19, 32, '销量', 'sales', 'i:0;', '2020-03-23 20:54:51', '2020-03-23 20:54:51'),
(20, 33, '销量', 'sales', 'i:0;', '2020-03-24 01:10:26', '2020-03-24 01:10:26'),
(21, 34, '销量', 'sales', 'i:0;', '2020-04-15 23:11:56', '2020-04-15 23:11:56'),
(22, 35, '销量', 'sales', 'i:0;', '2020-06-29 06:58:56', '2020-06-29 06:58:56');

-- --------------------------------------------------------

--
-- 表的结构 `max_shipping`
--

DROP TABLE IF EXISTS `max_shipping`;
CREATE TABLE IF NOT EXISTS `max_shipping` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `shipping_data` varchar(4196) NOT NULL COMMENT '包含运输的区域，邮费信息',
  `status` varchar(10) NOT NULL DEFAULT 'allow',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `max_shipping`
--

INSERT INTO `max_shipping` (`shipping_id`, `name`, `shipping_data`, `status`, `created_at`, `updated_at`) VALUES
(2, '顺丰速运', 'a:31:{i:0;a:1:{s:6:\"广东\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:1;a:1:{s:6:\"广西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:2;a:1:{s:6:\"江苏\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:3;a:1:{s:6:\"浙江\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:4;a:1:{s:6:\"上海\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:5;a:1:{s:6:\"福建\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:6;a:1:{s:6:\"北京\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:7;a:1:{s:6:\"湖北\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:8;a:1:{s:6:\"山东\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:9;a:1:{s:6:\"安徽\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:10;a:1:{s:6:\"江西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:11;a:1:{s:6:\"湖南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:12;a:1:{s:6:\"河南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:13;a:1:{s:6:\"河北\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:14;a:1:{s:6:\"四川\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:15;a:1:{s:6:\"海南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:16;a:1:{s:6:\"天津\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:17;a:1:{s:6:\"重庆\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:18;a:1:{s:6:\"云南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:19;a:1:{s:6:\"贵州\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:20;a:1:{s:6:\"山西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:21;a:1:{s:6:\"陕西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:22;a:1:{s:6:\"辽宁\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:23;a:1:{s:6:\"吉林\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:24;a:1:{s:9:\"黑龙江\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:25;a:1:{s:6:\"甘肃\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:26;a:1:{s:6:\"青海\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:27;a:1:{s:6:\"宁夏\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:28;a:1:{s:9:\"内蒙古\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:29;a:1:{s:6:\"新疆\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:30;a:1:{s:6:\"西藏\";a:2:{s:4:\"cost\";s:6:\"西藏\";s:6:\"status\";s:5:\"allow\";}}}', 'allow', '2020-03-26 00:48:10', '2020-03-26 00:48:10'),
(3, '百世快递', 'a:31:{i:0;a:1:{s:6:\"广东\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:1;a:1:{s:6:\"广西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:2;a:1:{s:6:\"江苏\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:3;a:1:{s:6:\"浙江\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:4;a:1:{s:6:\"上海\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:5;a:1:{s:6:\"福建\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:6;a:1:{s:6:\"北京\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:7;a:1:{s:6:\"湖北\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:8;a:1:{s:6:\"山东\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:9;a:1:{s:6:\"安徽\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:10;a:1:{s:6:\"江西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:11;a:1:{s:6:\"湖南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:12;a:1:{s:6:\"河南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:13;a:1:{s:6:\"河北\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:14;a:1:{s:6:\"四川\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:15;a:1:{s:6:\"海南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:16;a:1:{s:6:\"天津\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:17;a:1:{s:6:\"重庆\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:18;a:1:{s:6:\"云南\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:19;a:1:{s:6:\"贵州\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:20;a:1:{s:6:\"山西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:21;a:1:{s:6:\"陕西\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:22;a:1:{s:6:\"辽宁\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:23;a:1:{s:6:\"吉林\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:24;a:1:{s:9:\"黑龙江\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:25;a:1:{s:6:\"甘肃\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:26;a:1:{s:6:\"青海\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:27;a:1:{s:6:\"宁夏\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:28;a:1:{s:9:\"内蒙古\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:29;a:1:{s:6:\"新疆\";a:2:{s:4:\"cost\";s:5:\"10.00\";s:6:\"status\";s:5:\"allow\";}}i:30;a:1:{s:6:\"西藏\";a:2:{s:4:\"cost\";s:6:\"西藏\";s:6:\"status\";s:5:\"allow\";}}}', 'allow', '2020-03-26 01:22:21', '2020-03-26 01:22:21');

-- --------------------------------------------------------

--
-- 表的结构 `max_stores`
--

DROP TABLE IF EXISTS `max_stores`;
CREATE TABLE IF NOT EXISTS `max_stores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `max_users`
--

DROP TABLE IF EXISTS `max_users`;
CREATE TABLE IF NOT EXISTS `max_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_key` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activition_key` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `max_users`
--

INSERT INTO `max_users` (`user_id`, `openid`, `session_key`, `username`, `password`, `avatar_url`, `nickname`, `phone`, `email`, `activition_key`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Jiang', 'jiangjibi8', NULL, 'JueXie', '15622334008', '734714758@qq.com', NULL, 1, '2020-03-02 00:42:27', '2020-03-03 23:29:33'),
(2, NULL, NULL, 'admin', 'jiangjibi8', NULL, 'root', '18127945951', '734714758@qq.com', NULL, 1, '2020-03-02 01:08:31', '2020-03-02 01:08:31'),
(4, NULL, NULL, 'Qian', 'jiangjibi8', NULL, 'Qian', '15622334008', '734714758@qq.com', NULL, 1, '2020-03-03 12:33:15', '2020-03-03 15:51:28'),
(9, NULL, NULL, '734714758', 'jiangjibi8', NULL, 'Admin', '15622334008', '2648950779@qq.com', 'created_by_admin', 1, '2020-03-03 23:55:52', '2020-03-03 23:55:52'),
(10, NULL, NULL, 'yangwei', 'yangwei688', NULL, 'youngwei', '18662135654', 'yangweiprogram@163.com', 'created_by_admin', 1, '2020-03-04 02:59:50', '2020-03-04 02:59:50'),
(14, 'oe2xX42jfkYurrmN6iCpr0oPVFtE', 'MjTZiOMgboMxvx5zdf1MAw==', 'created_by_wechatminiprogram', 'no_password', 'https://wx.qlogo.cn/mmopen/vi_32/ueuMuaKIY0qKZficXXaJTRD1fNftMlqlQFboy1XKufnN99SRMHOQtq2DP3MQa5MAd7x2m6yw93geOoYjHdianpiaQ/132', '今天你吃饭了吗！', 'no_phone', 'no_email', 'no_activition_key', 1, '2020-03-19 08:24:58', '2020-03-20 21:04:54'),
(13, 'oe2xX48f_7suhgZN7HwxA5OO2js8', 'E4p9irb9Nst9eA8XiMGn5w==', 'created_by_wechatminiprogram', 'no_password', 'https://wx.qlogo.cn/mmopen/vi_32/Jng3QOA6Xp64NtNNa9T6OfNIbwYyOddTyHcG89Wj2xFnrFaedpdl0jyvuTM7YFRLLZUAxzel1nx7hU3TJicCVuA/132', '江', 'no_phone', 'no_email', 'no_activition_key', 1, '2020-03-13 08:02:09', '2020-06-22 05:35:34'),
(15, 'oKvQF5lhDoztBmpfuTecQQHP6FXU', 'DzQbul8TwUrz25SrPvCJoQ==', 'created_by_wechatminiprogram', 'no_password', 'https://wx.qlogo.cn/mmopen/vi_32/yQAo8WOgN8Wv9f493yy2QBxewxbibJI3LWk7CicywQfj3YyRM4KibcTaYxY8sLmgbVh4HCJu7woDBgurgsr1duicxA/132', '今天你吃饭了吗！', 'no_phone', 'no_email', 'no_activition_key', 1, '2020-06-23 19:40:48', '2020-07-07 03:45:09'),
(16, 'oKvQF5kudZgs0SirYv2PE62jYZ2U', '8WzjC+eWpHahc7ooMPdUhA==', 'created_by_wechatminiprogram', 'no_password', 'https://wx.qlogo.cn/mmopen/vi_32/DhpI3K9fWX4SaoHYctialI8RF7aQRwcYyxice4eDX1icZRnwwOxzEOAHpMSk6d0ub9zRVYXVFu5ej9UgnGm9LJF6w/132', '江', 'no_phone', 'no_email', 'no_activition_key', 1, '2020-06-30 12:15:12', '2020-06-30 12:15:12');

-- --------------------------------------------------------

--
-- 表的结构 `max_user_meta`
--

DROP TABLE IF EXISTS `max_user_meta`;
CREATE TABLE IF NOT EXISTS `max_user_meta` (
  `u_meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '别名，用于显示',
  `meta_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`u_meta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `max_user_meta`
--

INSERT INTO `max_user_meta` (`u_meta_id`, `user_id`, `slug`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(8, 1, '积分', 'score', 's:3:\"900\";', '2020-03-03 10:48:46', '2020-03-03 23:28:43'),
(10, 9, '积分', 'score', 'i:0;', '2020-03-03 23:55:52', '2020-03-03 23:55:52'),
(16, 13, '积分', 'score', 'i:0;', '2020-03-13 08:02:09', '2020-03-13 08:02:09'),
(15, 13, '微信用户信息', 'userInfo', 'a:9:{s:6:\"openId\";s:28:\"oe2xX48f_7suhgZN7HwxA5OO2js8\";s:8:\"nickName\";s:3:\"江\";s:6:\"gender\";i:1;s:8:\"language\";s:5:\"zh_CN\";s:4:\"city\";s:0:\"\";s:8:\"province\";s:0:\"\";s:7:\"country\";s:7:\"Albania\";s:9:\"avatarUrl\";s:124:\"https://wx.qlogo.cn/mmopen/vi_32/Jng3QOA6Xp64NtNNa9T6OfNIbwYyOddTyHcG89Wj2xFnrFaedpdl0jyvuTM7YFRLLZUAxzel1nx7hU3TJicCVuA/132\";s:9:\"watermark\";a:2:{s:9:\"timestamp\";i:1584115317;s:5:\"appid\";s:18:\"wx2995805d095ca479\";}}', '2020-03-13 08:02:09', '2020-03-13 08:02:09'),
(17, 14, '微信用户信息', 'userInfo', 'a:9:{s:6:\"openId\";s:28:\"oe2xX42jfkYurrmN6iCpr0oPVFtE\";s:8:\"nickName\";s:24:\"今天你吃饭了吗！\";s:6:\"gender\";i:0;s:8:\"language\";s:5:\"zh_CN\";s:4:\"city\";s:0:\"\";s:8:\"province\";s:0:\"\";s:7:\"country\";s:0:\"\";s:9:\"avatarUrl\";s:126:\"https://wx.qlogo.cn/mmopen/vi_32/ueuMuaKIY0qKZficXXaJTRD1fNftMlqlQFboy1XKufnN99SRMHOQtq2DP3MQa5MAd7x2m6yw93geOoYjHdianpiaQ/132\";s:9:\"watermark\";a:2:{s:9:\"timestamp\";i:1584635086;s:5:\"appid\";s:18:\"wx2995805d095ca479\";}}', '2020-03-19 08:24:58', '2020-03-19 08:24:58'),
(18, 14, '积分', 'score', 'i:0;', '2020-03-19 08:24:58', '2020-03-19 08:24:58'),
(19, 15, '微信用户信息', 'userInfo', 'a:9:{s:6:\"openId\";s:28:\"oKvQF5lhDoztBmpfuTecQQHP6FXU\";s:8:\"nickName\";s:24:\"今天你吃饭了吗！\";s:6:\"gender\";i:0;s:8:\"language\";s:5:\"zh_CN\";s:4:\"city\";s:0:\"\";s:8:\"province\";s:0:\"\";s:7:\"country\";s:0:\"\";s:9:\"avatarUrl\";s:127:\"https://wx.qlogo.cn/mmopen/vi_32/yQAo8WOgN8Wv9f493yy2QBxewxbibJI3LWk7CicywQfj3YyRM4KibcTaYxY8sLmgbVh4HCJu7woDBgurgsr1duicxA/132\";s:9:\"watermark\";a:2:{s:9:\"timestamp\";i:1592970038;s:5:\"appid\";s:18:\"wxddc9101001dc0fbe\";}}', '2020-06-23 19:40:48', '2020-06-23 19:40:48'),
(20, 15, '积分', 'score', 'i:0;', '2020-06-23 19:40:48', '2020-06-23 19:40:48'),
(21, 16, '微信用户信息', 'userInfo', 'a:9:{s:6:\"openId\";s:28:\"oKvQF5kudZgs0SirYv2PE62jYZ2U\";s:8:\"nickName\";s:3:\"江\";s:6:\"gender\";i:1;s:8:\"language\";s:5:\"zh_CN\";s:4:\"city\";s:0:\"\";s:8:\"province\";s:0:\"\";s:7:\"country\";s:7:\"Albania\";s:9:\"avatarUrl\";s:126:\"https://wx.qlogo.cn/mmopen/vi_32/DhpI3K9fWX4SaoHYctialI8RF7aQRwcYyxice4eDX1icZRnwwOxzEOAHpMSk6d0ub9zRVYXVFu5ej9UgnGm9LJF6w/132\";s:9:\"watermark\";a:2:{s:9:\"timestamp\";i:1593519308;s:5:\"appid\";s:18:\"wxddc9101001dc0fbe\";}}', '2020-06-30 12:15:12', '2020-06-30 12:15:12'),
(22, 16, '积分', 'score', 'i:0;', '2020-06-30 12:15:12', '2020-06-30 12:15:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
