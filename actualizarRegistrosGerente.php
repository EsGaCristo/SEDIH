<?php
$id = $_GET['id'];

include("src/database/conexion_bd.php");
$idRegistro = $_POST['idRegistro'];
$fEntrada = $_POST['fEntrada'];
$fSalida = $_POST['fSalida'];
$Motivo = $_POST['Motivo'];
$Lugar = $_POST['Lugar'];


echo"<script>console.log('$idRegistro')</script>";

$actualizar = "UPDATE registrocliente set fechaHRegistro = '$fEntrada' , fechaSalida = '$fSalida' 
, motivoVisita = '$Motivo' , lugarProcedencia = '$Lugar'  WHERE idRegistro = '$idRegistro' ";
$update = mysqli_query($conexion, $actualizar);


if ($update) {
  header("location: Gerente.php?hotelid=$id");
}

?>