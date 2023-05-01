
<?php
/* buscar_habitaciones.php

$tipoHabitacion = $_GET["tipoHabitacion"];

$query = $mysqli->query("SELECT * FROM habitacion WHERE idTipo='$tipoHabitacion' AND estado='DISPONIBLE' AND idHotel='$datos'");

$options = "<option value='0'>Seleccionar</option>";
while ($valores = mysqli_fetch_array($query)) {
    $options .= '<option value="'.$valores['codigoHabitacion'].'">'.$valores['codigoHabitacion'].'</option>';
}
echo $options;

*/
?>