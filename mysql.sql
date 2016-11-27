-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 27 2016 г., 01:48
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `name`, `content`, `imageFileName`, `startTime`, `endTime`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(7, 'Слайд 1', '<p>123</p>', 'ava.jpg', '2016-11-22 21:00:00', '2016-11-29 21:00:00', 1, '2016-11-23 14:54:30', '2016-11-23 20:14:21', 1, 1),
(8, 'Слайд 2', '<p>123</p>', 'news2.png', '2016-11-22 21:00:00', '2016-11-29 21:00:00', 1, '2016-11-23 14:54:56', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(10) unsigned NOT NULL,
  `sessionId` char(32) NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=540 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `sessionId`, `customerId`, `createTime`) VALUES
(226, '44aa67d091406ec049a760c6a29125e8', 2, '2016-11-23 11:04:01'),
(230, '49a7ac5bab67611bae0aa158718b84bf', 0, '2016-11-23 15:08:41'),
(231, 'd6b6d1454c7da99562d6331fa833dcef', 0, '2016-11-23 15:19:13'),
(232, '30da4f397c163a1bda70c34f821202db', 0, '2016-11-23 15:24:35'),
(233, '0c6730b6e541aef6ac8bebd838163456', 0, '2016-11-23 16:33:17'),
(234, '9521e220e100351e2da7bfa99b653390', 0, '2016-11-23 16:54:25'),
(235, 'bdc979587a3535f45b09d91ee560abaf', 0, '2016-11-23 17:21:47'),
(236, 'd4d8457656c758d218a23adc9607d068', 0, '2016-11-23 17:50:26'),
(238, '1c65e8aa4fed2a8e9b35304230566ad9', 0, '2016-11-23 18:02:52'),
(239, '53750c621749664f86f6f5a05453aaa7', 0, '2016-11-23 18:02:56'),
(241, '68bf323f4696a4ffdba3d07bb03291ae', 0, '2016-11-23 19:02:24'),
(242, '5e0e24dc48078e0ea20f806748db55e7', 0, '2016-11-23 19:05:46'),
(243, '669bfa048a18c5bb46b945f0e35a2ac1', 0, '2016-11-23 19:20:31'),
(245, '756aeb5855a0bd38899d2b8a0e901a84', 0, '2016-11-23 19:26:20'),
(246, 'a934114e0c200429a5347a7da4d393d5', 0, '2016-11-23 19:37:58'),
(247, '305c7d007a86acafb6821977b5aa0ef1', 0, '2016-11-23 19:38:22'),
(248, '3c98e7d610ab4332e2b83b78642c368a', 0, '2016-11-23 19:38:51'),
(250, '9d557e7c36f34dc05a05c411d7a3f587', 0, '2016-11-23 19:43:58'),
(251, '9bd91932935b0ba802aab9fe4ffa8506', 0, '2016-11-23 19:52:14'),
(252, '1f2ce1ba6c46d58dff16d75f0a03c5a6', 10, '2016-11-23 19:54:19'),
(253, '3f592dfbff90ddd0e1dd80db9947c5d3', 0, '2016-11-23 19:58:09'),
(254, 'a5f5f99cb2bff8f4be691b7708028abd', 0, '2016-11-23 20:26:23'),
(255, 'e89e75cefd378710e1b87769365301fe', 0, '2016-11-23 20:45:40'),
(256, 'b6608de2bc0c2ea2f81b4c38cac880d2', 0, '2016-11-23 20:57:35'),
(257, '4038c72af39a4e68d1ae465a82c7b2d1', 0, '2016-11-23 21:00:11'),
(258, 'a7cece6249bddf56cbd85767c1fea655', 0, '2016-11-23 21:02:21'),
(259, '0fe30d4deabd6dd2b14bdc4b06ffc386', 0, '2016-11-23 21:13:23'),
(260, 'de6b48c8a600fa39bf96d59e82a779d1', 0, '2016-11-23 21:26:25'),
(261, '3736167e6bd35c3aa162e309f984ef3f', 0, '2016-11-23 21:43:23'),
(262, '470abbe2b51c2d8eeab65f0bb3d8f569', 0, '2016-11-23 21:48:25'),
(263, '769c64fef47a64455e7c8151013d2fb3', 0, '2016-11-23 21:59:29'),
(264, 'c445c2b71d420021fc4d135940910d7f', 0, '2016-11-23 21:59:34'),
(265, '5b3b903c9304fa21e664963ca644abbd', 0, '2016-11-23 21:59:43'),
(266, 'a2f3b33e1e6a251baa4f11f2dfae835d', 0, '2016-11-23 21:59:44'),
(267, 'b5970018533d8ee6cae085fa43dc1564', 0, '2016-11-23 22:10:14'),
(268, '4c805584ec33bb49af31703d568ee5f1', 0, '2016-11-23 22:12:52'),
(269, 'a2f394930adba741aeb05b8b9765192e', 0, '2016-11-23 22:13:26'),
(270, 'c3ca9439df9df20119daea6c3cfc442f', 0, '2016-11-23 22:39:46'),
(271, '8b843024007c5e59ca2fce2d1f447384', 0, '2016-11-23 23:11:06'),
(272, '4b72be3c5a96d5cc6a81f42bc2bf622e', 0, '2016-11-23 23:23:17'),
(273, '915979dc3c40a65265471164a6136596', 0, '2016-11-23 23:25:26'),
(274, '2da9d408732dc46cb580c1bf18eaabfd', 0, '2016-11-23 23:30:43'),
(275, '00715e4c48281aace2f06f48bc2ab1f7', 0, '2016-11-23 23:30:45'),
(276, '61bd4668d327dfcc349b9c4b90871448', 0, '2016-11-24 01:01:54'),
(277, 'b325d517c26fdf070fdff659649a4fb3', 0, '2016-11-24 01:01:57'),
(278, '7ac2aaa5648bfce7f6b13fa4596db25e', 0, '2016-11-24 01:05:13'),
(279, 'c0d5107aca594284395aff1507de28d4', 0, '2016-11-24 01:09:28'),
(280, '513354b48afef59592a148a798f5d091', 0, '2016-11-24 01:22:49'),
(281, '6a32ad8ea9681ed495fdebd05cd578af', 0, '2016-11-24 01:36:09'),
(282, '709b1aa166b0e059a7d7d698c20bd20b', 0, '2016-11-24 04:51:52'),
(283, '02a0d31c7d9b2b03961923c1e1595f1f', 0, '2016-11-24 05:24:18'),
(284, '27804051814f7a7a138c7e1da224a003', 0, '2016-11-24 05:27:30'),
(285, '8ee95288c326a1c8848abda3bacdfb5b', 0, '2016-11-24 05:29:46'),
(286, 'b91aae21226e7a3e96fe9548f6a52f36', 0, '2016-11-24 06:03:00'),
(287, '0cffe5bd354b1f64093a10a93159ed27', 0, '2016-11-24 06:03:04'),
(288, '579bbf49560d13e02a4225e4cf258c91', 0, '2016-11-24 06:03:10'),
(289, 'ca64febbf3e50b3b401e3a8ae65a3bab', 0, '2016-11-24 06:03:12'),
(290, '789576bf27b3d8ebd77dfa8636b3a535', 0, '2016-11-24 06:03:14'),
(291, '1a13c60aef9d93360515f797785755d0', 0, '2016-11-24 06:03:17'),
(292, '86314b57200010086185d914c2ac7f35', 0, '2016-11-24 06:03:20'),
(293, '4338aa1f57a95d24cfb0107bcae8d4f4', 0, '2016-11-24 06:03:22'),
(294, '01b05b953cf159b1ccaf4bf4c30c8bdd', 0, '2016-11-24 06:03:25'),
(295, '4b4e629463f433a265185996c0bf2ca7', 0, '2016-11-24 06:03:28'),
(296, 'c94b03b7576f1298dd9266c48e0c3fc4', 0, '2016-11-24 06:03:30'),
(297, '3b80000be7df1ca65ac524ce87512e0e', 0, '2016-11-24 06:03:35'),
(298, '5b4b460f61b6ee47dabe949e1abe6f20', 0, '2016-11-24 06:03:40'),
(299, '83a25dd883870decdef18dccbb893d95', 0, '2016-11-24 06:03:43'),
(300, '671cdff9aa93d9ab2245b71d37e3f2f3', 0, '2016-11-24 06:03:46'),
(301, 'e2cc9da532a29b1dbafbc90c9a54e008', 0, '2016-11-24 06:03:52'),
(302, 'f82ca1fc8859270b094d39ec3cabf7ba', 0, '2016-11-24 06:03:54'),
(303, '3545d386c14a7e3bfb125e50416ba4e7', 0, '2016-11-24 06:03:57'),
(304, '10d2d52b9bab8e57ee1265f663cf4ebe', 0, '2016-11-24 06:03:59'),
(305, 'c3d1842638137ef4c0e4feb837af2be5', 0, '2016-11-24 06:04:02'),
(306, '9fbefe21c91eadc2ef305ee15669b93a', 0, '2016-11-24 06:04:04'),
(307, 'c5306157344606d0c3f4d07f7396eadb', 0, '2016-11-24 06:04:08'),
(308, 'a4c51e1506bc35d4d8680101488ada28', 0, '2016-11-24 06:04:11'),
(309, 'b29a0fdf6b93f77e8bc72f7bded2f29c', 0, '2016-11-24 06:07:18'),
(310, 'b073d99e775227fcd831bcf7b4c58aab', 0, '2016-11-24 06:09:56'),
(311, '8588f7e2be8457e4c5c625589d190f30', 0, '2016-11-24 07:48:39'),
(312, '8a7417ab2f9f2d6f37099af21d43f81c', 0, '2016-11-24 07:48:52'),
(313, 'a02b3f1b900a9306283160cfe2402596', 0, '2016-11-24 07:49:03'),
(314, 'a70051b0a778285e5a6e0e5f51f6ad84', 0, '2016-11-24 07:49:04'),
(315, '14fe2f24400e2e6bdab40a2ba861aedb', 0, '2016-11-24 08:22:01'),
(316, '961cf76dd00aa9d213e12d7a18e93946', 0, '2016-11-24 08:31:51'),
(317, 'cabc3f1458d9b0dbe44f27310f8f9fe5', 0, '2016-11-24 09:01:30'),
(318, '57acd76b809c479019eacbcd3596a73a', 0, '2016-11-24 09:57:03'),
(319, 'f8dd56f927719e37bfcf11bf944f8b91', 0, '2016-11-24 09:57:07'),
(320, '5d1dc4498ad46b981f3ed7f481695517', 0, '2016-11-24 10:27:25'),
(321, '79daa60448757e94a8a9f6b5ce52fe41', 0, '2016-11-24 10:29:30'),
(322, 'd52fe4d9ed7410318c6384e810fd40d3', 0, '2016-11-24 11:04:03'),
(323, '78a072ad658a53e39e677ea7bd3b70b1', 0, '2016-11-24 11:27:13'),
(324, 'eac08ca5dc8dffdefb09e438c6c98bab', 0, '2016-11-24 11:53:17'),
(325, 'b3c221aef3aa9f20dc60b3c280d2d048', 0, '2016-11-24 11:59:28'),
(326, '3aab474daa89e86e344304d209ff3b7a', 0, '2016-11-24 13:30:48'),
(327, '812eba1b6f5021f6d0905af3ec39cc8b', 0, '2016-11-24 14:53:17'),
(328, 'ee64d7b967b711b1fa1664fcb2b8436d', 0, '2016-11-24 14:53:28'),
(329, '8ef0d40071cf8f0559a7f60f99648eae', 0, '2016-11-24 17:02:07'),
(330, 'cc15421f2349db89963e345c92f0aa58', 0, '2016-11-24 17:02:10'),
(331, '40133837d91722283c0637cc0f1029dd', 0, '2016-11-24 17:02:16'),
(332, '48f466e2372a4ee5c99a56f048719e73', 0, '2016-11-24 17:02:21'),
(333, '0f0b2e89003cf67cbc6199803a5c2461', 0, '2016-11-24 17:02:26'),
(334, 'c22c60ec4f52bae16a8dbbb4cadee909', 0, '2016-11-24 17:02:33'),
(335, '1f29d96c60f804f081a1841a387c10dd', 0, '2016-11-24 17:02:37'),
(336, '5cc0d835fa7ea51eaf26b6a2cebb0289', 0, '2016-11-24 17:02:41'),
(337, '13d5d5ff13f7e866f135fa4012615bfd', 0, '2016-11-24 17:02:51'),
(338, 'a2f025a7ba4a30959d7fd1432ced3a53', 0, '2016-11-24 17:03:01'),
(339, 'a7c1864664af7e3140233d4d0109c377', 0, '2016-11-24 17:03:04'),
(340, 'ce106adf051a029ed33f8476146e0a17', 0, '2016-11-24 17:33:34'),
(341, 'faf08019a13552ad1d140d3db769929e', 0, '2016-11-24 17:38:32'),
(342, '593862bad3c6ef6844416af23709a333', 0, '2016-11-24 17:38:33'),
(343, '31fc522487b80dcd1548438f94714cb3', 0, '2016-11-24 18:07:06'),
(344, 'b05ac2a73f8e9d795c96bc65ffbd500d', 0, '2016-11-24 20:28:37'),
(345, 'f0aa8f781407882d1f5f2bf2acc91ad1', 0, '2016-11-24 22:22:17'),
(346, 'dd21da8b42dc014142699a75a9569c23', 0, '2016-11-25 02:16:10'),
(347, '91d9c3211f91d6a51e7bdbd5093d9fc1', 0, '2016-11-25 02:57:07'),
(348, '45f98e8198e7213ee6c203f2e400fbd2', 0, '2016-11-25 03:03:28'),
(349, '31f2c913f5ef558eeb0a7cc218ff7ca5', 0, '2016-11-25 03:48:11'),
(350, '953557b49bc2dcef24a1123393bb165d', 0, '2016-11-25 04:19:14'),
(351, '28dfcdf0d42923684595d49fd35ca351', 0, '2016-11-25 04:25:23'),
(352, 'd5c724a093f238c2fa035045f8b2b259', 0, '2016-11-25 04:41:08'),
(353, '0387bd0306582a6922a0a0f4247c5399', 0, '2016-11-25 05:25:11'),
(354, '81797952bfbe6633efc7baba88b0cd2a', 0, '2016-11-25 05:25:15'),
(355, '573a8a2da9a911d805f5410792dc0395', 0, '2016-11-25 05:55:18'),
(356, 'f1577efc2ac0112fe628b76a66219f0b', 0, '2016-11-25 08:31:31'),
(357, '57af35ea9cd14d806d773094cdb5765d', 0, '2016-11-25 08:42:15'),
(358, 'e3c6478a6141f091edd56ddfa8589e40', 0, '2016-11-25 08:43:51'),
(359, '121dac67bad5dc8844b8f93aad4d76fe', 0, '2016-11-25 08:46:02'),
(360, 'dac90cdc46761e394789f60be5015875', 0, '2016-11-25 08:49:49'),
(361, 'f39b3520577bd77643c52426f532d9f2', 0, '2016-11-25 08:53:36'),
(363, 'ddf701706d515fb65a55d3dac6024b34', 0, '2016-11-25 09:05:00'),
(364, '281fe30db11f2ebdbe6a6046aca4bc2c', 0, '2016-11-25 09:12:31'),
(365, '848bc9a616b65c7002de11e6bee4e3fc', 0, '2016-11-25 09:16:18'),
(366, 'd0fe8727edb48ee83f7f1f4d12e295ac', 0, '2016-11-25 09:23:52'),
(368, 'f991c2cafa5d24284bf44aa43306d457', 0, '2016-11-25 09:27:39'),
(369, 'a38dcfc0d4ce1be1cb29ca1ee2da29cd', 0, '2016-11-25 09:31:26'),
(370, 'c8a804377396dea2ab3cdc3010e42f61', 0, '2016-11-25 09:35:13'),
(371, '1c3764b2490aa632a23dffa3b17c2609', 0, '2016-11-25 09:42:47'),
(373, '88677f5a53203167b91b48e5ad734fa3', 0, '2016-11-25 10:01:14'),
(374, 'cab0de5f5d9c573166c528d99711e83f', 0, '2016-11-25 10:03:02'),
(375, 'b1369a2f8adc63f5fa3c3db96be4d3e9', 0, '2016-11-25 10:18:24'),
(376, '91c756ebd13f01a74a4da465ad7e1f05', 0, '2016-11-25 10:37:55'),
(377, '609393b7fc124a38a5097db21574e531', 0, '2016-11-25 11:00:21'),
(378, '2cc6b3d79d932a987e815c62a3e7f31c', 0, '2016-11-25 11:03:04'),
(379, '6a69bb7e0346461cbc1a25f236b8c863', 0, '2016-11-25 11:25:22'),
(380, '28f92d62b7fd98b099ca7c95435629ef', 0, '2016-11-25 11:53:17'),
(381, '3ea6665732589e7e81c5522e9d1f48a0', 0, '2016-11-25 12:03:06'),
(382, '1a0f58eee6cdaa4cb7088152f8e7def4', 0, '2016-11-25 12:23:19'),
(383, 'fbd9d709b60a5d1512dd9ed446627b77', 0, '2016-11-25 12:30:28'),
(384, 'facbb6c43d90258ec671bd86e7e3a819', 0, '2016-11-25 12:53:21'),
(385, '3b3ee2e1fa1465ed27aa75fc60003bb5', 0, '2016-11-25 13:03:08'),
(386, 'a3834947eb5480bd483d972f45c56938', 0, '2016-11-25 13:23:23'),
(387, 'dde2015d24b6b7bd2cd5631df6d34392', 0, '2016-11-25 13:53:25'),
(388, '31268d7fd0cf33567d8cd29ec3ef043d', 0, '2016-11-25 14:03:10'),
(389, 'ac840a6dc48b9cfe71bcf13cf6ec8918', 0, '2016-11-25 14:23:27'),
(390, '22a733c543d7e019069b838c4c570ab1', 0, '2016-11-25 14:34:20'),
(391, 'c40957ee4cd7b4e0bf63d967ddf3727d', 0, '2016-11-25 14:35:05'),
(392, 'c0c5300adccf3e47f34264756b528a0f', 0, '2016-11-25 14:35:09'),
(393, '602a61cf5583b2fb3d6888027deca6da', 0, '2016-11-25 14:53:29'),
(394, 'bd6a28dc7573f9e6d06ba4d8e3de2e40', 0, '2016-11-25 15:01:20'),
(395, '0698bac9c31e45bdd135d165d20c2bac', 0, '2016-11-25 15:03:13'),
(397, '6a14557cb598478a57fe46bf696e5f7a', 0, '2016-11-25 15:23:31'),
(398, 'a45bc23b2bb5da8231a8227003931b00', 11, '2016-11-25 15:25:03'),
(399, 'd772d3d41a395ff5f11b4bb60cbbba95', 0, '2016-11-25 15:33:49'),
(400, 'b0940d5f56e5b8593996232ead56355f', 0, '2016-11-25 17:30:52'),
(401, 'c9d5d8e33571b8c0b2411b45d2a89cc2', 0, '2016-11-25 17:33:20'),
(402, 'cd5cd0867f6c36c50f63ad34d9086d08', 0, '2016-11-25 17:33:57'),
(403, '9663bff4187a67d3e9dda2b26aa9255d', 0, '2016-11-25 17:34:42'),
(404, '58d0f9979ff106e8a7891bd6451a976f', 0, '2016-11-25 17:35:30'),
(405, 'fd84a006abd42ac1799555c64e78e61d', 0, '2016-11-25 17:36:47'),
(406, '31efa52259559307dbbe00a84f82f24d', 0, '2016-11-25 17:38:21'),
(407, '1dbeda160dac3b1dc066e6aa74067a70', 0, '2016-11-25 17:40:23'),
(408, '532402ef2a0e5bca775b67e5f2ab4865', 0, '2016-11-25 17:41:23'),
(409, '0bca015844be95682dbae8b869d54be6', 0, '2016-11-25 17:45:38'),
(410, 'bafb66dd26c0e30daaf24548bcf76562', 0, '2016-11-25 17:47:16'),
(411, '4e57104409700a0d949a0e8739ae3920', 0, '2016-11-25 17:50:39'),
(412, 'b69c3c6d2b23378e136de08df0272a32', 0, '2016-11-25 17:51:52'),
(413, '82647471ba0adc6df17b0d3466fe17e8', 0, '2016-11-25 17:54:13'),
(414, 'b751e8f31869442d886265f27def0a75', 0, '2016-11-25 17:56:41'),
(415, '6642273c7c77ba2c0ed8d60a34eef63d', 0, '2016-11-25 18:03:43'),
(416, '806811b42f67891bd3ed587e02a1d3b7', 0, '2016-11-25 18:11:46'),
(417, 'e0612351dd37c7334fda33a8f3159dda', 0, '2016-11-25 18:20:50'),
(420, '17dc138e4f472db9e21667449bf29f29', 12, '2016-11-25 18:33:27'),
(421, '4ecacbc2535173715650ab313b681a2e', 0, '2016-11-25 18:34:35'),
(422, 'c2a6e97164dc4fa8a24944bfec9d9d8d', 0, '2016-11-25 18:40:17'),
(423, '0f2ad74ae9c5970ab63ee524162df948', 0, '2016-11-25 18:40:51'),
(424, '35d7729bfc58be8575aaefa5375f3ced', 0, '2016-11-25 18:41:36'),
(425, 'fcf02cade16b810e14b4081aafdc1a42', 0, '2016-11-25 18:42:24'),
(426, '3e898d28ed92fa76406719fcfbd0bd9e', 0, '2016-11-25 18:43:37'),
(427, 'dec2b1c94fb9b3920115d85ef7ad3b47', 0, '2016-11-25 18:45:09'),
(428, '5576f8ba9ffa3629da44436197b8edb3', 0, '2016-11-25 18:47:11'),
(429, '04c702c800806b7b55409a9eb58225fc', 0, '2016-11-25 18:47:17'),
(430, '1e96ff1c85cf1ddae4fc0631c236ef02', 0, '2016-11-25 18:47:22'),
(431, 'a0f154d9405de19ddb50775f95fa68e0', 0, '2016-11-25 18:50:12'),
(432, '440c7a0fd1357de07dd5ba9440fba01c', 0, '2016-11-25 18:54:28'),
(433, 'bb2e4fcb7d3ee0ea96763b17ff7e61fa', 0, '2016-11-25 18:57:19'),
(434, '5140cdc601814a08960a4799368c13f7', 0, '2016-11-25 18:59:30'),
(435, 'dd5202bf3fe63142c04d82ff2f8c8443', 0, '2016-11-25 19:01:16'),
(436, 'e8de3823d292dc8e4e3faa7a27cdc07a', 0, '2016-11-25 19:02:27'),
(437, '23421860c6b019873600ea62ec86253b', 0, '2016-11-25 19:05:31'),
(438, '011667e60655086c9ba21e3865a19ecb', 0, '2016-11-25 19:07:21'),
(439, '2899fa5752f909d1ec36e8187166bdaa', 0, '2016-11-25 19:12:33'),
(440, '8ac8cad9f79b3cbf6916c1fd25a0df20', 0, '2016-11-25 19:17:22'),
(441, '4090b3deadaee386b135f95065343495', 0, '2016-11-25 19:20:07'),
(442, '053f7bab564a43f7f255c1f6fbee6c9a', 0, '2016-11-25 19:20:35'),
(443, '75546f01d8d28699e27027f765c6367c', 0, '2016-11-25 19:26:41'),
(444, '750eb80f8877d4e332c26abf07ae77ea', 0, '2016-11-25 19:27:24'),
(445, '689577f492277db0b518a7b1d5360ec4', 0, '2016-11-25 19:46:20'),
(446, 'dace7918728457cec49ae7dfea802824', 0, '2016-11-25 19:57:22'),
(447, '0c722eddb31608fdfa63cfa832bc13dd', 0, '2016-11-25 19:57:45'),
(448, 'edbb209848e1c22adae9fefd61d35d35', 0, '2016-11-25 19:58:15'),
(449, 'ca915d9c77f2d77db3bf15c546f7a269', 0, '2016-11-25 19:58:47'),
(450, 'f3c913a460341f2b34af1fd9dd656472', 0, '2016-11-25 19:59:45'),
(451, 'f618d1e6c4a8d201768010aab2150df8', 0, '2016-11-25 20:00:47'),
(452, 'c78aacbd299e2cea4346668015a96733', 0, '2016-11-25 20:02:21'),
(453, '6c3fb312c4f54332b21a371c5f0433c6', 0, '2016-11-25 20:04:23'),
(454, '422e93eb8c521a5607ef7b12bd44b336', 0, '2016-11-25 20:07:36'),
(455, 'c94cc73304d99ea605f426c3b4ea9eba', 0, '2016-11-25 20:08:13'),
(456, '75c56e86358000ef99a1463394ea064b', 0, '2016-11-25 20:11:38'),
(457, '54a505ac39f3cda4c662057b9c896df2', 0, '2016-11-25 20:16:40'),
(458, 'b9a13500fdd4b67987fccf4c64f6e9d7', 0, '2016-11-25 20:27:27'),
(459, '7764fc3b52e4e779fd3068fa650876ae', 0, '2016-11-25 20:30:48'),
(460, 'ed5a3ef3aa6f359c9293dbf3f2b58716', 0, '2016-11-25 20:55:22'),
(461, '32a878ace0c6dd24ba28a066d7119d1e', 0, '2016-11-25 21:22:06'),
(462, '031bfe88966ef9edea516ace7063ef8d', 0, '2016-11-25 21:25:36'),
(463, '3a2778ab6a26cca23d5ecdbb0e388239', 0, '2016-11-25 21:27:29'),
(464, '79c964ee2007ff155f5cecc610a53456', 0, '2016-11-25 21:29:29'),
(465, '19420ebbae7f9cb8cb4fc66b8a0b756f', 0, '2016-11-25 21:39:59'),
(466, 'af4404d7e74eeee3ed6503c632dd5f29', 0, '2016-11-25 21:40:03'),
(467, 'b94ab93dc11f7c821580564ad0b26ff5', 0, '2016-11-25 21:45:39'),
(468, 'f13f964a798f4b22eb415e18a828893c', 0, '2016-11-25 21:46:12'),
(469, '3600cdb1670cda0fd1205b412ef0e052', 0, '2016-11-25 21:46:57'),
(470, 'b50f1c582de5cf0391028c63466d788c', 0, '2016-11-25 21:47:43'),
(471, '0498c82d772cd868d6b815f178f03bcb', 0, '2016-11-25 21:48:57'),
(472, '212900d8ce5be223ed17b713ba37325b', 0, '2016-11-25 21:50:29'),
(473, '710e06b281e79343760a7d9bfcdef136', 0, '2016-11-25 21:50:59'),
(474, 'fd7b00f08da07f5b29256e1ca1ed6396', 0, '2016-11-25 22:21:01'),
(475, 'dc4a9743758597617ca8a6e959fcc339', 0, '2016-11-25 22:23:28'),
(476, '1da024039dc3bc85367d89c833e28c3b', 0, '2016-11-25 22:23:51'),
(477, '55393825359302bd5855bf88b2a185df', 0, '2016-11-25 22:24:21'),
(478, '5d9a97032b163bf46bb3087ea0046015', 0, '2016-11-25 22:24:52'),
(479, 'ab17c781c11418c631ecc8b58ccc3127', 0, '2016-11-25 22:25:51'),
(480, '5b0aa84eec6826d46d652a0d7692eff7', 0, '2016-11-25 22:26:53'),
(481, '1c0ea813203099930da34608c51ce9c7', 0, '2016-11-25 22:27:31'),
(482, '1a2f8003fe4cc679e395e9743c64dc08', 0, '2016-11-25 22:28:24'),
(483, '6edd7bd7fe226d9c9b0cf0a9f3b8f0af', 0, '2016-11-25 22:30:26'),
(484, '30c216ab9417844659384b8d90982098', 0, '2016-11-25 22:30:55'),
(485, '2649e716dfa7b8350cc830531757bf1a', 0, '2016-11-25 22:31:07'),
(486, '1e0fc4d0b1dab6a0766e9b2344bab998', 0, '2016-11-25 22:34:09'),
(487, '1f39ae42b16c3b48887840b488904fad', 0, '2016-11-25 22:37:32'),
(488, '00d648588fe2306150e9271e9c68e5ab', 0, '2016-11-25 22:38:10'),
(489, 'a617f08624f0e1d817493779867a836b', 0, '2016-11-25 22:41:24'),
(490, '5ddc4322bdec8c5776c0a4525599d98a', 0, '2016-11-25 22:43:12'),
(491, 'd3964df8bd146b7b6ac469e4f1c8b498', 0, '2016-11-25 22:47:35'),
(492, '1115a0377d2bf5a5bfdcaab696baca70', 0, '2016-11-25 23:00:57'),
(493, '4db7ca091d9734ce2efd2d77171150cb', 0, '2016-11-25 23:16:16'),
(494, '4d43b32f1414c57ec3842a8d59d52e84', 0, '2016-11-25 23:16:52'),
(495, 'eb1389f21b88b9ef4abec816cced8904', 0, '2016-11-25 23:17:37'),
(496, '16b46aed686e489142391f1e14ab77af', 0, '2016-11-25 23:18:24'),
(497, 'b27c3723733c7b2e1e38b95fa7ae1686', 0, '2016-11-25 23:19:37'),
(498, 'a4e7fa6984e7c463396b1fce30cd477b', 0, '2016-11-25 23:21:09'),
(499, 'e7c8eaf762ec63bdc6052c6fda5685c2', 0, '2016-11-25 23:23:12'),
(500, 'a47a4620f0d8ab02a8b4e8441250d2b3', 0, '2016-11-25 23:26:14'),
(501, '28a021ca40d15738564984f056687233', 0, '2016-11-25 23:30:28'),
(502, '7ffc3ad6b27f36a991b04a1390b7f97c', 0, '2016-11-25 23:30:58'),
(503, '5c0288c98ddf92f4d015070aa182e665', 0, '2016-11-25 23:35:30'),
(504, '0b08497e1b05a7b106bc09770a897395', 0, '2016-11-26 00:40:08'),
(505, '73e3c395407a822bc80edc5ae5a30250', 0, '2016-11-26 02:52:31'),
(506, 'c27a40a4df262f64064fbe3ea2a6a29d', 0, '2016-11-26 03:16:52'),
(507, '12b5c6251f381df21a41a775c05a5a2f', 0, '2016-11-26 04:00:34'),
(508, '33c9c4d296f3f990784e839e1dc6f8f3', 0, '2016-11-26 04:40:53'),
(509, '0c5d9f19b71451f0d40022bbac0f9101', 0, '2016-11-26 04:54:59'),
(510, '055a9ee700f0f8781f788e5eb7237ff7', 0, '2016-11-26 05:33:26'),
(511, '6f9aadda541e76f15cb154b333e18f64', 0, '2016-11-26 05:38:44'),
(512, '1176b67522f6394f901228617174b4b0', 0, '2016-11-26 05:38:48'),
(513, 'dbf519bee1fe82fa94fc3db806797947', 0, '2016-11-26 06:36:15'),
(514, '2ea5cf06383ab56915b8798327053345', 0, '2016-11-26 07:43:43'),
(515, '9976d3c5fefd622d0175d6c80f648155', 0, '2016-11-26 08:19:56'),
(516, 'f164380a889147d67bfefc05a907e93a', 0, '2016-11-26 13:56:17'),
(517, '8d72937997eaf96694d484afdeeeedfa', 0, '2016-11-26 14:21:39'),
(518, 'f91d71b1514bd31dc46b7bad6a035928', 0, '2016-11-26 14:58:48'),
(519, 'e3f392f4076c8a8429759c75be5be3a1', 0, '2016-11-26 15:28:44'),
(520, 'ba81992afbd8b6cf23db6c6a42a9e4df', 0, '2016-11-26 15:36:35'),
(521, '28941f6a156ad81eec1e86c4c84b6e68', 0, '2016-11-26 16:59:43'),
(522, '42d94b3be76678e1362f697f57f03975', 0, '2016-11-26 16:59:48'),
(523, '9825d35774176b757997a0c539013bf1', 0, '2016-11-26 17:13:43'),
(524, '424a08d4c9e170deb86a3af8cc6122db', 0, '2016-11-26 19:04:44'),
(525, 'b86e3cffa1c87e2a093877f6cef34897', 0, '2016-11-26 19:35:00'),
(526, 'cbbfe548f472298e111292cc5d529525', 0, '2016-11-26 20:13:43'),
(527, '83e2b6b61cc0eee0369fb66fb40fd26e', 0, '2016-11-26 20:51:27'),
(528, '64220596bc3a45e607907286b5ebfc75', 0, '2016-11-26 21:13:41'),
(529, '2a0f52fd97ea4ee2c3d7283dc9473958', 0, '2016-11-26 21:33:04'),
(530, '2337f76e66ac89a98eae2b96e06df7a1', 0, '2016-11-26 21:37:28'),
(531, '069291ff185a6a689b44833402e032d1', 0, '2016-11-26 21:53:54'),
(532, '7bc5c572c02777b74e9101e05ecfaa8a', 0, '2016-11-26 22:03:07'),
(533, '14c138a90fef170e7b47b8934dea04e8', 0, '2016-11-26 22:06:18'),
(534, 'ea9b0a3b74f32639b84e0739167f93f1', 0, '2016-11-26 22:17:39'),
(535, 'cfc2b0ffb026ac4e4c5e7eebaf20bc7b', 0, '2016-11-26 22:28:43'),
(536, '6135d7ea708ad531cc48f6d3d28decc1', 0, '2016-11-26 22:33:09'),
(537, '9cc06e690d31bc728d8256ffe6909f75', 0, '2016-11-26 22:36:34'),
(538, '4b85dbcda76dc6b94bd6b7345caf2160', 0, '2016-11-26 22:37:30'),
(539, '092740cb9f25212a5af2106390564ee3', 0, '2016-11-26 22:40:21');

-- --------------------------------------------------------

--
-- Структура таблицы `basketproduct`
--

CREATE TABLE IF NOT EXISTS `basketproduct` (
  `id` int(10) unsigned NOT NULL,
  `basketId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basketproduct`
--

INSERT INTO `basketproduct` (`id`, `basketId`, `productId`, `quantity`) VALUES
(28, 247, 11, 1),
(29, 248, 11, 1),
(30, 247, 10, 1),
(33, 398, 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `basketproductattribute`
--

CREATE TABLE IF NOT EXISTS `basketproductattribute` (
  `id` int(10) unsigned NOT NULL,
  `basketProductId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `productOptionValueId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `productId`, `userName`, `userEmail`, `rating`, `message`, `date`, `isActive`) VALUES
(1, 4, 'Сергей', 'kasp89s@gmail.com', 1, 'Текст отзыва', '2016-11-09 14:57:51', 0),
(2, 4, 'Сергей', 'kasp89s@gmail.com', 4, 'Лучшее, что я читал. Отличный комикс на все времена.', '2016-11-09 14:58:57', 0),
(3, 11, 'юзер', 'boosyck@i.ua', 2, 'Бла бла бла', '2016-11-21 17:35:06', 1),
(4, 12, 'Марина', 'user@user.com', 5, 'Присутня російська розкладка клавіатури?', '2016-11-26 22:06:48', 1),
(5, 13, 'Свят', 'user@user.com', 5, 'Отличный ноутбучек за вменяемые деньги. Если нужно часто носить с собой и бюджет ограничен, то вариант оптимальный. Я покупал на подарок и долго не мог определиться с цветом, вроде как все прикольные, но остановился на черно-серебристом из соображений практичности, думаю черный будет меньше залапываться. Из допов сразу докупил карточку на 32гига (тут протупил, можно было б на 64 взять), того в системе видно почти 100ГБ, их в принципе достаточно, если не использовать его как сервак с данными. По производительности вопросов почти нет, всетаки 4 ядра, хоть и не самых мощных. Оперативы было бы неплохо чтоб было 4гига, но и так сойдет в принципе. Винда лицензия избавляет от мороки ставить левак, к ому же есть рекавери и можно восстановить систему без танцев с бубном. Откровенно порадовала работа от акума, у меня продержался чуть-чуть больше 7 часов при включенном вайфае и открытой мозилле, хочу еще потестить с просмотров видео из ютуба, думаю часов 5 должен вытянуть. Смело могу его рекомендовать, вещь достойная за приемлемую сумму.', '2016-11-26 22:29:29', 1),
(6, 13, 'Геннадий', 'user@user.com', 4, 'Вопрос к представителю компании Lenovo. Есть ли возможность добавить в эту модель оперативную память и заменить накопитель на 120 Gb', '2016-11-26 22:29:56', 1),
(7, 13, 'Владислав', 'user@user.com', 2, 'Люди подскажите а много-ли в нем памети просто я очень много роботаю с документами', '2016-11-26 22:30:24', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `description`, `startTime`, `endTime`, `type`, `value`, `minimalOrderCost`, `isActive`, `createTime`, `updateTime`, `createUserId`, `updateUserId`) VALUES
(1, 'er3432r2r3f3fdfsdfdf3', 'eweqwfefwef', '2016-10-28 21:00:00', '2016-12-27 22:00:00', 'percent', 11.00, 2112.00, 1, '2016-10-29 21:20:22', '2016-10-29 20:25:05', 1, 1),
(2, '123456', 'Тестовый купон', '2016-10-31 21:00:00', '2016-11-29 21:00:00', 'percent', 10.00, 0.00, 1, '2016-11-21 21:29:03', NULL, 0, NULL);

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
  `fullName` varchar(255) DEFAULT NULL,
  `code` char(32) DEFAULT NULL,
  `registrationIp` varchar(16) DEFAULT NULL,
  `registrationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `memo` text COMMENT 'заметки продавца о покупателе',
  `authID` varchar(64) DEFAULT NULL,
  `authMethod` varchar(16) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `customerGroupId`, `isActive`, `fullName`, `code`, `registrationIp`, `registrationTime`, `memo`, `authID`, `authMethod`) VALUES
(0, 'default@user.net', '12345', 1, 1, NULL, NULL, NULL, '2016-11-10 08:25:40', NULL, NULL, NULL),
(2, 'boosyck@i.ua', '98be71b310296cf2f282bf0ce65d27fc', 3, 1, 'Сергей Каспрук1', NULL, '127.0.0.1', '2016-10-25 21:00:00', '', NULL, NULL),
(7, 'kasp89s1@gmail.com', '8349efb1b90fb33b41698cbe945769c4', 1, 0, NULL, '582f6d85bb2be', '::1', '2016-11-18 21:07:21', NULL, NULL, NULL),
(10, 'sveneld@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, NULL, NULL, '46.185.121.192', '2016-11-23 19:53:31', NULL, NULL, NULL),
(11, 'kasp89s@gmail.com', '4e479f91e60f8b24908a142637ecde87', 1, 1, 'Sergio  Kaspruk', NULL, '195.211.136.227', '2016-11-25 15:25:03', NULL, '1105705726213787', 'facebook'),
(12, 'kasp89s@mail.ru', 'ea87ff0a7d5a4adc2e35b3b99a975003', 1, 1, 'Сережа Каспрук', NULL, '195.211.136.227', '2016-11-25 18:33:27', NULL, '12140344', 'vk');

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
  `isPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customeraddress`
--

INSERT INTO `customeraddress` (`id`, `customerId`, `countryCode`, `city`, `zip`, `address`, `isPrimary`) VALUES
(2, 2, '', 'Киев', '03187', 'Glushkova str. 47, 50, 111', 0),
(3, 0, NULL, NULL, NULL, '', 0),
(4, 7, NULL, NULL, NULL, '', 0),
(7, 10, NULL, NULL, NULL, '', 0),
(8, 2, NULL, 'Киев', '03187', 'Теремковская 21', 0),
(9, 11, NULL, NULL, NULL, '', 0),
(10, 12, NULL, NULL, NULL, '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customergroup`
--

INSERT INTO `customergroup` (`id`, `name`, `description`, `groupDiscount`, `isAutomaticGroup`, `isActive`, `isDefault`, `groupAccumulatedLimit`) VALUES
(1, 'Зарегистрированные', '', 0.00, 1, 1, 1, 0.00),
(2, 'Начинающие', '', 5.00, 1, 1, 0, 1200.00),
(3, 'Продвинутые', '', 10.00, 1, 1, 0, 2000.00);

-- --------------------------------------------------------

--
-- Структура таблицы `customerphone`
--

CREATE TABLE IF NOT EXISTS `customerphone` (
  `id` int(10) unsigned NOT NULL,
  `customerId` int(10) unsigned NOT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Телефоны клиентов';

--
-- Дамп данных таблицы `customerphone`
--

INSERT INTO `customerphone` (`id`, `customerId`, `phone`) VALUES
(1, 2, '05085716471'),
(2, 2, '05044444441');

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
(4, 'Предзаказ. Мордобой, Скотт, Велес, Орда, Ассассины', 'Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!\r\n«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»\r\nУсловия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)', '<p class="article-info" style="padding: 0px; margin-bottom: 18px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p class="ready-to-buy" style="padding: 0px; margin-bottom: 18px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p class="info-danger" style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p><p class="info-danger" style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">{<span style="background-color: rgb(249, 249, 249); color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px;">KO1016</span>} {<span style="color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px;">KO658</span>}</p>', 'news2.png', NULL, NULL, 1, '2016-11-25 16:56:30', '2016-11-06 12:52:45', '2016-11-25 16:56:30', 1, 1),
(5, 'Предзаказ. Мордобой, Скотт, Велес, Орда, Ассассины', '<p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p>', '<p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Внимание-внимание! Сегодня мы открываем целых 5 предзаказов!</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">«Assassin''s Creed. Анкх Исиды», «Велес. Дурман-цветок», «Орда», «Скотт Пилигрим и Бесконечная Печаль», «Мордобой»</p><p style="padding: 0px 0px 16px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(85, 85, 85); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Условия Предзаказа: Накопительная скидка на сайте не действует на данное предложение. Предзаказ продлится до 21/07/2015 включительно. (возможны изменения)</p>', 'news3.png', NULL, NULL, 1, '2016-11-23 15:01:45', '2016-11-06 13:42:22', '2016-11-23 15:01:45', 1, 1);

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
(2, 2, 'boosyck@i.ua', 1, '582e400544d58', '2016-11-17 23:40:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `customerId`, `shippingId`, `paymentId`, `currencyCode`, `orderStatus`, `couponCode`, `createTime`, `updateTime`, `isFinished`) VALUES
(11, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 19:28:53', NULL, 0),
(12, 2, 4, 4, 'грн', 'PE', '', '2016-11-17 19:29:58', NULL, 0),
(13, 2, 3, 4, 'грн', 'PE', 'er3432r2r3f3fdfsdfdf3', '2016-11-17 19:31:32', NULL, 0),
(14, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 20:57:49', NULL, 0),
(15, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 20:59:09', NULL, 0),
(16, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:07:30', NULL, 0),
(17, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:13:01', NULL, 0),
(18, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:18:26', NULL, 0),
(19, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:18:50', NULL, 0),
(20, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:21:23', NULL, 0),
(21, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:21:57', NULL, 0),
(22, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:22:35', NULL, 0),
(23, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:22:45', NULL, 0),
(24, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:25:33', NULL, 0),
(25, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:27:25', NULL, 0),
(26, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:37:33', NULL, 0),
(27, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 21:39:12', NULL, 0),
(28, 2, 4, 2, 'грн', 'PE', '', '2016-11-17 21:42:29', NULL, 0),
(29, 2, 4, 2, 'грн', 'PE', '', '2016-11-17 21:42:58', NULL, 0),
(30, 2, 4, 3, 'грн', 'PE', '', '2016-11-17 21:44:34', NULL, 0),
(31, 2, 4, 3, 'грн', 'PE', '', '2016-11-17 21:46:46', NULL, 0),
(32, 2, 4, 3, 'грн', 'PE', '', '2016-11-17 19:47:54', NULL, 0),
(33, 2, 4, 3, 'грн', 'PE', '', '2016-11-17 19:50:12', NULL, 0),
(34, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 19:51:10', NULL, 0),
(35, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 20:21:41', NULL, 0),
(36, 2, 3, 2, 'грн', 'PE', '', '2016-11-17 20:53:31', NULL, 0),
(37, 2, 4, 4, 'грн', 'R', '123456', '2016-11-21 16:37:39', '2016-11-22 05:49:13', 0),
(38, 2, 3, 2, 'грн', 'CO', '123456', '2016-11-21 17:31:38', '2016-11-22 06:33:18', 0),
(39, 0, 4, 2, 'грн', 'PE', '', '2016-11-23 08:38:17', NULL, 0),
(40, 0, 4, 2, 'грн', 'PE', '', '2016-11-23 08:40:16', NULL, 0),
(41, 0, 3, 5, 'грн', 'PE', '', '2016-11-23 19:45:54', NULL, 0),
(42, 0, 3, 2, 'грн', 'PE', NULL, '2016-11-25 09:19:45', NULL, 0),
(43, 0, 3, 2, 'грн', 'PE', NULL, '2016-11-25 09:21:45', NULL, 0),
(44, 0, 3, 2, 'грн', 'PE', NULL, '2016-11-25 09:22:08', NULL, 0),
(45, 2, 3, 2, 'грн', 'PE', '', '2016-11-25 12:29:12', NULL, 0),
(46, 2, 3, 2, 'грн', 'PE', '', '2016-11-25 13:22:49', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ordercustomerinfo`
--

CREATE TABLE IF NOT EXISTS `ordercustomerinfo` (
  `id` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `countryCode` char(3) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ordercustomerinfo`
--

INSERT INTO `ordercustomerinfo` (`id`, `orderId`, `countryCode`, `city`, `zip`, `address`, `fullName`, `phone1`, `phone2`) VALUES
(8, 11, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(9, 12, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(10, 13, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(11, 14, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(12, 15, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(13, 16, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(14, 17, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(15, 18, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(16, 19, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(17, 20, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(18, 21, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(19, 22, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(20, 23, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(21, 24, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(22, 25, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(23, 26, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(24, 27, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(25, 28, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(26, 29, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(27, 30, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(28, 31, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(29, 32, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(30, 33, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(31, 34, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(32, 35, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(33, 36, NULL, NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(34, 37, 'UA', NULL, NULL, 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', NULL),
(35, 38, 'UA', 'Киев', '03187', 'Glushkova str. 47, 50, 111', 'Сергей Каспрук', '050 857 16 47', ''),
(36, 39, 'UAH', NULL, NULL, 'Жмерынка', 'Бордунов Борис Борисыч', '885254545', NULL),
(37, 40, 'UAH', NULL, NULL, 'Жмерынка', 'Бордунов Борис Борисыч', '885254545', NULL),
(38, 41, 'UA', NULL, NULL, 'st. Kaynasskaya 6/1 kv. 2', 'ag', '+380632451651', NULL),
(39, 43, 'UA', NULL, NULL, 'Адресс не указан', 'Быстрый клиент', '0973838383', NULL),
(40, 44, 'UA', NULL, NULL, 'Адресс не указан', 'Быстрый клиент', '0973838383', NULL),
(41, 45, 'UA', NULL, NULL, '2', 'Сергей Каспрук', '0', NULL),
(42, 46, 'UA', 'Киев', '03187', 'Теремковская 21', 'Сергей Каспрук1', '05085716471', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderhistory`
--

INSERT INTO `orderhistory` (`id`, `orderId`, `orderStatus`, `comment`, `isCustomerNotified`, `createTime`, `createUserId`) VALUES
(1, 11, 'PE', 'dfdsfsdfdsfdfs', 1, '2016-11-21 15:29:37', 0),
(2, 37, 'PE', NULL, 1, '2016-11-21 16:37:41', 0),
(3, 38, 'PE', NULL, 1, '2016-11-21 17:31:40', 0),
(4, 38, 'CO', '1', 0, '2016-11-21 23:24:34', 1),
(5, 37, 'CO', '2', 0, '2016-11-21 23:27:07', 1),
(6, 37, 'CO', '3', 0, '2016-11-21 23:32:05', 1),
(7, 37, 'CO', '4', 0, '2016-11-22 08:34:43', 1),
(8, 37, 'R', 'Вернули', 0, '2016-11-22 08:35:50', 1),
(9, 39, 'PE', NULL, 1, '2016-11-23 08:38:18', 0),
(10, 40, 'PE', NULL, 1, '2016-11-23 08:40:16', 0),
(11, 41, 'PE', NULL, 1, '2016-11-23 19:45:54', 0),
(12, 43, 'PE', NULL, 0, '2016-11-25 09:21:46', 0),
(13, 44, 'PE', NULL, 0, '2016-11-25 09:22:09', 0),
(14, 45, 'PE', NULL, 1, '2016-11-25 12:29:13', 0),
(15, 46, 'PE', NULL, 1, '2016-11-25 13:22:50', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

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
(142, 36, 4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', 1, 900.00, 1200.00, 0, 'UAH'),
(143, 37, 10, 'KO123', 'Боун', 1, 500.00, 111.00, 0, 'грн'),
(144, 37, 4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', 1, 900.00, 1200.00, 0, 'UAH'),
(145, 37, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(146, 38, 10, 'KO123', 'Боун', 2, 502.00, 111.00, 0, 'грн'),
(147, 38, 4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', 1, 900.00, 1200.00, 0, 'UAH'),
(148, 38, 11, 'KO543', 'Сын М', 2, 799.00, 444.00, 0, 'грн'),
(150, 39, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(151, 39, 9, 'KO459', 'Мразь', 1, 340.00, 111.00, 0, 'грн'),
(152, 39, 6, 'KO777', 'Скот пилигрим 2', 1, 740.00, 111.00, 0, 'грн'),
(153, 40, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(154, 40, 9, 'KO459', 'Мразь', 1, 340.00, 111.00, 0, 'грн'),
(155, 40, 6, 'KO777', 'Скот пилигрим 2', 1, 740.00, 111.00, 0, 'грн'),
(156, 41, 9, 'KO459', 'Мразь', 1, 340.00, 111.00, 0, 'грн'),
(157, 44, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(158, 45, 11, 'KO543', 'Сын М', 1, 789.00, 444.00, 0, 'грн'),
(159, 46, 7, 'KO999', 'Пора туманов', 1, 360.00, 111.00, 0, 'грн');

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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

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
(69, 135, 8, 13, 'Размер', 'M', 0.00, 'грн'),
(70, 145, 8, 14, 'Размер', 'L', 10.00, 'грн'),
(71, 148, 8, 14, 'Размер', 'L', 10.00, 'грн');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `statusCode`, `name`, `isDefault`, `isChargeble`, `isPaid`, `isShipped`, `isRestock`, `isPenalty`, `isFinished`) VALUES
(1, 'PE', 'В ожидании', 1, 0, 0, 0, 0, 0, 0),
(2, 'AC', 'Подтверждён', 0, 1, 0, 0, 0, 0, 0),
(3, 'PO', 'Предзаказ', 0, 0, 0, 0, 0, 0, 0),
(4, 'PP', 'Ожидает оплаты', 0, 1, 0, 0, 0, 0, 0),
(5, 'P', 'Оплачен', 0, 0, 1, 0, 0, 0, 0),
(6, 'RS', 'Готов к отправке', 0, 0, 0, 0, 0, 0, 0),
(7, 'S', 'Отправлен', 0, 0, 0, 0, 0, 0, 0),
(8, 'CO', 'Завершён', 0, 0, 0, 0, 0, 0, 1),
(9, 'X', 'Отменён', 0, 0, 0, 0, 0, 1, 0),
(10, 'R', 'Возврат', 0, 0, 0, 0, 1, 0, 0),
(11, '?', 'Проблемный', 0, 0, 0, 0, 0, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

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
(30, 36, NULL, NULL, 2080.00, 'грн'),
(31, 37, NULL, NULL, 1831.00, 'грн'),
(32, 38, NULL, NULL, 3152.00, 'грн'),
(33, 39, NULL, NULL, 1899.00, 'грн'),
(34, 40, NULL, NULL, 1899.00, 'грн'),
(35, 41, NULL, NULL, 350.00, 'грн'),
(36, 43, NULL, NULL, 789.00, 'грн'),
(37, 44, NULL, NULL, 789.00, 'грн'),
(38, 45, NULL, NULL, 710.00, 'грн'),
(39, 46, NULL, NULL, 324.00, 'грн');

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
(2, 'Наличными', 'UA', '', '1.png', NULL, 0.00),
(3, 'Предоплата', 'UA', '', '2.png', NULL, 0.00),
(4, 'Наложенный платеж', 'UA', '', '3.png', 50.00, 0.00),
(5, 'Visa/MasterCard', 'UA', '', '5.png', NULL, 3.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `description`, `quantityInStock`, `quantityOfSold`, `barcode1`, `barcode2`, `barcode3`, `availableTime`, `createTime`, `updateTime`, `price`, `currencyCode`, `productDisountId`, `productManufactureId`, `imageFileName`) VALUES
(4, 'KO1016', 'Бэтмен. Книга 1. Суд Сов', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 9, 2, '11111', '22222', '33333', '2016-11-22 21:00:00', '2016-11-06 22:05:24', '2016-11-23 14:58:17', 1000.00, 'UAH', 2, 3, 'dummy-img1.png'),
(5, 'KO658', 'Ходячие мертвецы', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 45, 1, '11111', '22222', '33333', '2016-11-22 21:00:00', '2016-11-09 20:42:03', '2016-11-23 14:58:39', 500.00, 'грн', 3, 4, 'item3.png'),
(6, 'KO777', 'Скот пилигрим 2', '<p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!</p><p style="padding: 0px 0px 18px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.</p><p style="padding: 0px; margin-bottom: 0px; outline: none; list-style: none; color: rgb(21, 21, 21); font-family: &quot;PT Sans&quot;, sans-serif; font-size: 14px;">Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…</p>', 1, 1, '11111', '22222', '33333', '2016-11-22 21:00:00', '2016-11-09 20:44:08', '2016-11-23 14:59:09', 800.00, 'грн', 3, 3, 'last2.png'),
(7, 'KO999', 'Пора туманов', '', 2, 0, '', '', '', '2016-11-22 21:00:00', '2016-11-09 20:45:19', '2016-11-23 14:59:33', 400.00, 'грн', 2, 3, 'item2.png'),
(9, 'KO459', 'Мразь', '<pre style="background-color:#ffffff;color:#000000;font-family:''Courier New'';font-size:9,0pt;"><span style="color:#000080;background-color:#f7faff;font-weight:bold;">return </span><span style="background-color:#f7faff;font-style:italic;">round</span><span style="background-color:#f7faff;">(</span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">price </span><span style="background-color:#f7faff;">- </span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">discount</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">value</span><span style="background-color:#f7faff;">);</span></pre>', 5, 0, '', '', '', '2016-11-22 21:00:00', '2016-11-09 20:53:05', '2016-11-23 14:59:55', 378.00, 'грн', 2, 3, 'last5.png'),
(10, 'KO123', 'Боун', '<pre style="background-color:#ffffff;color:#000000;font-family:''Courier New'';font-size:9,0pt;"><span style="color:#000080;background-color:#f7faff;font-weight:bold;">return </span><span style="background-color:#f7faff;font-style:italic;">round</span><span style="background-color:#f7faff;">(</span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">price </span><span style="background-color:#f7faff;">- </span><span style="color:#660000;background-color:#f7faff;">$this</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">discount</span><span style="background-color:#f7faff;">-&gt;</span><span style="color:#000080;background-color:#f7faff;font-weight:bold;">value</span><span style="background-color:#f7faff;">);</span></pre>', 3, 2, '', '', '', '2016-11-22 21:00:00', '2016-11-09 21:00:41', '2016-11-23 15:00:14', 500.00, 'грн', 4, 3, 'last1.png'),
(11, 'KO543', 'Сын М', '<p><span style="color: rgb(51, 51, 51); font-family: ''Open Sans'', sans-serif; font-size: 14px; line-height: 22.4px;">string(586) "{"TransactionId":1478779631,"BetId":123456,"Amount":123,"Created":"2016-04-26T11:35:30.0543787Z","BetType":1,"SystemMinCount":null,"TotalPrice":2.5,"Selections":[{"SelectionId":42343,"SelectionName":"P1","MarketTypeId":333,"MarketName":"Match Result","MatchId":55,"MatchName":"Barcelona - Real Madrid","MatchStartDate":"2016-04-26T11:35:30.0543787Z","RegionId":22,"RegionName":"Spain","CompetitionId":44,"CompetitionName":"La Liga","SportId":1,"SportName":"Football","Price":2.5}],"AuthToken":"86e8f7ab32cfd12577bc2619bc635690","TS":1478779631,"Hash":"7d22124a70e6a77f2fcde9e0f470ec10"}"&nbsp;</span><br></p>', 1, 2, '11111111', '22222222', '33333333', '2016-11-22 21:00:00', '2016-11-10 14:04:31', '2016-11-23 15:00:36', 877.00, 'грн', 2, 3, 'item6.png'),
(12, 'p12200609', 'Ноутбук Acer Aspire ES1-131-C1Z2 (NX.G17EU.011) Red', '<p><span style="color: rgb(51, 51, 51); font-family: Arial, Helvetica, FreeSans, &quot;Liberation Sans&quot;, &quot;Nimbus Sans L&quot;, sans-serif; font-size: 13.0013px;">Экран 11.6'''' (1366x768) WXGA HD LED, матовый / Intel Celeron N3060 (1.6 - 2.48 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / Linux / 1.2 кг / красный</span><span id="copyinfo" style="position: absolute; overflow: hidden; width: 1px; height: 1px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, FreeSans, &quot;Liberation Sans&quot;, &quot;Nimbus Sans L&quot;, sans-serif; font-size: 13.0013px;"><br>Подробнее:&nbsp;</span></p>', 100, 0, 'p12200609', 'p12200609', 'p12200609', '2016-11-26 21:00:00', '2016-11-26 21:39:32', '2016-11-26 21:43:44', 6999.00, 'грн', 4, 3, '12200609_images_1774418927.jpg'),
(13, 'p5905767', 'Ноутбук Lenovo IdeaPad 100S (80R2006BUA) Blue-White', '<p>Экран 11.6" TN (1366x768) WXGA HD LED, глянцевый / Intel Atom Z3735F (1.33 ГГц) / RAM 2 ГБ / 64 ГБ eMMC / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 10 Home / 1 кг / сине-белый<br></p>', 100, 0, 'p5905767', 'p5905767', 'p5905767', '2016-11-26 21:00:00', '2016-11-26 22:15:24', '2016-11-26 22:18:21', 6299.00, 'грн', 2, 6, 'lenovo_80r2006bua_images_1383405645.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productattribute`
--

INSERT INTO `productattribute` (`id`, `productId`, `productOptionId`, `productOptionValueId`, `price`, `quantityInStock`) VALUES
(44, 11, 8, 12, 0.00, 0),
(45, 11, 8, 13, 0.00, 0),
(46, 11, 8, 14, 0.00, 0),
(51, 12, 9, 17, 0.00, 0),
(52, 12, 9, 18, 0.00, 0),
(53, 12, 9, 19, 0.00, 0),
(54, 12, 9, 20, 0.00, 0),
(55, 13, 9, 17, 0.00, 0),
(56, 13, 9, 18, 0.00, 0),
(57, 13, 9, 19, 0.00, 0),
(58, 13, 9, 20, 0.00, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategory`
--

INSERT INTO `productcategory` (`id`, `name`, `parentId`, `sortOrder`, `description`, `imageFileName`, `isActive`, `createTime`, `updateTime`, `left`, `right`, `level`, `isInQuickLink`) VALUES
(34, 'Все книги', 0, 1, '', NULL, 1, '2016-11-06 20:44:46', NULL, NULL, NULL, 0, 0),
(35, 'Комиксы', 34, 0, '', '8.png', 1, '2016-11-09 19:31:31', '2016-11-23 15:04:42', NULL, NULL, 1, 1),
(36, 'Манга', 34, 1, '', '7.png', 1, '2016-11-09 19:31:46', '2016-11-23 15:04:25', NULL, NULL, 1, 1),
(37, 'Ноутбуки и компютеры', 0, 2, '', '69539.jpg', 1, '2016-11-26 19:09:53', NULL, NULL, NULL, 0, 1),
(38, 'Ноутбуки', 37, 2, '', NULL, 1, '2016-11-26 19:10:30', '2016-11-26 21:41:10', NULL, NULL, 1, 0),
(39, 'Компьютеры', 37, 3, '', NULL, 1, '2016-11-26 19:11:14', NULL, NULL, NULL, 1, 0),
(40, 'Комплектующие', 37, 4, '', NULL, 1, '2016-11-26 19:11:40', NULL, NULL, NULL, 1, 0),
(41, 'Планшеты', 37, 5, '', NULL, 1, '2016-11-26 19:12:08', NULL, NULL, NULL, 1, 0),
(42, 'Нетбуки', 38, 0, '', NULL, 1, '2016-11-26 19:13:00', NULL, NULL, NULL, 2, 0),
(43, 'Для несложных задач', 38, 1, '', NULL, 1, '2016-11-26 19:13:27', NULL, NULL, NULL, 2, 0),
(44, 'Для работы и учебы', 38, 2, '', NULL, 1, '2016-11-26 19:13:52', NULL, NULL, NULL, 2, 0),
(45, 'Для бизнеса', 38, 3, '', NULL, 1, '2016-11-26 19:14:16', NULL, NULL, NULL, 2, 0),
(46, 'Геймерские ноутбуки', 38, 4, '', NULL, 1, '2016-11-26 19:14:46', NULL, NULL, NULL, 2, 0),
(47, 'Мультимедийные центры', 38, 5, '', NULL, 1, '2016-11-26 19:15:09', NULL, NULL, NULL, 2, 0),
(48, 'Легкие и тонкие', 38, 6, '', NULL, 1, '2016-11-26 19:15:36', NULL, NULL, NULL, 2, 0),
(49, 'Трансформеры\\2 в 1', 38, 7, '', NULL, 1, '2016-11-26 19:16:00', NULL, NULL, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductoptionrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductoptionrelation` (
  `id` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategoryproductoptionrelation`
--

INSERT INTO `productcategoryproductoptionrelation` (`id`, `productCategoryId`, `productOptionId`) VALUES
(49, 36, 8),
(50, 38, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `productcategoryproductspecificationrelation`
--

CREATE TABLE IF NOT EXISTS `productcategoryproductspecificationrelation` (
  `id` int(10) unsigned NOT NULL,
  `productCategoryId` int(10) unsigned NOT NULL,
  `productSpecificationId` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productcategoryproductspecificationrelation`
--

INSERT INTO `productcategoryproductspecificationrelation` (`id`, `productCategoryId`, `productSpecificationId`) VALUES
(21, 34, 5),
(22, 34, 6),
(35, 36, 5),
(36, 36, 6),
(37, 35, 5),
(38, 35, 6),
(52, 38, 7),
(53, 38, 8),
(54, 38, 9),
(55, 38, 10),
(56, 38, 12),
(57, 38, 13),
(58, 38, 14),
(59, 38, 15),
(60, 38, 16),
(61, 38, 17),
(62, 38, 18),
(63, 38, 19);

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
(11, 36),
(12, 42),
(13, 42);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

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
(20, 11, 'item6.png', 1),
(21, 12, 'acer_nx_g17eu_011_images_1774420229.jpg', 1),
(22, 12, 'acer_nx_g17eu_011_images_1774422336.jpg', 1),
(23, 12, 'acer_nx_g17eu_011_images_1774423001.jpg', 1),
(24, 12, 'acer_nx_g17eu_011_images_1774428615.jpg', 1),
(25, 12, 'acer_nx_g17eu_011_images_1774428706.jpg', 1),
(26, 13, 'lenovo_80r2006bua_images_1383405801.jpg', 1),
(27, 13, 'lenovo_80r2006bua_images_1383405879.jpg', 1),
(28, 13, 'lenovo_80r2006bua_images_1383405957.jpg', 1),
(29, 13, 'lenovo_80r2006bua_images_1383406035.jpg', 1),
(30, 13, 'lenovo_80r2006bua_images_1383406113.jpg', 1),
(31, 13, 'lenovo_80r2006bua_images_1383406191.jpg', 1),
(32, 13, 'lenovo_80r2006bua_images_1383406269.jpg', 1),
(33, 13, 'lenovo_80r2006bua_images_1383406347.jpg', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
(8, 11, 444.00, 'грн', '2016-11-10 14:04:32'),
(9, 12, 5000.00, 'грн', '2016-11-26 21:39:33'),
(10, 13, 6000.00, 'грн', '2016-11-26 22:15:24');

-- --------------------------------------------------------

--
-- Структура таблицы `productmanufacture`
--

CREATE TABLE IF NOT EXISTS `productmanufacture` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productmanufacture`
--

INSERT INTO `productmanufacture` (`id`, `name`, `description`, `image`) VALUES
(3, 'Winston', 'Winston Classic', '992-zabolevaniya-zheludochno-kishechnogo-trakta-zabolevaniya-zheludochno-kishechnogo-trakta.png'),
(4, 'Parlament', 'Parlament', '997-lechenie-pochek-i-mochevyvodyashchih-putej-lechenie-pochek-i-mochevyvodyashchih-putej.png'),
(5, 'Davidoff', 'Davidoff', '1000-lechenie-diabeta-lechenie-diabeta.png'),
(6, 'Lenovo', '', NULL),
(7, 'Acer', '', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
(8, 11, 1, 0, 0, 1, 1, 0),
(9, 12, 1, 0, 0, 1, 1, 0),
(10, 13, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `productoption`
--

CREATE TABLE IF NOT EXISTS `productoption` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productoption`
--

INSERT INTO `productoption` (`id`, `name`) VALUES
(8, 'Размер'),
(9, 'Операционная система');

-- --------------------------------------------------------

--
-- Структура таблицы `productoptionvalue`
--

CREATE TABLE IF NOT EXISTS `productoptionvalue` (
  `id` int(10) unsigned NOT NULL,
  `productOptionId` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productoptionvalue`
--

INSERT INTO `productoptionvalue` (`id`, `productOptionId`, `name`, `price`) VALUES
(12, 8, 'S', '-20'),
(13, 8, 'M', '0'),
(14, 8, 'L', '10'),
(15, 8, 'XL', '20'),
(16, 8, 'XXL', '30'),
(17, 9, 'Windows 10', '500'),
(18, 9, 'Windows 8.x', '300'),
(19, 9, 'Linux', '0'),
(20, 9, 'Без ОС', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productproductspecificationrelation`
--

INSERT INTO `productproductspecificationrelation` (`id`, `productId`, `productSpecificationId`, `value`, `isSearch`) VALUES
(9, 4, 5, '6777', 1),
(10, 4, 6, '', 0),
(11, 5, 5, '8889', 1),
(12, 5, 6, '', 0),
(13, 6, 5, '6777', 1),
(14, 6, 6, '', 0),
(15, 7, 5, '8886', 1),
(16, 7, 6, '', 0),
(19, 9, 5, '8886', 1),
(20, 9, 6, '', 0),
(21, 10, 5, '8886', 1),
(22, 10, 6, '', 0),
(25, 11, 5, '8886', 1),
(26, 11, 6, '1000х5000', 1),
(49, 12, 7, 'Intel Celeron N3060 (1.6 - 2.48 ГГц)', 1),
(50, 12, 8, '11.6"', 1),
(51, 12, 9, '2 ГБ', 1),
(52, 12, 10, 'Intel HD Graphics', 1),
(53, 12, 12, 'Двухъядерный', 1),
(54, 12, 13, 'HDD', 1),
(55, 12, 14, '1366x768', 1),
(56, 12, 15, '500 ГБ', 1),
(57, 12, 16, 'Отсутствует', 0),
(58, 12, 18, 'матовый', 0),
(59, 12, 19, 'красный', 0),
(60, 13, 7, 'Intel Atom Z3735F (1.33 - 1.83 ГГц)', 1),
(61, 13, 8, '11.6"', 1),
(62, 13, 9, '2 ГБ', 1),
(63, 13, 10, 'Intel HD Graphics', 1),
(64, 13, 12, 'Четырехъядерный', 1),
(65, 13, 13, 'eMMC', 1),
(66, 13, 14, '1366x768', 1),
(67, 13, 15, '64 ГБ', 1),
(68, 13, 16, 'Отсутствует', 0),
(69, 13, 18, 'глянцевый', 0),
(70, 13, 19, 'сине-белый', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productspecification`
--

INSERT INTO `productspecification` (`id`, `name`) VALUES
(5, 'Страниц'),
(6, 'Формат'),
(7, 'Процессор'),
(8, 'Экран'),
(9, 'Объем оперативной памяти'),
(10, 'Видеокарта'),
(12, 'Количество ядер процессора'),
(13, 'Тип накопителя'),
(14, 'Разрешение'),
(15, 'Объём накопителя'),
(16, 'Оптический привод'),
(17, 'Объем памяти видеокарты'),
(18, 'Покрытие экрана'),
(19, 'Цвет');

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
(11, '', 0),
(12, '', 0),
(13, '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `userGroupId`, `isActive`, `description`) VALUES
(0, 'admin@example.com', '', 1, 0, NULL),
(1, 'kasp89s@gmail.com', '8349efb1b90fb33b41698cbe945769c4', 1, 1, 'Мудила'),
(4, 'kasp89s@mail.ru', 'g65uerden', 2, 1, 'Hello word'),
(6, 'test@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `actions` set('user','customer','banner','info-page','manufacture','discount','coupon','shipping-method','payment-method','news','news-letter-subscriber','product','category','order','group','customer-group','specification','option','comment') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `actions`) VALUES
(1, 'Супер админ', 'user,customer,banner,info-page,manufacture,discount,coupon,shipping-method,payment-method,news,news-letter-subscriber,product,category,order,group,customer-group,specification,option,comment'),
(2, 'Админ', 'banner,info-page,manufacture,discount,coupon,news,news-letter-subscriber,product');

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
-- Индексы таблицы `customerphone`
--
ALTER TABLE `customerphone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=540;
--
-- AUTO_INCREMENT для таблицы `basketproduct`
--
ALTER TABLE `basketproduct`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `basketproductattribute`
--
ALTER TABLE `basketproductattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `customerphone`
--
ALTER TABLE `customerphone`
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `ordercustomerinfo`
--
ALTER TABLE `ordercustomerinfo`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT для таблицы `orderproductattribute`
--
ALTER TABLE `orderproductattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT для таблицы `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `ordertotal`
--
ALTER TABLE `ordertotal`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `productattribute`
--
ALTER TABLE `productattribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT для таблицы `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `productcategoryproductoptionrelation`
--
ALTER TABLE `productcategoryproductoptionrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT для таблицы `productcategoryproductspecificationrelation`
--
ALTER TABLE `productcategoryproductspecificationrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT для таблицы `productdiscount`
--
ALTER TABLE `productdiscount`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `productincomingprice`
--
ALTER TABLE `productincomingprice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `productmanufacture`
--
ALTER TABLE `productmanufacture`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `productmarker`
--
ALTER TABLE `productmarker`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `productoption`
--
ALTER TABLE `productoption`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `productoptionvalue`
--
ALTER TABLE `productoptionvalue`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `productproductspecificationrelation`
--
ALTER TABLE `productproductspecificationrelation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT для таблицы `productspecification`
--
ALTER TABLE `productspecification`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
-- Ограничения внешнего ключа таблицы `customerphone`
--
ALTER TABLE `customerphone`
  ADD CONSTRAINT `customerphone_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
