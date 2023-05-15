DELIMITER $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_diario`(IN `Hotelid` INT) BEGIN DECLARE idTipoArray TEXT;

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

END $ $ DELIMITER;

DELIMITER $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_inicioSemana`(
    IN `fechaConsulta` DATETIME,
    OUT `SALIDA` DATETIME
) BEGIN DECLARE SALIDA DATE;

SELECT
    DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(fechaConsulta) DAY) INTO SALIDA;

END $ $ DELIMITER;

DELIMITER $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_porTipoDeHabitacion`(IN `HotelID` INT) BEGIN
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

END $ $ DELIMITER;

DELIMITER $ $ CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_registrocliente`(IN varIdRegistro INT) BEGIN
SELECT
    idHabitacion
FROM
    registrocliente
WHERE
    idRegistro = varIdRegistro;

END $ $ DELIMITER;

-- Triggers -- 
CREATE TRIGGER `tr_actualizarOcupacion`
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

END CREATE TRIGGER `tr_ocupacionDisponible` BEFORE
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

END --
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
    (1, '2023-05-14 17:59:54', 2, 3, 0, 5, 0);

COMMIT;