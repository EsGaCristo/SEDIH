<?php
include ("src/database/conexion_bd.php");
include("Capturista.php");
    $id   = $_POST['idHabitacion'];
    $num   = $_POST['numHabitacion'];
    $Tipo   = $_POST['tipoHabitacion'];
    $estado = $_POST['estado'];
    $costo  = $_POST['CostoHabitacion'];
    $idHotel = $_POST['$hotelid'];

    $insertar = 
    "INSERT INTO habitacion (codigoHabitacion, numeroHabitacion, idTipo, estado, costo, idHotel) 
    VALUES ('$id',$num,$Tipo,'$estado', $costo, $idHotel)";

$resultado = mysqli_query($conexion, $insertar);

if($resultado){
    echo '<script> alert ("Se han registrado los datos");';
    header("location: Gerente.php");
}
?>