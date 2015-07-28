-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2015 a las 08:25:42
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `demo_gallery`
--
DROP DATABASE IF EXISTS `demo_gallery`;
CREATE DATABASE IF NOT EXISTS `demo_gallery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `demo_gallery`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`image_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `thumbnail_path_id` int(11) NOT NULL,
  `image_path_id` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image_path`
--

CREATE TABLE IF NOT EXISTS `image_path` (
`image_path_id` int(11) NOT NULL,
  `url_path` varchar(110) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`status_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `code` varchar(4) NOT NULL,
  `description` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`status_id`, `name`, `code`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'activated', 'AC', 'Activated', 1, '2015-07-25 00:30:00', 1, '2015-07-25 00:30:00'),
(2, 'deleted', 'DEL', 'Deleted', 1, '2015-07-25 00:30:00', 1, '2015-07-25 00:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_by` int(8) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_by` int(8) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'email@email.com', 1, 's2015-07-25 00:22:00', 1, '2015-07-25 00:22:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`image_id`), ADD KEY `FK_IMAGE_STATUS_idx` (`status_id`), ADD KEY `FK_IMAGE_PATH_idx` (`image_path_id`), ADD KEY `FK_IMAGE_CREATE_idx` (`created_by`), ADD KEY `FK_IMAGE_UPDATE_idx` (`updated_by`), ADD KEY `FK_IMAGE_THUMB_idx` (`thumbnail_path_id`);

--
-- Indices de la tabla `image_path`
--
ALTER TABLE `image_path`
 ADD PRIMARY KEY (`image_path_id`), ADD KEY `FK_PATH_CREATE_idx` (`created_by`), ADD KEY `FK_PATH_UPDATE_idx` (`updated_by`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`status_id`), ADD KEY `FK_STATUS_CREATE_idx` (`created_by`), ADD KEY `FK_STATUS_UPDATE_idx` (`updated_by`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `image_path`
--
ALTER TABLE `image_path`
MODIFY `image_path_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
ADD CONSTRAINT `FK_IMAGE_CREATE` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_IMAGE_PATH` FOREIGN KEY (`image_path_id`) REFERENCES `image_path` (`image_path_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_IMAGE_STATUS` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_IMAGE_THUMB` FOREIGN KEY (`thumbnail_path_id`) REFERENCES `image_path` (`image_path_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_IMAGE_UPDATE` FOREIGN KEY (`updated_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `image_path`
--
ALTER TABLE `image_path`
ADD CONSTRAINT `FK_PATH_CREATE` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_PATH_UPDATE` FOREIGN KEY (`updated_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `status`
--
ALTER TABLE `status`
ADD CONSTRAINT `FK_STATUS_CREATE` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_STATUS_UPDATE` FOREIGN KEY (`updated_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
