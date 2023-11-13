-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2023 a las 02:30:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tecnotandil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(21, 'Audio y video'),
(22, 'Aire y Climatizacion'),
(23, 'Heladeras'),
(24, 'Lavarropas'),
(46, 'Holi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `imagen` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `precio`, `modelo`, `id_categoria`, `imagen`) VALUES
(19, 'Bgh Aires Climat', 199000, 'Bh6 Ultimat Prime', 22, ''),
(20, 'Heladera gafa', 330000, 'vG5 gafa', 23, ''),
(21, 'Lavarropas automatico Whirlpool', 500000, 'WWB11B Whirlpool', 24, ''),
(22, 'Sony Music Disq', 189000, 'Disque Prime-Hto', 21, ''),
(27, 'juega la seleccion', 111111, '2222', 23, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `user`, `email`, `password`, `rol`) VALUES
(3, 'fran', 'frankrauel99@gmail.com', '$2y$10$TKlEfg2QwU3HCu.2.vxx3.N18ii6LcJalGgGauQHn0LEGG9cjmJre', 'admin'),
(24, '', 'web2@gmai.com', '$2y$10$0q5QD0qhtanf/b9UtAK4keF0w1aKPd4dieKoAN.deGkahVkP7T9LK', 'admin'),
(109, '', 'marce@gmail.com', '$2y$10$.mzuNeNt6HZixyST8MIlou8VyHVTeOia9lAnTt5wL5EZD3G/dSosG', 'usuario'),
(110, '', 'martinazuzulich@gmail.com', '$2y$10$67bWJgjX7utRqheneGMBc.cjgte6GAoYvEGMPl9m7Tr.JXTOQAuza', 'admin'),
(111, '', 'aaaa@gmail.com', '$2y$10$NYDRKoH/reQAdHXMGeD9.uSpNfkm/2dm6ieo.L23N2zGcqSTW5Ivu', 'usuario'),
(112, '', '1qwqsa@gmail.com', '$2y$10$tXFiSc76bHgbRae3AkhSxuA/wfiEP/Emnw65RxUyFukVP07b0HuGa', 'usuario'),
(113, '', 'ASDADA@Gmail.com', '$2y$10$4BQexwvJANTb.BsrbpYSnecRBWqQcmE8heUlPCOFMw77i3f/.ZYQa', 'usuario'),
(115, '', '123123@gmail.com', '$2y$10$ox5VRwC.3.0H2OAjWxiEZu5AwtdEUY1yMHQpsqv1jZ1VnbkCXPSx.', 'usuario'),
(116, '', 'pruebaaa@gmail.com', '$2y$10$yWWBAk50tyuXbtDGtv60W.Xjsv8MHqNFdyumENf0Kf6TX0iupzy/C', ''),
(117, '', 'hernan@gmail.com', '$2y$10$QRd.tizt3dRvyWJKwP2QauttDA0.PBqQ5dnADIq/Tc4EO7glyUaee', ''),
(118, '', 'tecnoT@gmail.com', '$2y$10$ZbD3uvbhViE83zhMfXawJe4/WzTsDKzt4C4VVubMaRztko3saD0lG', ''),
(119, '', 'juan@gmail.com', '$2y$10$I.Mk2pQwXhnv4FMymT3KJevceruhpPQQLZ6h1fKtKz26Kw0hKR5wu', ''),
(120, '', 'chicho@gmail.com', '$2y$10$ozh.2.//6F5C8I9d9Q1/buuButXbocMcuI6QKalGzvgKffpqRjT1a', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
