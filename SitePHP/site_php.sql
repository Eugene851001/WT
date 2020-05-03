-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 03 2020 г., 12:28
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site_php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `page_id` int NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `page_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `header`, `page_content`) VALUES
(1, 'Main', 'PHP', '../res/ContentMain.html'),
(2, 'Manual', 'Документация PHP', '../res/ContentManual.html'),
(3, 'What do i need?', 'Документация', '../res/ContentWhatDoINeed.html'),
(4, 'Guid', 'Документация PHP', '../res/ContentGuid.html'),
(5, 'First page PHP', 'Документация PHP', '../res/ContentFirstPage.html'),
(6, 'Something usefull', 'Документация PHP', '../res/ContentSomethingUsefull.html'),
(7, 'Types', 'Документация PHP', '../res/ContentTypes.html'),
(8, 'Compiler', 'Компилятор', '../res/ContentCompiler.html'),
(9, 'Registration', 'Документация PHP', '../res/ContentRegistration.html'),
(10, 'Login in', 'Документация PHP', '../res/ContentLogin.html'),
(11, 'Feedback', 'Документация PHP', '../res/ContentFeedback.html'),
(12, 'Statistics', 'Статистика', '');

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `section_id` int NOT NULL,
  `parent_section_id` int DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`section_id`, `parent_section_id`, `title`, `link`) VALUES
(1, 0, 'Main', 'Main.php'),
(2, 0, 'Manual', 'Manual.php'),
(3, 0, 'Guid', 'Guid.php'),
(4, 2, 'What do i need?', 'WhatDoINeed.php'),
(5, 2, 'First page php', 'FirstPagePHP.php'),
(6, 2, 'Do something', 'SomethingUsefull.php'),
(7, 3, 'Types', 'Types.php'),
(8, 0, 'Registration', 'Registration.php'),
(9, 6, 'Output', 'SomethingUsefull.php#FirstExample'),
(10, 6, 'If contructions', 'SomethingUsefull.php#SecondExample'),
(11, 0, 'Site Map', 'SiteMap.php');

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE `statistics` (
  `id` int NOT NULL,
  `browser_name` varchar(30) DEFAULT NULL,
  `user_address` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`id`, `browser_name`, `user_address`) VALUES
(1, 'Opera', '::1'),
(2, 'Edge', '192.168.230.1'),
(3, 'Opera', '192.168.230.1');

-- --------------------------------------------------------

--
-- Структура таблицы `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `LINK` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `surveys`
--

INSERT INTO `surveys` (`survey_id`, `name`, `LINK`) VALUES
(1, 'ProgrammingLanguage', '../res/surveys/ProgrammingLanguages.html'),
(2, 'IsUsefull', '../res/surveys/IsUsefull.html'),
(3, 'PHPBehavior', '../res/surveys/PHPBehavior.html');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `login`, `password`, `mail`) VALUES
(1, 'name', '234', '$2y$10$/gqI.WtABZp05F9EIsU5oepLKgH/QFk8X8Ukb.kE3PK7SkKkTJYbe', '324'),
(2, 'name', 'Admin', '$2y$10$k4VlKqlj4KEW6fs6uOrJguXh8QjVHTLFOFJlgTeO9MwoWt5ZIzlem', 'jackz16302mail.ru'),
(3, 'Jack', '12345', '$2y$10$L173Eej9G1P3CEL9JTBaJOeAaWfSAc2MRY4xINH9YB6v5k3fBpjOa', '123'),
(4, 'name', 'login', '$2y$10$WlgSUx.DfOl9rtFj8mw9OOyI1qhKuyf4jpMq63mfGN.V4DnWvZaqe', 'jackz16302mail.ru'),
(5, 'name', 'logout', '$2y$10$HxsQaoybq993kzmA1F4vpONmhguqsVrhFQtU8Zw2GAj0W5Onk8pA6', 'jackz16302mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
