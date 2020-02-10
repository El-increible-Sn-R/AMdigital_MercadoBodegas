-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-02-2020 a las 20:28:57
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2020_01_10_005332_create_usuarios_table', 1),
(28, '2020_01_10_005416_create_empresas_table', 1),
(29, '2020_01_10_005448_create_locales_table', 1),
(30, '2020_01_10_005530_create_galerias_table', 1),
(31, '2020_01_10_005648_create_grupocaracteriticas_table', 1),
(32, '2020_01_10_005742_create_caracteriticaslocal_table', 1),
(33, '2020_01_10_005854_create_localcaracteristicas_table', 1),
(34, '2020_01_10_005938_create_unidades_table', 1),
(35, '2020_01_10_010043_create_caracteristicasunidad_table', 1),
(36, '2020_01_10_010221_create_unidadcaracteristicas_table', 1),
(37, '2020_01_10_010313_create_reservas_table', 1),
(38, '2020_01_10_010400_create_visitas_table', 1),
(39, '2020_01_10_010417_create_horario_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_caracteriticas_de_locales`
--

DROP TABLE IF EXISTS `t_caracteriticas_de_locales`;
CREATE TABLE IF NOT EXISTS `t_caracteriticas_de_locales` (
  `caracteristicasLocal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caracteristicasLocal_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`caracteristicasLocal_id`),
  KEY `t_caracteriticas_de_locales_grupo_id_foreign` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_caracteriticas_de_locales`
--

INSERT INTO `t_caracteriticas_de_locales` (`caracteristicasLocal_id`, `caracteristicasLocal_nombre`, `grupo_id`) VALUES
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
(22, 'Outdoor', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_caracteriticas_de_unidades`
--

DROP TABLE IF EXISTS `t_caracteriticas_de_unidades`;
CREATE TABLE IF NOT EXISTS `t_caracteriticas_de_unidades` (
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
(1, 'empresa de peruana uno', 'n', 'Perú', 'Arequipa', 'Arequipa', 1),
(2, 'empresa de chilena uno', 'n', 'Chile', 'Santiago', 'La Granja', 1);

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
-- Estructura de tabla para la tabla `t_grupo_de_caracteristicas`
--

DROP TABLE IF EXISTS `t_grupo_de_caracteristicas`;
CREATE TABLE IF NOT EXISTS `t_grupo_de_caracteristicas` (
  `grupo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grupo_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_grupo_de_caracteristicas`
--

INSERT INTO `t_grupo_de_caracteristicas` (`grupo_id`, `grupo_nombre`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(37, '05:00:00', '17:00:00', 'a', 3, 'sabado'),
(38, '08:00:00', '13:00:00', 'o', 4, 'lunes'),
(39, '08:00:00', '13:00:00', 'o', 4, 'martes'),
(40, '08:00:00', '13:00:00', 'o', 4, 'miercoles'),
(41, '08:00:00', '13:00:00', 'o', 4, 'jueves'),
(42, '08:00:00', '13:00:00', 'o', 4, 'viernes'),
(43, '08:00:00', '13:00:00', 'o', 4, 'sabado'),
(44, '06:00:00', '20:00:00', 'a', 4, 'lunes'),
(45, '06:00:00', '20:00:00', 'a', 4, 'martes'),
(46, '06:00:00', '20:00:00', 'a', 4, 'miercoles'),
(47, '06:00:00', '20:00:00', 'a', 4, 'jueves'),
(48, '06:00:00', '20:00:00', 'a', 4, 'viernes'),
(49, '06:00:00', '20:00:00', 'a', 4, 'sabado'),
(50, '07:00:00', '13:00:00', 'a', 4, 'domingo'),
(51, '08:00:00', '19:00:00', 'o', 6, 'lunes'),
(52, '08:00:00', '19:00:00', 'o', 6, 'martes'),
(53, '08:00:00', '19:00:00', 'o', 6, 'miercoles'),
(54, '08:00:00', '19:00:00', 'o', 6, 'jueves'),
(55, '08:00:00', '19:00:00', 'o', 6, 'viernes'),
(56, '08:00:00', '19:00:00', 'o', 6, 'sabado'),
(57, '08:00:00', '19:00:00', 'o', 6, 'domingo'),
(58, '08:00:00', '19:00:00', 'a', 6, 'lunes'),
(59, '08:00:00', '19:00:00', 'a', 6, 'martes'),
(60, '08:00:00', '19:00:00', 'a', 6, 'miercoles'),
(61, '08:00:00', '19:00:00', 'a', 6, 'jueves'),
(62, '08:00:00', '19:00:00', 'a', 6, 'viernes'),
(63, '08:00:00', '19:00:00', 'a', 6, 'sabado'),
(64, '08:00:00', '19:00:00', 'a', 6, 'domingo'),
(65, '08:00:00', '19:00:00', 'o', 7, 'lunes'),
(66, '08:00:00', '19:00:00', 'o', 7, 'martes'),
(67, '08:00:00', '19:00:00', 'o', 7, 'miercoles'),
(68, '08:00:00', '19:00:00', 'o', 7, 'jueves'),
(69, '08:00:00', '19:00:00', 'o', 7, 'viernes'),
(70, '08:00:00', '19:00:00', 'o', 7, 'sabado'),
(71, '08:00:00', '19:00:00', 'o', 7, 'domingo'),
(72, '08:00:00', '19:00:00', 'a', 7, 'lunes'),
(73, '08:00:00', '19:00:00', 'a', 7, 'martes'),
(74, '08:00:00', '19:00:00', 'a', 7, 'miercoles'),
(75, '08:00:00', '19:00:00', 'a', 7, 'jueves'),
(76, '08:00:00', '19:00:00', 'a', 7, 'viernes'),
(77, '08:00:00', '19:00:00', 'a', 7, 'sabado'),
(78, '08:00:00', '19:00:00', 'a', 7, 'domingo'),
(79, '08:00:00', '19:00:00', 'o', 8, 'lunes'),
(80, '08:00:00', '19:00:00', 'o', 8, 'martes'),
(81, '08:00:00', '19:00:00', 'o', 8, 'miercoles'),
(82, '08:00:00', '19:00:00', 'o', 8, 'jueves'),
(83, '08:00:00', '19:00:00', 'o', 8, 'viernes'),
(84, '08:00:00', '19:00:00', 'o', 8, 'sabado'),
(85, '08:00:00', '19:00:00', 'a', 8, 'lunes'),
(86, '08:00:00', '19:00:00', 'a', 8, 'martes'),
(87, '08:00:00', '19:00:00', 'a', 8, 'miercoles'),
(88, '08:00:00', '19:00:00', 'a', 8, 'jueves'),
(89, '08:00:00', '19:00:00', 'a', 8, 'viernes'),
(90, '08:00:00', '19:00:00', 'a', 8, 'sabado'),
(91, '08:00:00', '19:00:00', 'o', 9, 'lunes'),
(92, '08:00:00', '19:00:00', 'o', 9, 'martes'),
(93, '08:00:00', '19:00:00', 'o', 9, 'miercoles'),
(94, '08:00:00', '19:00:00', 'o', 9, 'jueves'),
(95, '08:00:00', '19:00:00', 'o', 9, 'viernes'),
(96, '08:00:00', '19:00:00', 'a', 9, 'lunes'),
(97, '08:00:00', '19:00:00', 'a', 9, 'martes'),
(98, '08:00:00', '19:00:00', 'a', 9, 'miercoles'),
(99, '08:00:00', '19:00:00', 'a', 9, 'jueves'),
(100, '08:00:00', '19:00:00', 'a', 9, 'viernes');

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
  `local_provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `t_locales` (`local_id`, `local_nombre`, `local_descripcion`, `empresa_id`, `local_telefono`, `local_email`, `local_pais`, `local_region`, `local_provincia`, `local_comuna`, `local_direccion`, `usuario_id`, `local_latitud`, `local_longitud`, `local_nDiasDeReserva`, `local_estaBorrado`) VALUES
(1, 'local de prueba uno', 'descripcion', 1, 111111111, 'emailDelLocal@algo.algo', 'Perú', 'Arequipa', 'Arequipa', 'Alto Selva Alegre', 'Argentina 126, Arequipa 04004, Perú', 1, -16.382547, -71.519298, '20', 'n'),
(2, 'local de prueba dos', 'descripcion', 2, 222222222, 'emailDelLocalDos@algo.algo', 'Chile', 'Bío Bío', 'Concepción', 'Concepción', 'Diego de Almagro 640-672, Concepción, Bío Bío, Chile', 1, -36.807547, -73.066322, '20', 'n'),
(3, 'local de prueba tres', 'descripcion', 2, 333333333, 'emailDePrueb@algo.algo', 'Chile', 'Santiago', 'Santiago', 'La Granja', 'Veintiocho Ote 6465-6499, La Granja, Región Metropolitana, Chile', 1, -33.518138, -70.61986, '20', 'n'),
(4, 'local de prueba cuatro', 'descripcion', 2, 444444444, 'esteEmailNoExiste@local4.com', 'Chile', 'Santiago', 'Santiago', 'Pudahuel', 'Dillu 267-291, Pudahuel, Región Metropolitana, Chile', 1, -33.462733, -70.742522, '20', 'n'),
(5, 'local de prueba cinco', 'descripcion', 2, 555555555, 'local__5@algo.algo', 'Chile', 'Arica y Parinacota', 'Arica', 'Arica', 'Alejandro Azolas 2364, Arica, Arica y Parinacota, Chile', 1, -18.470816, -70.296328, '20', 'n'),
(6, 'local de Paucarpata', 'local de bodegas en Paucarpata muy serca del mall aventura plaza con 3 unidades de 3 metros cuadrados cada uno y 30 dias de ventana de reserva', 1, 666666666, 'LocalPaucarpata@algo.algo', 'Perú', 'Arequipa', 'Arequipa', 'Paucarpata', 'John F. Kennedy 1201-803, Arequipa 04002', 1, -16.41925, -71.509139, '30', 'n'),
(7, 'local del Cercado', 'local en el Cercado de Arequipa por las proximidades del centro historico con 6 unidades de variados tamaños y 20 dias de ventana de reserva', 1, 777777777, 'emailDelLocalCercado@gmail.com', 'Perú', 'Arequipa', 'Arequipa', 'Cercado', 'Centro Histórico, Arequipa 04001', 1, -16.400233, -71.537364, '20', 'n'),
(8, 'local de Miraflores', 'local en el distrito de miraflores cerca al cementerio municipal, con 5 unidades de un area menor a 10 metros cuadrados no ofrece una ventana de reserva', 1, 888888888, 'localMiraflorino@algo.algo', 'Perú', 'Arequipa', 'Arequipa', 'Miraflores', 'Miraflores 04004', 1, -16.374467, -71.495023, '0', 'n'),
(9, 'local de Cayma', 'local ubicado al frente del estadio Bolognesi con 4 unidades de 5 metros cuadrados cada uno y sin una ventana de reserva', 1, 999999999, 'localDeCayma@algo.com', 'Perú', 'Arequipa', 'Arequipa', 'Cayma', 'Calle Aviación 1018, Arequipa 04018', 1, -16.345504, -71.542861, '0', 'n'),
(10, 'local de Bustamante y Ribero', 'este local acaba de ser inagurado, no posee unidades activas aun', 1, 101010101, 'JoseLuisBustamanteyRibero@algo.algo', 'Perú', 'Arequipa', 'Arequipa', 'Jose Luis Bustamante y Ribero', 'Auxiliar Av. Dolores, Arequipa 04009', 1, -16.426415, -71.52449, '0', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pivot_caracteriticas_unidad`
--

DROP TABLE IF EXISTS `t_pivot_caracteriticas_unidad`;
CREATE TABLE IF NOT EXISTS `t_pivot_caracteriticas_unidad` (
  `unidadCaracteristicas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unidad_id` bigint(20) UNSIGNED NOT NULL,
  `caracteristicasUnidad_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`unidadCaracteristicas_id`),
  KEY `t_pivot_caracteriticas_unidad_unidad_id_foreign` (`unidad_id`),
  KEY `t_pivot_caracteriticas_unidad_caracteristicasunidad_id_foreign` (`caracteristicasUnidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pivot_local_caracteriticas`
--

DROP TABLE IF EXISTS `t_pivot_local_caracteriticas`;
CREATE TABLE IF NOT EXISTS `t_pivot_local_caracteriticas` (
  `localCaracteristicas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caracteristicasLocal_id` bigint(20) UNSIGNED NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`localCaracteristicas_id`),
  KEY `t_pivot_local_caracteriticas_local_id_foreign` (`local_id`),
  KEY `t_pivot_local_caracteriticas_caracteristicaslocal_id_foreign` (`caracteristicasLocal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `t_pivot_local_caracteriticas`
--

INSERT INTO `t_pivot_local_caracteriticas` (`localCaracteristicas_id`, `caracteristicasLocal_id`, `local_id`) VALUES
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
(30, 3, 3),
(31, 4, 3),
(32, 5, 3),
(33, 6, 3),
(34, 7, 3),
(35, 8, 3),
(36, 9, 3),
(37, 10, 3),
(38, 11, 3),
(39, 12, 3),
(40, 13, 3),
(41, 14, 3),
(42, 16, 3),
(43, 18, 3),
(44, 19, 3),
(45, 22, 3),
(46, 1, 5),
(47, 8, 5),
(48, 13, 5),
(49, 16, 5),
(50, 21, 5),
(51, 1, 6),
(52, 2, 6),
(53, 3, 6),
(54, 5, 6),
(55, 8, 6),
(56, 9, 6),
(57, 11, 6),
(58, 13, 6),
(59, 14, 6),
(60, 16, 6),
(61, 18, 6),
(62, 20, 6),
(63, 21, 6),
(64, 2, 7),
(65, 3, 7),
(66, 5, 7),
(67, 8, 7),
(68, 9, 7),
(69, 11, 7),
(70, 13, 7),
(71, 14, 7),
(72, 16, 7),
(73, 18, 7),
(74, 19, 7),
(75, 20, 7),
(76, 21, 7),
(77, 1, 8),
(78, 2, 8),
(79, 3, 8),
(80, 5, 8),
(81, 8, 8),
(82, 9, 8),
(83, 16, 8),
(84, 18, 8),
(85, 19, 8),
(86, 20, 8),
(87, 21, 8),
(88, 1, 9),
(89, 2, 9),
(90, 3, 9),
(91, 5, 9),
(92, 8, 9),
(93, 18, 9),
(94, 19, 9),
(95, 20, 9),
(96, 21, 9);

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
  `reserva_fechaRegistro` datetime NOT NULL DEFAULT '2020-02-10 19:21:04',
  `reserva_fechaMudanza` date DEFAULT '2020-02-10',
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
(1, 'Niko', 'Bellic', 'nikoBellic@gmail.com', 11111111, '2020-02-10 14:25:32', '2020-02-06', 'o', 'n', 2, 'Q2OOLS5Z', '281bd29a44e3da06e769ad79694a53f1'),
(2, 'tomy', 'vercetty', 'to_ver@gmail.com', 222222222, '2020-02-10 19:21:04', '2020-01-30', 'o', 'n', 3, '081IUTYK', '43f383da2df0a0e3f042b5c5bca00f9b'),
(3, 'carl', 'jhonson', 'cj_master@hotmail.com', 333333333, '2020-02-10 19:21:04', '2020-02-07', 'o', 'n', 2, 'UIB2I7S8', '0aa5354a13b49920cca9b31474eacf63'),
(4, 'marco', 'arriaga', 'marco.arriaga@outlook.com', 444444444, '2020-02-10 19:21:04', '2020-02-10', 'o', 's', 1, '1LP0D3ZG', '4597730ad8d39ff104f6460ed59cc1b1'),
(5, 'marcos', 'aguilar', 'ma.agui.esteban@isur.edu.pe', 555555555, '2020-02-10 19:21:04', '2020-02-10', 'o', 's', 4, 'T188VFB7', 'e6a505e0cfd9376725af6dcde4f85317');

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
(9, '160.00', 15, 'oferton de la unidad 9', 5, 'n', 'd'),
(10, '20.00', 3, 'oferton de la unidad 10', 6, 'n', 'd'),
(11, '20.00', 3, 'oferton de la unidad 11', 6, 'n', 'd'),
(12, '20.00', 3, 'oferton de la unidad 12', 6, 'n', 'd'),
(13, '30.00', 3, 'oferton de la unidad 13', 7, 'n', 'd'),
(14, '120.00', 10, 'oferton de la unidad 14', 7, 'n', 'd'),
(15, '60.00', 5, 'oferton de la unidad 15', 7, 'n', 'd'),
(16, '60.00', 5, 'oferton de la unidad 16', 7, 'n', 'd'),
(17, '150.00', 15, 'oferton de la unidad 17', 7, 'n', 'd'),
(18, '90.00', 8, 'oferton de la unidad 18', 7, 'n', 'd'),
(19, '50.00', 4, 'oferton de la unidad 19', 8, 'n', 'd'),
(20, '80.00', 7, 'oferton de la unidad 20', 8, 'n', 'd'),
(21, '70.00', 6, 'oferton de la unidad 21', 8, 'n', 'd'),
(22, '80.00', 7, 'oferton de la unidad 22', 8, 'n', 'd'),
(23, '60.00', 5, 'oferton de la unidad 23', 8, 'n', 'd'),
(24, '50.00', 5, 'oferton de la unidad 18', 9, 'n', 'd'),
(25, '50.00', 5, 'oferton de la unidad 18', 9, 'n', 'd'),
(26, '50.00', 5, 'oferton de la unidad 18', 9, 'n', 'd'),
(27, '50.00', 5, 'oferton de la unidad 18', 9, 'n', 'd');

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
  `visitas_fecha` datetime NOT NULL DEFAULT '2020-02-10 00:00:00',
  `visitas_hora` time NOT NULL DEFAULT '19:21:07',
  `local_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`visitas_id`),
  KEY `t_visitas_local_id_foreign` (`local_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_caracteriticas_de_locales`
--
ALTER TABLE `t_caracteriticas_de_locales`
  ADD CONSTRAINT `t_caracteriticas_de_locales_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `t_grupo_de_caracteristicas` (`grupo_id`);

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
-- Filtros para la tabla `t_locales`
--
ALTER TABLE `t_locales`
  ADD CONSTRAINT `t_locales_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `t_empresas` (`empresa_id`),
  ADD CONSTRAINT `t_locales_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `t_usuarios` (`usuario_id`);

--
-- Filtros para la tabla `t_pivot_caracteriticas_unidad`
--
ALTER TABLE `t_pivot_caracteriticas_unidad`
  ADD CONSTRAINT `t_pivot_caracteriticas_unidad_caracteristicasunidad_id_foreign` FOREIGN KEY (`caracteristicasUnidad_id`) REFERENCES `t_caracteriticas_de_unidades` (`caracteristicasUnidad_id`),
  ADD CONSTRAINT `t_pivot_caracteriticas_unidad_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `t_unidades` (`unidad_id`);

--
-- Filtros para la tabla `t_pivot_local_caracteriticas`
--
ALTER TABLE `t_pivot_local_caracteriticas`
  ADD CONSTRAINT `t_pivot_local_caracteriticas_caracteristicaslocal_id_foreign` FOREIGN KEY (`caracteristicasLocal_id`) REFERENCES `t_caracteriticas_de_locales` (`caracteristicasLocal_id`),
  ADD CONSTRAINT `t_pivot_local_caracteriticas_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `t_locales` (`local_id`);

--
-- Filtros para la tabla `t_reservas`
--
ALTER TABLE `t_reservas`
  ADD CONSTRAINT `t_reservas_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `t_unidades` (`unidad_id`);

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
