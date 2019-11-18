-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 10 2019 г., 18:05
-- Версия сервера: 5.7.16-log
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `markup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments_users`
--

CREATE TABLE `comments_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments_users`
--

INSERT INTO `comments_users` (`id`, `user_id`, `text`, `date`) VALUES
(1, 3, 'Первый комментарий', '1573318680'),
(2, 4, 'Второй комментарий\r\n', '1573318752'),
(3, 4, 'третий комментарий\r\n', '1573321044');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_confirmation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `password_confirmation`) VALUES
(3, 'user1', 'test@mail.ru', '$2y$10$0.KliR682puONAPOyYZ0lukyPyz2eDWx4zAYNEplOnVG6OhKGY9la', '$2y$10$LUqQV.oHTv2w158Xh6VOXe0Tvtrtx6BZgWtdpVbAZrMOzunjWSsDi'),
(4, 'user2', 'user2@mail.ru', '$2y$10$66hsY17aLpeXofB01RiGzeKCz2rPvUthmv7ertxWZfom22MHsFccO', '$2y$10$MnNSVqMYHL2r/t6Ne278keTXYC3rhcfIQtiJMkdcrqZr8LchcRTxy');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments_users`
--
ALTER TABLE `comments_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments_users`
--
ALTER TABLE `comments_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments_users`
--
ALTER TABLE `comments_users`
  ADD CONSTRAINT `comments_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
