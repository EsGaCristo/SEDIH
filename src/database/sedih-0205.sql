-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2023 a las 07:26:14
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_diario` (IN `Hotelid` INT)   BEGIN
    DECLARE idTipoArray TEXT;
    DECLARE idTipo1 TEXT;
    DECLARE nivelGeneral REAL DEFAULT 0;
    DECLARE pos INT DEFAULT 1;
    DECLARE total_rows INT DEFAULT 0;
    DECLARE nivelTipo REAL DEFAULT 0;
    
	SET idTipoArray = (SELECT GROUP_CONCAT(DISTINCT habitacion.idTipo SEPARATOR ',') FROM habitacion WHERE idHotel = Hotelid);
    
    SET nivelGeneral = (SELECT ocupacion FROM hotel WHERE idHotel = Hotelid); 
    SELECT COUNT(*) INTO total_rows FROM hotel WHERE idHotel = Hotelid;
    
    WHILE pos <= LENGTH(idTipoArray) - LENGTH(REPLACE(idTipoArray, ',', '')) + 1 DO
        SET idTipo1 = SUBSTRING_INDEX(idTipoArray, ',', pos);
        SET nivelTipo = (100*(SELECT COUNT(*) FROM habitacion WHERE idHotel = Hotelid AND idTipo=pos AND estado = "OCUPADO"))/(SELECT COUNT(*) FROM habitacion WHERE idHotel = Hotelid AND idTipo=pos);

        IF idTipo1 <> '' THEN
            INSERT INTO registroocupacion VALUES(Hotelid, NOW(), nivelGeneral,pos,nivelTipo);
        END IF;
        SET pos = pos + 1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrocliente` (IN `varIdRegistro` INT)   BEGIN
    SELECT idHabitacion
    FROM registrocliente
    WHERE idRegistro = varIdRegistro;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `codigoHabitacion` varchar(100) NOT NULL,
  `numeroHabitacion` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `costo` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`codigoHabitacion`, `numeroHabitacion`, `idTipo`, `estado`, `costo`, `idHotel`) VALUES
('LL-01', 1, 1, 'OCUPADO', 2500, 1),
('LL-02', 2, 1, 'OCUPADO', 2500, 1),
('LL-03', 3, 2, 'OCUPADO', 3600, 1),
('LL-04', 4, 2, 'DISPONIBLE', 3600, 1),
('LL-05', 5, 3, 'DISPONIBLE', 4200, 1),
('LL-06', 6, 3, 'DISPONIBLE', 4200, 1),
('LL-07', 7, 3, 'DISPONIBLE', 5200, 1),
('LL-08', 8, 3, 'DISPONIBLE', 5200, 1),
('LP-01', 1, 4, 'DISPONIBLE', 2500, 2),
('LP-02', 2, 4, 'DISPONIBLE', 3600, 2),
('LP-04', 4, 4, 'OCUPADO', 4000, 2);

--
-- Disparadores `habitacion`
--
DELIMITER $$
CREATE TRIGGER `tr_ocupacionDisponible` BEFORE UPDATE ON `habitacion` FOR EACH ROW BEGIN 
    DECLARE porcentaje REAL;
    
    SET porcentaje = 0;
    
    IF NEW.estado = 'DISPONIBLE' THEN
        SET porcentaje = 100 / (SELECT noHabitaciones FROM hotel WHERE idHotel = NEW.idHotel);
    END IF;
    
    UPDATE hotel SET ocupacion = ocupacion - porcentaje WHERE idHotel = NEW.idHotel;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `domicilio` varchar(150) DEFAULT NULL,
  `ocupacion` double DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `noHabitaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`idHotel`, `nombre`, `categoria`, `domicilio`, `ocupacion`, `ubicacion`, `noHabitaciones`) VALUES
(1, 'La Loma', 5, 'Calle y numero', 2, 'Tepic ', 100),
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
  `idHabitacion` varchar(100) NOT NULL,
  `tipoHabitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registrocliente`
--

INSERT INTO `registrocliente` (`idRegistro`, `fechaHRegistro`, `fechaSalida`, `motivoVisita`, `lugarProcedencia`, `idHabitacion`, `tipoHabitacion`) VALUES
(79, '2023-05-10', '2023-05-11', 'Prueba', 'Prueba', 'LL-03', 2),
(80, '2023-05-11', '2023-05-18', 'PLACER', 'Pitufo', 'LL-02', 1),
(82, '2023-05-11', '2023-05-18', 'PLACER', 'Pitufo', 'LP-04', 4);

--
-- Disparadores `registrocliente`
--
DELIMITER $$
CREATE TRIGGER `tr_actualizarOcupacion` AFTER INSERT ON `registrocliente` FOR EACH ROW BEGIN 
    DECLARE hotelID TEXT;
    DECLARE porcentaje REAL;
    
    
    SET hotelID = (SELECT idHotel FROM habitacion WHERE 	codigoHabitacion = (SELECT idHabitacion FROM 			registrocliente WHERE idRegistro = NEW.idRegistro));
   	
    SET porcentaje = (100)/(SELECT noHabitaciones FROM 							hotel WHERE idHotel = hotelID);
    
    
    
   UPDATE hotel set ocupacion = ocupacion + porcentaje WHERE idHotel = hotelID;

END
$$
DELIMITER ;

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

--
-- Volcado de datos para la tabla `registroocupacion`
--

INSERT INTO `registroocupacion` (`idHotel`, `fecha`, `nivelGeneral`, `tipoHabitacion`, `nivelHabitacion`) VALUES
(1, '2023-05-02 22:12:17', 2, 1, 100),
(1, '2023-05-02 22:12:17', 2, 2, 50),
(1, '2023-05-02 22:12:17', 2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohabitacion`
--

CREATE TABLE `tipohabitacion` (
  `idTipo` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipohabitacion`
--

INSERT INTO `tipohabitacion` (`idTipo`, `nombre`, `cantidad`, `idHotel`) VALUES
(1, 'INDIVIDUAL', 25, 1),
(2, 'DOBLE', 25, 1),
(3, 'TRIPLE', 25, 1),
(4, 'PENTHOUSE', 25, 2);

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
(3, 3, 'gerente@correo.com', 1, '12345'),
(4, 2, 'capturista2@correo.com', 2, '12345'),
(5, 3, 'gerente2@correo.com', 2, '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`codigoHabitacion`) USING BTREE,
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
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `fk_registroTipoHab` FOREIGN KEY (`tipoHabitacion`) REFERENCES `habitacion` (`idTipo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_hotel` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
