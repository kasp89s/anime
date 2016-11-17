-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 18 2016 г., 02:41
-- Версия сервера: 5.5.50-MariaDB
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `orion`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text,
  `imageFileName` varchar(255) NOT NULL,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `name`, `content`, `imageFileName`, `startTime`, `endTime`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(4, 'Слайд 1', '<p>This will automatically create an iframe with sportsbook inside the container div element.<br></p>', 'dummy-img2.png', '2016-10-31 21:00:00', '2016-11-29 21:00:00', 1, '2016-11-10 09:23:02', NULL, 1, NULL),
(5, 'Слайд 2', '<p>This will automatically create an iframe with sportsbook inside the container div element.<br></p>', 'dummy-img1.png', '2016-11-01 21:00:00', '2016-11-29 21:00:00', 1, '2016-11-10 09:23:29', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(10) unsigned NOT NULL,
  `sessionId` char(32) NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `sessionId`, `customerId`, `createTime`) VALUES
(2, 'o0gufrvsv6qdbh42uhu4jd2p33', 0, '2016-11-10 08:30:18'),
(3, 'o0gufrvsv6qdbh42uhu4jd2p33', 2, '2016-11-10 09:11:57'),
(4, 'peve07b2d3j3s4rrhbhap64sk5', 0, '2016-11-10 12:19:06'),
(5, 'le21t4vnve9mdd97nr9t3pck26', 0, '2016-11-12 21:35:08'),
(6, 'j9i0f3en1908k52cpi8kas68m5', 0, '2016-11-14 12:20:56'),
(7, 'lcc99bsm3g8k0lk434fnh5nvo2', 0, '2016-11-14 20:18:29'),
(8, 'edgnch4c5pt4ids2sa1us7h3v1', 0, '2016-11-15 21:31:58'),
(9, 'tr1le801hif6lc1hqohe889cu4', 0, '2016-11-16 13:14:26'),
(10, 's6k8lge6ri256k9j5n1lasudp2', 0, '2016-11-16 17:32:27'),
(11, '27v77fem1qcqkjrfcog1797eq1', 0, '2016-11-16 20:07:08'),
(12, 'mm6cabppi6p4h3ah1m13p8fa75', 0, '2016-11-17 18:02:13'),
(13, '4liq5le5mlfkurmurtujbsusg6', 0, '2016-11-17 18:40:59'),
(14, 'ddtpnppmhh91hh9a3dc3tjdjc3', 0, '2016-11-17 18:42:00'),
(15, 'dh5ldskb12i0rnp36qgf7c2jc2', 0, '2016-11-17 18:42:15'),
(16, 'l6h4lgu7njsi6vj9gs78qrpc96', 0, '2016-11-17 19:12:41'),
(17, 'v6fs4clhe5moi270fgr5og0el7', 0, '2016-11-17 19:19:20');

-- --------------------------------------------------------

--
-- Структура таблицы `basketproduct`
--

CREATE TABLE IF NOT EXISTS `basketproduct` (
  `id` int(10) unsigned NOT NULL,
  `basketId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basketproduct`
--

INSERT INTO `basketproduct` (`id`, `basketId`, `productId`, `quantity`) VALUES
(2, 4, 11, 1),
(3, 4, 11, 2),
(4, 4, 11, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `basketproductattribute`
--

CREATE TABLE IF NOT EXISTS `basketproductattribute` (
  `id` int(10) unsigned NOT NULL,
  `basketProductId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basketproductattribute`
--

INSERT INTO `basketproductattribute` (`id`, `basketProductId`, `productOptionId`, `productOptionValueId`) VALUES
(1, 2, 8, 14),
(2, 3, 8, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `rating` int(1) NOT NULL DEFAULT '4',
  `message` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `productId`, `userName`, `userEmail`, `rating`, `message`, `date`) VALUES
(1, 4, 'Сергей', 'kasp89s@gmail.com', 1, 'Текст отзыва', '2016-11-09 14:57:51'),
(2, 4, 'Сергей', 'kasp89s@gmail.com', 4, 'Лучшее, что я читал. Отличный комикс на все времена.', '2016-11-09 14:58:57');

-- --------------------------------------------------------

--
-- Структура таблицы `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `type` enum('percent','value') NOT NULL DEFAULT 'percent',
  `value` decimal(10,2) NOT NULL,
  `minimalOrderCost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `description`, `startTime`, `endTime`, `type`, `value`, `minimalOrderCost`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(1, 'er3432r2r3f3fdfsdfdf3', 'eweqwfefwef', '2016-10-28 21:00:00', '2016-12-27 22:00:00', 'percent', 11.00, 2112.00, 1, '2016-10-29 21:20:22', '2016-10-29 20:25:05', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `customerGroupId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `code` char(32) DEFAULT NULL,
  `registrationIp` varchar(16) DEFAULT NULL,
  `registrationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `memo` text COMMENT 'заметки продавца о покупателе'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `customerGroupId`, `isActive`, `code`, `registrationIp`, `registrationTime`, `memo`) VALUES
(0, 'default@user.net', '12345', 2, 1, NULL, NULL, '2016-11-10 08:25:40', NULL),
(2, 'boosyck@i.ua', '8349efb1b90fb33b41698cbe945769c4', 2, 1, NULL, '127.0.0.1', '2016-10-25 21:00:00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `customeraddress`
--

CREATE TABLE IF NOT EXISTS `customeraddress` (
  `id` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `countryCode` char(3) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `isPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customeraddress`
--

INSERT INTO `customeraddress` (`id`, `customerId`, `countryCode`, `city`, `zip`, `address`, `fullName`, `phone1`, `phone2`, `isPrimary`) VALUES
(2, 2, '', '', NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `customergroup`
--

CREATE TABLE IF NOT EXISTS `customergroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `groupDiscount` double(10,2) NOT NULL DEFAULT '0.00',
  `isAutomaticGroup` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `isDefault` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `groupAccumulatedLimit` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customergroup`
--

INSERT INTO `customergroup` (`id`, `name`, `description`, `groupDiscount`, `isAutomaticGroup`, `isActive`, `isDefault`, `groupAccumulatedLimit`) VALUES
(2, 'Зарегистрированные', 'Зарегистрированные клиенты', 5.00, 0, 1, 1, 1200.00);

-- --------------------------------------------------------

--
-- Структура таблицы `infopage`
--

CREATE TABLE IF NOT EXISTS `infopage` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(45) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `infopage`
--

INSERT INTO `infopage` (`id`, `code`, `title`, `content`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(2, 'delivery', 'Доставка и оплата', '<li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Доставка и оплата</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Как сделать заказ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Вопрос-ответ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Система скидок</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Контакты</a></li>', '2016-11-06 20:26:58', NULL, 1, NULL),
(3, 'order_create', 'Как сделать заказ', '<li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Доставка и оплата</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Как сделать заказ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Вопрос-ответ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Система скидок</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Контакты</a></li>', '2016-11-06 20:27:41', NULL, 1, NULL),
(4, 'faq', 'Вопрос-ответ', '<li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Доставка и оплата</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Как сделать заказ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Вопрос-ответ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Система скидок</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Контакты</a></li>', '2016-11-06 20:28:09', NULL, 1, NULL),
(5, 'discount_system', 'Система скидок', '<li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Доставка и оплата</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Как сделать заказ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Вопрос-ответ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Система скидок</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Контакты</a></li>', '2016-11-06 20:28:33', NULL, 1, NULL),
(6, 'contacts', 'Контакты', '<li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Доставка и оплата</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Как сделать заказ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Вопрос-ответ</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Система скидок</a></li><li style="padding: 0px; margin: 0px; outline: none; float: left; color: rgb(255, 255, 255); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(112, 94, 156);"><a href="http://localhost/" style="padding: 0px 15px; margin: 0px; outline: none; color: rgb(255, 255, 255); display: block;">Контакты</a></li>', '2016-11-06 20:33:19', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `shortContent` text NOT NULL,
  `content` longtext NOT NULL,
  `imageFileName` varchar(255) DEFAULT NULL,
  `formatedShortContent` text,
  `formatedContent` longtext,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `publishTime` timestamp NULL DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `shortContent`, `content`, `imageFileName`, `formatedShortContent`, `formatedContent`, `isActive`, `publishTime`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(4, 'Предзаказ. Мордобой, Скотт, Велес, Орда, Ассассины', 'Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!\r\n«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»\r\nУсловия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)', '<p class="article-info" style="padding: 0px; margin-bottom: 18px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p class="ready-to-buy" style="padding: 0px; margin-bottom: 18px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p class="info-danger" style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p>', 'news2.png', NULL, NULL, 1, '2016-11-06 12:44:08', '2016-11-06 12:52:45', '2016-11-06 12:44:08', 1, 1),
(5, 'Предзаказ. Мордобой, Скотт, Велес, Орда, Ассассины', '<p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p>', '<p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p>', 'news3.png', NULL, NULL, 1, '2016-11-06 12:45:42', '2016-11-06 13:42:22', '2016-11-06 12:45:42', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `newslettersubscriber`
--

CREATE TABLE IF NOT EXISTS `newslettersubscriber` (
  `id` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `code` char(32) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `newslettersubscriber`
--

INSERT INTO `newslettersubscriber` (`id`, `customerId`, `email`, `isActive`, `code`, `createTime`) VALUES
(2, 2, 'boosyck@i.ua', 0, '582e400544d58', '2016-11-17 23:40:57');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `shippingId` int(10) unsigned NOT NULL,
  `paymentId` int(10) unsigned NOT NULL,
  `currencyCode` char(3) NOT NULL,
  `orderStatus` char(2) NOT NULL,
  `couponCode` varchar(255) DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `isFinished` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'по данному заказу расчёт произведён'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `customerId`, `shippingId`, `paymentId`, `currencyCode`, `orderStatus`, `couponCode`, `createTime`, `updateTime`, `isFinished`) VALUES
(11, 2, 3, 2, 'грн', '1', '', '2016-11-17 19:28:53', NULL, 0),
(12, 2, 4, 4, 'грн', '1', '', '2016-11-17 19:29:58', NULL, 0),
(13, 2, 3, 4, 'грн', '1', 'er3432r2r3f3fdfsdfdf3', '2016-11-17 19:31:32', NULL, 0),
(14, 2, 3, 2, 'грн', '1', '', '2016-11-17 20:57:49', NULL, 0),
(15, 2, 3, 2, 'грн', '1', '', '2016-11-17 20:59:09', NULL, 0),
(16, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:07:30', NULL, 0),
(17, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:13:01', NULL, 0),
(18, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:18:26', NULL, 0),
(19, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:18:50', NULL, 0),
(20, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:21:23', NULL, 0),
(21, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:21:57', NULL, 0),
(22, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:22:35', NULL, 0),
(23, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:22:45', NULL, 0),
(24, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:25:33', NULL, 0),
(25, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:27:25', NULL, 0),
(26, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:37:33', NULL, 0),
(27, 2, 3, 2, 'грн', '1', '', '2016-11-17 21:39:12', NULL, 0),
(28, 2, 4, 2, 'грн', '1', '', '2016-11-17 21:42:29', NULL, 0),
(29, 2, 4, 2, 'грн', '1', '', '2016-11-17 21:42:58', NULL, 0),
(30, 2, 4, 3, 'грн', '1', '', '2016-11-17 21:44:34', NULL, 0),
(31, 2, 4, 3, 'грн', '1', '', '2016-11-17 21:46:46', NULL, 0),
(32, 2, 4, 3, 'грн', '1', '', '2016-11-17 19:47:54', NULL, 0),
(33, 2, 4, 3, 'грн', '1', '', '2016-11-17 19:50:12', NULL, 0),
(34, 2, 3, 2, 'грн', '1', '', '2016-11-17 19:51:10', NULL, 0),
(35, 2, 3, 2, 'грн', '1', '', '2016-11-17 20:21:41', NULL, 0),
(36, 2, 3, 2, 'грн', '1', '', '2016-11-17 20:53:31', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ordercustomerinfo`
--

CREATE TABLE IF NOT EXISTS `ordercustomerinfo` (
  `id` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `сountryCode` char(3) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ordercustomerinfo`
--

INSERT INTO `ordercustomerinfo` (`id`, `orderId`, `сountryCode`, `city`, `zip`, `address`, `fullName`, `phone1`, `phone2`) VALUES
(8, 11, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(9, 12, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(10, 13, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(11, 14, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(12, 15, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(13, 16, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(14, 17, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(15, 18, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(16, 19, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(17, 20, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(18, 21, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(19, 22, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(20, 23, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(21, 24, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(22, 25, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(23, 26, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(24, 27, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(25, 28, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(26, 29, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(27, 30, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(28, 31, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(29, 32, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(30, 33, 'UAH', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(31, 34, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(32, 35, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(33, 36, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orderhistory`
--

CREATE TABLE IF NOT EXISTS `orderhistory` (
  `id` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `orderStatus` char(2) NOT NULL,
  `comment` text,
  `isCustomerNotified` tinyint(1) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orderpostbarcode`
--

CREATE TABLE IF NOT EXISTS `orderpostbarcode` (
  `id` int(11) NOT NULL,
  `orderId` int(10) unsigned DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barcode` varchar(45) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orderproduct`
--

CREATE TABLE IF NOT EXISTS `orderproduct` (
  `id` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `productSku` varchar(255) NOT NULL,
  `productName` varchar(500) NOT NULL,
  `productQuantity` int(10) unsigned NOT NULL,
  `productPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productIncomingPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isPreOrder` tinyint(1) NOT NULL DEFAULT '0',
  `currencyCode` char(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderproduct`
--

INSERT INTO `orderproduct` (`id`, `orderId`, `productId`, `productSku`, `productName`, `productQuantity`, `productPrice`, `productIncomingPrice`, `isPreOrder`, `currencyCode`) VALUES
(22, 11, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(23, 11, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(24, 11, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(25, 11, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(26, 11, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(27, 12, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(28, 12, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(29, 12, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(30, 12, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(31, 12, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(32, 13, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(33, 13, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(34, 13, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(35, 13, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(36, 13, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(37, 14, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(38, 14, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(39, 14, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(40, 14, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(41, 14, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(42, 15, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(43, 15, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(44, 15, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(45, 15, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(46, 15, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(47, 16, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(48, 16, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(49, 16, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(50, 16, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(51, 16, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(52, 17, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(53, 17, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(54, 17, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(55, 17, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(56, 17, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(57, 18, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(58, 18, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(59, 18, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(60, 18, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(61, 18, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(62, 19, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(63, 19, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(64, 19, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(65, 19, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(66, 19, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(67, 20, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(68, 20, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(69, 20, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(70, 20, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(71, 20, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(72, 21, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(73, 21, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(74, 21, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(75, 21, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(76, 21, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(77, 22, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(78, 22, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(79, 22, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(80, 22, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(81, 22, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(82, 23, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(83, 23, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(84, 23, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(85, 23, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(86, 23, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(87, 24, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(88, 24, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(89, 24, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(90, 24, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(91, 24, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(92, 25, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(93, 25, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(94, 25, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(95, 25, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(96, 25, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(97, 26, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(98, 26, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(99, 26, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(100, 26, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(101, 26, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(102, 27, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(103, 27, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(104, 27, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(105, 27, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(106, 27, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(107, 28, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(108, 28, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(109, 28, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(110, 28, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(111, 28, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(112, 29, 5, 'KO658', 'Ходячие мертвецы', 1, 500.00, 1000.00, 0, 'грн'),
(113, 29, 11, 'KO543', 'Сын М', 2, 877.00, 444.00, 0, 'грн'),
(114, 29, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(115, 29, 11, 'KO543', 'Сын М', 1, 877.00, 444.00, 0, 'грн'),
(116, 29, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(117, 30, 5, 'KO658', 'Ходячие мертвецы', 1, 440.00, 1000.00, 0, 'грн'),
(118, 30, 11, 'KO543', 'Сын М', 2, 789.00, 444.00, 0, 'грн'),
(119, 30, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(120, 30, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(121, 30, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(122, 31, 5, 'KO658', 'Ходячие мертвецы', 1, 440.00, 1000.00, 0, 'грн'),
(123, 31, 11, 'KO543', 'Сын М', 2, 789.00, 444.00, 0, 'грн'),
(124, 31, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(125, 31, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(126, 31, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(127, 32, 5, 'KO658', 'Ходячие мертвецы', 1, 440.00, 1000.00, 0, 'грн'),
(128, 32, 11, 'KO543', 'Сын М', 2, 789.00, 444.00, 0, 'грн'),
(129, 32, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(130, 32, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(131, 32, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(132, 33, 5, 'KO658', 'Ходячие мертвецы', 1, 440.00, 1000.00, 0, 'грн'),
(133, 33, 11, 'KO543', 'Сын М', 2, 789.00, 444.00, 0, 'грн'),
(134, 33, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(135, 33, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(136, 33, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(137, 34, 9, 'KO459', 'Мразь', 1, 340.00, 111.00, 0, 'грн'),
(138, 34, 4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', 1, 900.00, 1200.00, 0, 'UAH'),
(139, 35, 7, 'KO999', 'Пора туманов', 2, 360.00, 111.00, 0, 'грн'),
(140, 36, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(141, 36, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(142, 36, 4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', 1, 900.00, 1200.00, 0, 'UAH');

-- --------------------------------------------------------

--
-- Структура таблицы `orderproductattribute`
--

CREATE TABLE IF NOT EXISTS `orderproductattribute` (
  `id` int(10) unsigned NOT NULL,
  `orderProductId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL,
  `productOptionName` varchar(255) NOT NULL,
  `productOptionValueName` varchar(255) NOT NULL,
  `productAttributePrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currencyCode` char(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderproductattribute`
--

INSERT INTO `orderproductattribute` (`id`, `orderProductId`, `productOptionId`, `productOptionValueId`, `productOptionName`, `productOptionValueName`, `productAttributePrice`, `currencyCode`) VALUES
(1, 23, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(2, 24, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(3, 25, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(4, 28, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(5, 29, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(6, 30, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(7, 33, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(8, 34, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(9, 35, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(10, 38, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(11, 39, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(12, 40, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(13, 43, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(14, 44, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(15, 45, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(16, 48, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(17, 49, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(18, 50, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(19, 53, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(20, 54, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(21, 55, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(22, 58, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(23, 59, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(24, 60, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(25, 63, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(26, 64, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(27, 65, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(28, 68, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(29, 69, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(30, 70, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(31, 73, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(32, 74, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(33, 75, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(34, 78, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(35, 79, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(36, 80, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(37, 83, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(38, 84, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(39, 85, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(40, 88, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(41, 89, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(42, 90, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(43, 93, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(44, 94, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(45, 95, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(46, 98, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(47, 99, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(48, 100, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(49, 103, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(50, 104, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(51, 105, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(52, 108, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(53, 109, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(54, 110, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(55, 113, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(56, 114, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(57, 115, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(58, 118, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(59, 119, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(60, 120, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(61, 123, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(62, 124, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(63, 125, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(64, 128, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(65, 129, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(66, 130, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(67, 133, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(68, 134, 8, 12, 'Размер', 'S', -20.00, 'грн'),
(69, 135, 8, 13, 'Размер', 'M', 0.00, 'грн');

-- --------------------------------------------------------

--
-- Структура таблицы `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int(11) NOT NULL,
  `statusCode` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `isChargeble` tinyint(1) NOT NULL DEFAULT '0',
  `isPaid` tinyint(1) NOT NULL DEFAULT '0',
  `isShipped` tinyint(1) NOT NULL DEFAULT '0',
  `isRestock` tinyint(1) NOT NULL DEFAULT '0',
  `isPenalty` tinyint(1) NOT NULL DEFAULT '0',
  `isFinished` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `statusCode`, `name`, `isDefault`, `isChargeble`, `isPaid`, `isShipped`, `isRestock`, `isPenalty`, `isFinished`) VALUES
(1, '1', 'Создан', 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ordertotal`
--

CREATE TABLE IF NOT EXISTS `ordertotal` (
  `id` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currencyCode` char(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ordertotal`
--

INSERT INTO `ordertotal` (`id`, `orderId`, `code`, `name`, `amount`, `currencyCode`) VALUES
(5, 11, NULL, NULL, 3132.00, 'грн'),
(6, 12, NULL, NULL, 3212.00, 'грн'),
(7, 13, NULL, NULL, 2819.00, 'грн'),
(8, 14, NULL, NULL, 3132.00, 'грн'),
(9, 15, NULL, NULL, 3132.00, 'грн'),
(10, 16, NULL, NULL, 3132.00, 'грн'),
(11, 17, NULL, NULL, 3132.00, 'грн'),
(12, 18, NULL, NULL, 3132.00, 'грн'),
(13, 19, NULL, NULL, 3132.00, 'грн'),
(14, 20, NULL, NULL, 3132.00, 'грн'),
(15, 21, NULL, NULL, 3132.00, 'грн'),
(16, 22, NULL, NULL, 3132.00, 'грн'),
(17, 23, NULL, NULL, 3132.00, 'грн'),
(18, 24, NULL, NULL, 3132.00, 'грн'),
(19, 25, NULL, NULL, 3132.00, 'грн'),
(20, 26, NULL, NULL, 3132.00, 'грн'),
(21, 27, NULL, NULL, 3132.00, 'грн'),
(22, 28, NULL, NULL, 3162.00, 'грн'),
(23, 29, NULL, NULL, 3162.00, 'грн'),
(24, 30, NULL, NULL, 3162.00, 'грн'),
(25, 31, NULL, NULL, 3162.00, 'грн'),
(26, 32, NULL, NULL, 3162.00, 'грн'),
(27, 33, NULL, NULL, 3162.00, 'грн'),
(28, 34, NULL, NULL, 1178.00, 'грн'),
(29, 35, NULL, NULL, 684.00, 'грн'),
(30, 36, NULL, NULL, 2080.00, 'грн');

-- --------------------------------------------------------

--
-- Структура таблицы `paymentmethod`
--

CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `countryCode` char(3) DEFAULT NULL,
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `feePercent` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`, `countryCode`, `description`, `imageFileName`, `price`, `feePercent`) VALUES
(2, 'Наличными', 'UA', '', NULL, NULL, 0.00),
(3, 'Предоплата', 'UA', '', NULL, NULL, 0.00),
(4, 'Наложенный платеж', 'UA', '', NULL, 50.00, 0.00),
(5, 'Visa/MasterCard', 'UA', '', NULL, NULL, 3.00);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text,
  `quantityInStock` int(10) unsigned NOT NULL DEFAULT '0',
  `quantityOfSold` int(10) unsigned NOT NULL DEFAULT '0',
  `barcode1` varchar(45) DEFAULT NULL,
  `barcode2` varchar(45) DEFAULT NULL,
  `barcode3` varchar(45) DEFAULT NULL,
  `availableTime` timestamp NULL DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currencyCode` char(3) NOT NULL,
  `productDisountId` int(10) unsigned NOT NULL DEFAULT '0',
  `productManufactureId` int(10) unsigned NOT NULL,
  `imageFileName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `description`, `quantityInStock`, `quantityOfSold`, `barcode1`, `barcode2`, `barcode3`, `availableTime`, `createTime`, `updateTime`, `price`, `currencyCode`, `productDisountId`, `productManufactureId`, `imageFileName`) VALUES
(4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 11, 0, '11111', '22222', '33333', '2016-11-29 22:00:00', '2016-11-06 22:05:24', '2016-11-09 18:37:23', 1000.00, 'UAH', 2, 3, 'dummy-img1.png'),
(5, 'KO658', 'Ходячие мертвецы', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 45, 1, '11111', '22222', '33333', '2016-11-08 21:00:00', '2016-11-09 20:42:03', NULL, 500.00, 'грн', 3, 4, 'item3.png'),
(6, 'KO777', 'Скот пилигрим 2', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 1, 1, '11111', '22222', '33333', '2016-11-08 21:00:00', '2016-11-09 20:44:08', NULL, 800.00, 'грн', 3, 3, 'last2.png'),
(7, 'KO999', 'Пора туманов', '', 2, 0, '', '', '', '2016-11-08 21:00:00', '2016-11-09 20:45:19', NULL, 400.00, 'грн', 2, 3, 'item2.png'),
(9, 'KO459', 'Мразь', '<pre style="background-color:#ffffff;color:#000000;font-family:''Courier New'';font-size:9,0pt;"><span style="color:#000080;background-color:#f7faff;font-weight:bold;">return </span><span style="background-color:#f7faff;font-style:italic;">round</span><span style="background-color:#f7faff;">(</span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">price </span><span style="background-color:#f7faff;">- </span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">discount</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">value</span><span style="background-color:#f7faff;">);</span></pre>', 5, 0, '', '', '', '2016-11-08 21:00:00', '2016-11-09 20:53:05', '2016-11-09 18:53:26', 378.00, 'грн', 2, 3, 'item5.png'),
(10, 'KO123', 'Боун', '<pre style="background-color:#ffffff;color:#000000;font-family:''Courier New'';font-size:9,0pt;"><span style="color:#000080;background-color:#f7faff;font-weight:bold;">return </span><span style="background-color:#f7faff;font-style:italic;">round</span><span style="background-color:#f7faff;">(</span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">price </span><span style="background-color:#f7faff;">- </span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">discount</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">value</span><span style="background-color:#f7faff;">);</span></pre>', 5, 0, '', '', '', '2016-11-07 21:00:00', '2016-11-09 21:00:41', NULL, 500.00, 'грн', 4, 3, 'last1.png'),
(11, 'KO543', 'Сын М', '<p><span style="color: rgb(51, 51, 51); font-family: ''Open Sans'', sans-serif; font-size: 14px; line-height: 22.4px;">string(586) "{"TransactionId":1478779631,"BetId":123456,"Amount":123,"Created":"2016-04-26T11:35:30.0543787Z","BetType":1,"SystemMinCount":null,"TotalPrice":2.5,"Selections":[{"SelectionId":42343,"SelectionName":"P1","MarketTypeId":333,"MarketName":"Match Result","MatchId":55,"MatchName":"Barcelona - Real Madrid","MatchStartDate":"2016-04-26T11:35:30.0543787Z","RegionId":22,"RegionName":"Spain","CompetitionId":44,"CompetitionName":"La Liga","SportId":1,"SportName":"Football","Price":2.5}],"AuthToken":"86e8f7ab32cfd12577bc2619bc635690","TS":1478779631,"Hash":"7d22124a70e6a77f2fcde9e0f470ec10"}"&nbsp;</span><br></p>', 3, 0, '11111111', '22222222', '33333333', '2016-11-09 21:00:00', '2016-11-10 14:04:31', '2016-11-10 11:16:47', 877.00, 'грн', 2, 3, 'item6.png');

-- --------------------------------------------------------

--
-- Структура таблицы `productattribute`
--

CREATE TABLE IF NOT EXISTS `productattribute` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantityInStock` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productattribute`
--

INSERT INTO `productattribute` (`id`, `productId`, `productOptionId`, `productOptionValueId`, `price`, `quantityInStock`) VALUES
(44, 11, 8, 12, 0.00, 0),
(45, 11, 8, 13, 0.00, 0),
(46, 11, 8, 14, 0.00, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategory`
--

CREATE TABLE IF NOT EXISTS `productcategory` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(500) NOT NULL,
  `parentId` int(10) unsigned NOT NULL DEFAULT '0',
  `sortOrder` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `right` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `isInQuickLink` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategory`
--

INSERT INTO `productcategory` (`id`, `name`, `parentId`, `sortOrder`, `description`, `imageFileName`, `isActive`, `createTime`, `updateTime`, `left`, `right`, `level`, `isInQuickLink`) VALUES
(34, 'Все книги', 0, 1, '', NULL, 1, '2016-11-06 20:44:46', NULL, NULL, NULL, 0, 0),
(35, 'Комиксы', 34, 0, '', '8.png', 1, '2016-11-09 19:31:31', '2016-11-10 09:30:17', NULL, NULL, 1, 1),
(36, 'Манга', 34, 1, '', '7.png', 1, '2016-11-09 19:31:46', '2016-11-10 10:11:48', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductoptionrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductoptionrelation` (
  `id` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategoryproductoptionrelation`
--

INSERT INTO `productcategoryproductoptionrelation` (`id`, `productCategoryId`, `productOptionId`) VALUES
(48, 36, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductspecificationrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductspecificationrelation` (
  `id` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productSpecificationId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategoryproductspecificationrelation`
--

INSERT INTO `productcategoryproductspecificationrelation` (`id`, `productCategoryId`, `productSpecificationId`) VALUES
(21, 34, 5),
(22, 34, 6),
(31, 35, 5),
(32, 35, 6),
(33, 36, 5),
(34, 36, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryrelation` (
  `productId` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategoryrelation`
--

INSERT INTO `productcategoryrelation` (`productId`, `productCategoryId`) VALUES
(4, 36),
(5, 36),
(6, 36),
(7, 36),
(9, 36),
(10, 36),
(11, 36);

-- --------------------------------------------------------

--
-- Структура таблицы `productdiscount`
--

CREATE TABLE IF NOT EXISTS `productdiscount` (
  `id` int(10) unsigned NOT NULL,
  `description` text,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `type` enum('percent','value') NOT NULL DEFAULT 'percent',
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productdiscount`
--

INSERT INTO `productdiscount` (`id`, `description`, `startTime`, `endTime`, `type`, `value`) VALUES
(2, 'Скидка 10 %', '2016-10-26 21:00:00', '2016-11-29 22:00:00', 'percent', 10.00),
(3, 'Скидка 60 грн', '2016-11-08 21:00:00', '2016-11-29 21:00:00', 'value', 60.00),
(4, 'Без скидки', '2016-11-08 21:00:00', '2016-11-08 21:00:00', 'percent', 0.00);

-- --------------------------------------------------------

--
-- Структура таблицы `productimage`
--

CREATE TABLE IF NOT EXISTS `productimage` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `imageFileName` varchar(255) NOT NULL,
  `rank` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productimage`
--

INSERT INTO `productimage` (`id`, `productId`, `imageFileName`, `rank`) VALUES
(11, 4, 'product-slide1.png', 1),
(12, 4, 'product-slide2.png', 2),
(13, 4, 'product-slide3.png', 3),
(14, 5, 'item3.png', 1),
(15, 6, 'last2.png', 1),
(16, 7, 'item2.png', 1),
(18, 9, 'item5.png', 1),
(19, 10, 'last1.png', 1),
(20, 11, 'item6.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productincomingprice`
--

CREATE TABLE IF NOT EXISTS `productincomingprice` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currencyCode` char(3) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productincomingprice`
--

INSERT INTO `productincomingprice` (`id`, `productId`, `price`, `currencyCode`, `time`) VALUES
(2, 4, 1200.00, 'uah', '2016-11-06 22:05:25'),
(3, 5, 1000.00, 'грн', '2016-11-09 20:42:06'),
(4, 6, 111.00, 'грн', '2016-11-09 20:44:11'),
(5, 7, 111.00, 'грн', '2016-11-09 20:45:22'),
(6, 9, 111.00, 'грн', '2016-11-09 20:53:07'),
(7, 10, 111.00, 'грн', '2016-11-09 21:00:44'),
(8, 11, 444.00, 'грн', '2016-11-10 14:04:32');

-- --------------------------------------------------------

--
-- Структура таблицы `productmanufacture`
--

CREATE TABLE IF NOT EXISTS `productmanufacture` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productmanufacture`
--

INSERT INTO `productmanufacture` (`id`, `name`, `description`, `image`) VALUES
(3, 'Winston', 'Winston Classic', '992-zabolevaniya-zheludochno-kishechnogo-trakta-zabolevaniya-zheludochno-kishechnogo-trakta.png'),
(4, 'Parlament', 'Parlament', '997-lechenie-pochek-i-mochevyvodyashchih-putej-lechenie-pochek-i-mochevyvodyashchih-putej.png'),
(5, 'Davidoff', 'Davidoff', '1000-lechenie-diabeta-lechenie-diabeta.png');

-- --------------------------------------------------------

--
-- Структура таблицы `productmarker`
--

CREATE TABLE IF NOT EXISTS `productmarker` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `isPreOrder` tinyint(1) NOT NULL DEFAULT '0',
  `isSpecialOffer` tinyint(1) NOT NULL DEFAULT '0',
  `isNew` tinyint(1) NOT NULL DEFAULT '0',
  `isSale` tinyint(1) NOT NULL DEFAULT '0',
  `isAdult` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productmarker`
--

INSERT INTO `productmarker` (`id`, `productId`, `isActive`, `isPreOrder`, `isSpecialOffer`, `isNew`, `isSale`, `isAdult`) VALUES
(2, 4, 1, 0, 0, 1, 1, 0),
(3, 5, 1, 1, 1, 1, 1, 0),
(4, 6, 1, 1, 1, 1, 1, 1),
(5, 7, 1, 1, 1, 1, 1, 0),
(6, 9, 1, 1, 1, 1, 1, 0),
(7, 10, 1, 1, 1, 1, 1, 0),
(8, 11, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `productoption`
--

CREATE TABLE IF NOT EXISTS `productoption` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productoption`
--

INSERT INTO `productoption` (`id`, `name`) VALUES
(8, 'Размер');

-- --------------------------------------------------------

--
-- Структура таблицы `productoptionvalue`
--

CREATE TABLE IF NOT EXISTS `productoptionvalue` (
  `id` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productoptionvalue`
--

INSERT INTO `productoptionvalue` (`id`, `productOptionId`, `name`, `price`) VALUES
(12, 8, 'S', '-20'),
(13, 8, 'M', '0'),
(14, 8, 'L', '10'),
(15, 8, 'XL', '20'),
(16, 8, 'XXL', '30');

-- --------------------------------------------------------

--
-- Структура таблицы `productproductspecificationrelation`
--

CREATE TABLE IF NOT EXISTS `productproductspecificationrelation` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `productSpecificationId` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  `isSearch` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productproductspecificationrelation`
--

INSERT INTO `productproductspecificationrelation` (`id`, `productId`, `productSpecificationId`, `value`, `isSearch`) VALUES
(9, 4, 5, '', 0),
(10, 4, 6, '', 0),
(11, 5, 5, '', 0),
(12, 5, 6, '', 0),
(13, 6, 5, '', 0),
(14, 6, 6, '', 0),
(15, 7, 5, '', 0),
(16, 7, 6, '', 0),
(19, 9, 5, '', 0),
(20, 9, 6, '', 0),
(21, 10, 5, '', 0),
(22, 10, 6, '', 0),
(25, 11, 5, '8886', 1),
(26, 11, 6, '1000х5000', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productreview`
--

CREATE TABLE IF NOT EXISTS `productreview` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review` text NOT NULL,
  `rate` int(10) unsigned NOT NULL DEFAULT '0',
  `ipAddress` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `productspecification`
--

CREATE TABLE IF NOT EXISTS `productspecification` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productspecification`
--

INSERT INTO `productspecification` (`id`, `name`) VALUES
(5, 'Страниц'),
(6, 'Формат');

-- --------------------------------------------------------

--
-- Структура таблицы `relatedproduct`
--

CREATE TABLE IF NOT EXISTS `relatedproduct` (
  `idProduct` int(10) unsigned NOT NULL,
  `relatedProductId` varchar(255) DEFAULT NULL COMMENT 'json',
  `isAutoRelation` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relatedproduct`
--

INSERT INTO `relatedproduct` (`idProduct`, `relatedProductId`, `isAutoRelation`) VALUES
(4, '', 0),
(5, '', 0),
(6, '', 0),
(7, '', 0),
(9, '', 0),
(10, '', 0),
(11, '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shippingmethod`
--

CREATE TABLE IF NOT EXISTS `shippingmethod` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `countryCode` char(3) NOT NULL,
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `insurancePercent` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'процентная наценка от общей стоимости товаров в качестве страховки товара'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shippingmethod`
--

INSERT INTO `shippingmethod` (`id`, `name`, `countryCode`, `description`, `imageFileName`, `price`, `insurancePercent`) VALUES
(3, 'Самовывоз', 'UA', '', NULL, NULL, 0.00),
(4, 'Курьером', 'UAH', '', NULL, 30.00, 0.00);

-- --------------------------------------------------------

--
-- Структура таблицы `shippingpaymentmethodrelation`
--

CREATE TABLE IF NOT EXISTS `shippingpaymentmethodrelation` (
  `shippingMethodId` int(10) unsigned NOT NULL,
  `paymentMethodId` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shippingpaymentmethodrelation`
--

INSERT INTO `shippingpaymentmethodrelation` (`shippingMethodId`, `paymentMethodId`) VALUES
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 2),
(4, 3),
(4, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `shopinfo`
--

CREATE TABLE IF NOT EXISTS `shopinfo` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone3` varchar(15) DEFAULT NULL,
  `phone4` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `countryCode` char(3) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `userGroupId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `userGroupId`, `isActive`, `description`) VALUES
(1, 'kasp89s@gmail.com', '8349efb1b90fb33b41698cbe945769c4', 1, 1, 'Мудила'),
(4, 'kasp89s@mail.ru', 'g65uerden', 2, 1, 'Hello word');

-- --------------------------------------------------------

--
-- Структура таблицы `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`) VALUES
(1, 'Супер админ'),
(2, 'Админ');

-- --------------------------------------------------------

--
-- Структура таблицы `waitinglist`
--

CREATE TABLE IF NOT EXISTS `waitinglist` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `creteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `creteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wishlist`
--

INSERT INTO `wishlist` (`id`, `productId`, `customerId`, `creteTime`) VALUES
(2, 10, 2, '2016-11-09 23:02:43'),
(5, 7, 2, '2016-11-09 23:24:10'),
(6, 11, 2, '2016-11-15 11:41:40');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createUserId` (`createUserId`),
  ADD KEY `updateUserId` (`updateUserId`);

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Индексы таблицы `basketproduct`
--
ALTER TABLE `basketproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basketId` (`basketId`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `basketproductattribute`
--
ALTER TABLE `basketproductattribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baskeProducttId` (`basketProductId`),
  ADD KEY `basketProductId` (`basketProductId`),
  ADD KEY `productOptionId` (`productOptionId`),
  ADD KEY `productOptionValueId` (`productOptionValueId`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `createUserId` (`createUserId`),
  ADD KEY `updateUserId` (`updateUserId`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `customerGroupId` (`customerGroupId`);

--
-- Индексы таблицы `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `customerId_2` (`customerId`);

--
-- Индексы таблицы `customergroup`
--
ALTER TABLE `customergroup`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `infopage`
--
ALTER TABLE `infopage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`code`),
  ADD KEY `code` (`code`),
  ADD KEY `updateUserId` (`updateUserId`),
  ADD KEY `createUserId` (`createUserId`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updateUserId` (`updateUserId`),
  ADD KEY `createUserId` (`createUserId`);

--
-- Индексы таблицы `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `newslettersubscriber`
--
ALTER TABLE `newslettersubscriber`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shppingId` (`shippingId`),
  ADD KEY `paymentId` (`paymentId`);

--
-- Индексы таблицы `ordercustomerinfo`
--
ALTER TABLE `ordercustomerinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Индексы таблицы `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Индексы таблицы `orderpostbarcode`
--
ALTER TABLE `orderpostbarcode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderBarcode` (`orderId`,`barcode`),
  ADD KEY `orderId` (`orderId`);

--
-- Индексы таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `orderproductattribute`
--
ALTER TABLE `orderproductattribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderProductId` (`orderProductId`),
  ADD KEY `productOptionValueId` (`productOptionValueId`),
  ADD KEY `productOptionId` (`productOptionId`);

--
-- Индексы таблицы `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isDefault_UNIQUE` (`isDefault`);

--
-- Индексы таблицы `ordertotal`
--
ALTER TABLE `ordertotal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Индексы таблицы `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku_UNIQUE` (`sku`),
  ADD KEY `productDisountId` (`productDisountId`),
  ADD KEY `productManufactureId` (`productManufactureId`);

--
-- Индексы таблицы `productattribute`
--
ALTER TABLE `productattribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `productOptionId` (`productOptionId`),
  ADD KEY `productOptionValueId` (`productOptionValueId`);

--
-- Индексы таблицы `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentId` (`parentId`);

--
-- Индексы таблицы `productcategoryproductoptionrelation`
--
ALTER TABLE `productcategoryproductoptionrelation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productCategoryId` (`productCategoryId`),
  ADD KEY `productOptionId` (`productOptionId`),
  ADD KEY `productCategoryId_2` (`productCategoryId`);

--
-- Индексы таблицы `productcategoryproductspecificationrelation`
--
ALTER TABLE `productcategoryproductspecificationrelation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productCategoryId` (`productCategoryId`),
  ADD KEY `productSpecificationId` (`productSpecificationId`);

--
-- Индексы таблицы `productcategoryrelation`
--
ALTER TABLE `productcategoryrelation`
  ADD UNIQUE KEY `unique` (`productCategoryId`,`productId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `productCategoryId` (`productCategoryId`);

--
-- Индексы таблицы `productdiscount`
--
ALTER TABLE `productdiscount`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `productincomingprice`
--
ALTER TABLE `productincomingprice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `productmanufacture`
--
ALTER TABLE `productmanufacture`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productmarker`
--
ALTER TABLE `productmarker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `productoption`
--
ALTER TABLE `productoption`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productoptionvalue`
--
ALTER TABLE `productoptionvalue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productOptionId` (`productOptionId`),
  ADD KEY `productOptionId_2` (`productOptionId`),
  ADD KEY `productOptionId_3` (`productOptionId`);

--
-- Индексы таблицы `productproductspecificationrelation`
--
ALTER TABLE `productproductspecificationrelation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productd` (`productId`),
  ADD KEY `productSpecificationId` (`productSpecificationId`);

--
-- Индексы таблицы `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `productspecification`
--
ALTER TABLE `productspecification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `relatedproduct`
--
ALTER TABLE `relatedproduct`
  ADD UNIQUE KEY `unique` (`idProduct`,`relatedProductId`);

--
-- Индексы таблицы `shippingmethod`
--
ALTER TABLE `shippingmethod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shippingpaymentmethodrelation`
--
ALTER TABLE `shippingpaymentmethodrelation`
  ADD UNIQUE KEY `unique` (`shippingMethodId`,`paymentMethodId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`);

--
-- Индексы таблицы `shopinfo`
--
ALTER TABLE `shopinfo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `userGroupId` (`userGroupId`);

--
-- Индексы таблицы `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `waitinglist`
--
ALTER TABLE `waitinglist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Индексы таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`customerId`,`productId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `productId` (`productId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `basketproduct`
--
ALTER TABLE `basketproduct`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `basketproductattribute`
--
ALTER TABLE `basketproductattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `infopage`
--
ALTER TABLE `infopage`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `newslettersubscriber`
--
ALTER TABLE `newslettersubscriber`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `ordercustomerinfo`
--
ALTER TABLE `ordercustomerinfo`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT для таблицы `orderproductattribute`
--
ALTER TABLE `orderproductattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ordertotal`
--
ALTER TABLE `ordertotal`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `productattribute`
--
ALTER TABLE `productattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `productcategoryproductoptionrelation`
--
ALTER TABLE `productcategoryproductoptionrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT для таблицы `productcategoryproductspecificationrelation`
--
ALTER TABLE `productcategoryproductspecificationrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `productdiscount`
--
ALTER TABLE `productdiscount`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `productincomingprice`
--
ALTER TABLE `productincomingprice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `productmanufacture`
--
ALTER TABLE `productmanufacture`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `productmarker`
--
ALTER TABLE `productmarker`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `productoption`
--
ALTER TABLE `productoption`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `productoptionvalue`
--
ALTER TABLE `productoptionvalue`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `productproductspecificationrelation`
--
ALTER TABLE `productproductspecificationrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `productspecification`
--
ALTER TABLE `productspecification`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `shippingmethod`
--
ALTER TABLE `shippingmethod`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `shopinfo`
--
ALTER TABLE `shopinfo`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`createUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `banner_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `basketproduct`
--
ALTER TABLE `basketproduct`
  ADD CONSTRAINT `basketproduct_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basketproduct_ibfk_2` FOREIGN KEY (`basketId`) REFERENCES `basket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `basketproductattribute`
--
ALTER TABLE `basketproductattribute`
  ADD CONSTRAINT `basketproductattribute_ibfk_1` FOREIGN KEY (`basketProductId`) REFERENCES `basketproduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basketproductattribute_ibfk_2` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basketproductattribute_ibfk_3` FOREIGN KEY (`productOptionValueId`) REFERENCES `productoptionvalue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`createUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customerGroupId`) REFERENCES `customergroup` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD CONSTRAINT `customeraddress_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `infopage`
--
ALTER TABLE `infopage`
  ADD CONSTRAINT `infopage_ibfk_1` FOREIGN KEY (`createUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `infopage_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`createUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `paymentmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`shippingId`) REFERENCES `shippingmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ordercustomerinfo`
--
ALTER TABLE `ordercustomerinfo`
  ADD CONSTRAINT `ordercustomerinfo_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD CONSTRAINT `orderhistory_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderpostbarcode`
--
ALTER TABLE `orderpostbarcode`
  ADD CONSTRAINT `orderpostbarcode_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderproductattribute`
--
ALTER TABLE `orderproductattribute`
  ADD CONSTRAINT `orderproductattribute_ibfk_1` FOREIGN KEY (`orderProductId`) REFERENCES `orderproduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderproductattribute_ibfk_2` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderproductattribute_ibfk_3` FOREIGN KEY (`productOptionValueId`) REFERENCES `productoptionvalue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ordertotal`
--
ALTER TABLE `ordertotal`
  ADD CONSTRAINT `ordertotal_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productDisountId`) REFERENCES `productdiscount` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`productManufactureId`) REFERENCES `productmanufacture` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productattribute`
--
ALTER TABLE `productattribute`
  ADD CONSTRAINT `productattribute_ibfk_3` FOREIGN KEY (`productOptionValueId`) REFERENCES `productoptionvalue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productattribute_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productattribute_ibfk_2` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productcategoryproductoptionrelation`
--
ALTER TABLE `productcategoryproductoptionrelation`
  ADD CONSTRAINT `productcategoryproductoptionrelation_ibfk_1` FOREIGN KEY (`productCategoryId`) REFERENCES `productcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productcategoryproductoptionrelation_ibfk_2` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productcategoryproductspecificationrelation`
--
ALTER TABLE `productcategoryproductspecificationrelation`
  ADD CONSTRAINT `productcategoryproductspecificationrelation_ibfk_1` FOREIGN KEY (`productCategoryId`) REFERENCES `productcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productcategoryproductspecificationrelation_ibfk_2` FOREIGN KEY (`productSpecificationId`) REFERENCES `productspecification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productcategoryrelation`
--
ALTER TABLE `productcategoryrelation`
  ADD CONSTRAINT `productcategoryrelation_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productcategoryrelation_ibfk_2` FOREIGN KEY (`productCategoryId`) REFERENCES `productcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productincomingprice`
--
ALTER TABLE `productincomingprice`
  ADD CONSTRAINT `productincomingprice_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productmarker`
--
ALTER TABLE `productmarker`
  ADD CONSTRAINT `productmarker_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productoptionvalue`
--
ALTER TABLE `productoptionvalue`
  ADD CONSTRAINT `productoptionvalue_ibfk_1` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productproductspecificationrelation`
--
ALTER TABLE `productproductspecificationrelation`
  ADD CONSTRAINT `productproductspecificationrelation_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productproductspecificationrelation_ibfk_2` FOREIGN KEY (`productSpecificationId`) REFERENCES `productspecification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `relatedproduct`
--
ALTER TABLE `relatedproduct`
  ADD CONSTRAINT `relatedproduct_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shippingpaymentmethodrelation`
--
ALTER TABLE `shippingpaymentmethodrelation`
  ADD CONSTRAINT `shippingpaymentmethodrelation_ibfk_1` FOREIGN KEY (`shippingMethodId`) REFERENCES `shippingmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shippingpaymentmethodrelation_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userGroupId`) REFERENCES `usergroup` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
