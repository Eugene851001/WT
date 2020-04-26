-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 09 2020 г., 15:02
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
CREATE DATABASE IF NOT EXISTS `site_php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `site_php`;

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
(9, 'Registration', 'Документация PHP', '../res/ContentRegistration.html');

-- --------------------------------------------------------

--
-- Структура таблицы `programs`
--

CREATE TABLE `programs` (
  `program_id` int NOT NULL,
  `program_name` varchar(20) DEFAULT NULL,
  `owner_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `owner_id`) VALUES
(2, '????5', 3);

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
  `user_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`) VALUES
(3, 'BILL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

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
  MODIFY `page_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
