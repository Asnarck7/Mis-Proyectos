-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-12-2024 a las 14:39:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_pijao_del_sol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuartos`
--

CREATE TABLE `cuartos` (
  `id` int(11) NOT NULL,
  `tipo_habitacion` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `numero_elementos` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `numero_habitacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuartos`
--

INSERT INTO `cuartos` (`id`, `tipo_habitacion`, `descripcion`, `precio`, `numero_elementos`, `capacidad`, `numero_habitacion`, `fecha_creacion`) VALUES
(1, 'Suite', 'Espaciosa y elegante, la suite ofrece una experiencia de lujo con una zona de estar separada, cama king size y comodidades de alta gama. Ideal para una estancia prolongada o una experiencia de relax total.', 650000.00, 7, 2, 101, '2024-12-24 05:24:16'),
(2, 'Habitación CIP', 'Habitaciones diseñadas para los viajeros que requieren comodidad y funcionalidad, con una decoración moderna y todos los servicios necesarios para una estancia práctica y placentera.', 350000.00, 10, 2, 102, '2024-12-24 05:26:15'),
(3, 'Habitación Standard', 'Confortable y accesible, la habitación estándar ofrece lo esencial para una estancia cómoda. Equipadas con cama doble o dos camas individuales, ideales para viajeros que buscan una opción práctica y económica.', 200000.00, 10, 2, 103, '2024-12-24 05:27:53'),
(4, 'Habitación Familiar', 'Espaciosa y equipada con varias camas, diseñada para acomodar a familias. Con un ambiente cálido y cómodo, es ideal para compartir momentos de descanso con seres queridos en un solo espacio.', 500000.00, 13, 4, 104, '2024-12-24 05:28:27'),
(5, 'Habitación Ejecutiva', 'Perfecta para los viajeros de negocios, cuenta con un entorno profesional y sofisticado, equipado con escritorio, acceso a internet de alta velocidad y una cama confortable para descansar después de un día de trabajo.', 400000.00, 6, 2, 105, '2024-12-24 05:28:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `usuario`, `fecha_nacimiento`, `telefono`, `correo`, `contrasena`, `salario`, `fecha_creacion`) VALUES
(1, 'Kevin Julián', 'Guerrero Penagos', 'asnarck7', '2003-12-15', '3222278027', 'kevinjulian@gmail.com', '$2y$10$vGGpR5E96OOXzCuPfMq8jOiqcth39F.TxCtK1TwFtCHO9HlWUlo/O', 1.00, '2024-12-24 04:56:59'),
(2, 'Maria Camila', 'Vanegas Rivas', 'MariCami', '2007-11-23', '3222278027', 'MariCami@gmail.com', '$2y$10$.rQBliQuxfAyBWWWobxt0uVYOK3nOLytVZ3lV0cMre7TIKGMtgZL2', 0.97, '2024-12-24 05:02:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(1, 'Kevin Julián Guerrero Penagos', 'kevinjuliangue@hotmail.com', '123456789kjfdsadfdgfhgh', '2024-12-24 06:23:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `numero_personas` int(11) NOT NULL,
  `metodo_pago` enum('tarjeta_credito','tarjeta_debito','efectivo') NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_habitacion`, `nombre`, `correo`, `telefono`, `comentarios`, `fecha_entrada`, `fecha_salida`, `numero_personas`, `metodo_pago`, `fecha_reserva`, `estado`, `id_usuario`) VALUES
(1, 1, 'Kevin Julián Guerrero Penagos', 'kevinjulian@gmail.com', '3222278027', 'hola, muchas gracias quiero realizar mi reserva ', '2024-12-25', '2024-12-27', 2, 'efectivo', '2024-12-24 05:44:13', 'pendiente', 1),
(3, 3, 'Maria Camila Vanegas Rivas', 'MariCami@gmail.com', '3222278027', 'wertrtyfhjgfbdvvdstrhyjuiu,k,gjhgfbdvfegtrhy g hghfgdfs', '2024-12-29', '2025-01-01', 2, 'efectivo', '2024-12-24 05:52:45', 'pendiente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `nombre_usuario`, `correo`, `contrasena`, `creado_en`) VALUES
(1, 'Kevin Julián', 'Guerrero Penagos', 'asnarck', 'kevinjulian@gmail.com', '$2y$10$3WrELX/4v7XNUqtOe6r08ucJpl3jqxEGyFO.6tQ7I/GfNTKGzSDhy', '2024-12-24 04:40:10'),
(2, 'Maria Camila', 'Vanegas Rivas', 'Mari', 'MariCami@gmail.com', '$2y$10$Eu3S2bQXVsldrH1L.AJ8oOJtHemB9JY7TVCNVR1yqqyg3t5ieXxqy', '2024-12-24 05:49:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuartos`
--
ALTER TABLE `cuartos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuartos`
--
ALTER TABLE `cuartos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `cuartos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
