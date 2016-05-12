-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2015 a las 05:09:10
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `vyf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

/*CREATE TABLE IF NOT EXISTS `estados` (
  `estadosID` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `estados` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`estadosID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`estadosID`, `estados`) VALUES
(01, 'Amazonas'),
(02, 'Anzoátegui'),
(03, 'Apure'),
(04, 'Aragua'),
(05, 'Barinas'),
(06, 'Bolívar'),
(07, 'Carabobo'),
(08, 'Cojedes'),
(09, 'Delta Amac'),
(10, 'Falcón'),
(11, 'Guárico'),
(12, 'Lara'),
(13, 'Mérida'),
(14, 'Miranda'),
(15, 'Monagas'),
(16, 'Nueva Espa'),
(17, 'Portuguesa'),
(18, 'Sucre'),
(19, 'Táchira'),
(20, 'Trujillo'),
(21, 'Vargas'),
(22, 'Yaracuy'),
(23, 'Zulia'),
(24, 'Distrito f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `municipiosID` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `estadosID` int(2) DEFAULT NULL,
  `municipios` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estados` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`municipiosID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`municipiosID`, `estadosID`, `municipios`, `estados`) VALUES
(01, 1, 'Alto Orinoco  (La Esmeralda)', 'Amazonas'),
(02, 1, 'Atabapo (San Fernando de Atabapo)', 'Amazonas'),
(03, 1, 'Atures (Puerto Ayacucho)', 'Amazonas'),
(04, 1, 'Autana (Isla Ratón)', 'Amazonas'),
(05, 1, 'Manapiare (San Juan de Manapiare)', 'Amazonas'),
(06, 1, 'Maroa (Maroa)', 'Amazonas'),
(07, 1, 'Río Negro (San Carlos de Río negro)', 'Amazonas'),
(08, 2, 'Anaco (Anaco)', 'Anzoátegui'),
(09, 2, 'Aragua (Aragua de Barcelona)', 'Anzoátegui'),
(10, 2, 'Bruzal (Clarines)', 'Anzoátegui'),
(11, 2, 'Diego Bautista Urbaneja (Lechería)', 'Anzoátegui'),
(12, 2, 'Peñalver (Puerto Píritu)', 'Anzoátegui'),
(13, 2, 'Francisco del Carmen Carvajal (Valle de Guanape)', 'Anzoátegui'),
(14, 2, 'General Sir Arthur McGregor (El Chaparro)', 'Anzoátegui'),
(15, 2, 'Guanta (Guanta)', 'Anzoátegui'),
(16, 2, 'Independencia (Soledad)', 'Anzoátegui'),
(17, 2, 'onagas Monagas (Mapire)', 'Anzoátegui'),
(18, 2, 'Juan Antonio Sotillo (Puerto la Cruz)', 'Anzoátegui'),
(19, 2, 'Juan Manuel Cajigal (Onoto)', 'Anzoátegui'),
(20, 2, 'Libertad (San Mateo)', 'Anzoátegui'),
(21, 2, 'Francisco Miranda (Pariguán)', 'Anzoátegui'),
(22, 2, 'Pedro María Freites (Cantaura)', 'Anzoátegui'),
(23, 2, 'Píritu (Píritu)', 'Anzoátegui'),
(24, 2, 'San José de Guanipa (San José de Guanipa)', 'Anzoátegui'),
(25, 2, 'San Juan de Capistrano (Boca de Uchire)', 'Anzoátegui'),
(26, 2, 'Santa Ana (Santa Ana)', 'Anzoátegui'),
(27, 2, 'Simón Bolívar (Barcelona)', 'Anzoátegui'),
(28, 2, 'Simón Rodriguéz (El Tigre)', 'Anzoátegui'),
(29, 3, 'Achaguas (Achaguas)', NULL),
(30, 3, 'Biruaca (Biruaca)', NULL),
(31, 3, 'Muñoz (Bruzal)', NULL),
(32, 3, 'Paéz (Guasdualito)', NULL),
(33, 3, 'Pedro Camejo (San Juan de Payara)', NULL),
(34, 3, 'Rómulo Gallegos (Elorza)', NULL),
(35, 3, 'San Fernando (San Fernando de Apure)', NULL);*/

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_admin_usuarios`
--

CREATE TABLE IF NOT EXISTS `vy_admin_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_adm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave_adm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel_adm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `vy_admin_usuarios`
--

INSERT INTO `vy_admin_usuarios` (`id`, `usuario_adm`, `clave_adm`, `nivel_adm`) VALUES
(1, 'johana', '123456', 'medio'),
(2, 'ledarca', '123456', 'alto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_catalogo`
--

CREATE TABLE IF NOT EXISTS `vy_catalogo` (
  `catalogo_id` int(11) NOT NULL AUTO_INCREMENT,
  `unterkategorie_id` int(11) DEFAULT NULL,
  `referencia` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen60` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen700` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechasubida` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `peso` decimal(11,2) DEFAULT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `activar` int(1) DEFAULT NULL,
  PRIMARY KEY (`catalogo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=151 ;

--
-- Volcado de datos para la tabla `vy_catalogo`
--

INSERT INTO `vy_catalogo` (`catalogo_id`, `unterkategorie_id`, `referencia`, `imagen60`, `imagen700`, `fechasubida`, `cantidad`, `precio`, `peso`, `color`, `descripcion`, `activar`) VALUES
(1, 40, 'cg000', 'catalogo/photo/small/60x60/cg_000.jpg', 'catalogo/photo/big/700x700/cg_000.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(2, 40, 'cg001', 'catalogo/photo/small/60x60/cg_001.jpg', 'catalogo/photo/big/700x700/cg_001.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(3, 40, 'cg002', 'catalogo/photo/small/60x60/cg_002.jpg', 'catalogo/photo/big/700x700/cg_002.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(4, 40, 'cg003', 'catalogo/photo/small/60x60/cg_003.jpg', 'catalogo/photo/big/700x700/cg_003.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(5, 40, 'cg004', 'catalogo/photo/small/60x60/cg_004.jpg', 'catalogo/photo/big/700x700/cg_004.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(6, 40, 'cg005', 'catalogo/photo/small/60x60/cg_005.jpg', 'catalogo/photo/big/700x700/cg_005.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(7, 40, 'cg006', 'catalogo/photo/small/60x60/cg_006.jpg', 'catalogo/photo/big/700x700/cg_006.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(8, 40, 'cg007', 'catalogo/photo/small/60x60/cg_007.jpg', 'catalogo/photo/big/700x700/cg_007.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(9, 40, 'cg008', 'catalogo/photo/small/60x60/cg_008.jpg', 'catalogo/photo/big/700x700/cg_008.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(10, 40, 'cg009', 'catalogo/photo/small/60x60/cg_009.jpg', 'catalogo/photo/big/700x700/cg_009.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(11, 40, 'cg010', 'catalogo/photo/small/60x60/cg_010.jpg', 'catalogo/photo/big/700x700/cg_010.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(12, 40, 'cg011', 'catalogo/photo/small/60x60/cg_011.jpg', 'catalogo/photo/big/700x700/cg_011.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(13, 40, 'cg012', 'catalogo/photo/small/60x60/cg_012.jpg', 'catalogo/photo/big/700x700/cg_012.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(14, 40, 'cg013', 'catalogo/photo/small/60x60/cg_013.jpg', 'catalogo/photo/big/700x700/cg_013.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(15, 40, 'cg014', 'catalogo/photo/small/60x60/cg_014.jpg', 'catalogo/photo/big/700x700/cg_014.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(16, 40, 'cg015', 'catalogo/photo/small/60x60/cg_015.jpg', 'catalogo/photo/big/700x700/cg_015.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(17, 40, 'cg016', 'catalogo/photo/small/60x60/cg_016.jpg', 'catalogo/photo/big/700x700/cg_016.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(18, 40, 'cg017', 'catalogo/photo/small/60x60/cg_017.jpg', 'catalogo/photo/big/700x700/cg_017.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(19, 40, 'cg018', 'catalogo/photo/small/60x60/cg_018.jpg', 'catalogo/photo/big/700x700/cg_018.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(20, 40, 'cg019', 'catalogo/photo/small/60x60/cg_019.jpg', 'catalogo/photo/big/700x700/cg_019.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(21, 40, 'cg020', 'catalogo/photo/small/60x60/cg_020.jpg', 'catalogo/photo/big/700x700/cg_020.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(22, 40, 'cg021', 'catalogo/photo/small/60x60/cg_021.jpg', 'catalogo/photo/big/700x700/cg_021.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(23, 40, 'cg022', 'catalogo/photo/small/60x60/cg_022.jpg', 'catalogo/photo/big/700x700/cg_022.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 0),
(24, 40, 'cg023', 'catalogo/photo/small/60x60/cg_023.jpg', 'catalogo/photo/big/700x700/cg_023.jpg', '2013-03-12', 1, 140.00, 150.00, 'variado', 'cinta gross', 1),
(46, 46, 'pr080', 'catalogo/photo/small/60x60/venyor.com_60x60_4049f9bfb2089cd7d5ac10fd6efb7ffePR080.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b561853b0034cec9d919f3a0e1a35b68PR080.jpg', '2013-03-13', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(47, 48, 'pr000', 'catalogo/photo/small/60x60/venyor.com_60x60_e72c16dbc8a8d8028853c2c86badaa13PR000.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_2082a0b09799af6738dc5d60c9d0b121PR000.jpg', '2013-03-13', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(48, 48, 'pr001', 'catalogo/photo/small/60x60/venyor.com_60x60_8603b7dfba771e3443a880ba91a62cdfPR001.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_9060e2d5ae2ca01a4c0436b729dd05d8PR001.jpg', '2013-03-13', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(49, 48, 'pr002', 'catalogo/photo/small/60x60/venyor.com_60x60_3e8dfbf3d7f6b6d1b0a57c3ea0896743PR002.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_7689a820ac4f3e69e5c4edb6e554a99ePR002.jpg', '2013-03-13', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(50, 46, 'PR081', 'catalogo/photo/small/60x60/venyor.com_60x60_c3f518f36abfd3bcbea20093634c721aPR081.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_d826dc90ba7e9b89c8a0e0e26c58e515PR081.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(51, 46, 'PR083', 'catalogo/photo/small/60x60/venyor.com_60x60_81862e17337317a1a38f59a487287ee2PR083.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_79d046e2977b15c168e967e19c57fc6cPR083.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(52, 46, 'PR084', 'catalogo/photo/small/60x60/venyor.com_60x60_ee964dfd0d74c91c505c1c43e0d4237cPR084.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_c0d93b8839fa44a7e625ef35e7d50c8dPR084.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(53, 46, 'PR085', 'catalogo/photo/small/60x60/venyor.com_60x60_346c72386b04541e215affeac76b6bafPR085.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_d5dc28c3774a082a106ec4227d07fbffPR085.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(54, 46, 'PR086', 'catalogo/photo/small/60x60/venyor.com_60x60_3ccafd1807a89623d7aff0cfc08c8565PR086.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_d697bb42e99a5db9e5a1d095d4099a21PR086.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(55, 46, 'PR087', 'catalogo/photo/small/60x60/venyor.com_60x60_d3239f3af24ab102244da8ba2a03e1acPR087.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_05176c56eb31c4dc9a80de7f119a7989PR087.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(56, 46, 'PR088', 'catalogo/photo/small/60x60/venyor.com_60x60_10f162bdce69b603723ba0a21a23ab6fPR088.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ab5a036c570e873c1acc5ddffc383893PR088.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(57, 46, 'PR089', 'catalogo/photo/small/60x60/venyor.com_60x60_e2453db9247d958818e0086ec187fcb3PR089.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_64310a0f1725bcdc1ea58d3110073093PR089.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(58, 46, 'PR090', 'catalogo/photo/small/60x60/venyor.com_60x60_6ddac0b0c192e22671a3eea995b2f4f9PR090.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_47217ac369de2e2a929f464f71445a4dPR090.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(59, 46, 'PR091', 'catalogo/photo/small/60x60/venyor.com_60x60_b0b1ddc817693b6001f3f37da3c0b286PR091.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_61bf1989579a12160a95ed8b82d0fbcfPR091.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(60, 46, 'PR092', 'catalogo/photo/small/60x60/venyor.com_60x60_8b90eab228be8aa894274a2bb032506aPR092.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_343d804abe73afaf2ae0053e94e330ddPR092.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(61, 46, 'PR093', 'catalogo/photo/small/60x60/venyor.com_60x60_0c1c9e12ec556bfd81d829016bc5c42aPR093.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_8096ddb4b52cfb8523203bf74c0742dfPR093.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(62, 46, 'PR094', 'catalogo/photo/small/60x60/venyor.com_60x60_341a858400ee46f24974222d31c25eb5PR094.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_a6db36b96f6d65101334b39e200370c1PR094.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(63, 46, 'PR095', 'catalogo/photo/small/60x60/venyor.com_60x60_8159d2d2af9dd1f4b585e3da05c1cd84PR095.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_22a7f4dc2d9fa0b25518b241bd6a01b0PR095.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(64, 46, 'PR096', 'catalogo/photo/small/60x60/venyor.com_60x60_7273273efb72d3993dcef3e1e3226f57PR096.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_5e7ef41a7a60ee32ce3353ab5d6f342dPR096.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(65, 46, 'PR097', 'catalogo/photo/small/60x60/venyor.com_60x60_a802249d23e2d80abffb9b3193ee7465PR097.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_9524301254abe2d6bddd695f11674ff7PR097.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(66, 48, 'PR003', 'catalogo/photo/small/60x60/venyor.com_60x60_f5cd9f85e53867d53b79d3d3016675cbPR003.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_6b87b7052a182a4a647cc2e4646676d8PR003.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(67, 48, 'PR004', 'catalogo/photo/small/60x60/venyor.com_60x60_14791c25dd95fc7749e341042d630201PR004.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_227099d3d260f99b17ab8515feb7bab6PR004.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(68, 49, 'PR005', 'catalogo/photo/small/60x60/venyor.com_60x60_c0c689c16d3832f3086898ca6af255f1PR005.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_6a5f7c907f1afd975ff851aa9f1eb23ePR005.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(69, 49, 'PR008', 'catalogo/photo/small/60x60/venyor.com_60x60_f6c1b172b906a82057546aa0acfb7861PR008.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_10c8deb7047dd6576353347c95a3f873PR008.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(70, 49, 'PR010', 'catalogo/photo/small/60x60/venyor.com_60x60_c2ae2da631d80d72b8dc0d86f4b14f7fPR010.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ef03e65ccc0d9b4e435f56ab627b460bPR010.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(71, 49, 'PR011', 'catalogo/photo/small/60x60/venyor.com_60x60_551da57f8262b44aa4863e250a113533PR011.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_18d7558958159e94c63abe60763e2ef2PR011.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(72, 49, 'PR012', 'catalogo/photo/small/60x60/venyor.com_60x60_467d59a88b9bf1baf1b1b893a42a57f0PR012.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_6d56948b7a0624eb62fb1702f42c7507PR012.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(74, 43, 'PR013', 'catalogo/photo/small/60x60/venyor.com_60x60_6b9d9fccedb8e8e3cbfa93994ef110c7PR013.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_cab151cc43bec7f0b99cb32be8c26856PR013.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(75, 43, 'PR014', 'catalogo/photo/small/60x60/venyor.com_60x60_0df17b5aa40cfc14d629772200432b93PR014.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_260ba46b83105798c565b489039aae10PR014.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(76, 43, 'PR015', 'catalogo/photo/small/60x60/venyor.com_60x60_5c7c3048d48ececeba8b1a42d8ee8604PR015.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_467ee4922ad13971fcd165608f62f41aPR015.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(77, 43, 'PR016', 'catalogo/photo/small/60x60/venyor.com_60x60_b4697ee1c3aabc13e55078bb83fc6f01PR016.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ce3e076012e09aa774784fb9878c935dPR016.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(78, 43, 'PR018', 'catalogo/photo/small/60x60/venyor.com_60x60_dd8df6db18edb74380bbb1d1d20772cbPR018.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_e0aa7a17048d382760b5db2aa0eb888ePR018.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(79, 43, 'PR019', 'catalogo/photo/small/60x60/venyor.com_60x60_333be086a48d21238b383786f355a9f4PR019.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_18fa9b4a0e0314c8b094e5c2862d832fPR019.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(80, 43, 'PR020', 'catalogo/photo/small/60x60/venyor.com_60x60_75b242d55f6049befe2d2cb017c18400PR020.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_5b8ada117d505ef7a524c97ce10503c4PR020.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(81, 43, 'PR021', 'catalogo/photo/small/60x60/venyor.com_60x60_d18f939f0789f8d6eaa7ceeb18c2c2e9PR021.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_0d4144ac22b719ca059fe699742c359bPR021.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(82, 43, 'PR022', 'catalogo/photo/small/60x60/venyor.com_60x60_e73633de12584966e2b2cb9cfd7bfb4dPR022.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_79c3ee20fd0bd8be7fd4bd1bc7f8d6ebPR022.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(83, 43, 'PR023', 'catalogo/photo/small/60x60/venyor.com_60x60_9683db5693774c91ffa0614247b15740PR023.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_f51013163fcaa3016b3d64749b18a6d5PR023.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(84, 43, 'PR024', 'catalogo/photo/small/60x60/venyor.com_60x60_03917cc60f447148f1deb6c39f5a0b7ePR024.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_2bee9c1f037e263f3f8a973fbf09f325PR024.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(85, 44, 'PR025', 'catalogo/photo/small/60x60/venyor.com_60x60_70d12269991c40ef28db01fdd4cd5a21PR025.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_915dcdf86667ef68ac45a39eb1f85653PR025.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(86, 44, 'PR026', 'catalogo/photo/small/60x60/venyor.com_60x60_5f2469abe133abf7e3849e25b84bb495PR026.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_d4d0efd8d22b2bd002006235da1ee579PR026.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(87, 44, 'PR027', 'catalogo/photo/small/60x60/venyor.com_60x60_2849415ecee4a6e1a99f3d7565667c8fPR027.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_a781a133e0366385b0e6fcc160d960e7PR027.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(88, 44, 'PR028', 'catalogo/photo/small/60x60/venyor.com_60x60_18c42f79ec8df01e47674759dc20426aPR028.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_cbff40276570f4fd17e29e0f4c6b790dPR028.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(89, 44, 'PR029', 'catalogo/photo/small/60x60/venyor.com_60x60_6772f37a8957c6849d0f927b974a6167PR029.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_8d8f09ed615c7b2a55a4f4bc917c1d6bPR029.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(90, 44, 'PR032', 'catalogo/photo/small/60x60/venyor.com_60x60_9aefd13792816d3d7d77d3dcd61b69b3PR032.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_d72c5dfc163aa35da449946495a35b55PR032.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(91, 44, 'PR033', 'catalogo/photo/small/60x60/venyor.com_60x60_93571cbe2594b3dc2a63c7636a2112cdPR033.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_f50bb1dd63e3b104d2a2d75edac1f01fPR033.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(92, 44, 'PR034', 'catalogo/photo/small/60x60/venyor.com_60x60_42f95a66aacd1e476146c7a018e7d1f3PR034.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_4253164430ec32334f181cb0c46e6778PR034.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(93, 44, 'PR035', 'catalogo/photo/small/60x60/venyor.com_60x60_f3b4a87b9029f102f413a74c3dee6a2cPR035.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_624437078bf585567204d840dda117b6PR035.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(94, 44, 'PR036', 'catalogo/photo/small/60x60/venyor.com_60x60_61123c3719225f2eb2b82e51bdc203a8PR036.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_6286a413d5dd5fd062e8f3ebf9590a5fPR036.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(95, 45, 'PR038', 'catalogo/photo/small/60x60/venyor.com_60x60_1c2c0881e596638f1bfb55e2a3da79cdPR038.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_6a196d60497194424aca2da5dc524af7PR038.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(96, 45, 'PR039', 'catalogo/photo/small/60x60/venyor.com_60x60_ed9f85acface4aed0d9c6fd435f145d0PR039.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ab32c6427de8d90b787f14fd96b5efb8PR039.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(97, 45, 'PR040', 'catalogo/photo/small/60x60/venyor.com_60x60_7ea9a2229e91000bb43ac2f576f06fe6PR040.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_3038d152be6f7cae3ca5373a5e5fa878PR040.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(98, 45, 'PR041', 'catalogo/photo/small/60x60/venyor.com_60x60_fcf87bb4448d35c370021b73339da0aePR041.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_cb5c1c1bdd6de1e04f72935f4b0b32eaPR041.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(99, 45, 'PR042', 'catalogo/photo/small/60x60/venyor.com_60x60_be07cb1e1278b5dcac49ef87adda6811PR042.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_313b44d5db879ea056b3bb58d154a817PR042.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(100, 45, 'PR043', 'catalogo/photo/small/60x60/venyor.com_60x60_73ba4061bc2481b7cf9fff7f49b5a9faPR043.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b9c0ce3413b02e35d4cb51ef0dab57ccPR043.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(101, 45, 'PR044', 'catalogo/photo/small/60x60/venyor.com_60x60_63a0912d11201c77da4c4a924bcd693fPR044.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_36e2c5643d344ac6a2bf88243327fdd4PR044.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(102, 45, 'PR045', 'catalogo/photo/small/60x60/venyor.com_60x60_c679b22db16702c43b1ef6981354f992PR045.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_de9186a6a22ceb3e4b1a5347024ba269PR045.jpg', '2013-03-14', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(103, 50, 'PR124', 'catalogo/photo/small/60x60/venyor.com_60x60_341ca654aecf94adb81833c1e532522bPR124.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_1e5f2acc77e980ff3b82425e87a8ca52PR124.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(104, 50, 'PR125', 'catalogo/photo/small/60x60/venyor.com_60x60_5e220da702e97f1301b4de152f144621PR125.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_4aef79b2f2750496874aad911b47ab49PR125.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(105, 50, 'PR129', 'catalogo/photo/small/60x60/venyor.com_60x60_ce01aeded06aa0478acacec3c9636c65PR129.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_e1355dd40ba77546c7068d4b93025f5cPR129.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(106, 33, 'PR067', 'catalogo/photo/small/60x60/venyor.com_60x60_ed6b9014e487a898d10139b584cf5faaPR067.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_bb6a15d788be1fcfecbd0e985d14a76aPR067.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(107, 33, 'PR068', 'catalogo/photo/small/60x60/venyor.com_60x60_7806b848c65d9065454f792431ed8101PR068.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_8a11800b8bead0acc87062f91ab373afPR068.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(108, 33, 'PR076', 'catalogo/photo/small/60x60/venyor.com_60x60_5ef0836e4d28803dd85c2ba976ab5c96PR076.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_233d805a66b923914d446be7e3daed43PR076.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(109, 33, 'PR077', 'catalogo/photo/small/60x60/venyor.com_60x60_674675d7e4fdf295cd0514ed2a49c74cPR077.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_c2b649fbdfb4deae1cf59fd40411d16fPR077.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(110, 31, 'PR047', 'catalogo/photo/small/60x60/venyor.com_60x60_127ec8794efedf486fb19a1183c4e263PR047.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b3bd59cc4fab9b354d34da6531145b06PR047.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(111, 31, 'PR048', 'catalogo/photo/small/60x60/venyor.com_60x60_54a705cc2cfc7bcfa3d225692564a7b7PR048.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b1d605272f781b2aaeb0a0e37f898a05PR048.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(112, 31, 'PR051', 'catalogo/photo/small/60x60/venyor.com_60x60_c65255a4db6d71653601a88b59c11245PR051.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_7193ce2e0f5b7b6c1232cc8cc03a4f82PR051.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(113, 31, 'PR052', 'catalogo/photo/small/60x60/venyor.com_60x60_e64e6a565057a4291fbad59eb937fa5ePR052.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_4ed8541d3bbd66a30674184caab415e5PR052.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(114, 31, 'PR053', 'catalogo/photo/small/60x60/venyor.com_60x60_8dee0f427a983fb2ad64cf43e017f739PR053.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_0e797c6c79f20d0b3ede1a969966037aPR053.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(115, 31, 'PR054', 'catalogo/photo/small/60x60/venyor.com_60x60_bad0b779033496981c1bc8d14ab41225PR054.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_e0308bd7648da31ba761932fec6b3122PR054.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(116, 31, 'PR055', 'catalogo/photo/small/60x60/venyor.com_60x60_2fd52697d39edc7adcec17720d125425PR055.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_4447b049ee12b24918045a919fd70585PR055.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(117, 31, 'PR061', 'catalogo/photo/small/60x60/venyor.com_60x60_a9f56a86ca68f4574769f90511f697dePR061.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_950b52141f37613edb20607a89c0687dPR061.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(118, 31, 'PR062', 'catalogo/photo/small/60x60/venyor.com_60x60_60146828475dac0bcdf2a2a71c478362PR062.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ddf013aa10ac2cb66dad9ecc2ca970caPR062.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(119, 31, 'PR063', 'catalogo/photo/small/60x60/venyor.com_60x60_7684864e031e86af79f2c00d1d6cf102PR063.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ec8dcd16f6451bf190d97e7a81f4c59ePR063.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(120, 31, 'PR064', 'catalogo/photo/small/60x60/venyor.com_60x60_ecf3faf57db2fb4309c22a54b5c8b8f6PR064.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_e8d40f87d1d98e43dec635dac5a76f88PR064.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(121, 31, 'PR065', 'catalogo/photo/small/60x60/venyor.com_60x60_afa82a61d3f97df4e1197bff5951c645PR065.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_7e251ccdfb81b9255804283fd60c8deaPR065.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(122, 31, 'PR066', 'catalogo/photo/small/60x60/venyor.com_60x60_353d1b0536822982165678ffbe960401PR066.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_377bc6f2e0e364058571182004505306PR066.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(123, 47, 'PR102', 'catalogo/photo/small/60x60/venyor.com_60x60_1e90918a09e8734bbf85fb37837fe68aPR102.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b35c08caf716d2f31313314ddda91008PR102.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(124, 47, 'PR103', 'catalogo/photo/small/60x60/venyor.com_60x60_31c8964c9e3165f56cbd750e7552bde7PR103.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_f22bd6f8af959ed6af60f26381fc5657PR103.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(125, 47, 'PR105', 'catalogo/photo/small/60x60/venyor.com_60x60_bfa88d38abc3c38eff00798f000a17c8PR105.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ee4840ce5f2b9a29ba20e02107ce6552PR105.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(126, 47, 'PR106', 'catalogo/photo/small/60x60/venyor.com_60x60_f6354feae1bb7337047a16735605c8ccPR106.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_c3b436b61f49290db55d3a05b9529657PR106.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(127, 47, 'PR107', 'catalogo/photo/small/60x60/venyor.com_60x60_1c08174de4e3a7a75e3213eb9b27c3ddPR107.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_cce9f539762ed446676088b02db427c2PR107.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(128, 47, 'PR108', 'catalogo/photo/small/60x60/venyor.com_60x60_ea373db32a8ba56b8508dc4483a4cd52PR108.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_0f9772d8cf628bdab7457aa2b291c410PR108.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(129, 47, 'PR109', 'catalogo/photo/small/60x60/venyor.com_60x60_81e5870b26444104c0bf9d1b3ef1f606PR109.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_fe3f6b3eda49a93dae678c035033eaccPR109.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(130, 47, 'PR110', 'catalogo/photo/small/60x60/venyor.com_60x60_adf7352b74886a79d80597e169271055PR110.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_3883f33db21076ef8cc7b048b32b2d42PR110.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 1),
(131, 47, 'PR111', 'catalogo/photo/small/60x60/venyor.com_60x60_2881f71351d7418dac12dfa0f327dd78PR111.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_11bc4550b3f41b86aa957aaf2883800cPR111.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(132, 47, 'PR112', 'catalogo/photo/small/60x60/venyor.com_60x60_60ff9bc0c075bbbdbfbcc74841f9dff1PR112.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_52a2e86c58ad76de1a87a15c37e1f8e3PR112.jpg', '2013-03-15', 6, 1.80, 25.00, 'variado', 'papel de regalo', 0),
(133, 47, 'PR113', 'catalogo/photo/small/60x60/venyor.com_60x60_2d12a0c9e3fb1fd1fe6accb7e4a4f3d7PR113.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_a1e89389b7c2acab81c76c875e8c9a8dPR113.jpg', '2013-03-15', 6, 1.80, 25.00, 'blanco con azul puntos', 'papel de regalo de puntos', 0),
(141, 18, 'laz13412_000', 'catalogo/photo/small/60x60/venyor.com_60x60_c0640b42c78af61d3b718ab199b70202laz13412_000.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b99b0381aec470530f43c2c629482930laz13412_000.jpg', '2013-05-08', 1, 12.00, 35.00, 'amarillo con flores', 'lazo para niña amarillo con flores', 1),
(142, 18, 'laz13412_001', 'catalogo/photo/small/60x60/venyor.com_60x60_849cbba876ebddef47b7c2d632bd94a3laz13412_001.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_fa078beeba46ad8205ac3309c25843bclaz13412_001.jpg', '2013-05-08', 1, 12.00, 35.00, 'verde y blanco', 'lazos para niña', 1),
(143, 18, 'laz13412_002', 'catalogo/photo/small/60x60/venyor.com_60x60_677da3672c667a2a416f4962a3656875laz13412_002.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_b3a47aebb3739ca740064d92368f859flaz13412_002.jpg', '2013-05-08', 1, 12.00, 35.00, 'verde y blanco', 'lazos para niña', 1),
(144, 18, 'laz13412_003', 'catalogo/photo/small/60x60/venyor.com_60x60_a05e2ad134ae2623c5f1c1cf8bf098aalaz13412_003.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_bc24e877b19c82abdfd05554295a617blaz13412_003.jpg', '2013-05-08', 1, 12.00, 35.00, 'morado y blanco', 'lazos para niña', 1),
(145, 18, 'laz13412_004', 'catalogo/photo/small/60x60/venyor.com_60x60_e311a8b351aa138026f8cdb4fe5d1b9blaz13412_004.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_7749df8cd799d1a4befaaa713f0de917laz13412_004.jpg', '2013-05-08', 1, 12.00, 35.00, 'morado y blanco', 'lazos para niña', 1),
(146, 18, 'laz13412_005', 'catalogo/photo/small/60x60/venyor.com_60x60_a840eedab68dd412ce91b0b4f3e22347laz13412_005.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_4d2794f187c79fb3ab533b40d362f005laz13412_005.jpg', '2013-05-08', 1, 12.00, 35.00, 'morado y blanco', 'lazos para niña', 1),
(147, 18, 'laz13412_006', 'catalogo/photo/small/60x60/venyor.com_60x60_6ad2a3af50ca878cd5a9add30d4ac160laz13412_006.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_ca71336d7b9d48ef35d9093e52628cdblaz13412_006.jpg', '2013-05-08', 1, 12.00, 35.00, 'blanco y rosado', 'lazos para niña', 1),
(148, 18, 'laz13412_007', 'catalogo/photo/small/60x60/venyor.com_60x60_4323cb71496149cd1b9d6581c813a935laz13412_007.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_7ff6c631e7725d770e8d88b8fee8616flaz13412_007.jpg', '2013-05-08', 1, 12.00, 35.00, 'azul y blanco', 'lazos para niña', 1),
(149, 18, 'laz13412_008', 'catalogo/photo/small/60x60/venyor.com_60x60_6d9ac7077634fef24b17d7549d695df1laz13412_008.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_41afd4ce33f6f5ec17105ef3be5d23aclaz13412_008.jpg', '2013-05-08', 1, 12.00, 35.00, 'blanco y azul', 'lazos para niña', 1),
(150, 18, 'laz13412_009', 'catalogo/photo/small/60x60/venyor.com_60x60_4165005e5e37e762b8d0536d76b4874elaz13412_009.jpg', 'catalogo/photo/big/700x700/venyor.com_700x700_9fa6954bab6fc12211782cc68c0cfcb5laz13412_009.jpg', '2013-05-08', 1, 15.00, 35.00, 'negro y blanco', 'lazos para niñas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_kategorie`
--

CREATE TABLE IF NOT EXISTS `vy_cat_kategorie` (
  `kategorie_id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sujet_id` int(11) DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  PRIMARY KEY (`kategorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `vy_cat_kategorie`
--

INSERT INTO `vy_cat_kategorie` (`kategorie_id`, `nombre_categoria`, `sujet_id`, `activar`) VALUES
(4, 'prendas ', 1, NULL),
(11, 'papel de regalo', 4, NULL),
(13, 'animados', 2, NULL),
(16, 'cinta gross', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_productos`
--

CREATE TABLE IF NOT EXISTS `vy_cat_productos` (
  `produkt_id` int(10) NOT NULL AUTO_INCREMENT,
  `kategorie_id` int(11) DEFAULT NULL,
  `unterkategorie_id` int(11) DEFAULT NULL,
  `sujet_id` int(11) DEFAULT NULL,
  `nombre_prod` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion_prod` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `color_prod` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `unidad_prod` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dimensiones_prod` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `precio_prod` decimal(11,2) DEFAULT NULL,
  `peso_prod` int(11) DEFAULT NULL,
  `cantidad_prod` int(11) DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `nuevo_prod` int(11) DEFAULT NULL,
  `alto_prod` int(11) DEFAULT NULL,
  `ancho_prod` int(11) DEFAULT NULL,
  `largo_prod` int(11) DEFAULT NULL,
  `marca_prod` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen60` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen60_2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen60_3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen60_4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen100` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen290` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen290_2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen290_3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen290_4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen700` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen700_2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen700_3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen700_4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen1500` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen1500_2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen1500_3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen1500_4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `garantia` int(11) DEFAULT NULL,
  `catalogo` int(11) DEFAULT NULL,
  PRIMARY KEY (`produkt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `vy_cat_productos`
--

INSERT INTO `vy_cat_productos` (`produkt_id`, `kategorie_id`, `unterkategorie_id`, `sujet_id`, `nombre_prod`, `descripcion_prod`, `color_prod`, `unidad_prod`, `dimensiones_prod`, `precio_prod`, `peso_prod`, `cantidad_prod`, `activar`, `fecha_ingreso`, `nuevo_prod`, `alto_prod`, `ancho_prod`, `largo_prod`, `marca_prod`, `imagen60`, `imagen60_2`, `imagen60_3`, `imagen60_4`, `imagen100`, `imagen290`, `imagen290_2`, `imagen290_3`, `imagen290_4`, `imagen700`, `imagen700_2`, `imagen700_3`, `imagen700_4`, `imagen1500`, `imagen1500_2`, `imagen1500_3`, `imagen1500_4`, `garantia`, `catalogo`) VALUES
(1, 4, 18, 1, 'lazos con ganchos lindos para niñas de varias figu', 'lazos lindos para niñas de varias figuras animadas lazos lin', 'variados', '10', NULL, 50.00, 350, 1000, 1, '2013-03-09', 1, 10, 10, 50, 'bbhook', 'photo/small/60x60/venyor.com_60x60_b66cdb0678227f470dd52aab7d1e8dc6bbhook_000.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_f92140f98fd0fb399127ef2ee157a7c0bbhook_006.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_72714ceb7992e035d1d7e439447ff036bbhook_017.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_a8e956b63cca2b0148f449243e03d602bbhook_011.jpg', 'photo/small/100x100/venyor.com_100x100_6d6c34f843b228ca6befcf09e336e2e8bbhook_000.jpg', 'photo/small/290x290/venyor.com_290x290_74eebcd53409d67db32551f63e9f8b7ebbhook_000.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_428994da8d32c33d0ad5c5eb4f8f4eb4bbhook_006.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_8b6e3e7b72440f0fa7b810a6c16ecefabbhook_017.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_7016c1ff5974b1cfdaacbd13a1539abcbbhook_011.jpg', 'photo/big/700x700/venyor.com_700x700_48876db86014fa5bb168de602c8d4d2ebbhook_000.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_3874e04e3f822ab89a91088f50cc5cc0bbhook_006.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_d96c03a17910632d2d20c6151df9dab8bbhook_017.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_62494f7cfa6d8f581f4b57cc6b470789bbhook_011.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_9c2285d29ce383434020fd2a9948e3e7bbhook_000.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_3af5bcf61371c2336b1994983d147664bbhook_006.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_61f885aff47e22c93ae922d7c46ad8aebbhook_017.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_246033cd78f82a5ccd654c55c03880dabbhook_011.jpg', 0, 1),
(2, 16, 40, 3, 'cintas de princesas', 'cintas de princesas variadas', 'variados ', 'rollo', NULL, 130.00, 100, 1000, 1, '2013-03-11', 1, 0, 3, 23, 'no tiene', 'photo/small/60x60/venyor.com_60x60_dbf7c9ee10278c38f751e6a397b8a81fcg_000.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_1ae6fe0d8b7e49127d8199e3dfe5bc5bcg_001.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_1af7325e8389230b17fb6c50cd5522dbcg_002.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_a471f96f5f0f13b053d4a91c9ec75031cg_003.jpg', 'photo/small/100x100/venyor.com_100x100_eea63be4104e93428a26cfb19df497cbcg_000.jpg', 'photo/small/290x290/venyor.com_290x290_9f5f39920d8656b50d0d0214235dc804cg_000.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_39abfabfd9e9ecb9a4fede2f2a30a09fcg_001.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_c4a55432ce509c6e262393ddf0b475afcg_002.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_e4f594d55b2fb1cba75296f16b138e80cg_003.jpg', 'photo/big/700x700/venyor.com_700x700_6700d1f228d26e6fa56788c2fe2b0289cg_000.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_fd5691eb2ebd18ea90417b3b60be3232cg_001.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_e50494e6fe91891a2b9f640d855a6990cg_002.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_1c05093d515eaaecee3552a2e019d164cg_003.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_8049bdb54bd8814ef0785a8df79217ffcg_000.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_d0750b21e91e4e0eb4334d289c14f116cg_001.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_458ba1e5307cf51b981b6931fb9e5af0cg_002.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_be275907b50f97d53e6add540b5a3b43cg_003.jpg', 0, 1),
(3, 11, 46, 4, 'papel de ragalo', 'papel de ragalo al mayor con figura de animales', 'variados', 'pliego', NULL, 1.40, 25, 1000, 1, '2013-03-13', 1, 0, 50, 70, 'no tiene', 'photo/small/60x60/venyor.com_60x60_99692360233862c1f23a4f1f48349b55PR080.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_44829384fdde8f8ecb29e9dfafda265cPR081.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_888a21223785f7d2f763452447b85ac0PR083.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_8dd657ad2447896bd505420eeebda9fbPR084.jpg', 'photo/small/100x100/venyor.com_100x100_a1bfdbd10ef9e82a1dbebd1840b7bf83PR080.jpg', 'photo/small/290x290/venyor.com_290x290_625c91dece834bb34346aa2cf4b6f148PR080.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_405ae7d10c420a754ba21c0d779b05d1PR081.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_88d2127d8e5e5600c8f1454a9b1593e0PR083.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_5c99df8a67251e372eeeaa1dd3937117PR084.jpg', 'photo/big/700x700/venyor.com_700x700_f8f48f50110e6fd843329b7f2067a7a0PR080.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_63e3867b9f8588880ef6c7975ce1e8a5PR081.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_7ac61c72ad391984dcfe971dd47abb04PR083.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_b9462ff535644093062397b582ac6002PR084.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_8f859a05a11b4536366f2af677487a3ePR080.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_90063a3e901c848568673a5f1e04f622PR081.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_bf2f7a78bb6164e93494cfc16e0a3736PR083.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_c2ba0da931363b5ef63255ea6aa7c877PR084.jpg', 0, 1),
(4, 11, 46, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de animales', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_c2378c17aadd1ab12403e9551544070bPR085.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_9ffcdafc3b7e424c2aa6687ad7776f6ePR086.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_57b6929d479d4f170495676e23f94f96PR087.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_f4adf45a4804673241fc5d2a175f8394PR088.jpg', 'photo/small/100x100/venyor.com_100x100_573adddf1d5b1f8e1dc5cc0699c23dd1PR085.jpg', 'photo/small/290x290/venyor.com_290x290_a369732eeac66faf0e638d4f64726f52PR085.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_c659be555a9048b242016535c5640300PR086.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_60576ad55af269da0a1f8932e42c4cf2PR087.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_933444f0ee8d0e26eb1ff5c7c6def917PR088.jpg', 'photo/big/700x700/venyor.com_700x700_aba94bf443b2d0f8a0da9f1dd7cf1e53PR085.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_3072d1e37101578edc9e29411956bb36PR086.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_ba6d107aeea8e3e1c320be766834f937PR087.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_e3799e9ab0072850b156019b0f5fc098PR088.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_1b0380530e6e53b74be3bbd64eccaea7PR085.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_7f0cf1246264883c58f6f537c513f395PR086.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_b4f734a08faa493322823b5cf5a4cfd8PR087.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_df5a011733ad7d3f285917b3b78b4234PR088.jpg', 0, 1),
(5, 11, 46, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de animales', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_43f0cfe1c6bfb9ad92d33227d6b39f5bPR089.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_43ee30f8dc0263a34b0b87f8b4b0c8c8PR090.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_87f3e3cf4d4794ffaaee600802cd6363PR091.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_fe6041fb2387b2032c8f3fefb354c5bbPR092.jpg', 'photo/small/100x100/venyor.com_100x100_b46ed4b1f55269b0837d0f8a160ec3cbPR089.jpg', 'photo/small/290x290/venyor.com_290x290_b107938630ee3c130e9569be180244f7PR089.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_8333826f661f45de375c1dea25760eccPR090.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_1860e101eccafd8d1e35558aabbd2620PR091.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_0cfdceb030c964d3a25a366dfca5d241PR092.jpg', 'photo/big/700x700/venyor.com_700x700_bf8fb71a61e3df4f01ba2311a7d53348PR089.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_1ba16c4b9311beccaf9f14504f6feda9PR090.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_b1e15baf23dde371f6863837cc4051f7PR091.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_ff1acb524e259fc1aca8dc97ac2f784aPR092.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_2aa9fd21c5fb1283ea34d082cc0b0ec0PR089.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_ae6e78ac8cbcb1ee03e24f6fd4011901PR090.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_ddf1555baa6d11214ddda946aaf4eb3cPR091.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_482e23231650c6fb301d4f3ef4b33e7cPR092.jpg', 0, 1),
(6, 11, 46, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de animales', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_73a28bf9a924714f357c83966970a4c9PR093.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_e97c8b08350da9977e13c3c5f5ce308dPR094.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_311300fa126a81ba2c1597a2df29646ePR095.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_0253099b3ad5277866baf9f3e32c2447PR096.jpg', 'photo/small/100x100/venyor.com_100x100_144e994d9e77012309e7a236ed139df4PR093.jpg', 'photo/small/290x290/venyor.com_290x290_f3a00874a66efb870ee2e07146cc8cc3PR093.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_9a38756e160bddc235afa49f76fba278PR094.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_68ceab17d44aa12f48f67b0b50d5989ePR095.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_4713504706345acc7f0db646ffd3be38PR096.jpg', 'photo/big/700x700/venyor.com_700x700_b3ccbc54f5d1520abaf0d6e440dbc7f0PR093.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_c87193de982d6fc552e6095a6d2f55a6PR094.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_2707737c3cd2431999ee5449e127da3fPR095.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_c5c9d1b3b2d5eaf26cd499640c672863PR096.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_6b15050f32e9f1aad56c64c8a327117ePR093.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_a5b1d5cb30790829b435ffe8706dd0e0PR094.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_13d01d6f678e52a672ef402257e2f4c8PR095.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_b44091653bb337704a6ed73bf820087fPR096.jpg', 0, 1),
(8, 11, 48, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de bebes', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_05bf5b5016300b0598d564e946c3a810PR000.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_f22b6b4784fca606d856d63f0cbb5347PR001.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_450c97ee16ec3bada3d7ea4a70b4d418PR002.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_a2913ceb2987f36071f26bfacbca85c3PR003.jpg', 'photo/small/100x100/venyor.com_100x100_721ea8dbaaac759c03dafef5f5c07621PR000.jpg', 'photo/small/290x290/venyor.com_290x290_6bdd739b432612be02a885f220ef3f4fPR000.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_5cd4b164b35cab5033f0a65f51c3fc13PR001.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_af1f4a53ac17c3a8fdaa5a41a3fc4f3ePR002.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_3127d68942c25843a5566bb2f33d71a3PR003.jpg', 'photo/big/700x700/venyor.com_700x700_4aa51969efa2f0228b3199c1167db380PR000.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_e2b7449283193add31140023947db444PR001.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_18fdb67cf357248b6c4c0e2675f429a6PR002.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_753a157da35a38259acaea16e686d183PR003.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_e613dfb2b066ac6a00830509a1e0de99PR000.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_e53b4dc78fe0a6210eb63cebc39a0184PR001.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_8e5a004aef04985f732f180877c93844PR002.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_f0e32b5f20a15db401f74c8bdc07f8bbPR003.jpg', 0, 1),
(10, 11, 49, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de caballeros', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_0bcc21ad8c8d41669386e4d2928e823aPR005.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_1ea26bc2c198b22da4cb7b4b7f8a9e80PR008.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_f2b0094ca92a5f6ba846a890752df8f7PR010.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_935f8a98e3baba9e9533a54f9534fd83PR011.jpg', 'photo/small/100x100/venyor.com_100x100_7eaaffea1fcda9a9d681f5d03fc90ee4PR005.jpg', 'photo/small/290x290/venyor.com_290x290_70faf52e946bb0bbedb83a6c5a4c8a75PR005.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_a5d4e0b0ddcfde22724d1d0311527a0cPR008.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_196b85ba093a42868673d7289925e689PR010.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_1be7b627ccf68b419d9202d6a6a48012PR011.jpg', 'photo/big/700x700/venyor.com_700x700_72c1ddd317dda2656c0592b50553ce65PR005.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_3ea3f8de31f30cd05ccf676bdfb95842PR008.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_9c5582f5ab692fd87011b7c7619c08a9PR010.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_7ab17aca402097721e728a7f3de3ec21PR011.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_5ff3d48d659b38f9c63c29542bbe41b6PR005.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_07e6b3df6d251f05e6bdc4bdec1ad732PR008.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_c99ddd21ee681b41881018b6526ca897PR010.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_5e3fcf162f1ec50f23935c20b44bef5cPR011.jpg', 0, 1),
(12, 11, 43, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de corazones', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_ef041535b3c3cf5a86d2e10473a0fab7PR013.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_85daa246061d97f6e403786a0db6e1e0PR014.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_674e3aed53ce5893d977401acf915cedPR015.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_e2ebb450411e3d588b83eaa3f8d85291PR016.jpg', 'photo/small/100x100/venyor.com_100x100_8567e41bdfba9d89461a7bcdc7de0834PR013.jpg', 'photo/small/290x290/venyor.com_290x290_76959a997192525d3dbaf10c5d6b6df0PR013.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_15bda50f3b51c38b60185ca3d21276d5PR014.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_870b09c25c5ac78042cba971fff58901PR015.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_2b250b67f03519d8012fab762c9842a0PR016.jpg', 'photo/big/700x700/venyor.com_700x700_2bf87bf1bcd6ad4716b55c6ceef57844PR013.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_53fe8dc4d68297fc6fb0f026c39cfd43PR014.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_05d6110cf3053833d2b5cdd8260fce26PR015.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_1b65a403ab967a099efa16a50c247789PR016.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_c2508cf32f242bff4d89f00994654037PR013.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_9b18d7bf500bb9281ada0badaf5cdf83PR014.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_c81531ab7b89803b79546782e45eefd1PR015.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_ff47f7fff77c4b980a7bbb1fc9902848PR016.jpg', 0, 1),
(13, 11, 43, 4, 'Papel de regalo', 'Papel de regalo al mayor con figura de corazones', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_f212716c226a4fc6b83756767b1ec39dPR018.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_5c768d6c5067aab2169440cfff2a493bPR019.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_438b360fdeb453d1849937798b190bedPR020.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_0a45109f46bc9b7538db5696df9c8cc0PR021.jpg', 'photo/small/100x100/venyor.com_100x100_0c7741c9f0b1f667e03425800aaee62bPR018.jpg', 'photo/small/290x290/venyor.com_290x290_48afb4788649b3d0fe4368b78328a800PR018.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_5dce25cbd230b8318fabc351eff96e65PR019.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_4b3f15a4c4a8be59b0e1156b9e5434e6PR020.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_5de4b81239dcf3b315efec476040388aPR021.jpg', 'photo/big/700x700/venyor.com_700x700_3e128329e42c942bcceef67b7410ac9cPR018.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_560a6246852582e2339273a8d4de2ce9PR019.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_af921a61742585287f37208301c207f7PR020.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_f2af4cdbd8445c63cd71d3826ebf60f5PR021.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_bcedeb811ca3144ffefdbe79f7202367PR018.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_57b73f35239d4985b97cd3e11b6bbfa5PR019.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_d42f7b6ed66238037ce4a21de4ee9286PR020.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_b5519c8c864e3dda39347c04da93f388PR021.jpg', 0, 1),
(16, 11, 44, 4, 'Papel de regalo', 'Papel de regalo al mayor con figuras de cumpleaños', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_676023b2add09edb4aed1d353f60dc4cPR025.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_7222cddf8f2e3818f105ad0120848095PR026.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_fa395b473ec43ec64fc809a7d586713bPR027.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_3d789507ed689d03988acbd2455ea904PR028.jpg', 'photo/small/100x100/venyor.com_100x100_362a12bb7d2c5eb711c009a0ca8f14c5PR025.jpg', 'photo/small/290x290/venyor.com_290x290_eea0c28bf55c23b5126973196160929cPR025.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_411640e6b8e72d6cfe26dffce58306fdPR026.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_14edb1dd03749942d32294483ab843bdPR027.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_7b04d81dd94f835d98afa20e155af616PR028.jpg', 'photo/big/700x700/venyor.com_700x700_d2cdc57a0191d244286a7d57e819597aPR025.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_9dd17383d5b046a04d4a8c631ffcb891PR026.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_a8589bdb8b77a1ef972fc3ae8b8cab23PR027.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_07f167c61ebe001d542ef52a7a1208c0PR028.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_ea6a434c2db812a0de72301b51060e29PR025.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_71c8a82267c6e2113d8678f67e4092caPR026.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_3c9bfc4738828a77160577fa51a02f05PR027.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_7dffc2b8ca258bdc664c8368f54ff7d5PR028.jpg', 0, 1),
(17, 11, 44, 4, 'Papel de regalo', 'Papel de regalo al mayor con figuras de cumpleaños', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_312c0d9da3717c783919972be7e29594PR029.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_f344cfcdfd2b1d32dbdba69b1b7bcbd6PR032.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_d9e68f0146a28a91cfba51ac8d4e6ce2PR033.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_dcf372b1c4bc101c9bbe4f8a76878defPR034.jpg', 'photo/small/100x100/venyor.com_100x100_de36a10f0a992b2fc6f641673466d2c0PR029.jpg', 'photo/small/290x290/venyor.com_290x290_2bc64d4e80dfdb023f50367c36286b64PR029.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_5aa28d1b2d99113cae5926ef5990585aPR032.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_2b37a41cdf62c81408a928a5108f68d1PR033.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_de36057f03eab0ce7159e792c6c95206PR034.jpg', 'photo/big/700x700/venyor.com_700x700_cc7e6811dd7e637003b90c3f0c782a16PR029.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_15f63044f51bb7171a7e768f326d1737PR032.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_38f9e905ec1464b8bb4d634a431708fePR033.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_2f826922b2dea91fc24313dda462758aPR034.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_be6d0f0192e8337cf34d03354f586de9PR029.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_99b35175c8b4442ff7009b2c859e250ePR032.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_aa433f7370bc93e2e8e4d6f4144fe04fPR033.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_921eef1f5fc2b32c5b578c442d8db7a0PR034.jpg', 0, 1),
(19, 11, 45, 4, 'Papel de regalo', 'Papel de regalo al mayor con figuras de damas', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_f34f26367a5958623235571514b99259PR038.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_d262bd28a191d178dbbdc97983c80a55PR039.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_64e4df4d7b0bfa815078965b44f50869PR040.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_c66166f8ce1af25c3c3495f56cd40336PR041.jpg', 'photo/small/100x100/venyor.com_100x100_b4ad73cbd352e09935d82d748dab91c6PR038.jpg', 'photo/small/290x290/venyor.com_290x290_49ee1160b7a03db03e3c5aa7d7c7a9c8PR038.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_5f7622d26e013debc92ce501b3d5b233PR039.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_049d8a2708a50edd081530924e2872f3PR040.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_f3cae52332659742fffa103fe6d08a18PR041.jpg', 'photo/big/700x700/venyor.com_700x700_cf743df9f105ffefbd35f5907885ea8cPR038.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_4643d3914445d42b79b6769027a378fePR039.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_d47e67a16d85d9fe7199923b643e44d4PR040.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_2e4a7aceef57b9f409c03ad345d290eePR041.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_27a1d4622db55b616f3b5ac12ab05540PR038.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_5ac111489c3336618b9b2bd577cb1f53PR039.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_960735ad7d75104a797ee789c015569bPR040.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_ec985cc66b0f4641dffe4d11d41309f0PR041.jpg', 0, 1),
(20, 11, 45, 4, 'Papel de regalo', 'Papel de regalo al mayor con figuras de damas', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-14', 1, 0, 50, 70, 'No tiene ', 'photo/small/60x60/venyor.com_60x60_69756d5af770ee5f275e021db5f4560ePR042.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_349a8a4df4c82c6472f21bf2b3ecd2b1PR043.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_8314d833f8cadd6bc42590624832ecacPR044.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_27d955d9fb3e418a113d0caa6573d919PR045.jpg', 'photo/small/100x100/venyor.com_100x100_de847f6fb52142280aa7cd39ea215bc7PR042.jpg', 'photo/small/290x290/venyor.com_290x290_dad16872bfb71ca86fd3337202b9a808PR042.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_91f8f24e2fb5d57fd4b29a57d882e2c5PR043.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_48bfdd2f7329e82b6da9a4cea05265cdPR044.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_ddb41771953268b1c3af17a91d55794bPR045.jpg', 'photo/big/700x700/venyor.com_700x700_b01b0e84bb3fc4801aab15abebc0cad7PR042.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_5c33a1c2a21c68c18063b1f26646c976PR043.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_52a132c4c902863868242ac8f7941a88PR044.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_faae8eedd08b167921aebb5bec17cb6dPR045.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_9d0e7daebd55fb7be0cb044044c8c057PR042.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_ba8263e70b28c02d558d5f82118013b4PR043.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_7cf6e9db9e95e20b3f7e4506b04fc28dPR044.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_b9a9f59a329715380cabaf5adbd13438PR045.jpg', 0, 1),
(23, 11, 33, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de niñas', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_c9a95ce04d950b3b5f320a0d9cbe32e4PR067.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_4ec8926fdebccba2d0d3f9e52c3dee1ePR068.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_1479d2a092b492bd67dea786957b7c10PR076.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_e3fd97d8bab426d2fd99b8c7b9334a81PR077.jpg', 'photo/small/100x100/venyor.com_100x100_97140a5083a8767c546c6200a73000a8PR067.jpg', 'photo/small/290x290/venyor.com_290x290_1b0ef9cf49adfc09fb2a9a54d1b8ac72PR067.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_515eca02e668874528bdee3e435080b1PR068.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_309177d65e680a5ff2571b9366066744PR076.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_cde4487e8bc6105b865ed7b01f8dc3c7PR077.jpg', 'photo/big/700x700/venyor.com_700x700_e167917b17e91a5860a608eba2763875PR067.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_2cabde130dd081fb38a3ed9bc97886d6PR068.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_911645f9ffc0fc03383615b512b8bc9aPR076.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_65f3be1f351c4d03ca55368c2df793eePR077.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_6cbaa7bb4b1038c547da04e98ae23fe9PR067.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_5109db93954d89a40fe664c2d658d049PR068.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_b7ace11be08e611ea8234c64ddc3101ePR076.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_59441369025bd258417212e1acb5a824PR077.jpg', 0, 1),
(24, 11, 31, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de niños', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_907dd0c72d876d7abd9f38d34c7dab69PR047.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_b80ea9bc4e0d8a329963ccaed8ed1641PR048.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_818a619a92c8e9df2b79ecc3bdb90c00PR051.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_c64aaf235b41b725b83a79f733a891fePR052.jpg', 'photo/small/100x100/venyor.com_100x100_ecdc4e7f3b7ffeb87ba7af703aed7df3PR047.jpg', 'photo/small/290x290/venyor.com_290x290_11af704235e2eee2b8853e54af7042c1PR047.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_4cf4463dbb388d69ac765c866cab0f69PR048.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_14bf4d38f286771c476bae73281b3727PR051.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_406c823d46e92597774b35893388f1fbPR052.jpg', 'photo/big/700x700/venyor.com_700x700_06120ce6c4dc160f081f929ee399df55PR047.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_f3da30311444e2bb140c4ed1132ba725PR048.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_e4198e4d5f8b6d8e991acbf499f9f630PR051.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_d193e86618ee6a0c403fc0789e22ac61PR052.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_979e61d29cfae5539ca51a2973957bacPR047.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_b240418cfc3fb17574926cccb588bae0PR048.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_addac9583c0a640786c68662c467ec6fPR051.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_e764d6eae25e6d11ac935949241357daPR052.jpg', 0, 1),
(25, 11, 31, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de niños', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_270cbf70cfb40e445badd9d594d00414PR053.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_ae9ff7fa3c4b065eddb9f8bedbadb317PR054.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_bea7577f005f4bd8190220a08720e7aaPR055.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_ffa8b10d42916b7accce6dd765b69453PR061.jpg', 'photo/small/100x100/venyor.com_100x100_4a5d2dc8ab079558e38c98dd0cfa5bc1PR053.jpg', 'photo/small/290x290/venyor.com_290x290_d5341675e771f1f939d636a65bd0fd3aPR053.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_e75c467d2505c37149b5e698c1840f00PR054.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_3ca7075324c8a9e7460693ad1a41a6b3PR055.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_1b0b5b9a4a17aab299da4ab091d3cb56PR061.jpg', 'photo/big/700x700/venyor.com_700x700_505189b4ca248d9fe53685f77c4388a0PR053.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_92af466fe3371227c2bdf0df36aa0572PR054.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_50cb67828dd2dd034cc5c9351a9a5c95PR055.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_6e772790a728f9e22347689f9a9901e8PR061.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_9114271e764ee7a59fc844602d80cb96PR053.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_a85bdf71308ac575a550005a0dee6e1ePR054.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_39fcb618a72e43f5467c5e2006e2f291PR055.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_a4320fb461a3a3cb019c7128df37547cPR061.jpg', 0, 1),
(26, 11, 31, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de niños', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_8d3d9f4b4d9b2d52333deb2b80561a5dPR062.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_cf0f6c656913a2143004efe9154ee0aePR063.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_6e21222ca4379dffe87ed658eaa86cb1PR064.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_cd5d01ba0f6cf80ec6e4c4179a0cde61PR065.jpg', 'photo/small/100x100/venyor.com_100x100_6a8454552cf3d3ad88c78ab646710f49PR062.jpg', 'photo/small/290x290/venyor.com_290x290_e39ec7e381aed275a4cc95cc8a59a842PR062.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_dca0b2fb8a78394cf1fa26fe2f52fdd4PR063.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_596985c0ecaffe27c9c50da712377c39PR064.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_82400f2ca654985712ba9b8fa08082fbPR065.jpg', 'photo/big/700x700/venyor.com_700x700_6b36710b9063c120316ae3eb817b6f99PR062.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_37102bf8a560f0de2845568348ffaf3dPR063.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_4b94406552239d9830f1296e5eb0d563PR064.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_a76b20ba9df07daa9864dc1efadd2a32PR065.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_cf16e47b740dafd4bafb57d834cbe608PR062.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_0b13a4ae9e1acb48fc9041306c1fc5dePR063.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_2bd422f1d8f7c1c868bb14ccc8c4a9b9PR064.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_b3dc0ea9ccde14b64ee4cca19acf5724PR065.jpg', 0, 1),
(27, 11, 47, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de puntos', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_31c16055173626b50b53520a7d21618cPR102.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_464aa2734fd8e86f14c2bb55ccafa4a3PR103.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_a99c108a93e0453e43612ad27fee3eabPR105.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_b8457e3d7152061099881cfea6dc02dePR106.jpg', 'photo/small/100x100/venyor.com_100x100_da27f6dbc215e553b2ed6f53a1cebc1aPR102.jpg', 'photo/small/290x290/venyor.com_290x290_8b96e0dacb921acd1f2407633378c657PR102.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_9f2cd17f9e1c3eec773803a94be58d69PR103.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_d993d45f603197fa6d1ed525c503ade2PR105.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_53cf2c0292bbf2291df289b9e6a6035ePR106.jpg', 'photo/big/700x700/venyor.com_700x700_7a73a537007cff232d86447e70566e52PR102.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_fb7737ac24a9a8ab55c95883fe6e15ebPR103.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_745bc708c583910fffa4695d392fcb75PR105.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_e0f32f77e0cab470a8fd34b53eb33a87PR106.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_ff4b33523df2983c2aa97ce2c2a26b8bPR102.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_d340ed919a4e5ac326f3f9c36c320114PR103.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_ed948d0569fa53ac44e5a8207c075552PR105.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_e84706c2e13138ed762362e3ce9c09ccPR106.jpg', 0, 1),
(28, 11, 47, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de puntos', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_7148b7dcab8079fa7d569a30ab791fcaPR107.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_c8a322346b9afbfbb6b3f37bbc128f83PR108.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_bb6c5c18e250e14b7d16386b9e915816PR109.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_bfe9813ff098ce8ce94ec4d690f89d29PR110.jpg', 'photo/small/100x100/venyor.com_100x100_fb48a60fe733136c3ead1ffe785411bdPR107.jpg', 'photo/small/290x290/venyor.com_290x290_72a79f39ebcae8499b4b949e351eb431PR107.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_7fbc5abc63a3450c0122179268533c9ePR108.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_8f5f3d032d3312f6eae49d29fe3bc057PR109.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_812dd3ce3a9771e60fc442dd64fd0277PR110.jpg', 'photo/big/700x700/venyor.com_700x700_7fe2ff7f059852e8b4fc0175491eb598PR107.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_15a13a9c10f6d555bed8c363c5da8b89PR108.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_ca8f2b6e0197c5b46ff4dcdc53674826PR109.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_386b859c47fa92a36edab8d81c08c06cPR110.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_f1788e2a7d33f242bf268e2a71b15524PR107.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_6253b21935f68e73959876fa1e81d0c1PR108.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_55dc55d521c3a022689578eec52ee406PR109.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_7d578bfdcf421c2f2ecc84c3f3d79a6aPR110.jpg', 0, 1),
(29, 11, 47, 4, 'Papel de regalo ', 'Papel de regalo al mayor con figuras de puntos', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_7d801d18001c7fa53a5d0efc51aa2611PR111.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_92aea720ac2a9e177939bb37c6d789a0PR112.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_755b6b79022ef49a0f7441ef9ca559bePR113.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_1472ad73b59605502c1a4590761fb59aPR114.jpg', 'photo/small/100x100/venyor.com_100x100_afd62f9d2e23598e6e40b166978492e7PR111.jpg', 'photo/small/290x290/venyor.com_290x290_a43068188fbe68ca25d2c50a78afef2fPR111.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_475e6bd33ed3e8d78ec04048e839624aPR112.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_b7446e609b44c32907186baa05e24b0fPR113.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_e667bda5ec92299878fc7f6f395b43f5PR114.jpg', 'photo/big/700x700/venyor.com_700x700_4842d37ca8e466251eb0501e03d9ce71PR111.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_bcd834ba0ef218681bad47282154a353PR112.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_b3970a323952ad329a17cd29068e7a54PR113.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_698ff98e6db45f34aa6b5b5b4445f93bPR114.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_b688f4ab5155d65666e4e5dc3b0e88d7PR111.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_76e377b4057bd14c524911292473a8c7PR112.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_cdde4da9fe3bbaa73b38df18a118021aPR113.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_d98f4ed74b4afb1b1d7fa82c305f9084PR114.jpg', 0, 1),
(30, 11, 47, 4, 'Papel de regalo', 'Papel de regalo al mayor con figuras de puntos', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_471ecb6c798d94ee7f8bcd993e83a14ePR115.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_67a4ac91ce4f45332592e9a09576fa37PR116.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_804bed343472940bd4f6e5234f4f2a35PR117.jpg', '', 'photo/small/100x100/venyor.com_100x100_d7eb203bf193e0c9ea40be6bfd7baebaPR115.jpg', 'photo/small/290x290/venyor.com_290x290_eaaab7ccb62a8677eba1c663a251c63ePR115.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_433fe17e24ac50553f8d165012686922PR116.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_79e45ccff9e3e29c77b4bb811530c46cPR117.jpg', '', 'photo/big/700x700/venyor.com_700x700_8043a0fffb23785624f427a0cbf0e840PR115.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_cdf1d57a16e73a52b45eaacdc0227d5aPR116.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_8d9276f62e59eac10049e2389a14da16PR117.jpg', '', 'photo/big/1500x1500/venyor.com_1500x1500_1e4b44f3e01e11d7839586707d273053PR115.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_b4c43f6beda0432c59f71bc954e559f1PR116.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_9adf37bda79a27e0e69ef09fb9f1848dPR117.jpg', '', 0, 1),
(32, 11, 50, 4, 'Papel de regalo navidad', 'Papel de regalo al mayor con figuras de naviad', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_baa35d4be03d419c62bace3fcf106197PR121.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_3f6a05ce41950600dd67f1c4f68e6b97PR124.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_947c0eb052b310bc0a21cd80602e5aacPR125.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_5775df4ade0766151cbed06dd03f255ePR129.jpg', 'photo/small/100x100/venyor.com_100x100_8b3f4a820d4c5a13015a5732a6ea87e7PR121.jpg', 'photo/small/290x290/venyor.com_290x290_d92950bbfff7a6910c3fe9d7b86cd439PR121.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_88597639c6ff96be2f32c6d871a73762PR124.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_781013447c1489eb0c7796e1ef5dd473PR125.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_ddfba006621045667def294c6f011cbaPR129.jpg', 'photo/big/700x700/venyor.com_700x700_7e744ad4adebee75df66a740f569d016PR121.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_be23794dca41d5f2c10b29e478bd4a0dPR124.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_e5e9555e510926056be369d36a1db737PR125.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_e0798373dbd10db49e5dd7eeb9721927PR129.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_2e52f15ba96fcd893ab4ae886f756d44PR121.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_e4d1a3519bcba5b7bbc1abd6b02a42b1PR124.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_3ba952eade0370c7590e9002effed13dPR125.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_72c78ec36805d9900166b275962ab9bdPR129.jpg', 0, 1),
(33, 11, 32, 4, 'Papel de regalo satinado al mayor', 'Papel de regalo al mayor con figuras satinadas', 'Variado', 'Pliego', NULL, 1.40, 25, 1000, 1, '2013-03-15', 1, 0, 50, 70, 'No tiene', 'photo/small/60x60/venyor.com_60x60_0b66901440ccd414f854c58f48bfd33aPRS03.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_adcff1fdae5d1169dd58e79385f45f55PRS06.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_3f919bc43bc857325ebd4199b086bfa0PRS14.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_f166c5ef9651d50945c843bce47d403cPRS33.jpg', 'photo/small/100x100/venyor.com_100x100_298e552d069040eb96ff3fa7af5a492cPRS03.jpg', 'photo/small/290x290/venyor.com_290x290_080c0f322dadbbb0a184ebafe473ed34PRS03.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_e42934433a30e215e0ff782867976c69PRS06.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_4c55093ab6bb2a5c97862526914d2f72PRS14.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_33ba61362846c34fcfa1570e0aceaeb7PRS33.jpg', 'photo/big/700x700/venyor.com_700x700_add13527c7d540b09acb8e9b7fb6ba1aPRS03.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_8718ab2e23bfcef20b476e17a44b73b9PRS06.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_f5e5a3adb31d39e46a7dd78251f6e5bfPRS14.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_c96e9debbc3b2a6da1a2a16897332d8bPRS33.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_ebd824d6a0d4f4bb0ef968d2e3984e26PRS03.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_45256b8e81ed6f7c7ab3b57f34dd110aPRS06.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_61cd2718d60d77e0c9277a20c2f9eec4PRS14.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_21c265549a9697f9db7f87f83d534ec4PRS33.jpg', 0, 1),
(35, 13, 35, 2, 'mario bross varios modelos pequeños grandes tambie', 'mario bross varios modelos pequeños medianos y grandes', 'variado', 'und', NULL, 450.00, 500, 0, 1, '2013-03-22', 1, 40, 40, 20, 'no tiene', 'photo/small/60x60/venyor.com_60x60_7a13b7af66527f326269075568b0e1eaMBMG000.jpg', 'photo/small/60x60_2/venyor.com_60x60_2_3895334fef011eaeeb2e1dcca483fc60MBMG002.jpg', 'photo/small/60x60_3/venyor.com_60x60_3_fe6f1d1ad695f580bcdffdd357b8146aMBMG003.jpg', 'photo/small/60x60_4/venyor.com_60x60_4_16a4ef39a3736cbe613defc0d5fc5499MBMG004.jpg', 'photo/small/100x100/venyor.com_100x100_30461cb3b8c27f20154abdbf2101bc7eMBMG000.jpg', 'photo/small/290x290/venyor.com_290x290_3e9b6c9e87492d893fe8440b94b84929MBMG000.jpg', 'photo/small/290x290_2/venyor.com_290x290_2_a65c9c924baa90574129079a742ac108MBMG002.jpg', 'photo/small/290x290_3/venyor.com_290x290_3_9b5770042dede0660cacb25caa63bc61MBMG003.jpg', 'photo/small/290x290_4/venyor.com_290x290_4_a62bde1aee6f1e670b2933e2d14f200fMBMG004.jpg', 'photo/big/700x700/venyor.com_700x700_047170fcd2d21dcfc545421536d00e8cMBMG000.jpg', 'photo/big/700x700_2/venyor.com_700x700_2_62c1d0851a8d8e96b839c5370364509eMBMG002.jpg', 'photo/big/700x700_3/venyor.com_700x700_3_17ee0943861a1b5224c2d2c1a0596e1fMBMG003.jpg', 'photo/big/700x700_4/venyor.com_700x700_4_88991339ce5e3277d815216d0d688bcaMBMG004.jpg', 'photo/big/1500x1500/venyor.com_1500x1500_1e461056bdfc1a86fa0480c9f5f984aeMBMG000.jpg', 'photo/big/1500x1500_2/venyor.com_1500x1500_2_96f3307757dc2d99e56ff39e89a26ecfMBMG002.jpg', 'photo/big/1500x1500_3/venyor.com_1500x1500_3_ff220ca2d55627e261a9fa928e00ab0bMBMG003.jpg', 'photo/big/1500x1500_4/venyor.com_1500x1500_4_643f0f3bcfd7494ecf73d3da1fb686f7MBMG004.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_productos_pregunta`
--

CREATE TABLE IF NOT EXISTS `vy_cat_productos_pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `produkt_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pregunta` text COLLATE utf8_unicode_ci,
  `fecha` date DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respuesta_si` int(1) DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  PRIMARY KEY (`pregunta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `vy_cat_productos_pregunta`
--

INSERT INTO `vy_cat_productos_pregunta` (`pregunta_id`, `produkt_id`, `nombre`, `pregunta`, `fecha`, `email`, `respuesta_si`, `activar`) VALUES
(1, 32, 'Leonard', 'Que vale', '2013-05-16', 'johana@localhost.com', 1, 1),
(2, 32, 'leonard', ' esto es una prueba de leonard david arrioja caceres y johana elizabeth caceres dega aja princesa es como esta bien leonard esto es una prueba esto es una prueba de leonard david arrioja caceres y johana elizabeth caceres dega aja princesa es como esta bien si solo es una simple prieba osjd kjd pero todo esta bien', '2013-05-16', 'johana@localhost.com', 1, 1),
(3, 23, 'Leonard Arrioja', 'Hola esta pregunta', '2013-05-20', 'johana@localhost.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_productos_respuesta`
--

CREATE TABLE IF NOT EXISTS `vy_cat_productos_respuesta` (
  `respuesta_id` int(210) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) DEFAULT NULL,
  `respuesta` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `vy_cat_productos_respuesta`
--

INSERT INTO `vy_cat_productos_respuesta` (`respuesta_id`, `pregunta_id`, `respuesta`, `fecha`, `activar`) VALUES
(1, 1, 'leonard esto es una prueba', '2013-05-16', 1),
(2, 2, 'leonard esto es una prueba esto es una prueba de leonard david arrioja caceres y johana elizabeth caceres dega aja princesa es como esta bien si solo es una simple prieba osjd kjd pero todo esta bien', '2013-05-16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_sujet`
--

CREATE TABLE IF NOT EXISTS `vy_cat_sujet` (
  `sujet_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tema` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  PRIMARY KEY (`sujet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `vy_cat_sujet`
--

INSERT INTO `vy_cat_sujet` (`sujet_id`, `nombre_tema`, `activar`) VALUES
(1, 'bisutería', 1),
(2, 'juguetes', 1),
(3, 'mercería', 1),
(4, 'fiesta y cotillón', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cat_unterkategorie`
--

CREATE TABLE IF NOT EXISTS `vy_cat_unterkategorie` (
  `unterkategorie_id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_subcategoria` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kategorie_id` int(11) DEFAULT NULL,
  `sujet_id` int(11) DEFAULT NULL,
  `activar` int(11) DEFAULT NULL,
  PRIMARY KEY (`unterkategorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `vy_cat_unterkategorie`
--

INSERT INTO `vy_cat_unterkategorie` (`unterkategorie_id`, `nombre_subcategoria`, `kategorie_id`, `sujet_id`, `activar`) VALUES
(18, 'lazos', 4, 1, NULL),
(31, 'niños', 11, 4, NULL),
(32, 'satinado', 11, 4, NULL),
(33, 'niñas', 11, 4, NULL),
(35, 'disney', 13, 2, NULL),
(40, '#5', 16, 3, NULL),
(41, 'corazones', 17, 1, NULL),
(43, 'corazones', 11, 4, NULL),
(44, 'cumpleaños', 11, 4, NULL),
(45, 'damas', 11, 4, NULL),
(46, 'animales', 11, 4, NULL),
(47, 'puntos', 11, 4, NULL),
(48, 'bebes', 11, 4, NULL),
(49, 'caballeros', 11, 4, NULL),
(50, 'navidad', 11, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cms`
--

CREATE TABLE IF NOT EXISTS `vy_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cms` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `contenido_cms` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_cms` date DEFAULT NULL,
  `activar` int(1) DEFAULT NULL COMMENT '1',
  PRIMARY KEY (`cms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `vy_cms`
--

INSERT INTO `vy_cms` (`cms_id`, `nombre_cms`, `contenido_cms`, `fecha_cms`, `activar`) VALUES
(1, 'entrega', '<p>La entrega se realiza después de que se confirme el pago, el usuario debe definir el medio por el por el cual quiere que se tramite el envió, trabajamos con domesa, mrw y tealca. </p>', '2012-12-08', 0),
(2, 'aviso legal', '<H2>Denominación</H2>\r\n<h3>venyor.com</h3>\r\n<h3>Propiedad intelectual</h3>\r\n<p>Todos los contenidos de la página bajo el dominio www.venyor.com, tales como artículos, cursos, imágenes y demás publicaciones son propiedad de venyor.com, este dominio es una tienda virtual que ofrece los siguientes rubros: a) prendas y accesorios de bisutería, b) utensilios para fiestas y cotillones, c) juguetería y mercería, ubicada en la Urb. Fundación Mendoza, Valencia edo. Carabobo. La información aquí publicada no puede ser reproducida ni copiada por ningún motivo.</p>\r\n<h3>Términos y Condiciones</h3>\r\n<p>Los servicios aquí prestados están sujetos a términos y condiciones de uso, todo para el mejor funcionamiento de www.venyor.com, estos términos pueden estar modificándose cuando se considere debido, queda bajo responsabilidad del usuario revisar las nuevas modificaciones, para que acceda de nuevo a los servicios prestados y así se considerara como la aceptación a los nuevos cambios.</p>\r\n<p>El usuario reconoce y acepta el ingreso a la página por su cuenta y es enteramente responsable de los datos suministrados, la empresa garantiza el resguardo y seguridad de los datos suministrados por los usuarios bajo las políticas regidas en la república bolivariana de Venezuela.</p>\r\n<h3>Inscripción y cuenta</h3>\r\n<p>El usuario debe completar el formulario de inscripción en todos sus campos con datos válidos para poder utilizar los servicios que brinda www.venyor.com, el futuro usuario deberá completarlo con su información personal de manera exacta, precisa, verdadera y se compromete a actualizar los datos cuando lo considere necesario.</p>\r\n<p>Solo podrá acceder a su sesión ingresando su nombre de usuario y la clave elegida por el mismo, se compromete a tener de manera confidencial la clave para que no se generen inconvenientes futuros. Es igualmente responsable por todas las operaciones realizadas en su cuenta, debido a que solo él conoce la clave de seguridad además el usuario se compromete a informar a www.venyor.com de cualquier uso no autorizado de su cuenta.</p>\r\n<p>El Usuario será responsable por todas las operaciones efectuadas en su Cuenta, pues el acceso a la misma está restringido al ingreso y uso de su Clave de Seguridad, de conocimiento exclusivo del Usuario.</p>\r\n<h3>Política de Privacidad</h3>\r\n<p>La página www.Venyor.com se compromete a mantener todos sus datos personales seguros y protegidos. Nuestra política de privacidad protege estrictamente la seguridad de su información personal y respeta sus decisiones para el uso previsto.</p>\r\n', '2013-04-19', 1),
(4, 'pago seguro y entrega', '<h2>Condiciones de pago</h2>\r\n<p>El pago se realizara solo por medio de transferencias o depósitos, ya que se tiene un comprobante de la transacción comercial entre las partes.</p>\r\n<p>Los números de cuenta son enviados al momento que usted realice el pedido y siguiente a eso se confirmara su pago para seguir con el proceso del envió.</p>\r\n<h2>Entrega</h2>\r\n<p>El usuario es el responsable de cancelar los gastos del envió del pedido, estos se envían por las compañías de correos de su preferencia como: MRW, GRUPO ZOOM, DHL, IPOSTEL entre otros.</p><p>\r\nLos pedidos al detal se procesan al día, después de verificado el pago, los pedidos al mayor se procesan de 2 a 3 días hábiles, después de verificado el pago. Los clientes deben asegurar sus paquetes con las empresas de envíos, debido que www.venyor.com no se hace responsable por pérdidas o maltrato que correspondan a causas de la empresa de envíos o terceros.</p>\r\n<p>No se devolverá dinero bajo ninguna circunstancia con la única excepción de que venyor.com, por alguna razón de cualquier naturaleza, no pueda llevar a cabo su pedido. Ninguna condición por parte del cliente será causante de devolución de dinero.</p>\r\n', '2013-04-19', 1),
(5, 'nuestras tiendas', NULL, '2012-12-08', 0),
(7, 'como comprar', '<ul>\r\n<li><iframe width="640" height="360" src="http://www.youtube.com/embed/r7GBGZ004vQ?list=PL5E1FA9F5A96883"></iframe></li>\r\n<li><h2>Ver paso a paso:</h2></li>\r\n<li><h3>1)Estar registrado en venyor ¿Cómo registrarse?</h3></li>\r\n<p>Busca el producto que necesites, compara las caracter&iacute;sticas y precios.</p>\r\n<p>Cualquier duda contacta a nuestros <a href="legal.php?cms=10">gerentes de ventas.</a></p>\r\n<li><h3>2)P&aacute;galo:</h3></li>\r\n<p>Haz clic en Comprar, se añadira el producto al carrito de compra donde podrás ver en cualquier instante el monto de tu compra.</p>\r\n<p>Concretar la compra dando clic al bot&oacute;n enviar desde el carrito, los datos de la compra y copia de la factura se te enviaran por e-mail.</p>\r\n<p>Al hacer clic en el botón comprar, el usuario deberá concretar su compra en un plazo mínimo de 5 días hábiles.\r\nLa forma de pago se puede realizar de la siguiente manera:</p>\r\n<p>transferencia bancaria, depósito bancario. <a href="legal.php?cms=4">¿Cómo pagar?</a></p>\r\n<p>Al comprar en venyor tienes la opción de convertirte cliente vip y recibirás descuentos de hasta el 50% y crédito para tus compras.</p>\r\n<li><h3>3) Recibe el producto:</h4></li>\r\n<p>Los envio se realizan por el medio que el cliente proponga</p>\r\n</ul>', '2012-12-08', 0),
(8, 'contacto', '<ul><li><p>Correo: venyorca@gmail.com</p></li><li><p>Teléfono: 0426-2247676</p></li></ul>', '2012-12-20', 1),
(9, 'correos', '<p>ledarca@hotmail.com<p>', '2012-12-20', 0),
(10, 'fidelidad', '<p>esto es un ejemplo</p>', '2013-03-11', 0),
(11, 'ayuda', '<p>ejemplo de ayuda</p>', '2013-03-11', 1),
(13, 'que somos', '<p>somos nosotros</p>', '2013-03-16', 0),
(14, 'info comprado', '<ul>\r\n<li><h3>Gracias por tu compra, estimado usuario</h3></li>\r\n<li>\r\n	<p> \r\n		Estimado usuario, a tu cuenta de correo electrónico te enviamos los números de cuentas para que hagas el depósito o transferencia revísalo por favor y confirma tu pago.\r\n	</p>\r\n</li>\r\n<li><p>Después de confirmar el pago se envía la mercancía en un plazo no mayor a dos (2) días hábiles.</p></li>\r\n<li><p>Gracias por preferirnos, sigue disfrutando de nuestros servicios</p></li>\r\n</ul>', '2013-03-28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_cms_contacto`
--

CREATE TABLE IF NOT EXISTS `vy_cms_contacto` (
  `contacto_id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `activar` int(1) DEFAULT NULL,
  PRIMARY KEY (`contacto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vy_cms_contacto`
--

INSERT INTO `vy_cms_contacto` (`contacto_id`, `correo`, `fecha`, `activar`) VALUES
(1, 'leonard@localhost.com', '2013-03-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_comprado`
--

CREATE TABLE IF NOT EXISTS `vy_comprado` (
  `cc_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`cc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Volcado de datos para la tabla `vy_comprado`
--

INSERT INTO `vy_comprado` (`cc_id`, `cliente_id`, `produkt_id`, `cantidad`, `fecha`) VALUES
(0000000053, 25, 92, 5, '2013-05-04'),
(0000000054, 25, 67, 6, '2013-05-04'),
(0000000055, 25, 69, 6, '2013-05-04'),
(0000000056, 25, 71, 6, '2013-05-04'),
(0000000057, 25, 74, 6, '2013-05-04'),
(0000000058, 25, 76, 6, '2013-05-04'),
(0000000059, 25, 80, 6, '2013-05-04'),
(0000000060, 25, 81, 6, '2013-05-04'),
(0000000061, 25, 82, 6, '2013-05-04'),
(0000000062, 25, 87, 6, '2013-05-04'),
(0000000063, 25, 98, 6, '2013-05-04'),
(0000000064, 25, 102, 6, '2013-05-04'),
(0000000065, 25, 46, 6, '2013-05-04'),
(0000000066, 25, 50, 6, '2013-05-04'),
(0000000067, 25, 51, 6, '2013-05-04'),
(0000000068, 25, 52, 6, '2013-05-04'),
(0000000069, 25, 53, 6, '2013-05-04'),
(0000000070, 25, 56, 6, '2013-05-04'),
(0000000071, 25, 57, 6, '2013-05-04'),
(0000000072, 25, 60, 6, '2013-05-04'),
(0000000073, 25, 104, 6, '2013-05-04'),
(0000000074, 26, 47, 6, '2013-05-12'),
(0000000075, 27, 35, 10, '2013-05-22'),
(0000000076, 28, 47, 6, '2013-05-22'),
(0000000077, 29, 47, 6, '2013-05-22'),
(0000000078, 30, 47, 6, '2013-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_comprado_clientes`
--

CREATE TABLE IF NOT EXISTS `vy_comprado_clientes` (
  `clientes_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ci` int(11) DEFAULT NULL,
  `telefono` double(20,0) DEFAULT NULL,
  `direccion` text COLLATE utf8_unicode_ci,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`clientes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `vy_comprado_clientes`
--

INSERT INTO `vy_comprado_clientes` (`clientes_id`, `nombre`, `email`, `ci`, `telefono`, `direccion`, `ip`, `fecha`) VALUES
(25, 'rafael pire', 'chocolatinas_yito@hotmail.com', 9542899, 4245289688, 'mrw\r\ncódigo agencia: 1307000\r\ndirección: av. caracas, centro empresarial caracas, p.b., local 2-b.\r\npoblación: barquisimeto\r\nestado: lara', '186.186.26.107', '2013-05-04'),
(26, 'leonard david', 'johana@localhost.com', 11111111, 222222222222, 'rubio', '::1', '2013-05-12'),
(27, 'leonard arrioja', 'johana@localhost.com', 11111111, 222222222222, 'caracas', '::1', '2013-05-22'),
(28, 'leonard', 'johana@localhost.com', 11111111, 222222222222, 'valencia', '::1', '2013-05-22'),
(29, 'johana caceres', 'johana@localhost.com', 11111111, 222222222222, 'ksk', '::1', '2013-05-22'),
(30, 'leonard', 'ledarca@localhost.com', 11111111, 222222222222, 'al', '::1', '2013-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_curso`
--

CREATE TABLE IF NOT EXISTS `vy_curso` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_vid_id` int(11) DEFAULT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  `titulo_vid` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenido_vid` text COLLATE utf8_unicode_ci,
  `fecha_publicacion_vid` date DEFAULT NULL,
  `miniatura_vid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_vid` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activar` int(1) DEFAULT NULL,
  `revista` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `revista_online` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vy_curso`
--

INSERT INTO `vy_curso` (`video_id`, `categoria_vid_id`, `comentario_id`, `titulo_vid`, `contenido_vid`, `fecha_publicacion_vid`, `miniatura_vid`, `video_vid`, `activar`, `revista`, `revista_online`, `description`, `keywords`) VALUES
(1, 1, NULL, 'dos lineas cruzado en mano primera cuarta y quinta sexta y hay es', 'VideoTutorial 5 del curso de PHP y PostgreSQL.Acá veremos la forma de conectar PHP con PostgreSQL, usando la librería PG.Desarrollaremos una clase de conexión, la cual heredaremos de otra clase para poder crear una conexión reutilizable y heredable en cualquier clase de nuestro proyecto.Usaremos las funciones nativas de PHP pg_connect,or die, pg_query, pg_fetch_assoc.   Trabajaremos en un pequeño sistema de navegación que nos permitirá ver en línea los artículos ordenados por tipo artículo.Todo en 37 minutos de charla.', '2012-08-15', 'video/photo/small/100x100/vy_100x100000010.jpg', '<iframe width="640" height="360" src="http://www.youtube.com/embed/fwK7ggA3-bU"></iframe>', 1, 'revista01.pdf', NULL, 'dos lineas cruzado en mano primera cuarta y quinta sexta y hay es', 'dos lineas cruzado en mano primera cuarta y quinta sexta y hay es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_curso_categoria`
--

CREATE TABLE IF NOT EXISTS `vy_curso_categoria` (
  `categoria_vid_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cat_vid` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `activar` int(1) DEFAULT NULL,
  PRIMARY KEY (`categoria_vid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vy_curso_categoria`
--

INSERT INTO `vy_curso_categoria` (`categoria_vid_id`, `nombre_cat_vid`, `activar`) VALUES
(1, 'alambrismo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_curso_comentario`
--

CREATE TABLE IF NOT EXISTS `vy_curso_comentario` (
  `comentario_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentario` text COLLATE utf8_unicode_ci,
  `fecha` date DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activar` int(1) DEFAULT NULL,
  PRIMARY KEY (`comentario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `vy_curso_comentario`
--

INSERT INTO `vy_curso_comentario` (`comentario_id`, `video_id`, `nombre`, `comentario`, `fecha`, `email`, `activar`) VALUES
(1, 1, 'Johana Caceres', 'Primer comentario esto es unco comentario de paa vamos a ver que coño pasaPrimer comentario esto es unco comentario de paa vamos a ver que coño pasa Primer comentario esto es unco comentario de paa vamos a ver que coño pasa', '2013-04-01', 'johana@localhost.com', 1),
(3, 1, 'Johana Caceres', 'klllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll', '2013-04-01', 'johana@localhost.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vy_newsletter`
--

CREATE TABLE IF NOT EXISTS `vy_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `vy_newsletter`
--

INSERT INTO `vy_newsletter` (`newsletter_id`, `email`, `fecha`) VALUES
(1, 'ledarca@hotmail.com', '2013-03-09'),
(2, 'ledarca@hotmail.com', '2013-03-29'),
(3, 'johana@localhost.com', '2013-03-30'),
(4, 'johana@localhost.com', '2013-03-30'),
(5, 'johana@localhost.com', '2013-03-30'),
(6, 'johana@localhost.com', '2013-03-30'),
(7, 'johana@localhost.com', '2013-03-30'),
(8, 'johana@localhost.com', '2013-03-30'),
(9, 'leonard@localhost.com', '2013-03-30'),
(10, 'leonard@localhost.com', '2013-03-30'),
(11, 'leonard@localhost.com', '2013-03-30'),
(12, 'johana@localhost.com', '2013-03-30'),
(13, 'johana@localhost.com', '2013-03-30'),
(14, 'johana@localhost.com', '2013-03-30'),
(15, 'johana@localhost.com', '2013-03-30'),
(16, 'johana@localhost.com', '2013-03-30'),
(17, 'johana@localhost.com', '2013-03-30'),
(18, 'johana@localhost.com', '2013-03-30'),
(19, 'johana@localhost.com', '2013-03-30'),
(20, 'johana@localhost.com', '2013-03-30'),
(21, 'johana@localhost.com', '2013-03-30'),
(22, 'johana@localhost.com', '2013-03-30'),
(23, 'johana@localhost.com', '2013-03-30'),
(24, 'johana@localhost.com', '2013-03-30'),
(25, 'johana@localhost.com', '2013-03-30'),
(26, 'johana@localhost.com', '2013-03-30'),
(27, 'johana@localhost.com', '2013-03-30'),
(28, 'johana@localhost.com', '2013-03-30'),
(29, 'johana@localhost.com', '2013-03-30'),
(30, 'ledarca@hotmail.com', '2013-03-30'),
(31, 'johana@localhost.com', '2013-03-30'),
(32, 'leonard@localhost.com', '2013-03-30'),
(33, 'johana@localhost.com', '2013-03-30'),
(34, 'johana@localhost.com', '2013-03-30'),
(35, 'johana@localhost.com', '2013-03-30'),
(36, 'johana@localhost.com', '2013-03-30'),
(37, 'johana@localhost.com', '2013-03-30'),
(38, 'johana@localhost.com', '2013-03-30'),
(39, 'johana@localhost.com', '2013-03-30'),
(40, 'johana@localhost.com', '2013-03-30'),
(41, 'johana@localhost.com', '2013-04-01'),
(42, 'johana@localhost.com', '2013-04-01'),
(43, 'ledarca@localhost.com', '2015-01-12'),
(44, 'ledarca@localhost.com', '2015-01-12'),
(45, 'johana@localhost.com', '2015-01-12'),
(46, 'johana@localhost.com', '2015-01-12'),
(47, 'ledarca@localhost.com', '2015-01-12'),
(48, 'ledarca@localhost.com', '2015-01-12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
