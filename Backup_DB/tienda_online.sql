-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2024 a las 04:45:33
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
(3, 'jeenifeerjimeeneez@gmail.com', 'Gael Quintero', 'Quintero Garcia', '8442274404', '123', '2024-05-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`idmailBox`);

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
-- AUTO_INCREMENT de la tabla `userstechstore`
--
ALTER TABLE `userstechstore`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
