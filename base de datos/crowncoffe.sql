-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2021 a las 05:36:12
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crowncoffe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_gasto`
--

CREATE TABLE `caja_gasto` (
  `id` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_gasto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_prod_menu`
--

CREATE TABLE `categoria_prod_menu` (
  `id_cat_prod_menu` int(11) NOT NULL,
  `nombre_cat` varchar(100) NOT NULL,
  `descripcion_cat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_prod_menu`
--

INSERT INTO `categoria_prod_menu` (`id_cat_prod_menu`, `nombre_cat`, `descripcion_cat`) VALUES
(75, 'Postres', 'postre casero'),
(76, 'Bebidas', 'todo tipo de bebidas'),
(77, 'Aperitivos', 'todo tipo de comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `id_compra_prod` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `id_producto_inv` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id_compra_prod`, `cantidad`, `costo`, `id_producto_inv`, `id_compra`) VALUES
(1, 10, 4, 17, 64),
(2, 10, 4, 24, 65),
(3, 10, 2, 28, 66),
(4, 10, 5, 27, 67),
(5, 10, 1, 25, 68),
(6, 10, 4, 17, 69),
(7, 10, 1, 25, 70),
(8, 2, 1, 25, 71),
(9, 6, 5, 16, 72),
(10, 6, 4, 17, 73),
(11, 6, 12, 18, 74),
(12, 3, 1, 25, 75),
(13, 3, 1, 25, 76),
(14, 10, 1, 25, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_compra` int(11) NOT NULL,
  `proveedor` varchar(255) DEFAULT 'sin proveedor',
  `codigo` varchar(100) DEFAULT 'sin codigo',
  `descripcion` varchar(255) DEFAULT NULL,
  `origen_dinero` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL DEFAULT 1,
  `id_caja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_compra`, `proveedor`, `codigo`, `descripcion`, `origen_dinero`, `fecha`, `id_usuario`, `id_caja`) VALUES
(64, 'tienda', '2525', 'azucar compra', 1, '2021-10-17 04:08:14', 1, 60),
(65, 'tienda', '777', 'compra de harina', 1, '2021-10-17 04:08:46', 1, 60),
(66, 'tienda', '', '', 1, '2021-10-19 05:00:29', 1, 60),
(67, '', '', '', 1, '2021-10-19 05:00:40', 1, 60),
(68, '', '', '', 1, '2021-10-20 05:09:10', 1, 60),
(69, '', '', '', 1, '2021-10-20 05:09:19', 1, 60),
(70, '', '', '', 1, '2021-10-20 05:48:59', 1, 60),
(71, '', '', '', 1, '2021-10-20 06:05:43', 1, 60),
(72, '', '', '', 1, '2021-10-20 06:05:48', 1, 60),
(73, '', '', '', 1, '2021-10-20 06:05:52', 1, 60),
(74, '', '', '', 1, '2021-10-20 06:05:57', 1, 60),
(75, '', '', '', 1, '2021-10-20 06:07:48', 1, 60),
(76, '', '', '', 1, '2021-10-21 03:39:41', 1, 60),
(77, '', '', '', 1, '2021-10-23 03:17:44', 1, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id_det_orden` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `observacion` varchar(255) DEFAULT NULL,
  `id_mesa` int(11) NOT NULL,
  `estado_orden` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`id_det_orden`, `fecha`, `observacion`, `id_mesa`, `estado_orden`) VALUES
(63, '2021-10-16 22:10:44', NULL, 15, 0),
(64, '2021-10-16 22:35:08', NULL, 15, 0),
(65, '2021-10-16 23:11:59', NULL, 16, 0),
(66, '2021-10-17 11:54:26', NULL, 17, 0),
(67, '2021-10-17 16:02:43', NULL, 17, 0),
(68, '2021-10-17 16:28:18', NULL, 18, 0),
(69, '2021-10-18 22:54:35', NULL, 17, 0),
(70, '2021-10-18 23:01:39', NULL, 17, 0),
(71, '2021-10-18 23:04:49', NULL, 17, 0),
(72, '2021-10-18 23:06:29', NULL, 17, 0),
(73, '2021-10-18 23:08:40', NULL, 17, 0),
(74, '2021-10-18 23:13:06', NULL, 17, 0),
(75, '2021-10-18 23:19:24', NULL, 17, 0),
(76, '2021-10-18 23:21:12', NULL, 17, 0),
(77, '2021-10-18 23:22:43', NULL, 17, 0),
(78, '2021-10-18 23:27:47', NULL, 18, 0),
(79, '2021-10-18 23:28:45', NULL, 18, 0),
(80, '2021-10-18 23:33:44', NULL, 18, 0),
(81, '2021-10-18 23:36:45', NULL, 18, 0),
(82, '2021-10-18 23:41:54', NULL, 18, 0),
(83, '2021-10-18 23:45:44', NULL, 18, 0),
(84, '2021-10-19 18:46:51', NULL, 17, 0),
(85, '2021-10-19 22:53:40', NULL, 15, 0),
(86, '2021-10-19 23:00:35', NULL, 15, 0),
(87, '2021-10-19 23:02:34', NULL, 15, 0),
(88, '2021-10-19 23:09:35', NULL, 15, 0),
(89, '2021-10-19 23:09:43', NULL, 16, 0),
(90, '2021-10-19 23:09:52', NULL, 17, 0),
(91, '2021-10-19 23:27:15', NULL, 15, 0),
(92, '2021-10-19 23:28:23', NULL, 15, 0),
(93, '2021-10-19 23:29:49', NULL, 16, 0),
(94, '2021-10-19 23:49:11', NULL, 15, 0),
(95, '2021-10-19 23:58:07', NULL, 15, 0),
(96, '2021-10-20 00:01:13', NULL, 15, 0),
(97, '2021-10-20 00:03:26', NULL, 15, 0),
(98, '2021-10-20 00:04:16', NULL, 15, 0),
(99, '2021-10-20 00:06:17', NULL, 15, 0),
(100, '2021-10-20 00:08:02', NULL, 15, 0),
(101, '2021-10-20 01:23:58', NULL, 15, 0),
(102, '2021-10-20 21:40:02', NULL, 16, 0),
(103, '2021-10-20 22:02:51', NULL, 15, 0),
(104, '2021-10-20 23:45:39', NULL, 15, 0),
(105, '2021-10-20 23:53:53', NULL, 15, 0),
(106, '2021-10-20 23:54:39', NULL, 15, 0),
(107, '2021-10-20 23:57:55', NULL, 15, 0),
(114, '2021-10-22 21:25:46', NULL, 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra_prod_menu`
--

CREATE TABLE `extra_prod_menu` (
  `id_extra_prod_m` int(11) NOT NULL,
  `nombre_extra` varchar(255) NOT NULL,
  `costo` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `unidad_mediada` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_detalle_orden` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `observaciones` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_detalle_orden`, `id_caja`, `fecha`, `observaciones`) VALUES
(1, 63, 60, '2021-10-16 22:10:51', NULL),
(2, 66, 60, '2021-10-17 14:36:59', NULL),
(3, 68, 60, '2021-10-18 22:47:15', NULL),
(4, 67, 60, '2021-10-18 22:50:47', NULL),
(5, 69, 60, '2021-10-18 22:54:43', NULL),
(6, 70, 60, '2021-10-18 23:01:45', NULL),
(7, 71, 60, '2021-10-18 23:04:56', NULL),
(8, 72, 60, '2021-10-18 23:07:10', NULL),
(9, 73, 60, '2021-10-18 23:08:54', NULL),
(10, 74, 60, '2021-10-18 23:13:15', NULL),
(11, 75, 60, '2021-10-18 23:19:33', NULL),
(12, 76, 60, '2021-10-18 23:21:19', NULL),
(13, 77, 60, '2021-10-18 23:22:52', NULL),
(14, 78, 60, '2021-10-18 23:27:54', NULL),
(15, 79, 60, '2021-10-18 23:28:51', NULL),
(16, 80, 60, '2021-10-18 23:33:53', NULL),
(17, 81, 60, '2021-10-18 23:37:23', NULL),
(18, 82, 60, '2021-10-18 23:41:59', NULL),
(19, 84, 60, '2021-10-19 22:24:14', NULL),
(20, 83, 60, '2021-10-19 22:27:18', NULL),
(21, 64, 60, '2021-10-19 22:27:50', NULL),
(22, 65, 60, '2021-10-19 22:29:13', NULL),
(23, 85, 60, '2021-10-19 22:59:35', NULL),
(24, 86, 60, '2021-10-19 23:00:44', NULL),
(25, 86, 60, '2021-10-19 23:01:09', NULL),
(26, 87, 60, '2021-10-19 23:03:22', NULL),
(27, 87, 60, '2021-10-19 23:05:03', NULL),
(28, 87, 60, '2021-10-19 23:05:05', NULL),
(29, 88, 60, '2021-10-19 23:11:28', NULL),
(30, 88, 60, '2021-10-19 23:14:53', NULL),
(31, 88, 60, '2021-10-19 23:16:11', NULL),
(32, 89, 60, '2021-10-19 23:19:45', NULL),
(33, 90, 60, '2021-10-19 23:24:33', NULL),
(34, 90, 60, '2021-10-19 23:26:11', NULL),
(35, 91, 60, '2021-10-19 23:27:21', NULL),
(36, 92, 60, '2021-10-19 23:28:28', NULL),
(37, 93, 60, '2021-10-19 23:29:52', NULL),
(38, 93, 60, '2021-10-19 23:30:53', NULL),
(39, 93, 60, '2021-10-19 23:33:45', NULL),
(40, 93, 60, '2021-10-19 23:35:35', NULL),
(41, 93, 60, '2021-10-19 23:36:46', NULL),
(42, 93, 60, '2021-10-19 23:37:19', NULL),
(43, 93, 60, '2021-10-19 23:38:29', NULL),
(44, 93, 60, '2021-10-19 23:39:51', NULL),
(45, 94, 60, '2021-10-19 23:49:16', NULL),
(46, 94, 60, '2021-10-19 23:50:14', NULL),
(47, 94, 60, '2021-10-19 23:50:15', NULL),
(48, 95, 60, '2021-10-20 00:00:05', NULL),
(49, 96, 60, '2021-10-20 00:01:17', NULL),
(50, 97, 60, '2021-10-20 00:03:30', NULL),
(51, 98, 60, '2021-10-20 00:04:21', NULL),
(52, 99, 60, '2021-10-20 00:06:26', NULL),
(53, 100, 60, '2021-10-20 00:08:08', NULL),
(54, 101, 60, '2021-10-20 21:40:23', NULL),
(55, 102, 60, '2021-10-20 21:40:54', NULL),
(56, 103, 60, '2021-10-20 22:09:05', NULL),
(57, 104, 60, '2021-10-20 23:45:56', NULL),
(58, 105, 60, '2021-10-20 23:54:02', NULL),
(59, 106, 60, '2021-10-20 23:54:47', NULL),
(60, 107, 60, '2021-10-20 23:58:06', NULL),
(61, 114, 60, '2021-10-22 21:25:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `nombre_mesa` varchar(10) NOT NULL DEFAULT 'Mesa',
  `numero` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `nombre_mesa`, `numero`, `estado`) VALUES
(15, 'Mesa', 1, 1),
(16, 'Mesa', 2, 1),
(17, 'Mesa', 3, 1),
(18, 'Mesa', 4, 1),
(19, 'Mesa', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `Id_orden` int(11) NOT NULL,
  `mesa` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto` varchar(90) NOT NULL,
  `total` int(11) NOT NULL,
  `anexo` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ingrediente`
--

CREATE TABLE `producto_ingrediente` (
  `id_pro_ing` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `id_uni_m` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `exclusion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_ingrediente`
--

INSERT INTO `producto_ingrediente` (`id_pro_ing`, `id_producto`, `id_ingrediente`, `id_uni_m`, `cantidad`, `exclusion`) VALUES
(19, 33, 16, 4, 4, 'No'),
(20, 33, 17, 4, 8, 'No'),
(21, 33, 18, 8, 250, 'No'),
(22, 34, 19, 9, 1, 'No'),
(23, 34, 20, 9, 1, 'No'),
(24, 34, 21, 9, 1, 'No'),
(25, 34, 22, 9, 1, 'No'),
(26, 34, 23, 4, 8, 'No'),
(27, 35, 24, 5, 1, 'No'),
(28, 35, 18, 6, 1, 'No'),
(29, 35, 25, 9, 5, 'No'),
(30, 35, 17, 4, 8, 'No'),
(31, 35, 26, 4, 4, 'No'),
(32, 36, 27, 4, 8, 'No'),
(33, 36, 28, 2, 2, 'No'),
(34, 33, 25, 9, 1, 'Seleccionar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_inventario`
--

CREATE TABLE `producto_inventario` (
  `id_producto_inv` int(11) NOT NULL,
  `nombre_prod_inv` varchar(255) NOT NULL,
  `costo_prod_inv` int(11) NOT NULL,
  `precio_prod_inv` int(11) DEFAULT NULL,
  `u_medida_prod_inv` int(11) NOT NULL,
  `u_disp_prod_inv` decimal(30,25) DEFAULT 0.0000000000000000000000000,
  `u_vend_prod_inv` decimal(30,25) DEFAULT 0.0000000000000000000000000,
  `u_comp_prod_inv` decimal(30,25) DEFAULT 0.0000000000000000000000000,
  `u_elim_prod_inv` decimal(30,25) DEFAULT 0.0000000000000000000000000,
  `descrip_prod_inv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_inventario`
--

INSERT INTO `producto_inventario` (`id_producto_inv`, `nombre_prod_inv`, `costo_prod_inv`, `precio_prod_inv`, `u_medida_prod_inv`, `u_disp_prod_inv`, `u_vend_prod_inv`, `u_comp_prod_inv`, `u_elim_prod_inv`, `descrip_prod_inv`) VALUES
(16, 'Fresa', 5, NULL, 5, '3.5000000000000004000000000', '0.0000000000000000000000000', '6.0000000000000000000000000', '0.0000000000000000000000000', 'fresas por libra'),
(17, 'Azucar', 4, NULL, 5, '0.9999999999999999000000000', '0.0000000000000000000000000', '26.0000000000000000000000000', '0.0000000000000000000000000', 'libras de azucar'),
(18, 'Leche', 12, NULL, 6, '3.5000000000000000000000000', '0.0000000000000000000000000', '6.0000000000000000000000000', '0.0000000000000000000000000', 'leche liquido'),
(19, 'Pan', 1, NULL, 9, '10.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'para hamburguesa'),
(20, 'Lechuga', 5, NULL, 9, '10.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'lechuga'),
(21, 'Tomate', 1, NULL, 9, '10.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'tomate'),
(22, 'Queso', 8, NULL, 9, '10.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'queso para hamburguesa'),
(23, 'Carne Molida', 25, NULL, 5, '16.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'carne de pollo'),
(24, 'Harina', 4, NULL, 5, '15.0000000000000000000000000', '0.0000000000000000000000000', '10.0000000000000000000000000', '0.0000000000000000000000000', 'para pastel'),
(25, 'Huevos', 1, NULL, 9, '8.0000000000000000000000000', '0.0000000000000000000000000', '38.0000000000000000000000000', '0.0000000000000000000000000', 'huevos'),
(26, 'Glacear', 8, NULL, 2, '400.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', '0.0000000000000000000000000', 'glacear'),
(27, 'papas', 5, NULL, 5, '16.0000000000000000000000000', '0.0000000000000000000000000', '10.0000000000000000000000000', '0.0000000000000000000000000', 'papas'),
(28, 'sal', 2, NULL, 5, '33.0000000000000000000000000', '0.0000000000000000000000000', '10.0000000000000000000000000', '0.0000000000000000000000000', 'sal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_menu`
--

CREATE TABLE `producto_menu` (
  `id_producto_m` int(11) NOT NULL,
  `nombre_prod_m` varchar(255) NOT NULL,
  `costo_prod_m` int(11) DEFAULT NULL,
  `precio_prod_m` int(11) NOT NULL,
  `id_uni_m` int(11) DEFAULT NULL,
  `estado_prod_m` int(11) DEFAULT 1,
  `visible_prod_m` int(11) DEFAULT 1,
  `tmprepa_prod_m` varchar(255) DEFAULT NULL,
  `descrip_prod_m` varchar(255) NOT NULL,
  `id_cat_prod_menu` int(11) NOT NULL,
  `img` mediumblob DEFAULT NULL,
  `nombre_img` varchar(100) DEFAULT NULL,
  `tipo_img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_menu`
--

INSERT INTO `producto_menu` (`id_producto_m`, `nombre_prod_m`, `costo_prod_m`, `precio_prod_m`, `id_uni_m`, `estado_prod_m`, `visible_prod_m`, `tmprepa_prod_m`, `descrip_prod_m`, `id_cat_prod_menu`, `img`, `nombre_img`, `tipo_img`) VALUES
(33, 'Licuado De Fresa', NULL, 25, NULL, 1, 1, '5 min', 'licuado', 76, 0x496d6167656e65735f4e75657661732f366537396566663539662e706e67, 'Imagenes_Nuevas/6e79eff59f.png', 'image/png'),
(34, 'hamburguesa', NULL, 35, NULL, 1, 1, '25 mins', 'hamburguesa', 77, 0x496d6167656e65735f4e75657661732f363365373764623830372e6a7067, 'Imagenes_Nuevas/63e77db807.jpg', 'image/jpeg'),
(35, 'Pastel De Chocolate', NULL, 12, NULL, 1, 1, '5 min', 'pasteles', 75, 0x496d6167656e65735f4e75657661732f393030333133663563622e6a7067, 'Imagenes_Nuevas/900313f5cb.jpg', 'image/jpeg'),
(36, 'Papas', NULL, 15, NULL, 1, 1, '10 mins', 'papas fritas', 77, 0x496d6167656e65735f4e75657661732f343364663162303636312e6a7067, 'Imagenes_Nuevas/43df1b0661.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcajaefectivo`
--

CREATE TABLE `tbcajaefectivo` (
  `id` int(11) NOT NULL,
  `efectivo` int(11) NOT NULL,
  `usuarioinicio` varchar(250) DEFAULT NULL,
  `hora_apertura` time NOT NULL,
  `usuariofin` varchar(250) DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbcajaefectivo`
--

INSERT INTO `tbcajaefectivo` (`id`, `efectivo`, `usuarioinicio`, `hora_apertura`, `usuariofin`, `hora_cierre`, `fecha`, `estado`) VALUES
(60, 500, 'admin', '02:13:12', 'admin', '06:31:51', '2021-10-17', 1),
(61, 100, 'admin', '06:27:56', 'admin', '06:30:32', '2021-10-17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbgastos`
--

CREATE TABLE `tbgastos` (
  `id` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `Tipo_Transaccion` varchar(300) NOT NULL DEFAULT 'gasto',
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toma_orden`
--

CREATE TABLE `toma_orden` (
  `id_orden` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `id_producto_m` int(11) DEFAULT NULL,
  `nombre_prod_m` varchar(100) DEFAULT NULL,
  `id_det_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `toma_orden`
--

INSERT INTO `toma_orden` (`id_orden`, `cantidad`, `precio`, `id_producto_m`, `nombre_prod_m`, `id_det_orden`) VALUES
(1, 4, 25, 33, 'Licuado De', 63),
(2, 2, 35, 34, 'hamburgues', 64),
(3, 4, 35, 34, 'hamburgues', 65),
(4, 2, 25, 33, 'Licuado De', 66),
(5, 1, 12, 35, 'Pastel De ', 66),
(6, 1, 35, 34, 'hamburgues', 66),
(7, 1, 15, 36, 'Papas', 67),
(8, 2, 15, 36, 'Papas', 68),
(9, 1, 15, 36, 'Papas', 69),
(10, 1, 15, 36, 'Papas', 70),
(11, 1, 15, 36, 'Papas', 71),
(12, 1, 15, 36, 'Papas', 72),
(13, 1, 15, 36, 'Papas', 73),
(14, 1, 15, 36, 'Papas', 74),
(15, 1, 15, 36, 'Papas', 75),
(16, 1, 15, 36, 'Papas', 76),
(17, 1, 15, 36, 'Papas', 77),
(18, 1, 15, 36, 'Papas', 78),
(19, 1, 15, 36, 'Papas', 79),
(20, 1, 15, 36, 'Papas', 80),
(21, 1, 15, 36, 'Papas', 81),
(22, 1, 15, 36, 'Papas', 82),
(23, 1, 15, 36, 'Papas', 83),
(24, 1, 25, 33, 'Licuado De Fresa', 84),
(25, 2, 25, 33, 'Licuado De Fresa', 85),
(26, 1, 25, 33, 'Licuado De Fresa', 86),
(27, 1, 25, 33, 'Licuado De Fresa', 87),
(28, 1, 25, 33, 'Licuado De Fresa', 88),
(29, 1, 25, 33, 'Licuado De Fresa', 89),
(30, 1, 25, 33, 'Licuado De Fresa', 90),
(31, 1, 25, 33, 'Licuado De Fresa', 91),
(32, 1, 25, 33, 'Licuado De Fresa', 92),
(33, 1, 25, 33, 'Licuado De Fresa', 93),
(34, 1, 25, 33, 'Licuado De Fresa', 94),
(35, 1, 25, 33, 'Licuado De Fresa', 95),
(36, 1, 25, 33, 'Licuado De Fresa', 96),
(37, 1, 25, 33, 'Licuado De Fresa', 97),
(38, 1, 25, 33, 'Licuado De Fresa', 98),
(39, 3, 25, 33, 'Licuado De Fresa', 99),
(40, 3, 25, 33, 'Licuado De Fresa', 100),
(41, 1, 25, 33, 'Licuado De Fresa', 101),
(42, 2, 25, 33, 'Licuado De Fresa', 102),
(43, 1, 25, 33, 'Licuado De Fresa', 103),
(44, 1, 25, 33, 'Licuado De Fresa', 104),
(45, 1, 25, 33, 'Licuado De Fresa', 105),
(46, 1, 25, 33, 'Licuado De Fresa', 106),
(47, 1, 25, 33, 'Licuado De Fresa', 107),
(54, 1, 25, 33, 'Licuado De Fresa', 114);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_uni_m` int(11) NOT NULL,
  `nombre_uni` varchar(100) NOT NULL,
  `simbolo_uni` varchar(50) NOT NULL,
  `tipo_uni` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_uni_m`, `nombre_uni`, `simbolo_uni`, `tipo_uni`) VALUES
(1, 'Kilogramo', 'kg', 'masa'),
(2, 'gramo', 'g', 'masa'),
(3, 'miligramo', 'mg', 'masa'),
(4, 'onza', 'oz', 'masa'),
(5, 'libra', 'lb', 'masa'),
(6, 'litro', 'l', 'volumen'),
(7, 'galon', 'gl', 'volumen'),
(8, 'Mililitro', 'ml', 'volumen'),
(9, 'Unidad', 'ud', 'unidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `permiso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `contraseña`, `permiso`) VALUES
(1, 'admin', '123', 'Administrador'),
(3, 'aux', '123', 'Auxiliar'),
(4, 'admin2', '123', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_gasto`
--
ALTER TABLE `caja_gasto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_caja` (`id_caja`),
  ADD KEY `id_gasto` (`id_gasto`);

--
-- Indices de la tabla `categoria_prod_menu`
--
ALTER TABLE `categoria_prod_menu`
  ADD PRIMARY KEY (`id_cat_prod_menu`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`id_compra_prod`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto_inv` (`id_producto_inv`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id_det_orden`),
  ADD KEY `id_mesa` (`id_mesa`);

--
-- Indices de la tabla `extra_prod_menu`
--
ALTER TABLE `extra_prod_menu`
  ADD PRIMARY KEY (`id_extra_prod_m`),
  ADD KEY `unidad_mediada` (`unidad_mediada`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_detalle_orden` (`id_detalle_orden`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`Id_orden`);

--
-- Indices de la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  ADD PRIMARY KEY (`id_pro_ing`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_ingrediente` (`id_ingrediente`),
  ADD KEY `id_uni_m` (`id_uni_m`);

--
-- Indices de la tabla `producto_inventario`
--
ALTER TABLE `producto_inventario`
  ADD PRIMARY KEY (`id_producto_inv`),
  ADD KEY `u_medida_prod_inv` (`u_medida_prod_inv`);

--
-- Indices de la tabla `producto_menu`
--
ALTER TABLE `producto_menu`
  ADD PRIMARY KEY (`id_producto_m`),
  ADD KEY `id_uni_m` (`id_uni_m`),
  ADD KEY `id_cat_prod_menu` (`id_cat_prod_menu`);

--
-- Indices de la tabla `tbcajaefectivo`
--
ALTER TABLE `tbcajaefectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbgastos`
--
ALTER TABLE `tbgastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `toma_orden`
--
ALTER TABLE `toma_orden`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_producto_m` (`nombre_prod_m`,`id_det_orden`),
  ADD KEY `id_det_orden` (`id_det_orden`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_uni_m`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_gasto`
--
ALTER TABLE `caja_gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_prod_menu`
--
ALTER TABLE `categoria_prod_menu`
  MODIFY `id_cat_prod_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `id_compra_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_det_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `extra_prod_menu`
--
ALTER TABLE `extra_prod_menu`
  MODIFY `id_extra_prod_m` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `Id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  MODIFY `id_pro_ing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `producto_inventario`
--
ALTER TABLE `producto_inventario`
  MODIFY `id_producto_inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `producto_menu`
--
ALTER TABLE `producto_menu`
  MODIFY `id_producto_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbcajaefectivo`
--
ALTER TABLE `tbcajaefectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tbgastos`
--
ALTER TABLE `tbgastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `toma_orden`
--
ALTER TABLE `toma_orden`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id_uni_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja_gasto`
--
ALTER TABLE `caja_gasto`
  ADD CONSTRAINT `caja_gasto_ibfk_1` FOREIGN KEY (`id_caja`) REFERENCES `tbcajaefectivo` (`id`),
  ADD CONSTRAINT `caja_gasto_ibfk_2` FOREIGN KEY (`id_gasto`) REFERENCES `tbgastos` (`id`);

--
-- Filtros para la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD CONSTRAINT `compra_producto_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `detalle_compra` (`id_compra`),
  ADD CONSTRAINT `compra_producto_ibfk_2` FOREIGN KEY (`id_producto_inv`) REFERENCES `producto_inventario` (`id_producto_inv`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_caja`) REFERENCES `tbcajaefectivo` (`id`);

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `detalle_orden_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`);

--
-- Filtros para la tabla `extra_prod_menu`
--
ALTER TABLE `extra_prod_menu`
  ADD CONSTRAINT `extra_prod_menu_ibfk_1` FOREIGN KEY (`unidad_mediada`) REFERENCES `unidad_medida` (`id_uni_m`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_detalle_orden`) REFERENCES `detalle_orden` (`id_det_orden`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_caja`) REFERENCES `tbcajaefectivo` (`id`);

--
-- Filtros para la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  ADD CONSTRAINT `producto_ingrediente_ibfk_1` FOREIGN KEY (`id_ingrediente`) REFERENCES `producto_inventario` (`id_producto_inv`),
  ADD CONSTRAINT `producto_ingrediente_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto_menu` (`id_producto_m`),
  ADD CONSTRAINT `producto_ingrediente_ibfk_3` FOREIGN KEY (`id_uni_m`) REFERENCES `unidad_medida` (`id_uni_m`);

--
-- Filtros para la tabla `producto_inventario`
--
ALTER TABLE `producto_inventario`
  ADD CONSTRAINT `producto_inventario_ibfk_1` FOREIGN KEY (`u_medida_prod_inv`) REFERENCES `unidad_medida` (`id_uni_m`);

--
-- Filtros para la tabla `producto_menu`
--
ALTER TABLE `producto_menu`
  ADD CONSTRAINT `producto_menu_ibfk_1` FOREIGN KEY (`id_uni_m`) REFERENCES `unidad_medida` (`id_uni_m`),
  ADD CONSTRAINT `producto_menu_ibfk_2` FOREIGN KEY (`id_cat_prod_menu`) REFERENCES `categoria_prod_menu` (`id_cat_prod_menu`);

--
-- Filtros para la tabla `toma_orden`
--
ALTER TABLE `toma_orden`
  ADD CONSTRAINT `toma_orden_ibfk_3` FOREIGN KEY (`id_det_orden`) REFERENCES `detalle_orden` (`id_det_orden`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
