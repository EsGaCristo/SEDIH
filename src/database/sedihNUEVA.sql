-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2023 a las 22:21:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sedih`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `idHabitacion` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `costo` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`idHabitacion`, `idTipo`, `estado`, `costo`, `idHotel`) VALUES
(1, 1, 'DISPONIBLE', 2500, 1),
(2, 2, 'DISPONIBLE', 4500, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `domicilio` varchar(150) DEFAULT NULL,
  `ocupacion` int(11) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `noHabitaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`idHotel`, `nombre`, `categoria`, `domicilio`, `ocupacion`, `ubicacion`, `noHabitaciones`) VALUES
(1, 'La Loma', 5, 'Calle y numero', 50, 'Tepic ', 100),
(2, 'Las Palomas', 5, 'calle conocida numero conocido', 0, 'Tepic', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrocliente`
--

CREATE TABLE `registrocliente` (
  `idRegistro` int(11) NOT NULL,
  `fechaHRegistro` date NOT NULL,
  `fechaSalida` date NOT NULL,
  `motivoVisita` varchar(200) DEFAULT NULL,
  `lugarProcedencia` varchar(60) DEFAULT NULL,
  `idHabitacion` int(11) NOT NULL,
  `tipoHabitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registrocliente`
--

INSERT INTO `registrocliente` (`idRegistro`, `fechaHRegistro`, `fechaSalida`, `motivoVisita`, `lugarProcedencia`, `idHabitacion`, `tipoHabitacion`) VALUES
(1, '2023-04-27', '2023-04-29', 'NEGOCIOS', 'TIJUANA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroocupacion`
--

CREATE TABLE `registroocupacion` (
  `idHotel` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nivelGeneral` int(11) NOT NULL,
  `tipoHabitacion` int(11) NOT NULL,
  `nivelHabitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohabitacion`
--

CREATE TABLE `tipohabitacion` (
  `idTipo` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipohabitacion`
--

INSERT INTO `tipohabitacion` (`idTipo`, `nombre`, `cantidad`) VALUES
(1, 'INDIVIDUAL', 25),
(2, 'DOBLE', 25),
(3, 'TRIPLE', 25),
(4, 'PENTHOUSE', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `tipo` smallint(6) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `idHotel` int(11) DEFAULT NULL,
  `userPass` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tipo`, `correo`, `idHotel`, `userPass`) VALUES
(1, 1, 'David@correo.com', 1, '12345'),
(2, 2, 'capturista@correo.com', 1, '12345'),
(3, 3, 'gerente@correo.com', 1, '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`idHabitacion`),
  ADD KEY `idTipo` (`idTipo`),
  ADD KEY `fk_` (`idHotel`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idHotel`);

--
-- Indices de la tabla `registrocliente`
--
ALTER TABLE `registrocliente`
  ADD PRIMARY KEY (`idRegistro`,`fechaHRegistro`),
  ADD KEY `fk_registroTipoHab` (`tipoHabitacion`),
  ADD KEY `idHabitacion` (`idHabitacion`);

--
-- Indices de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_usuarios_hotel` (`idHotel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `idHotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registrocliente`
--
ALTER TABLE `registrocliente`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `fk_` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`),
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipohabitacion` (`idTipo`);

--
-- Filtros para la tabla `registrocliente`
--
ALTER TABLE `registrocliente`
  ADD CONSTRAINT `fk_registroTipoHab` FOREIGN KEY (`tipoHabitacion`) REFERENCES `habitacion` (`idTipo`),
  ADD CONSTRAINT `registrocliente_ibfk_1` FOREIGN KEY (`idHabitacion`) REFERENCES `habitacion` (`idHabitacion`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_hotel` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
