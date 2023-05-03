<?php
$id = $_GET['id'];

include ("src/database/conexion_bd.php");
    $idH   = $_POST['idHabitacion'];
    $num   = $_POST['numHabitacion'];
    $Tipo   = $_POST['tipoHabitacion'];
    $estado = $_POST['estado'];
    $costo  = $_POST['CostoHabitacion'];
    //$idHotel = $_POST['$hotelid'];

    $insertar = 
    "INSERT INTO habitacion (codigoHabitacion, numeroHabitacion, idTipo, estado, costo, idHotel) 
    VALUES ('$idH',$num,$Tipo,'$estado', $costo, $id)";

$resultado = mysqli_query($conexion, $insertar);

if($resultado){
    header("location: Gerente.php?hotelid=$id");
}
?>