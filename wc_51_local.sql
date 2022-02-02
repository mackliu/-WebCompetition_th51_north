-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `wc_51_local`
--

-- --------------------------------------------------------

--
-- 資料表結構 `inv_codes`
--

CREATE TABLE `inv_codes` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `used` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `inv_codes`
--

INSERT INTO `inv_codes` (`id`, `code`, `quiz_id`, `used`) VALUES
(1, 'A0001', 3, 0),
(7, '69869', 8, 0),
(8, '62041', 9, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `logs`
--

CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `inv_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `logs`
--

INSERT INTO `logs` (`id`, `inv_code`, `ans`, `quiz_id`, `created_date`) VALUES
(16, 'A0001', 'a:8:{i:1;s:1:\"1\";i:2;a:4:{i:0;s:1:\"0\";i:1;s:1:\"2\";i:2;s:1:\"5\";s:5:\"other\";s:5:\"aaaaa\";}i:3;a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";s:5:\"other\";s:0:\"\";}i:4;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"3\";}i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:15:\"adfsafsdfasdfas\";}', 3, '2022-01-31 10:47:44'),
(17, 'A0001', 'a:8:{i:1;s:1:\"1\";i:2;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";s:5:\"other\";s:0:\"\";}i:3;a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"3\";s:5:\"other\";s:11:\"dsfasdfasdf\";}i:4;a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}i:5;s:1:\"0\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:11:\"sdfsfsadfsd\";}', 3, '2022-01-31 11:14:39'),
(18, 'A0001', 'a:8:{i:1;s:1:\"0\";i:2;a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"5\";s:5:\"other\";s:9:\"dfasdasdf\";}i:3;a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";s:5:\"other\";s:9:\"dsfasdfsa\";}i:4;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"4\";}i:5;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"0\";i:8;s:13:\"dfsadfsdfsdaf\";}', 3, '2022-01-31 11:15:13'),
(22, 'A0001', 'a:8:{i:1;s:1:\"1\";i:2;a:4:{i:0;s:1:\"0\";i:1;s:1:\"2\";i:2;s:1:\"5\";s:5:\"other\";s:5:\"aaaaa\";}i:3;a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";s:5:\"other\";s:0:\"\";}i:4;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"3\";}i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:15:\"adfsafsdfasdfas\";}', 9, '2022-01-31 10:47:44'),
(23, 'A0001', 'a:8:{i:1;s:1:\"1\";i:2;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";s:5:\"other\";s:0:\"\";}i:3;a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"3\";s:5:\"other\";s:11:\"dsfasdfasdf\";}i:4;a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}i:5;s:1:\"0\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:11:\"sdfsfsadfsd\";}', 9, '2022-01-31 11:14:39'),
(24, 'A0001', 'a:8:{i:1;s:1:\"0\";i:2;a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"5\";s:5:\"other\";s:9:\"dfasdasdf\";}i:3;a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";s:5:\"other\";s:9:\"dsfasdfsa\";}i:4;a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"4\";}i:5;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"0\";i:8;s:13:\"dfsadfsdfsdaf\";}', 9, '2022-01-31 11:15:13');

-- --------------------------------------------------------

--
-- 資料表結構 `quizs`
--

CREATE TABLE `quizs` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '流水號',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '問卷名稱',
  `qt` int(11) UNSIGNED NOT NULL COMMENT '問卷數量',
  `paginate` int(11) NOT NULL COMMENT '分頁量',
  `inv_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single' COMMENT '邀請碼型式',
  `subjects` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '問卷內容',
  `locked` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OFF' COMMENT '是否鎖定'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `quizs`
--

INSERT INTO `quizs` (`id`, `name`, `qt`, `paginate`, `inv_type`, `subjects`, `locked`) VALUES
(3, '勞動大學課程改進問卷調查', 10, 3, 'single', 'a:8:{i:1;a:4:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:3:\"tof\";s:3:\"seq\";s:1:\"1\";s:4:\"desc\";s:37:\"您是否同意本問卷結果公開?\";}i:2;a:5:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"2\";s:4:\"desc\";s:43:\"您主要從何處得知本班開課訊息?\";s:3:\"opt\";a:5:{i:0;s:12:\"本校首頁\";i:1;s:15:\"本中心網頁\";i:2;s:15:\"校外紅布條\";i:3;s:12:\"親友告知\";i:4;s:12:\"報紙廣告\";}s:5:\"other\";s:2:\"on\";}i:3;a:6:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"3\";s:4:\"desc\";s:34:\"您參加本推廣班的理由是?\";s:3:\"opt\";a:3:{i:0;s:6:\"興趣\";i:1;s:18:\"增進語言能力\";i:2;s:12:\"準備考試\";}s:5:\"other\";s:2:\"on\";}i:4;a:4:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"4\";s:4:\"desc\";s:37:\"您比較喜歡的推廣班時間是?\";s:3:\"opt\";a:5:{i:0;s:21:\"週一至週五早上\";i:1;s:21:\"週一至週五下午\";i:2;s:21:\"週一至週五晚上\";i:3;s:12:\"週末早上\";i:4;s:12:\"週末下午\";}}i:5;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"5\";s:4:\"desc\";s:34:\"您對目前的上課內容覺得?\";s:3:\"opt\";a:5:{i:0;s:6:\"太難\";i:1;s:3:\"難\";i:2;s:6:\"適中\";i:3;s:6:\"簡單\";i:4;s:9:\"太簡單\";}}i:6;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"6\";s:4:\"desc\";s:31:\"您覺得老師的上課速度?\";s:3:\"opt\";a:5:{i:0;s:6:\"太快\";i:1;s:9:\"有點快\";i:2;s:6:\"適中\";i:3;s:9:\"有點慢\";i:4;s:6:\"太慢\";}}i:7;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"7\";s:4:\"desc\";s:31:\"您覺得老師上課的方式?\";s:3:\"opt\";a:5:{i:0;s:12:\"非常滿意\";i:1;s:6:\"滿意\";i:2;s:6:\"適中\";i:3;s:9:\"不滿意\";i:4;s:15:\"非常不滿意\";}}i:8;a:3:{s:4:\"type\";s:2:\"qa\";s:3:\"seq\";s:1:\"8\";s:4:\"desc\";s:0:\"\";}}', 'OFF'),
(8, '勞動大學課程改進問卷調查', 10, 3, 'single', 'a:8:{i:1;a:4:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:3:\"tof\";s:3:\"seq\";s:1:\"1\";s:4:\"desc\";s:37:\"您是否同意本問卷結果公開?\";}i:2;a:5:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"2\";s:4:\"desc\";s:43:\"您主要從何處得知本班開課訊息?\";s:3:\"opt\";a:5:{i:0;s:12:\"本校首頁\";i:1;s:15:\"本中心網頁\";i:2;s:15:\"校外紅布條\";i:3;s:12:\"親友告知\";i:4;s:12:\"報紙廣告\";}s:5:\"other\";s:2:\"on\";}i:3;a:6:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"3\";s:4:\"desc\";s:34:\"您參加本推廣班的理由是?\";s:3:\"opt\";a:3:{i:0;s:6:\"興趣\";i:1;s:18:\"增進語言能力\";i:2;s:12:\"準備考試\";}s:5:\"other\";s:2:\"on\";}i:4;a:4:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"4\";s:4:\"desc\";s:37:\"您比較喜歡的推廣班時間是?\";s:3:\"opt\";a:5:{i:0;s:21:\"週一至週五早上\";i:1;s:21:\"週一至週五下午\";i:2;s:21:\"週一至週五晚上\";i:3;s:12:\"週末早上\";i:4;s:12:\"週末下午\";}}i:5;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"5\";s:4:\"desc\";s:34:\"您對目前的上課內容覺得?\";s:3:\"opt\";a:5:{i:0;s:6:\"太難\";i:1;s:3:\"難\";i:2;s:6:\"適中\";i:3;s:6:\"簡單\";i:4;s:9:\"太簡單\";}}i:6;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"6\";s:4:\"desc\";s:31:\"您覺得老師的上課速度?\";s:3:\"opt\";a:5:{i:0;s:6:\"太快\";i:1;s:9:\"有點快\";i:2;s:6:\"適中\";i:3;s:9:\"有點慢\";i:4;s:6:\"太慢\";}}i:7;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"7\";s:4:\"desc\";s:31:\"您覺得老師上課的方式?\";s:3:\"opt\";a:5:{i:0;s:12:\"非常滿意\";i:1;s:6:\"滿意\";i:2;s:6:\"適中\";i:3;s:9:\"不滿意\";i:4;s:15:\"非常不滿意\";}}i:8;a:3:{s:4:\"type\";s:2:\"qa\";s:3:\"seq\";s:1:\"8\";s:4:\"desc\";s:0:\"\";}}', 'OFF'),
(9, '勞動大學課程改進問卷調查', 10, 3, 'single', 'a:8:{i:1;a:4:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:3:\"tof\";s:3:\"seq\";s:1:\"1\";s:4:\"desc\";s:37:\"您是否同意本問卷結果公開?\";}i:2;a:5:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"2\";s:4:\"desc\";s:43:\"您主要從何處得知本班開課訊息?\";s:3:\"opt\";a:5:{i:0;s:12:\"本校首頁\";i:1;s:15:\"本中心網頁\";i:2;s:15:\"校外紅布條\";i:3;s:12:\"親友告知\";i:4;s:12:\"報紙廣告\";}s:5:\"other\";s:2:\"on\";}i:3;a:6:{s:7:\"require\";s:2:\"on\";s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"3\";s:4:\"desc\";s:34:\"您參加本推廣班的理由是?\";s:3:\"opt\";a:3:{i:0;s:6:\"興趣\";i:1;s:18:\"增進語言能力\";i:2;s:12:\"準備考試\";}s:5:\"other\";s:2:\"on\";}i:4;a:4:{s:4:\"type\";s:8:\"multiple\";s:3:\"seq\";s:1:\"4\";s:4:\"desc\";s:37:\"您比較喜歡的推廣班時間是?\";s:3:\"opt\";a:5:{i:0;s:21:\"週一至週五早上\";i:1;s:21:\"週一至週五下午\";i:2;s:21:\"週一至週五晚上\";i:3;s:12:\"週末早上\";i:4;s:12:\"週末下午\";}}i:5;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"5\";s:4:\"desc\";s:34:\"您對目前的上課內容覺得?\";s:3:\"opt\";a:5:{i:0;s:6:\"太難\";i:1;s:3:\"難\";i:2;s:6:\"適中\";i:3;s:6:\"簡單\";i:4;s:9:\"太簡單\";}}i:6;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"6\";s:4:\"desc\";s:31:\"您覺得老師的上課速度?\";s:3:\"opt\";a:5:{i:0;s:6:\"太快\";i:1;s:9:\"有點快\";i:2;s:6:\"適中\";i:3;s:9:\"有點慢\";i:4;s:6:\"太慢\";}}i:7;a:4:{s:4:\"type\";s:6:\"single\";s:3:\"seq\";s:1:\"7\";s:4:\"desc\";s:31:\"您覺得老師上課的方式?\";s:3:\"opt\";a:5:{i:0;s:12:\"非常滿意\";i:1;s:6:\"滿意\";i:2;s:6:\"適中\";i:3;s:9:\"不滿意\";i:4;s:15:\"非常不滿意\";}}i:8;a:3:{s:4:\"type\";s:2:\"qa\";s:3:\"seq\";s:1:\"8\";s:4:\"desc\";s:0:\"\";}}', 'OFF');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `inv_codes`
--
ALTER TABLE `inv_codes`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `quizs`
--
ALTER TABLE `quizs`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `inv_codes`
--
ALTER TABLE `inv_codes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `quizs`
--
ALTER TABLE `quizs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
