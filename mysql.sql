-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 31 2016 г., 20:09
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `amime_line`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `imageFileName` varchar(255) NOT NULL,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `createUserId` (`createUserId`),
  KEY `updateUserId` (`updateUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `name`, `content`, `imageFileName`, `startTime`, `endTime`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(3, 'Мой первый баннер', 'Мой первый баннер', '2423119_900.jpg', '2016-10-26 21:00:00', '2016-10-26 21:00:00', 0, '2016-10-27 07:35:51', '2016-10-27 07:40:16', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(10) unsigned NOT NULL,
  `sessionId` char(32) NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `basketproduct`
--

CREATE TABLE IF NOT EXISTS `basketproduct` (
  `id` int(10) unsigned NOT NULL,
  `basketId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `basketId` (`basketId`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `basketproductattribute`
--

CREATE TABLE IF NOT EXISTS `basketproductattribute` (
  `id` int(10) unsigned NOT NULL,
  `basketProductId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `baskeProducttId` (`basketProductId`),
  KEY `basketProductId` (`basketProductId`),
  KEY `productOptionId` (`productOptionId`),
  KEY `productOptionValueId` (`productOptionValueId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updateUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `createUserId` (`createUserId`),
  KEY `updateUserId` (`updateUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `description`, `startTime`, `endTime`, `type`, `value`, `minimalOrderCost`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(1, 'er3432r2r3f3fdfsdfdf3', 'eweqwfefwef', '2016-10-28 21:00:00', '2016-10-30 22:00:00', 'percent', '11.00', '2112.00', 0, '2016-10-29 21:20:22', '2016-10-29 20:25:05', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `customerGroupId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `code` char(32) DEFAULT NULL,
  `registrationIp` varchar(16) DEFAULT NULL,
  `registrationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `memo` text COMMENT 'заметки продавца о покупателе',
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `customerGroupId` (`customerGroupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `customerGroupId`, `isActive`, `code`, `registrationIp`, `registrationTime`, `memo`) VALUES
(2, 'boosyck@i.ua', '8349efb1b90fb33b41698cbe945769c4', 2, 1, NULL, '127.0.0.1', '2016-10-25 21:00:00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `customeraddress`
--

CREATE TABLE IF NOT EXISTS `customeraddress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` int(10) unsigned NOT NULL,
  `countryCode` char(3) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `isPrimary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customerId` (`customerId`),
  KEY `customerId_2` (`customerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `customeraddress`
--

INSERT INTO `customeraddress` (`id`, `customerId`, `countryCode`, `city`, `zip`, `address`, `fullName`, `phone1`, `phone2`, `isPrimary`) VALUES
(1, 2, 'Ua', 'Kiev', '03187', 'Glushkova str. 47, 50', 'Kaspruk Sergey Maksimovich', '0508571647', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `customergroup`
--

CREATE TABLE IF NOT EXISTS `customergroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `groupDiscount` double(10,2) NOT NULL DEFAULT '0.00',
  `isAutomaticGroup` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `isDefault` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `groupAccumulatedLimit` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `customergroup`
--

INSERT INTO `customergroup` (`id`, `name`, `description`, `groupDiscount`, `isAutomaticGroup`, `isActive`, `isDefault`, `groupAccumulatedLimit`) VALUES
(2, 'Зарегистрированные', 'Зарегистрированные клиенты', 0.00, 0, 0, 1, 1200.00);

-- --------------------------------------------------------

--
-- Структура таблицы `infopage`
--

CREATE TABLE IF NOT EXISTS `infopage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`code`),
  KEY `code` (`code`),
  KEY `updateUserId` (`updateUserId`),
  KEY `createUserId` (`createUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `infopage`
--

INSERT INTO `infopage` (`id`, `code`, `title`, `content`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(1, 'delivery', ' Доставка и оплата', '<p>fdfj sdjfdjiofsj fsjg oijgofsij osjfg ojis111111111111111</p>', '2016-10-30 10:00:21', '2016-10-30 09:04:38', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `shortContent` text NOT NULL,
  `content` longtext NOT NULL,
  `formatedShortContent` text,
  `formatedContent` longtext,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `publishTime` timestamp NULL DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  `createUserId` int(10) unsigned NOT NULL,
  `updateUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updateUserId` (`updateUserId`),
  KEY `createUserId` (`createUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `shortContent`, `content`, `formatedShortContent`, `formatedContent`, `isActive`, `publishTime`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(1, 'Охуенная новость!!!!', 'Вам всем пиздец!', '<h1>ВАМ ВСЕМ ПИЗДЕЦ!!!!!!!!!!!11111йЙЙЙ!!!</h1><p><br></p><table class="table table-bordered"><tbody><tr><td>вфывфывфыв</td><td>ыфвфывыфв</td><td>вфывыфв</td><td>фывыфвы</td><td>фвфывфы</td><td>вфывыфв</td><td>ыфвфыв</td><td>фывфыв</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table><p><br></p>', NULL, NULL, 1, '2016-10-29 19:58:39', '2016-10-29 20:40:09', '2016-10-29 19:58:39', 1, 1),
(2, 'Охуенная новость2!!!!', 'Охуенная новость2!!!!', '<p>Охуенная новость2!!!!ppp<br></p>', NULL, NULL, 0, NULL, '2016-10-29 20:58:57', '2016-10-29 20:08:30', 1, 1),
(3, 'Охуенная новость3!!!!', 'Охуенная новость3!!!!', '<p>Охуенная новость3!!!!<br></p>', NULL, NULL, 1, '2016-10-29 19:59:07', '2016-10-29 20:59:07', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `newslettersubscriber`
--

CREATE TABLE IF NOT EXISTS `newslettersubscriber` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `code` char(32) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` int(10) unsigned NOT NULL,
  `shppingInfo` text NOT NULL,
  `paymentInfo` text NOT NULL,
  `currencyCode` char(3) NOT NULL,
  `orderStatus` char(2) NOT NULL,
  `couponCode` varchar(255) DEFAULT NULL,
  `createTime` int(11) NOT NULL,
  `updateTime` int(11) DEFAULT NULL,
  `isFinished` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'по данному заказу расчёт произведён',
  PRIMARY KEY (`id`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ordercustomerinfo`
--

CREATE TABLE IF NOT EXISTS `ordercustomerinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(10) unsigned NOT NULL,
  `сountryCode` char(3) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orderhistory`
--

CREATE TABLE IF NOT EXISTS `orderhistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` varchar(45) NOT NULL,
  `orderStatus` char(2) NOT NULL,
  `comment` text,
  `isCustomerNotified` tinyint(1) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createUserId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orderpostbarcode`
--

CREATE TABLE IF NOT EXISTS `orderpostbarcode` (
  `id` int(11) NOT NULL,
  `orderId` int(10) unsigned DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barcode` varchar(45) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `orderBarcode` (`orderId`,`barcode`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orderproduct`
--

CREATE TABLE IF NOT EXISTS `orderproduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `productSku` varchar(255) NOT NULL,
  `productName` varchar(500) NOT NULL,
  `productQuantity` int(10) unsigned NOT NULL,
  `productPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productIncomingPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isPreOrder` tinyint(1) NOT NULL DEFAULT '0',
  `currencyCode` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `currencyCode` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderProductId` (`orderProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `isFinished` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `isDefault_UNIQUE` (`isDefault`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ordertotal`
--

CREATE TABLE IF NOT EXISTS `ordertotal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(10) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currecnyCode` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `paymentmethod`
--

CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `countryCode` char(3) DEFAULT NULL,
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `feePercent` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `imageFileName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku_UNIQUE` (`sku`),
  KEY `productDisountId` (`productDisountId`),
  KEY `productManufactureId` (`productManufactureId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `productattribute`
--

CREATE TABLE IF NOT EXISTS `productattribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantityInStock` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`),
  KEY `productOptionId` (`productOptionId`),
  KEY `productOptionValueId` (`productOptionValueId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `productcategory`
--

CREATE TABLE IF NOT EXISTS `productcategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `productcategory`
--

INSERT INTO `productcategory` (`id`, `name`, `parentId`, `sortOrder`, `description`, `imageFileName`, `isActive`, `createTime`, `updateTime`, `left`, `right`, `level`) VALUES
(4, 'Категория 1', 0, 0, 'Категория 1', 'nTy86nsQ.jpg', 0, '2016-10-29 13:04:02', NULL, NULL, NULL, 0),
(5, 'Категория 2', 0, 1, 'Категория 2 Описание', 'f6.jpg', 1, '2016-10-29 13:06:20', '2016-10-29 16:51:42', NULL, NULL, 0),
(24, 'Категория 3', 0, 2, '', NULL, 0, '2016-10-29 18:00:48', NULL, NULL, NULL, 0),
(26, 'Подкатегория категории 3', 24, 0, '', NULL, 0, '2016-10-29 18:02:45', NULL, NULL, NULL, 1),
(28, 'Категория 4', 0, 3, '', NULL, 0, '2016-10-29 18:04:46', NULL, NULL, NULL, 0),
(33, 'Подкатегория категории 3 1', 24, 1, '', 'f5.jpg', 0, '2016-10-29 18:08:42', '2016-10-29 18:11:51', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductoptionrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductoptionrelation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productCategoryId` (`productCategoryId`),
  KEY `productOptionId` (`productOptionId`),
  KEY `productCategoryId_2` (`productCategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `productcategoryproductoptionrelation`
--

INSERT INTO `productcategoryproductoptionrelation` (`id`, `productCategoryId`, `productOptionId`) VALUES
(4, 5, 1),
(17, 33, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductspecificationrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductspecificationrelation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productSpecificationId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productCategoryId` (`productCategoryId`),
  KEY `productSpecificationId` (`productSpecificationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `productcategoryproductspecificationrelation`
--

INSERT INTO `productcategoryproductspecificationrelation` (`id`, `productCategoryId`, `productSpecificationId`) VALUES
(5, 5, 1),
(20, 33, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryrelation` (
  `productId` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL,
  UNIQUE KEY `unique` (`productCategoryId`,`productId`),
  KEY `productId` (`productId`),
  KEY `productCategoryId` (`productCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `productdiscount`
--

CREATE TABLE IF NOT EXISTS `productdiscount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `type` enum('percent','value') NOT NULL DEFAULT 'percent',
  `value` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `productdiscount`
--

INSERT INTO `productdiscount` (`id`, `description`, `startTime`, `endTime`, `type`, `value`) VALUES
(2, 'Скидка 10 %', '2016-10-26 21:00:00', '2016-10-30 22:00:00', 'percent', '10.00'),
(3, 'Скидка 60 грн', '2016-10-26 21:00:00', '2016-10-26 21:00:00', 'value', '60.00');

-- --------------------------------------------------------

--
-- Структура таблицы `productimage`
--

CREATE TABLE IF NOT EXISTS `productimage` (
  `id` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `imageFileName` varchar(255) NOT NULL,
  `rank` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `productincomingprice`
--

CREATE TABLE IF NOT EXISTS `productincomingprice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currencyCode` char(3) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `productmanufacture`
--

CREATE TABLE IF NOT EXISTS `productmanufacture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `isPreOrder` tinyint(1) NOT NULL DEFAULT '0',
  `isSpecialOffer` tinyint(1) NOT NULL DEFAULT '0',
  `isNew` tinyint(1) NOT NULL DEFAULT '0',
  `isSale` tinyint(1) NOT NULL DEFAULT '0',
  `isAdult` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `productoption`
--

CREATE TABLE IF NOT EXISTS `productoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `productoption`
--

INSERT INTO `productoption` (`id`, `name`) VALUES
(1, 'Опция 1'),
(2, 'Опция 2');

-- --------------------------------------------------------

--
-- Структура таблицы `productoptionvalue`
--

CREATE TABLE IF NOT EXISTS `productoptionvalue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productOptionId` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productOptionId` (`productOptionId`),
  KEY `productOptionId_2` (`productOptionId`),
  KEY `productOptionId_3` (`productOptionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `productoptionvalue`
--

INSERT INTO `productoptionvalue` (`id`, `productOptionId`, `name`, `price`) VALUES
(2, 2, 'Значение 2', '50'),
(3, 1, 'Значение 1', '60'),
(4, 1, 'Значение 2', '88'),
(5, 2, 'Значение 3', '44');

-- --------------------------------------------------------

--
-- Структура таблицы `productproductspecificationrelation`
--

CREATE TABLE IF NOT EXISTS `productproductspecificationrelation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(10) unsigned NOT NULL,
  `productSpecificationId` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productd` (`productId`),
  KEY `productSpecificationId` (`productSpecificationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `ipAddress` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `productspecification`
--

CREATE TABLE IF NOT EXISTS `productspecification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `productspecification`
--

INSERT INTO `productspecification` (`id`, `name`) VALUES
(1, 'Вкус'),
(2, 'Цвет'),
(3, 'Писатель'),
(4, 'Барада');

-- --------------------------------------------------------

--
-- Структура таблицы `relatedproduct`
--

CREATE TABLE IF NOT EXISTS `relatedproduct` (
  `idProduct` int(10) unsigned NOT NULL,
  `relatedProductId` int(11) NOT NULL COMMENT 'json',
  `isAutoRelation` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `unique` (`idProduct`,`relatedProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shippingmethod`
--

CREATE TABLE IF NOT EXISTS `shippingmethod` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `countryCode` char(3) NOT NULL,
  `description` text,
  `imageFileName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `insurancePercent` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'процентная наценка от общей стоимости товаров в качестве страховки товара',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shippingpaymentmethodrelation`
--

CREATE TABLE IF NOT EXISTS `shippingpaymentmethodrelation` (
  `shippingMethodId` int(10) unsigned NOT NULL,
  `paymentMethodId` int(10) unsigned NOT NULL,
  UNIQUE KEY `unique` (`shippingMethodId`,`paymentMethodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shopinfo`
--

CREATE TABLE IF NOT EXISTS `shopinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `userGroupId` int(10) unsigned NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `userGroupId` (`userGroupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `userGroupId`, `isActive`, `description`) VALUES
(1, 'kasp89s@gmail.com', '8349efb1b90fb33b41698cbe945769c4', 1, 1, 'Мудила'),
(4, 'kasp89s@mail.ru', 'g65uerden', 2, 1, 'fdsfsdf');

-- --------------------------------------------------------

--
-- Структура таблицы `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `creteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `creteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`customerId`,`productId`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productDisountId`) REFERENCES `productdiscount` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`productManufactureId`) REFERENCES `productmanufacture` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productattribute`
--
ALTER TABLE `productattribute`
  ADD CONSTRAINT `productattribute_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productattribute_ibfk_2` FOREIGN KEY (`productOptionId`) REFERENCES `productoption` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `productattribute_ibfk_3` FOREIGN KEY (`productOptionValueId`) REFERENCES `productoptionvalue` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userGroupId`) REFERENCES `usergroup` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
