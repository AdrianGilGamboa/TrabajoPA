-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2020 a las 00:26:50
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
,`Dv` tinyint(1)
,`gustos` varchar(255)
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

--
-- Volcado de datos para la tabla `anunciantes`
--

INSERT INTO `anunciantes` (`idAnunciante`, `nombre`, `tarifa`) VALUES
(4, 'Ford', 'oro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `idAnuncio` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(45) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idArticulo` int(15) DEFAULT NULL,
  `idPortada` int(15) DEFAULT NULL,
  `idAnunciante` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`idAnuncio`, `imagen`, `duracion`, `descripcion`, `idArticulo`, `idPortada`, `idAnunciante`) VALUES
(19, 'kuga.png', 10, 'Ford Kuga', 2, 8, 4),
(20, 'fiesta.png', 2, 'Ford Fiesta', 4, NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idArticulo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `audio` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idCuenta` int(150) DEFAULT NULL,
  `idAnuncio` int(150) DEFAULT NULL,
  `idPortada` int(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idArticulo`, `fecha`, `titulo`, `descripcion`, `texto`, `imagen`, `audio`, `idCuenta`, `idAnuncio`, `idPortada`) VALUES
(2, '2020-01-25', 'Lluvia', 'Lluvia en toda EspaÃ±a', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', 'lluvia.png', 'Record (online-voice-recorder.com).mp3', 18, 19, 8),
(4, '2020-01-26', 'El gobierno con simios', 'Pedro Sanchez en la presidencia', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 'politica.png', 'politica.mp3', 18, 20, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulossecciones`
--

CREATE TABLE `articulossecciones` (
  `idSeccion` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulossecciones`
--

INSERT INTO `articulossecciones` (`idSeccion`, `idArticulo`) VALUES
(31, 4),
(31, 2);

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
,`Dv` tinyint(1)
,`gustos` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(155) NOT NULL,
  `texto` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `puntuacion` int(15) NOT NULL,
  `puntuacionNegativa` int(11) NOT NULL,
  `idCuenta` int(155) DEFAULT NULL,
  `idArticulo` int(155) DEFAULT NULL,
  `idRespuesta` int(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `texto`, `puntuacion`, `puntuacionNegativa`, `idCuenta`, `idArticulo`, `idRespuesta`) VALUES
(7, 'Que frio', 4, 0, 17, 2, NULL),
(8, 'Es verdad', 0, 0, 17, 2, 7),
(9, 'Pues aqui no', 1, 0, 17, 2, NULL),
(10, 'Aqui en canarias no', 2, 0, 17, 2, NULL),
(11, 'No ni na', 0, 0, 17, 2, 10),
(12, 'claor', 5, 0, 17, 2, NULL),
(13, 'respuesta1', 0, 0, 17, 2, 7),
(14, 'bonitos monos', 6, 5, 21, 4, NULL);

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
  `tipo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Dv` tinyint(1) NOT NULL,
  `gustos` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`idCuenta`, `nombre`, `usuario`, `clave`, `email`, `formato`, `tipo`, `Dv`, `gustos`) VALUES
(15, 'adminAdmin1', 'admin', '$2y$10$xAyhCGrp1jNH/PM/JD0azuc5aAXtIhkg62tCHblQ4.FkFhIHv/bPO', 'admin', 'oro', 'administrador', 0, ''),
(17, 'usuarioUsuario1', 'usuario', '$2y$10$mwmRNmjGRdi580kTgRSRYOTZZ4l1jPcxtq8hIaOMSgnOX3cGRlCbm', 'usuario', 'bronze', 'usuario', 0, ''),
(18, 'autorAutor1', 'autor', '$2y$10$/40CLPxmRPxJt8dOA0wF9eyZbAg7os5K7yDPeG4TH/IUUVtTY9wGi', 'autor', 'normal', 'autor', 0, ''),
(21, 'prueba', 'prueba', '$2y$10$zlUq7Y8GJLQaf9KSQRtOWuDt0MFdGrx6ZOZnaMxBBcoqFdnkjvVJm', 'prueba@gmail.com', 'silver', 'usuario', 0, 'Spain,Economy,Sports,Culture'),
(22, 'Pedro', 'priscal', '$2y$10$EIuCiZyZpOW6T/l53Ww4luqPTmIgIgTi80WFEFMOYwxhAmOncl9SS', 'pedrorc983@gmail.com', 'gold', 'usuario', 0, 'Spain,Economy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portadas`
--

CREATE TABLE `portadas` (
  `idPortada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idAnuncio` int(11) DEFAULT NULL,
  `idCuenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `portadas`
--

INSERT INTO `portadas` (`idPortada`, `fecha`, `idAnuncio`, `idCuenta`) VALUES
(8, '2020-01-29', 19, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `idSeccion` int(11) NOT NULL,
  `categoria` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idCuenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`idSeccion`, `categoria`, `idCuenta`) VALUES
(31, 'Spain', 15),
(32, 'Economy', 15),
(33, 'Sports', 15),
(34, 'Culture', 15),
(35, 'Technology', 15),
(36, 'Music', 15),
(37, 'International', 15);

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
,`Dv` tinyint(1)
,`gustos` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `administradores`
--
DROP TABLE IF EXISTS `administradores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `administradores`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo`,`cuentas`.`Dv` AS `Dv`,`cuentas`.`gustos` AS `gustos` from `cuentas` where (`cuentas`.`tipo` = 'administrador') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `autores`
--
DROP TABLE IF EXISTS `autores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `autores`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo`,`cuentas`.`Dv` AS `Dv`,`cuentas`.`gustos` AS `gustos` from `cuentas` where (`cuentas`.`tipo` = 'autor') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuarios`  AS  select `cuentas`.`idCuenta` AS `idCuenta`,`cuentas`.`nombre` AS `nombre`,`cuentas`.`usuario` AS `usuario`,`cuentas`.`clave` AS `clave`,`cuentas`.`email` AS `email`,`cuentas`.`formato` AS `formato`,`cuentas`.`tipo` AS `tipo`,`cuentas`.`Dv` AS `Dv`,`cuentas`.`gustos` AS `gustos` from `cuentas` where (`cuentas`.`tipo` = 'usuario') ;

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
  ADD KEY `idAnuncio` (`idAnuncio`),
  ADD KEY `idPortada` (`idPortada`);

--
-- Indices de la tabla `articulossecciones`
--
ALTER TABLE `articulossecciones`
  ADD KEY `idSeccion` (`idSeccion`),
  ADD KEY `idArticulo` (`idArticulo`);

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
  ADD KEY `idCuenta` (`idCuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anunciantes`
--
ALTER TABLE `anunciantes`
  MODIFY `idAnunciante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(155) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `portadas`
--
ALTER TABLE `portadas`
  MODIFY `idPortada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  ADD CONSTRAINT `articulos_ibfk_4` FOREIGN KEY (`idPortada`) REFERENCES `portadas` (`idPortada`);

--
-- Filtros para la tabla `articulossecciones`
--
ALTER TABLE `articulossecciones`
  ADD CONSTRAINT `articulossecciones_ibfk_1` FOREIGN KEY (`idSeccion`) REFERENCES `secciones` (`idSeccion`),
  ADD CONSTRAINT `articulossecciones_ibfk_2` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulo`);

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
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`idCuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
