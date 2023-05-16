-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2023 a las 02:32:45
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
    time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `sedih`
--

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--
INSERT INTO
    `habitacion` (
        `codigoHabitacion`,
        `numeroHabitacion`,
        `idTipo`,
        `estado`,
        `costo`,
        `idHotel`
    )
VALUES
    ('La-Loma-01', 1, 1, 'DISPONIBLE', 1600, 1),
    ('La-Loma-02', 2, 1, 'DISPONIBLE', 1600, 1),
    ('La-Loma-03', 3, 1, 'DISPONIBLE', 1600, 1),
    ('La-Loma-04', 4, 1, 'DISPONIBLE', 1600, 1),
    ('La-Loma-05', 5, 1, 'DISPONIBLE', 1600, 1),
    ('La-Loma-06', 6, 2, 'DISPONIBLE', 2600, 1),
    ('La-Loma-07', 7, 2, 'DISPONIBLE', 2600, 1),
    ('La-Loma-08', 8, 2, 'DISPONIBLE', 2600, 1),
    ('La-Loma-09', 9, 2, 'DISPONIBLE', 2600, 1),
    ('La-Loma-10', 10, 2, 'DISPONIBLE', 2600, 1),
    ('Las-Palomas-01', 1, 4, 'DISPONIBLE', 4600, 2);



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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotel`
--
INSERT INTO
    `hotel` (
        `idHotel`,
        `nombre`,
        `categoria`,
        `domicilio`,
        `ocupacion`,
        `ubicacion`,
        `noHabitaciones`
    )
VALUES
    (1, 'La Loma', 5, 'Conocido', 0.4, 'Tepic', 10),
    (
        2,
        'Las Palomas',
        5,
        'calle conocida numero conocido',
        0.2,
        'Tepic',
        2
    ),
    (
        36,
        'Nekie',
        5,
        'conocido',
        0,
        'Tepic Nayarit',
        0
    ),
    (
        37,
        'Las Palmas',
        5,
        'Conocido',
        0,
        'Tepic Nayarit',
        0
    );

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
    `tipoHabitacion` int(11) NOT NULL,
    `idHotel` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registrocliente`
--
INSERT INTO
    `registrocliente` (
        `idRegistro`,
        `fechaHRegistro`,
        `fechaSalida`,
        `motivoVisita`,
        `lugarProcedencia`,
        `idHabitacion`,
        `tipoHabitacion`,
        `idHotel`
    )
VALUES
    (
        1,
        '2023-04-01',
        '2023-04-02',
        'PLACER',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        2,
        '2023-04-01',
        '2023-04-02',
        'PLACER',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        3,
        '2023-04-03',
        '2023-04-05',
        'PLACER',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        4,
        '2023-04-03',
        '2023-04-05',
        'PLACER',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        5,
        '2023-04-03',
        '2023-04-05',
        'PLACER',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        6,
        '2023-04-06',
        '2023-04-07',
        'NEGOCIOS',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        7,
        '2023-04-06',
        '2023-04-07',
        'NEGOCIOS',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        8,
        '2023-04-06',
        '2023-04-07',
        'NEGOCIOS',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        9,
        '2023-04-06',
        '2023-04-07',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        10,
        '2023-04-06',
        '2023-04-07',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    ),
    (
        11,
        '2023-04-08',
        '2023-04-09',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        12,
        '2023-04-08',
        '2023-04-09',
        'NEGOCIOS',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        13,
        '2023-04-08',
        '2023-04-10',
        'NEGOCIOS',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        14,
        '2023-04-09',
        '2023-04-11',
        'NEGOCIOS',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        15,
        '2023-04-10',
        '2023-04-12',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        16,
        '2023-04-11',
        '2023-04-12',
        'PLACER',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        17,
        '2023-04-12',
        '2023-04-13',
        'PLACER',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        18,
        '2023-04-12',
        '2023-04-13',
        'PLACER',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        19,
        '2023-04-13',
        '2023-04-15',
        'PLACER',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        20,
        '2023-04-13',
        '2023-04-15',
        'PLACER',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    ),
    (
        21,
        '2023-04-14',
        '2023-04-15',
        'PLACER',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        22,
        '2023-04-14',
        '2023-04-15',
        'PLACER',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        23,
        '2023-04-15',
        '2023-04-17',
        'PLACER',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        24,
        '2023-04-15',
        '2023-04-17',
        'PLACER',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        25,
        '2023-04-16',
        '2023-04-18',
        'PLACER',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        26,
        '2023-04-16',
        '2023-04-18',
        'NEGOCIOS',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        27,
        '2023-04-17',
        '2023-04-19',
        'NEGOCIOS',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        28,
        '2023-04-17',
        '2023-04-19',
        'NEGOCIOS',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        29,
        '2023-04-17',
        '2023-04-20',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        30,
        '2023-04-18',
        '2023-04-20',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    ),
    (
        31,
        '2023-04-18',
        '2023-04-20',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        32,
        '2023-04-19',
        '2023-04-21',
        'NEGOCIOS',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        33,
        '2023-04-20',
        '2023-04-21',
        'NEGOCIOS',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        34,
        '2023-04-21',
        '2023-04-22',
        'NEGOCIOS',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        35,
        '2023-04-22',
        '2023-04-23',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        36,
        '2023-04-22',
        '2023-04-23',
        'PLACER',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        37,
        '2023-04-23',
        '2023-04-25',
        'PLACER',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        38,
        '2023-04-23',
        '2023-04-26',
        'PLACER',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        39,
        '2023-04-23',
        '2023-04-27',
        'PLACER',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        40,
        '2023-04-24',
        '2023-04-27',
        'PLACER',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    ),
    (
        41,
        '2023-04-24',
        '2023-04-27',
        'PLACER',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        42,
        '2023-04-24',
        '2023-04-27',
        'PLACER',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        43,
        '2023-04-25',
        '2023-04-27',
        'PLACER',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        44,
        '2023-04-25',
        '2023-04-27',
        'PLACER',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        45,
        '2023-04-25',
        '2023-04-27',
        'PLACER',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        46,
        '2023-04-26',
        '2023-04-27',
        'NEGOCIOS',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        47,
        '2023-04-26',
        '2023-04-28',
        'NEGOCIOS',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        48,
        '2023-04-26',
        '2023-04-28',
        'NEGOCIOS',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        49,
        '2023-04-27',
        '2023-04-28',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        50,
        '2023-04-27',
        '2023-04-28',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    ),
    (
        51,
        '2023-04-27',
        '2023-04-28',
        'NEGOCIOS',
        'OAXACA',
        'La-Loma-01',
        1,
        1
    ),
    (
        52,
        '2023-04-27',
        '2023-04-28',
        'NEGOCIOS',
        'QUERETARO',
        'La-Loma-02',
        1,
        1
    ),
    (
        53,
        '2023-04-28',
        '2023-04-29',
        'NEGOCIOS',
        'QUINTANA ROO',
        'La-Loma-03',
        1,
        1
    ),
    (
        54,
        '2023-04-28',
        '2023-04-29',
        'NEGOCIOS',
        'MERIDA',
        'La-Loma-04',
        1,
        1
    ),
    (
        55,
        '2023-04-28',
        '2023-04-29',
        'NEGOCIOS',
        'SINALOA',
        'La-Loma-05',
        1,
        1
    ),
    (
        56,
        '2023-04-28',
        '2023-04-29',
        'PLACER',
        'VERACRUZ',
        'La-Loma-06',
        2,
        1
    ),
    (
        57,
        '2023-04-29',
        '2023-05-30',
        'PLACER',
        'JALISCO',
        'La-Loma-07',
        2,
        1
    ),
    (
        58,
        '2023-04-29',
        '2023-05-30',
        'PLACER',
        'DURANGO',
        'La-Loma-08',
        2,
        1
    ),
    (
        59,
        '2023-04-29',
        '2023-05-30',
        'PLACER',
        'SINALOA',
        'La-Loma-09',
        2,
        1
    ),
    (
        60,
        '2023-04-29',
        '2023-05-30',
        'PLACER',
        'OAXACA',
        'La-Loma-10',
        2,
        1
    );



-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `registroocupacion`
--
CREATE TABLE `registroocupacion` (
    `idHotel` int(11) NOT NULL,
    `fecha` datetime NOT NULL,
    `nivelGeneral` int(11) NOT NULL,
    `tipoHabitacion` int(11) NOT NULL,
    `nivelHabitacion` int(11) NOT NULL,
    `categoria` int(11) NOT NULL,
    `costoPromedio` double NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroocupacion`
--
INSERT INTO
    `registroocupacion` (
        `idHotel`,
        `fecha`,
        `nivelGeneral`,
        `tipoHabitacion`,
        `nivelHabitacion`,
        `categoria`,
        `costoPromedio`
    )
VALUES
    (1, '2023-05-14 19:09:47', 2, 1, 100, 5, 2500),
    (1, '2023-05-14 19:09:47', 2, 2, 50, 5, 3600),
    (1, '2023-05-14 19:09:47', 2, 3, 0, 5, 4700),
    (2, '2023-05-14 18:00:25', 0, 1, 33, 5, 0),
    (2, '2023-05-14 18:00:25', 0, 4, 33, 5, 0),
    (1, '2023-05-14 17:59:54', 2, 1, 100, 5, 0),
    (1, '2023-05-14 17:59:54', 2, 2, 50, 5, 0),
    (1, '2023-05-14 17:59:54', 2, 3, 0, 5, 0),
    (1, '2023-05-15 16:59:01', 908, 1, 0, 5, 1600),
    (1, '2023-05-15 16:59:01', 908, 2, 0, 5, 2600);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipohabitacion`
--
CREATE TABLE `tipohabitacion` (
    `idTipo` int(11) NOT NULL,
    `nombre` varchar(150) NOT NULL,
    `idHotel` int(11) NOT NULL,
    `costo` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipohabitacion`
--
INSERT INTO
    `tipohabitacion` (`idTipo`, `nombre`, `idHotel`, `costo`)
VALUES
    (1, 'INDIVIDUAL', 1, 1600),
    (2, 'DOBLE', 1, 2600),
    (3, 'TRIPLE', 1, 3200),
    (4, 'PENTHOUSE', 2, 4600),
    (14, 'PREMIUM', 1, 5200);

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO
    `usuarios` (
        `idUsuario`,
        `tipo`,
        `correo`,
        `idHotel`,
        `userPass`
    )
VALUES
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
ALTER TABLE
    `habitacion`
ADD
    PRIMARY KEY (`codigoHabitacion`) USING BTREE,
ADD
    KEY `idTipo` (`idTipo`),
ADD
    KEY `fk_` (`idHotel`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE
    `hotel`
ADD
    PRIMARY KEY (`idHotel`);

--
-- Indices de la tabla `registrocliente`
--
ALTER TABLE
    `registrocliente`
ADD
    PRIMARY KEY (`idRegistro`, `fechaHRegistro`),
ADD
    KEY `fk_registroTipoHab` (`tipoHabitacion`),
ADD
    KEY `idHabitacion` (`idHabitacion`);

--
-- Indices de la tabla `tipohabitacion`
--
ALTER TABLE
    `tipohabitacion`
ADD
    PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE
    `usuarios`
ADD
    PRIMARY KEY (`idUsuario`),
ADD
    KEY `fk_usuarios_hotel` (`idHotel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE
    `hotel`
MODIFY
    `idHotel` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 38;

--
-- AUTO_INCREMENT de la tabla `registrocliente`
--
ALTER TABLE
    `registrocliente`
MODIFY
    `idRegistro` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 70;

--
-- AUTO_INCREMENT de la tabla `tipohabitacion`
--
ALTER TABLE
    `tipohabitacion`
MODIFY
    `idTipo` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE
    `usuarios`
MODIFY
    `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 60;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE
    `habitacion`
ADD
    CONSTRAINT `fk_` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`),
ADD
    CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipohabitacion` (`idTipo`);

--
-- Filtros para la tabla `registrocliente`
--
ALTER TABLE
    `registrocliente`
ADD
    CONSTRAINT `fk_registroTipoHab` FOREIGN KEY (`tipoHabitacion`) REFERENCES `habitacion` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE
    `usuarios`
ADD
    CONSTRAINT `fk_usuarios_hotel` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`);

COMMIT;

DELIMITER $ $ --
-- Procedimientos
--
CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_diario` (IN `Hotelid` INT) BEGIN DECLARE idTipoArray TEXT;

DECLARE idTipo1 TEXT;

DECLARE nivelGeneral REAL DEFAULT 0;

DECLARE pos INT DEFAULT 1;

DECLARE total_rows INT DEFAULT 0;

DECLARE nivelTipo REAL DEFAULT 0;

DECLARE varCategoria INT DEFAULT 0;

DECLARE varCostoP DOUBLE DEFAULT 0;

SET
    idTipoArray = (
        SELECT
            GROUP_CONCAT(DISTINCT habitacion.idTipo SEPARATOR ',')
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
    );

SET
    nivelGeneral = (
        SELECT
            ocupacion
        FROM
            hotel
        WHERE
            idHotel = Hotelid
    );

SELECT
    COUNT(*) INTO total_rows
FROM
    hotel
WHERE
    idHotel = Hotelid;

SET
    varCategoria = (
        SELECT
            categoria
        FROM
            hotel
        WHERE
            idHotel = Hotelid
    );

WHILE pos <= LENGTH(idTipoArray) - LENGTH(REPLACE(idTipoArray, ',', '')) + 1 DO
SET
    idTipo1 = SUBSTRING_INDEX(SUBSTRING_INDEX(idTipoArray, ',', pos), ',', -1);

SET
    varCostoP =(
        SELECT
            AVG(costo)
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
            AND idTipo = idTipo1
    );

-- SELECT idTipo1;
-- SELECT pos;
SET
    nivelTipo = (
        100 *(
            SELECT
                COUNT(*)
            FROM
                habitacion
            WHERE
                idHotel = Hotelid
                AND idTipo = idTipo1
                AND estado = "OCUPADO"
        )
    ) /(
        SELECT
            COUNT(*)
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
            AND idTipo = idTipo1
    );

IF idTipo1 <> '' THEN
INSERT INTO
    registroocupacion
VALUES
    (
        Hotelid,
        NOW(),
        nivelGeneral,
        idTipo1,
        nivelTipo,
        varCategoria,
        varCostoP
    );

END IF;

SET
    pos = pos + 1;

END WHILE;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_inicioSemana` (
    IN `fechaConsulta` DATETIME,
    OUT `SALIDA` DATETIME
) BEGIN DECLARE SALIDA DATE;

SELECT
    DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(fechaConsulta) DAY) INTO SALIDA;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_porTipoDeHabitacion` (IN `HotelID` INT) BEGIN
SELECT
    idTipo,
    COUNT(*) as cantidad
FROM
    habitacion
WHERE
    HotelID = idHotel
    AND estado = "OCUPADO"
GROUP BY
    idTipo;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_registrocliente` (IN `varIdRegistro` INT) BEGIN
SELECT
    idHabitacion
FROM
    registrocliente
WHERE
    idRegistro = varIdRegistro;

END $ $ DELIMITER;

--
-- Disparadores `habitacion`
--
DELIMITER $ $ CREATE TRIGGER `tr_ocupacionDisponible` BEFORE
UPDATE
    ON `habitacion` FOR EACH ROW BEGIN DECLARE porcentaje REAL;

SET
    porcentaje = 0;

IF NEW.estado = 'DISPONIBLE' THEN
SET
    porcentaje = 100 / (
        SELECT
            noHabitaciones
        FROM
            hotel
        WHERE
            idHotel = NEW.idHotel
    );

END IF;

UPDATE
    hotel
SET
    ocupacion = ocupacion - porcentaje
WHERE
    idHotel = NEW.idHotel;

END $ $ DELIMITER;

--
-- Disparadores `registrocliente`
--
DELIMITER $ $ CREATE TRIGGER `tr_actualizarOcupacion`
AFTER
INSERT
    ON `registrocliente` FOR EACH ROW BEGIN DECLARE hotelID TEXT;

DECLARE porcentaje REAL;

SET
    hotelID = (
        SELECT
            idHotel
        FROM
            habitacion
        WHERE
            codigoHabitacion = (
                SELECT
                    idHabitacion
                FROM
                    registrocliente
                WHERE
                    idRegistro = NEW.idRegistro
            )
    );

SET
    porcentaje = (100) /(
        SELECT
            noHabitaciones
        FROM
            hotel
        WHERE
            idHotel = hotelID
    );

UPDATE
    hotel
set
    ocupacion = ocupacion + porcentaje
WHERE
    idHotel = hotelID;

END $ $ DELIMITER;

DELIMITER $ $ --
-- Procedimientos
--
CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_diario` (IN `Hotelid` INT) BEGIN DECLARE idTipoArray TEXT;

DECLARE idTipo1 TEXT;

DECLARE nivelGeneral REAL DEFAULT 0;

DECLARE pos INT DEFAULT 1;

DECLARE total_rows INT DEFAULT 0;

DECLARE nivelTipo REAL DEFAULT 0;

DECLARE varCategoria INT DEFAULT 0;

DECLARE varCostoP DOUBLE DEFAULT 0;

SET
    idTipoArray = (
        SELECT
            GROUP_CONCAT(DISTINCT habitacion.idTipo SEPARATOR ',')
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
    );

SET
    nivelGeneral = (
        SELECT
            ocupacion
        FROM
            hotel
        WHERE
            idHotel = Hotelid
    );

SELECT
    COUNT(*) INTO total_rows
FROM
    hotel
WHERE
    idHotel = Hotelid;

SET
    varCategoria = (
        SELECT
            categoria
        FROM
            hotel
        WHERE
            idHotel = Hotelid
    );

WHILE pos <= LENGTH(idTipoArray) - LENGTH(REPLACE(idTipoArray, ',', '')) + 1 DO
SET
    idTipo1 = SUBSTRING_INDEX(SUBSTRING_INDEX(idTipoArray, ',', pos), ',', -1);

SET
    varCostoP =(
        SELECT
            AVG(costo)
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
            AND idTipo = idTipo1
    );

-- SELECT idTipo1;
-- SELECT pos;
SET
    nivelTipo = (
        100 *(
            SELECT
                COUNT(*)
            FROM
                habitacion
            WHERE
                idHotel = Hotelid
                AND idTipo = idTipo1
                AND estado = "OCUPADO"
        )
    ) /(
        SELECT
            COUNT(*)
        FROM
            habitacion
        WHERE
            idHotel = Hotelid
            AND idTipo = idTipo1
    );

IF idTipo1 <> '' THEN
INSERT INTO
    registroocupacion
VALUES
    (
        Hotelid,
        NOW(),
        nivelGeneral,
        idTipo1,
        nivelTipo,
        varCategoria,
        varCostoP
    );

END IF;

SET
    pos = pos + 1;

END WHILE;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_inicioSemana` (
    IN `fechaConsulta` DATETIME,
    OUT `SALIDA` DATETIME
) BEGIN DECLARE SALIDA DATE;

SELECT
    DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(fechaConsulta) DAY) INTO SALIDA;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_porTipoDeHabitacion` (IN `HotelID` INT) BEGIN
SELECT
    idTipo,
    COUNT(*) as cantidad
FROM
    habitacion
WHERE
    HotelID = idHotel
    AND estado = "OCUPADO"
GROUP BY
    idTipo;

END $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_registrocliente` (IN `varIdRegistro` INT) BEGIN
SELECT
    idHabitacion
FROM
    registrocliente
WHERE
    idRegistro = varIdRegistro;

END $ $ DELIMITER;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;