CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `products` (`id`, `name`, `price`, `stock`) VALUES
(1, 'SAMSUNG 三星 EVO Plus microSDXC UHS-1(U3) Class10 256GB記憶卡 (公司貨)', 1299, 20),
(2, 'Toshiba【N300 NAS碟】8TB 3.5吋NAS硬碟(HDWN180AZSTA)', 6499, 20),
(3, '卡巴斯基 安全軟體2019 (3台裝置/2年授權)', 1990, 20),
(4, 'HyperX Predator RGB DDR4 3200 8GBx2 桌上型超頻記憶體(HX432C16PB3AK2/16)', 2999, 20),
(5, 'TOTOLINK 10000mAh超薄快充行動電源', 399, 12);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
