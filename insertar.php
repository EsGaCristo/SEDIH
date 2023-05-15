<?php
$id = $_GET['id'];
include("src/database/conexion_bd.php");
$lugarProce = $_POST['lugarProc'];
$fechaSal = $_POST['fechaSalida'];
$fechaReg = $_POST['fechaRegistro'];
$idHabitacion = $_POST['idHab'];
$tipoHabitacion = $_POST['tipoHab'];
$motivoVisita = $_POST['motVis'];

$insertar = "INSERT INTO registrocliente (idRegistro, fechaHRegistro, fechaSalida, motivoVisita, lugarProcedencia, idHabitacion, tipoHabitacion,idHotel) 
    VALUES ('','$fechaReg','$fechaSal', '$motivoVisita','$lugarProce','$idHabitacion',$tipoHabitacion,$id)";

$actualizar = "UPDATE habitacion set estado = 'OCUPADO' WHERE codigoHabitacion = '$idHabitacion' ";
$update = mysqli_query($conexion, $actualizar);


$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
  echo '<script>
  alert("Los datos se han registrado correctamente.");
  setTimeout(function() {
    window.location.href = "Capturista.php?hotelid=' . $id . '";
  }, 50); // espera 3 segundos antes de redirigir
  </script>';
}

?>