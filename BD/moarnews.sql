-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2019 a las 19:24:52
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moarnews`
--
CREATE DATABASE IF NOT EXISTS `moarnews` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `moarnews`;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `administradores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `administradores` (
`idCuenta` int(11)
,`nombre` varchar(45)
,`usuario` varchar(45)
,`clave` varchar(255)
,`email` varchar(150)
,`formato` varchar(15)
,`tipo` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anunciantes`
--

CREATE TABLE `anunciantes` (
  `idAnunciante` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tarifa` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `idAnuncio` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(45) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idArticulo` int(15) NOT NULL,
  `idPortada` int(15) NOT NULL,
  `idAnunciante` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idArticulo` int(11) NOT NULL,
  `fecha` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `audio` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idCuenta` int(150) NOT NULL,
  `idSeccion` int(150) NOT NULL,
  `idAnuncio` int(150) NOT NULL,
  `idPortada` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `autores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `autores` (
`idCuenta` int(11)
,`nombre` varchar(45)
,`usuario` varchar(45)
,`clave` varchar(255)
,`email` varchar(150)
,`formato` varchar(15)
,`tipo` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(155) NOT NULL,
  `texto` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `puntuacion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idCuenta` int(155) NOT NULL,
  `idArticulo` int(155) NOT NULL,
  `idRespuesta` int(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `idCuenta` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`idCuenta`, `nombre`, `usuario`, `clave`, `email`, `formato`, `tipo`) VALUES
(1, 'Pedro', 'priscal', 'priscal', 'pedrorisquez@hotmail.com', 'Oro', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portadas`
--

CREATE TABLE `portadas` (
  `idPortada` int(11) NOT NULL,
  `fecha` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `idAnuncio` int(11) NOT NULL,
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `idSeccion` int(11) NOT NULL,
  `categoria` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuarios` (
`idCuenta` int(11)
,`nombre` varchar(45)
,`usuario` varchar(45)
,`clave` varchar(255)
,`email` varchar(150)
,`formato` varchar(15)
,`tipo` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `administradores`
--
DROP TABLE IF EXISTS `administradores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `administradores`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo` from `cuentas` where (`cuentas`.`tipo` = 'administrador') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `autores`
--
DROP TABLE IF EXISTS `autores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `autores`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo` from `cuentas` where (`cuentas`.`tipo` = 'autor') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuarios`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo` from `cuentas` where (`cuentas`.`tipo` = 'usuario') ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anunciantes`
--
ALTER TABLE `anunciantes`
  ADD PRIMARY KEY (`idAnunciante`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`idAnuncio`),
  ADD KEY `idArticulo` (`idArticulo`),
  ADD KEY `idPortada` (`idPortada`),
  ADD KEY `idAnunciante` (`idAnunciante`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idArticulo`),
  ADD KEY `idCuenta` (`idCuenta`),
  ADD KEY `idSeccion` (`idSeccion`),
  ADD KEY `idAnuncio` (`idAnuncio`),
  ADD KEY `idPortada` (`idPortada`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idCuenta` (`idCuenta`),
  ADD KEY `idArticulo` (`idArticulo`),
  ADD KEY `idRespuesta` (`idRespuesta`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idCuenta`);

--
-- Indices de la tabla `portadas`
--
ALTER TABLE `portadas`
  ADD PRIMARY KEY (`idPortada`),
  ADD KEY `idAnuncio` (`idAnuncio`),
  ADD KEY `idCuenta` (`idCuenta`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`idSeccion`),
  ADD KEY `idArticulo` (`idArticulo`),
  ADD KEY `idCuenta` (`idCuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anunciantes`
--
ALTER TABLE `anunciantes`
  MODIFY `idAnunciante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(155) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `portadas`
--
ALTER TABLE `portadas`
  MODIFY `idPortada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulo`),
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`idAnunciante`) REFERENCES `anunciantes` (`idAnunciante`),
  ADD CONSTRAINT `anuncios_ibfk_3` FOREIGN KEY (`idPortada`) REFERENCES `portadas` (`idPortada`);

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`idCuenta`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`idAnuncio`) REFERENCES `anuncios` (`idAnuncio`),
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`idSeccion`) REFERENCES `secciones` (`idSeccion`),
  ADD CONSTRAINT `articulos_ibfk_4` FOREIGN KEY (`idPortada`) REFERENCES `portadas` (`idPortada`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`idCuenta`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idRespuesta`) REFERENCES `comentarios` (`idComentario`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulo`);

--
-- Filtros para la tabla `portadas`
--
ALTER TABLE `portadas`
  ADD CONSTRAINT `portadas_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`idCuenta`),
  ADD CONSTRAINT `portadas_ibfk_2` FOREIGN KEY (`idAnuncio`) REFERENCES `anuncios` (`idAnuncio`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`idCuenta`),
  ADD CONSTRAINT `secciones_ibfk_2` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
