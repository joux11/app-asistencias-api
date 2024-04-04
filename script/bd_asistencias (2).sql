-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2024 a las 03:22:56
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_asistencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `fecha_marcacion` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` varchar(80) NOT NULL,
  `latitud` double(10,8) DEFAULT NULL,
  `longitud` decimal(12,8) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `fecha_marcacion`, `hora_entrada`, `hora_salida`, `estado`, `latitud`, `longitud`, `usuario_id`) VALUES
(19, '2024-04-03', '14:52:56', '14:53:07', 'A', -1.51024000, '-78.00009900', 12),
(20, '2024-04-03', '20:06:27', '20:08:18', 'A', -1.51024000, '-78.00009900', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_niños`
--

CREATE TABLE `asistencia_niños` (
  `id` int(11) NOT NULL,
  `fecha_marcacion` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` varchar(80) NOT NULL,
  `observacion_entrada` varchar(100) DEFAULT NULL,
  `observacion_salida` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `niño_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia_niños`
--

INSERT INTO `asistencia_niños` (`id`, `fecha_marcacion`, `hora_entrada`, `hora_salida`, `estado`, `observacion_entrada`, `observacion_salida`, `usuario_id`, `niño_id`) VALUES
(28, '2024-04-02', '23:35:01', '23:35:04', 'A', '', '', 12, 4),
(29, '2024-04-02', '23:35:36', NULL, 'A', '', NULL, 12, 3),
(30, '2024-04-03', '09:12:22', '20:14:33', 'A', '', '', 13, 4),
(31, '2024-04-03', '14:53:35', NULL, 'A', '', NULL, 12, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niños`
--

CREATE TABLE `niños` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `primer_nombre` varchar(100) NOT NULL,
  `segundo_nombre` varchar(100) NOT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niños`
--

INSERT INTO `niños` (`id`, `identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `genero`, `created_at`, `update_at`) VALUES
(1, '1600774411', 'Jhonly', 'Alberto', 'Mendoza', 'Perez', '2021-11-11', 'masculino', '2024-04-02 16:02:22', '2024-04-02 16:02:22'),
(2, '1600748877', 'Manuel', 'Mario', 'Mercedes', 'Moran', '2004-04-15', 'masculino', '2024-04-02 16:03:38', '2024-04-02 16:03:38'),
(3, '1600745574', 'Joselyn', 'Andrea', 'Benitez', 'Morales', '2022-12-11', 'femenino', '2024-04-02 17:32:57', '2024-04-02 17:32:57'),
(4, '1600784477', 'Nayeli', 'Caronlina', 'Beltran', 'Mora', '2014-07-11', 'femenino', '2024-04-02 17:34:52', '2024-04-02 17:34:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre_rol`, `descripcion`, `estado`) VALUES
(1, 'admin', 'admin', 1),
(2, 'personal', 'Rol del personal', 1),
(3, 'guardia', 'Rol del guardia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `numero_celular` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `numero_celular`, `email`, `password`, `estado`, `created_at`, `updated_at`, `rol_id`) VALUES
(12, '1600560872', 'Joe', 'Fernando', 'Caiza ', 'Guarnizo', '0983932864', 'caizajoe@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2024-04-01 22:33:13', '2024-04-01 22:33:13', 1),
(13, '1600327744', 'Jhon', 'Cass', 'Casses', 'Doe', '0983854441', 'johancass1@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2024-04-01 22:34:46', '2024-04-01 22:34:46', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `asistencia_niños`
--
ALTER TABLE `asistencia_niños`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `niño_id` (`niño_id`);

--
-- Indices de la tabla `niños`
--
ALTER TABLE `niños`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `asistencia_niños`
--
ALTER TABLE `asistencia_niños`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `niños`
--
ALTER TABLE `niños`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia_niños`
--
ALTER TABLE `asistencia_niños`
  ADD CONSTRAINT `asistencia_niños_ibfk_1` FOREIGN KEY (`niño_id`) REFERENCES `niños` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_niños_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
