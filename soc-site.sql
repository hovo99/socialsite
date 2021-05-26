-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 17 2020 г., 17:06
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `soc-site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `first_user_id` int(11) NOT NULL,
  `second_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `first_user_id`, `second_user_id`) VALUES
(18, 26, 25),
(21, 26, 25),
(22, 26, 25),
(23, 25, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `chat_id`, `sender_id`, `message`, `date_time`) VALUES
(347, 18, 26, '18wefgew\n', '2020-04-17'),
(348, 18, 26, 'wgweg\n', '2020-04-17'),
(349, 18, 25, '18wef\n', '2020-04-17'),
(350, 18, 26, '18wefe\n', '2020-04-17'),
(351, 18, 26, '18sdgsd\n', '2020-04-17'),
(352, 18, 26, '18wefwe\n', '2020-04-17'),
(353, 18, 26, 'wef\n', '2020-04-17'),
(354, 18, 26, 'ewf\n', '2020-04-17'),
(355, 18, 25, 'wefew\n', '2020-04-17'),
(356, 18, 25, '18fwef\n', '2020-04-17'),
(357, 18, 26, '18wefe\n', '2020-04-17'),
(358, 18, 26, 'fwefwe\n', '2020-04-17'),
(359, 18, 25, 'fwewefew\n', '2020-04-17'),
(360, 18, 25, '25gwegew\n', '2020-04-17'),
(361, 18, 25, 'wefewf\n', '2020-04-17'),
(362, 18, 26, '26ewfew\n', '2020-04-17'),
(363, 18, 26, 'gewrreg\n', '2020-04-17'),
(364, 18, 25, 'erger\n', '2020-04-17'),
(365, 18, 26, '26gwegew\n', '2020-04-17'),
(366, 18, 25, '25wegewg\n', '2020-04-17'),
(367, 18, 25, 'weg\n', '2020-04-17'),
(368, 18, 25, 'weg\n', '2020-04-17'),
(369, 18, 26, '26eg\n', '2020-04-17'),
(370, 18, 25, 'erg\n', '2020-04-17'),
(371, 18, 26, 'reg\n', '2020-04-17'),
(372, 18, 26, 'erg\n', '2020-04-17'),
(373, 18, 26, 'erg\n', '2020-04-17'),
(374, 18, 25, 'ergregre\n', '2020-04-17'),
(375, 18, 26, '26fewf\n', '2020-04-17'),
(376, 18, 26, 'fff\n', '2020-04-17');

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `uxarkoxi_id` int(11) NOT NULL,
  `stacoxi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `friends`
--

INSERT INTO `friends` (`id`, `uxarkoxi_id`, `stacoxi_id`) VALUES
(4, 26, 25),
(5, 24, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(11) NOT NULL,
  `uxarkoxi_id` int(11) NOT NULL,
  `stacoxi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `friend_request`
--

INSERT INTO `friend_request` (`id`, `uxarkoxi_id`, `stacoxi_id`) VALUES
(10, 26, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `name`) VALUES
(5, 22, '1557923763img-2.jpg'),
(6, 22, '1557923763img-3.jpg'),
(7, 22, '1557923763img-4.jpg'),
(8, 22, '1557924074img-3.jpg'),
(9, 22, '1557924074img-4.jpg'),
(10, 22, '15579278906.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `img`) VALUES
(1, 21, 'dsfsdsdf', 'sfsfsasad', '1557495630apple-touch-icon-114x114.png'),
(2, 21, 'dsfsdsdf2', 'sfsfsasad', '1557495714apple-touch-icon-114x114.png'),
(3, 21, 'dsfsdsdf', 'sfsfsasad', '1557495789apple-touch-icon-114x114.png'),
(4, 22, '', 'sdfsdfs', '1557752060apple-touch-icon-144x144.png'),
(5, 22, 'dfgdfgd', 'dgdfgd', ''),
(6, 26, 'uol89', 'ouol89o89o', '15865453401_XVJg3i1j5fhPDx961bbsvQ.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `post_like`
--

CREATE TABLE `post_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `post_like`
--

INSERT INTO `post_like` (`id`, `user_id`, `post_id`) VALUES
(1, 22, 4),
(3, 26, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `country` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `country`, `date`, `created_at`, `updated_at`, `avatar`) VALUES
(22, 'Aram', 'Sargsyan', 'a@a.a', '$1$kFD3vLrp$NOdQMmfn08bsQ1dC5dkrE1', 'male', 'Armenia', '1997-11-11', '2019-05-13 12:52:30', '2019-05-15 17:44:53', '15579278906.jpg'),
(23, 'Aram2', 'Sargsyan2', 'a@a.a2', '$1$UdfyjLJp$WtdrcKdMPnZMvjhIn/uxw0', 'male', 'Armenia', '1997-11-14', '2019-05-15 13:20:34', '2019-05-15 17:20:34', NULL),
(24, 'Garnik', 'Xaribyan', 'g@g.g', '$1$D7h92CRB$iVRVYHOVSeXNi.epcC3iw1', 'male', 'Algeria', '2019-05-24', '2019-05-17 12:57:42', '2019-05-17 16:58:13', '155809789303.jpg'),
(25, 'Artashuhi', 'Asatryan', 'a@a.axjik', '$1$i58si1K2$3ZWgI/LKzJR9Op98Xpx4G/', 'female', 'Gibraltar', '2007-11-08', '2019-05-17 13:19:47', '2019-05-17 17:21:45', '1558099305portfolio-2.jpg'),
(26, 'test', 'test', 'test@test.test', '$1$D/F3ugsG$MMohIxnD8MvQR/DiRcfAr1', 'male', 'Armenia', '2020-04-14', '2020-04-10 19:01:49', '2020-04-10 23:01:49', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `post_like`
--
ALTER TABLE `post_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
