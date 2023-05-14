<?php
$idTipo = $_GET["idTipo"];
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
if ($mysqli->connect_errno) {
  echo "Error al conectar a la base de datos: " . $mysqli->connect_error;
  exit();
}
$query = $mysqli->query("SELECT costo FROM tipohabitacion WHERE idTipo = $idTipo");
if ($query) {
  $fila = mysqli_fetch_array($query);
  $costo = $fila["costo"];
  echo $costo;
} else {
  echo "Error al obtener el costo de la habitación: " . $mysqli->error;
}
$mysqli->close();
?>
