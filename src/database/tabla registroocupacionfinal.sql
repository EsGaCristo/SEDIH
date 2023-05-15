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