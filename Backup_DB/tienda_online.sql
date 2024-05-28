-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 10:36:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idArticulo` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `image` longblob NOT NULL,
  `category` varchar(50) NOT NULL,
  `dateRegister` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idArticulo`, `name`, `description`, `image`, `category`, `dateRegister`) VALUES
(1, 'ROG Strix G15', 'ROG Strix G15 is powered by an AMD Ryzen™ 9 6900HX CPU, an NVIDIA® GeForce RTX™ 3080 Ti', 0x524f475f53747269785f4731352e706e67, 'Laptops', '2024-05-28 07:21:19'),
(2, 'GF63 Thin', 'Equipada con el nuevo procesador 11a Gen. Intel® Core™ i7, tiene un desempeño 40% mayor que la generación anterior.', 0x6d73695f67616d696e675f636f6d70757465725f67616d65722e706e67, 'Laptops', '2024-05-28 07:25:06'),
(3, 'Laptop Gamer ASUS ROG Strix', 'Laptop Gamer ASUS ROG Strix GL702VM-GC220T 17.3\'\', Intel Core i7-7700HQ 2.80GHz', 0x706e672d7472616e73706172656e742d67616d696e672d6c6170746f702d676c3730322d617375732d696e74656c2d636f72652d69372de58d8ee7a1952d6c6170746f702d656c656374726f6e6963732d6e6574626f6f6b2d636f6d70757465722e706e67, 'Laptops', '2024-05-28 07:25:26'),
(4, 'Xtreme Pc Gaming', 'Amd Radeon Vega Renoir Ryzen 5 5600g 16gb Ssd 500gb Wifi Rgb.', 0x70632d67616d65722e706e67, 'Computadoras', '2024-05-28 07:25:40'),
(5, 'iPhone 15', 'El iPhone 15 Plus viene con la Dynamic Island, cámara gran angular de 48 MP, entrada USB-C y un resistente vidrio con infusión de color en un diseño de aluminio.', 0x6970686f6e652e6a7067, 'Celulares', '2024-05-28 07:26:30'),
(6, 'Samsung Galaxy S24', 'Descubre infinitas posibilidades para tus fotos con las 4 cámaras principales de tu equipo. Pon a prueba tu creatividad y juega con la iluminación, diferentes planos y efectos para obtener grandes resultados.', 0x7332342e6a7067, 'Celulares', '2024-05-28 07:26:48'),
(7, 'Samsung Galaxy S22', 'Prueba 1', 0x53616d73756e6747616c61787953313035472e6a7067, 'Celulares', '2024-05-28 08:35:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mailbox`
--

CREATE TABLE `mailbox` (
  `idmailBox` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `comment` text NOT NULL,
  `dateComment` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mailbox`
--

INSERT INTO `mailbox` (`idmailBox`, `email`, `name`, `comment`, `dateComment`) VALUES
(1, 'tober223@outlook.com', 'Gael Quintero', 'prueba uno', '2024-05-24'),
(2, 'robertogael664@gmail.com', 'Roberto Gael Quintero Garcia', 'holas', '2024-05-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `idToken` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`idToken`, `email`, `token`, `created_at`) VALUES
(4, 'mireleslitzzy.06@gmail.com', 'd2d897c934e0d07a2e5fe53f5300d8bf42d2247dc1155db140edeb270ae2b3fc26d13261969ae75bdd460ddfe59afab3478d', '2024-05-28 00:14:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userstechstore`
--

CREATE TABLE `userstechstore` (
  `idUser` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dateRegister` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userstechstore`
--

INSERT INTO `userstechstore` (`idUser`, `email`, `name`, `lastname`, `phone`, `password`, `dateRegister`) VALUES
(1, 'robertogael664@gmail.com', 'ROBERTO GAEL', 'QUINTERO GARCIA', '8442335678', 'sussy', '2024-05-28'),
(2, 'tober223@outlook.com', 'Roberto Gael', 'Quintero Garcia', '8442335678', 'hola', '2024-05-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idArticulo`);

--
-- Indices de la tabla `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`idmailBox`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`idToken`);

--
-- Indices de la tabla `userstechstore`
--
ALTER TABLE `userstechstore`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `idmailBox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `userstechstore`
--
ALTER TABLE `userstechstore`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
