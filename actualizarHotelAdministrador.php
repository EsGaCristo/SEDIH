<?php
$id = $_GET['id'];

include("src/database/conexion_bd.php");
$idRegistro = $_POST['idRegistro'];
$fEntrada = $_POST['fEntrada'];
$fSalida = $_POST['fSalida'];
$Motivo = $_POST['Motivo'];
$Lugar = $_POST['Lugar'];
//$Habitacion = $_POST['Habitacion'];
//$Tipo = $_POST['Tipo'];

echo"<script>console.log('$idRegistro')</script>";

$actualizar = "UPDATE registrocliente set fechaHRegistro = '$fEntrada' , fechaSalida = '$fSalida' 
, motivoVisita = '$Motivo' , lugarProcedencia = '$Lugar' WHERE idRegistro = '$idRegistro' ";
$update = mysqli_query($conexion, $actualizar);



if ($update) {
  header("location: administrador.php?hotelid=$id");
}

?>