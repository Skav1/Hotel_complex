-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Січ 05 2023 р., 06:53
-- Версія сервера: 8.0.24
-- Версія PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `hotel_complex`
--

-- --------------------------------------------------------

--
-- Структура таблиці `bill`
--

CREATE TABLE `bill` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `room_charge` int NOT NULL,
  `room_service_charge` int NOT NULL,
  `minibar_charge` int NOT NULL,
  `payment_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `bill`
--

INSERT INTO `bill` (`id`, `reservation_id`, `client_id`, `room_charge`, `room_service_charge`, `minibar_charge`, `payment_date`, `expire_date`) VALUES
(2, 8, 39, 4800, 250, 130, '2023-01-17 12:00:00', '2023-01-24 18:00:00'),
(3, 9, 40, 800, 50, 0, '2023-02-03 09:30:00', '2023-03-01 19:40:00'),
(4, 10, 41, 38000, 3400, 2160, '2023-01-28 15:20:00', '2023-02-06 18:00:00'),
(5, 11, 42, 43400, 5710, 2940, '2023-05-10 20:50:00', '2023-06-03 16:30:00'),
(6, 12, 43, 58600, 6650, 1570, '2023-03-15 12:00:00', '2023-03-28 14:00:00');

-- --------------------------------------------------------

--
-- Структура таблиці `client`
--

CREATE TABLE `client` (
  `id` bigint UNSIGNED NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `passport_no` int NOT NULL,
  `fname` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `client`
--

INSERT INTO `client` (`id`, `password`, `email`, `passport_no`, `fname`, `lname`, `phone`) VALUES
(38, '9L4Ndja35ZiBX42r', 'trofofrugroufi@gmail.com', 2434442, 'Vann', 'Davis', '340586539047'),
(39, 'mB39Fj223ZxRp', 'roinoucraffilo1152@gmail.com', 342452, 'Colt', 'Morgan', '9690371991952'),
(40, 'f8PZ296neT', 'yihugammoinnou21@gmail.com', 425243, 'Brian', 'James', '84017003793'),
(41, 'A4d5s5L', 'prazebaquawa456@gmail.com', 654677, 'Konstantin', 'Veremchuk', '6016612935652'),
(42, 'mB39Fj223ZxRp', 'noifra5ujatri237@gmail.com', 276561, 'Roman', 'Dubnevich', '079122656955'),
(43, 'tK9T55Gzb2', 'mejeyauffeive9559@gmail.com', 876542, 'Rodion', 'Gornikevich', '614920355584');

-- --------------------------------------------------------

--
-- Структура таблиці `hotel`
--

CREATE TABLE `hotel` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `star_rating` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `country`, `city`, `address`, `star_rating`) VALUES
(1, 'Desna', 'Ukraine', 'Kyiv', 'Desnyanskaya 77', 4),
(2, 'Politeh-hostel', 'Ukraine', 'Chernihiv', 'Shevchenko 95C', 4),
(3, 'Branderburg', 'Germany', 'Berlin', 'Platz der Republik 41', 5),
(4, 'La-Defanse', 'France', 'Versailles', 'Rue du Vieux Versailles 71', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `reservation`
--

CREATE TABLE `reservation` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `hotel_code` bigint UNSIGNED NOT NULL,
  `room_number` bigint UNSIGNED NOT NULL,
  `reservation_date_` date NOT NULL,
  `reservation_time` time NOT NULL,
  `quantity_peoples` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `reservation`
--

INSERT INTO `reservation` (`id`, `client_id`, `hotel_code`, `room_number`, `reservation_date_`, `reservation_time`, `quantity_peoples`) VALUES
(8, 39, 1, 3, '2023-01-14', '14:27:32', 2),
(9, 40, 2, 5, '2023-02-02', '14:27:32', 4),
(10, 41, 3, 7, '2023-01-23', '15:37:12', 1),
(11, 42, 3, 8, '2023-05-07', '17:30:00', 2),
(12, 43, 4, 12, '2023-02-26', '08:45:00', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `room`
--

CREATE TABLE `room` (
  `room_number` bigint UNSIGNED NOT NULL,
  `hotel_code` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `floor` int NOT NULL,
  `style` varchar(30) NOT NULL,
  `room_area` int NOT NULL,
  `internet` varchar(30) NOT NULL,
  `beds` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `room`
--

INSERT INTO `room` (`room_number`, `hotel_code`, `status`, `floor`, `style`, `room_area`, `internet`, `beds`) VALUES
(1, 1, 0, 2, 'minimalism', 40, '94 Mbps', 2),
(2, 1, 1, 1, 'loft', 32, '95 Mbps', 1),
(3, 1, 0, 2, 'minimalism', 46, '93 Mbps', 2),
(4, 2, 1, 1, 'classicism', 36, '86 Mbps', 2),
(5, 2, 0, 2, 'classicism', 48, '64 Mbps', 4),
(6, 2, 1, 3, 'classicism', 36, 'none', 2),
(7, 3, 0, 1, 'modern', 28, '96 Mbps', 1),
(8, 3, 0, 2, 'high-tech', 38, '98 Mbps', 2),
(9, 3, 1, 1, 'modern', 57, '96 Mbps', 4),
(10, 4, 1, 1, 'art-deco', 45, '87 Mbps', 2),
(11, 4, 1, 2, 'loft', 64, '85 Mbps', 4),
(12, 4, 0, 3, 'classicism', 31, '81 Mbps', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `hotel_code` bigint UNSIGNED NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(32) NOT NULL,
  `salary` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `staff`
--

INSERT INTO `staff` (`id`, `hotel_code`, `fname`, `lname`, `phone`, `email`, `salary`) VALUES
(3, 2, 'Denis', 'Mirgorodskiy', '380684711808', 'denisok1006@gmail.com', 2000),
(4, 2, 'Yuhim', 'Perehodov', '380685083397', 'dniprovets25@gmail.com', 10000),
(5, 3, 'Nikhil', 'Watson', '490304196936', 'fouzeipragrafe53@gmail.com', 70000),
(6, 3, 'Sadig', 'Abbaszade', '994517258088', 'memiyahauxi7507@gmail.com', 25000),
(7, 4, 'Milan', 'Cooper', '339106686506', 'nepeunnoumuze@gmail.com', 45000),
(8, 4, 'Luis', 'Lee', '338183559243', 'brebrafrevaza624@gmail.com', 50000);

-- --------------------------------------------------------

--
-- Структура таблиці `usertbl`
--

CREATE TABLE `usertbl` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `roles` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `usertbl`
--

INSERT INTO `usertbl` (`id`, `username`, `password`, `roles`) VALUES
(5, 'admin', '$2y$10$KpDKLM7xoF8DAmT4gVAe8O4gfbb3LV4dBzpz5HyHdAbgOwT9Zh4ki', 'admin'),
(6, 'test', '$2y$10$wxp1A1Gf4ow6q8dBmF7B5ersfwNabOicGhCWltp5g0G747lZWyHB2', 'user');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `reservation_id` (`reservation_id`,`client_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Індекси таблиці `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD UNIQUE KEY `id_4` (`id`),
  ADD UNIQUE KEY `id_5` (`id`);

--
-- Індекси таблиці `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `hotel_code` (`hotel_code`),
  ADD KEY `client_id` (`client_id`,`hotel_code`,`room_number`),
  ADD KEY `room_number` (`room_number`);

--
-- Індекси таблиці `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_number`),
  ADD UNIQUE KEY `room_number` (`room_number`),
  ADD KEY `hotel_code` (`hotel_code`),
  ADD KEY `hotel_code_2` (`hotel_code`);

--
-- Індекси таблиці `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `hotel_code` (`hotel_code`);

--
-- Індекси таблиці `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `bill`
--
ALTER TABLE `bill`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=457;

--
-- AUTO_INCREMENT для таблиці `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3424;

--
-- AUTO_INCREMENT для таблиці `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT для таблиці `room`
--
ALTER TABLE `room`
  MODIFY `room_number` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблиці `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`hotel_code`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`hotel_code`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`hotel_code`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
