<?php
$id = $_GET['id'];

include ("src/database/conexion_bd.php");
    $idH   = $_POST['idHabitacion'];
    $num   = $_POST['numHabitacion'];
    $Tipo   = $_POST['tipoHabitacion'];
    $estado = $_POST['estado'];
    $costo  = $_POST['CostoHabitacion'];
    //$idHotel = $_POST['$hotelid'];



try {
    $insertar = 
    "INSERT INTO habitacion (codigoHabitacion, numeroHabitacion, idTipo, estado, costo, idHotel) 
    VALUES ('$idH',$num,$Tipo,'$estado', $costo, $id)";

    $resultado = mysqli_query($conexion, $insertar);

    if($resultado){
        header("location: Gerente.php?hotelid=$id");
    }
} catch (mysqli_sql_exception $e) {
    // si se produce una excepción, significa que hubo un error al insertar el registro
    // enviamos un alert al usuario indicando el problema
    echo "<script>alert('Hubo un error al insertar el registro: " . $e->getMessage() . "');</script>";
}

echo '<script>
alert("No se ha podido ingresar la habitacion, verifique que los datos.");
setTimeout(function() {
  window.location.href = "Gerente.php?hotelid=' . $id . '";
}, 50); // espera 3 segundos antes de redirigir
</script>';


?>