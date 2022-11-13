-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 04:39:55
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_sales`
--

CREATE TABLE `products_sales` (
  `Transaction_ID` int(11) NOT NULL,
  `Customer` varchar(100) NOT NULL,
  `Invoice` varchar(14) NOT NULL,
  `Date` date NOT NULL,
  `Seller` int(11) NOT NULL,
  `Product` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Unit_Price` decimal(7,2) NOT NULL,
  `Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products_sales`
--

INSERT INTO `products_sales` (`Transaction_ID`, `Customer`, `Invoice`, `Date`, `Seller`, `Product`, `Quantity`, `Unit_Price`, `Amount`) VALUES
(16, 'TAKEISHI SHIGERU', 'A0000500002536', '2022-09-30', 2, 'AJINOMOTO 2 KG*5 BOLSAS', 92, '8176.64', '752250.93'),
(17, 'DYENA SRL', 'A0000500002537', '2022-09-30', 6, 'AJINOMOTO 25 KG', 40, '13586.78', '543471.12'),
(18, 'LOS CINCO HISPANOS SOCIEDAD ANONIMA', 'A0000500002538', '2022-09-30', 6, 'AJINOMOTO 25 KG', 100, '14341.60', '1434159.90'),
(19, 'H BENELLI Y CIA SRL', 'A0000500002539', '2022-09-30', 3, 'AJINOMOTO 25 KG', 20, '14341.60', '286831.98'),
(20, 'INC  SOCIEDAD ANONIMA', 'A0000500002540', '2022-09-30', 1, 'AJINOMOTO 100 GS. FRASCO', 16, '2262.88', '36206.08'),
(21, 'INC  SOCIEDAD ANONIMA', 'A0000500002540', '2022-09-30', 1, 'SAZON AMARILLO LEGUMBR 60g*48 ', 24, '1751.90', '42045.60'),
(22, 'INC  SOCIEDAD ANONIMA', 'A0000500002540', '2022-09-30', 1, 'SAZON NARANJA PASTAS 60g*48', 11, '1751.90', '19270.90'),
(23, 'INC  SOCIEDAD ANONIMA', 'A0000500002540', '2022-09-30', 1, 'SAZON ROJO CARNES 60 G * 48', 19, '1751.90', '33286.10'),
(24, 'LABORATORIO CONDISAL SA E F', 'A0000500002541', '2022-09-30', 3, 'AJINOMOTO 25 KG', 50, '14039.67', '701983.53'),
(25, 'TAPIA CRUZ MARIA ANGELICA', 'A0000500002542', '2022-09-30', 3, 'AJINOMOTO 25 KG', 100, '17392.77', '1739277.10'),
(26, 'BAUTISTA', '002000', '2022-10-12', 3, 'AJINOMOTO ', 34, '334.00', '3434.00'),
(27, 'BAUTISTA', '002000', '2022-10-13', 5, 'AJINOMOTO ', 111, '11111.00', '111111.00'),
(28, 'BAUTISTA', '002000', '2022-10-04', 3, 'AJINOMOTO ', 4, '4.00', '4.00'),
(31, 'BAUTISTA', '002000', '2022-10-13', 2, 'AJINOMOTO ', 3, '3.00', '4.00'),
(34, 'FEDERICO', '333', '2022-10-11', 1, 'AJINOMOTO ', 3, '2.00', '1.00'),
(35, '', '', '0000-00-00', 7, '', 0, '0.00', '0.00'),
(36, '', '', '0000-00-00', 7, '', 0, '0.00', '0.00'),
(37, 'BAUTISTA', '002000', '2022-09-28', 8, 'AJINOMOTO ', 2, '3.00', '6.00'),
(42, 'BAUTISTA', '002000', '2022-10-11', 4, 'AJINOMOTO ', 1, '1.00', '1.00'),
(43, 'BAUTISTA', 'w', '2022-10-11', 3, 'AJINOMOTO ', 1, '1.00', '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sellers`
--

CREATE TABLE `sellers` (
  `Seller_ID` int(11) NOT NULL,
  `Seller` varchar(100) NOT NULL,
  `Sales_Area` varchar(100) NOT NULL,
  `Sales_Commission` decimal(4,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sellers`
--

INSERT INTO `sellers` (`Seller_ID`, `Seller`, `Sales_Area`, `Sales_Commission`) VALUES
(1, 'Franco Derisos', 'CABA', '0.024'),
(2, 'Martin Lopezw', 'Buenos Aires', '0.021'),
(3, 'Amalia Gomez', 'Santa Fe', '0.200'),
(4, 'Federico Rodriguez', 'Cordoba', '0.025'),
(5, 'German Robela', 'Rio Negro', '0.120'),
(6, 'Esteban Fuentes', 'La pampa', '0.150'),
(7, 'Marcos Abdala', 'Mendoza', '0.200'),
(8, 'Sebastian Tal', 'La Pampa', '0.110');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'fede@hotmail.com', '$2y$10$KfWnCCX/1v/V.aEWvfKETu54FgGmTxWmvqkHUgwnc3zt6/a90r24W'),
(2, 'fede@hotmail.com', '$2y$10$2roZOOnJWINaJGuv47O15ug.zoBSi6jOx7TDVl0ZVSSjkWP9Y1PvS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products_sales`
--
ALTER TABLE `products_sales`
  ADD PRIMARY KEY (`Transaction_ID`),
  ADD KEY `Vendedores_fk` (`Seller`);

--
-- Indices de la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`Seller_ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products_sales`
--
ALTER TABLE `products_sales`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `sellers`
--
ALTER TABLE `sellers`
  MODIFY `Seller_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products_sales`
--
ALTER TABLE `products_sales`
  ADD CONSTRAINT `Vendedores_fk` FOREIGN KEY (`Seller`) REFERENCES `sellers` (`Seller_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
