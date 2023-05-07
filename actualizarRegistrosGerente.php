<?php
$id = $_GET['id'];

include("src/database/conexion_bd.php");
$idHotel = $_POST['id'];
$nombre = $_POST['nombre'];
$categoria = $_POST['Categoria'];
$domicilio = $_POST['Domicilio'];
$ocupacion = $_POST['Ocupacion'];
$ubicacion = $_POST['Ubicacion'];
$noHabitaciones = $_POST['NoHabitaciones'];

echo"<script>console.log('$idHotel')</script>";

$actualizar = "UPDATE hotel set nombre = '$nombre' , categoria = '$categoria' 
, domicilio = '$domicilio' , ocupacion = '$ocupacion', ubicacion = '$ubicacion', NoHabitaciones = '$noHabitaciones' WHERE idHotel = '$idHotel' ";
$update = mysqli_query($conexion, $actualizar);



if ($update) {
  header("location: administrador.php?hotelid=$id");
}

?>