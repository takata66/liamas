

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Ювелирные кольца'),
(2, 'Серьги'),
(3, 'Ожерелья'),
(4, 'Браслеты'),
(5, 'Часы'),
(6, 'Аксессуары');


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


CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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


ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;
