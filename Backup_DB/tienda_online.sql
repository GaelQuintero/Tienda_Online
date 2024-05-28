-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 04:31:55
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
(1, 'tober223@outlook.com', 'Gael Quintero', 'prueba uno', '2024-05-24');

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
(1, 'robertogael664@gmail.com', '226cd2c2613d349e7cf3f2ed34ad4e0b44a755be7629b5b9eed71408f342d0b5561fbc253569fd2eb6f9d9697aaf3884e70e', '2024-05-27 23:58:26'),
(2, 'robertogael664@gmail.com', '5ed2b60a311f1a3a8fb03ad07e5d6d5ca329bfd5f0987d0c8e44eb083e02d14e3c577805b029c4d874db5af0d3af9135bc4a', '2024-05-28 00:06:34'),
(3, 'robertogael664@gmail.com', '688cda4905f98036fe2ffdfdf074ba9d71eae80bbb8357bce884a27c89130da73382f9a27b2ea7a1b472bea472f19efa5be4', '2024-05-28 00:13:24'),
(4, 'mireleslitzzy.06@gmail.com', 'd2d897c934e0d07a2e5fe53f5300d8bf42d2247dc1155db140edeb270ae2b3fc26d13261969ae75bdd460ddfe59afab3478d', '2024-05-28 00:14:16'),
(5, 'robertogael664@gmail.com', '5dce3234eab3629eafc8da74e35a7e146788c3f92cb1cf26d2eb3991e4da82e86320a681e5b6f9b919b23c6d7bebd195bbf4', '2024-05-28 00:17:24'),
(6, 'robertogael664@gmail.com', '04b3f1b0bca3f4ac0e5627841cce2f24eeb854ebf88a8952855a7acc2e0cd62a835f2f8b0ee71e9d7455f75a4644a0707253', '2024-05-28 00:18:20'),
(7, 'robertogael664@gmail.com', '4e793636f3684948403d08ce4c724de9e449c6282c4cc64d8cf6bbf444965bd7777b09f0c198d96603bea9a06a73fea14e9e', '2024-05-28 00:32:02'),
(8, 'robertogael664@gmail.com', '2e7bb8ea7c66380a575383c21ed76cd3bafdd51673e0edf724ae116b1021c980672016332afb270ecbcfcebf2cd6c472ac97', '2024-05-28 00:33:50'),
(9, 'tober223@outlook.com', 'ce10b03a7d382e299ac473cab3b88fe2add10cdb92fb1f4ccef864a4a0f3e88d2da41da6147a66675e45907df4b05d728f23', '2024-05-28 00:34:29'),
(10, 'robertogael664@gmail.com', '949adc5ff72cad135ceb4e8b07288ffced3ecb2da68a1e46969a62d52566c103296b952cb7599011eb44551c0e9ac08770a9', '2024-05-28 01:59:41');

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
(1, 'tober223@outlook.com', 'Roberto Gael', 'Quintero Garcia', '2147483647', '$2y$10$JO2UDN1nRt3/8ngEtxINjeHJpIVLJb1QN', '2024-05-24'),
(2, 'robertogael664@gmail.com', 'Roberto Gael', 'Quintero Garcia', '2147483647', '$2y$10$BmLtAbipaE3mgJ5QNhCoKuhc1.z5sfTkf', '2024-05-24'),
(3, 'jeenifeerjimeeneez@gmail.com', 'Gael Quintero', 'Quintero Garcia', '8442274404', '123', '2024-05-24'),
(4, 'robertogael664@gmail.com', 'Roberto Gael', 'Quintero Garcia', '8442274404', '123', '2024-05-27');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `idmailBox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `userstechstore`
--
ALTER TABLE `userstechstore`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
