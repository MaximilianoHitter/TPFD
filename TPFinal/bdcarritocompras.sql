-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2018 a las 23:12:45
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

--SE PUDO CREAR
-- Estructura de tabla para la tabla `compra`
--
/*ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);
*/

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `cofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idusuario` bigint(20) NOT NULL,
  PRIMARY KEY (`idcompra`),
  CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES usuario (`idusuario`) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `compraestado`
--
/*ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);*/

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcompraestado`),
  CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES compra (`idcompra`) ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES compraestadotipo (`idcompraestadotipo`) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `compraestadotipo`
--
/*ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);*/

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL AUTO_INCREMENT,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL,
  PRIMARY KEY (`idcompraestadotipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `compraitem`
--
/*ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);*/

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL,
  PRIMARY KEY (`idcompraitem`),
  CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES compra (`idcompra`) ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES producto (`idproducto`) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `menu`
--
/*ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);
  ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu'
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu'
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem'
  `medeshabilitado` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez',
  PRIMARY KEY (`idmenu`),
  CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES menu (`idmenu`) ON UPDATE CASCADE ON DELETE NO ACTION
  */

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL,
  `medescripcion` varchar(124) NOT NULL,
  `idpadre` bigint(20) DEFAULT NULL,
  `medeshabilitado` timestamp DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE menu
  CHANGE `medeshabilitado` `medeshabilitado` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(7, 'nuevo', 'kkkkk', NULL, NULL),
(8, 'nuevo', 'kkkkk', NULL, NULL),
(9, 'nuevo', 'kkkkk', 7, NULL),
(10, 'nuevo', 'kkkkk', NULL, NULL),
(11, 'nuevo', 'kkkkk', NULL, NULL);

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `menurol`
--
/*ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);*/

CREATE TABLE `menurol` (
  `idmr` bigint(20) NOT NULL AUTO_INCREMENT,
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idmr`),
  CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES menu (`idmenu`) ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES rol (`idrol`) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `producto`
--
/*ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);*/

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, 
  `pronombre` varchar(50) NOT NULL,
  `prodetalle` varchar(512) NOT NULL, /* cambiar nombre de campo a 'sinopsis' */
  `procantstock` int(11) NOT NULL,
  /* agregar campos 'autor', 'precio', 'isbn', 'categoria' */
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `producto`
  ADD `autor` varchar(100) NOT NULL,
  ADD `precio` int(10) NOT NULL,
  ADD `isbn` int(15) NOT NULL,
  ADD `categoria` varchar(30) NOT NULL,
  CHANGE `prodetalle` `sinopsis` varchar(512) NOT NULL,
  ADD `prdeshabilitado` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `producto`
  CHANGE `pronombre` `pronombre` varchar(50) NOT NULL;

ALTER TABLE producto ADD COLUMN foto LONGBLOB AFTER categoria;
-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `rol`
--
/*ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);*/

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `rodescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `usuario`
--
/*ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);*/

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usnombre` varchar(50) NOT NULL UNIQUE,
  `uspass` varchar(255) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE usuario
  CHANGE 'usnombre' 'usenombre' varchar(50) NOT NULL UNIQUE;

/* ALTER TABLE `usuario`
  MODIFY `uspass` varchar(255) NOT NULL; */

-- --------------------------------------------------------

--SE PUDO CREAR
-- Estructura de tabla para la tabla `usuariorol`
--
/*ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);*/

CREATE TABLE `usuariorol` (
  `idur` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idur`),
  CONSTRAINT `fkusuariorol_1` FOREIGN KEY (`idusuario`) REFERENCES usuario (`idusuario`) ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT `fkusuariorol_2` FOREIGN KEY (`idrol`) REFERENCES rol (`idrol`) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
/* ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);
 */
--
-- Indices de la tabla `compraestado`
--
/* ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`); */

--
-- Indices de la tabla `compraestadotipo`
--
/* ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`); */

--
-- Indices de la tabla `compraitem`
--
/* ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`); */

--
-- Indices de la tabla `menu`
--
/* ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`); */

--
-- Indices de la tabla `menurol`
--
/* ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`); */

--
-- Indices de la tabla `producto`
--
/* ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`); */

--
-- Indices de la tabla `rol`
--
/* ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`); */

--
-- Indices de la tabla `usuario`
--
/* ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`); */

--
-- Indices de la tabla `usuariorol`
--
/* ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`); */

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
/* ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT; */

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
/* ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT; */

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
/* ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT; */

--
-- AUTO_INCREMENT de la tabla `menu`
--
/* ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12; */

--
-- AUTO_INCREMENT de la tabla `producto`
--
/* ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT; */

--
-- AUTO_INCREMENT de la tabla `rol`
--
/* ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT; */

--
-- AUTO_INCREMENT de la tabla `usuario`
--
/* ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT; */

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
/* ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE; */

--
-- Filtros para la tabla `compraestado`
--
/* ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE; */

--
-- Filtros para la tabla `compraitem`
--
/* ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE; */

--
-- Filtros para la tabla `menu`
--
/* ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE; */

--
-- Filtros para la tabla `menurol`
--
/* ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE; */

--
-- Filtros para la tabla `usuariorol`
--
/* ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT; */

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
