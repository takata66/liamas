-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 20 2023 г., 01:37
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `liamas`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `added_on`) VALUES
(101, 1, 5, 1, '2023-12-16 05:57:09'),
(104, 1, 12, 1, '2023-12-16 05:57:16'),
(105, 1, 13, 1, '2023-12-16 05:57:17');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Ювелирные кольца'),
(2, 'Серьги'),
(3, 'Ожерелья'),
(4, 'Браслеты'),
(5, 'Часы'),
(6, 'Аксессуары');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` enum('обработан','отправлен','доставлен') DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `product_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_id`)),
  `price` decimal(10,2) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `payment_type`, `product_id`, `price`, `address`, `full_name`) VALUES
(974, 1, '2023-12-15 22:22:38', 'обработан', 'sbp', '[{\"product_id\":3,\"quantity\":1},{\"product_id\":5,\"quantity\":1},{\"product_id\":6,\"quantity\":1},{\"product_id\":9,\"quantity\":1}]', 15900.00, 'Москва, Хилков переулок, 1, Частное здание', 'Шачнев Дмитрий Константинович'),
(975, 1, '2023-12-16 02:06:39', 'обработан', 'card', '[{\"product_id\":5,\"quantity\":1},{\"product_id\":6,\"quantity\":1},{\"product_id\":9,\"quantity\":1}]', 7900.00, 'Мещерский парк, Частное здание', 'Шачнев Дмитрий Константинович'),
(976, 1, '2023-12-16 05:11:13', 'обработан', 'cash', '[{\"product_id\":6,\"quantity\":2},{\"product_id\":3,\"quantity\":1},{\"product_id\":5,\"quantity\":2},{\"product_id\":12,\"quantity\":1},{\"product_id\":15,\"quantity\":1},{\"product_id\":10,\"quantity\":1}]', 22500.00, 'Москва, Лужники, Частное здание', 'Шачнев Дмитрий Константинович'),
(977, 1, '2023-12-16 05:11:35', 'обработан', 'sbp', '[{\"product_id\":5,\"quantity\":1},{\"product_id\":3,\"quantity\":1},{\"product_id\":9,\"quantity\":1}]', 14700.00, 'Москва, Беленовский проезд, Частное здание', 'Шачнев Дмитрий Константинович');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`, `image_url`) VALUES
(3, 'Жемчужное ожерелье', 'Элегантное ожерелье с жемчугом и бриллиантами.', 8000.00, 3, 'https://sun9-46.userapi.com/impg/sRNwco-2AwqFataQufhI8o5hEd-ysawA4OdBjA/ARLT0gmT9Rc.jpg?size=732x760&quality=96&sign=580de43aaed8ef43d276b4c758b4035f&type=album'),
(5, 'Мужские часы', 'Классические мужские часы с кожаным ремешком.', 2500.00, 5, 'https://sun9-50.userapi.com/impg/rht-iVcomxCR1kJqvlGut1kgG54kgmGBZH9qrA/Vza5gw_UKNY.jpg?size=762x740&quality=96&sign=e1e306745f0e42cd07a1e77da26a01e4&type=album'),
(6, 'Ювелирная брошь', 'Украшение-брошь с яркими драгоценными камнями.', 1200.00, 6, 'https://sun9-61.userapi.com/impg/oiYRmmN5cEyXK7T8W49c-vJfiJcx8-k7rgeFNQ/qR4mdRHtheE.jpg?size=640x480&quality=96&sign=a16869924b6eb390b20c0e04940d92d2&type=album'),
(9, 'Золотые наручные часы', 'Элегантные наручные часы с золотым браслетом.', 4200.00, 5, 'https://sun9-61.userapi.com/impg/oiYRmmN5cEyXK7T8W49c-vJfiJcx8-k7rgeFNQ/qR4mdRHtheE.jpg?size=640x480&quality=96&sign=a16869924b6eb390b20c0e04940d92d2&type=album'),
(10, 'Серебряное ожерелье', 'Прекрасное ожерелье из серебра с инкрустацией.', 2400.00, 4, 'https://sun9-6.userapi.com/impg/sztU_aV_91K7l4e-GLUOPAQzbXUkUzKY4mQWPQ/QAwS2qHhOQ4.jpg?size=1024x1024&quality=96&sign=ae93adb9802132608aa98b6fc7493cc7&type=album'),
(11, 'Бриллиантовое кольцо', 'Кольцо с крупным бриллиантом в круглой огранке.', 7500.00, 1, 'https://sun9-61.userapi.com/impg/oiYRmmN5cEyXK7T8W49c-vJfiJcx8-k7rgeFNQ/qR4mdRHtheE.jpg?size=640x480&quality=96&sign=a16869924b6eb390b20c0e04940d92d2&type=album'),
(12, 'Сапфировый браслет', 'Сапфировый браслет с белыми бриллиантами.', 3800.00, 4, 'https://sun9-6.userapi.com/impg/5OCta6zywRD7ZCOzRibOQHdvWWrMfiV2RG3XUg/l-8dIkb6ZIE.jpg?size=1024x1024&quality=96&sign=e619f38e1d1a1ff271467792225f07ec&type=album'),
(13, 'Серьги-гвоздики', 'Простые и стильные серьги-гвоздики из золота.', 1200.00, 2, 'https://sun9-61.userapi.com/impg/oiYRmmN5cEyXK7T8W49c-vJfiJcx8-k7rgeFNQ/qR4mdRHtheE.jpg?size=640x480&quality=96&sign=a16869924b6eb390b20c0e04940d92d2&type=album'),
(15, 'Подвеска с аметистом', 'Подвеска с аметистовым камнем и серебряной цепью.', 900.00, 3, 'https://sun9-15.userapi.com/impg/kGI1h-CsRFmsObJhMaFIjztQIaeRyGhEQW6q8w/Ug7WyiX3DIk.jpg?size=1024x1024&quality=96&sign=509b501dceb03cfb09b43045b3411e9a&type=album');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `surname`, `first_name`, `middle_name`, `date_of_birth`) VALUES
(1, 'takata', 'mity.klondike@gmail.com', '$2y$10$KfRu.Nvtunu.04nMn0MuSO.3m2x7aQCeioqXV1ABBs0bEyJULCTvS', 'admin', NULL, NULL, NULL, NULL),
(2, 'vikamikky', 'mikushina04@inbox.ru', '$2y$10$lxZ4JnzDEiCwQIBBCTcrP.IvNbbTRJoNszJTfKeGp7aLFdRBNaAdi', 'admin', 'Микушина', 'Виктория', 'Дмитриевна', '2004-11-10'),
(3, 'takata9', 'juve.hef@gmail.com', '$2y$10$Y2qTdUziruOv1LBRS4oqM.mBTvCQW14qxT/0qNL7b/qMvdRb1MFn2', 'customer', 'Шачнев', 'Дмитрий1', 'Константинович', '2004-04-16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=978;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;