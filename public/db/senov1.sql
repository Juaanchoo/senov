-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-12-2018 a las 22:41:44
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `senov1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE IF NOT EXISTS `auditoria` (
  `id_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `fk_documento` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `accion` varchar(50) NOT NULL,
  `id_afectado` int(11) NOT NULL,
  `comentarios` mediumtext NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_auditoria`),
  KEY `fk_documento` (`fk_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

DROP TABLE IF EXISTS `competencias`;
CREATE TABLE IF NOT EXISTS `competencias` (
  `id_competencia` int(11) NOT NULL AUTO_INCREMENT,
  `competencia` mediumtext NOT NULL,
  `fk_id_programa` int(11) NOT NULL,
  `trimestre_diurno` varchar(5) NOT NULL,
  `trimestre_especial` varchar(5) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_competencia`),
  KEY `fk_id_programa` (`fk_id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id_competencia`, `competencia`, `fk_id_programa`, `trimestre_diurno`, `trimestre_especial`, `estado`) VALUES
(1, 'PRODUCE TEXTOS EN INGLES', 1, '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_novedad`
--

DROP TABLE IF EXISTS `estado_novedad`;
CREATE TABLE IF NOT EXISTS `estado_novedad` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado_novedad` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_novedad`
--

INSERT INTO `estado_novedad` (`id_estado`, `estado_novedad`, `estado`) VALUES
(1, 'EN TRAMITE', 1),
(2, 'APROBADO', 1),
(3, 'NO APROBADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `id_ficha` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_sede` int(5) NOT NULL,
  `fk_id_jornada` int(11) NOT NULL,
  `fk_id_modalidad` int(11) NOT NULL,
  `fk_id_programa_formacion` int(11) NOT NULL,
  `trimestre_formacion` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_ficha`),
  KEY `fk_id_sede` (`fk_id_sede`,`fk_id_jornada`,`fk_id_modalidad`,`fk_id_programa_formacion`),
  KEY `fk_id_modalidad` (`fk_id_modalidad`),
  KEY `fk_id_programa_formacion` (`fk_id_programa_formacion`),
  KEY `fk_id_jornada` (`fk_id_jornada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id_ficha`, `fk_id_sede`, `fk_id_jornada`, `fk_id_modalidad`, `fk_id_programa_formacion`, `trimestre_formacion`, `estado`) VALUES
('10098', 1, 3, 1, 4, 2, '1'),
('1438303', 1, 1, 1, 1, 5, '1'),
('1538956', 2, 1, 1, 1, 4, '1'),
('1620145', 3, 2, 1, 2, 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilitado`
--

DROP TABLE IF EXISTS `habilitado`;
CREATE TABLE IF NOT EXISTS `habilitado` (
  `fk_id_tipo_documento` int(11) NOT NULL,
  `documento` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`documento`),
  KEY `fk_id_tipo_documento` (`fk_id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habilitado`
--

INSERT INTO `habilitado` (`fk_id_tipo_documento`, `documento`, `estado`) VALUES
(1, '1000', '1'),
(1, '1020', '1'),
(1, '123', '1'),
(1, '1233', '1'),
(1, '1999', '1'),
(1, '321', '1'),
(3, '66666666', '1'),
(1, '666666666', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE IF NOT EXISTS `jornada` (
  `id_jornada` int(11) NOT NULL AUTO_INCREMENT,
  `jornada` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_jornada`),
  UNIQUE KEY `jornada` (`jornada`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id_jornada`, `jornada`, `estado`) VALUES
(1, 'DIURNA', '1'),
(2, 'NOCTURNA', '1'),
(3, 'FINES DE SEMANA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

DROP TABLE IF EXISTS `modalidad`;
CREATE TABLE IF NOT EXISTS `modalidad` (
  `id_modalidad` int(11) NOT NULL AUTO_INCREMENT,
  `modalidad` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_modalidad`),
  UNIQUE KEY `modalidad` (`modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id_modalidad`, `modalidad`, `estado`) VALUES
(1, 'PRESENCIAL', '1'),
(2, 'VIRTUAL', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

DROP TABLE IF EXISTS `novedades`;
CREATE TABLE IF NOT EXISTS `novedades` (
  `fk_id_tipo_documento` int(11) NOT NULL,
  `id_novedad` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_tipo_novedad` int(11) NOT NULL,
  `motivo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `comentarios` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `recomendaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `evidencias` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `nueva_jornada` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `nueva_ficha` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `fk_id_estado` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_novedad`),
  KEY `fk_id_tipo_documento` (`fk_id_tipo_documento`),
  KEY `fk_id_ficha` (`fk_id_tipo_novedad`,`fk_id_estado`),
  KEY `fk_id_estado` (`fk_id_estado`),
  KEY `fk_id_tipo_novedad` (`fk_id_tipo_novedad`),
  KEY `documento` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`fk_id_tipo_documento`, `id_novedad`, `documento`, `fk_id_tipo_novedad`, `motivo`, `comentarios`, `recomendaciones`, `evidencias`, `nueva_jornada`, `nueva_ficha`, `observaciones`, `fecha_inicio`, `fecha_final`, `fk_id_estado`, `estado`) VALUES
(1, 1, '1000', 1, 'SE VA A HACER UNA CIRUGíA', 'SE ACEPTA EL MOTIVO', 'POR FAVOR ACEPTAR NOVEDAD', 'PRUEBAS MEDICAS', NULL, NULL, NULL, '2018-12-13', NULL, 1, '1'),
(1, 2, '666666666', 1, 'FALLECIMIENTO', '...', '...', '...', NULL, NULL, NULL, '2018-12-14', NULL, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_cargo`
--

DROP TABLE IF EXISTS `permiso_cargo`;
CREATE TABLE IF NOT EXISTS `permiso_cargo` (
  `id_permiso` int(5) NOT NULL AUTO_INCREMENT,
  `fk_id_cargo` int(5) NOT NULL,
  `fk_documento` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `fk_documento` (`fk_id_cargo`),
  KEY `fk_documento_2` (`fk_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso_cargo`
--

INSERT INTO `permiso_cargo` (`id_permiso`, `fk_id_cargo`, `fk_documento`) VALUES
(2, 3, '123'),
(3, 1, '123'),
(4, 3, '321'),
(5, 5, '1000'),
(8, 3, '1999'),
(14, 3, '1233'),
(15, 2, '123'),
(16, 4, '123'),
(17, 3, '66666666'),
(18, 1, '66666666'),
(19, 5, '666666666');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_formacion`
--

DROP TABLE IF EXISTS `programa_formacion`;
CREATE TABLE IF NOT EXISTS `programa_formacion` (
  `id_programa_formacion` int(11) NOT NULL AUTO_INCREMENT,
  `programa_formacion` varchar(100) NOT NULL,
  `fk_id_tipo_formacion` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_programa_formacion`),
  UNIQUE KEY `programa_formacion` (`programa_formacion`),
  KEY `fk_id_tipo_formacion` (`fk_id_tipo_formacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa_formacion`
--

INSERT INTO `programa_formacion` (`id_programa_formacion`, `programa_formacion`, `fk_id_tipo_formacion`, `estado`) VALUES
(1, 'ANáLISIS Y DESARROLLO DE SISTEMAS DE INFORMACIóN', 1, '1'),
(2, 'PROGRAMACIóN DE SOFTWARE', 2, '1'),
(3, 'DISEñO E INTEGRACIóN DE MULTIMEDIA', 3, '1'),
(4, 'REDES', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE IF NOT EXISTS `sede` (
  `id_sede` int(5) NOT NULL AUTO_INCREMENT,
  `sede` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sede`),
  UNIQUE KEY `sede` (`sede`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `sede`, `estado`) VALUES
(1, 'COLOMBIA', '1'),
(2, 'RICAURTE', '1'),
(3, 'COMPLEJO SUR', '1'),
(4, 'ÁLAMOS', '1'),
(5, 'RESTREPO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

DROP TABLE IF EXISTS `tipo_cargo`;
CREATE TABLE IF NOT EXISTS `tipo_cargo` (
  `id_cargo` int(5) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cargo`),
  UNIQUE KEY `cargo` (`cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`id_cargo`, `cargo`, `estado`) VALUES
(1, 'ADMINISTRADOR', '1'),
(2, 'APOYO ADMINISTRATIVO', '1'),
(3, 'INVITADO', '1'),
(4, 'INSTRUCTOR', '1'),
(5, 'APRENDIZ', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_documento`),
  UNIQUE KEY `tipo_documento` (`tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `tipo_documento`, `estado`) VALUES
(1, 'CÉDULA DE CIUDADANÍA', '1'),
(2, 'TARJETA DE IDENTIDAD', '1'),
(3, 'CÉDULA DE EXTRANJERÍA', '1'),
(4, 'PASAPORTE', '1'),
(5, 'NÚMERO CIEGO SENA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_formacion`
--

DROP TABLE IF EXISTS `tipo_formacion`;
CREATE TABLE IF NOT EXISTS `tipo_formacion` (
  `id_tipo_formacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_formacion` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_formacion`),
  UNIQUE KEY `tipo_formacion` (`tipo_formacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_formacion`
--

INSERT INTO `tipo_formacion` (`id_tipo_formacion`, `tipo_formacion`, `estado`) VALUES
(1, 'TECNÓLOGO', '1'),
(2, 'TÉCNICO', '1'),
(3, 'ESPECIALIZACIÓN', '1'),
(4, 'COMPLEMENTARIA', '1'),
(5, 'CURSO CORTO', '1'),
(6, 'Especialización técnica', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_novedad`
--

DROP TABLE IF EXISTS `tipo_novedad`;
CREATE TABLE IF NOT EXISTS `tipo_novedad` (
  `id_novedad` int(11) NOT NULL AUTO_INCREMENT,
  `novedad` varchar(80) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_novedad`),
  UNIQUE KEY `novedad` (`novedad`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_novedad`
--

INSERT INTO `tipo_novedad` (`id_novedad`, `novedad`, `estado`) VALUES
(1, 'APLAZAMIENTO', '1'),
(2, 'CAMBIO DE JORNADA', '1'),
(3, 'DESERCIÓN', '1'),
(4, 'REINTEGRO', '1'),
(5, 'TRASLADO', '1'),
(6, 'RETIRO VOLUNTARIO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_admin`
--

DROP TABLE IF EXISTS `usuarios_admin`;
CREATE TABLE IF NOT EXISTS `usuarios_admin` (
  `fk_id_tipo_documento` int(11) NOT NULL,
  `documento` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_ficha` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`documento`),
  KEY `fk_id_tipo_documento` (`fk_id_tipo_documento`),
  KEY `documento` (`documento`),
  KEY `fk_id_ficha` (`fk_id_ficha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`fk_id_tipo_documento`, `documento`, `nombre`, `primer_apellido`, `segundo_apellido`, `email`, `telefono`, `direccion`, `fk_id_ficha`, `password`, `intentos`, `estado`) VALUES
(1, '1000', 'JUANITO', 'PEREZ', 'CILUETA', 'JUANIPE@EXAMPLE.COM', '651651', 'CRA 68', '1438303', NULL, NULL, '1'),
(1, '123', 'JUAN DAVID', 'GOMEZ', 'BENAVIDES', 'JDGOMEZ@EXAMPLE.COM', '16516', 'CLL 23F', NULL, '202cb962ac59075b964b07152d234b70', 0, '1'),
(1, '1233', 'KEVIN JULIAN', 'GALINDO', 'MENESES', 'KJGALINDO@EXAMPLE.COM', '65165165', 'CLL 55', NULL, 'e034fb6b66aacc1d48f445ddfb08da98', NULL, '1'),
(1, '1999', 'SANDRA', 'BENAVIDES', 'BECERRA', 'SANDI@EXAMPLE.COM', '5165165', 'CLL 23 F', NULL, '5ec829debe54b19a5f78d9a65b900a39', 0, '1'),
(1, '321', 'PEDRO', 'NUñEZ', 'SANTANA', 'PENUSA@EXAMPLE.COM', '2516516', 'CLL 50 SUR', NULL, 'caf1a3dfb505ffed0d024130f58c5cfa', 0, '1'),
(3, '66666666', 'INSTRUCTOR', 'INSTRUCTOR', 'N/A', 'INSTRUCTOR@EXAMPLE.COM', '65165165', 'CLL 68', NULL, '202cb962ac59075b964b07152d234b70', 0, '1'),
(1, '666666666', 'INSTRUCTOR', 'INSTRUCTOR', 'N/A', 'INSTRUCTOR@EXAMPLE.COM', '5165165', 'CLL 98', '1538956', NULL, NULL, '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`fk_documento`) REFERENCES `usuarios_admin` (`documento`);

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `competencias_ibfk_1` FOREIGN KEY (`fk_id_programa`) REFERENCES `programa_formacion` (`id_programa_formacion`);

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_ibfk_1` FOREIGN KEY (`fk_id_modalidad`) REFERENCES `modalidad` (`id_modalidad`),
  ADD CONSTRAINT `fichas_ibfk_2` FOREIGN KEY (`fk_id_programa_formacion`) REFERENCES `programa_formacion` (`id_programa_formacion`),
  ADD CONSTRAINT `fichas_ibfk_3` FOREIGN KEY (`fk_id_jornada`) REFERENCES `jornada` (`id_jornada`),
  ADD CONSTRAINT `fichas_ibfk_4` FOREIGN KEY (`fk_id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `habilitado`
--
ALTER TABLE `habilitado`
  ADD CONSTRAINT `habilitado_ibfk_1` FOREIGN KEY (`fk_id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`);

--
-- Filtros para la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD CONSTRAINT `novedades_ibfk_1` FOREIGN KEY (`fk_id_estado`) REFERENCES `estado_novedad` (`id_estado`),
  ADD CONSTRAINT `novedades_ibfk_3` FOREIGN KEY (`fk_id_tipo_novedad`) REFERENCES `tipo_novedad` (`id_novedad`),
  ADD CONSTRAINT `novedades_ibfk_5` FOREIGN KEY (`fk_id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`),
  ADD CONSTRAINT `novedades_ibfk_6` FOREIGN KEY (`documento`) REFERENCES `usuarios_admin` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_cargo`
--
ALTER TABLE `permiso_cargo`
  ADD CONSTRAINT `permiso_cargo_ibfk_1` FOREIGN KEY (`fk_id_cargo`) REFERENCES `tipo_cargo` (`id_cargo`),
  ADD CONSTRAINT `permiso_cargo_ibfk_2` FOREIGN KEY (`fk_documento`) REFERENCES `usuarios_admin` (`documento`);

--
-- Filtros para la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  ADD CONSTRAINT `programa_formacion_ibfk_1` FOREIGN KEY (`fk_id_tipo_formacion`) REFERENCES `tipo_formacion` (`id_tipo_formacion`);

--
-- Filtros para la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD CONSTRAINT `usuarios_admin_ibfk_1` FOREIGN KEY (`fk_id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`),
  ADD CONSTRAINT `usuarios_admin_ibfk_2` FOREIGN KEY (`documento`) REFERENCES `habilitado` (`documento`),
  ADD CONSTRAINT `usuarios_admin_ibfk_3` FOREIGN KEY (`fk_id_ficha`) REFERENCES `fichas` (`id_ficha`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
