-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-10-2024 a las 02:39:52
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id_conductor` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `numero_licencia` varchar(50) DEFAULT NULL,
  `tipo_licencia` varchar(50) DEFAULT NULL,
  `vencimiento_licencia` date DEFAULT NULL,
  `renovacion_licencia` date DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id_conductor`, `nombre`, `numero_licencia`, `tipo_licencia`, `vencimiento_licencia`, `renovacion_licencia`, `telefono`, `correo`, `direccion`, `estado`) VALUES
(1, 'LOURDES', 'hola', 'd', '2024-10-24', '2024-10-21', '33', 'cami@gmail.com', '33', 'De baja'),
(2, 'd', 'd', 'd', '2024-10-15', '2024-10-21', 'd', 'cosita@gmail.com', 'd', 'd'),
(3, 'Q', 'Q', 'Q', '2024-10-14', '2024-10-29', '22', 'CAMI@gmail.com', 'D', 'D'),
(4, 'Manuel', '3847476', 'A', '2024-10-23', '2024-10-31', '98777e7e', 'manuel@gmail.com', '1calle ', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `cambio_valvulas` tinyint(1) DEFAULT NULL,
  `filtro_aceite` tinyint(1) DEFAULT NULL,
  `filtro_gasolina` tinyint(1) DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `chasis` varchar(50) DEFAULT NULL,
  `llantas` varchar(50) DEFAULT NULL,
  `linea` varchar(50) DEFAULT NULL,
  `tonelaje` decimal(5,2) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `estadomantenimiento` varchar(50) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `proximo_mantenimiento` date DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id_mantenimiento`, `fecha`, `tipo`, `costo`, `cambio_valvulas`, `filtro_aceite`, `filtro_gasolina`, `kilometraje`, `chasis`, `llantas`, `linea`, `tonelaje`, `descripcion`, `proveedor`, `estadomantenimiento`, `responsable`, `proximo_mantenimiento`, `id_vehiculo`) VALUES
(2, '2024-10-22', '3', 3.00, 0, 1, 0, 3, 'd', 'd', 'd', 3.00, 'd', 'dd', 'dd', 'd', '2024-10-14', 3),
(3, '2024-10-29', 'S', 1222.00, 0, 0, 0, 2332, '2', 'S', 'S', 4.00, 'SSS', 'DD', 'DD', 'D', '2024-10-14', 2),
(4, '2024-10-29', 'd', 3333.00, 1, 1, 1, 5, '3', '3', '3', 3.00, '333', 'ddfs', 'd', 'Mario', '2024-10-22', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `categoria`, `cantidad`) VALUES
(1, 'incapacita', 'd', 'd', 2003),
(2, 'agua pura', 'd', 'd', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_viajes`
--

CREATE TABLE `registro_viajes` (
  `id_viaje` int(11) NOT NULL,
  `fechaviaje` date DEFAULT NULL,
  `horaviaje` time DEFAULT NULL,
  `destinocamion` varchar(100) DEFAULT NULL,
  `salidavehiculo` datetime DEFAULT NULL,
  `entradavehiculo` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_viajes`
--

INSERT INTO `registro_viajes` (`id_viaje`, `fechaviaje`, `horaviaje`, `destinocamion`, `salidavehiculo`, `entradavehiculo`, `estado`, `id_vehiculo`) VALUES
(11, '2024-10-28', '15:03:00', 'MALU', '2024-10-29 21:14:00', '2024-10-27 21:14:00', '0', 3),
(12, '2024-10-29', '15:03:00', 'SALAMA', '2024-10-29 21:23:00', '2024-10-29 21:23:00', '0', 3),
(13, '2024-10-29', '15:03:00', 'SALAMA', '2024-10-29 21:23:00', '2024-10-29 21:23:00', '0', 3),
(14, '2024-10-29', '14:02:00', 'd', '2024-10-15 21:52:00', '2024-10-21 21:53:00', 'd', 2),
(15, '2024-10-29', '14:02:00', 'd', '2024-10-15 21:52:00', '2024-10-21 21:53:00', 'CAMILA', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `rol`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `marca`, `modelo`, `ano`, `estado`, `capacidad`) VALUES
(2, 'Camila', 'Camila', 2023, 'nuevo', 2003),
(3, 'd', 'd', 2002, 'd', 23000),
(4, 'hola', 'd', 33, 'd', 2),
(5, 'Honda', 'dad', 4, 'dd', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id_conductor`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `fk_mantenimiento_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `registro_viajes`
--
ALTER TABLE `registro_viajes`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `fk_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id_conductor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro_viajes`
--
ALTER TABLE `registro_viajes`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `fk_mantenimiento_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro_viajes`
--
ALTER TABLE `registro_viajes`
  ADD CONSTRAINT `fk_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
