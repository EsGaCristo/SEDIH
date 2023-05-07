<?php
$id = $_GET['id'];
include("src/database/conexion_bd.php");
$nombre = $_POST['Nombre'];
$categoria = $_POST['Categoria'];
$domicilio = $_POST['Domicilio'];
$ocupacion = $_POST['Ocupacion'];
$ubicacion = $_POST['Ubicacion'];
$noHabitaciones = $_POST['NoHabitantes'];

$insertar = "INSERT INTO hotel (idHotel, nombre, categoria, domicilio, ocupacion, ubicacion, noHabitaciones) 
    VALUES ('','$nombre','$categoria', '$domicilio','$ocupacion','$ubicacion',$noHabitaciones)";


$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
  header("location: administrador.php?hotelid=$id");
}

?>