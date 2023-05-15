
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
