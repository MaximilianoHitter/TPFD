-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-02-2023 a las 22:23:10
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `idcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `cofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idusuario` bigint(20) NOT NULL,
  PRIMARY KEY (`idcompra`),
  KEY `fkcompra_1` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(1, '2023-02-18 16:01:10', 2),
(8, '2023-02-18 17:08:57', 2),
(11, '2023-02-19 17:09:37', 2),
(12, '2023-02-19 23:03:39', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

DROP TABLE IF EXISTS `compraestado`;
CREATE TABLE IF NOT EXISTS `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcompraestado`),
  KEY `fkcompraestado_1` (`idcompra`),
  KEY `fkcompraestado_2` (`idcompraestadotipo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(1, 1, 3, '2023-02-18 16:01:10', '2023-02-20 00:17:36'),
(8, 8, 2, '2023-02-18 17:08:57', '2023-02-19 16:59:48'),
(11, 11, 1, '2023-02-19 17:09:37', NULL),
(12, 12, 4, '2023-02-19 23:03:39', '2023-02-20 00:28:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

DROP TABLE IF EXISTS `compraestadotipo`;
CREATE TABLE IF NOT EXISTS `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL AUTO_INCREMENT,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL,
  PRIMARY KEY (`idcompraestadotipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

DROP TABLE IF EXISTS `compraitem`;
CREATE TABLE IF NOT EXISTS `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL,
  PRIMARY KEY (`idcompraitem`),
  KEY `fkcompraitem_1` (`idcompra`),
  KEY `fkcompraitem_2` (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraitem`
--

INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(9, 2, 8, 5),
(12, 1, 8, 1),
(13, 2, 11, 3),
(14, 1, 11, 2),
(15, 1, 12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` bigint(20) NOT NULL AUTO_INCREMENT,
  `menombre` varchar(50) NOT NULL,
  `medescripcion` varchar(124) NOT NULL,
  `idpadre` bigint(20) DEFAULT NULL,
  `medeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmenu`),
  UNIQUE KEY `idmenu` (`idmenu`),
  KEY `fkmenu_1` (`idpadre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'ABMusuario', 'Views/usuario/usuario_list.php', 0, NULL),
(2, 'ABMrol', 'Views/rol/rol_list.php', 0, NULL),
(3, 'ABMcompraitem', 'Views/compraitem/compraitem_list.php', 0, NULL),
(4, 'ABMproducto', 'Views/producto/producto_list.php', 0, NULL),
(5, 'ABMmenu', 'Views/menu/menu_list.php', 0, NULL),
(6, 'ABMcompraestado', 'Views/compraestado/compraestado_list.php', 0, NULL),
(7, 'ABMpepe', 'Views/pepe/pepe_list.php', 0, '2023-02-18 15:56:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

DROP TABLE IF EXISTS `menurol`;
CREATE TABLE IF NOT EXISTS `menurol` (
  `idmr` bigint(20) NOT NULL AUTO_INCREMENT,
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idmr`),
  KEY `fkmenurol_1` (`idmenu`),
  KEY `fkmenurol_2` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menurol`
--

INSERT INTO `menurol` (`idmr`, `idmenu`, `idrol`) VALUES
(2, 2, 1),
(5, 5, 1),
(7, 7, 1),
(8, 1, 1),
(9, 1, 3),
(10, 3, 1),
(11, 3, 3),
(12, 6, 1),
(13, 6, 3),
(14, 4, 1),
(15, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `pronombre` varchar(50) NOT NULL,
  `sinopsis` varchar(512) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `precio` int(10) NOT NULL,
  `isbn` int(15) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `prdeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `sinopsis`, `procantstock`, `autor`, `precio`, `isbn`, `categoria`, `foto`, `prdeshabilitado`) VALUES
(1, 'El señor de los anillos las dos torres', 'mucha pelea', 15, 'jrrtolkien', 150, 123456789, 'Fantasia', '', NULL),
(2, 'El señor de los anillos la comunidad del anillo', 'poca pelea', 19, 'jrrtolkien', 120, 78945613, 'Fantasia', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `rodescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'Admin'),
(2, 'Deposito'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(255) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usnombre` (`usnombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'maxi', '123', 'maximliano.hitter@est.fi.uncoma.edu.ar', NULL),
(2, 'pipo', 'asd', 'maximliano.hitter@est.fi.uncoma.edu.ar', NULL),
(3, 'juan', 'asd', 'maximliano.hitter@est.fi.uncoma.edu.ar', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

DROP TABLE IF EXISTS `usuariorol`;
CREATE TABLE IF NOT EXISTS `usuariorol` (
  `idur` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idur`),
  KEY `fkusuariorol_1` (`idusuario`),
  KEY `fkusuariorol_2` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idur`, `idusuario`, `idrol`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkusuariorol_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fkusuariorol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
