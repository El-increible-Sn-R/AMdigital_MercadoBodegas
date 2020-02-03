-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-02-2020 a las 19:58:49
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `z_mercadobodegas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(144, '2020_01_10_005332_create_usuarios_table', 1),
(145, '2020_01_10_005416_create_empresas_table', 1),
(146, '2020_01_10_005448_create_locales_table', 1),
(147, '2020_01_10_005530_create_galerias_table', 1),
(148, '2020_01_10_005648_create_grupocaracteriticas_table', 1),
(149, '2020_01_10_005742_create_caracteriticaslocal_table', 1),
(150, '2020_01_10_005854_create_localcaracteristicas_table', 1),
(151, '2020_01_10_005938_create_unidades_table', 1),
(152, '2020_01_10_010043_create_caracteristicasunidad_table', 1),
(153, '2020_01_10_010221_create_unidadcaracteristicas_table', 1),
(154, '2020_01_10_010313_create_reservas_table', 1),
(155, '2020_01_10_010400_create_visitas_table', 1),
(156, '2020_01_10_010417_create_horario_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_caracteriticaslocal`
--

DROP TABLE IF EXISTS `t_caracteriticaslocal`;
CREATE TABLE IF NOT EXISTS `t_caracteriticaslocal` (
  `caracteristicasLocal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caracteristicasLocal_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`caracteristicasLocal_id`),
  KEY `t_caracteriticaslocal_grupo_id_foreign` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_caracteriticaslocal`
--

INSERT INTO `t_caracteriticaslocal` (`caracteristicasLocal_id`, `caracteristicasLocal_nombre`, `grupo_id`) VALUES
(1, 'Acepta Tarjeta De Crédito', 1),
(2, 'Acepta Cheques', 1),
(3, 'Acepta Efectivo', 1),
(4, 'Acepta Transferencias', 1),
(5, 'Pagos Automatizados', 1),
(6, 'Pago El Primer Día De Cada Mes', 1),
(7, 'Exige Mes De Garantía', 1),
(8, 'Cámaras De Vigilancia', 2),
(9, 'Alarma', 2),
(10, 'Guardia', 2),
(11, 'Guardia 24/7', 2),
(12, 'Cerco Eléctrico', 2),
(13, 'Puerta De Entrada De Acceso Electrónico', 3),
(14, 'Acceso 24 Horas', 3),
(15, 'Debe Coordinar Visita Con Anticipación', 3),
(16, 'Incluye Seguro', 4),
(17, 'Seguro Disponible', 4),
(18, 'Cuenta Con Ascensor', 5),
(19, 'Cuenta Con Grúa Horquilla Motorizada', 5),
(20, 'Cuenta Con Grúa Horquilla Manual', 5),
(21, 'Indoor', 6),
(22, 'Outdoor', 6),
(23, 'Acepta Tarjeta De Crédito', 1),
(24, 'Outdoor', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_caracteriticasunidad`
--

DROP TABLE IF EXISTS `t_caracteriticasunidad`;
CREATE TABLE IF NOT EXISTS `t_caracteriticasunidad` (
  `caracteristicasUnidad_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caracteristicasUnidad_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`caracteristicasUnidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empresas`
--

DROP TABLE IF EXISTS `t_empresas`;
CREATE TABLE IF NOT EXISTS `t_empresas` (
  `empresa_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `empresa_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_estaBorrado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `empresa_pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_comuna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`empresa_id`),
  KEY `t_empresas_usuario_id_foreign` (`usuario_id`)
) ;

--
-- Volcado de datos para la tabla `t_empresas`
--

INSERT INTO `t_empresas` (`empresa_id`, `empresa_nombre`, `empresa_estaBorrado`, `empresa_pais`, `empresa_region`, `empresa_comuna`, `usuario_id`) VALUES
(1, 'empresa de prueba uno', 'n', 'Perú', 'Arequipa', 'Arequipa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_galeria`
--

DROP TABLE IF EXISTS `t_galeria`;
CREATE TABLE IF NOT EXISTS `t_galeria` (
  `galeria_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `galeria_coleccion_orden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`galeria_id`),
  KEY `t_galeria_local_id_foreign` (`local_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_grupocaracteristicas`
--

DROP TABLE IF EXISTS `t_grupocaracteristicas`;
CREATE TABLE IF NOT EXISTS `t_grupocaracteristicas` (
  `grupo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grupo_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_grupocaracteristicas`
--

INSERT INTO `t_grupocaracteristicas` (`grupo_id`, `grupo_nombre`) VALUES
(1, 'pagos'),
(2, 'seguridad'),
(3, 'acceso'),
(4, 'cobertura'),
(5, 'servicios adicionales'),
(6, 'tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_horario`
--

DROP TABLE IF EXISTS `t_horario`;
CREATE TABLE IF NOT EXISTS `t_horario` (
  `horario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `horario_horaEntrada` time NOT NULL,
  `horario_horaSalida` time NOT NULL,
  `horario_tipo` enum('o','a') COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  `horario_dia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`horario_id`),
  KEY `t_horario_local_id_foreign` (`local_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_horario`
--

INSERT INTO `t_horario` (`horario_id`, `horario_horaEntrada`, `horario_horaSalida`, `horario_tipo`, `local_id`, `horario_dia`) VALUES
(1, '08:00:00', '19:00:00', 'o', 1, 'lunes'),
(2, '08:00:00', '19:00:00', 'o', 1, 'martes'),
(3, '08:00:00', '19:00:00', 'o', 1, 'miercoles'),
(4, '08:00:00', '19:00:00', 'o', 1, 'jueves'),
(5, '08:00:00', '19:00:00', 'o', 1, 'viernes'),
(6, '08:00:00', '19:00:00', 'o', 1, 'sabado'),
(7, '08:00:00', '19:00:00', 'o', 1, 'domingo'),
(8, '08:00:00', '19:00:00', 'a', 1, 'lunes'),
(9, '08:00:00', '19:00:00', 'a', 1, 'martes'),
(10, '08:00:00', '19:00:00', 'a', 1, 'miercoles'),
(11, '08:00:00', '19:00:00', 'a', 1, 'jueves'),
(12, '08:00:00', '19:00:00', 'a', 1, 'viernes'),
(13, '08:00:00', '19:00:00', 'a', 1, 'sabado'),
(14, '08:00:00', '19:00:00', 'a', 1, 'domingo'),
(15, '07:00:00', '18:00:00', 'o', 2, 'lunes'),
(16, '07:00:00', '18:00:00', 'o', 2, 'martes'),
(17, '07:00:00', '18:00:00', 'o', 2, 'miercoles'),
(18, '07:00:00', '18:00:00', 'o', 2, 'jueves'),
(19, '07:00:00', '18:00:00', 'o', 2, 'viernes'),
(20, '07:00:00', '18:00:00', 'a', 2, 'lunes'),
(21, '07:00:00', '18:00:00', 'a', 2, 'martes'),
(22, '07:00:00', '18:00:00', 'a', 2, 'miercoles'),
(23, '07:00:00', '18:00:00', 'a', 2, 'jueves'),
(24, '07:00:00', '18:00:00', 'a', 2, 'viernes'),
(25, '08:00:00', '16:00:00', 'o', 3, 'lunes'),
(26, '08:00:00', '16:00:00', 'o', 3, 'martes'),
(27, '07:00:00', '19:00:00', 'o', 3, 'miercoles'),
(28, '07:00:00', '19:00:00', 'o', 3, 'jueves'),
(29, '07:00:00', '19:00:00', 'o', 3, 'viernes'),
(30, '13:00:00', '18:00:00', 'o', 3, 'sabado'),
(31, '13:00:00', '18:00:00', 'o', 3, 'domingo'),
(32, '10:00:00', '12:30:00', 'a', 3, 'lunes'),
(33, '08:00:00', '13:00:00', 'a', 3, 'martes'),
(34, '09:00:00', '18:00:00', 'a', 3, 'miercoles'),
(35, '18:00:00', '22:00:00', 'a', 3, 'jueves'),
(36, '05:00:00', '12:00:00', 'a', 3, 'viernes'),
(37, '05:00:00', '17:00:00', 'a', 3, 'sabado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_localcaracteriticas`
--

DROP TABLE IF EXISTS `t_localcaracteriticas`;
CREATE TABLE IF NOT EXISTS `t_localcaracteriticas` (
  `localCaracteristicas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caracteristicasLocal_id` bigint(20) UNSIGNED NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`localCaracteristicas_id`),
  KEY `t_localcaracteriticas_local_id_foreign` (`local_id`),
  KEY `t_localcaracteriticas_caracteristicaslocal_id_foreign` (`caracteristicasLocal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_localcaracteriticas`
--

INSERT INTO `t_localcaracteriticas` (`localCaracteristicas_id`, `caracteristicasLocal_id`, `local_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 5, 1),
(5, 8, 1),
(6, 9, 1),
(7, 11, 1),
(8, 13, 1),
(9, 14, 1),
(10, 16, 1),
(11, 18, 1),
(12, 19, 1),
(13, 20, 1),
(14, 21, 1),
(15, 1, 2),
(16, 2, 2),
(17, 3, 2),
(18, 5, 2),
(19, 8, 2),
(20, 9, 2),
(21, 11, 2),
(22, 13, 2),
(23, 14, 2),
(24, 16, 2),
(25, 18, 2),
(26, 19, 2),
(27, 20, 2),
(28, 1, 3),
(29, 2, 3),
(30, 1, 1),
(31, 2, 1),
(32, 3, 1),
(33, 5, 1),
(34, 8, 1),
(35, 9, 1),
(36, 11, 1),
(37, 13, 1),
(38, 14, 1),
(39, 16, 1),
(40, 18, 1),
(41, 19, 1),
(42, 20, 1),
(43, 21, 1),
(44, 1, 2),
(45, 2, 2),
(46, 3, 2),
(47, 5, 2),
(48, 8, 2),
(49, 9, 2),
(50, 11, 2),
(51, 13, 2),
(52, 14, 2),
(53, 16, 2),
(54, 18, 2),
(55, 19, 2),
(56, 20, 2),
(57, 1, 3),
(58, 2, 3),
(59, 3, 3),
(60, 4, 3),
(61, 5, 3),
(62, 6, 3),
(63, 7, 3),
(64, 8, 3),
(65, 9, 3),
(66, 10, 3),
(67, 11, 3),
(68, 12, 3),
(69, 13, 3),
(70, 14, 3),
(71, 16, 3),
(72, 18, 3),
(73, 19, 3),
(74, 22, 3),
(75, 1, 5),
(76, 8, 5),
(77, 13, 5),
(78, 16, 5),
(79, 21, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_locales`
--

DROP TABLE IF EXISTS `t_locales`;
CREATE TABLE IF NOT EXISTS `t_locales` (
  `local_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `local_telefono` bigint(20) UNSIGNED NOT NULL,
  `local_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_comuna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `local_latitud` double NOT NULL,
  `local_longitud` double NOT NULL,
  `local_nDiasDeReserva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_estaBorrado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`local_id`),
  KEY `t_locales_empresa_id_foreign` (`empresa_id`),
  KEY `t_locales_usuario_id_foreign` (`usuario_id`)
) ;

--
-- Volcado de datos para la tabla `t_locales`
--

INSERT INTO `t_locales` (`local_id`, `local_nombre`, `local_descripcion`, `empresa_id`, `local_telefono`, `local_email`, `local_pais`, `local_region`, `local_comuna`, `local_direccion`, `usuario_id`, `local_latitud`, `local_longitud`, `local_nDiasDeReserva`, `local_estaBorrado`) VALUES
(1, 'local de prueba uno', 'descripcion', 1, 111111111, 'emailDelLocal@algo.algo', 'Perú', 'Arequipa', 'Arequipa', 'Argentina 126, Arequipa 04004, Perú', 1, -16.382547, -71.519298, '20', 'n'),
(2, 'local de prueba dos', 'descripcion', 1, 222222222, 'emailDelLocalDos@algo.algo', 'Chile', 'Bío Bío', 'Concepción', 'Diego de Almagro 640-672, Concepción, Bío Bío, Chile', 1, -36.807547, -73.066322, '20', 'n'),
(3, 'local de prueba tres', 'descripcion', 1, 333333333, 'emailDePrueb@algo.algo', 'Chile', 'Santiago', 'La Granja', 'Veintiocho Ote 6465-6499, La Granja, Región Metropolitana, Chile', 1, -33.518138, -70.61986, '20', 'n'),
(4, 'local de prueba cuatro', 'descripcion', 1, 444444444, 'esteEmailNoExiste@local4.com', 'Chile', 'Santiago', 'Pudahuel', 'Dillu 267-291, Pudahuel, Región Metropolitana, Chile', 1, -33.462733, -70.742522, '20', 'n'),
(5, 'local de prueba cinco', 'descripcion', 1, 555555555, 'local__5@algo.algo', 'Chile', 'Arica y Parinacota', 'Arica', 'Alejandro Azolas 2364, Arica, Arica y Parinacota, Chile', 1, -18.470816, -70.296328, '20', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reservas`
--

DROP TABLE IF EXISTS `t_reservas`;
CREATE TABLE IF NOT EXISTS `t_reservas` (
  `reserva_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reserva_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserva_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserva_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserva_telefono` bigint(20) NOT NULL,
  `reserva_fechaRegistro` datetime NOT NULL DEFAULT '2020-01-29 15:35:38',
  `reserva_fechaMudanza` date DEFAULT '2020-01-29',
  `reserva_estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'o',
  `reserva_estaBorrado` enum('s','n') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `unidad_id` bigint(20) UNSIGNED NOT NULL,
  `reserva_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserva_token_edition` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`reserva_id`),
  KEY `t_reservas_unidad_id_foreign` (`unidad_id`)
) ;

--
-- Volcado de datos para la tabla `t_reservas`
--

INSERT INTO `t_reservas` (`reserva_id`, `reserva_nombre`, `reserva_apellido`, `reserva_email`, `reserva_telefono`, `reserva_fechaRegistro`, `reserva_fechaMudanza`, `reserva_estado`, `reserva_estaBorrado`, `unidad_id`, `reserva_codigo`, `reserva_token_edition`) VALUES
(1, 'niko', 'bellic', 'nikoBellic@gmail.com', 11111111, '2020-01-29 10:37:22', '2020-02-06', 'o', 'n', 2, 'Q2OOLS5Z', '281bd29a44e3da06e769ad79694a53f1'),
(2, 'tomy', 'vercetty', 'to_ver@gmail.com', 222222222, '2020-01-29 15:35:38', '2020-01-30', 'o', 'n', 3, '081IUTYK', '43f383da2df0a0e3f042b5c5bca00f9b'),
(3, 'carl', 'jhonson', 'cj_master@hotmail.com', 333333333, '2020-01-29 15:35:38', '2020-02-07', 'o', 'n', 2, 'UIB2I7S8', '0aa5354a13b49920cca9b31474eacf63'),
(4, 'marco', 'arriaga', 'marco.arriaga@outlook.com', 444444444, '2020-01-29 15:35:38', '2020-01-29', 'o', 's', 1, '1LP0D3ZG', '4597730ad8d39ff104f6460ed59cc1b1'),
(5, 'marcos', 'aguilar', 'ma.agui.esteban@isur.edu.pe', 555555555, '2020-01-29 15:35:38', '2020-01-29', 'o', 's', 4, 'T188VFB7', 'e6a505e0cfd9376725af6dcde4f85317'),
(6, 'string', 'string', 'string', 75757657, '2020-01-29 15:35:38', '2020-03-01', 'o', 'n', 1, 'BC8YTIQ6', 'gaaaaaaaa'),
(7, 'prueba', 'prueba', 'adfa@dfsdf', 33333, '2020-01-29 15:35:38', '2020-03-01', 'o', 'n', 5, 'XSVP8RGT', 'gaaaaaaaa'),
(8, 'string', 'string', 'string@wwww', 75757657, '2020-01-29 15:35:38', '2020-05-01', 'o', 'n', 3, 'A9GO316R', 'gaaaaaaaa'),
(9, 'string', 'string', 'rando,@gmal.com', 555333555, '2020-01-29 15:35:38', '2020-08-01', 'o', 'n', 5, 'T4CKA8M2', 'gaaaaaaaa'),
(10, 'string', 'string', 'tttttttt@gmal.com', 555333555, '2020-01-29 15:35:38', '2020-12-01', 'o', 'n', 2, '31WEFSPJ', 'gaaaaaaaa'),
(11, 'noFuncionan', 'losCORS', 'CorreoFalso@outlook.com', 987322115, '2020-01-29 15:35:38', '2020-02-13', 'o', 'n', 1, '2ZOC0UAT', 'gaaaaaaaa'),
(12, 'prueba', 'prueba', 'adfa@dfsdf', 33333, '2020-01-29 15:35:38', '2020-03-04', 'o', 'n', 5, 'VXY63M24', 'gaaaaaaaa'),
(13, 'prueba', 'prueba', 'adfa@dfsdf', 33333, '2020-01-29 15:35:38', '2020-03-04', 'o', 'n', 3, 'DFGPCKSB', 'gaaaaaaaa'),
(14, 'Jose', 'Duda', 'adfa@dfsdf', 959356546, '2020-01-29 15:35:38', '2020-02-03', 'o', 'n', 5, '61E7PLR8', 'gaaaaaaaa'),
(15, 'strinasdasdadsasdasdasdasdg', 'stringasasdasddadasdasd', 'stringasdaasdasdasdasdasd', 11111, '2020-01-29 15:35:38', '2023-03-01', 'o', 'n', 2, 'SN6M4OJ0', 'gaaaaaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_unidadcaracteriticas`
--

DROP TABLE IF EXISTS `t_unidadcaracteriticas`;
CREATE TABLE IF NOT EXISTS `t_unidadcaracteriticas` (
  `unidadCaracteristicas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unidad_id` bigint(20) UNSIGNED NOT NULL,
  `caracteristicasUnidad_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`unidadCaracteristicas_id`),
  KEY `t_unidadcaracteriticas_unidad_id_foreign` (`unidad_id`),
  KEY `t_unidadcaracteriticas_caracteristicasunidad_id_foreign` (`caracteristicasUnidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_unidades`
--

DROP TABLE IF EXISTS `t_unidades`;
CREATE TABLE IF NOT EXISTS `t_unidades` (
  `unidad_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unidad_precioMensual` decimal(9,2) NOT NULL,
  `unidad_area` int(11) NOT NULL,
  `unidad_oferta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  `unidad_estaBorrado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `unidad_estaDisponible` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd',
  PRIMARY KEY (`unidad_id`),
  KEY `t_unidades_local_id_foreign` (`local_id`)
) ;

--
-- Volcado de datos para la tabla `t_unidades`
--

INSERT INTO `t_unidades` (`unidad_id`, `unidad_precioMensual`, `unidad_area`, `unidad_oferta`, `local_id`, `unidad_estaBorrado`, `unidad_estaDisponible`) VALUES
(1, '70.00', 5, 'oferton de la unidad 1', 2, 'n', 'd'),
(2, '160.00', 15, 'oferton de la unidad 2', 1, 'n', 'd'),
(3, '500.00', 25, 'oferton de la unidad 3', 1, 'n', 'd'),
(4, '100.00', 7, 'oferton de la unidad 4', 1, 'n', 'd'),
(5, '120.00', 10, 'oferton de la unidad 5', 3, 'n', 'd'),
(6, '300.00', 5, 'oferton de la unidad 6', 3, 'n', 'd'),
(7, '300.00', 5, 'oferton de la unidad 7', 1, 'n', 'd'),
(8, '150.00', 15, 'oferton de la unidad 8', 5, 'n', 'd'),
(9, '160.00', 15, 'oferton de la unidad 9', 5, 'n', 'd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

DROP TABLE IF EXISTS `t_usuarios`;
CREATE TABLE IF NOT EXISTS `t_usuarios` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_telefono` bigint(20) UNSIGNED NOT NULL,
  `usuario_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_contrasenia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_tipo` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_login`, `usuario_contrasenia`, `usuario_imagen`, `usuario_tipo`) VALUES
(1, 'karol', 'Goptila', 945678345, 'karolGoptila', 'contrasenia', NULL, 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_visitas`
--

DROP TABLE IF EXISTS `t_visitas`;
CREATE TABLE IF NOT EXISTS `t_visitas` (
  `visitas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `visitas_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitas_fecha` datetime NOT NULL DEFAULT '2020-01-29 00:00:00',
  `visitas_hora` time NOT NULL DEFAULT '15:35:41',
  `local_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`visitas_id`),
  KEY `t_visitas_local_id_foreign` (`local_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_caracteriticaslocal`
--
ALTER TABLE `t_caracteriticaslocal`
  ADD CONSTRAINT `t_caracteriticaslocal_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `t_grupocaracteristicas` (`grupo_id`);

--
-- Filtros para la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD CONSTRAINT `t_empresas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `t_usuarios` (`usuario_id`);

--
-- Filtros para la tabla `t_galeria`
--
ALTER TABLE `t_galeria`
  ADD CONSTRAINT `t_galeria_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);

--
-- Filtros para la tabla `t_horario`
--
ALTER TABLE `t_horario`
  ADD CONSTRAINT `t_horario_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);

--
-- Filtros para la tabla `t_localcaracteriticas`
--
ALTER TABLE `t_localcaracteriticas`
  ADD CONSTRAINT `t_localcaracteriticas_caracteristicaslocal_id_foreign` FOREIGN KEY (`caracteristicasLocal_id`) REFERENCES `t_caracteriticaslocal` (`caracteristicasLocal_id`),
  ADD CONSTRAINT `t_localcaracteriticas_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);

--
-- Filtros para la tabla `t_locales`
--
ALTER TABLE `t_locales`
  ADD CONSTRAINT `t_locales_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `t_empresas` (`empresa_id`),
  ADD CONSTRAINT `t_locales_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `t_usuarios` (`usuario_id`);

--
-- Filtros para la tabla `t_reservas`
--
ALTER TABLE `t_reservas`
  ADD CONSTRAINT `t_reservas_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `t_unidades` (`unidad_id`);

--
-- Filtros para la tabla `t_unidadcaracteriticas`
--
ALTER TABLE `t_unidadcaracteriticas`
  ADD CONSTRAINT `t_unidadcaracteriticas_caracteristicasunidad_id_foreign` FOREIGN KEY (`caracteristicasUnidad_id`) REFERENCES `t_caracteriticasunidad` (`caracteristicasUnidad_id`),
  ADD CONSTRAINT `t_unidadcaracteriticas_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `t_unidades` (`unidad_id`);

--
-- Filtros para la tabla `t_unidades`
--
ALTER TABLE `t_unidades`
  ADD CONSTRAINT `t_unidades_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);

--
-- Filtros para la tabla `t_visitas`
--
ALTER TABLE `t_visitas`
  ADD CONSTRAINT `t_visitas_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
